<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CaptchaModel extends CI_Model {
    public function verify_recaptcha($response) {
        $secret_key = '6Lcn-k4nAAAAAE52jjQC0R0C1p_8XjopuG0w8DhI'; // Ganti dengan Secret Key Anda dari reCAPTCHA
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $data = array(
            'secret' => $secret_key,
            'response' => $response
        );

        $options = array(
            'http' => array (
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $result2 = json_decode($result, true);

        return $result2['success'];
    }
}
