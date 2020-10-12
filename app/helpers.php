<?php
// namespace App\Http\Controllers\Auth;
// namespace App\Http\Controllers;

use App\Textlocal;
// use App\Exception;
use App\UserMeta;
use Exception;
use Auth;

function sms($number)
{	
    $textlocal = new Textlocal("veepeek@yahoo.com","d9fe2afa2f0b66e8418ffcc2f892259b04ddbcc37c22674c5717f2f7a8e21ad0");
        $numbers = array($number);
        $sender = 'MTRADE';
        $otp = mt_rand(100000,999999);
        $message = 'Thankyou for registering with Investment. Your verification code is '.$otp;
        try {
            $result = $textlocal->sendSms($numbers, $message, $sender);
            // dd($result);
            return $otp;
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
}


function user_register($number,$username, $password)
{   
    $textlocal = new Textlocal("veepeek@yahoo.com","d9fe2afa2f0b66e8418ffcc2f892259b04ddbcc37c22674c5717f2f7a8e21ad0");
        $numbers = array($number);
        $sender = 'MTRADE';
        $message = 'Welcome to Microtrademall business services. Username: '.$username.' / pw: '.$password.'. Click here https://microtrademall.com/login to login';
        try {
            $result = $textlocal->sendSms($numbers, $message, $sender);
            return $result;
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
}


function userotp($number)
{   
    $textlocal = new Textlocal("veepeek@yahoo.com","d9fe2afa2f0b66e8418ffcc2f892259b04ddbcc37c22674c5717f2f7a8e21ad0");
        $numbers = array($number);
        $otp = mt_rand(100000,999999);
        $sender = 'MTRADE';
        $message = 'Welcome to Microtrademall Business Services. your verification code is '.$otp;
        try {
            $result = $textlocal->sendSms($numbers, $message, $sender);
            return $otp;
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
}


function experience($ex){
    $stored = array(
        '-1' => 'Less than 1 Year',
        '12' => '1-2 Years',
        '23' => '2-3 Years',
        '34' => '3-4 Years',
        '45' => '4-5 Years',
        '50' => '5+ Years',
    );
    foreach ($stored as $key => $value) {
        if($ex == $key){
            return $value; 
            break;
        }
    }
    return null;

}

function tester(){
    echo 'test';
}


