

  <main id="main">

   <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Contact Us</h2>
          <ol>
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li>Contact Us</li>
          </ol>
        </div>

      </div>
    </section>

  
    

   
       <section id="services" class="services">
      <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
        
          <p>We'd Love to hear from you</p>
        </div>

<div class="row no-gutters">
<div class="col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
<div class="contact-wrap w-100 p-md-5 p-4">
<h3 class="mb-4">Get in touch</h3>
<form method="post" name="frmContact" id="frmContact" class="contactForm"  onsubmit="return validateContactForm(this);">

<div class="row">
<div class="mb-4">
<div class="form-group">
<label class="label mb-2" for="email">Full Name</label>
<input type="text" class="form-control" name="full_name" id="full_name" >
</div>
</div>

<div class="mb-4">
<div class="form-group">
<label class="label mb-2" for="email">Email Address</label>
<input type="text" class="form-control" name="email" id="email" >
</div>
</div>

<div class="mb-4">
<div class="form-group">
<label class="label mb-2" for="email">Mobile No</label>
<input type="text" class="form-control mnumber" name="mobile" id="mobile" maxlength="10">
</div>
</div>

<div class="col-md-6 mb-4">
<div class="form-group">
<label class="label mb-2" for="email">Course Interested</label>
<select id="courses_id" name="courses_id"  class="form-control">
<?php foreach($CourseList as $CourseLists) { ?>   
    <option value="<?php echo $CourseLists['course_id'] ;?>"><?php echo $CourseLists['course_name'] ;?></option> 
 <?php } ?>
</select>
</div>
</div>
<div class="col-md-12 mb-4">
<div class="form-group">
<label class="label mb-2" for="subject">Subject</label>
<input type="text" class="form-control" name="subject" id="subject"  >
</div>
</div>
<div class="col-md-12 mb-4">
<div class="form-group">
<label class="label mb-2" for="#">Message</label>
<textarea name="message" class="form-control" id="message" cols="30" rows="4"  ></textarea>
</div>
</div>
<div class="col-md-12 mb-4">
<div class="form-group">
<input type="submit" value="Send Message" class="btn btn-warning">
<div class="submitting"></div>
</div>
</div>
</div>
</form>
</div>
</div>
<div class="col-lg-4 col-md-5 d-flex align-items-stretch">
<div class="info-wrap bg-light shadow rounded w-100 p-md-5 p-4">
<h3>Let's get in touch</h3>
<p class="mb-4">We're open for any suggestion or just to have a chat</p>
<div class="dbox w-100 d-flex align-items-start">
<div class="icon d-flex align-items-center justify-content-center">
<span class="fa fa-map-marker"></span>
</div>
<div class="text pl-3">
<p><b>Address:</b> 310 C Sundaram complex Sundar Nagar,
Tuling Nalasopara East,
(Sub urban Mumbai) Pin 401209</p>
</div>
</div>
<div class="dbox w-100 d-flex align-items-center">
<div class="icon d-flex align-items-center justify-content-center">
<span class="fa fa-phone"></span>
</div>
<div class="text pl-3">
<p><b>Phone:</b> 8421028854 / 98920278934 / 8788669739 / 9146567780</p>
</div>
</div>
<div class="dbox w-100 d-flex align-items-center">
<div class="icon d-flex align-items-center justify-content-center">
<span class="fa fa-paper-plane"></span>
</div>
<div class="text pl-3">
<p><b>Email:</b> <a href="mailto:support@gogurueducationhub.com">support@gogurueducationhub.com</a></p>
</div>
</div>
<div class="dbox w-100 d-flex align-items-center">
<div class="icon d-flex align-items-center justify-content-center">
<span class="fa fa-globe"></span>
</div>
</div>
</div>
</div>
</div>



      </div>
    </section>
    
    

   
  </main><!-- End #main -->
