 <main id="main">

   <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Webinar </h2>
          <ol>
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li>Webinar </li>
          </ol>
        </div>

      </div>
    </section>

  
    

   
       <section id="services" class="services">
      <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
       <h2> Webinar</h2>
          <p>Register for free live webinar </p>
        </div>


        <div class="d-flex justify-content-center">

<div class="card w-50">
  <div class="card-body">

<div class="contact-wrap p-md-5 p-4">
<form method="post" name="frmMasterThesis" id="frmMasterThesis" class="contactForm"  onsubmit="return validateWebniarForm(this);">

<div class="frm">
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

<div class="mb-4">
<div class="form-group">
<label class="label mb-2" for="email">Courses</label>
<select id="courses_id" name="courses_id"  class="form-control" >
<?php foreach($CourseList as $CourseLists) { ?>   
    <option value="<?php echo $CourseLists['course_id'] ;?>"><?php echo $CourseLists['course_name'] ;?></option> 
 <?php } ?>
</select>
</div>
</div>

<div class="mb-4">
<div class="form-group">
<input type="submit" value="Submit" class="btn btn-warning">
<div class="submitting"></div>
</div>
</div>



</div>
</form>
</div>
</div>

</div>

</div>











      </div>
    </section>
    
    

   
  </main><!-- End #main -->