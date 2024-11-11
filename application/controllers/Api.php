<?php

header('Access-Control-Allow-Origin: *');
require_once APPPATH . 'controllers/Mailer.php';
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');

Class Api extends Mailer {

    function Token() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://prdgta.scfhs.org.sa/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic ZjBjQmZHZmpEOHJTYWY4TXBpczBUSlhWQThzYTpkZHhXVHR2Wm1Ubk1QdVNicmxRd0xPUE9KblFh'
            ),
        ));

        $result = curl_exec($curl);
        $resultList = json_decode($result, true);
        curl_close($curl);
      return   $access_token=$resultList['access_token'];
        
    }

    function MembershipStatus($RequestData) {
        
        $token=$RequestData['token_key'];//"10f6459b-aaaf-3966-adef-02ede2a84051";
        $healthassociationcode=$RequestData['health_association_code'];//"20036";
        $membership_number=$RequestData['membership_number'];//"20220345";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://prdgta.scfhs.org.sa/member-staus/1.0.0',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                            "HealthAssociationCode": "'.$healthassociationcode.'",
                            "MemberShipNumber": "'.$membership_number.'"

}
',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer "'.$token.'"',
                'Content-Type: application/json'
            ),
        ));

        $result = curl_exec($curl);
        curl_close($curl);
        
        $resultList = json_decode($result, true);
        if(empty($resultList)){
         
            $CountStatus=-1;
        }
        else {
             $CountStatus=($resultList['MembersStatus']['MemberStatus']['CountStatus']);
        }
       
     return $CountStatus;
        
    }

}

?>