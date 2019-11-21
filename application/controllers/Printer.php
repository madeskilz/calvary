<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Printer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("logged_in")) {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        redirect(base_url());
    }
    public function printReceipt($reference = "")
    {
        $p = array();
        $p['title'] = "Print Receipt $reference";
        $uid = $this->session->userdata("user_id");
        $ulevel = $this->session->userdata("level");
        $this->db->where("reference", $reference);
        $this->db->where("user_id", $uid);
        $this->db->where("status", "approved");
        $payment_details = $this->db->get("payments", 1)->result();
        if (count($payment_details) > 0) {
            $pd = $p['payment'] = $payment_details[0];
            $p["pay_type"] = $this->db->query("SELECT * FROM payment_type WHERE id = $pd->type LIMIT 1")->row()->name;
            $this->db->where("id", $pd->type);
            $plevel = $this->db->get("payment_type", 1)->row()->level;
            $table = "students";
            if ($plevel < 1) {
                if ($pd->type == "1") {
                    $table = "applicants";
                } elseif ($pd->type == "2") {
                    $table = "prospective_students";
                }
            } elseif ($plevel == 1 && $ulevel == 4) {
                $table = "prospective_students";
            }
            $p['table'] = $table;
            $this->db->where("user_id", $uid);
            $p['details'] = $this->db->get($table, 1)->row();
            if (!$payment_details[0]->qr_code) {
                $datat = "Payment Reference: " . $payment_details[0]->payment_reference . "\r\n";
                $datat .= "Amount: " . $payment_details[0]->amount_paid . "\r\n";
                $datat .= "Full Name: "
                    . $p['details']->lastname . " "
                    . $p['details']->firstname . "\r\n";
                $datat .= "ID: " . (($p["details"]->matric_no) ? $p["details"]->matric_no : $p["details"]->admission_no) . "\r\n";
                $params['data'] = $datat;
                $qr_image = rand() . '.png';
                $params['level'] = 'H';
                $params['size'] = 8;
                $params['savename'] = FCPATH . "sitefiles/qrcodes/" . $qr_image;
                $this->load->library('ciqrcode');
                if ($this->ciqrcode->generate($params)) {
                    $p["qr_image"] = $qr_image;
                    $this->db->where("reference", $reference);
                    $this->db->where("user_id", $uid);
                    $this->db->where("status", "approved");
                    $this->db->update("payments", array("qr_code" => $qr_image));
                }
            } else {
                $p["qr_image"] = $payment_details[0]->qr_code;
            }
        } else {
            $this->session->set_flashdata('error_msg', "Payment details not found");
            redirect($_SERVER["HTTP_REFERER"]);
        }
        $this->load->view('printer/print-receipt', $p);
    }
    public function applicationForm($ad = "")
    {
        $user_id = simple_crypt($ad, "d");
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['details'] = $det = $this->db->get("applicants", 1)->row();
        if ($user_id != $uid) {
            $this->session->set_flashdata('error_msg', "User not found");
            return redirect($_SERVER['HTTP_REFERER']);
        }
        if(!$det->paid_application_fee && !$det->confirm_details){
            $this->session->set_flashdata('error_msg', "Please make all neccessary payments");
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $p['title'] = "Application Form $ad";
        $this->load->view('printer/application-form', $p);
    }
    public function admissionSlip($ad = "")
    {
        $user_id = simple_crypt($ad, "d");
        $uid = $this->session->userdata("user_id");
        if ($user_id != $uid) {
            $this->session->set_flashdata('error_msg', "User not found");
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $p['title'] = "Admission Slip $ad";
        $this->db->where("user_id", $uid);
        $det = $p['details'] = $this->db->get("prospective_students", 1)->row();
        if(!$det->paid_acceptance_fee){
            $this->session->set_flashdata('error_msg', "Please make all neccessary payments");
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $this->load->view('printer/admission-slip', $p);
    }
    public function acceptLetter($ad = "")
    {
        $user_id = simple_crypt($ad, "d");
        $uid = $this->session->userdata("user_id");
        if ($user_id != $uid) {
            $this->session->set_flashdata('error_msg', "User not found");
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $p['title'] = "Acceptance Letter $ad";
        $this->db->where("user_id", $uid);
        $det = $p['details'] = $this->db->get("prospective_students", 1)->row();
        if(!$det->paid_acceptance_fee){
            $this->session->set_flashdata('error_msg', "Please make all neccessary payments");
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $this->load->view('printer/accept-letter', $p);
    }
    public function admissionLetter($ad = "")
    {
        $user_id = simple_crypt($ad, "d");
        $uid = $this->session->userdata("user_id");
        if ($user_id != $uid) {
            $this->session->set_flashdata('error_msg', "User not found");
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $p['title'] = "Admission Letter $ad";
        $this->db->where("user_id", $uid);
        $det = $p['details'] = $this->db->get("prospective_students", 1)->row();
        if(!$det->paid_acceptance_fee){
            $this->session->set_flashdata('error_msg', "Please make all neccessary payments");
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $this->load->view('printer/admission-letter', $p);
    }
    public function clearanceForm($ad = "")
    {
        $user_id = simple_crypt($ad, "d");
        $uid = $this->session->userdata("user_id");
        if ($user_id != $uid) {
            $this->session->set_flashdata('error_msg', "User not found");
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $p['title'] = "Clearance Form $ad";
        $this->db->where("user_id", $uid);
        $p['olevel'] =  $this->db->get("exam")->result();
        $this->db->where("user_id", $uid);
        $det = $p['details'] = $this->db->get("prospective_students", 1)->row();
        if(!$det->paid_acceptance_fee){
            $this->session->set_flashdata('error_msg', "Please make all neccessary payments");
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $this->load->view('printer/clearance-form', $p);
    }
}
