<div class="page-content-wrapper" ng-controller="CourseController">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">

        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_dashboard'); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>

                <span class="active">Dashboard</span>

            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-red-sunglo bold uppercase">Dashboard</span>

                        </div>

                    </div>
                    <div class="portlet-body form">

                        <div class="row">
                            <div class="col-lg-4 col-4 text-center">
                                <!-- small box -->
                                <div class="panel panel-default bg-blue">
                                    <div class="panel-body">
                                        <h3 style="color:#fff;"><?PHP echo $DATA['total_users']; ?></h3>
                                        <p style="color:#fff;"><i class="fa fa-users" aria-hidden="true" ></i> Total Trainee</p>
                                    </div>

                                    <p class="text-right" style="margin-bottom: 3px;padding-right: 10px;">  <a href="<?php echo base_url(); ?>Portal" class="small-box-footer" style="color:#fff;">More info <i class="fa fa-arrow-circle-right"></i></a></p>
                                </div>
                            </div>
                            
                              <div class="col-lg-4 col-4 text-center">
                                <!-- small box -->
                                <div class="panel panel-default bg-purple-soft">
                                    <div class="panel-body">
                                        <h3  style="color:#fff;"><?PHP echo $DATA['total_courses']; ?></h3>
                                        <p  style="color:#fff;"><i class="fa fa-yelp" aria-hidden="true" ></i> Total Courses</p>
                                    </div>

                                    <p class="text-right" style="margin-bottom: 3px;padding-right: 10px;">  <a href="<?php echo base_url(); ?>Course" class="small-box-footer" style="color:#fff;">More info <i class="fa fa-arrow-circle-right"></i></a></p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-4 text-center">
                                <!-- small box -->
                                <div class="panel panel-default bg-blue-soft">
                                    <div class="panel-body">
                                        <h3  style="color:#fff;"><?PHP echo $DATA['total_test']; ?></h3>
                                        <p  style="color:#fff;"><i class="fa fa-book" aria-hidden="true" ></i> Total Tests</p>
                                    </div>

                                    <p class="text-right" style="margin-bottom: 3px;padding-right: 10px;">  <a href="<?php echo base_url(); ?>Course/Test" class="small-box-footer" style="color:#fff;">More info <i class="fa fa-arrow-circle-right"></i></a></p>
                                </div>
                            </div>
                            
                            
                            
                          
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">


                               

                                    <table class="table table-bordered table-striped margin-top-30">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Test Name</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Trainee Name</th>
                                                <th scope="col">Submitted at</th>
                                                <th scope="col">Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?PHP 
                                            $i=1;
                                            foreach($TestResult as $TestResultList) {
                                                $test_id=$TestResultList['test_id'];
                                                 $Testdata = $this->Model->getSqlData("SELECT *  FROM rm_admin_course_test_details WHERE test_id='$test_id' ");
                                                if (!empty($Testdata)) {
                                                    $test_name = $Testdata[0]['test_name'];
                                                } 

                                                else
                                                {
                                                  $test_name="0";  
                                                }
                                                $user_id=$TestResultList['user_id'];
                                                $Userdata = $this->Model->getSqlData("SELECT *  FROM rm_portal_trainee_details WHERE user_id='$user_id' ");
                                                if (!empty($Userdata)) {
                                                    $user_name = $Userdata[0]['first_name'];
                                                    $u_ids = $Userdata[0]['id'];

                                                } 

                                                else
                                                {
                                                  $user_name="0";  
                                                  $u_ids="";
                                                }
                                                $upload = $TestResultList['upload_date'];
                                                $phpdate = strtotime($upload);
                                                $upload_date = date('d M Y h:i A', $phpdate);
                                                $marks=$TestResultList['marks'];
                                                 if($marks>=70){
                   $result="Passed";
               }
               else {
                   $result="Fail"; 
               }
                                                ?>
                                            <tr>
                                                <th scope="row"><?php echo $i; ?></th>
                                                <td><?PHP echo $test_name; ?></td>
                                                <td><?PHP echo $u_ids; ?></td>
                                                <td><?PHP echo $user_name; ?></td>
                                                <td><?PHP echo $upload_date; ?></td>
                                                
                                                <td><?php echo $marks ?>/100 <span class="text-success">(<?php echo $result; ?>)</span></td>
                                            </tr>
                                            <?PHP $i++;}?>
                                        </tbody>
                                    </table>

<!--                                    <p><a href="#">+15 more</a> </p>-->


                                </div>



                            </div>



                         
                        </div>
                    </div>


                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>


        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>



    <?PHP foreach ($CouseList as $CouseLists) { ?> 

                    <div class="row">
                        <div class="col d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">

                            <div class="icon-box p-0  text-start">

                                <div class="mb-2"><center><img src="<?php echo base_url(); ?>portal/assets/img/thumb1.png" class="img-fluid" /></center></div>
                                <div class="p-3">
                                    <h4 class="title align-items-start"><a href="courses-details.html"><?php echo $CouseLists['course_name']; ?></a></h4>
                                    <p class="description mb-2"><?php echo $CouseLists['short_description']; ?></p>

                                    <div class="d-flex justify-content-between mb-4">


                                        <div>

                                            <b>Mentor:</b> <?php $mentor_id=$CouseLists['mentor_id']; 
                                            
                                            switch($mentor_id){
                                              CASE 1:
                                                  echo "Mr.Saswat Sahi";
                                                  break;
                                               CASE 2:
                                                  echo "Mr. Vinod Gupta";
                                                  break;
                                              defalut:
                                                  echo "NA";
                                                  break;
                                            }
                                            ?> </div>
                                    </div>
                                    <div class="d-flex justify-content-between"><small class="rounded-pill ps-2 pe-2 bg-warning"><?php $course_type=$CouseLists['course_type']; if($course_type=='0'){ echo "Free";} else { echo "Paid"; } ?></small> <div>        <b>Mode:</b> <?php $course_mode=$CouseLists['course_mode']; if($course_mode=='0'){ echo "Offline";} else { echo "Online"; }
                                        ?> </div> <a href="courses-details.html">Start Now <i class="bx bx-right-arrow-alt fs-5 align-middle"></i></a></div>
                                </div>
                            </div>

                        </div>
                    </div>
    <?PHP }?>