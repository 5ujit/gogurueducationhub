<?php   $user_id = $this->input->cookie('user_id', TRUE);  ?>
<main id="main">

    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Courses</h2>
                <ol>
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li>Courses</li>
                </ol>
            </div>

        </div>
    </section>





    <section id="services" class="services">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="section-title">

                <p>
                    <?php 
                    $course_id=$TopicList[0]['course_id'];
                    $CurrentTopicDet=$this->Model->getSqlData("SELECT * FROM rm_admin_course_topic_details WHERE status='1' AND course_id='$course_id' AND lession_no='$lession_no'");
                    $link=$CurrentTopicDet[0]['link'];
                    $ylink=explode('https://youtu.be/',$link);
                    $youtube_link=$ylink[1];                    
                   $courseDet=$this->Model->getSqlData("SELECT * FROM rm_admin_category_course_details WHERE status='1' AND course_id='$course_id'");
                    ?>
                   <?php echo $courseDet[0]['course_name'];?></p>
            </div>



            <div class="row">

                <div class="col-md-4">

                    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                        <div class="p-0">
                            <h4 class="mb-3">Lesson Navigator</h4>


                            <div class="accordion" id="accordionExample">
                                 <?PHP 
                                 $i=1;
                                 foreach ($TopicList as $TopicLists) {
                                     $topic_id=$TopicLists['topic_id'];
                                     if($i==$lession_no){
                                       $aria_expanded="true";
                                       $show_box="show";
                                     }
                                     else
                                     {
                                        $aria_expanded="false"; 
                                        $show_box="";
                                     }
                                     ?> 
                                <div class="accordion-item">
                                    <h4 class="accordion-header">
                                        <button class="accordion-button " style="font-size:13px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $topic_id;?>" aria-expanded="<?php echo $aria_expanded ;?>" aria-controls="collapseOne<?php echo $topic_id;?>">
                                            <?php echo $i."."; ?> <?php echo $TopicLists['topic_name']; ?>
                                        </button>
                                    </h4>
                                    <div id="collapseOne<?php echo $topic_id;?>" class="accordion-collapse collapse <?php echo $show_box ;?>" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
<!--                                             <p  style="font-size:11px;">This is sub title</p>-->
       
                                        </div>
                                    </div>
                                </div>
                                 <?php $i++; } ?>
                                
                                
                            </div>

                        </div></div>

                </div>


                <div class="col-md-8">



                    <div class="vedio-container">

                        <iframe width="100%" height="415" src="https://www.youtube.com/embed/<?php echo $youtube_link;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>




                    <div class="pt-4">
                        <h4 class="title align-items-start"><?php echo $CurrentTopicDet[0]['short_description']; ?></h4>
                        

                        <div class="mb-4">


                            <div class="mb-2">

                                <b>Mentor:</b> <?php
                                
                              
                                 
                                $mentor_id=$courseDet[0]['mentor_id']; 
                                            
                                            switch($mentor_id){
                                              CASE 1:
                                                  echo "Mr.Saswat Sahi";
                                                  break;
                                               CASE 2:
                                                  echo "Mr. Vinod Gupta";
                                                  break;
                                              default:
                                                  echo "NA";
                                                  break;
                                            }
                                            ?> </div>

                            <div>        <b>Mode:</b> <?php $course_mode=$courseDet[0]['course_mode']; if($course_mode=='0'){ echo "Offline";} else { echo "Online"; } ?> </div>  
<!--                            <div>        <b>Duration:</b> 35 minutes </div>  -->
                        </div>



<!--                        <div class="card">
                            <div class="card-body">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Overview</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                        <div class="p-3">
                                            <h5>1.1 Introductions</h5>

                                            <ul class="p-3">

                                                <li>Soft skills needed to interact effectively in a business setting</li>

                                                <li>Show respect to co-workers and clients</li>

                                                <li>Make a great impression at a job interview</li>

                                                <li>Make introductions appropriately and effectively</li>

                                                <li>Learn soft skills that enhance your professionalism</li>

                                                <li>Prepare for the business behaviour component of the IITTI Level 1 exam</li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
                                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
                                    <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
                                </div>





                            </div>
                        </div>-->


                        <div class="pt-4">

                            <div class="row">
                                <div class="col-6">
                                    <?php 
                                     if (($user_id=='') && ($lession_no==0) ) { 
                                    if($lession_no!=1) { ?>
                                    <a class="btn btn-warning" href="#" onclick="PreLession(<?php echo $course_id;?>,<?php echo $lession_no;?>);"><i class="bx bx-left-arrow-alt fs-5 align-middle"></i> Previous Lession</a>
                                     <?php } } ?>
                                </div>
                                <div class="col-6 text-end">
                                    <?php  
                                    
                                    $PaymentDet = $this->Model->getSqlData("SELECT * FROM rm_user_payment_details WHERE status='1' AND course_id='$course_id' AND user_id='$user_id'");
                                    if(!empty($PaymentDet)){
                                        $payment_type=1;
                                    }
                                    else {
                                       $payment_type=0; 
                                    }
                                 
                                   if (($user_id!='') && ($payment_type==1) ) {  ?>
                                       <a class="btn btn-warning" href="#" onclick="NextLession(<?php echo $course_id;?>,<?php echo $lession_no;?>);">Next Lession <i class="bx bx-right-arrow-alt fs-5 align-middle"></i></a>
                                    <?php } 
                                 
                                    else   {?>
                                    
                                    <a class="btn btn-warning" href="<?php echo base_url(); ?>Portal/PaymentCheck" >Next Lession <i class="bx bx-right-arrow-alt fs-5 align-middle"></i></a>

                                    <?php } ?>
                                </div>

                            </div>
                        </div>







                    </div>




                </div>


            </div>








        </div>
    </section>




</main><!-- End #main -->
