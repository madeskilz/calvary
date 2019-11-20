<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prospective extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("logged_in") || $this->session->userdata('level') !== '4') {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $p["active"] = "home";
        $p["title"] = "Clearance Home";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['profile'] = $this->db->get("prospective_students", 1)->row();
        $this->load->view('prospective/index', $p);
    }
    public function finish()
    {
        $p["active"] = "finish";
        $p["title"] = "Complete Clearance";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['profile'] = $profile = $this->db->get("prospective_students", 1)->row();
        if (!$profile->matric_no) {
            $this->session->set_flashdata('error_msg', "Please generate a matric number first");
            redirect("prospective");
        }
        $this->load->view('prospective/finish', $p);
    }

    public function completed()
    {
        $data = array();
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $profile = $this->db->get("prospective_students", 1)->row();
        if (!$profile->paid_school_fee) {
            $this->session->set_flashdata('error_msg', "Not Admitted");
            return redirect("prospective");
        }
        $this->db->trans_start();
        $this->db->where("user_id", $uid);
        $this->db->set(array("user_level" => 3));
        $this->db->update("users");
        $data['firstname'] = $profile->firstname;
        $data['lastname'] = $profile->lastname;
        $data['middlename'] = $profile->middlename;
        $data['department'] = $profile->department;
        $data['image'] = $profile->image;
        $data['title'] = $profile->title;
        $data['dateofbirth'] = $profile->dateofbirth;
        $data['phone'] = $profile->phone;
        $data['user_id'] = $profile->user_id;
        $data['alt_contact_rel'] = $profile->alt_contact_rel;
        $data['alt_contact_name'] = $profile->alt_contact_name;
        $data['alt_contact_phone'] = $profile->alt_contact_phone;
        $data['gender'] = $profile->gender;
        $data['marital_status'] = $profile->marital_status;
        $data['country'] = $profile->country;
        $data['lga'] = $profile->lga;
        $data['state'] = $profile->state;
        $data['address'] = $profile->address;
        $data['jamb_year'] = $profile->jamb_year;
        $data['jamb_score'] = $profile->jamb_score;
        $data['jamb_reg_no'] = $profile->jamb_reg_no;
        $data['exam_sitting'] = $profile->exam_sitting;
        $data['admission_no'] = $profile->admission_no;
        $data['matric_no'] = $profile->matric_no;
        $data['paid_school_fee_1'] = $profile->paid_school_fee;
        $data['paid_school_fee_2'] = 0;
        $this->db->insert("students", $data);
        $this->db->where("id", $profile->department);
        $prog = $this->db->get("departments", 1)->row()->program;
        $level_data["user_id"] = $profile->user_id;
        $level_data["matric_no"] = $profile->matric_no;
        $this->db->where(array('position' => 1, "program" => $prog));
        $new_level = $this->db->get('level', 1)->row()->id;
        $level_data["current_level"] = $new_level;
        $level_data["session"] = getNextSession();
        $this->db->insert("student_level", $level_data);
        $this->db->where("id", $profile->id);
        $this->db->delete("prospective_students");
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $response = "There was an error completing your registration.";
            $this->session->set_flashdata('error_msg', $response);
            redirect("prospective");
        } else {
            $response = "You have successfully completed your clearance process, login to continue with course registration.";
            $this->session->set_flashdata('success_msg', $response);
            redirect('logout');
        }
    }
    public function documents()
    {
        $p["active"] = "documents";
        $p["title"] = "Print Documents";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['profile'] = $this->db->get("prospective_students", 1)->row();
        $this->load->view('prospective/documents', $p);
    }
    public function matric()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->get_matric();
        }
        $p["active"] = "matric";
        $p["title"] = "Get Matric Number";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['profile'] = $profile = $this->db->get("prospective_students", 1)->row();
        if (!$profile->paid_acceptance_fee && !$profile->paid_school_fee) {
            $this->session->set_flashdata('error_msg', "Error getting matric number, please ensure you have paid your acceptance fee and gone through clearance before getting a matric number.");
            redirect("prospective");
        }
        $this->load->view('prospective/matric', $p);
    }
    private function get_matric()
    {
        $code = cleanit($this->input->post('code'));
        $user_id = $this->session->userdata("user_id");
        $this->db->where("user_id", $user_id);
        $this->db->where("code", $code);
        $clr = $this->db->get("student_clearance", 1)->row();
        if ($clr == null) {
            $this->session->set_flashdata('error_msg', "Error getting matric number please provide a valid clearance code");
            redirect("prospective/matric");
        }
        $this->db->trans_start();
        $this->db->where("user_id", $user_id);
        $this->db->set(array("matric_no" => $clr->matric_no));
        $this->db->update("users");

        $this->db->where("user_id", $user_id);
        $this->db->set(array("matric_no" => $clr->matric_no));
        $this->db->update("prospective_students");
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $response = "There was an error generatind your matric number.";
            $this->session->set_flashdata('error_msg', $response);
            redirect("prospective/matric");
        } else {
            $response = "You have successfully generated your matric number, Pay your school fee to continue.";
            $this->session->set_flashdata('success_msg', $response);
            redirect('prospective/finish');
        }
    }
    public function payment()
    {
        $p["active"] = "payment";
        $p["title"] = "Make Payments";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $prf = $p['profile'] = $this->db->get("prospective_students", 1)->row();
        $this->db->where("id", $prf->department);
        $prog = $p['prog'] = $this->db->get("departments", 1)->row()->program;
        $n = ($prf->department == 4) ? "003" : "004";
        $p['sfc'] = $prog . $n;
        $this->db->where("code", $prog . "002");
        $this->db->or_where("code", $prog . $n);
        $pt = $p['payment_type'] = $this->db->get("payment_type")->result();
        $this->db->where("user_id", $uid);
        $this->db->group_start();
        $this->db->where("type", $pt[0]->id);
        $this->db->or_where("type", $pt[1]->id);
        $this->db->group_end();
        $p['payments'] = $this->db->get("payments")->result();
        $this->load->view('prospective/payment', $p);
    }
    public function password()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->change_password();
        }
        $p["active"] = "password";
        $p["title"] = "Change Password";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['profile'] = $this->db->get("prospective_students", 1)->row();
        $this->load->view('prospective/password', $p);
    }
    public function profile()
    {
        $p["active"] = "profile";
        $p["title"] = "My Profile";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['profile'] = $this->db->get("prospective_students", 1)->row();
        $this->db->where("id", $p['profile']->department);
        $p['program'] = $this->db->get("departments", 1)->row()->program;
        $this->db->where("id", $p['profile']->department);
        $p['school'] = $this->db->get("departments", 1)->row()->school_id;
        $this->load->view('prospective/profile', $p);
    }
    private function change_password()
    {
        $uid = $this->session->userdata("user_id");
        $email = $this->session->userdata("email");
        $data = array();
        $data["old_password"] = cleanit($this->input->post('old_password'));
        $data["new_password"] = cleanit($this->input->post('new_password'));
        $data["user_id"] = $uid;
        $data["email"] = $email;
        $result = $this->login_model->change_password($data);
        if ($result > 0) {
            $this->session->set_flashdata('success_msg', "Password successfully changed");
            redirect("prospective");
        } else {
            $this->session->set_flashdata('error_msg', $result);
            redirect("prospective/password");
        }
    }
}
