<?php

class Course extends CI_controller {

    function __construct() {
        parent::__construct();
        set_time_limit(0);
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

    
    
    // Courses
    
    
    function Index() {
        $data['menu_type'] = "1";
        $data['mcategory'] = "active";
        $data['mcourse'] = "active";
        $data['jsType'] = "4";
        $data['main_content'] = "admin/category/courseList";
        $this->load->view('includes/template_admin', $data);
    }

    function AddCourse() {  
          $data['menu_type'] = "1";
        $data['mcourse'] = "active";
        $data['mcategory'] = "active";
        $data['jsType'] = "4";
        $data['main_content'] = "admin/category/course";
        $this->load->view('includes/template_admin', $data);
    }
    
     
    function CourseListing() {
        
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

        $Course_data = $this->Admin_model->select_all_data('rm_admin_category_course_details', array("rstatus=" => "1"), "course_name", "ASC");

        if (count($Course_data) > 0) {
            $dataReturn['status'] = true;
            $i = 1;
            foreach ($Course_data as $CourseList):
               
                $upload = $CourseList->upload_date;
                $phpdate = strtotime($upload);
                $upload_date = date('d M Y h:i A', $phpdate);

                $user_id = $CourseList->user_id;
                $Userdata = $this->Model->getSqlData("SELECT * FROM rm_user_login_details WHERE user_id='$user_id'");

                if (!empty($Userdata)) {
                    $user_name = $Userdata[0]['full_name'];
                } else {
                    $user_name = "";
                }
              
               $category_id = $CourseList->category_id;
                $Categorydata = $this->Model->getSqlData("SELECT * FROM rm_admin_category_details WHERE category_id='$category_id'");

                if (!empty($Categorydata)) {
                    $category_name = $Categorydata[0]['category_name'];
                } else {
                    $category_name= "";
                }
                $store_image_id_list = $CourseList->jpg_image_id;
                $store_image_id_lists = explode(',', $store_image_id_list);
                $store_image_id = $store_image_id_lists[0];
                $Imagedata = $this->Model->getSqlData("SELECT * FROM rm_image_details WHERE image_id='$store_image_id'");

                if (!empty($Imagedata)) {
                    $image_name = $Imagedata[0]['name'];

                    $baner_image_path = base_url() . "uploads/" . $image_name;
                } else {
                    $image_name = "default_avatar.png";
                    $baner_image_path = base_url() . "uploads/" . $image_name;
                }
               
                $dataReturn['data'][] = array(
                    'course_id' => $CourseList->course_id,
                    'course_name' => $CourseList->course_name,
                    'category_id' => $CourseList->category_id,
                    'category_name' => $category_name,
                    'short_description' => $CourseList->short_description,  
                    'course_duration' => $CourseList->course_duration,  
                    'course_duration_remarks' => $CourseList->course_duration_remarks,
                    'zoom_duration' => $CourseList->zoom_duration,
                    'zoom_schedule'=>$CourseList->zoom_schedule,
                    'mentor_id' => $CourseList->mentor_id,
                    'course_mode' => $CourseList->course_mode,
                    'course_fee' => $CourseList->course_fee,
                    'course_type' => $CourseList->course_type,
                    'status' => $CourseList->status,
                     'image_name' => $baner_image_path,    
                    'upload_date' => $upload_date,
                    'user_name' => $user_name,
                    
                    'number' => $i
                );
                $i++;
            endforeach;
        } else {
            $dataReturn['status'] = FALSE;
        }

        print_r(json_encode($dataReturn));
    }

    function SaveCourse() {
        $admin_id = $this->input->cookie('admin_id', TRUE);
        $project_data['course_id'] = $this->input->post('course_id');
        $project_data['course_name'] = $this->input->post('course_name');
        $project_data['category_id'] = $this->input->post('category_id');
        $project_data['short_description'] = $this->input->post('short_description');
        $project_data['course_duration'] = $this->input->post('course_duration');
        $project_data['course_duration_remarks'] = $this->input->post('course_duration_remarks');
        $project_data['zoom_duration'] = $this->input->post('zoom_duration');
        $project_data['zoom_schedule'] = $this->input->post('zoom_schedule');
        
        $project_data['mentor_id'] = $this->input->post('mentor_id');
        $project_data['course_mode'] = $this->input->post('course_mode');
        $project_data['course_type'] = $this->input->post('course_type');
        $project_data['course_fee'] = $this->input->post('course_fee');
        $project_data['jpg_image_id'] = $this->input->post('jpg_image_id');
       
        $project_data['ip'] = $this->input->ip_address();
        $project_data['rstatus'] = "1";
        date_default_timezone_set("Asia/Kolkata");    //India time (GMT+5:30)
        $project_data['upload_date'] = date('Y-m-d H:i:s');
        
        if ($project_data['course_id'] == 0) {
            $project_data['user_id'] = $admin_id;
           
            $insert_id = $this->Admin_model->indert_data('rm_admin_category_course_details', $project_data);
            $return['status'] = 1;
        } else {
            // Update Start Here 
            $where = array("course_id" => $project_data['course_id']);
            $insert_id = $this->Admin_model->update_data('rm_admin_category_course_details', $project_data, $where);
            $return['status'] = 2;
        }

        if ($insert_id > 0) {
            
        } else {
            $return['status'] = false;
        }
        echo json_encode($return);
    }

    

    function DeleteCourse() {
        $dept_data['course_id'] = $this->input->post('course_id');
        $where = array("course_id" => $dept_data['course_id']);
        echo $delete = $this->Admin_model->row_delete($where, 'rm_admin_category_course_details');
    }

    function ActiveCourse() {

        $status = $this->input->post('status');

        if ($status == 1) {
            $newstatus = '0';
        } else {
            $newstatus = '1';
        }
        //$newstatus;
        $project_data['status'] = $newstatus;
        $where = array("course_id" => $this->input->post('course_id'));
        $insert_id = $this->Admin_model->update_data('rm_admin_category_course_details', $project_data, $where);
    }

    function EditCourse() {
        $course_id = $this->input->post('course_id');
        $Coursedata = $this->Admin_model->select_all_data('rm_admin_category_course_details', array("course_id" => $course_id), "course_id", "DESC");
        if (count($Coursedata) > 0) {

            foreach ($Coursedata as $CourseList):

                $dataReturn['CourseDet'] = array(
                   'course_id' => $CourseList->course_id,
                    'course_name' => $CourseList->course_name,
                    'category_id' => $CourseList->category_id,
                    'short_description' => $CourseList->short_description,  
                    'course_duration' => $CourseList->course_duration,  
                    'course_duration_remarks' => $CourseList->course_duration_remarks,
                    'zoom_duration' => $CourseList->zoom_duration,
                    'mentor_id' => $CourseList->mentor_id,
                    'course_mode' => $CourseList->course_mode,
                    'course_fee' => $CourseList->course_fee,
                    'course_type' => $CourseList->course_type,
                    'status' => $CourseList->status,
                    'jpg_image_id' => $CourseList->jpg_image_id,
                    
                );

            endforeach;
        }

          $ImageDetails = $this->Model->getSqlData("SELECT * FROM  rm_admin_category_course_details WHERE course_id='$course_id' ");
        $JpgimageList = $ImageDetails[0]['jpg_image_id'];
        $primary_jpg_image = explode(',', $JpgimageList);

         for ($l = 0; $l < count($primary_jpg_image); $l++) {
            $image_id = $primary_jpg_image[$l];
            $Imagesdata = $this->Model->getSqlData("SELECT * FROM rm_image_details WHERE image_id='$image_id'");
            if (count($Imagesdata) > 0) {
                if (!empty($Imagesdata)) {
                    $hotel_image_name = $Imagesdata[0]['name'];
                    $image_path = base_url() . "uploads/" . $hotel_image_name;
                } else {
                    $image_path = "";
                }

                $dataReturn['JpgImageList'][] = array(
                    'image_name' => $image_path,
                    'image_id' => $image_id,
                );
            }
        }
        
        
        echo json_encode($dataReturn);
    }  
    
     // Topics
    
    
    function Topics() {
        $data['menu_type'] = "1";
        $data['mcategory'] = "active";
        $data['topics'] = "active";
        $data['jsType'] = "4";
        $data['main_content'] = "admin/category/topicsList";
        $this->load->view('includes/template_admin', $data);
    }

    function AddTopics() { 
        $data['menu_type'] = "1";
        $data['mcategory'] = "active";
        $data['topics'] = "active";
        $data['jsType'] = "4";
        $data['main_content'] = "admin/category/topics";
        $this->load->view('includes/template_admin', $data);
    }
    
    
    function TopicsListing() {
        
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

        
        $Topic_data = $this->Admin_model->select_all_data('rm_admin_course_topic_details', array("rstatus=" => "1"), "lession_no", "ASC");

        if (count($Topic_data) > 0) {
            $dataReturn['status'] = true;
            $i = 1;
            foreach ($Topic_data as $TopicList):
                $upload = $TopicList->upload_date;
                $phpdate = strtotime($upload);
                $upload_date = date('d M Y h:i A', $phpdate);
                $user_id = $TopicList->user_id;
                $Userdata = $this->Model->getSqlData("SELECT * FROM rm_user_login_details WHERE user_id='$user_id'");

                if (!empty($Userdata)) {
                    $user_name = $Userdata[0]['full_name'];
                } else {
                    $user_name = "";
                }
                $store_image_id_list = $TopicList->jpg_image_id;
                $store_image_id_lists = explode(',', $store_image_id_list);
                $store_image_id = $store_image_id_lists[0];
                $Imagedata = $this->Model->getSqlData("SELECT * FROM rm_image_details WHERE image_id='$store_image_id'");

                if (!empty($Imagedata)) {
                    $image_name = $Imagedata[0]['name'];

                    $baner_image_path = base_url() . "uploads/" . $image_name;
                } else {
                    $image_name = "default_avatar.png";
                    $baner_image_path = base_url() . "uploads/" . $image_name;
                }
                    $course_id = $TopicList->course_id;
                $Coursedata = $this->Model->getSqlData("SELECT * FROM rm_admin_category_course_details WHERE course_id='$course_id'");

                if (!empty($Coursedata)) {
                    $course_name = $Coursedata[0]['course_name'];
                } else {
                    $course_name= "";
                }
               
                $dataReturn['data'][] = array(
                    'topic_id' => $TopicList->topic_id,
                    'topic_name' => $TopicList->topic_name,
                    'course_id' => $TopicList->course_id,
                    'category_id' => $TopicList->category_id,
                    'course_name' => $course_name,
                    'short_description' => $TopicList->short_description,
                    'lession_no'=>$TopicList->lession_no,
                    'link' => $TopicList->link,
                    'image_name' => $baner_image_path,                   
                    'status' => $TopicList->status,
                    'upload_date' => $upload_date,
                    'user_name' => $user_name,
                    'number' => $i
                );
                $i++;
            endforeach;
        } else {
            $dataReturn['status'] = FALSE;
        }

        print_r(json_encode($dataReturn));
    }

    function SaveTopics() {
        $admin_id = $this->input->cookie('admin_id', TRUE);
        $project_data['category_id'] = $this->input->post('category_id');
        $project_data['course_id'] = $this->input->post('course_id');
        $project_data['lession_no'] = $this->input->post('lession_no');
        $project_data['topic_id'] = $this->input->post('topic_id');
        $project_data['topic_name'] = $this->input->post('topic_name');
        $project_data['short_description'] = $this->input->post('short_description');
        $project_data['jpg_image_id'] = $this->input->post('store_image_id');
        $project_data['link'] = $this->input->post('youtube_link');
        $project_data['ip'] = $this->input->ip_address();
        $project_data['rstatus'] = "1";
        date_default_timezone_set("Asia/Kolkata");    //India time (GMT+5:30)
        $project_data['upload_date'] = date('Y-m-d H:i:s');
        
        if ($project_data['topic_id'] == 0) {
            $project_data['user_id'] = $admin_id;
           
            $insert_id = $this->Admin_model->indert_data('rm_admin_course_topic_details', $project_data);
            $return['status'] = 1;
        } else {
            // Update Start Here 
            $where = array("topic_id" => $project_data['topic_id']);
            $insert_id = $this->Admin_model->update_data('rm_admin_course_topic_details', $project_data, $where);
            $return['status'] = 2;
        }

        if ($insert_id > 0) {
            
        } else {
            $return['status'] = false;
        }
        echo json_encode($return);
    }

    

    function DeleteTopics() {
        $dept_data['topic_id'] = $this->input->post('topic_id');
        $where = array("topic_id" => $dept_data['topic_id']);
        echo $delete = $this->Admin_model->row_delete($where, 'rm_admin_course_topic_details');
    }

    function ActiveTopics() {

        $status = $this->input->post('status');

        if ($status == 1) {
            $newstatus = '0';
        } else {
            $newstatus = '1';
        }
        //$newstatus;
        $project_data['status'] = $newstatus;
        $where = array("topic_id" => $this->input->post('topic_id'));
        $insert_id = $this->Admin_model->update_data('rm_admin_course_topic_details', $project_data, $where);
    }

    function EditTopics() {
        $topic_id = $this->input->post('topic_id');
        $Topicdata = $this->Admin_model->select_all_data('rm_admin_course_topic_details', array("topic_id" => $topic_id), "topic_id", "DESC");
        if (count($Topicdata) > 0) {

            foreach ($Topicdata as $TopicList):

                $dataReturn['TopicDet'] = array(
                    'topic_id' => $TopicList->topic_id,
                    'course_id' => $TopicList->course_id,
                    'category_id' => $TopicList->category_id,
                    'topic_name' => $TopicList->topic_name,
                    'lession_no' => $TopicList->lession_no,
                    'short_description' => $TopicList->short_description,
                    'link' => $TopicList->link,
                    'jpg_image_id' => $TopicList->jpg_image_id,
                    
                );

            endforeach;
        }

        $ImageDetails = $this->Model->getSqlData("SELECT * FROM  rm_admin_course_topic_details WHERE topic_id='$topic_id' ");
        $JpgimageList = $ImageDetails[0]['jpg_image_id'];
        $primary_jpg_image = explode(',', $JpgimageList);

         for ($l = 0; $l < count($primary_jpg_image); $l++) {
            $image_id = $primary_jpg_image[$l];
            $Imagesdata = $this->Model->getSqlData("SELECT * FROM rm_image_details WHERE image_id='$image_id'");
            if (count($Imagesdata) > 0) {
                if (!empty($Imagesdata)) {
                    $hotel_image_name = $Imagesdata[0]['name'];
                    $image_path = base_url() . "uploads/" . $hotel_image_name;
                } else {
                    $image_path = "";
                }

                $dataReturn['JpgImageList'][] = array(
                    'image_name' => $image_path,
                    'image_id' => $image_id,
                );
            }
        }
        
        echo json_encode($dataReturn);
    }

    function AboutTopicsImage() {
        $topic_id = $this->input->post('topic_id');
        $Categroydata = $this->Model->getSqlData("SELECT * FROM rm_admin_course_topic_details WHERE topic_id='$topic_id'");
        $primary_store_image_id_list = $Categroydata[0]['jpg_image_id'];


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

     function GetCourseList(){
          $category_id=$this->input->post('category_id');
          $Course_data = $this->Admin_model->select_all_data('rm_admin_category_course_details', array("status" => "1","category_id"=>$category_id), "course_name", "ASC ");
         
          
        if (count($Course_data) > 0) {
            $dataReturn['status'] = true;

            foreach ($Course_data as $coursedataList):

                $dataReturn['CourseList'][] = array(
                    'course_id' => $coursedataList->course_id,
                    'course_name' => $coursedataList->course_name,
                    
                                        
                );


            endforeach;
        } else {
             
                    
                    
                                        
       
        } 
        
         echo json_encode($dataReturn);
       }
       

}

?>