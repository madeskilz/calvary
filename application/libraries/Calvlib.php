<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Calvlib
{
    public function __construct()
    { }

    /*
     * Interswitch requery and API query
     * @param : array - Necessary credentials for curl
     * */
    public function interswitch_curl($data = array())
    {
        $parameters = array(
            "productid" => $data['product_id'],
            "transactionreference"  =>  $data['txn_ref'],
            "amount"    =>  $data['amount']
        );
        // $hash = hash('SHA512', $txn_ref.INTERSWITCH_PRODUCT_ID.INTERSWITCH_PAY_ITEM_ID.$amt.$redirect_url.INTERSWITCH_MAC_KEY) ;
        $thash = hash('SHA512', $data['product_id'] . $data['txn_ref'] . MAC_LIVE);
        $ponmo = http_build_query($parameters);
        $url = INTERSWITCH_LIVE_RESPONSE_URL . '?' . $ponmo; // json
        $host = INTERSWITCH_LIVE_HOST_URL;
        $headers = array(
            "GET /HTTP/1.1",
            "Host: $host",
            "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1",
            "Accept: */* ",
            "Accept-Language: en-us,en;q=0.5",
            "Keep-Alive: 300",
            "Connection: keep-alive",
            "Hash: " . $thash
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POST, false);
        $response = curl_exec($ch);
        $response = json_decode($response, TRUE);
        curl_close($ch);
        return $response;
    }
    public function send_email($data = array())
    {
        $_this = &get_instance();
        $_this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.mailgun.org';
        $config['mailpath'] = "/usr/sbin/sendmail";
        $config['smtp_port'] = '587';
        $config['smtp_timeout'] = '30';
        $config['smtp_user'] = 'postmaster@sandbox6c152daa0163468591f652a72e914428.mailgun.org';
        $config['smtp_pass'] = 'fad1028f1956509c275ee722454c7081-4167c382-d0d9d1aa';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'text';
        $config['send_multipart'] = FALSE;
        $_this->email->initialize($config);

        $_this->email->from($data["from"], 'Calvary Polytechnic', 'info@calvarypoly.edu.ng');
        $_this->email->reply_to($data["reply_to"], 'Calvary Polytechnic');
        $_this->email->to($data["mail_to"]);

        $_this->email->subject($data["subject"]);
        $_this->email->message($data["message"]);
        if ($_this->email->send()) {
            return "message sent";
        }
        return $_this->email->print_debugger();
    }
}
