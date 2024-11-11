<?php

//require_once APPPATH . 'controllers/Api.php';

Class Import extends CI_controller {

    function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        ini_set('memory_limit', '-1');

        $this->load->library('Csvimport');
        $this->db->cache_delete_all();
        $admin_id = $this->input->cookie('admin_id', TRUE);
        if ($admin_id == '') {
            redirect(base_url() . "Login");
        }
    }

   

    function Test() {
        $data['bulk'] = "active";
        $data['btest'] = "active";
        $data['jsType'] = "4";
        $data['main_content'] = "admin/import/testList";
        $this->load->view('includes/template_admin', $data);
    }

    function AddTest() {
        $data['bulk'] = "active";
        $data['jsType'] = "1";
        $data['msg'] = "";
        $data['main_content'] = "admin/import/test";
        $this->load->view('includes/template_admin', $data);
    }

// Fethcing The Raw Unsampled From API 

    function UploadCallDump() {

        $csvfile = $_FILES['file_source']['tmp_name'];
        if ($csvfile == '') {
            $data['vin'] = "active";
            $data['jsType'] = "1";
            $data['msg'] = "Please upload CSV file.";
            $data['main_content'] = "admin/import/test";
            $this->load->view('includes/template_admin', $data);
        } else {
            $worksheet = $this->csvimport->get_array($csvfile);
            $track_id = $this->TrackCode();
            $this->AddBulkQuestions($worksheet, $track_id);
        }
    }

    function AddBulkQuestions($result, $track_id) {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 600); //300 seconds = 5 minutes
        $admin_id = $this->input->cookie('admin_id', TRUE);
        $test_id = trim($result[0]['Test ID']);
        $Testsql = "SELECT * FROM rm_admin_course_test_details WHERE test_id='$test_id'";
        $CourseCheck = $this->Model->getSqlData($Testsql);
        if (!empty($CourseCheck)) {
            $main_course_id = $CourseCheck[0]['course_id'];
        } else {
            $main_course_id = 0;
        }
        $total_no_of_questions = count($result);
        if (($test_id != '') && ($main_course_id != '0')) {
            $master_data['user_id'] = $admin_id;
            $master_data['test_id'] = $test_id;
            $master_data['course_id'] = $main_course_id;
            $master_data['no_of_questions'] = $total_no_of_questions;
            $master_data['test_id'] = $test_id;
            $master_data['upload_date'] = date('Y-m-d H:i:s');
            $master_data['track_id'] = $track_id;
            $master_data['ip'] = $this->input->ip_address();
            $master_data['status'] = '0';
//                 print_r($master_data);
//                 exit;
            $import_id = $this->Admin_model->indert_data('rm_admin_course_test_questions_bulk_upload_details', $master_data);
        }

        ;

        foreach ($result as $row) {
            $test_id = trim($row['Test ID']);
            $Testsql = "SELECT * FROM rm_admin_course_test_details WHERE test_id='$test_id'";
            $DealarCheck = $this->Model->getSqlData($Testsql);
            if (!empty($DealarCheck)) {
                $course_id = $DealarCheck[0]['course_id'];
            } else {
                $course_id = 0;
            }
            if (($test_id != '') && ($course_id != '0')) {
                $import_data['user_id'] = $admin_id;
                $import_data['test_id'] = $test_id;
                $import_data['question_name'] = trim($row['Question Name']);
                $import_data['test_id'] = $test_id;
                $import_data['course_id'] = $course_id;
                $import_data['answer1'] = trim($row['Answer1']);
                $import_data['answer2'] = trim($row['Answer2']);
                $import_data['answer3'] = trim($row['Answer3']);
                $import_data['answer4'] = trim($row['Answer4']);
                $import_data['correct_answer1'] = trim($row['Correct Answer1']);
                $import_data['correct_answer2'] = trim($row['Correct Answer2']);
                $import_data['correct_answer3'] = trim($row['Correct Answer3']);
                $import_data['correct_answer4'] = trim($row['Correct Answer4']);
                $import_data['page_no'] = trim($row['page_no']);
                $import_data['upload_date'] = date('Y-m-d H:i:s');
                $import_data['track_id'] = $track_id;
                $import_data['status'] = '0';
                $import_data['source'] = '1';
                $import_data['ip'] = $this->input->ip_address();
                $import_id = $this->Admin_model->indert_data('rm_admin_course_test_questions_details', $import_data);
            }
        }

        redirect(base_url() . "Import/Test");
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

        function TestListing() {
        
         $course_section_data = $this->Admin_model->select_all_data('rm_admin_course_details', array("status" => "1"), "course_name", "ASC ");

        if (count($course_section_data) > 0) {
            $dataReturn['status'] = true;

            foreach ($course_section_data as $courseSectionList):

                $dataReturn['CourseList'][] = array(
                    'course_id' => $courseSectionList->course_id,
                    'course_name' => $courseSectionList->course_name,
                    
                                        
                );


            endforeach;
        }

        $Test_data = $this->Admin_model->select_all_data('rm_admin_course_test_questions_bulk_upload_details', array("rstatus=" => "1"), "bulk_upload_id", "DESC");

        if (count($Test_data) > 0) {
            $dataReturn['status'] = true;
            $i = 1;
            foreach ($Test_data as $TestList):
               
                $upload = $TestList->upload_date;
                $phpdate = strtotime($upload);
                $upload_date = date('d M Y h:i A', $phpdate);

                $user_id = $TestList->user_id;
                $Userdata = $this->Model->getSqlData("SELECT * FROM rm_user_login_details WHERE user_id='$user_id'");

                if (!empty($Userdata)) {
                    $user_name = $Userdata[0]['full_name'];
                } else {
                    $user_name = "";
                }
              
                $test_id = $TestList->test_id;
                $Testdata = $this->Model->getSqlData("SELECT * FROM rm_admin_course_test_details WHERE test_id='$test_id'");

                if (!empty($Testdata)) {
                    $test_name = $Testdata[0]['test_name'];
                    $tot_no_questions=$Testdata[0]['tot_no_questions'];
                    
                } else {
                    $test_name= "";
                    $tot_no_questions=0;
                }
                
               $course_id = $TestList->course_id;
                $Coursedata = $this->Model->getSqlData("SELECT * FROM rm_admin_course_details WHERE course_id='$course_id'");

                if (!empty($Coursedata)) {
                    $course_name = $Coursedata[0]['course_name'];
                } else {
                    $course_name= "";
                }
                $test_id=$TestList->test_id;
                $question_status=$this->Questionsvalidation($test_id);
                $dataReturn['data'][] = array(
                    'test_id' => $TestList->test_id,
                    'test_name' => $test_name,
                    'course_id' => $TestList->course_id,
                    'course_name' => $course_name,
                    'tot_no_questions' => $tot_no_questions,
                    'no_of_questions'=>$TestList->no_of_questions,
                    'status' => $TestList->status,
                    'track_id' => $TestList->track_id,
                    'upload_date' => $upload_date,
                    'user_name' => $user_name,
                    'question_status'=>$question_status,
                    'number' => $i
                );
                $i++;
            endforeach;
        } else {
            $dataReturn['status'] = FALSE;
        }

        print_r(json_encode($dataReturn));
    }
    
    
    function DeleteTest() {
        $dept_data['track_id'] = $this->input->post('track_id');
        $where = array("track_id" => $dept_data['track_id']);
        echo $delete = $this->Admin_model->row_delete($where, 'rm_admin_course_test_questions_details');
        echo $delete = $this->Admin_model->row_delete($where, 'rm_admin_course_test_questions_bulk_upload_details');
    }

    function ActiveTest() {
        $status = $this->input->post('status');
        if ($status == 1) {
            $newstatus = '0';
        } else {
            $newstatus = '1';
        }
        //$newstatus;
        $project_data['status'] = $newstatus;
        $where = array("track_id" => $this->input->post('track_id'));
        $insert_id = $this->Admin_model->update_data('rm_admin_course_test_questions_bulk_upload_details', $project_data, $where);
    }

    
      function Questionsvalidation($test_id){
        
         $Questiondata = $this->Model->getSqlData("SELECT count(*) as total FROM rm_admin_course_test_questions_details WHERE test_id='$test_id'");
               if (!empty($Questiondata)) {
                    $total_questions_added = $Questiondata[0]['total'];
                } else {
                    $total_questions_added= 0;
                }
                
               $Testdata = $this->Model->getSqlData("SELECT * FROM rm_admin_course_test_details WHERE test_id='$test_id'");
               if (!empty($Testdata)) {
                    $tot_no_questions = $Testdata[0]['tot_no_questions'];
                } else {
                    $tot_no_questions= 0;
                }
                
                if($tot_no_questions>$total_questions_added){
                   $check=1 ;
                }else    if($tot_no_questions=$total_questions_added){
                     $check=-1 ;  
                }
                else {
                   $check=-1 ;  
                }
                
                return  $check;
    }
    
        function QuestionsPreview() {              
         $data['bulk'] = "active";
        $data['btest'] = "active";
        $data['jsType'] = "4";
        $data['main_content'] = "admin/import/questionsPreview";
        $this->load->view('includes/template_admin', $data);
    }
    
     function LoadQuestionsPreview() {
         $track_id = $this->input->post('track_id');
         $test_section_data = $this->Admin_model->select_all_data('rm_admin_course_test_questions_details', array("rstatus" => "1","track_id"=>$track_id), "test_id", "ASC ");

        if (count($test_section_data) > 0) {
            $dataReturn['status'] = true;
               $i = 1;
            foreach ($test_section_data as $testDet):
              
               $course_id=$testDet->course_id;
               $Coursedata = $this->Model->getSqlData("SELECT * FROM rm_admin_course_details WHERE course_id='$course_id'");
               if (!empty($Coursedata)) {
                    $course_name = $Coursedata[0]['course_name'];
                } else {
                    $course_name= "";
                }
                
                $test_id=$testDet->test_id;
               $testdata = $this->Model->getSqlData("SELECT * FROM rm_admin_course_test_details WHERE test_id='$test_id'");
               if (!empty($testdata)) {
                    $test_name = $testdata[0]['test_name'];
                    $tot_no_questions=$testdata[0]['tot_no_questions'];
                } else {
                    $test_name= "";
                    $tot_no_questions="";
                }
                
               $Questiondata = $this->Model->getSqlData("SELECT count(*) as total FROM rm_admin_course_test_questions_details WHERE test_id='$test_id'");
               if (!empty($Questiondata)) {
                    $total_questions_added = $Questiondata[0]['total'];
                } else {
                    $total_questions_added= 0;
                }
                
                $dataReturn['data'][] = array(
                    'question_id' => $testDet->question_id,
                    'test_id' => $testDet->test_id,
                    'course_name' => $course_name,
                    'question_name'=>$testDet->question_name,
                    'answer1'=>$testDet->answer1,
                    'answer2'=>$testDet->answer2,
                    'answer3'=>$testDet->answer3,
                    'answer4'=>$testDet->answer3,
                    'correct_answer1'=>$testDet->correct_answer1,
                    'correct_answer2'=>$testDet->correct_answer2,
                    'correct_answer3'=>$testDet->correct_answer3,
                    'correct_answer4'=>$testDet->correct_answer4,
                    'course_id'=>$testDet->course_id,
                    'total_questions_added'=>$total_questions_added,
                    'tot_no_questions'=>$tot_no_questions,
                     'number' => $i
                    
                                        
                );
            $i++;

            endforeach;
        }

       

        print_r(json_encode($dataReturn));
    }
    
    
    // Traniie Section 
    
     function AddUser() {
        $data['bulk'] = "active";
        $data['jsType'] = "1";
        $data['msg'] = "";
        $data['main_content'] = "admin/import/user";
        $this->load->view('includes/template_admin', $data);
    }
    
    function UploadUser() {

        $csvfile = $_FILES['file_source']['tmp_name'];
        if ($csvfile == '') {
            $data['vin'] = "active";
            $data['jsType'] = "1";
            $data['msg'] = "Please upload CSV file.";
            $data['main_content'] = "admin/import/user";
            $this->load->view('includes/template_admin', $data);
        } else {
            $worksheet = $this->csvimport->get_array($csvfile);
         
            $this->AddBulkUsers($worksheet);
        }
    }

    function AddBulkUsers($result) {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 600); //300 seconds = 5 minutes
        $admin_id = $this->input->cookie('admin_id', TRUE);

         foreach ($result as $row) {
         $id = trim($row['ID']);
         if ($id != '') {
            $master_data['admin_user_id'] = $admin_id;
            $master_data['first_name'] = trim($row['First Name']);
            $master_data['email'] = trim($row['Email']);
            $master_data['username'] = trim($row['Username']);
            $master_data['speciality'] = trim($row['Speciality']);
            $master_data['region'] = trim($row['Region']);            
            $master_data['id'] = $id;
            $master_data['upload_date'] = date('Y-m-d H:i:s');
            $master_data['ip'] = $this->input->ip_address();
            $master_data['status'] = '1';
//            print_r($master_data);
//            exit;
            $import_id = $this->Admin_model->indert_data('rm_portal_trainee_details', $master_data);
        }
      
    }
    redirect(base_url() . "Portal");  
    }
    
}

?>