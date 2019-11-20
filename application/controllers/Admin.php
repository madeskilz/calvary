<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("logged_in") || $this->session->userdata('level') !== '1') {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $p["active"] = "dashboard";
        $p["title"] = "Dashboard";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['details'] = $this->db->get("applicants", 1)->row();
        $this->db->where("user_id", $uid);
        $p['exams'] =  $this->db->get("exam")->result();
        $this->load->view('admin/index', $p);
    }
    public function courses(){
        
    }
    public function add_course(){
        
    }
    public function payments()
    {
        $p["active"] = "payment";
        $p["title"] = "All Payments";
        $p['payments'] =  $this->db->get("payments")->result();
        $this->load->view('admin/payments', $p);
    }
    public function session()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->update_session();
        }
        $p["active"] = "session";
        $p["title"] = "All Session";
        $this->db->where("status", "current");
        $p['c_session'] =  $this->db->get("school_session", 1)->row();
        $this->db->where("status", "next");
        $p['n_session'] =  $this->db->get("school_session", 1)->row();
        $this->db->where("item_type", "session");
        $t = $p['settings'] =  $this->db->get("settings", 1)->result();
        $this->load->view('admin/session', $p);
    }
    private function update_session()
    {
        $id = cleanit($this->input->post('id'));
        $session = cleanit($this->input->post('session'));
        $this->db->where("id", $id);
        $this->db->set("session", $session);
        if (!$this->db->update("school_session")) {
            $this->session->set_flashdata('error_msg', "Error Updating Session");
            return redirect("admin/session");
        }
        $this->session->set_flashdata('success_msg', "Session changed successfully");
        return redirect("admin/session");
    }
    public function toggle_settings()
    {
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
        $rr = (cleanit($this->input->post('act')) == "on") ? 1 : 0;
        $id = cleanit($this->input->post('item_id'));
        // return_response(array($rr,$id));exit;
        $this->db->where("id", $id);
        $this->db->set("item_setting", $rr);
        if ($this->db->update("settings")) {
            $this->session->set_flashdata('success_msg', "Settings changed successfully");
            $response["status"] = "success";
        } else {
            $this->session->set_flashdata('error_msg', "Error Updating Setting");
            $response["status"] = "error";
        }
        return_response($response);
    }
    public function prospective_clearance()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->single_clearance();
        }
        $p["active"] = "prospective";
        $p["title"] = "Student Clearance";
        $this->db->where("paid_acceptance_fee", "1");
        $p['prospectives'] =  $this->db->get("prospective_students")->result();
        $this->load->view('admin/prospective-clearance', $p);
    }
    private function single_clearance()
    {
        $user_id = cleanit($this->input->post('user_id'));
        $matric_no = cleanit($this->input->post('matric_no'));
        $code = generate_code('student_clearance', 'code');
        $this->db->where("user_id", $user_id);
        $clr = $this->db->get("student_clearance", 1)->row();
        if ($clr == null) {
            $data = array(
                "user_id" => $user_id,
                "matric_no" => $matric_no,
                "code" => $code
            );
            if ($this->db->insert("student_clearance", $data)) {
                $this->session->set_flashdata('success_msg', "Student successfully cleared");
                redirect("admin/prospective_clearance");
            } else {
                $this->session->set_flashdata('error_msg', "Error clearing student");
                redirect("admin/prospective_clearance");
            }
        } else {
            $this->session->set_flashdata('error_msg', "Student already cleared");
            redirect("admin/prospective_clearance");
        }
    }
    public function applicant_exam($batch = "")
    {
        if ($batch == "batch") {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                $this->batch_application_update();
            }
            $p["active"] = "applicant";
            $p["title"] = "Batch Update Applicant Admission";
            $this->db->where("paid_application_fee", "1");
            $p['applicants'] =  $this->db->get("applicants")->result();
            $this->load->view('admin/applicant-exam-batch', $p);
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                $this->single_application_update();
            }
            $p["active"] = "applicant";
            $p["title"] = "Applicant Admission";
            $this->db->where("paid_application_fee", "1");
            $t = $p['applicants'] =  $this->db->get("applicants")->result();
            // var_dump($t);exit;
            $this->load->view('admin/applicant-exam', $p);
        }
    }
    public function all_applicants() {
        $p["active"] = "applicant";
        $p["title"] = "All Applicants";
        $t = $p['applicants'] =  $this->db->get("applicants")->result();
        // var_dump($t);exit;
        $this->load->view('admin/all-applicant', $p);
    }
    private function batch_application_update()
    {
        $exam_scores = $this->input->post('exam_score');
        $user_ids = $this->input->post('user_id');
        $admission_status = $this->input->post('admission_status');
        for ($i = 0; $i < count($user_ids); $i++) {
            $this->db->where("user_id", $user_ids[$i]);
            $score = $this->db->get("application_exam", 1)->row();
            if ($score == null) {
                $data = array(
                    "user_id" => $user_ids[$i],
                    "score" => $exam_scores[$i]
                );
                $this->db->insert("application_exam", $data);
                $this->db->where("user_id", $user_ids[$i]);
                $this->db->set(array("done_exam" => 1, "admission_status" => $admission_status[$i]));
                $this->db->update("applicants");
            } else {
                $this->db->where("user_id", $user_ids[$i]);
                $this->db->set("score", $exam_scores[$i]);
                $this->db->update("application_exam");
                $this->db->where("user_id", $user_ids[$i]);
                $this->db->set(array("done_exam" => 1, "admission_status" => $admission_status[$i]));
                $this->db->update("applicants");
            }
        }
        $this->session->set_flashdata('success_msg', "Batch update successfully completed");
        redirect("admin/applicant_exam");
    }
    private function single_application_update()
    {
        $exam_score = cleanit($this->input->post('exam_score'));
        $admin_stat = cleanit($this->input->post('admission_status'));
        $user_id = $this->input->post('user_id');
        $this->db->where("user_id", $user_id);
        $score = $this->db->get("application_exam", 1)->row();
        if ($score == null) {
            $data = array(
                "user_id" => $user_id,
                "score" => $exam_score
            );
            $this->db->insert("application_exam", $data);
            $this->db->where("user_id", $user_id);
            $this->db->set(array("done_exam" => 1, "admission_status" => $admin_stat));
            $this->db->update("applicants");
        } else {
            $this->db->where("user_id", $user_id);
            $this->db->set("score", $exam_score);
            $this->db->update("application_exam");
            $this->db->where("user_id", $user_id);
            $this->db->set(array("done_exam" => 1, "admission_status" => $admin_stat));
            $this->db->update("applicants");
        }
        $this->session->set_flashdata('success_msg', "Applicant score and status successfully updated");
        redirect("admin/applicant_exam");
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
        $p['details'] = $this->db->get("applicants", 1)->row();
        $this->load->view('admin/password', $p);
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
            redirect("admin");
        } else {
            $this->session->set_flashdata('error_msg', $result);
            redirect("admin/password");
        }
    }
}
