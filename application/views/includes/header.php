<!DOCTYPE html>
<?php 
$catList=$this->Model->getSqlData("SELECT * FROM rm_admin_category_details WHERE status='1'");
 $user_id = $this->input->cookie('user_id', TRUE);
 $full_name = $this->input->cookie('full_name', TRUE);
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GoGuru Education Hub - Professional high quality educational services</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>portal/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>portal/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>portal/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>portal/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>portal/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>portal/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>portal/assets/css/style.css" rel="stylesheet">
 
   <link href="<?php echo base_url(); ?>css/guru.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="<?php echo base_url(); ?>"><span><img src="<?php echo base_url(); ?>portal/assets/img/logo.png"/></span></a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link active" href="<?php echo base_url(); ?>">Home</a></li>
          <li><a class="nav-link" href="<?php echo base_url(); ?>about-us">About Us</a></li>
          

<li class="dropdown"><a href="#"><span>Courses</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <?PHP foreach($catList as $catLists) { ?>
              <li><a href="<?php echo base_url(); ?>Portal/Course/<?php echo $catLists['category_id'];?>"><?Php echo $catLists['category_name'];?></a></li>
                <?PHP } ?>
              
             
            </ul>
          </li>





          <li><a class="nav-link" href="<?php echo base_url(); ?>webinar">Webinars</a></li>
          <li><a class="nav-link" href="#">Corporates</a></li>
          <li><a class="nav-link" href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
          <?php if ($user_id=='') { ?>
          <li><a class="getstarted scrollto" href="<?php echo base_url(); ?>login">Log in</a></li>
          <?php } ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
               <?php if ($user_id!='') { ?>
<nav id="navbar" class="navbar">
        <ul>
         
         
          <li >Welcome,</li>

<li class="dropdown"><a class="active ps-1" href="#"><span> <?php echo $full_name; ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
<!--              <li><a href="#">My Courses</a></li>-->
             
              <li><a href="<?php echo base_url(); ?>Portal/ChangePassword">Change Password</a></li>
              <li><a href="<?php echo base_url(); ?>Portal/Logout">Logout</a></li>
              </ul>
          </li>





      
  
           
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
               <?php } ?>
    </div>
  </header><!-- End Header -->