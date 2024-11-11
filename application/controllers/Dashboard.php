<?php

class Dashboard extends CI_controller {

    function __construct() {
        parent::__construct();

        $this->no_cache();

        $admin_id = $this->input->cookie('admin_id', TRUE);
//      
// if( $admin_id==''){
//             redirect(base_url()."Login");
//        }
    }

    protected function no_cache() {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    function Listing() {

        $Course_data = $this->Admin_model->getAllDataquery("SELECT * FROM `rm_portal_trainee_test_result_summary_details` WHERE status='1' AND track_id  IS NOT NULL");

         $TotalUserdata = $this->Model->getSqlData("SELECT count(*) as tot FROM rm_portal_trainee_details ");
        if (!empty($TotalUserdata)) {
            $total_users = $TotalUserdata[0]['tot'];
        } else {
            $total_users = "0";
        }


        $TotalCourseUserdata = $this->Model->getSqlData("SELECT count(*) as tot FROM rm_admin_course_details  WHERE status='1'");
        if (!empty($TotalCourseUserdata)) {
            $total_courses = $TotalCourseUserdata[0]['tot'];
        } else {
            $total_courses = "0";
        }

        $TotalCourseTestUserdata = $this->Model->getSqlData("SELECT count(*) as tot FROM rm_admin_course_test_details  WHERE status='1'");
        if (!empty($TotalCourseTestUserdata)) {
            $total_test = $TotalCourseTestUserdata[0]['tot'];
        } else {
            $total_test = "0";
        }

        
        if (count($Course_data) > 0) {
            $dataReturn['status'] = true;
            $i = 1;
            foreach ($Course_data as $CourseList):
                $upload = $CourseList->upload_date;
                $phpdate = strtotime($upload);
                $upload_date = date('d M Y h:i A', $phpdate);
                $user_id = $CourseList->user_id;
                $Userdata = $this->Model->getSqlData("SELECT *  FROM rm_portal_trainee_details WHERE user_id='$user_id' ");
                if (!empty($Userdata)) {
                    $user_name = $Userdata[0]['first_name'] ." ". $Userdata[0]['last_name'];
                    $u_ids = $Userdata[0]['id'];
                } else {
                    $user_name = "0";
                    $u_ids = "";
                }
                
                $marks = $CourseList->marks;
                $test_id = $CourseList->test_id;
                
                $TestDet = $this->Model->getSqlData("SELECT * FROM rm_admin_course_test_details WHERE test_id='$test_id'");
                if (!empty($TestDet)) {
                     $course_id = $TestDet[0]['course_id'];
                       $tot_no_questions= $TestDet[0]['tot_no_questions'];
                      
                   
                } else {
                     $course_id = 0;
                       $tot_no_questions= 0;
                }
                
                
                $CourseDet = $this->Model->getSqlData("SELECT * FROM rm_admin_course_details WHERE course_id='$course_id'");
                if (!empty($CourseDet)) {
                    $passing_marks = $CourseDet[0]['passing_marks'];
                  
                } else {
                    $passing_marks =0;
                   
                }

                
                if ($marks >= $passing_marks) {
                    $result = "Passed";
                } else {
                    $result = "Fail";
                }
                $test_id = $CourseList->test_id;
                $Testdata = $this->Model->getSqlData("SELECT *  FROM rm_admin_course_test_details WHERE test_id='$test_id' ");
                if (!empty($Testdata)) {
                    $test_name = $Testdata[0]['test_name'];
                } else {
                    $test_name = "0";
                }


                $dataReturn['data'][] = array(
                    'test_name' => $test_name,
                    'user_id' => $user_id,
                     'u_ids' => $u_ids,
                    'user_name' => $user_name,
                    'passing_marks' => $passing_marks,
                    'upload_date' => $upload_date,
                    'test_result'=>$result,
                    'marks'=>$marks,
                    'number' => $i,
                    'total_users'=>$total_users,
                    'tot_no_questions'=>$tot_no_questions,
                    'total_courses'=>$total_courses,
                    'total_test'=>$total_test,
                );
                $i++;
            endforeach;
        } else {
            $dataReturn['status'] = FALSE;
        }

        print_r(json_encode($dataReturn));
    }

    function index() {
        $data['menu_type'] = "1";
        $data['jsType'] = "4";
        $data['dash'] = "active";
        $data['main_content'] = "admin/dashboard/dashboard";
        $this->load->view('includes/template_admin', $data);
    }

    function Dash() {

        $today_date = date("Y-m-d");

        $TotalUserdata = $this->Model->getSqlData("SELECT count(*) as tot FROM rm_portal_trainee_details ");
        if (!empty($TotalUserdata)) {
            $total_users = $TotalUserdata[0]['tot'];
        } else {
            $total_users = "0";
        }


        $TotalCourseUserdata = $this->Model->getSqlData("SELECT count(*) as tot FROM rm_admin_course_details  WHERE status='1'");
        if (!empty($TotalCourseUserdata)) {
            $total_courses = $TotalCourseUserdata[0]['tot'];
        } else {
            $total_courses = "0";
        }

        $TotalCourseTestUserdata = $this->Model->getSqlData("SELECT count(*) as tot FROM rm_admin_course_test_details  WHERE status='1'");
        if (!empty($TotalCourseTestUserdata)) {
            $total_test = $TotalCourseTestUserdata[0]['tot'];
        } else {
            $total_test = "0";
        }

        $Users = array(
            "total_users" => $total_users,
            "total_courses" => $total_courses,
            "total_test" => $total_test,
        );

        return $Users;
    }
    
    function Result() {
        $data['TestResult']=$this->Model->getSqlData("SELECT * FROM  rm_portal_trainee_test_result_summary_details ORDER BY summary_id DESC ");
        $data['main_content'] = "admin/dashboard/result-excel_view";
        $this->load->view('includes/template_login', $data);
    }
    

}

?>