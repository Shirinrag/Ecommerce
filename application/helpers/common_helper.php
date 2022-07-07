<?php
    if (!function_exists('token_get')){
        function token_get(){
            $tokenData = array();
            $tokenData['id'] = mt_rand(1000000000000,9999999999999);
            $output['token'] = AUTHORIZATION::generateToken($tokenData);
            return $output['token'];
        }
    }

    if (!function_exists('get_session_name')){
        function get_session_name($user_type=''){
            switch ($user_type) {
                case "employer":
                    return "jp_employer_logged_in";
                    break;
                case "employee":
                    return "jp_employee_logged_in";
                    break;         
                default:
                    return "jp_employee_logged_in";
            }
        }
    }