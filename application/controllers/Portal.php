<?php
require_once APPPATH . 'controllers/Api.php';

Class Portal extends Api {

      function __construct() {
        parent::__construct();
        set_time_limit(0);
        $this->no_cache();
//        $user_id = $this->input->cookie('user_id', TRUE);
//        if ($user_id == '') {
//            redirect(base_url() . "Trainee");
//        }
    }
 protected function no_cache() {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

      function index() {
       $data['CategoryList'] = $this->Model->getSqlData("SELECT * FROM rm_admin_category_details WHERE status='1' ");
        $data['main_content'] = "portal/home";
        $this->load->view('includes/template', $data);
    }
    
     function About() {
        $data['jsType'] = "1";
        $data['portal'] = "active";
        $data['puser'] = "active";
         $data['menu_type'] = "0";
        $data['main_content'] = "portal/about";
        $this->load->view('includes/template', $data);
    }
    
      function Contact() {
       $data['CourseList'] = $this->Model->getSqlData("SELECT * FROM rm_admin_category_course_details WHERE status='1' ");
      
        $data['main_content'] = "portal/contact";
        $this->load->view('includes/template', $data);
    }
    
      function Login() {
        $data['jsType'] = "1";
        $data['portal'] = "active";
        $data['puser'] = "active";
         $data['menu_type'] = "0";
        $data['main_content'] = "portal/login";
        $this->load->view('includes/template', $data);
    }
      function Register() {
        $data['jsType'] = "1";
        $data['portal'] = "active";
        $data['puser'] = "active";
        $data['menu_type'] = "0";
        $data['main_content'] = "portal/signup";
        $this->load->view('includes/template', $data);
    }
    
     function Webinar() {
        $data['CourseList'] = $this->Model->getSqlData("SELECT * FROM rm_admin_category_course_details WHERE status='1' ");
        $data['main_content'] = "portal/webinar";
        $this->load->view('includes/template', $data);
    }
    
       function Event() {
        $data['jsType'] = "1";
        $data['portal'] = "active";
        $data['puser'] = "active";
         $data['menu_type'] = "0";
        $data['main_content'] = "portal/event";
        $this->load->view('includes/template', $data);
    }
    
    function Course($category_id) {
        $data['jsType'] = "1";
        $data['portal'] = "active";
        $data['puser'] = "active";
        $data['CouseList'] = $this->Model->getSqlData("SELECT * FROM rm_admin_category_course_details WHERE status='1' AND category_id='$category_id'");
         $data['menu_type'] = "0";
        $data['main_content'] = "portal/course";
        $this->load->view('includes/template', $data);
    }
    
     function Topic($course_id) {
 
        $data['lession_no'] = 1;
        $data['TopicList'] = $this->Model->getSqlData("SELECT * FROM rm_admin_course_topic_details WHERE status='1' AND course_id='$course_id'");
        $data['menu_type'] = "0";
        $data['main_content'] = "portal/topic";
        $this->load->view('includes/template', $data);
    }
    
      function ValidateNextLession(){
        $course_id = $this->input->post('course_id');
        $lession_no = $this->input->post('lession_no');
        $data['lession_no'] = $lession_no+1;
        $data['TopicList'] = $this->Model->getSqlData("SELECT * FROM rm_admin_course_topic_details WHERE status='1' AND course_id='$course_id'");
        $data['menu_type'] = "0";
        $data['main_content'] = "portal/topic";
        $this->load->view('includes/template', $data);
      }
      
         function ValidatePreLession(){
        $course_id = $this->input->post('course_id');
        $lession_no = $this->input->post('lession_no');
        $data['lession_no'] = $lession_no-1;
        $data['TopicList'] = $this->Model->getSqlData("SELECT * FROM rm_admin_course_topic_details WHERE status='1' AND course_id='$course_id'");
        $data['menu_type'] = "0";
        $data['main_content'] = "portal/topic";
        $this->load->view('includes/template', $data);
      }
  
    
    function AddUser() {

        $data['jsType'] = "4";
        $data['user'] = "active";
        $data['main_content'] = "admin/user/user";
        $this->load->view('includes/template_admin', $data);
    }

    function loadUserData() {       
       
        $category_section_data = $this->Admin_model->select_all_data('rm_admin_category_details', array("status" => "1"), "category_name", "ASC ");
       if (count($category_section_data) > 0) {
            $dataReturn['status'] = true;
            foreach ($category_section_data as $categorySectionList):
                $dataReturn['CategoryList'][] = array(
                    'category_id' => $categorySectionList->category_id,
                    'category_name' => $categorySectionList->category_name,                                        
                );
            endforeach;
        }
        
        $Userdata = $this->Admin_model->getAllDataquery("SELECT * FROM rm_portal_user_login_details  ORDER BY user_id ASC");

        if (count($Userdata) > 0) {
            $dataReturn['status'] = true;
            $i = 1;
            foreach ($Userdata as $User):
                
                $upload = $User->upload_date;
                $phpdate = strtotime($upload);
                $upload_date = date('d M Y h:i A', $phpdate);

                               
                $store_image_id_list = $User->profile_pic_id;
                $store_image_id_lists = explode(',', $store_image_id_list);
                $store_image_id = $store_image_id_lists[0];
                $Imagedata = $this->Model->getSqlData("SELECT * FROM rm_image_details WHERE image_id='$store_image_id'");

                if (!empty($Imagedata)) {
                    $image_name = $Imagedata[0]['name'];

                    $baner_image_path = base_url() . "uploads/" . $image_name;
                } else {
                    
                    $baner_image_path =  "default_avatar.png";
                }
                $dataReturn['UserList'][] = array(
                    'user_id' => $User->user_id,
                    'full_name' => $User->full_name,
                    'email' => $User->email,
                    'mobile' => $User->mobile,                  
                    'status' => $User->status,
                    'image_name' => $baner_image_path,  
                    'upload_date' => $upload_date,
                                        'number' => $i
                );

                $i++;
            endforeach;
        }

        print_r(json_encode($dataReturn));
    }

    function SaveUserPayemnt() {
        $project_data['user_id'] = $this->input->post('user_id');
        $project_data['category_id'] = $this->input->post('category_id');
        $project_data['course_id'] = $this->input->post('course_id');
        $project_data['amount'] = $this->input->post('amount');
        $project_data['payment_mode'] = "0";
        $project_data['short_description'] = $this->input->post('short_description');
        $payment_date = date('Y-m-d');
        $ip = $this->input->ip_address();
        $project_data['payment_date'] = $payment_date;
        $project_data['ip'] = $ip;
        $project_data['upload_date'] = date('Y-m-d H:i:s');

        if ($project_data['user_id'] != 0) {
            $insert_id = $this->Admin_model->indert_data('rm_user_payment_details', $project_data);

            $return['msg'] = true;
        } 
        if ($insert_id > 0) {
            $return['status'] = true;
        } else {    $return['status'] = false;
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
        $insert_id = $this->Admin_model->update_data('rm_portal_user_login_details', $project_data, $where);
    }

    function DeleteUser() {
        $dept_data['user_id'] = $this->input->post('user_id');
        $where = array("user_id" => $dept_data['user_id']);
        $delete = $this->Admin_model->row_delete($where, 'rm_portal_user_login_details');
    }

    function EditUser() {
        $user_id = $this->input->post('user_id');
        $Userdata = $this->Admin_model->select_all_data('rm_portal_user_login_details', array("user_id" => $user_id), "user_id", "DESC");
        if (count($Userdata) > 0) {

            foreach ($Userdata as $UserList):

                $dataReturn['UserDet'] = array(
                    'user_id' => $UserList->user_id,
                    'full_name' => $UserList->full_name,
                    'email' => $UserList->email,
                    'mobile' => $UserList->mobile
                );

            endforeach;
        }
        
       
         echo json_encode($dataReturn);
    }
    
     function ProfileImage() {
        $user_id = $this->input->post('user_id');
        $Categroydata = $this->Model->getSqlData("SELECT * FROM rm_portal_trainee_details WHERE user_id='$user_id'");
        $primary_store_image_id_list = $Categroydata[0]['image_id'];
        $primary_store_image_id_lists = explode(',', $primary_store_image_id_list);
        for ($j = 0; $j < count($primary_store_image_id_lists); $j++) {
            $image_id = $primary_store_image_id_lists[$j];
            $Imagesdata = $this->Model->getSqlData("SELECT * FROM rm_image_details WHERE image_id='$image_id'");
            if (count($Imagesdata) > 0) {
                if (!empty($Imagesdata)) {
                    $hotel_image_name = $Imagesdata[0]['name'];
                    $image_path = base_url() . "uploads/" . $hotel_image_name;
                } else {
                    $image_path = "";
                }

                $dataReturn['ImageDet'][] = array(
                    'image_name' => $image_path,
                    'image_id' => $image_id,
                );
            }
        }

        print_r(json_encode($dataReturn));
    }

   
    
    function TrackCode() {
        $Caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $QuantidadeCaracteres = strlen($Caracteres);
        $QuantidadeCaracteres--;
        $Hash = NULL;
        for ($x = 1; $x <= 6; $x++) {
            $Posicao = rand(0, $QuantidadeCaracteres);
            $Hash .= substr($Caracteres, $Posicao, 1);
        }
        return $Hash;
    }
    
        function AddExternalSignup() {
        $jsonObj = $this->input->post('jsonObj'); //$_POST['jsonObj'];
        $requestData = json_decode($jsonObj, true);

        if (isset($requestData['full_name']) && $requestData['full_name'] != "") {            //Insert Data

             date_default_timezone_set("Asia/Kolkata");    //India time (GMT+5:30)
            $upload_date = date('Y-m-d H:i:s');
            $registration_date = date('Y-m-d');
            $ip = $this->input->ip_address();
            $email=$requestData['email'];
            $additionValue = array("upload_date" => $upload_date, "ip" => $ip, "registration_date" => $registration_date);
            $finalRequestData = array_merge($requestData, $additionValue);
             $onlyUserCheck = $this->Model->getSqlData("SELECT * FROM rm_portal_user_login_details WHERE email='$email'   ");
        if(!empty($onlyUserCheck)){
          $accountDetailsId=$onlyUserCheck[0]['user_id'];
                  
        } else {
           $accountDetailsId = $this->Model->insertData('rm_portal_user_login_details', $finalRequestData);           
            
            
            setcookie('user_id', $accountDetailsId, time() + ( 15 * 60), "/");
            setcookie('full_name', $requestData['full_name'], time() + ( 15 * 60), "/");
            //$this->SendRegistrationMail($finalRequestData); 
            //$this->EmailVerificationLink($requestData);
            $data['success'] = 1;
        }
        
        
        } else {
            $data['success'] = 0;
        }

        echo json_encode($data);
    }
    
      public function CheckExternalLogin() {
        $this->load->helper('cookie');
        $jsonObj = $this->input->post('jsonObj'); //$_POST['jsonObj'];
        $requestData = json_decode($jsonObj, true);
        $array['email'] = $requestData['user_email'];
        $array['password'] = $requestData['user_password'];
        $array['status'] = "1";

        $data_exist = $this->Admin_model->check_data('rm_portal_user_login_details', $array);
        if (!empty($data_exist)) {
            $data['status'] = true;
             $requestData = array("user_id" => $data_exist->user_id);
            // $this->AddExternalLog($requestData);
            setcookie('user_id', $data_exist->user_id, time() + ((86400) * 30 * 60), "/");
            setcookie('full_name', $data_exist->full_name, time() + ((86400) * 30 * 60), "/");
        } else {
            $data['status'] = false;
        }
        //$data['email']=$email;
        echo json_encode($data);
    }
    
     public function logout() {
        $this->load->helper('cookie');
        setcookie('user_id', '', time() + ((86400) * 30 * 60), "/");
        setcookie('full_name', '', time() + ((86400) * 30 * 60), "/");
        redirect(base_url());
    }
    
    // Portal 
    
      
    
      function AddWebniar() {
        $jsonObj = $this->input->post('jsonObj'); //$_POST['jsonObj'];
        $requestData = json_decode($jsonObj, true);
        if (isset($requestData['full_name']) && $requestData['full_name'] != "") {            //Insert Data
            date_default_timezone_set("Asia/Kolkata");    //India time (GMT+5:30)
            $upload_date = date('Y-m-d H:i:s');
            $registration_date = date('Y-m-d');
            $ip = $this->input->ip_address();
            $email=$requestData['email'];
            $additionValue = array("upload_date" => $upload_date, "ip" => $ip, "registration_date" => $registration_date);
            $finalRequestData = array_merge($requestData, $additionValue);
             $onlyUserCheck = $this->Model->getSqlData("SELECT * FROM rm_portal_webinar_details WHERE email='$email'   ");
        if(!empty($onlyUserCheck)){
          $accountDetailsId=$onlyUserCheck[0]['user_id'];
                  
        } else {
           $accountDetailsId = $this->Model->insertData('rm_portal_webinar_details', $finalRequestData);           
            //$this->SendRegistrationMail($finalRequestData); 
            //$this->EmailVerificationLink($requestData);
            $data['success'] = 1;
        }
        
        
        } else {
            $data['success'] = 0;
        }

        echo json_encode($data);
    }
    
      function Privacy() {       
        $data['main_content'] = "portal/privacy";
        $this->load->view('includes/template', $data);
    }
    
    function Terms() {       
        $data['main_content'] = "portal/terms";
        $this->load->view('includes/template', $data);
    }
     function Refund() {
       
        $data['main_content'] = "portal/refund";
        $this->load->view('includes/template', $data);
    }
    
    
        function AddContact() {
        $jsonObj = $this->input->post('jsonObj'); //$_POST['jsonObj'];
        $requestData = json_decode($jsonObj, true);
        if (isset($requestData['full_name']) && $requestData['full_name'] != "") {            //Insert Data
            date_default_timezone_set("Asia/Kolkata");    //India time (GMT+5:30)
            $upload_date = date('Y-m-d H:i:s');
            $registration_date = date('Y-m-d');
            $ip = $this->input->ip_address();
            $email=$requestData['email'];
            $additionValue = array("upload_date" => $upload_date, "ip" => $ip, "registration_date" => $registration_date);
            $finalRequestData = array_merge($requestData, $additionValue);
            $onlyUserCheck = $this->Model->getSqlData("SELECT * FROM rm_portal_contact_details WHERE email='$email'   ");
            $accountDetailsId = $this->Model->insertData('rm_portal_contact_details', $finalRequestData);           
            //$this->SendRegistrationMail($finalRequestData); 
            //$this->EmailVerificationLink($requestData);
            $data['success'] = 1;
        
        
        
        } else {
            $data['success'] = 0;
        }

        echo json_encode($data);
    }
    
    function PaymentCheck(){
        $user_id = $this->input->cookie('user_id', TRUE);
        
        if($user_id==''){
             redirect(base_url() . "Login");
        }
        else {
              redirect(base_url() . "payment-pending");
        }
    }
    function PaymentPending()
    {
          $data['main_content'] = "portal/paymentPending";
        $this->load->view('includes/template', $data); 
    }
    
       function ChangePassword() {
        $data['main_content'] = "portal/changepassword";
        $this->load->view('includes/template', $data);
    }
    
    
     function CheckChangePassword() {
        $jsonObj = $this->input->post('jsonObj'); //$_POST['jsonObj'];
        $user_id = $this->input->cookie('user_id', TRUE);
        $requestData = json_decode($jsonObj, true);
        if (isset($requestData['new_password']) && $requestData['new_password'] != "" && $user_id!='') {            //Insert Data
            date_default_timezone_set("Asia/Kolkata");    //India time (GMT+5:30)
            $where = array("user_id" => $user_id);
            $onlyUserCheck = $this->Model->getSqlData("SELECT * FROM rm_portal_user_login_details WHERE user_id='$user_id'   ");
            if(!empty($onlyUserCheck)){
            $project_data['email']=$onlyUserCheck[0]['email'];
            }
            $project_data['password'] =$requestData['new_password'];
            $insert_id = $this->Admin_model->update_data('rm_portal_user_login_details', $project_data, $where);
             $this->sendChangePassword($project_data); 
            $data['success'] = 1;
        
        } else {
            $data['success'] = 0;
        }

        echo json_encode($data);
    }
    
       function ForgotPassword() {
        $data['main_content'] = "portal/forgot";
        $this->load->view('includes/template', $data);
    }
    
    
    function CheckForgotPassword() {
        $jsonObj = $this->input->post('jsonObj'); //$_POST['jsonObj'];
        $user_id = $this->input->cookie('user_id', TRUE);
        $requestData = json_decode($jsonObj, true);
        $email=$requestData['user_email'];
        $onlyUserCheck = $this->Model->getSqlData("SELECT * FROM rm_portal_user_login_details WHERE email='$email'   ");
        if(empty($onlyUserCheck)){
          $data['success'] = 0;       
        } else {
           
        
        if (isset($requestData['user_email']) && $requestData['user_email'] != "") {            //Insert Data
            date_default_timezone_set("Asia/Kolkata");    //India time (GMT+5:30)
            $where = array("user_id" => $user_id);
            $project_data['password'] = $this->TrackCode();
            $project_data['email']=$email;
            $insert_id = $this->Admin_model->update_data('rm_portal_user_login_details', $project_data, $where);
             $this->sendChangePassword($project_data); 
            $data['success'] = 1;
        
        } else {
            $data['success'] = 0;
        }
        }
        echo json_encode($data);
    }
}

?>