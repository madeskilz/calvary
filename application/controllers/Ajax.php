<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{

    public $product_name_rules = '.+';

    public function __construct()
    {
        parent::__construct();
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
    }

    public function index()
    {
        redirect(base_url());
    }


    // Fetch dept by school and programme
    public function get_dept()
    {
        $pid = cleanit($this->input->post('pid'));
        $sid = cleanit($this->input->post('sid'));
        $this->db->where("program", $pid);
        $this->db->where("school_id", $sid);
        $dept = $this->db->get("departments")->result_array();
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo json_encode($dept);
        exit;
    }
    // Fetch lga by state
    public function get_lga()
    {
        $sid = cleanit($this->input->post('sid'));
        $this->db->where("state_id", $sid);
        $dept = $this->db->get("locals")->result_array();
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo json_encode($dept);
        exit;
    }
    public function pay_application_fee()
    {
        $response = array();
        $response['status'] = 'error';
        $charge = 2000;
        $data = array();
        $data["reference"] = generate_code('payments', 'reference');
        $data["user_id"] = $this->session->userdata('user_id');
        $data["type"] = 1;
        $data["status"] = "pending";
        $data["method"] = "online";
        $data["payment_status"] = "pending";
        $data["amount"] = 5000;
        $data["amount_paid"] = 0;
        $data["charge"] = $charge;
        if ($this->db->insert("payments", $data)) {
            $response['status'] = 'success';
            $response['message'] = $data["reference"];
            $response['key'] = PUBLIC_KEY;
            $response['amount'] = 700000; //paystack uses kobo
            return_response($response);
        } else {
            $response['message'] = 'There was an error registering transaction';
            return_response($response);
        }
    }
    function interswitchWebpay()
    {
        $table_type = ($this->input->post('type')) ? cleanit($this->input->post('type')) : "applicants";
        $response = array('status' => 'error');
        $data = array();
        $uid = $this->session->userdata('user_id');
        $pid =  cleanit($this->input->post('pid'));
        $this->db->where('id', $pid);
        $p_item = $this->db->get("payment_type", 1)->row();
        $txn_ref = $data["reference"] = generate_code('payments', 'reference');
        $data["user_id"] = $uid;
        $this->session->set_userdata("txn_ref", $txn_ref);
        $this->session->set_userdata("table_type", $table_type);
        // var_dump($table_type);exit;
        //todo
        $this->session->set_userdata("payment_id", PRODUCT_ID);
        $token = simple_crypt($txn_ref);
        $data["type"] = $p_item->id;
        $data["status"] = "pending";
        $q = "SELECT * FROM `student_level` WHERE `user_id` = $uid ORDER BY `created_at` DESC LIMIT 1";
        $sl = $this->db->query($q, 1)->row();
        $data['session'] = ($sl != null) ? $sl->session : getNextSession();
        $data["payment_status"] = "pending";
        $data["amount"] = $p_item->amount;
        $data["amount_paid"] = 0;
        $data["charge"] = $p_item->process_charge;
        $data["total"] = $p_item->total;
        $amt = $p_item->total * 100; //payment uses kobo
        $this->session->set_userdata("amount", $amt);
        if ($this->db->insert("payments", $data)) {
            $response["status"] = "success";
            $response["xml_data"] = "";
            $response["xml_data"] .= '<pay_item_detail>' . "\r\n";
            $response["xml_data"] .= '<item_details detail_ref="' . $txn_ref
                . '" payment_name="' . $p_item->name
                . '" college="CalvaryPoly">' . "\r\n";
            //todo svl acc num
            $response["xml_data"] .= '<item_detail item_id="1" item_name="Schoolvile" item_amt="'
                . (((float) $p_item->process_charge - INTERSWITCH_CHARGE) * 100) . '" bank_id="117" acct_num="1014006596" />' . "\r\n";
            $response["xml_data"] .= '<item_detail item_id="2" item_name="Calvary_Poly" item_amt="'
                . (((float) $p_item->amount) * 100) . '" bank_id="117" acct_num="1015208263" />' . "\r\n";
            $response["xml_data"] .= '</item_details>' . "\r\n";
            $response["xml_data"] .= '</pay_item_detail>';
            $rUrl = $response["site_redirect_url"] = base_url("payment/interswitch/?t=$token");
            $response["hash"] = hash('SHA512', $txn_ref . PRODUCT_ID . PAYMENT_ITEM_ID . $amt . $rUrl . MAC_LIVE);
            $response["cust_id"] = $this->session->userdata("email");
            $this->db->where("user_id", $uid);
            $profile = $this->db->get($table_type, 1)->row();
            $response["cust_name"] = $profile->firstname . " " . $profile->lastname;
            $response['txn_ref'] = $txn_ref;
            $response['amount'] = $amt;
            $response['product_id'] = PRODUCT_ID;
            $response['pay_item_id'] = PAYMENT_ITEM_ID;
        } else {
            $response['message'] = 'There was an error registering transaction';
        }
        return_response($response);
    }
    public function verifyPaystack()
    {
        $response = array('status' => 'error');
        $paystackreference = $this->input->post('reference', true);
        $ref = $this->input->post('ref', true);
        // Get row of the transaction
        $this->db->where("reference", $ref); //ZvKXOmg9XIUJcY54
        $this->db->set(array("payment_reference" => $paystackreference));
        $this->db->update("payments");
        $this->db->where("reference", $ref);
        $row = $this->db->get("payments", 1)->row();
        if (!$row) {
            $response['message'] = "Transaction not found";
            return_response($response);
        } else {
            $amount = (float) $row->amount + (float) $row->charge;
            $url = 'https://api.paystack.co/transaction/verify/' . $paystackreference;
            try {
                $resource = curl_init();
                // Check if initialization had gone wrong*    
                if ($resource === false) {
                    throw new Exception('failed to initialize');
                }
                curl_setopt($resource, CURLOPT_URL, $url);
                curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
                curl_setopt(
                    $resource,
                    CURLOPT_HTTPHEADER,
                    ['Authorization: Bearer ' . SECRET_KEY]
                );
                curl_setopt($resource, CURLOPT_CUSTOMREQUEST, 'GET');
                $request = curl_exec($resource);
                // Check the return value of curl_exec(), too
                if ($request === false) {
                    throw new Exception(curl_error($resource), curl_errno($resource));
                }
                // Close curl handle
                curl_close($resource);
            } catch (Exception $e) {
                trigger_error(
                    sprintf(
                        'Curl failed with error #%d: %s',
                        $e->getCode(),
                        $e->getMessage()
                    ),
                    E_USER_ERROR
                );
            }
            if ($request) {
                $result = json_decode($request, true);
                if ($result) {
                    if ($result['data']) {
                        if ($result['data']['status'] == 'success') {
                            $this->db->trans_start();
                            $paystack_amount = $result['data']['amount'] / 100;
                            $amount_paid = $paystack_amount;
                            $set_data = array(
                                'status' => 'approved',
                                'payment_status' => $result['message'],
                                'amount_paid' => $amount_paid
                            );
                            $this->db->where("reference", $ref);
                            $this->db->set($set_data);
                            $this->db->update("payments");
                            $this->db->where("user_id", $row->user_id);
                            $this->db->set(array("paid_application_fee" => 1));
                            $this->db->update("applicants");
                            $this->db->trans_complete();
                            if ($this->db->trans_status() === FALSE) {
                                $this->db->trans_rollback();
                                $response['message'] = "There was an error updating your payment. Please contact us if debited.";
                                return_response($response);
                            } else {
                                $this->db->trans_commit();
                                $response['status'] = 'success';
                                $response['message'] = "Transaction successful.";
                                return_response($response);
                            }
                        } else {
                            $response['message'] = "Transaction was unsuccessful, please contact us if debited.";
                            return_response($response);
                        }
                    } else {
                        $response['message'] = $result['message'];
                        return_response($response);
                    }
                } else {
                    $response['message'] = "Technical Error. Please contact us if persist.";
                    return_response($response);
                }
            } else {
                $response['message'] = "Error";
                return_response($response);
            }
        }
    }
    public function login()
    {
        $result = array("status" => "error");
        $email    = cleanit($this->input->post('email'));
        $password = md5(cleanit($this->input->post('password')));
        $validate = $this->login_model->validate($email, $password);
        if ($validate->num_rows() > 0) {
            $data  = $validate->row_array();
            $user_id  = $data['user_id'];
            $email = $data['user_email'];
            $level = $data['user_level'];
            $active  = $data['active'];
            $sesdata = array(
                'user_id'  => $user_id,
                'email'     => $email,
                'level'     => $level,
                'active'     => $active,
                'logged_in' => TRUE
            );
            if ($active == 1) {
                $this->session->set_userdata($sesdata);
                $result['status'] = "success";
                return_response($result);
            } else {
                $result["message"] = 'Account Suspended';
                return_response($result);
            }
        } else {
            $result['message'] = 'Username or Password is Wrong';
            return_response($result);
        }
    }
    public function myresult()
    {
        $uid = $this->session->userdata("user_id");
        $result = array("status" => "error");
        $this->db->where("user_id", $uid);
        $r = $this->db->get("application_exam", 1)->row();
        $this->db->where("user_id", $uid);
        $p = $this->db->get("applicants", 1)->row();
        if (!$r) {
            $result['message'] = "Your exam score is 0";
            return_response($result);
        }
        $result["status"] = "success";
        if ((int) $r->score < 40) {
            $result['status'] = "error";
        }
        $result['message'] = "Your exam score is $r->score";
        $result['admission_status'] = $p->admission_status;
        return_response($result);
    }
}
