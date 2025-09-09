<?php
    $cookiejar = sys_get_temp_dir() . "/cookie.jar";
    $redirectUrl = '';

        // generate id and redirect url
        global $cookiejar, $redirectUrl;
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://payments.yoco.com/api/checkouts',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_COOKIEJAR => $cookiejar,
          CURLOPT_COOKIEFILE => $cookiejar,
          CURLOPT_POSTFIELDS =>'{
            "amount": 900, 
            "currency": "ZAR"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer sk_test_ae0873f6NoDMvDP6b2e47a79aaca'
          ),
        ));
    
        $res = curl_exec($curl);
        $resArr = json_decode($res, true);
        
        $id = $resArr['id'];
        $redirectUrl = $resArr['redirectUrl'];
        
        
        curl_close($curl);
        
        //print_r('id: '.$id);
        //print_r('<br/>redirectUrl: '.$redirectUrl);

?>