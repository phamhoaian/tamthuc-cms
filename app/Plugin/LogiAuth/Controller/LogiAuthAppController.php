<?php
App::uses('AppController', 'Controller');

class LogiAuthAppController extends AppController
{
	public function post_captcha() {
        $post_data = http_build_query(
            array(
                'secret' => CAPTCHA_PRIVATE_KEY,
                'response' => $_POST['g-recaptcha-response'],
            )
        );
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $post_data
            )
        );
        $context  = stream_context_create($opts);
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $result = json_decode($response, true);

        if(isset($result['success']) && $result['success']){
            return $result['success'];
        }
        return false;
    }
}
