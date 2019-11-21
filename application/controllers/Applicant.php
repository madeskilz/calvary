<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Applicant extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("logged_in") || $this->session->userdata('level') !== '5') {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $p["active"] = "dashboard";
        $p["title"] = "Application Form";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['details'] = $this->db->get("applicants", 1)->row();
        $this->db->where("user_id", $uid);
        $p['exams'] =  $this->db->get("exam")->result();
        $this->load->view('applicant/index', $p);
    }
    public function result()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->upload_result();
        }
        $p["active"] = "result";
        $p["title"] = "O'Level Results";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $this->db->set(array("confirm_details" => 1));
        $this->db->update("applicants");
        $this->db->where("user_id", $uid);
        $p['details'] = $this->db->get("applicants", 1)->row();
        if ($p['details']->uploaded_result == 1) {
            redirect(base_url("applicant"));
        }
        $p['subjects'] = $this->db->get("subjects")->result();
        $p['exam_types'] = $this->db->get("exam_type")->result();
        $this->load->view('applicant/result', $p);
    }
    public function acceptAdmission()
    {
        $data = array();
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $profile = $this->db->get("applicants", 1)->row();
        if ($profile->admission_status != "admitted") {
            $this->session->set_flashdata('error_msg', "Not Admitted");
            return redirect("applicant/checkresult");
        }
        $this->db->trans_start();
        $this->db->where("user_id", $uid);
        $this->db->set(array("user_level" => 4));
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
        $data['jamb_score'] = $profile->jamb_score;
        $data['jamb_year'] = $profile->jamb_year;
        $data['jamb_reg_no'] = $profile->jamb_reg_no;
        $data['exam_sitting'] = $profile->exam_sitting;
        $data['admission_no'] = $profile->admission_no;
        $data['paid_acceptance_fee'] = 0;
        $data['paid_school_fee'] = 0;
        $this->db->insert("prospective_students", $data);
        $this->db->where("id", $profile->id);
        $this->db->delete("applicants");
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $response = "There was an error accepting your admission.";
            $this->session->set_flashdata('error_msg', $response);
            redirect("applicant/checkresult");
        } else {
            $response = "You have successfully accepted your admission, login to continue with clearance.";
            $this->session->set_flashdata('success_msg', $response);
            redirect('logout');
        }
    }
    private function upload_result()
    {
        $uid = $this->session->userdata("user_id");
        $exam_data = array();
        $exam_sitting = cleanit($this->input->post('exam_sitting'));
        //for exam table
        $exam_data["user_id"] = $uid;
        $exam_data["exam_type"] = cleanit($this->input->post('exam_type'));
        $exam_data["exam_no"] = cleanit($this->input->post('exam_no'));
        $exam_data["exam_year"] = cleanit($this->input->post('exam_year'));
        //subjects
        $subject = $this->input->post('subject');
        $grade = $this->input->post('grade');

        $result = $this->login_model->create_exam($exam_data);
        if ($result > 0) {
            for ($i = 0; $i < count($subject); $i++) {
                $result_data = array();
                $result_data['exam_id'] = $result;
                $result_data['subject'] = $subject[$i];
                $result_data['grade'] = $grade[$i];
                if ($grade[$i] != '' && $subject[$i] != '') {
                    $this->login_model->create_result($result_data);
                }
            }
        } else {
            $this->session->set_flashdata('error_msg', "Error uploading your o' level result, please try again.");
            redirect("applicant/result");
        }
        if ($exam_sitting == 2) {
            //for exam table
            $exam_data["user_id"] = $uid;
            $exam_data["exam_type"] = cleanit($this->input->post('exam_type2'));
            $exam_data["exam_no"] = cleanit($this->input->post('exam_no2'));
            $exam_data["exam_year"] = cleanit($this->input->post('exam_year2'));
            //subjects
            $subject = $this->input->post('subject2');
            $grade = $this->input->post('grade2');

            $result = $this->login_model->create_exam($exam_data);
            if ($result > 0) {
                for ($i = 0; $i < count($subject); $i++) {
                    $result_data = array();
                    $result_data['exam_id'] = $result;
                    $result_data['subject'] = $subject[$i];
                    $result_data['grade'] = $grade[$i];
                    if ($grade[$i] != '' && $subject[$i] != '') {
                        $this->login_model->create_result($result_data);
                    }
                }
            }
        }
        $this->db->where("user_id", $uid);
        $this->db->set(array("uploaded_result" => 1, "exam_sitting" => $exam_sitting));
        $this->db->update("applicants");
        $this->session->set_flashdata('success_msg', "Result uploaded successfully.");
        redirect(base_url("applicant"));
    }
    public function payment()
    {
        $p["active"] = "payment";
        $p["title"] = "Payment";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $profile = $p['details'] = $this->db->get("applicants", 1)->row();
        $this->db->where("id", $profile->department);
        $prog = $this->db->get("departments", 1)->row()->program;
        $this->db->where("code", $prog . "001");
        $pt = $p['payment_type'] = $this->db->get("payment_type")->result();
        $this->db->where("user_id", $uid);
        $this->db->where("type", $pt[0]->id);
        $p['payments'] = $this->db->get("payments")->result();
        $this->load->view('applicant/payment', $p);
    }
    public function upload()
    {
        $p["active"] = "upload";
        $p["title"] = "Upload Documents";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['details'] = $this->db->get("applicants", 1)->row();
        $this->load->view('applicant/upload', $p);
    }
    public function upload_birth_cert()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->upload_birth_cert_fn();
        }
        $p["active"] = "upload";
        $p["title"] = "Upload Birth Certificate";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['details'] = $this->db->get("applicants", 1)->row();
        if ($p['details']->uploaded_birth_cert) redirect("applicant/upload");
        $this->load->view('applicant/upload_birth_cert', $p);
    }
    public function upload_lga_cert()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->upload_lga_cert_fn();
        }
        $p["active"] = "upload";
        $p["title"] = "Upload Birth Certificate";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['details'] = $this->db->get("applicants", 1)->row();
        if ($p['details']->uploaded_lga_cert) redirect("applicant/upload");
        $this->load->view('applicant/upload_lga_cert', $p);
    }
    public function upload_jamb_printout()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->upload_jamb_printout_fn();
        }
        $p["active"] = "upload";
        $p["title"] = "Upload Birth Certificate";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['details'] = $this->db->get("applicants", 1)->row();
        if ($p['details']->uploaded_jamb_printout) redirect("applicant/upload");
        $this->load->view('applicant/upload_jamb_printout', $p);
    }
    public function documents()
    {
        $p["active"] = "documents";
        $p["title"] = "Documents Birth Certificate";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['details'] = $this->db->get("applicants", 1)->row();
        $this->load->view('applicant/documents', $p);
    }
    public function checkresult()
    {
        $p["active"] = "check_result";
        $p["title"] = "Application Exam Result";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['details'] = $det = $this->db->get("applicants", 1)->row();
        if ($det->done_exam != 1) {
            $this->session->set_flashdata('error_msg', "No exam record found.");
            return redirect("applicant");
        }
        $this->load->view('applicant/checkresult', $p);
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
        $this->load->view('applicant/password', $p);
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
            redirect("applicant");
        } else {
            $this->session->set_flashdata('error_msg', $result);
            redirect("applicant/password");
        }
    }
    private function upload_birth_cert_fn()
    {
        $data = array();
        $data["user_id"] = $this->session->userdata("user_id");
        $upload_data = array();
        if (isset($_FILES) && $_FILES['image']['name'] != '') :
            $imagename = rand(1, 1999) . "_birth_cert_" . $data['user_id'];
            $path = realpath(FCPATH . 'sitefiles/applicants/birth/');
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png|webp|jpeg';
            $config['file_name'] = $imagename;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                redirect("applicant/upload_birth_cert");
            } else {
                $upload_data = $this->upload->data();
            }
        endif;
        if (count($upload_data) > 0) :
            $data["certificate"] = ($upload_data['file_name']);
        endif;
        if ($this->db->insert("birth_certs", $data)) {
            $uid = $this->session->userdata("user_id");
            $this->db->where("user_id", $uid);
            $this->db->set(array("uploaded_birth_cert" => 1));
            $this->db->update("applicants");
            $message = 'Birth certificate uploaded successfully.';
            $this->session->set_flashdata('success_msg', $message);
            redirect("applicant/upload");
        } else {
            $message = 'There was an error uploading your birth certificate.';
            $this->session->set_flashdata('error_msg', $message);
            redirect("applicant/upload_birth_cert");
        }
    }
    private function upload_lga_cert_fn()
    {
        $data = array();
        $data["user_id"] = $this->session->userdata("user_id");
        $upload_data = array();
        if (isset($_FILES) && $_FILES['image']['name'] != '') :
            $imagename = rand(1, 1999) . "_lga_cert_" . $data['user_id'];
            $path = realpath(FCPATH . 'sitefiles/applicants/lga/');
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png|webp|jpeg';
            $config['file_name'] = $imagename;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                redirect("applicant/upload_lga_cert");
            } else {
                $upload_data = $this->upload->data();
            }
        endif;
        if (count($upload_data) > 0) :
            $data["certificate"] = ($upload_data['file_name']);
        endif;
        if ($this->db->insert("lga_certs", $data)) {
            $uid = $this->session->userdata("user_id");
            $this->db->where("user_id", $uid);
            $this->db->set(array("uploaded_lga_cert" => 1));
            $this->db->update("applicants");
            $message = 'LGA certificate uploaded successfully.';
            $this->session->set_flashdata('success_msg', $message);
            redirect("applicant/upload");
        } else {
            $message = 'There was an error uploading your LGA certificate.';
            $this->session->set_flashdata('error_msg', $message);
            redirect("applicant/upload_lga_cert");
        }
    }
    private function upload_jamb_printout_fn()
    {
        $data = array();
        $data["user_id"] = $this->session->userdata("user_id");
        $upload_data = array();
        if (isset($_FILES) && $_FILES['image']['name'] != '') :
            $imagename = rand(1, 1999) . "_jamb_printout_" . $data['user_id'];
            $path = realpath(FCPATH . 'sitefiles/applicants/jamb/');
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png|webp|jpeg';
            $config['file_name'] = $imagename;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                redirect("applicant/upload_jamb_printout");
            } else {
                $upload_data = $this->upload->data();
            }
        endif;
        if (count($upload_data) > 0) :
            $data["certificate"] = ($upload_data['file_name']);
        endif;
        if ($this->db->insert("jamb_printouts", $data)) {
            $uid = $this->session->userdata("user_id");
            $this->db->where("user_id", $uid);
            $this->db->set(array("uploaded_jamb_printout" => 1));
            $this->db->update("applicants");
            $message = 'JAMB printout uploaded successfully.';
            $this->session->set_flashdata('success_msg', $message);
            redirect("applicant/upload");
        } else {
            $message = 'There was an error uploading your JAMB printout.';
            $this->session->set_flashdata('error_msg', $message);
            redirect("applicant/upload_jamb_printout");
        }
    }
    public function edit()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->update_details();
        }
        $p["active"] = "edit";
        $p["title"] = "Edit Details";
        $uid = $this->session->userdata("user_id");
        $this->db->where("user_id", $uid);
        $p['details'] = $this->db->get("applicants", 1)->row();
        $this->db->where("id", $p['details']->department);
        $p['program'] = $this->db->get("departments", 1)->row()->program;
        $this->db->where("id", $p['details']->department);
        $p['s_school'] = $this->db->get("departments", 1)->row()->school_id;
        if ($p['details']->confirm_details) redirect("applicant");
        $p["programs"] = $this->db->get('programs')->result();
        $p["schools"] = $this->db->get('schools')->result();
        $p["states"] = $this->db->get('states')->result();
        $this->load->view('applicant/edit', $p);
    }
    private function update_details()
    {
        $data = array();
        $data['firstname'] = cleanit($this->input->post('firstname'));
        $data['lastname'] = cleanit($this->input->post('lastname'));
        $data['middlename'] = cleanit($this->input->post('middlename'));
        $data['jamb_year'] = cleanit($this->input->post('jamb_year'));
        $data['jamb_reg_no'] = cleanit($this->input->post('jamb_reg_no'));
        $data['jamb_score'] = cleanit($this->input->post('jamb_score'));
        $data['address'] = cleanit($this->input->post('address'));
        $data['department'] = cleanit($this->input->post('department'));
        $program = cleanit($this->input->post('program'));
        $school = cleanit($this->input->post('school'));
        $upload_data = array();
        if (isset($_FILES) && $_FILES['image']['name'] != '') :
            $imagename = rand(1, 1999) . $data['lastname'];
            $path = realpath(FCPATH . 'sitefiles/applicants/images/');
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png|webp|jpeg';
            $config['file_name'] = $imagename;
            // if (!is_dir($path)) {
            // 	mkdir($path, 0777);
            // }Delete previous image before uploading new one
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                redirect("application-form");
            } else {
                $upload_data = $this->upload->data();
            }
        endif;
        if (count($upload_data) > 0) :
            $data["image"] = ($upload_data['file_name']);
        endif;
        $data['title'] = cleanit($this->input->post('title'));
        $data['dateofbirth'] = cleanit($this->input->post('dateofbirth'));
        $data['phone'] = cleanit($this->input->post('phone'));
        $data['alt_contact_rel'] = cleanit($this->input->post('alt_contact_rel'));
        $data['alt_contact_phone'] = cleanit($this->input->post('alt_contact_phone'));
        $data['alt_contact_name'] = cleanit($this->input->post('alt_contact_name'));
        $data['gender'] = cleanit($this->input->post('gender'));
        $data['marital_status'] = cleanit($this->input->post('marital_status'));
        $data['country'] = cleanit($this->input->post('country'));
        $data['state'] = cleanit($this->input->post('state'));
        $data['lga'] = cleanit($this->input->post('lga'));
        $uid = $this->session->userdata("user_id");
        $update_student = $this->login_model->update_applicant($data, $uid);
        if ($update_student > 0) {
            $this->session->set_flashdata('success_msg', "Details successfully edited.");
            redirect("applicant");
        } else {
            $this->session->set_flashdata('error_msg', $update_student);
            redirect("applicant/edit");
        }
    }
}
