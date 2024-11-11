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

if ($url_type == 'http://www.ramahospital.com/Login') {
    redirect("https://www.ramahospital.com/Login");
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
        <title>GOGURU EDUCATION HUB- ADMIN SECTION</title>
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
                <div class="row bs-reset">

                    <div class="col-md-6 bs-reset">
                        
                        <img class="img-responsive" src="<?php echo base_url(); ?>img/logo.png" alt="" style="margin-top:200px;margin-left:40px;  ">
                    </div>
                    <div class="col-md-6 login-container bs-reset">

                        <div class="login-content">
                            <div class="text-center">
                             
                                <h3>WELCOME TO GOGURU EDUCATION HUB</h3> <br><br><br>
                              
                            </div>
                            <form ng-submit="submitForm()" method="post" ng-show="LoginFormDiv" AUTOCOMPLETE="off">
                                    <div class="form-group">
                                       <label for="UserName">User Name</label>
                                       <input type="text" class="form-control"  name="user_email" id="user_email" aria-describedby="UserName" placeholder="User Name">
                                        <span id="Erroremail" class="error_text"></span>                                   
								   </div>
                                     
                                     <div class="form-group pwdFld" >
                                       <label for="Password">Password</label>
                                        
                                       <input type="password" class="form-control"  name="user_password" id="user_password" aria-describedby="Password" placeholder="Password"> <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password spwd" divid="user_password"></span>
                                   
                                        <span id="Errorpassword" class="error_text" ></span>
                                     <span id="Errorlogin" class="error_text" ></span>
								   </div>
                                    
                                    <div class="form-group text-right">
                                        <a href="#" class="styled__link" ng-click="ShowForm(1);">Forgot Password?</a>
                                    </div>
                                    <div class="form-btn">
                                       <button type="submit" class="btn blue btn-block btn-lg fill">Login</button>
                                    </div>
                                       </form>
                            <form ng-submit="submitForgotForm()" method="post" ng-show="ForgotDiv" AUTOCOMPLETE="off">
                                    <div class="form-group">
                                       <label for="UserName">User Name</label>
                                       <input type="text" class="form-control"  name="forgot_user_email" id="forgot_user_email" aria-describedby="UserName" placeholder="User Name">
<span id="Errorforgot_user_email" class="error_text"></span>                                   
								   </div>
                                     
                                     
                                    <div class="form-group text-right">
                                        <a href="#" class="styled__link" ng-click="ShowForm(2);">Back to Admin Login </a>
                                    </div>
                                    <div class="form-btn">
                                       <button type="submit" class="btn blue btn-block btn-lg fill">Login</button>
                                    </div>
                                       </form>
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

        var pathname = "http://localhost/goguru/";
        //var pathname = "https://www.ramahospital.com/";

        app.controller('login_validate', function($scope, $http, $location, $timeout) {
             $scope.LoginFormDiv=true;
            $scope.ShowForm = function (id) {
                if(id=='1'){
                $scope.ForgotDiv=true;
                $scope.LoginFormDiv=false;
            }
             if(id=='2'){
                $scope.ForgotDiv=false;
                $scope.LoginFormDiv=true;
            }
            
                };
            var ReturnEmailID = '';
            var count = 0;
            var ReturnMobileNumber = '';
            $scope.regEx = "/^[0-9]{10,10}$/";
            var emailrgx = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$|^$/;
            var numbers = /[^0-9]/;
            $scope.submitForm = function() {
              
                var email = angular.element(document.querySelector('[name="user_email"]')).val().trim();
              
                var password = angular.element(document.querySelector('[name="user_password"]')).val().trim();
                
                count = 0;
                if (email == '' || email == null || email == 'undefined') {
                      
                    angular.element(document.querySelector('[id="Erroremail"]')).html('').append("Please enter email id!");
                    count++;
                } else {
                    angular.element(document.querySelector('[id="Erroremail"]')).html('').append("");
                }
                if (password == '' || password == null || password == 'undefined') {
                    
                    angular.element(document.querySelector('[id="Errorpassword"]')).html('').append("Please enter Password!");
                    count++;
                } else {
                    angular.element(document.querySelector('[id="Errorpassword"]')).html('').append("");
                }
                if (count > 0) {
                    
                    return false;
                } else {

                    return $http({
                        url: pathname + 'Login/CheckLogin',
                        cache: false,
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        },
                        data: $.param({
                            email: email,
                            password: password
                        })
                    }).then(function successCallback(responce) {

                        console.log(responce);
                        if (responce.data.status == true) {
                            angular.element(document.querySelector('[id="Errorlogin"]')).html("");
                            location.href = pathname + "Course";
                            //location.href=pathname+"Login/Country";

                        } else {
                            angular.element(document.querySelector('[id="Errorlogin"]')).html('Invalid Email/Password');
                        }
                    }, function errorCallback(responce) {
                        //console.log(responce);
                    });
                }
            };

         $scope.submitForgotForm = function() {
              
                var email = angular.element(document.querySelector('[name="forgot_user_email"]')).val().trim();
              
               
                
                count = 0;
                if (email == '' || email == null || email == 'undefined') {
                      
                    angular.element(document.querySelector('[id="Errorforgot_user_email"]')).html('').append("Please enter email id!");
                    count++;
                } else {
                    angular.element(document.querySelector('[id="Errorforgot_user_email"]')).html('').append("");
                }
               
                if (count > 0) {
                    
                    return false;
                } else {

                    return $http({
                        url: pathname + 'Login/CheckForgotLogin',
                        cache: false,
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                        },
                        data: $.param({
                            email: email
                            
                        })
                    }).then(function successCallback(responce) {

                        console.log(responce);
                        if (responce.data.status == true) {
                            angular.element(document.querySelector('[id="Errorlogin"]')).html("");
                             swal(
                            'A reset password link has been sent to your registered email account.',
                            'Please click on the link that has been sent to your registered email account to reset your password.',
                            'success'
                          ).then(function() {
                                          location.href = pathname+'Login';
                        });

                        } else {
                            angular.element(document.querySelector('[id="Errorlogin"]')).html('Invalid Email');
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
        