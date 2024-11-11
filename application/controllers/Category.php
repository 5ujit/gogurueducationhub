<?php

class Category extends CI_controller {

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
        $data['category'] = "active";
        $data['jsType'] = "4";
        $data['main_content'] = "admin/category/categoryList";
        $this->load->view('includes/template_admin', $data);
    }

    function AddCategory() {  
          $data['menu_type'] = "1";
        $data['mcourse'] = "active";
        $data['course'] = "active";
        $data['jsType'] = "4";
        $data['main_content'] = "admin/category/category";
        $this->load->view('includes/template_admin', $data);
    }
    
    
    function CategoryListing() {

        $Course_data = $this->Admin_model->select_all_data('rm_admin_category_details', array("rstatus=" => "1"), "category_name", "ASC");

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
                    'category_id' => $CourseList->category_id,
                    'category_name' => $CourseList->category_name,
                    'short_description' => $CourseList->short_description,
                    'image_name' => $baner_image_path,                   
                    'status' => $CourseList->status,
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

    function SaveCategorys() {
        $admin_id = $this->input->cookie('admin_id', TRUE);
        $project_data['category_id'] = $this->input->post('category_id');
        $project_data['category_name'] = $this->input->post('category_name');
        $project_data['short_description'] = $this->input->post('short_description');
        $project_data['jpg_image_id'] = $this->input->post('jpg_image_id');
        $project_data['ip'] = $this->input->ip_address();
        $project_data['rstatus'] = "1";
        date_default_timezone_set("Asia/Riyadh");    //India time (GMT+5:30)
        $project_data['upload_date'] = date('Y-m-d H:i:s');
        
        if ($project_data['category_id'] == 0) {
            $project_data['user_id'] = $admin_id;
           
            $insert_id = $this->Admin_model->indert_data('rm_admin_category_details', $project_data);
            $return['status'] = 1;
        } else {
            // Update Start Here 
            $where = array("category_id" => $project_data['category_id']);
            $insert_id = $this->Admin_model->update_data('rm_admin_category_details', $project_data, $where);
            $return['status'] = 2;
        }

        if ($insert_id > 0) {
            
        } else {
            $return['status'] = false;
        }
        echo json_encode($return);
    }

    

    function DeleteCategorys() {
        $dept_data['category_id'] = $this->input->post('category_id');
        $where = array("category_id" => $dept_data['category_id']);
        echo $delete = $this->Admin_model->row_delete($where, 'rm_admin_category_details');
    }

    function ActiveCategorys() {

        $status = $this->input->post('status');

        if ($status == 1) {
            $newstatus = '0';
        } else {
            $newstatus = '1';
        }
        //$newstatus;
        $project_data['status'] = $newstatus;
        $where = array("category_id" => $this->input->post('category_id'));
        $insert_id = $this->Admin_model->update_data('rm_admin_category_details', $project_data, $where);
    }

    function EditCategorys() {
        $category_id = $this->input->post('category_id');
        $Categorydata = $this->Admin_model->select_all_data('rm_admin_category_details', array("category_id" => $category_id), "category_id", "DESC");
        if (count($Categorydata) > 0) {

            foreach ($Categorydata as $CategoryList):

                $dataReturn['CategoryDet'] = array(
                    'category_id' => $CategoryList->category_id,
                    'category_name' => $CategoryList->category_name,
                    'short_description' => $CategoryList->short_description,
                    'jpg_image_id' => $CategoryList->jpg_image_id,
                    
                );

            endforeach;
        }

        $ImageDetails = $this->Model->getSqlData("SELECT * FROM  rm_admin_category_details WHERE category_id='$category_id' ");
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

    function AboutCourseImage() {

        $course_id = $this->input->post('course_id');
        $Categroydata = $this->Model->getSqlData("SELECT * FROM rm_admin_category_details WHERE course_id='$course_id'");
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

  
    
}

?>