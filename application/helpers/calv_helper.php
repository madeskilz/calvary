<?php
if (!function_exists('get_state')) {
    function get_state($id)
    {
        $ci = &get_instance();
        $ci->db->where("id", $id);
        $state = $ci->db->get("states", 1)->row();
        return $state;
    }
}
if (!function_exists('naira')) {
    function naira($amt)
    {
        return "₦" . number_format((int) $amt, 2, ".", ",");
    }
}
if (!function_exists('get_lga')) {
    function get_lga($id)
    {
        $ci = &get_instance();
        $ci->db->where("local_id", $id);
        $lga = $ci->db->get("locals", 1)->row();
        return $lga;
    }
}
if (!function_exists('get_clearance')) {
    function get_clearance($id)
    {
        $ci = &get_instance();
        $ci->db->where("user_id", $id);
        $clr = $ci->db->get("student_clearance", 1)->row();
        if ($clr == null) return "not cleared";
        return $clr->code;
    }
}
if (!function_exists('admission_open')) {
    function admission_open()
    {
        $ci = &get_instance();
        $ci->db->where("id", 1);
        $ci->db->where("item_type", "session");
        $clr = $ci->db->get("settings", 1)->row();
        if ($clr == null) return false;
        return ($clr->item_setting == 1) ? true : false;
    }
}
if (!function_exists('get_matric')) {
    function get_matric($id)
    {
        $ci = &get_instance();
        $ci->db->where("user_id", $id);
        $clr = $ci->db->get("student_clearance", 1)->row();
        if ($clr == null) return "not cleared";
        return $clr->matric_no;
    }
}
if (!function_exists('get_exam_result')) {
    function get_exam_result($id)
    {
        $ci = &get_instance();
        $ci->db->where("exam_id", $id);
        $res = $ci->db->get("exam_results")->result();
        return $res;
    }
}
if (!function_exists('return_response')) {
    function return_response($array = array())
    {
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo json_encode($array);
        exit;
    }
}
if (!function_exists('get_exam_type')) {
    function get_exam_type($id)
    {
        $ci = &get_instance();
        $ci->db->where("id", $id);
        $res = $ci->db->get("exam_type", 1)->row();
        return $res->name;
    }
}
if (!function_exists('getStudentLevel')) {
    function getStudentLevel($id)
    {
        $ci = &get_instance();
        $ci->db->where("id", $id);
        $res = $ci->db->get("level", 1)->row();
        return $res->name;
    }
}
if (!function_exists('isLoggedIn')) {
    function isLoggedIn()
    {
        $_this = &get_instance();
        //1 = admin
        //2 = lecturer
        //3 = student
        //4 = prospective-student
        //5 = applicant
        //6 = bursar
        //7 = hod
        if ($_this->session->userdata("logged_in")) {
            $active = $_this->session->userdata("active");
            $level = $_this->session->userdata("level");
            if ($active == 1) {
                if ($level === '1') {
                    redirect('admin');
                } elseif ($level === '2') {
                    redirect('lecturer');
                } elseif ($level === '3') {
                    redirect('student');
                } elseif ($level === '4') {
                    redirect('prospective');
                } elseif ($level === '5') {
                    redirect('applicant');
                } elseif ($level === '6') {
                    redirect('burser');
                } elseif ($level === '7') {
                    redirect('hod');
                }
            } else {
                echo $_this->session->set_flashdata('msg', 'Account Suspended');
                redirect('logout');
            }
        }
    }
}
if (!function_exists('get_exam_score')) {
    function get_exam_score($id)
    {
        $ci = &get_instance();
        $ci->db->where("user_id", $id);
        $res = $ci->db->get("application_exam", 1)->row();
        return $res->score;
    }
}
if (!function_exists('getNextSession')) {
    function getNextSession()
    {
        $ci = &get_instance();
        $ci->db->where("status", "next");
        $res = $ci->db->get("school_session", 1)->row();
        return $res->session;
    }
}
if (!function_exists('getAppExamScore')) {
    function getAppExamScore($id)
    {
        $ci = &get_instance();
        $ci->db->where("user_id", $id);
        $res = $ci->db->get("application_exam", 1)->row();
        if ($res == null) return 0;
        return $res->score;
    }
}
if (!function_exists('get_payment_type')) {
    function get_payment_type($id)
    {
        $ci = &get_instance();
        $ci->db->where("id", $id);
        $res = $ci->db->get("payment_type", 1)->row();
        return $res->name;
    }
}
if (!function_exists('get_subject')) {
    function get_subject($id)
    {
        $ci = &get_instance();
        $ci->db->where("id", $id);
        $res = $ci->db->get("subjects", 1)->row();
        return $res->name;
    }
}
if (!function_exists('get_student_name')) {
    function get_student_name($id)
    {
        $ci = &get_instance();
        $ci->db->where("user_id", $id);
        $res = $ci->db->get("users", 1)->row();
        if ($res != null) {
            $table = "";
            if ($res->user_level == "3") {
                $table = "students";
            } elseif ($res->user_level == "4") {
                $table = "prospective_students";
            } elseif ($res->user_level == "5") {
                $table = "applicants";
            } else {
                return "";
            }
            $ci->db->where("user_id", $id);
            $pers = $ci->db->get($table, 1)->row();
            return "$pers->firstname $pers->lastname";
        }
        return "";
    }
}
if (!function_exists('get_department')) {
    function get_department($id)
    {
        $ci = &get_instance();
        $ci->db->where("id", $id);
        $res = $ci->db->get("departments", 1)->row();
        return $res;
    }
}
if (!function_exists('get_school')) {
    function get_school($id)
    {
        $ci = &get_instance();
        $ci->db->where("id", $id);
        $res = $ci->db->get("schools", 1)->row();
        return $res;
    }
}
if (!function_exists('get_program')) {
    function get_program($id)
    {
        $ci = &get_instance();
        $ci->db->where("id", $id);
        $res = $ci->db->get("programs", 1)->row();
        return $res;
    }
}
if (!function_exists('salt')) {
    function salt($length)
    {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789;:?.>,<!@#$%^&*()-_=+|';
        $randStringLen = $length;

        $randString = "";
        for ($i = 0; $i < $randStringLen; $i++) {
            $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
        }

        return $randString;
    }
}

