<?php

class Admin extends CI_controller {

    function __construct() {
        parent::__construct();
        set_time_limit(0);
        $this->no_cache();
        $admin_id = $this->input->cookie('admin_id', TRUE);
        if ($admin_id == '') {
            redirect(base_url() . "Login");
        }
    }

    public $data = array(
        'dir' => array(
            'original' => 'uploads/',
            'thumb' => 'uploads/thumbs/'
        ),
        'total' => 0,
        'images' => array(),
        'error' => ''
    );

    protected function no_cache() {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    function cleanString($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    function ajaxserviceimage() {
        $output_dir = "uploads/";
        if (isset($_FILES["myfile"])) {
            $ret = array();
            $error = $_FILES["myfile"]["error"]; {
                if (!is_array($_FILES["myfile"]['name'])) { //single file
                    list($txt, $ext) = explode(".", $_FILES["myfile"]['name']);
                    $fileName = time() . $this->cleanString($txt) . "." . $ext;

                    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)) {
                        $ret['name'] = $fileName;
                        $ret['path'] = base_url() . $output_dir . $fileName;
                        $ret['type'] = "SERVICE_IMG";
                        //inserting into table
                        $imageId = $this->Model->insertData('rm_image_details', $ret);
                        // create thumbnail
                        $new_image = $this->data['dir']['thumb'] . 'thumb_' . $fileName;

                        $c_img_lib = array(
                            'image_library' => 'gd2',
                            'source_image' => $output_dir . $fileName,
                            'maintain_ratio' => FALSE,
                            'width' => 110,
                            'height' => 95,
                            'new_image' => $new_image
                        );

                        $this->load->library('image_lib');
                        $this->image_lib->initialize($c_img_lib);
                        $this->image_lib->resize();
                        if ($imageId > 0) {
                            $ret['fileId'] = $imageId;
                        }
                    } else {
                        $ret['error'] = $_FILES["myfile"]["error"];
                    }
                } else {
                    $fileCount = count($_FILES["myfile"]['name']);
                    for ($i = 0; $i < $fileCount; $i++) {
                        list($txt, $ext) = explode(".", $_FILES["myfile"]['name']);
                        $fileName = time() . $this->cleanString($txt) . "." . $ext;

                        /* $_FILES["myfile"]['name'] = time().$this->cleanString($_FILES["myfile"]['name']);
                          $fileName = $_FILES["myfile"]["name"][$i]; */

                        if (move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName)) {
                            $ret['name'] = $fileName;
                            $ret['path'] = base_url() . $output_dir . $fileName;
                            $ret['type'] = "SERVICE_IMG";
                            //inserting into table
                            $imageId = $this->Model->insertData('md_image_details', $ret);
                            if ($imageId > 0) {
                                $ret['fileId'] = $imageId;
                            }
                        } else {
                            $ret['error'] = $_FILES["myfile"]["error"];
                        }
                    }
                }
            }
            echo json_encode($ret);
        }
    }
    
    
      function ajaxwebpimage() {
        $output_dir = "uploads/webp/";
        if (isset($_FILES["myfile"])) {
            $ret = array();
            $error = $_FILES["myfile"]["error"]; {
                if (!is_array($_FILES["myfile"]['name'])) { //single file
                    list($txt, $ext) = explode(".", $_FILES["myfile"]['name']);
                    $fileName = time() . $this->cleanString($txt) . "." . $ext;

                    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)) {
                        $ret['name'] = $fileName;
                        $ret['path'] = base_url() . $output_dir . $fileName;
                        $ret['type'] = "SERVICE_IMG";
                        //inserting into table
                        $imageId = $this->Model->insertData('rm_image_details', $ret);
                        // create thumbnail
                        $new_image = $this->data['dir']['thumb'] . 'thumb_' . $fileName;

                        $c_img_lib = array(
                            'image_library' => 'gd2',
                            'source_image' => $output_dir . $fileName,
                            'maintain_ratio' => FALSE,
                            'width' => 110,
                            'height' => 95,
                            'new_image' => $new_image
                        );

                        $this->load->library('image_lib');
                        $this->image_lib->initialize($c_img_lib);
                        $this->image_lib->resize();
                        if ($imageId > 0) {
                            $ret['fileId'] = $imageId;
                        }
                    } else {
                        $ret['error'] = $_FILES["myfile"]["error"];
                    }
                } else {
                    $fileCount = count($_FILES["myfile"]['name']);
                    for ($i = 0; $i < $fileCount; $i++) {
                        list($txt, $ext) = explode(".", $_FILES["myfile"]['name']);
                        $fileName = time() . $this->cleanString($txt) . "." . $ext;

                        /* $_FILES["myfile"]['name'] = time().$this->cleanString($_FILES["myfile"]['name']);
                          $fileName = $_FILES["myfile"]["name"][$i]; */

                        if (move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName)) {
                            $ret['name'] = $fileName;
                            $ret['path'] = base_url() . $output_dir . $fileName;
                            $ret['type'] = "SERVICE_IMG";
                            //inserting into table
                            $imageId = $this->Model->insertData('md_image_details', $ret);
                            if ($imageId > 0) {
                                $ret['fileId'] = $imageId;
                            }
                        } else {
                            $ret['error'] = $_FILES["myfile"]["error"];
                        }
                    }
                }
            }
            echo json_encode($ret);
        }
    }
    
    
         function ajaxjpg2image() {
        $output_dir = "uploads/jpeg_2000/";
        if (isset($_FILES["myfile"])) {
            $ret = array();
            $error = $_FILES["myfile"]["error"]; {
                if (!is_array($_FILES["myfile"]['name'])) { //single file
                    list($txt, $ext) = explode(".", $_FILES["myfile"]['name']);
                    $fileName = time() . $this->cleanString($txt) . "." . $ext;

                    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)) {
                        $ret['name'] = $fileName;
                        $ret['path'] = base_url() . $output_dir . $fileName;
                        $ret['type'] = "SERVICE_IMG";
                        //inserting into table
                        $imageId = $this->Model->insertData('rm_image_details', $ret);
                        // create thumbnail
                        $new_image = $this->data['dir']['thumb'] . 'thumb_' . $fileName;

                        $c_img_lib = array(
                            'image_library' => 'gd2',
                            'source_image' => $output_dir . $fileName,
                            'maintain_ratio' => FALSE,
                            'width' => 110,
                            'height' => 95,
                            'new_image' => $new_image
                        );

                        $this->load->library('image_lib');
                        $this->image_lib->initialize($c_img_lib);
                        $this->image_lib->resize();
                        if ($imageId > 0) {
                            $ret['fileId'] = $imageId;
                        }
                    } else {
                        $ret['error'] = $_FILES["myfile"]["error"];
                    }
                } else {
                    $fileCount = count($_FILES["myfile"]['name']);
                    for ($i = 0; $i < $fileCount; $i++) {
                        list($txt, $ext) = explode(".", $_FILES["myfile"]['name']);
                        $fileName = time() . $this->cleanString($txt) . "." . $ext;

                        /* $_FILES["myfile"]['name'] = time().$this->cleanString($_FILES["myfile"]['name']);
                          $fileName = $_FILES["myfile"]["name"][$i]; */

                        if (move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName)) {
                            $ret['name'] = $fileName;
                            $ret['path'] = base_url() . $output_dir . $fileName;
                            $ret['type'] = "SERVICE_IMG";
                            //inserting into table
                            $imageId = $this->Model->insertData('md_image_details', $ret);
                            if ($imageId > 0) {
                                $ret['fileId'] = $imageId;
                            }
                        } else {
                            $ret['error'] = $_FILES["myfile"]["error"];
                        }
                    }
                }
            }
            echo json_encode($ret);
        }
    }
    
       function ajaxjpgimage() {
        $output_dir = "uploads/jpg/";
        if (isset($_FILES["myfile"])) {
            $ret = array();
            $error = $_FILES["myfile"]["error"]; {
                if (!is_array($_FILES["myfile"]['name'])) { //single file
                    list($txt, $ext) = explode(".", $_FILES["myfile"]['name']);
                    $fileName = time() . $this->cleanString($txt) . "." . $ext;

                    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)) {
                        $ret['name'] = $fileName;
                        $ret['path'] = base_url() . $output_dir . $fileName;
                        $ret['type'] = "SERVICE_IMG";
                        //inserting into table
                        $imageId = $this->Model->insertData('rm_image_details', $ret);
                        // create thumbnail
                        $new_image = $this->data['dir']['thumb'] . 'thumb_' . $fileName;

                        $c_img_lib = array(
                            'image_library' => 'gd2',
                            'source_image' => $output_dir . $fileName,
                            'maintain_ratio' => FALSE,
                            'width' => 110,
                            'height' => 95,
                            'new_image' => $new_image
                        );

                        $this->load->library('image_lib');
                        $this->image_lib->initialize($c_img_lib);
                        $this->image_lib->resize();
                        if ($imageId > 0) {
                            $ret['fileId'] = $imageId;
                        }
                    } else {
                        $ret['error'] = $_FILES["myfile"]["error"];
                    }
                } else {
                    $fileCount = count($_FILES["myfile"]['name']);
                    for ($i = 0; $i < $fileCount; $i++) {
                        list($txt, $ext) = explode(".", $_FILES["myfile"]['name']);
                        $fileName = time() . $this->cleanString($txt) . "." . $ext;

                        /* $_FILES["myfile"]['name'] = time().$this->cleanString($_FILES["myfile"]['name']);
                          $fileName = $_FILES["myfile"]["name"][$i]; */

                        if (move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName)) {
                            $ret['name'] = $fileName;
                            $ret['path'] = base_url() . $output_dir . $fileName;
                            $ret['type'] = "SERVICE_IMG";
                            //inserting into table
                            $imageId = $this->Model->insertData('md_image_details', $ret);
                            if ($imageId > 0) {
                                $ret['fileId'] = $imageId;
                            }
                        } else {
                            $ret['error'] = $_FILES["myfile"]["error"];
                        }
                    }
                }
            }
            echo json_encode($ret);
        }
    }

    function getImageDetails() {
        $imageId = $this->input->post('imageId');
        $imageType = $this->input->post('type');

        if ($imageId > 0 && $imageType != "") {
            $ImageData = $this->model->getData('md_image_details', array('image_id' => $imageId));
            echo $ImageData[0]['path'];
        }
    }

 

    function Contact() {
        $data['portal'] = "active";
        $data['cont'] = "active";
        $data['jsType'] = "4";
        $data['main_content'] = "admin/user/contactList";
        $this->load->view('includes/template_admin', $data);
    }

    function loadContactListing() {

        $contact_data = $this->Admin_model->select_all_data('rm_portal_contact_details', array("rstatus=" => "1"), "contact_id", "DESC");

        if (count($contact_data) > 0) {
            $dataReturn['status'] = true;
            $i = 1;
            foreach ($contact_data as $contactList):
                $upload = $contactList->upload_date;
                $course_id=$contactList->courses_id;
                $CourseDetails = $this->Model->getSqlData("SELECT * FROM  rm_admin_category_course_details WHERE course_id='$course_id' ");
                if (!empty($CourseDetails)) {
                    $course_name = $CourseDetails[0]['course_name'];
                } else {
                    
                   $course_name="NA";
                }
                $phpdate = strtotime($upload);
                $upload_date = date('l d M Y', $phpdate);
                $dataReturn['ConatctList'][] = array(
                    'contact_id' => $contactList->contact_id,
                    'subject' => $contactList->subject,
                    'full_name' => $contactList->full_name,
                    'message' => $contactList->message,
                    'course_id'=>$contactList->courses_id,
                    'course_name'=>$course_name,
                    'email' => $contactList->email,
                    'mobile' => $contactList->mobile,
                    'status' => $contactList->status,
                    'upload_date' => $upload_date,
                    'number' => $i
                );
                $i++;
            endforeach;
        } else {
            $dataReturn['status'] = FALSE;
        }

        print_r(json_encode($dataReturn));
    }

    function DeleteContacts() {
        $dept_data['contact_id'] = $this->input->post('contact_id');
        $where = array("contact_id" => $dept_data['contact_id']);
        echo $delete = $this->Admin_model->row_delete($where, 'rm_portal_contact_details');
    }

        function ContactExcel() {
        $data['ContactList'] = $this->Model->getSqlData("SELECT * FROM rm_portal_contact_details where status='1' ");
        $data['main_content'] = "admin/user/excel/contactList-Excel_view";
        $this->load->view('includes/template_login', $data);
    }
    // Webinar

    function Webinars() {
        $data['portal'] = "active";
        $data['web'] = "active";
        $data['jsType'] = "4";
        $data['main_content'] = "admin/user/webinarList";
        $this->load->view('includes/template_admin', $data);
    }

    function loadWebinarListing() {

        $contact_data = $this->Admin_model->select_all_data('rm_portal_webinar_details', array("rstatus=" => "1"), "webinar_id", "DESC");

        if (count($contact_data) > 0) {
            $dataReturn['status'] = true;
            $i = 1;
            foreach ($contact_data as $contactList):
                $upload = $contactList->upload_date;
                $course_id=$contactList->courses_id;
                $CourseDetails = $this->Model->getSqlData("SELECT * FROM  rm_admin_category_course_details WHERE course_id='$course_id' ");
                if (!empty($CourseDetails)) {
                    $course_name = $CourseDetails[0]['course_name'];
                } else {
                    
                   $course_name="NA";
                }
                $phpdate = strtotime($upload);
                $upload_date = date('l d M Y', $phpdate);
                $dataReturn['ConatctList'][] = array(
                    'webinar_id' => $contactList->webinar_id,
                    'full_name' => $contactList->full_name,
                    'course_id'=>$contactList->courses_id,
                    'course_name'=>$course_name,
                    'email' => $contactList->email,
                    'mobile' => $contactList->mobile,
                    'status' => $contactList->status,
                    'upload_date' => $upload_date,
                    'number' => $i
                );
                $i++;
            endforeach;
        } else {
            $dataReturn['status'] = FALSE;
        }

        print_r(json_encode($dataReturn));
    }

    function DeleteWebinars() {
        $dept_data['webinar_id'] = $this->input->post('webinar_id');
        $where = array("webinar_id" => $dept_data['webinar_id']);
        echo $delete = $this->Admin_model->row_delete($where, 'rm_portal_webinar_details');
    }

    function WebinarExcel() {
        $data['ContactList'] = $this->Model->getSqlData("SELECT * FROM rm_portal_webinar_details where status='1' ");
        $data['main_content'] = "admin/user/excel/webinarList-Excel_view";
        $this->load->view('includes/template_login', $data);
    }
    
    function User() {
        $data['jsType'] = "4";
        $data['portal'] = "active";
        $data['puser'] = "active";
         $data['menu_type'] = "0";
        $data['main_content'] = "admin/user/userList";
        $this->load->view('includes/template_admin', $data);
    }
    function UserExcel() {
        $data['ContactList'] = $this->Model->getSqlData("SELECT * FROM rm_portal_user_login_details where status='1' ");
        $data['main_content'] = "admin/user/excel/userList-Excel_view";
        $this->load->view('includes/template_login', $data);
    }
    
   /// Payment
    


    function Payment() {
        $data['portal'] = "active";
        $data['pay'] = "active";
        $data['jsType'] = "4";
        $data['main_content'] = "admin/user/paymentList";
        $this->load->view('includes/template_admin', $data);
    }

    function loadPaymentListing() {

        $contact_data = $this->Admin_model->select_all_data('rm_user_payment_details', array("rstatus=" => "1"), "payment_id", "DESC");

        if (count($contact_data) > 0) {
            $dataReturn['status'] = true;
            $i = 1;
            foreach ($contact_data as $contactList):
                $upload = $contactList->upload_date;
                $course_id=$contactList->course_id;
                $CourseDetails = $this->Model->getSqlData("SELECT * FROM  rm_admin_category_course_details WHERE course_id='$course_id' ");
                if (!empty($CourseDetails)) {
                    $course_name = $CourseDetails[0]['course_name'];
                } else {
                    
                   $course_name="NA";
                }
                $user_id=$contactList->user_id;
                $UserDetails = $this->Model->getSqlData("SELECT * FROM  rm_portal_user_login_details WHERE user_id='$user_id' ");
                if (!empty($UserDetails)) {
                    $full_name = $UserDetails[0]['full_name'];
                     $email = $UserDetails[0]['email'];
                     $mobile = $UserDetails[0]['mobile'];
                } else {
                    
                   $full_name="NA";
                   $email="NA";
                   $mobile="NA";
                }
                $phpdate = strtotime($upload);
                $upload_date = date('l d M Y', $phpdate);
                $dataReturn['ConatctList'][] = array(
                    'payment_id' => $contactList->payment_id,
                    'short_description' => $contactList->short_description,
                    'payment_date' => $contactList->payment_date,
                    'payment_mode' => $contactList->payment_mode,
                    'amount' => $contactList->amount,
                    'course_id'=>$contactList->course_id,
                    'course_name'=>$course_name,
                    'full_name'=>$full_name,
                    'email'=>$email,
                    'mobile'=>$mobile,
                    'status' => $contactList->status,
                    'upload_date' => $upload_date,
                    'number' => $i
                );
                $i++;
            endforeach;
        } else {
            $dataReturn['status'] = FALSE;
        }

        print_r(json_encode($dataReturn));
    }

    function DeletePayments() {
        $dept_data['payment_id'] = $this->input->post('payment_id');
        $where = array("payment_id" => $dept_data['payment_id']);
        echo $delete = $this->Admin_model->row_delete($where, 'rm_user_payment_details');
    }


    
      
}

?>