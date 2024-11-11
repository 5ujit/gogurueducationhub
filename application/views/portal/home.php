 <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 class="mb-3">Professional high quality educational services</h1>
<!--          <ul>
              
              <li>Get skilled First </li>
              <li>Assistance for Placement  </li>
              <li>Get Placed or received a Salary increase  </li>
              <li>Pay Later  </li>
          </ul>
          <br>-->
          <ul>
              <li><b>Get skilled with our  certificate courses  </b></li>
              <li><b>Very reasonable priced  fees   </b></li>
              <li><b>Live Classes </b></li>
              <li><b>Placement  assistance from our team  </b></li>
              <li><b>Get hikes   </b></li>
              <li><b>Experienced Mentors </b></li>
              <li><b>Founder and Mentor - Mr. Vinod Gupta with 30 years of working experience in HR /Financial Services/Sales and Marketing </b> </li>
          </ul>
<!--          <p>GoGuru Education Hub was founded in 2022 to offer professional, high-quality online educational certificates that meet industry requirements and are affordable for the masses. We firmly believe that there is a scarcity of jobs , but not a scarcity of jobs in good companes for skilled people.<p>
<p>
      With our office located in Mumbai Suburban – Nalasopara, we offer the widest range of practical skill-building training programs.</p>
        -->
          <div>
           <!-- <a href="<?php echo base_url(); ?>Portal/Course/1" class="btn-get-started">Get Started <i class='bx bx-right-arrow-alt fs-5 align-middle'></i></a>-->
              <a href="<?php echo base_url(); ?>webinar" class="btn-get-started">Register for free live webinar  <i class='bx bx-right-arrow-alt fs-5 align-middle'></i></a>
          </div>

        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <img src="<?php echo base_url(); ?>portal/assets/img/banner.jpg" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  
  <main id="main">



    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Courses</h2>
          <p>"We provide certified training for both professionals and non-professionals across various domains. Initially, we are launching our first product, and in the coming days, we will be launching more such courses on other domains as well."</p>
        </div>


        <ul class="nav nav-tabs mb-4 border-bottom border-primary">
        <?PHP foreach($CategoryList as $CategoryLists) { 
             $category_id=$CategoryLists['category_id'];
             $totalCourses = $this->Model->getSqlData("SELECT count(*) as tot FROM rm_admin_category_course_details WHERE status='1' AND category_id='$category_id'");

            ?>
            
  <li class="nav-item">
   <h4 class="title align-items-start mb-0"> <a class="ms-5 ps-5 pe-5 pb-3 pt-3 nav-link bg-primary text-white" aria-current="page" href="index.html"><?Php echo $CategoryLists['category_name'];?> (<?php echo $totalCourses[0]['tot'];?>)</a></h4>
  </li>
        <?php }
        
        $CouseList= $this->Model->getSqlData("SELECT * FROM rm_admin_category_course_details WHERE status='1' AND category_id='1'");

        ?>
 
</ul>

           <div class="row">
                 <?PHP foreach ($CouseList as $CouseLists) { 
          $image_id=$CouseLists['jpg_image_id'];
          $course_image_path = $this->Model->ImageDetails('1',$image_id);
          ?> 
          <div class="col d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
          
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

           
                 <?php } ?>



              

         

        </div>


      </div>
    </section><!-- End Services Section -->


    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Our Mission</h2>
          <p>It has been our consistent endeavor to provide quality education to learners.</p>
        </div>

<p>
 Our aim at GoGuru Education Hub is to help one lakh people get placed in entry-level and mid-level jobs in reputed companies by improving their skills as per industry requirements. We achieve this by imparting online certificate training on various subjects with a very reasonable fee, so that candidates can improve their skills and quickly get placed in the job market or become self-employed.</p>

<p>
    <u><b>We reserve 25% of the seats for needy students who are unable to pay the fees, so they can take the course for free and later become a contributing alumni member."
</b></u></p>
      </div>
    </section><!-- End F.A.Q Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Team</h2>
          <p>Our Founder and Mentors</p>
        </div>

        <div class="row d-flex justify-content-center">

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="member">
              <img src="<?php echo base_url(); ?>portal/assets/img/team/team-1.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Vinod Gupta </h4>
                  <span>Founder</span>
                </div>
                <div class="social">
                  <a href="https://www.linkedin.com/in/vinod-gupta-65406046" target="_blank"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="member">
              <img src="<?php echo base_url(); ?>portal/assets/img/team/team-2.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Geeta Chaudhary</h4>
                  <span>Co- Founder</span>
                </div>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          
    

        </div>

      </div>
    </section><!-- End Team Section -->
    
    <section id="test" class="test">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Testimonials </h2>
          <p>Users testimonials </p>
        </div>

        <div class="row d-flex">
<div class="col-md-4">
          <div class="vedio-container">

<iframe width="100%" height="250" src="https://www.youtube.com/embed/DJpI1J5FwqY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
</div>


          

          
    

        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Clients Section
    <section id="clients" class="clients section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Our Corporate Partners</h2>
          <p>We are working as Consultants/Recruiters with companies like</p>
        </div>

        <div class="clients-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="<?php echo base_url(); ?>portal/assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo base_url(); ?>portal/assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo base_url(); ?>portal/assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo base_url(); ?>portal/assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo base_url(); ?>portal/assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
         
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Clients Section -->

   
  </main><!-- End #main -->