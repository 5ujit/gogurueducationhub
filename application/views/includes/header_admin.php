<!DOCTYPE html>
<html lang="en" ng-app="RVLabData">
    <?PHP
    $admin_name = $this->input->cookie('admin_name', TRUE);
    $module_id_list = $this->input->cookie('module_id_list', TRUE);

    $module_id_lists = explode(',', $module_id_list);
    $user_type_id = $this->input->cookie('user_type_id', TRUE);
    
    $admin_language_id = $this->input->cookie('admin_language_id', TRUE);
    
    $UserTypedata = $this->Model->getSqlData("SELECT * FROM rm_admin_user_type_details WHERE user_type_id='$user_type_id'");
    if (!empty($UserTypedata)) {
        $user_type = $UserTypedata[0]['user_type'];
    } else {
        $user_type = "NA";
    }



    if ($user_type_id == '1') {
        $module_id_list = "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,17";
        $module_id_lists = explode(',', $module_id_list);
    }
     if ($user_type_id == '2') {
        $module_id_list = "50";
        $module_id_lists = explode(',', $module_id_list);
    }
    
    function curPageURLS() {

    $pageURL = 'http';

    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") {

        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];

    } else {

        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

    }

    return $pageURL;

}



$url_type = curPageURLS();



$details_url_type = str_replace(":443", "", $url_type);

//$final_meta_url = str_replace("http", "https", $details_url_type);



 





if ($url_type == 'http://www.kapl.org.sa/') {

    redirect("https://www.kapl.org.sa/");

}



if ($url_type == 'http://triumphapproved.in/') {

    redirect("https://www.triumphapproved.in/");

}

if ($url_type == 'http://www.triumphapproved.in/') {

    redirect("https://www.triumphapproved.in/");

}



if ($url_type == 'https://triumphapproved.in/') {

    redirect("https://www.triumphapproved.in/");

}

    ?>



    <html lang="en">
        <!--<![endif]-->
        <!-- BEGIN HEAD -->

        <head>
            <meta charset="utf-8" />
              <title>GOGURU EDUCATION HUB- ADMIN SECTION</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1" name="viewport" />
            <meta content="" name="description" />
            <meta content="" name="author" />
            <!-- BEGIN GLOBAL MANDATORY STYLES -->
            <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
            <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/layouts/layout4/css/layout.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/layouts/layout4/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color" />
            <link href="<?php echo base_url(); ?>assets/layouts/layout4/css/custom.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>js/summernote/summernote-bs4.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>css/rama.css">
            <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
            <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>images/apple-icon-60x60.png">
            <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>images/apple-icon-72x72.png">
            <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>images/apple-icon-76x76.png">
            <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>images/apple-icon-114x114.png">
            <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>images/apple-icon-120x120.png">
            <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>images/apple-icon-144x144.png">
            <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>images/apple-icon-152x152.png">
            <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>images/apple-icon-180x180.png">
            <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url(); ?>images/android-icon-192x192.png">
            <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>images/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>images/favicon-96x96.png">
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>images/favicon-16x16.png">
            <link rel="manifest" href="<?php echo base_url(); ?>images/manifest.json">
            <meta name="msapplication-TileColor" content="#ffffff">
            <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>images/ms-icon-144x144.png">
            <meta name="theme-color" content="#ffffff">


        </head>
        <!-- END HEAD -->
