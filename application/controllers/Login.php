<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function trainee() {
        $this->load->view('admin/login/trainee');
    }
    
      public function CheckTLogin() {
        $this->load->helper('cookie');
        $array['id'] = $this->input->post('user_id');
        $array['status'] = "1";
        $admin_language_id="2";
        $data_exist = $this->Admin_model->check_data('rm_portal_trainee_details', $array);
        if (!empty($data_exist)) {
            $data['status'] = true;
            setcookie('user_id', $data_exist->user_id, time() + ((86400) * 30 * 60), "/");
            setcookie('user_type_id', '2', time() + ((86400) * 30 * 60), "/");
            setcookie('admin_name', $data_exist->first_name, time() + ((86400) * 30 * 60), "/");
            setcookie('admin_language_id',$admin_language_id, time() + ((86400) * 30 * 60), "/");
        
           
        } else {
            $data['status'] = false;
        }
        //$data['email']=$email;
        echo json_encode($data);
    }
    public function index() {
        $this->load->view('admin/login/login');
    }

     public function Ins() {
        $this->load->view('admin/login/instruction');
    }
    public function ChangePassword($id) {
        $data['id'] = $id;
        $data['main_content'] = "admin/login/change_pass";
        $this->load->view('includes/template_login', $data);
    }

    public function CheckLogin() {
        $this->load->helper('cookie');
        $array['email'] = $this->input->post('email');
        $array['password'] = ($this->input->post('password'));
        $array['status'] = "1";

        $data_exist = $this->Admin_model->check_data('rm_user_login_details', $array);
        if (!empty($data_exist)) {
            $data['status'] = true;
            setcookie('admin_id', $data_exist->user_id, time() + ((86400) * 30 * 60), "/");
            setcookie('admin_email', $data_exist->email, time() + ((86400) * 30 * 60), "/");
            setcookie('admin_name', $data_exist->full_name, time() + ((86400) * 30 * 60), "/");
            setcookie('user_type_id', $data_exist->user_type_id, time() + ((86400) * 30 * 60), "/");
            setcookie('module_id_list', $data_exist->module_id_list, time() + ((86400) * 30 * 60), "/");
           
        } else {
            $data['status'] = false;
        }
        //$data['email']=$email;
        echo json_encode($data);
    }

    public function CheckForgotLogin() {
        //    $this->load->helper('cookie');
        $array['email'] = $this->input->post('email');

        $array['status'] = "1";

        $data_exist = $this->Admin_model->check_data('rm_user_login_details', $array);
        if (!empty($data_exist)) {
            $emailData = array("email" => $array['email']);
           // $this->sendForgotPassword($emailData);
            exit;
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }
        //$data['email']=$email;
        echo json_encode($data);
    }

    public function logout() {
        $this->load->helper('cookie');
        delete_cookie("country_id");
        delete_cookie("admin_id");
        delete_cookie("admin_email");
        delete_cookie("admin_name");
        delete_cookie("module_id_list");
        delete_cookie("user_type_id");
       
        redirect(base_url() . "Login");
    }
    
       public function TLogout() {
        $this->load->helper('cookie');
        delete_cookie("country_id");
        delete_cookie("user_id");
        delete_cookie("admin_email");
        delete_cookie("admin_name");
        delete_cookie("module_id_list");
        delete_cookie("user_type_id");
       
        redirect(base_url() . "trainee");
    }

    function ChangeUserPassword() {
        $user_id = $this->input->post('user_id');
        $email = base64_decode($user_id);
        $this->load->helper('cookie');
        $array['email'] = $email;
        $array['status'] = "1";

        $new_password = $this->input->post('new_password');
        $project_data['password'] = $new_password;
        $where = array("email" => $email);
        $insert_id = $this->Admin_model->update_data('rm_user_login_details', $project_data, $where);


        $data_exist = $this->Admin_model->check_data('rm_user_login_details', $array);


        if ($insert_id > 0) {
            if (!empty($data_exist)) {

                setcookie('admin_id', $data_exist->user_id, time() + ((86400) * 30 * 60), "/");
                setcookie('admin_email', $data_exist->email, time() + ((86400) * 30 * 60), "/");
                setcookie('admin_name', $data_exist->full_name, time() + ((86400) * 30 * 60), "/");
                setcookie('user_type_id', $data_exist->user_type_id, time() + ((86400) * 30 * 60), "/");
                setcookie('module_id_list', $data_exist->module_id_list, time() + ((86400) * 30 * 60), "/");
                setcookie('login_dealer_id', $data_exist->dealer_id, time() + ((86400) * 30 * 60), "/");
            }
            $return['status'] = true;
        } else {
            $return['status'] = false;
        }
        echo json_encode($return);
    }

    function sendForgotPassword($requestData) {

        if (isset($requestData) && !empty($requestData) && is_array($requestData)) {

            $from_title = "TriumphApproved India";
            $subject = "Reset Password";
            $email = $requestData['email'];
            $email_encode = base64_encode($email);
            $final_link = base_url() . "Login/ChangePassword/" . $email_encode;
            $msg = '<body style="margin:0; padding: 0px 0 0px 0; background-color: #f5f7f4"> 
                    <table width="100%" border="0" align="center" cellspacing="0" cellpadding="0" style="background:#f5f7f4;"> 
<tbody> <tr> <td style="padding:10px;" align="left" valign="middle">
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center"> 
<tr> 
<td align="center" valign="top"> <a style="text-decoration:none;" href="#" target="_blank">
<img src="https://www.triumphapproved.in/images/mailer/logo.jpg" alt="Triumph Approved"/></a> </td>
</tr>
</table> 
</td></tr></tbody> 
</table> 
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="background:#f5f7f4;"> 
<tr> <td align="left" valign="top"> 
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center"> 
<tr> <td align="left" valign="top"> 
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:arial; font-size:14px;">
 <tbody> <tr> <td align="left" valign="top"> 
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left"> 
 <tr> <td align="left" valign="top"> 
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"> 
 <tr> <td style="padding:0px;font-family:arial;line-height:100%;color:#000;"> 
 <table style="background: #2a2a2a;" width="100%" border="0" cellspacing="0" cellpadding="0" align="left"> 
 <tr> <td style="padding-top: 70px; padding-bottom:70px; padding-left:40px; padding-right:40px; color:#fff;">
 <h3 style="margin:0;font-size: 30px; font-weight:bold; line-height:normal;">APPROVED TRIUMPH </h3>
 <h3 style="margin:0;font-size: 30px; font-weight:bold;line-height:normal;">PRE-OWNED</h3>
 <p style="line-height: 20px;">Much more than a used bike<br/>Find your next Triumph</p></td></tr></table> </td></tr><tr> 
 <td style="padding-left: 40px; padding-right: 40px; padding-bottom:65px; padding-top:40px;line-height: 18px; font-size:14px;"> 
 <table style="font-size:14px;" width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
 <tr> <td style="font-family:arial;line-height:18px;color:#000;">
 <p style="font-size: 14px;line-height: 25px;">You have requested to reset your password on triumphapproved.in. Please click the following button to reset your password. <br><br><a href="#LINK#" target="_blank" style="min-height: 2.5rem;
height: 2.5rem;
line-height: 2.5rem;
background: #cd192d;
border: .125rem solid #cd192d;
box-shadow: none;
color: #fff;
cursor: pointer;
display: inline-block;
font-family: DIN2014-Demi;
font-size: 1.0625rem;
font-weight: inherit;
line-height: 2.375rem;
margin-bottom: 0;
min-height: 2.375rem;
height: 2.375rem;
padding: 0 1.25rem;
text-decoration: none;
text-transform: uppercase;
vertical-align: top;
white-space: nowrap;
-webkit-font-smoothing: antialiased;
position: relative;
border-radius: 0;
transition: background 250ms,border-color 250ms;
text-align: center;font-family:arial"> Reset Password </a> 
<br> <br> Thanks,
<br>TriumphApproved.in
 
</p>
 </td></tr></tbody> </table> </td></tr></table> </td></tr><tr><td>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background:#fff;"> <tr>
 <td align="center" valign="top" style="font-family:arial;font-size:15px;color:#999;line-height:100%;">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"> <tr> 
 <td align="center" colspan="2" valign="top" style="font-family:arial;font-size:15px;color:#999;line-height:100%; padding-top:20px; padding-bottom:20px;"> <a href="https://www.facebook.com/TriumphMotorcyclesIndia/" style="text-decoration:none; padding-right:5px;" target="_blank"><img style="height:18px; vertical-align:middle;" src="https://www.triumphapproved.in/images/mailer/facebook.png" alt=""/></a><a href="https://twitter.com/IndiaTriumph" style="text-decoration:none; padding-right:5px;" target="_blank"><img style="height:18px; vertical-align:middle;" src="https://www.triumphapproved.in/images/mailer/twitter.png" alt=""/></a><a href="https://www.instagram.com/indiatriumph/" style="text-decoration:none; padding-right:5px;" target="_blank"><img style="height:18px; vertical-align:middle;" src="https://www.triumphapproved.in/images/mailer/instagram.png" alt=""/></a><a href="https://www.youtube.com/c/triumphmotorcyclesindia" style="text-decoration:none; padding-right:5px;" target="_blank"><img style="height:18px; vertical-align:middle;" src="https://www.triumphapproved.in/images/mailer/youtube.png" alt=""/></a><a href="https://www.fortheride.com/" style="text-decoration:none; padding-right:5px;" target="_blank"><img style="height:18px; vertical-align:middle;" src="https://www.triumphapproved.in/images/mailer/fortheride.png" alt=""/></a></td></tr><tr> <td align="center" valign="top" style="font-family:arial;font-size:12px;color:#999;padding-bottom:5px;"> <a style="font-family:arial;font-size:12px;color:#333; text-decoration:none; white-space: nowrap;" href="https://www.triumphapproved.in/" target="_blank">www.triumphapproved.in</a> </td><td align="center" valign="top" style="font-family:arial;font-size:12px;color:#999;padding-bottom:20px;"> <a style="font-family:arial;font-size:12px;color:#333; text-decoration:none;white-space: nowrap;" href="#">Apporved Triumph Pre-owned</a> </td></tr></tr></table> </td></tr></table> </td></tr></table> </td></tr></tbody> </table> </td></tr></table> </td></tr></table>';

            $msg = str_replace("#LINK#", $final_link, $msg);
            $config['protocol'] = 'mail';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not
            $config['wordwrap'] = FALSE;
            $from_email = "contact@triumphapproved.in";
            $email = "shrivaamit@gmail.com";
            $this->email->initialize($config);
            $this->email->from($from_email, $from_title);
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($msg);
            $this->email->send();
            $retMessage = $this->email->print_debugger();
        } else {
            $retMessage = 0;
        }
        return array('msg' => $retMessage);
    }

    function UserVefification($user_id) {
        $email = base64_decode($user_id);
        $project_data['status'] = "1";
        $where = array("email" => $email);
        $insert_id = $this->Admin_model->update_data('rm_user_login_details', $project_data, $where);
        if ($insert_id > 0) {
            $Emaildata = $this->Model->getData('rm_user_login_details', array('email' => $email, 'status' => '1'));
            if (!empty($Emaildata)) {
                $requestData = array('email' => $email, 'password' => $Emaildata[0]['password'], 'full_name' => $Emaildata[0]['full_name']);
                //$this->sendLoginDetails($requestData);  
                
                $data['main_content'] = "admin/login/email_verify";
                $data['message']="Email verification completed successfully.";
                $this->load->view('includes/template_login', $data);
            }
           
   
        } else {
            $data['main_content'] = "admin/login/email_verify";
            $data['message']="Invalid email Id.";
            $this->load->view('includes/template_login', $data);
        }
        
    }

    function sendLoginDetails($requestData) {
        if (isset($requestData) && !empty($requestData) && is_array($requestData)) {

            $from_title = "TriumphApproved India";
            $subject = "TriumphApproved India  Admin Login Credentials";
            $email = $requestData['email'];
            $password = $requestData['password'];
            $full_name = $requestData['full_name'];

            $msg = '<body style="margin:0; padding: 0px 0 0px 0; background-color: #f5f7f4"> 
                    <table width="100%" border="0" align="center" cellspacing="0" cellpadding="0" style="background:#f5f7f4;"> 
<tbody> <tr> <td style="padding:10px;" align="left" valign="middle">
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center"> 
<tr> 
<td align="center" valign="top"> <a style="text-decoration:none;" href="#" target="_blank">
<img src="https://www.triumphapproved.in/images/mailer/logo.jpg" alt="Triumph Approved"/></a> </td>
</tr>
</table> 
</td></tr></tbody> 
</table> 
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="background:#f5f7f4;"> 
<tr> <td align="left" valign="top"> 
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center"> 
<tr> <td align="left" valign="top"> 
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:arial; font-size:14px;">
 <tbody> <tr> <td align="left" valign="top"> 
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left"> 
 <tr> <td align="left" valign="top"> 
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"> 
 <tr> <td style="padding:0px;font-family:arial;line-height:100%;color:#000;"> 
 <table style="background: #2a2a2a;" width="100%" border="0" cellspacing="0" cellpadding="0" align="left"> 
 <tr> <td style="padding-top: 70px; padding-bottom:70px; padding-left:40px; padding-right:40px; color:#fff;">
 <h3 style="margin:0;font-size: 30px; font-weight:bold; line-height:normal;">APPROVED TRIUMPH </h3>
 <h3 style="margin:0;font-size: 30px; font-weight:bold;line-height:normal;">PRE-OWNED</h3>
 <p style="line-height: 20px;">Much more than a used bike<br/>Find your next Triumph</p></td></tr></table> </td></tr><tr> 
 <td style="padding-left: 40px; padding-right: 40px; padding-bottom:65px; padding-top:40px;line-height: 18px; font-size:14px;"> 
 <table style="font-size:14px;" width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
 <tr> <td style="font-family:arial;line-height:18px;color:#000;">
 <p style="font-size: 14px;line-height: 25px;">Hi, <br>
You are a step closer to creating a user at triumphapproved.in. We just need to verify your email address in order to complete your registration. Click the button below to verify your email.
 Hi #NAME#,
 
<br>
            Please find the below Triumph Admin Login Credential
            
            URL              : #URL# <br>
            
            Username         : #USERNAME# <br>
            
            Password         : #PASSWORD# <br>

<br> Thanks,
<br>TriumphApproved.in
 
</p>
 </td></tr></tbody> </table> </td></tr></table> </td></tr><tr><td>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background:#fff;"> <tr>
 <td align="center" valign="top" style="font-family:arial;font-size:15px;color:#999;line-height:100%;">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"> <tr> 
 <td align="center" colspan="2" valign="top" style="font-family:arial;font-size:15px;color:#999;line-height:100%; padding-top:20px; padding-bottom:20px;"> <a href="https://www.facebook.com/TriumphMotorcyclesIndia/" style="text-decoration:none; padding-right:5px;" target="_blank"><img style="height:18px; vertical-align:middle;" src="https://www.triumphapproved.in/images/mailer/facebook.png" alt=""/></a><a href="https://twitter.com/IndiaTriumph" style="text-decoration:none; padding-right:5px;" target="_blank"><img style="height:18px; vertical-align:middle;" src="https://www.triumphapproved.in/images/mailer/twitter.png" alt=""/></a><a href="https://www.instagram.com/indiatriumph/" style="text-decoration:none; padding-right:5px;" target="_blank"><img style="height:18px; vertical-align:middle;" src="https://www.triumphapproved.in/images/mailer/instagram.png" alt=""/></a><a href="https://www.youtube.com/c/triumphmotorcyclesindia" style="text-decoration:none; padding-right:5px;" target="_blank"><img style="height:18px; vertical-align:middle;" src="https://www.triumphapproved.in/images/mailer/youtube.png" alt=""/></a><a href="https://www.fortheride.com/" style="text-decoration:none; padding-right:5px;" target="_blank"><img style="height:18px; vertical-align:middle;" src="https://www.triumphapproved.in/images/mailer/fortheride.png" alt=""/></a></td></tr><tr> <td align="center" valign="top" style="font-family:arial;font-size:12px;color:#999;padding-bottom:5px;"> <a style="font-family:arial;font-size:12px;color:#333; text-decoration:none; white-space: nowrap;" href="https://www.triumphapproved.in/" target="_blank">www.triumphapproved.in</a> </td><td align="center" valign="top" style="font-family:arial;font-size:12px;color:#999;padding-bottom:20px;"> <a style="font-family:arial;font-size:12px;color:#333; text-decoration:none;white-space: nowrap;" href="#">Apporved Triumph Pre-owned</a> </td></tr></tr></table> </td></tr></table> </td></tr></table> </td></tr></tbody> </table> </td></tr></table> </td></tr></table>';


            $url = base_url() . "Login";
            $msg = str_replace("#NAME#", $full_name, $msg);
            $msg = str_replace("#URL#", $url, $msg);
            $msg = str_replace("#USERNAME#", $email, $msg);
            $msg = str_replace("#PASSWORD#", $password, $msg);
            $config['protocol'] = 'mail';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not
            $config['wordwrap'] = FALSE;
            $from_email = "cs@triumph.com";
            $email="shrivaamit@gmail.com";
            $this->email->initialize($config);
            $this->email->from($from_email, $from_title);
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($msg);
            $this->email->send();
            $retMessage = $this->email->print_debugger();
        } else {
            $retMessage = 0;
        }
        return array('msg' => $retMessage);
    }

      function SetCookies() {
         $admin_language_id = $this->input->post('admin_language_id');
          if($admin_language_id=='')
          {
              $admin_language_id=1;
          }
          setcookie('admin_language_id',$admin_language_id, time() + ((86400) * 30 * 60), "/");
          
    }
    
       function checkemailaddress() {
        $jsonObj = $_POST['jsonObj'];
        $jsonData = json_decode($jsonObj, true);
        $jsonEntity = $jsonData['account'];

        $useremailaadress = $jsonEntity['emailaddress'];
        $emaildata = $this->Model->getData('rm_portal_user_login_details', array('email' => $useremailaadress));
        if ($emaildata) {// 1: Exist; 0:Not Exist
            echo "1";
        } else {
            echo "0";
        }
    }
    
    
	
	 function checkmobilenumber() {
        $jsonObj = $_POST['jsonObj'];
        $jsonEntity = json_decode($jsonObj, true);
        $jsonData = $jsonEntity['account'];

        $usermobilenumber = $jsonData['mobileno'];
        $mobiledata = $this->Model->getData('rm_portal_user_login_details', array('mobile' => $usermobilenumber));
        if ($mobiledata) {// 1: Exist; 0:Not Exist
            echo "1";
        } else {
            echo "0";
        }
    }
    
      
   
}
