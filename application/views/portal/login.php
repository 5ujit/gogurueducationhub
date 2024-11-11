 <main id="main">

   <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Sign in</h2>
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
       <h2> Sign in</h2>
          <p>Learn on your own time from top Mentors.</p>
        </div>


        <div class="d-flex justify-content-center">

<div class="card w-50">
  <div class="card-body">

<div class="contact-wrap p-md-5 p-4">
<form method="post" name="frmExternalLogin" id="frmExternalLogin" onsubmit="return validateExternalLoginForm(this);"  class="contactForm" >

<div class="frm">
<div class="mb-4">
<div class="form-group">
<label class="label mb-2" for="email">Email Address</label>
<input type="text" class="form-control" name="user_email" id="user_email" >
</div>
</div>

<div class="mb-4">
<div class="form-group">
<label class="label mb-2" for="email">Password</label>
<input type="password" class="form-control" name="user_password" id="user_password">
</div>
</div>



<div class="mb-4">
<div class="form-group">

<input type="submit" value="Log in" class="btn btn-warning">
<div class="submitting"></div>
</div>
</div>


<p class="text-end mb-4"><a href="<?php echo base_url(); ?>forgot">Forgot Password?</a></p>


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