<?PHP
$admin_name = $this->input->cookie('admin_name', TRUE);
?>
        <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="<?php echo base_url(); ?>">
                            <img src="<?php echo base_url(); ?>img/logo.png" alt="logo" class="logo-default"  style="width:90%;"/> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
                       data-target=".navbar-collapse"> </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN PAGE ACTIONS -->
                    <!-- DOC: Remove "hide" class to enable the page header actions -->

                    <!-- END PAGE ACTIONS -->
                    <!-- BEGIN PAGE TOP -->
                    <div class="page-top">

                        <ul class="nav navbar-nav pull-right">
                            
                              
                            <li class="separator hide"> </li>
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                   data-close-others="true">
                                    <span class="username username-hide-on-mobile"> <?php echo ucfirst($admin_name) ?> </span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    <i class="fa fa-user" aria-hidden="true" style="color:#D57E0D;font-size: 20px;"></i> 
                                    <i class="fa fa-arrow-down" aria-hidden="true" style="color:#D57E0D;font-size: 15px;"></i>

                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                      <?php if ($user_type_id=='1') { ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>User/ChangePassword">
                                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>Change Password </a>
                                    </li> 
                                      <?PHP  } ?>
                                     <?php if ($user_type_id=='2') { ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>Portal/Profile">
                                            <i class="fa fa-user-secret" aria-hidden="true"></i>Profile </a>
                                    </li> 
                                      <?PHP  } ?>
                                    <li>
                                        <?php if ($user_type_id=='1') { ?>
                                        <a href="<?php echo base_url(); ?>Login/Logout">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Log Out </a>
                                        <?php } ?>
                                         <?php if ($user_type_id=='2') { ?>
                                        <a href="<?php echo base_url(); ?>Login/TLogout">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Log Out </a>
                                        <?php } ?>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->

                        </ul>
                        <!-- END TOP NAVIGATION MENU -->
                    </div>
                    <!-- END PAGE TOP -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">

                    <div class="page-sidebar navbar-collapse collapse">

                        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true"
                            data-slide-speed="200" style="height: 600px;">


                            <?PHP
                            if (in_array("2", $module_id_lists)) {
                                ?>            
                                <li class="nav-item <?php if (empty($mcategory)) {
                                    $mcategory = '';
                                } else {
                                    echo $mcategory;
                                } ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-sitemap" aria-hidden="true"></i>

                                        <span class="title">Masters</span>
                                        <span class="arrow open"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item <?php if (empty($category)) {
                                    $category = '';
                                } else {
                                    echo $category;
                                } ?>">
                                            <a href="<?php echo base_url(); ?>Category" class="nav-link">
                                                <span class="title"> Category </span>
                                            </a>
                                        </li>

                                        <li class="nav-item <?php if (empty($mcourse)) {
                                    $mcourse = '';
                                } else {
                                    echo $mcourse;
                                } ?>">
                                            <a href="<?php echo base_url(); ?>Course" class="nav-link">
                                                <span class="title">Course</span>
                                            </a>
                                        </li>
                             <li class="nav-item <?php if (empty($topics)) {
                                    $topics = '';
                                } else {
                                    echo $topics;
                                } ?>">
                                            <a href="<?php echo base_url(); ?>Course/Topics" class="nav-link">
                                                <span class="title">Topics</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            <?php } ?>
                                

                                
                                        <?PHP if (in_array("17", $module_id_lists))
  {
   ?>            
                    <li class="nav-item <?php if (empty($portal)) {$portal = '';} else { echo $portal;} ?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                           <i class="fa fa-bars" aria-hidden="true"></i>

                            <span class="title">Portal</span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                             <li class="nav-item <?php if (empty($puser)) {$puser = '';} else { echo $puser;} ?>">
                                <a href="<?php echo base_url(); ?>Admin/User" class="nav-link ">
                                    <span class="title">Users</span>
                                    
                                </a>
                            </li>
                            
                            <li class="nav-item <?php if (empty($pay)) {$pay = '';} else { echo $pay;} ?>">
                                <a href="<?php echo base_url(); ?>Admin/Payment" class="nav-link ">
                                    <span class="title">Payment</span>
                                    
                                </a>
                            </li>

                           <li class="nav-item <?php if (empty($web)) {$web = '';} else { echo $web;} ?>">
                                <a href="<?php echo base_url(); ?>Admin/Webinars" class="nav-link ">
                                    <span class="title">Webinars</span>
                                    
                                </a>
                            </li>
                            
                               <li class="nav-item <?php if (empty($cont)) {$cont = '';} else { echo $cont;} ?>">
                                <a href="<?php echo base_url(); ?>Admin/Contact" class="nav-link ">
                                    <span class="title">Contact Us</span>
                                    
                                </a>
                            </li>
                             
                           
                           
                        </ul>
                    </li>
                    
         
  <?php } ?>   

                    <?PHP
if (in_array("15", $module_id_lists)) {
    ?>                    
                                <li class="nav-item <?php if (empty($user)) {
        $user = '';
    } else {
        echo $user;
    } ?>">
                                    <a href="<?php echo base_url(); ?>Admin/User" class="nav-link">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                                        <span class="title">User</span>
                                    </a>
                                </li>

<?php } ?>  
                                
                        </ul>
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
