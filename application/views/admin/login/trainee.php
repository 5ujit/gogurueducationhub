<?PHP

//echo $lang;
function curPageURL() {
    $pageURL = 'http';
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

$url_type = curPageURL();
//echo 'URL Type : '.$url_type;

if ($url_type == 'https://sna-exam.com/trainee') {
    redirect("https://www.sna-exam.com/trainee");
}

      $admin_language_id = $this->input->cookie('admin_language_id', TRUE);
      if($admin_language_id==''){
         $admin_language_id='2'; 
      }
      if($admin_language_id=='2') { 
          $arabic='<span style="text-decoration-line: underline;text-decoration-style: solid;font-weight: bold;"> Arabic</span>';
          $english='English';
      }
      else {
           $english='<span style="text-decoration-line: underline;text-decoration-style: solid;font-weight: bold;"> English</span>';
         $arabic ='Arabic';
      }
?>

<style>
  
    .error_text {
        font-size: 13px;
        color: #CC192D;
    }
.pwdFld{ position:relative;}
.spwd{position: absolute;top: 35px;right: 10px;cursor: pointer;}
    

    
    .btn.fill{    z-index: 0;    transition: color 0.3s;    position: relative;
    overflow: hidden;display: inline-block;vertical-align: middle;text-align: center;}

.btn.fill::after{
    content: '';
    position: absolute;
    z-index: -1;
    transition: width 0.3s, opacity 0.3s;
    width: 0;
    height: 530px;
    top: 50%;
    left: 50%;
    opacity: 0;
    background: #04825f;
    transform: translate(-50%, -50%) rotate(45deg);
    transform: translate3d(-50%, -50%, 0) rotate(45deg);
    backface-visibility: hidden;

}

.btn.fill:hover:after, .btn.fill:active:after, .btn.fill:focus:after{
    width: 100%;
    opacity: 1; }

.btn.fill:hover:before, .btn.fill:focus:before, .btn.fill:active:before{
  animation: animate-generic 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
    
</style>

<!--[if !IE]><!-->
<html lang="en"  ng-app="userlogin">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>SAUDI NURSES ASSOCIATION- ADMIN SECTION</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
              type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
              type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url(); ?>assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url(); ?>assets/pages/css/login-5.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/layouts/layout4/css/custom.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>images/favicon.png">
    </head>
    <!-- END HEAD -->

    <body class="login">
        <!-- BEGIN : LOGIN PAGE 5-2 -->
        <div class="user-login-5">
            <div class="cust-container" ng-controller="login_validate">
                <div class="col-md-12 text-right">
                        <a href="javascript:;" onclick="LanguageCovert(2)">
                                            <img alt="" src="../assets/global/img/flags/ar.png"> 
                                            
                                            <?php echo $arabic ;?> </a>
                        <a href="javascript:;" onclick="LanguageCovert(1)">
                                            <img alt="" src="../assets/global/img/flags/us.png"> <?php echo $english ;?> </a>
                    </div>
                <div class="row bs-reset">
                    
                    <div class="col-md-6 bs-reset">
                        <img class="img-responsive" src="<?php echo base_url(); ?>img/login-img.jpeg" alt="">
                        
                    </div>
                   
                    
                    <div class="col-md-6 login-container bs-reset">

                        <div class="login-content">
                            <div class="text-center">
                                <!-- <p><img class="" src="<?php echo base_url(); ?>assets/pages/img/login/login-invert.png" /></p> -->
                                <h3>Welcome to Critical Care program Exam</h3> <br><br><br>
                                  <?php if($admin_language_id=='1') { ?>
                                <h4>To start the Exam login with Saudi National ID</h4> 
                                  <?PHP } else { ?>
                                  <h4 style="direction: rtl;">لبدء الاختبار، سجل الدخول برقم الهوية الوطنية</h4>
                               
                                  <?php } ?>
                                
                            </div>
                            <form ng-submit="submitForm()" method="post" ng-show="LoginFormDiv" AUTOCOMPLETE="off">
                                    <div class="form-group">
                                    
                                       <input type="text" class="form-control"  name="user_id" id="user_id" aria-describedby="UserName" placeholder="National ID">
                                        <span id="Errorlogin" class="error_text"></span>                                   
								   </div>
                                     
                                     
                                 
                                    <div class="form-btn">
                                       <button type="submit" class="btn blue btn-block btn-lg fill">Login</button>
                                    </div>
                                       </form>
                            <br><br><br><br><br><br>
                            <!-- END FORGOT PASSWORD FORM -->
                        </div>

                    </div>
                     
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-2 -->
        <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
    <![endif]-->
          <!-- BEGIN CORE PLUGINS -->
         <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
<script src="<?php echo base_url("js/angular-1.6.js"); ?>"></script>
   
    <script>
        var app = angular.module("userlogin", []);

        var pathname = "http://localhost/sna/";
        //var pathname = "https://www.sna-exam.com/";

        app.controller('login_validate', function($scope, $http, $location, $timeout) {
             $scope.LoginFormDiv=true;
         
            var ReturnEmailID = '';
            var count = 0;
            var ReturnMobileNumber = '';
            $scope.regEx = "/^[0-9]{10,10}$/";
            var emailrgx = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$|^$/;
            var numbers = /[^0-9]/;
            $scope.submitForm = function() {
              
                var user_id = angular.element(document.querySelector('[name="user_id"]')).val().trim();
              
                
                count = 0;
                if (user_id == '' || user_id == null || user_id == 'undefined') {
                   
                    angular.element(document.querySelector('[id="Errorlogin"]')).html('').append("Please enter national id.");
                    count++;
                } else {
                    angular.element(document.querySelector('[id="Errorlogin"]')).html('').append("");
                }
                
                if (count > 0) {
                    
                    return false;
                } else {

                    return $http({
                        url: pathname + 'Login/CheckTLogin',
                        cache: false,
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        },
                        data: $.param({
                            user_id: user_id
                            
                        })
                    }).then(function successCallback(responce) {

                        console.log(responce);
                        if (responce.data.status == true) {
                            angular.element(document.querySelector('[id="Errorlogin"]')).html("");
                            location.href = pathname + "Portal/TProfile";
                            //location.href=pathname+"Login/Country";

                        } else {
                             <?PHP  if($admin_language_id=='1') {   ?>
                            angular.element(document.querySelector('[id="Errorlogin"]')).html('Sorry, you are not eligible to take this exam. Please be noted that this exam are for the graduates of the Critical Care Nursing Qualification Program of the Ministry of Health.');
                             <?php } else { ?>
                                  angular.element(document.querySelector('[id="Errorlogin"]')).html('عذرًا ، أنت غير مؤهل لإجراء هذا الاختبار.  هذا الاختبار مخصص لخريجي برنامج تأهيل تمريض الرعاية الحرجة التابع لوزارة الصحة.');
                             <?PHP } ?>
                        }
                    }, function errorCallback(responce) {
                        //console.log(responce);
                    });
                }
            };

        


        });
    </script>
<script src="<?php echo base_url(); ?>js/sweet/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url(); ?>js/sweet/core.js"></script>
<script src="<?php echo base_url(); ?>js/sweet/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/sweet/sweetalert2.min.css">
<script>
    function LanguageCovert(admin_language_id)
    {

        
        jQuery.ajax({
            type: "POST",
            url: pathname + "Login/SetCookies",
            data: 'admin_language_id=' + admin_language_id,
            beforeSend: function () {
            },
            success: function (res) {
            location.reload();
            }
        });
        return false;
    }
$("body").on('click','.toggle-password',function(){
    $(this).toggleClass("fa-eye fa-eye-slash");
    var divid=jQuery(this).attr('divid');
    var input = $("#"+divid).attr("type");
    if (input == "password") {
        $("#"+divid).attr("type", "text");
    } else {
        $("#"+divid).attr("type", "password");
    }
});
</script>
</body>

</html>
        