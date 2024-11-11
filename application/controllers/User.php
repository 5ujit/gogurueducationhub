<?php

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
        $this->no_cache();
//        $admin_id = $this->input->cookie('admin_id', TRUE);
//        if ($admin_id == '') {
//            redirect(base_url() . "Login");
//        }
    }

    protected function no_cache() {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

      function index() {
        $data['menu_type'] = "1";  
        $data['jsType'] = "4";
        $data['user'] = "active";
        $data['main_content'] = "admin/user/userList";
        $this->load->view('includes/template_admin', $data);
    }
    
    function AddUser() {

        $data['jsType'] = "4";
        $data['user'] = "active";
        $data['main_content'] = "admin/user/user";
        $this->load->view('includes/template_admin', $data);
    }
    
    

    function loadUserData() {
        
        $Module_data = $this->Admin_model->select_all_data('rm_admin_module_details', array("status" => "1"), "module_name", "ASC");

        if (count($Module_data) > 0) {
            $dataReturn['status'] = true;
            $i = 1;
            foreach ($Module_data as $Module):

                $dataReturn['moduleList'][] = array(
                    'id' => $Module->module_id,
                    'name' => $Module->module_name,
                    'number' => $i
                );

                $i++;
            endforeach;
        }

        $Userdata = $this->Admin_model->getAllDataquery("SELECT * FROM rm_user_login_details ");

        if (count($Userdata) > 0) {
            $dataReturn['status'] = true;
            $i = 1;
            foreach ($Userdata as $User):
                $ModuleList = "";
                $module_list = $User->module_id_list;
                if ($module_list != NULL) {
                    $moduleLists = explode(',', $module_list);

                    for ($k = 0; $k < count($moduleLists); $k++) {
                        $module_id = $moduleLists[$k];
                        $ModuleData = $this->Model->getSqlData("SELECT * FROM  rm_admin_module_details WHERE module_id='$module_id' ");
                        if (!empty($ModuleData)) {
                            $ModuleList.=$ModuleData[0]['module_name'] . ',';
                        }
                    }

                    $module_id_list = substr($ModuleList, 0, -1);
                } else {
                    $module_id_list = "";
                }
                $upload = $User->upload_date;
                $phpdate = strtotime($upload);
                $upload_date = date('d M Y h:i A', $phpdate);

                $user_id = $User->admin_user_id;
                $Userdata = $this->Model->getSqlData("SELECT * FROM rm_user_login_details WHERE user_id='$user_id'");

                if (!empty($Userdata)) {
                    $user_name = $Userdata[0]['full_name'];
                } else {
                    $user_name = "";
                }
                
                $dataReturn['UserList'][] = array(
                    'user_id' => $User->user_id,
                    'full_name' => $User->full_name,
                    'email' => $User->email,
                    'mobile' => $User->mobile,
                    'module_id_list' => $module_id_list,
                    'status' => $User->status,
                    'upload_date' => $upload_date,
                    'user_name' => $user_name,
                    'number' => $i
                );

                $i++;
            endforeach;
        }

        print_r(json_encode($dataReturn));
    }

    function SaveUser() {
        $project_data['user_id'] = $this->input->post('user_id');
        $project_data['full_name'] = $this->input->post('full_name');
        $project_data['password'] = $this->input->post('password');
        $project_data['email'] = $this->input->post('email');
        $project_data['mobile'] = $this->input->post('mobile');
        $admin_id = $this->input->cookie('admin_id', TRUE);
        $project_data['admin_user_id'] = $admin_id;
        $project_data['user_type_id'] = "2";
        $project_data['module_id_list'] = $this->input->post('module_id_list');        
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $project_data['registration_date'] = date("Y-m-d");         
        $project_data['upload_date'] = date('Y-m-d H:i:s');

        if ($project_data['user_id'] == 0) {
            $insert_id = $this->Admin_model->indert_data('rm_user_login_details', $project_data);

            $return['msg'] = true;
        } else {
            $where = array("user_id" => $project_data['user_id']);
            $insert_id = $this->Admin_model->update_data('rm_user_login_details', $project_data, $where);
            $return['msg'] = false;
        }

        if ($insert_id > 0) {
            $return['status'] = true;
        } else {
            $return['status'] = false;
        }
        echo json_encode($return);
    }

    function ActiveUser() {

        $status = $this->input->post('status');

        if ($status == 1) {
            $newstatus = '0';
        } else {
            $newstatus = '1';
        }
        //$newstatus;
        $project_data['status'] = $newstatus;
        $where = array("user_id" => $this->input->post('user_id'));
        $insert_id = $this->Admin_model->update_data('rm_user_login_details', $project_data, $where);
    }

    function DeleteUser() {
        $dept_data['user_id'] = $this->input->post('user_id');
        $where = array("user_id" => $dept_data['user_id']);
        $delete = $this->Admin_model->row_delete($where, 'rm_user_login_details');
    }

    function EditUser() {
        $user_id = $this->input->post('user_id');
        $Userdata = $this->Admin_model->select_all_data('rm_user_login_details', array("user_id" => $user_id), "user_id", "DESC");
        if (count($Userdata) > 0) {

            foreach ($Userdata as $UserList):

                $dataReturn['UserDet'] = array(
                    'user_id' => $UserList->user_id,
                    'full_name' => $UserList->full_name,
                    'password' => $UserList->password,
                    'email' => $UserList->email,
                    'mobile' => $UserList->mobile ,
                    'module_id_list' => $UserList->module_id_list ,
                  
                    
                );

            endforeach;
        }
         echo json_encode($dataReturn);
    }

    function CheckUserName() {
        $username = $this->input->post('username'); 
        $Emaildata = $this->Model->getData('rm_user_login_details', array('email' => $username));

        if (!empty($Emaildata)) {// 1: Exist; 0:Not Exist
            $status = 1;
        } else {
            $status = 0;
        }
        $data = array('estatus' => $status,
            'username' => $username);
        echo json_encode($data);
    }

    function CheckMobile() {
        $mobile = $this->input->post('mobile'); 
        $Mobiledata = $this->Model->getData('rm_user_login_details', array('mobile' => $mobile));

        if (!empty($Mobiledata)) {// 1: Exist; 0:Not Exist
            $status = 1;
        } else {
            $status = 0;
        }
        $data = array('estatus' => $status,
            'mobile' => $mobile);
        echo json_encode($data);
    }
  function ChangePassword(){
        $data['general'] = "active";
        $data['user'] = "active";
        $data['jsType'] = "2";
        $data['menu_type'] = "1";  
        $data['main_content'] = "admin/user/changepasswod";
        $this->load->view('includes/template_admin', $data);
    }
    
     function CheckUserPassword() {
        $user_id = $this->input->cookie('admin_id', TRUE);
        $old_password = $this->input->post('old_password');
        $Emaildata = $this->Model->getData('rm_user_login_details', array('user_id' => $user_id,'password'=>$old_password));

        if (!empty($Emaildata)) {// 1: Exist; 0:Not Exist
            $status = 1;
        } else {
            $status = 0;
        }
        $data = array('estatus' => $status,
            'username' => $user_id);
        echo json_encode($data);
    }
    
    
    
     function ChangeUserPassword() {
        $user_id = $this->input->cookie('admin_id', TRUE); 
        $new_password = $this->input->post('new_password');
        $project_data['password'] = $new_password;
        $where = array("user_id" => $user_id);
        $insert_id = $this->Admin_model->update_data('rm_user_login_details', $project_data, $where);
         if ($insert_id > 0) {
            $return['status'] = true;
        } else {
            $return['status'] = false;
        }
        echo json_encode($return);
    }
    
     
    function sendVerificationLink($requestData) {
        if (isset($requestData) && !empty($requestData) && is_array($requestData)) {
          
             $from_title = "TriumphApproved India";
            $subject = "Please verify your email";
            $email=$requestData['email'];
            $email_encode=base64_encode($email);
            $final_link= base_url() . "Login/UserVefification/". $email_encode;
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
 <br><br><a href="#LINK#" target="_blank" style="min-height: 2.5rem;
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
text-align: center;font-family:arial"> Verify your email</a> 
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
            $from_email = "cs@triumph.com";
           // $email="shrivaamit@gmail.com";
            $email="ag@triumph.com";
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

}

?>