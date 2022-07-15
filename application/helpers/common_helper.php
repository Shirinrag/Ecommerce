<?php
	function token_get(){
        $tokenData = array();
        $tokenData['id'] = mt_rand(10000,99999); //TODO: Replace with data for token
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        return $output['token'];
    }

     function get_lat_long($address="")
    {
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address='".$address."'&sensor=false";
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $details_url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          $geoloc = json_decode(curl_exec($ch), true);
          switch ($geoloc[‘status’]) {
            case 'ZERO_RESULTS':
              return 0;
              break;
            case 'OK':
              print_r($geoloc['results'][0]['geometry']['location']);
              break;
          }
    }
?>