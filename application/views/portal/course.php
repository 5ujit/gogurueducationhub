
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

                <p>We have been providing certified training for professionals and non-professionals on various domains</p>
            </div>



            <div class="row">

                <div class="col-md-5">

                    <ul class="list-group">
                        <?PHP foreach ($CouseList as $CouseLists) {
                          $course_id=$CouseLists['course_id'];
                          $totalTopics = $this->Model->getSqlData("SELECT count(*) as tot FROM rm_admin_course_topic_details WHERE status='1' AND course_id='$course_id'");

                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold"><?php echo $CouseLists['course_name']; ?></div>

                                </div>
                                <span class="badge bg-warning rounded-pill"> <?php echo $totalTopics[0]['tot'];?> </span>
                            </li>
                        <?php } ?>       

                    </ul>

                </div>


                <div class="col-md-7">

      <?PHP foreach ($CouseList as $CouseLists) { 
          $image_id=$CouseLists['jpg_image_id'];
          $course_image_path = $this->Model->ImageDetails('1',$image_id);
          ?>                  
                     <div class="icon-box p-0  text-start">

              <div class="mb-2"><img src="<?php echo $course_image_path ?>" class="img-fluid" /></div>
              <div class="p-3">
              <h4 class="title align-items-start"><a href=""><?php echo $CouseLists['course_name']; ?></a></h4>
              <p class="description mb-2"><b>Duration:</b> <?php echo $CouseLists['course_duration']; ?></p>
              <p>- <?php echo $CouseLists['course_duration_remarks']; ?></p>
              <p>- <?php echo $CouseLists['zoom_duration']; ?> Minutes Zoom Call</p>
              <p><?php echo $CouseLists['short_description']; ?></p>   

<div class="d-flex justify-content-between mb-4">
    

      <div><b>Mentor:</b> <?php $mentor_id=$CouseLists['mentor_id']; 
                                            
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
                                            ?></div>
</div>

           
        
</div>
              
              <div class="d-flex justify-content-between"><small class="rounded-pill ps-2 pe-2 bg-warning"><?php $course_type=$CouseLists['course_type']; if($course_type=='0'){ echo "Free";} else { echo "Paid"; } ?></small> <div>        <b>Mode:</b> <?php $course_mode=$CouseLists['course_mode']; if($course_mode=='0'){ echo "Offline";} else { echo "Online"; }
                                        ?> </div> <a href="<?php echo base_url(); ?>Portal/Topic/<?php echo $CouseLists['course_id'];?>">Start Now <i class="bx bx-right-arrow-alt fs-5 align-middle"></i></a></div>
                                        <div><small style="font-size: 11px;">Watch preview before enrolling this Course</small></div>
                     </div>
                 <?PHP }?>       
                    
                </div>
                
                
            </div>
        </div>
    </section>




</main><!-- End #main -->
