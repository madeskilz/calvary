<?php
class Login_model extends CI_Model
{

    function validate($email, $password)
    {
        $this->db->where('user_email', $email);
        $this->db->or_where("matric_no", $email);
        $this->db->where('user_password', $password);
        $result = $this->db->get('users', 1);
        return $result;
    }
    function create_account($data = array())
    {
        $data['user_level'] = 5;
        $data['active'] = 1;
        try {
            $this->db->where("user_email", $data['user_email']);
            $count = $this->db->get("users", 1)->num_rows();
            if ($count > 0) {
                return "Email is already taken";
            }
            $this->db->insert("users", $data);
            $result = $this->db->insert_id();
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }
    function create_exam($data = array())
    {
        try {
            $this->db->insert("exam", $data);
            $result = $this->db->insert_id();
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }
    function create_result($data = array())
    {
        try {
            $this->db->insert("exam_results", $data);
            $result = $this->db->insert_id();
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }
    function applicant($data = array())
    {
        try {
            $this->db->insert("applicants", $data);
            $result = $this->db->insert_id();
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }
    function change_password($data = array())
    {
        // var_dump($data);exit;
        $validate = $this->validate($data["email"], md5($data["old_password"]));
        if ($validate->num_rows() > 0) {
            $this->db->where("user_id", $data["user_id"]);
            $this->db->set("user_password", md5($data["new_password"]));
            return $this->db->update("users");
        } else {
            return 'Error veryfing password';
        }
    }
    function update_applicant($data = array(), $user_id)
    {
        $data['confirm_details'] = 1;
        $this->db->where("user_id", $user_id);
        $result = $this->db->update("applicants", $data);
        return ($result) ?
            $result : 'Error editing your details, please contact admin if error persists.';
    }
}
