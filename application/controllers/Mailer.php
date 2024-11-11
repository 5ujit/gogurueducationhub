<?php

Class Mailer extends CI_Controller {

   function sendEmailWelcome($requestData) {
        $email =$requestData['email'];
        $password =$requestData['password'];
        if (isset($email) && $email != "") {
            $userData = $this->Model->getData('kw_user_login_details', array('email' => $email));
            if (isset($userData) && !empty($userData) && is_array($userData)) {

             
                $from_title = "Welcome To KeyWood";
                $subject = "KeyWood Registration Details";
                $userfullname = $userData[0]['full_name'];
                $email = $userData[0]['email'];
                
                $msg = '<table style=" width: 650px;
    font-family:Lato, Verdana, Geneva, sans-serif;
    color: #666; background: #fff7cc;">
	<tr>
    	<td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: #171414;border-bottom: 8px solid #ffcd08;">
              <tr>
                <td align="center"><img src="http://www.binarylogic.co.in/keywood/images/mailer/logo.png" width="180" height=""></td>
              </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td>
        	 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: #fff6ce; padding: 10px 30px; padding-bottom: 50px;    color: #666666;">
              <tr>
                <td>
                	<h3 style="font-size:20px; margin-top: 30px;">Welcome #NAME#!</h3> 
                    <p style="line-height: 18px; font-size:12px;">
                   Welcome to KeyWood. <br> We are delighted to greet you onboard with our exclusive services. Your account has been created and you will be able to access it with your credentials!
          Your Login Details are mentioned below for your reference:
<br>
              <br>
              User Name     : #EMAIL#  <br>
              
              Password      : #PASSWORD#  <br>              

              <br>
             In order to login to your account please visit  <a href="http://www.binarylogic.co.in/keywood" target="_blank">www.keywood.com </a>   </p><br>                </td>
				
              </tr>
			  <tr>		
			  <td>			
	 <p style="line-height: 18px; font-size:12px;">
              For any query please send us an email on <a href="mailto:cs@keywood.com">cs@keywood.com</a> and we shall attend to your query at the earliest. 
              </p>			
				</td>
			  </tr>	  

            </table>
        </td>
    </tr>
	
    <tr>
    	<td>
         <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px 30px 20px 30px;color: #666666;background: #f5f3f4;font-size:11px;border-top: solid 3px #ffce00;">

              <tr>
                <td align="left">
                	<table style="font-size:11px;">
                    	  <tr>
                            <td>
                              <table style="font-size:11px; width: 250px;">
                                <tr>
                                  <td><a style="color:#666666;" href="http://www.binarylogic.co.in/keywood" target="_blank">https://keywoods.com/</a></td>
                                  <td><a href=""><img src="http://www.binarylogic.co.in/keywood/images/mailer/fa-icon.jpg" ></a></td>
                                  <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/tiw-icon.jpg" ></a></td>
                                  <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/insta-icon.jpg" ></a></td>
                                  <td> <a href="#"><img srchttp://www.binarylogic.co.in/keywood/images/mailer/in-icon.jpg" ></a></td>
                                </tr>
                              </table>
                            </td>
                        </tr>

                        <tr>
                          <td align="left" colspan="4"> keywoods 2019 © All Rights Reserved </td>
                        </tr>
                    </table>
                </td>

                <td align="right">
                  <table>
                    <tr>
                      <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/g-play.png" width="120"></a></td>
                      <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/ios.png" width="120"></a></td>
                    </tr>
                  </table>
                </td>              
              </tr>             
            </table>
      </td>    
    </tr>	
</table>';
           
                $msg = str_replace("#NAME#", $userfullname, $msg);
                $msg = str_replace("#EMAIL#", $email, $msg);
                $msg = str_replace("#PASSWORD#", $password, $msg);
                $config['protocol'] = 'mail';
                $config['newline'] = "\r\n";
                $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE; // bool whether to validate email or not
                $config['wordwrap'] = FALSE;
                $from_email="cs@binarylogic.co.in";
              //  $email="shrivaamit@gmail.com";
                $this->email->initialize($config);
                $this->email->from($from_email, $from_title);
                $this->email->to($email);
                $this->email->subject($subject);
               // echo $msg; exit;
                $this->email->message($msg);
                $this->email->send();
                $retMessage = $this->email->print_debugger();
            } else {
                $retMessage = 0;
            }
        } else {
            $retMessage = 0;
        }
        return array('msg' => $retMessage);
    }

    function sendChangePassword() {
        $email ="amit.shrivastava@cubictree.com";//$requestData['email'];

        if (isset($email) && $email != "") {
            $userData = $this->Model->getData('rm_portal_user_login_details', array('email' => $email));
            if (isset($userData) && !empty($userData) && is_array($userData)) {                
                $from_title = "Gogurueducationhub";
                $subject = "Gogurueducationhub :- Forgot Password Details";
                $userfullname = $userData[0]['full_name'];
                $email = $userData[0]['email'];
                $password = $userData[0]['password'];
               
                 $msg = '<table style=" width: 650px;
    font-family:Lato, Verdana, Geneva, sans-serif;
    color: #666; background: #fff7cc;">
	<tr>
    	<td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: #171414;border-bottom: 8px solid #ffcd08;">
              <tr>
                <td align="center"><img src="http://www.gogurueducationhub.com/portal/assets/img/logo.png" width="180" height=""></td>
              </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td>
        	 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: #fff6ce; padding: 10px 30px; padding-bottom: 50px;    color: #666666;">
              <tr>
                <td>
                	<h3 style="font-size:20px; margin-top: 30px;">Welcome #NAME#!</h3> 
                    <p style="line-height: 18px; font-size:12px;">
                   <br>
             Your Password has been changed.
<br>
              <br>
              Your Login Details are mentioned below for your reference:
<br>
              <br>
              User Name     : #EMAIL#  <br>
              
              Password      : #PASSWORD#  <br>

              

              <br>
             In order to login to your account please visit  <a href="http://www.gogurueducationhub.com/" target="_blank">www.gogurueducationhub.com </a>  </p><br>                </td>
				
              </tr>
			  <tr>		
			  <td>			
	 <p style="line-height: 18px; font-size:12px;">
              For any query please send us an email on <a href="mailto:support@gogurueducationhub.com">support@gogurueducationhub.com</a> and we shall attend to your query at the earliest. 
              </p>			
				</td>
			  </tr>	  

            </table>
        </td>
    </tr>
	
    <tr>
    	<td>
         <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px 30px 20px 30px;color: #666666;background: #f5f3f4;font-size:11px;border-top: solid 3px #ffce00;">

              <tr>
                <td align="left">
                	<table style="font-size:11px;">
                    	  <tr>
                            <td>
                              <table style="font-size:11px; width: 300px;">
                                <tr>
                                  <td><a style="color:#666666;" href="http://www.gogurueducationhub.com/">http://www.gogurueducationhub.com/</a></td>
                                  <td><a href="https://www.facebook.com/mentorvinod/"><img src="http://www.binarylogic.co.in/keywood/images/mailer/fa-icon.jpg" ></a></td>
                                  <td><a href="https://instagram.com/companionforlife1998?igshid=YmMyMTA2M2Y="><img src="http://www.binarylogic.co.in/keywood/images/mailer/insta-icon.jpg" ></a></td>
                                  <td> <a href="http://linkedin.com/in/vinod-gupta-65406046"><img src="http://www.binarylogic.co.in/keywood/images/mailer/in-icon.jpg" ></a></td>
                                </tr>
                              </table>
                            </td>
                        </tr>

                        <tr>
                          <td align="left" colspan="4"> gogurueducationhub 2023 © All Rights Reserved </td>
                        </tr>
                    </table>
                </td>

                              
              </tr>             
            </table>
      </td>    
    </tr>	
</table>';
           
                $msg = str_replace("#NAME#", $userfullname, $msg);
                $msg = str_replace("#EMAIL#", $email, $msg);
                $msg = str_replace("#PASSWORD#", $password, $msg);
                $config['protocol'] = 'mail';
                $config['newline'] = "\r\n";
                $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE; // bool whether to validate email or not
                $config['wordwrap'] = FALSE;
                $from_email="support@gogurueducationhub.com";
                $email="shrivaamit@gmail.com";
                $this->email->initialize($config);
                $this->email->from($from_email, $from_title);
                $this->email->to($email);
                $this->email->subject($subject);
                //echo $msg; exit;
                $this->email->message($msg);
                $this->email->send();
                $retMessage = $this->email->print_debugger();
            } else {
                $retMessage = 0;
            }
        } else {
            $retMessage = 0;
        }
        return array('msg' => $retMessage);
                
                
    }

    
   

   function sendVerificationCode($email,$type) {
    //$email = "harishratudi27@gmail.com";//$requestData['email'];
    //$type=1;
        if (isset($email) && $email != "") {
            $userData = $this->Model->getData('kw_user_login_details', array('email' => $email));
            if (isset($userData) && !empty($userData) && is_array($userData)) {
                 if ($type=='1'){ // Email
                 $from_title = "KeyWood Email Verification Code";
                $subject = "KeyWood Email Verification Code";
                $mobile_number = $userData[0]['email'];
                $mobile_code = $userData[0]['email_code'];
                $main_title="Email Id";
            }
                
                if ($type=='2'){ // Mobile
                $from_title = "KeyWood Mobile Verification Code";
                $subject = "KeyWood Mobile Verification Code";
                $mobile_number = $userData[0]['mobile'];
                $mobile_code = $userData[0]['mobile_code'];
                $main_title="Mobile No";
               }
        
            
               
                $userfullname = $userData[0]['full_name'];
               
                $msg = '<table style=" width: 650px;
    font-family:Lato, Verdana, Geneva, sans-serif;
    color: #666; background: #fff7cc;">
	<tr>
    	<td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: #171414;border-bottom: 8px solid #ffcd08;">
              <tr>
                <td align="center"><img src="http://www.binarylogic.co.in/keywood/images/mailer/logo.png" width="180" height=""></td>
              </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td>
        	 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: #fff6ce; padding: 10px 30px; padding-bottom: 50px;    color: #666666;">
              <tr>
                <td>
                	<h3 style="font-size:20px; margin-top: 30px;">Welcome #NAME#!</h3> 
                    <p style="line-height: 18px; font-size:12px;">
                   <br>
             <br>
           Please Find the OTP 
<br>
             
           
              
              #TITLE#      : #MOBILE_NO#  <br>
              
              OTP          : #MOBILECODE#  <br>
              

              <br>
             In order to login to your account please visit  <a href="http://www.binarylogic.co.in/keywood" target="_blank">www.keywood.com </a>  </p><br>                </td>
				
              </tr>
			  <tr>		
			  <td>			
	 <p style="line-height: 18px; font-size:12px;">
              For any query please send us an email on <a href="mailto:cs@keywood.com">cs@keywood.com</a> and we shall attend to your query at the earliest. 
              </p>			
				</td>
			  </tr>	  

            </table>
        </td>
    </tr>
	
    <tr>
    	<td>
         <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px 30px 20px 30px;color: #666666;background: #f5f3f4;font-size:11px;border-top: solid 3px #ffce00;">

              <tr>
                <td align="left">
                	<table style="font-size:11px;">
                    	  <tr>
                            <td>
                              <table style="font-size:11px; width: 250px;">
                                <tr>
                                  <td><a style="color:#666666;" href="https://keywoods.com/">https://keywoods.com/</a></td>
                                  <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/fa-icon.jpg" ></a></td>
                                  <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/tiw-icon.jpg" ></a></td>
                                  <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/insta-icon.jpg" ></a></td>
                                  <td> <a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/in-icon.jpg" ></a></td>
                                </tr>
                              </table>
                            </td>
                        </tr>

                        <tr>
                          <td align="left" colspan="4"> keywoods 2019 © All Rights Reserved </td>
                        </tr>
                    </table>
                </td>

                <td align="right">
                  <table>
                    <tr>
                      <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/g-play.png" width="120"></a></td>
                      <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/ios.png" width="120"></a></td>
                    </tr>
                  </table>
                </td>              
              </tr>             
            </table>
      </td>    
    </tr>	
</table>';
           
                $msg = str_replace("#NAME#", $userfullname, $msg);
                $msg = str_replace("#EMAIL#", $email, $msg);
                $msg = str_replace("#MOBILECODE#", $mobile_code, $msg);
                $msg = str_replace("#TITLE#", $main_title, $msg);
                $msg = str_replace("#MOBILE_NO#", $mobile_number, $msg);
               
                
                $config['protocol'] = 'mail';
                $config['newline'] = "\r\n";
                $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE; // bool whether to validate email or not
                $config['wordwrap'] = FALSE;
                $from_email="cs@binarylogic.co.in";
                //$email="shrivaamit@gmail.com";
                $this->email->initialize($config);
                $this->email->from($from_email, $from_title);
                $this->email->to($email);
                $this->email->subject($subject);
                //echo $msg; exit;
                $this->email->message($msg);
                $this->email->send();
                $retMessage = $this->email->print_debugger();
            } else {
                $retMessage = 0;
            }
        } else {
            $retMessage = 0;
        }
        return array('msg' => $retMessage);

                
    }

    function sendVerificationForgotCode($email,$sms_code) {
  //  $email = "shrivaamit@gmail.com";//$requestData['email'];
   // $type=1;
        if (isset($email) && $email != "") {
            $userData = $this->Model->getData('kw_user_login_details', array('email' => $email));
            if (isset($userData) && !empty($userData) && is_array($userData)) {
                $from_title = "KeyWood Forgot Password Verification Code";
                $subject = "KeyWood Forgot Password Verification Code";
                $userfullname = $userData[0]['full_name'];
               
                $msg = '<table style=" width: 650px;
    font-family:Lato, Verdana, Geneva, sans-serif;
    color: #666; background: #fff7cc;">
	<tr>
    	<td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: #171414;border-bottom: 8px solid #ffcd08;">
              <tr>
                <td align="center"><img src="http://www.binarylogic.co.in/keywood/images/mailer/logo.png" width="180" height=""></td>
              </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td>
        	 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: #fff6ce; padding: 10px 30px; padding-bottom: 50px;    color: #666666;">
              <tr>
                <td>
                	<h3 style="font-size:20px; margin-top: 30px;">Welcome #NAME#!</h3> 
                    <p style="line-height: 18px; font-size:12px;">
                   <br>
             <br>
           Please Find the OTP 
<br>
             
           
              
              Email Id       : #EMAIL#  <br>
              
              OTP            : #MOBILECODE#  <br>
              

              <br>
             In order to login to your account please visit  <a href="http://www.binarylogic.co.in/keywood" target="_blank">www.keywood.com </a>  </p><br>                </td>
				
              </tr>
			  <tr>		
			  <td>			
	 <p style="line-height: 18px; font-size:12px;">
              For any query please send us an email on <a href="mailto:cs@keywood.com">cs@keywood.com</a> and we shall attend to your query at the earliest. 
              </p>			
				</td>
			  </tr>	  

            </table>
        </td>
    </tr>
	
    <tr>
    	<td>
         <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px 30px 20px 30px;color: #666666;background: #f5f3f4;font-size:11px;border-top: solid 3px #ffce00;">

              <tr>
                <td align="left">
                	<table style="font-size:11px;">
                    	  <tr>
                            <td>
                              <table style="font-size:11px; width: 250px;">
                                <tr>
                                  <td><a style="color:#666666;" href="https://keywoods.com/">https://keywoods.com/</a></td>
                                  <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/fa-icon.jpg" ></a></td>
                                  <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/tiw-icon.jpg" ></a></td>
                                  <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/insta-icon.jpg" ></a></td>
                                  <td> <a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/in-icon.jpg" ></a></td>
                                </tr>
                              </table>
                            </td>
                        </tr>

                        <tr>
                          <td align="left" colspan="4"> keywoods 2019 © All Rights Reserved </td>
                        </tr>
                    </table>
                </td>

                <td align="right">
                  <table>
                    <tr>
                      <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/g-play.png" width="120"></a></td>
                      <td><a href="#"><img src="http://www.binarylogic.co.in/keywood/images/mailer/ios.png" width="120"></a></td>
                    </tr>
                  </table>
                </td>              
              </tr>             
            </table>
      </td>    
    </tr>	
</table>';
           
                $msg = str_replace("#NAME#", $userfullname, $msg);
                $msg = str_replace("#EMAIL#", $email, $msg);
                $msg = str_replace("#MOBILECODE#", $sms_code, $msg);
               
               
               
                
                $config['protocol'] = 'mail';
                $config['newline'] = "\r\n";
                $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE; // bool whether to validate email or not
                $config['wordwrap'] = FALSE;
                $from_email="cs@binarylogic.co.in";
               // $email="shrivaamit@gmail.com";
                $this->email->initialize($config);
                $this->email->from($from_email, $from_title);
                $this->email->to($email);
                $this->email->subject($subject);
               // echo $msg; exit;
                $this->email->message($msg);
                $this->email->send();
                $retMessage = $this->email->print_debugger();
            } else {
                $retMessage = 0;
            }
        } else {
            $retMessage = 0;
        }
        return array('msg' => $retMessage);

                
    }
    
    
    function sendFCM() {
$noti_type="1"; // 1->Normal,2=>Banner
$message=" You are Approved From IMAX Theater.";
$title="Theater Approval ";
$banner_img="";
$id="c2KSn21zkjk:APA91bHUGQCtz9B2Pq57b0cgWHTQxUVeLWwyv8tHLj48sYHYUgMVUymrKW5N_xdu8hRZxVVI1cIYx4DH5rP9X_YMLSN0_afLDnQtYXOUzP2v8HDaNWnLhFnZCw57X4WGE8Hg7nvVu52o";

	$reg_ids = explode(',', $id);
	
	$apiKey = "AIzaSyAQlqUBLDStH8oXgcVttWc1l9h-TMCKP1Y";
  //  $payload=array("type"=>1);
    $data=array("positiveButtonText"=>"Accept","negativeButtonText"=>"Reject");
    $messageData = array('message' => $message, 'title' => $title, 'notification_id' => rand(),'banner_img' => $banner_img,'noti_type' => $noti_type,'type'=>"6");
    $headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" . $apiKey);
    $finaldata = array(
     'data' => $messageData,
     'registration_ids' => $reg_ids,
    // 'Buttondata'=>$data       
    );
    //print_r($finaldata); 
//    print(json_encode($finaldata,true));
//    exit;
    $ch = curl_init();
 
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers ); 
    curl_setopt( $ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send" );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($finaldata) );
 
    $response = curl_exec($ch);
    curl_close($ch);
 
    //echo $response;die;

    $returnArr['errCode']=-1;
    $message = "Id exist";
    $returnArr['errMsg']=$response;

	print(json_encode($returnArr,true));
}
    
        
        }
   
  

?>