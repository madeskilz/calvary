<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apply extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		if (!admission_open()) redirect(base_url());
		isLoggedIn();
		if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
			$this->apply();
		}
		$p["active"] = "apply";
		$p["title"] = "Application Form";
		$p["programs"] = $this->db->get('programs')->result();
		$p["schools"] = $this->db->get('schools')->result();
		$p["states"] = $this->db->get('states')->result();
		$this->load->view('home/application', $p);
	}
	private function apply()
	{
		$data = array();
		$login_data = array();
		$login_data['user_email'] = cleanit($this->input->post('email'));
		$login_data['user_password'] = md5(cleanit($this->input->post('password')));
		$result = $this->login_model->create_account($login_data);
		if ($result > 0) {
			$data['user_id'] = $result;
		} else {
			$this->session->set_flashdata('error_msg', $result);
			redirect("apply");
		}
		$data['firstname'] = cleanit($this->input->post('firstname'));
		$data['lastname'] = cleanit($this->input->post('lastname'));
		$data['middlename'] = cleanit($this->input->post('middlename'));
		$data['jamb_reg_no'] = cleanit($this->input->post('jamb_reg_no'));
		$data['jamb_score'] = cleanit($this->input->post('jamb_score'));
		$data['jamb_year'] = cleanit($this->input->post('jamb_year'));
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
			// }
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('image')) {
				$this->session->set_flashdata('error_msg', $this->upload->display_errors());
				redirect("apply");
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
		$data['admission_no'] = "AP/" . date("Y") . "/"
			. sprintf("%04d", $data['user_id']);
		$data['admission_status'] = 'processing';
		$add_student = $this->login_model->applicant($data);
		if ($add_student > 0) {
			$this->db->where("user_id", $data["user_id"]);
			$user_data = $this->db->get('users', 1)->row();
			$user_id  = $user_data->user_id;
			$email = $user_data->user_email;
			$level = $user_data->user_level;
			$active  = $user_data->active;
			$sesdata = array(
				'user_id'  => $user_id,
				'email'     => $email,
				'level'     => $level,
				'active'     => $active,
				'logged_in' => TRUE
			);
			$this->session->set_userdata($sesdata);
			redirect('applicant');
		} else {
			redirect("apply");
		}
	}
}
