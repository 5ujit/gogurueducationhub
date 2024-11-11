 <main id="main">

   <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Change Password</h2>
          <ol>
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li>Sign in</li>
          </ol>
        </div>

      </div>
    </section>

  
    

   
       <section id="services" class="services">
      <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
       <h2>Change Password</h2>
          <p>Learn on your own time from top Mentors.</p>
        </div>


        <div class="d-flex justify-content-center">

<div class="card w-50">
  <div class="card-body">

<div class="contact-wrap p-md-5 p-4">
<form method="post" name="frmExternalLogin" id="frmExternalLogin" onsubmit="return validateChangePassword(this);"  class="contactForm" >

<div class="frm">
    
<div class="mb-4">
<div class="form-group">
<label class="label mb-2" for="email">New Password</label>
<input type="password" class="form-control" name="new_password" id="new_password">
</div>
</div>

<div class="mb-4">
<div class="form-group">
<label class="label mb-2" for="email">Reenter New Password</label>
<input type="password" class="form-control" name="re_new_password" id="re_new_password">
</div>
</div>



<div class="mb-4">
<div class="form-group">

<input type="submit" value="Submit" class="btn btn-warning">
<div class="submitting"></div>
</div>
</div>


<p class="text-end mb-4"><a href="#">Forgot Password?</a></p>


<p class="text-center">New to GoGuru?  <a href="<?php echo base_url(); ?>register">Sign up </a> </p>

</div>
</form>
</div>
</div>

</div>

</div>











      </div>
    </section>
    
    

   
  </main><!-- End #main -->
