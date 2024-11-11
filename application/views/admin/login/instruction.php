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
        <title>WELCOME TO SAUDI NURSES ASSOCIATION EXAM</title>
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

                   
                    <div class="col-md-12 login-container bs-reset">
                        <h3><center>WELCOME TO SAUDI NURSES ASSOCIATION EXAM</center></h3>
                        <div class="login-content">
                            
                            <div class="text-left" style="direction: rtl;">
                                   <p style="direction: rtl;text-align: right;">   <b >                 الإرشادات والتعليمات الخاصة للاختبار : </b></p>
                                <ul style="direction: rtl;text-align: right;">
                                    <li>
                                       	وقت الاختبار محدد ب 120 دقيقة  (ساعتان)، ويلزم التسليم قبل انتهاء المؤقت الزمني.
                                    </li>
                                    <li>
                                       عند انتهاء الوقت الزمني سيتم احتساب الأسئلة الغير مجابة خاطئة.
                                    </li>
                                    <li>
                                       	عدد الأسئلة (100 سؤال).
                                    </li>
                                    
                                    <li>
                                       	أسئلة الاختبار هي "الاختيار من متعدد" ويجب عليك اختيار الإجابة الاصح
                                    </li>
                                    <li>
                                       	درجة الاجتياز في الاختبار: 70% . 
                                    </li>
                                    <li>
                                       	لديك ثلاث محاولات في حال عدم اجتيازك للاختبار.
                                    </li>
                                    
                                    <li>
                                       	بعد اجتيازك للاختبار سوف تحصل على شهادة إتمام الاختبار.
                                    </li>
                                    <li>
                                       	عند انقطاع الانترنت خلال تأدية الاختبار، تجنب اغلاق المتصفح او الخروج منه خلال اصلاح الانقطاع لكي لا تفقد فرصة اكمال الاختبار.
                                    </li>
                                    
                                     <li>
                                   	يجب قراءة السؤال قراءة دقيقة متأنية، لأنه لن يسمح بالعودة للسؤال مرة أخرى للمراجعة أو التعديل بعد الإجابة عنه.
                                    </li>
                                     <li>
                                      	عند بلوغ السؤال الأخير ستلاحظ اختفاء زر التالي، وسيظهر زر انهاء الاختبار . قم بالضغط عليه لإنهاء الاختبار وتسليم الإجابات.
                                    </li>
                                    
                                </ul>                              
                                   <p style="direction: rtl;text-align: right;"> <b>الأمانة العلمية في الإجابة، واستشعار الرقابة الذاتية. </b><p>
                                <p style="direction: rtl;text-align: right;">إقرار: أقر بأني اطلعت على تعليمات الاختبار، وأقر بأني سألتزم بالتعليمات ولن أقوم بتسريب أو تصوير أي جزء من الاختبار، وفي حال تبين خلاف ذلك أتعرض لعقوبة الحرمان وإلغاء جميع النتائج السابقة.</p>
                                  <div class="form-group text-right">
                                        <a href="<?php echo base_url(); ?>Portal/Profile" class="btn blue btn-block btn-lg fill">قبول </a>
                                         
                                    </div>
                            </div>
                            
                            <div class="text-left">
                                <b>Test Instructions: </b>
                                <ul>
                                    <li>
                                        Timed test: This test has a limit of 120 minutes (2 hours).
                                    </li>
                                    <li>
                                        Timer Setting: This test will save and submit automatically when the time expires.
                                    </li>
                                    <li>
                                        Number of questions: (100 questions).
                                    </li>
                                    
                                    <li>
                                       The test questions: (multiple choices).
                                    </li>
                                    <li>
                                        Passing score in the test: 70%.
                                    </li>
                                    <li>
                                        You have three attempts in case you do not pass the test.
                                    </li>
                                    
                                    <li>
                                        After you pass the test, you will get a certificate of completion of the test.
                                    </li>
                                    <li>
                                        When the Internet is interrupted during the test, avoid closing or exiting the browser, so as not to lose the opportunity to complete the test.
                                    </li>
                                    
                                     <li>
                                     The question must be read carefully, because it will not be allowed to return to the question again for review or modification after answering it.
                                    </li>
                                     <li>
                                       When you reach the last question, you will notice the disappearance of the Next button, and the End Exam button will appear. Click on it to finish the test and submit the answers.
                                    </li>
                                    
                                </ul>                              
                                <p> <b>Remarks and Endorsements: </b></p>
                                <p>I certify that I have read the test instructions, and I declare that I will abide by the instructions and I will not publish or photograph any part of the test, and if it turns out otherwise, I will be subject to the penalty of deprivation and the cancellation of all previous results. </p>
                                  <div class="form-group text-right">
                                        <a href="<?php echo base_url(); ?>Portal/Profile" class="btn blue btn-block btn-lg fill">Accept </a>
                                         
                                    </div>
                            </div>
                           
                            <!-- END FORGOT PASSWORD FORM -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
      