if (!function_exists('generate_token')) {
    function generate_token($length)
    {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randStringLen = $length;
        $randString = "";
        for ($i = 0; $i < $randStringLen; $i++) {
            $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
        }
        return $randString;
    }
}
function generate_code($table = 'payments', $label = 'reference')
{
    do {
        $_this = &get_instance();
        $number = generate_token(16);
        $_this->db->where($label, $number);
        $_this->db->from($table);
        $count = $_this->db->count_all_results();
    } while ($count >= 1);
    return $number;
}

if (!function_exists('shaPassword')) {
    function shaPassword($field = "", $salt = "")
    {
        if ($field) {
            return hash('sha256', $field . $salt);
        }
    }
}

if (!function_exists('plushrs')) {
    function plushrs($dt, $hrs)
    {
        $pure = strtotime($dt);
        $plus = ($pure + 60 * 60 * $hrs);
        $newPure = date('Y-m-d H:i:s', $plus);
        return $newPure;
    }
}

if (!function_exists('ngn')) {
    function ngn($amt = '')
    {
        if ($amt == '') $amt = '0';
        return '₦ ' . number_format($amt);
    }
}

if (!function_exists('get_now')) {
    function get_now()
    {
        //		return gmdate("Y-m-d H:i:s", time());
        return gmdate("Y-m-d H:i:s", strtotime('+1 hour', time()));
    }
}


function get_percentage($total, $number)
{
    if ($total > 0) {
        return round($number / ($total / 100), 2);
    } else {
        return 0;
    }
}

function get_discount($sale_price, $discount_price)
{
    $percent = round((($sale_price - $discount_price) * 100) / $sale_price);
    return ($percent == 0) ? '' : $percent . '% <span>off</span>';
}


if (!function_exists('neatDate')) {
    function neatDate($dt)
    {
        $bdate = $dt;
        $bdate = str_replace('/', '-', $bdate);
        $nice_date = date('d M., Y', strtotime($bdate));
        return $nice_date;
    }
}

if (!function_exists('neatTime')) {
    function neatTime($dt)
    {
        $bdate = $dt;
        $bdate = str_replace('/', '-', $bdate);
        $nice_date = date('g:i a', strtotime('+1 hour', strtotime($bdate)));
        return $nice_date;
    }
}

function ago($time)
{
    $time = strtotime($time);
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    $now = time();
    $difference     = $now - $time;
    $tense         = "ago";

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if ($difference != 1) {
        $periods[$j] .= "s";
    }

    return "$difference $periods[$j] ";
    //	return "$difference $periods[$j] ago ";
}


function cleanit($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// Clean phone number
function phoneclean($num)
{
    $num = preg_replace('/\D/', '', $num);
    $len = strlen($num);
    $accurate = $len - 10;
    $realNUM = substr($num, $accurate);
    return '0' . $realNUM;
}

function urlify($string, $id = '')
{
    $new_string = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    if ($id != '') {
        return 'product/' . $new_string . '-' . $id . '/';
    } else {
        return $new_string;
    }
}

function siteurlify($string, $id = '')
{
    $new_string = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    if ($id != '') {
        return $new_string . '-' . $id . '/';
    } else {
        return $new_string;
    }
}

function current_full_url()
{
    $CI = &get_instance();

    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;
}


function curl_get_result($url)
{
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function simple_crypt($string, $action = 'e')
{
    $secret_key = '4n9*^%%$3n^&4v&%7@!90&$$3c3x$^*$m8a456#@tgf%$$c'; // 4n9*^%%$3n^&4v&%7@!90&$$3c3x$^*$m8a456#@tgf%$$c
    $secret_iv = 'cXpYEjhvzuVXOV7ltEQSAq8dvNQTWLar';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
