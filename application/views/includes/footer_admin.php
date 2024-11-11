﻿<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js"></script>
<link href="<?php echo base_url(); ?>css/uploadfile.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/angular-datepicker.css" rel="stylesheet"/>
<script>
    $('.mnumber').keypress(function (e) {
    var arr = [];
    var kk = e.which;
    for (i = 48; i < 58; i++)
        arr.push(i);
    if (!(arr.indexOf(kk) >= 0))
        e.preventDefault();

});
//var base_url = "https://www.ramahospital.com/";     
var base_url = "http://localhost/goguru/";

    
    jQuery(document).ready(function () {
        doProductImageUpload('');
        doImageUpload('');
        doBackImageUpload('');
        
       dowebpupload('');
       dojpg2upload('');
       dojpgupload('');
       
       mobiledowebpupload('');
       mobiledojpg2upload('');
       mobiledojpgupload('');
        

    }); /*End of document*/

 
    
    function doImageUpload(lastId) {

        var settings = {url: base_url + "admin/ajaxserviceimage", method: "POST", allowedTypes: "jpg,png,gif,jpeg,bmp,JPG,PNG", fileName: "myfile", multiple: false, /*dataType:'json',*/
            onSuccess: function (files, data, xhr) {
                var splData = data.split(',');
                var imgArr = splData[3].split(":");
                var imgId = imgArr[1].replace(/"/g, ''); //Replacing the "(double quotes) from string
                imgId = imgId.replace(/}/g, ''); //Replacing Last } braces

                var imgPathArr = splData[0].split(":");
                var imgPath = imgPathArr[1].replace(/"/g, '');
                var finalimgPath = "thumb_" + imgPath;
                //Replacing the "(double quotes) from string
                //console.log(imgPath);
                var comImagePath = base_url + "uploads/thumbs/" + finalimgPath;

                var image_list = jQuery("#park_image_id").val();
                var next_val = imgId + "," + image_list;
                jQuery("#imgstatus" + lastId).append('<div class="col-md-5" id="div_' + imgId + '"><img id="' + imgId + '" src=' + comImagePath + ' class="thumbnail img-responsive" style="width: 80px; margin-top: 5px; display: block;" /><button style="margin-left: 5px;" type="button" class="close" onclick="delImage(' + imgId + ');" id="button_' + imgId + '"><span aria-hidden="true">×</span></button></div></div></div>');

                $('#park_image_id').val(next_val);
                //alert(imgId);
            },
            onError: function (files, status, errMsg) {
                //console.log(files+'='+status+'='+errMsg);
                jQuery("#imgstatus" + lastId).append(errMsg);
            }
        }

        jQuery("#mulitplefileuploader" + lastId).uploadFile(settings);
    }

    function delImage(image_id) {
        var hotel_image = $('#park_image_id').val();
        var after = hotel_image.replace(image_id + ",", '');

        $('#park_image_id').val(after);
        $("#" + image_id).remove();
        $("#button_" + image_id).remove();
        $("#div_" + image_id).remove();

    }
    
    function delDocs(image_id) {
        var hotel_docs = $('#park_docs_id').val();
        var after = hotel_docs.replace(image_id + ",", '');
        $('#park_docs_id').val(after);
        $("#" + image_id).remove();
        $("#buttons_" + image_id).remove();
        $("#div_" + image_id).remove();
    }


    function delStoreImages(image_id) {
        var hotel_docs = $('#store_image_id').val();
        var after = hotel_docs.replace(image_id + ",", '');
        $('#store_image_id').val(after);
        $("#" + image_id).remove();
        $("#buttons_" + image_id).remove();
        $("#div_" + image_id).remove();
    }


    function doBackImageUpload(lastId) {
        var settings = {url: base_url + "admin/ajaxserviceimage", method: "POST", allowedTypes: "jpg,png,gif,jpeg,bmp,JPG,PNG", fileName: "myfile", multiple: false, /*dataType:'json',*/
            onSuccess: function (files, data, xhr) {
                var splData = data.split(',');
                var imgArr = splData[3].split(":");
                var imgId = imgArr[1].replace(/"/g, ''); //Replacing the "(double quotes) from string
                imgId = imgId.replace(/}/g, ''); //Replacing Last } braces

                var imgPathArr = splData[0].split(":");
                var imgPath = imgPathArr[1].replace(/"/g, '');  //Replacing the "(double quotes) from string
                var finalimgPath = "thumb_" + imgPath;
                //console.log(imgPath);
                //var comImagePath = base_url+"images/docs.png";
                var comImagePath = base_url + "uploads/thumbs/" + finalimgPath;
                var image_list = jQuery("#park_docs_id").val();
                var next_val = imgId + "," + image_list;
                jQuery("#imgstatus1" + lastId).append('<div class="col-md-6" id="div_' + imgId + '"><button style="margin-left: 5px;" type="button" class="close" onclick="delDocs(' + imgId + ');" id="buttons_' + imgId + '"><span aria-hidden="true">×</span></button><img id="' + imgId + '" src=' + comImagePath + ' class="thumbnail img-responsive" style="width: 70px; margin-top: 5px; display: block;" /></div></div></div>');
                $('#park_docs_id').val(next_val);


                //alert(imgId);
            },
            onError: function (files, status, errMsg) {
                //console.log(files+'='+status+'='+errMsg);
                jQuery("#imgstatus1" + lastId).append(errMsg);
            }
        }
        jQuery("#bmulitplefileuploader" + lastId).uploadFile(settings);
    }

    function doProductImageUpload(lastId) {

        var settings = {url: base_url + "admin/ajaxserviceimage", method: "POST", allowedTypes: "svg,jpg,png,gif,jpeg,bmp,JPG,PNG", fileName: "myfile", multiple: true, /*dataType:'json',*/
            onSuccess: function (files, data, xhr) {
                var splData = data.split(',');
                var imgArr = splData[3].split(":");
                var imgId = imgArr[1].replace(/"/g, ''); //Replacing the "(double quotes) from string
                imgId = imgId.replace(/}/g, ''); //Replacing Last } braces

                var imgPathArr = splData[0].split(":");
                var imgPath = imgPathArr[1].replace(/"/g, '');  //Replacing the "(double quotes) from string
                //console.log(imgPath);
                var finalimgPath = "thumb_" + imgPath;
                var comImagePath = base_url + "uploads/thumbs/" + finalimgPath;
                var image_list = jQuery("#store_image_id").val();
                var next_val = imgId + "," + image_list;
                jQuery("#imgstatus2" + lastId).append('<div class="col-md-6" id="div_' + imgId + '"><button style="margin-left: 5px;" type="button" class="close" onclick="delStoreImages(' + imgId + ');" id="buttons_' + imgId + '"><span aria-hidden="true">×</span></button><img id="' + imgId + '" src=' + comImagePath + ' class="thumbnail img-responsive" style="width: 70px; margin-top: 5px; display: block;" /></div></div></div>');
                $('#store_image_id').val(next_val);


                //alert(imgId);
            },
            onError: function (files, status, errMsg) {
                //console.log(files+'='+status+'='+errMsg);
                jQuery("#imgstatus2" + lastId).append(errMsg);
            }
        };

        jQuery("#pmulitplefileuploader" + lastId).uploadFile(settings);
    }
    
    // webp Image Section 
    
    function dowebpupload(lastId) {

        var settings = {url: base_url + "admin/ajaxwebpimage", method: "POST", allowedTypes: "webp", fileName: "myfile", multiple: false, /*dataType:'json',*/
            onSuccess: function (files, data, xhr) {
                var splData = data.split(',');
                var imgArr = splData[3].split(":");
                var imgId = imgArr[1].replace(/"/g, ''); //Replacing the "(double quotes) from string
                imgId = imgId.replace(/}/g, ''); //Replacing Last } braces

                var imgPathArr = splData[0].split(":");
                var imgPath = imgPathArr[1].replace(/"/g, '');
                var comImagePath = base_url + "uploads/webp/" + imgPath;
                var image_list = jQuery("#webp_image_id").val();
                var next_val = imgId + "," + image_list;
                jQuery("#webpimgstatus" + lastId).append('<div class="col-md-5" id="div_' + imgId + '"><button style="margin-left: 5px;" type="button" class="close" onclick="delwebpImage(' + imgId + ');" id="button_' + imgId + '"><span aria-hidden="true">×</span></button><img id="' + imgId + '" src=' + comImagePath + ' class="thumbnail img-responsive" style="width: 80px; margin-top: 5px; display: block;" /></div></div></div>');
                $('#webp_image_id').val(next_val);

            },
            onError: function (files, status, errMsg) {
                jQuery("#webpimgstatus" + lastId).append(errMsg);
            }
        };

        jQuery("#webpfileuploader" + lastId).uploadFile(settings);
    }
    
      function delwebpImage(image_id) {
        var hotel_image = $('#webp_image_id').val();
        var after = hotel_image.replace(image_id + ",", '');
        $('#webp_image_id').val(after);
        $("#" + image_id).remove();
        $("#button_" + image_id).remove();
        $("#div_" + image_id).remove();

    }

function dojpg2upload(lastId) {

        var settings = {url: base_url + "admin/ajaxjpg2image", method: "POST", allowedTypes: "jpf", fileName: "myfile", multiple: false, /*dataType:'json',*/
            onSuccess: function (files, data, xhr) {
                var splData = data.split(',');
                var imgArr = splData[3].split(":");
                var imgId = imgArr[1].replace(/"/g, ''); //Replacing the "(double quotes) from string
                imgId = imgId.replace(/}/g, ''); //Replacing Last } braces
                var imgPathArr = splData[0].split(":");
                var imgPath = imgPathArr[1].replace(/"/g, '');
                var comImagePath = base_url + "uploads/jpeg_2000/" + imgPath;
                var image_list = jQuery("#jpg2_image_id").val();
                var next_val = imgId + "," + image_list;
                jQuery("#jpg2imgstatus" + lastId).append('<div class="col-md-5" id="div_' + imgId + '"><button style="margin-left: 5px;" type="button" class="close" onclick="deljpg2Image(' + imgId + ');" id="button_' + imgId + '"><span aria-hidden="true">×</span></button><img id="' + imgId + '" src=' + comImagePath + ' class="thumbnail img-responsive" style="width: 80px; margin-top: 5px; display: block;" /></div></div></div>');
                $('#jpg2_image_id').val(next_val);

            },
            onError: function (files, status, errMsg) {
                jQuery("#jpg2imgstatus" + lastId).append(errMsg);
            }
        };

        jQuery("#jpg2fileuploader" + lastId).uploadFile(settings);
    }
    
      function deljpg2Image(image_id) {
        var hotel_image = $('#jpg2_image_id').val();
        var after = hotel_image.replace(image_id + ",", '');
        $('#jpg2_image_id').val(after);
        $("#" + image_id).remove();
        $("#button_" + image_id).remove();
        $("#div_" + image_id).remove();

    }
    
    function dojpgupload(lastId) {

        var settings = {url: base_url + "admin/ajaxjpgimage", method: "POST", allowedTypes: "jpg,png", fileName: "myfile", multiple: false, /*dataType:'json',*/
            onSuccess: function (files, data, xhr) {
                var splData = data.split(',');
                var imgArr = splData[3].split(":");
                var imgId = imgArr[1].replace(/"/g, ''); //Replacing the "(double quotes) from string
                imgId = imgId.replace(/}/g, ''); //Replacing Last } braces
                var imgPathArr = splData[0].split(":");
                var imgPath = imgPathArr[1].replace(/"/g, '');
                var comImagePath = base_url + "uploads/jpg/" + imgPath;
                var image_list = jQuery("#jpg_image_id").val();
                var next_val = imgId + "," + image_list;
                jQuery("#jpgimgstatus" + lastId).append('<div class="col-md-5" id="div_' + imgId + '"><button style="margin-left: 5px;" type="button" class="close" onclick="deljpgImage(' + imgId + ');" id="button_' + imgId + '"><span aria-hidden="true">×</span></button><img id="' + imgId + '" src=' + comImagePath + ' class="thumbnail img-responsive" style="width: 80px; margin-top: 5px; display: block;" /></div></div></div>');
                $('#jpg_image_id').val(next_val);

            },
            onError: function (files, status, errMsg) {
                jQuery("#jpgimgstatus" + lastId).append(errMsg);
            }
        };

        jQuery("#jpgfileuploader" + lastId).uploadFile(settings);
    }
    
      function deljpgImage(image_id) {
        var hotel_image = $('#jpg_image_id').val();
        var after = hotel_image.replace(image_id + ",", '');
        $('#jpg_image_id').val(after);
        $("#" + image_id).remove();
        $("#button_" + image_id).remove();
        $("#div_" + image_id).remove();

    }
    
    /// Mobile Section start Here 
    
        // webp Image Section 
    
    function mobiledowebpupload(lastId) {

        var settings = {url: base_url + "admin/ajaxwebpimage", method: "POST", allowedTypes: "webp", fileName: "myfile", multiple: false, /*dataType:'json',*/
            onSuccess: function (files, data, xhr) {
                var splData = data.split(',');
                var imgArr = splData[3].split(":");
                var imgId = imgArr[1].replace(/"/g, ''); //Replacing the "(double quotes) from string
                imgId = imgId.replace(/}/g, ''); //Replacing Last } braces

                var imgPathArr = splData[0].split(":");
                var imgPath = imgPathArr[1].replace(/"/g, '');
                var comImagePath = base_url + "uploads/webp/" + imgPath;
                var image_list = jQuery("#mobile_webp_image_id").val();
                var next_val = imgId + "," + image_list;
                jQuery("#mobilewebpimgstatus" + lastId).append('<div class="col-md-5" id="div_' + imgId + '"><button style="margin-left: 5px;" type="button" class="close" onclick="mobiledelwebpImage(' + imgId + ');" id="button_' + imgId + '"><span aria-hidden="true">×</span></button><img id="' + imgId + '" src=' + comImagePath + ' class="thumbnail img-responsive" style="width: 80px; margin-top: 5px; display: block;" /></div></div></div>');
                $('#mobile_webp_image_id').val(next_val);

            },
            onError: function (files, status, errMsg) {
                jQuery("#mobilewebpimgstatus" + lastId).append(errMsg);
            }
        };

        jQuery("#mobilewebpfileuploader" + lastId).uploadFile(settings);
    }
    
      function mobiledelwebpImage(image_id) {
        var hotel_image = $('#mobilewebp_image_id').val();
        var after = hotel_image.replace(image_id + ",", '');
        $('#mobilewebp_image_id').val(after);
        $("#" + image_id).remove();
        $("#button_" + image_id).remove();
        $("#div_" + image_id).remove();

    }

function mobiledojpg2upload(lastId) {

        var settings = {url: base_url + "admin/ajaxjpg2image", method: "POST", allowedTypes: "jpf", fileName: "myfile", multiple: false, /*dataType:'json',*/
            onSuccess: function (files, data, xhr) {
                var splData = data.split(',');
                var imgArr = splData[3].split(":");
                var imgId = imgArr[1].replace(/"/g, ''); //Replacing the "(double quotes) from string
                imgId = imgId.replace(/}/g, ''); //Replacing Last } braces
                var imgPathArr = splData[0].split(":");
                var imgPath = imgPathArr[1].replace(/"/g, '');
                var comImagePath = base_url + "uploads/jpeg_2000/" + imgPath;
                var image_list = jQuery("#mobile_jpg2_image_id").val();
                var next_val = imgId + "," + image_list;
                jQuery("#mobilejpg2imgstatus" + lastId).append('<div class="col-md-5" id="div_' + imgId + '"><button style="margin-left: 5px;" type="button" class="close" onclick="mobiledeljpg2Image(' + imgId + ');" id="button_' + imgId + '"><span aria-hidden="true">×</span></button><img id="' + imgId + '" src=' + comImagePath + ' class="thumbnail img-responsive" style="width: 80px; margin-top: 5px; display: block;" /></div></div></div>');
                $('#mobile_jpg2_image_id').val(next_val);

            },
            onError: function (files, status, errMsg) {
                jQuery("#mobilejpg2imgstatus" + lastId).append(errMsg);
            }
        };

        jQuery("#mobilejpg2fileuploader" + lastId).uploadFile(settings);
    }
    
      function mobiledeljpg2Image(image_id) {
        var hotel_image = $('#mobile_jpg2_image_id').val();
        var after = hotel_image.replace(image_id + ",", '');
        $('#mobile_jpg2_image_id').val(after);
        $("#" + image_id).remove();
        $("#button_" + image_id).remove();
        $("#div_" + image_id).remove();

    }
    
    function mobiledojpgupload(lastId) {

        var settings = {url: base_url + "admin/ajaxjpgimage", method: "POST", allowedTypes: "jpg", fileName: "myfile", multiple: false, /*dataType:'json',*/
            onSuccess: function (files, data, xhr) {
                var splData = data.split(',');
                var imgArr = splData[3].split(":");
                var imgId = imgArr[1].replace(/"/g, ''); //Replacing the "(double quotes) from string
                imgId = imgId.replace(/}/g, ''); //Replacing Last } braces
                var imgPathArr = splData[0].split(":");
                var imgPath = imgPathArr[1].replace(/"/g, '');
                var comImagePath = base_url + "uploads/jpg/" + imgPath;
                var image_list = jQuery("#mobile_jpg_image_id").val();
                var next_val = imgId + "," + image_list;
                jQuery("#mobilejpgimgstatus" + lastId).append('<div class="col-md-5" id="div_' + imgId + '"><button style="margin-left: 5px;" type="button" class="close" onclick="mobiledeljpgImage(' + imgId + ');" id="button_' + imgId + '"><span aria-hidden="true">×</span></button><img id="' + imgId + '" src=' + comImagePath + ' class="thumbnail img-responsive" style="width: 80px; margin-top: 5px; display: block;" /></div></div></div>');
                $('#mobile_jpg_image_id').val(next_val);

            },
            onError: function (files, status, errMsg) {
                jQuery("#mobilejpgimgstatus" + lastId).append(errMsg);
            }
        };

        jQuery("#mobilejpgfileuploader" + lastId).uploadFile(settings);
    }
    
      function mobiledeljpgImage(image_id) {
        var hotel_image = $('#mobile_jpg_image_id').val();
        var after = hotel_image.replace(image_id + ",", '');
        $('#mobile_jpg_image_id').val(after);
        $("#" + image_id).remove();
        $("#button_" + image_id).remove();
        $("#div_" + image_id).remove();

    }

</script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>

<!-- END THEME LAYOUT SCRIPTS -->

<script src="<?php echo base_url(); ?>js/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo base_url("js/angular-1.6.js"); ?>"></script>
<script src="<?php echo base_url("js/angular_route.js"); ?>"></script>
<script src="<?php echo base_url("js/dirPagination.js"); ?>"></script>
<script src="<?php echo base_url("js/angular-summernote.js"); ?>"></script>
<script src="<?php echo base_url("js/angular-summernote.min.js"); ?>"></script>
<script src="<?php echo base_url(); ?>js/angular-datepicker.js"></script>




<?php
switch ($jsType) {

 
    CASE "1":
        ?>
        <script src="<?php echo base_url("js/store.js"); ?>"></script>
        <?php
        break;
    CASE "2":
        ?>
        <script src="<?php echo base_url("js/sna.js"); ?>"></script>
        <?php
        break;
        CASE "4":
        ?>
        <script src="<?php echo base_url("js/ward.js"); ?>"></script>
        <?php
        break;
}
?>
<script language="javascript" type="text/javascript">

    
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

<script>

    
</script>

<script src="<?php echo base_url(); ?>js/sweet/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url(); ?>js/sweet/core.js"></script>
<script src="<?php echo base_url(); ?>js/sweet/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/sweet/sweetalert2.min.css">
<script src="<?php echo base_url(); ?>js/jquery.uploadfile.min.js"></script>
</body>

</html>