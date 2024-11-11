/*Global Variable */
var tblUqRow = 1;
//var base_url = "http://localhost/goguru/";
var base_url = "http://www.gogurueducationhub.com/";



/********************************************************************
 CAPTCHA CODE VALIDATION
 ********************************************************************/
var botFirstNumber = Math.ceil(Math.random() * 10);
var botSecondNumber = Math.ceil(Math.random() * 10);
var botResult = botFirstNumber + botSecondNumber;

function ValidBotBoot() {
    var botValue = document.getElementById('BotBootInput').value;
    if (botValue == botResult)
        return true;
    return false;
}

/********************************************************************
 *FUNCTION *
 ********************************************************************/
(function ($) {
    $.fn.serializeFormJSON = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery);



function showError(msg, id) {
    if ($("#" + id).closest(".form-group").hasClass("error")) {
        $("#" + id).closest(".form-group").find("span.errorMsgArrow").html("<em class='ar-icon'></em>" + msg);
    } else {
        $("#" + id).closest(".form-group").addClass("error");
        $("#" + id).closest(".form-group").append("<span class='errorMsgArrow'><em class='ar-icon'></em>" + msg + "</span>");
    }
}

function changeError(id) {
    $("#" + id).closest(".form-group").removeClass("error");
    $("#" + id).closest(".form-group").find("span.errorMsgArrow").remove();
}

function showDivError(msg, id) {
    if ($("#" + id).closest("div").hasClass("error")) {
        $("#" + id).closest("div").find("span.errorMsgArrow").html("<em class='ar-icon'></em>" + msg);
    } else {
        $("#" + id).closest("div").addClass("error");
        $("#" + id).closest("div").append("<span class='errorMsgArrow'><em class='ar-icon'></em>" + msg + "</span>");
    }
}

function changeDivError(id) {
    $("#" + id).closest("div").removeClass("error");
    $("#" + id).closest("div").find("span.errorMsgArrow").remove();
}

function trim(str) {
    return(("" + str).replace(/^\s*([\s\S]*\S+)\s*$|^\s*$/, '$1'));
}

function isValidEmail(value) {
    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if (filter.test(trim(value)))
        return true;
    else
        return false;
}

function isPhone(value) {

    var iChars = "0123456789+-#/()";
    for (var i = 0; i < value.length; i++) {
        if (iChars.indexOf(value.charAt(i)) == -1) {
            return false;
        }
    }
    return true;
}

function isNumber(value) {
    var iChars = "0123456789";
    for (var i = 0; i < value.length; i++) {
        if (iChars.indexOf(value.charAt(i)) == -1) {
            return false;
        }
    }
    return true;
}

function isNumDigit(value) {
    var iChars = "0123456789.";
    for (var i = 0; i < value.length; i++) {
        if (iChars.indexOf(value.charAt(i)) == -1) {
            return false;
        }
    }
    return true;
}

function isPincode(value)
{
    var iChars = "0123456789() ";
    for (var i = 0; i < value.length; i++)
    {
        if (iChars.indexOf(value.charAt(i)) == -1)
        {
            return false;
        }
    }
    return true;
} //End of isPinocde()

function is_int(value) {
    if (value > 0 && (value / 1) == 0) {
        return true;
    } else {
        return false;
    }
}



function validateSignupForm(ele)
{

    var hasError = 0;
    var full_name = jQuery("#full_name").val();
    var email = jQuery("#email").val();
    var mobile = jQuery("#mobile").val();
    var password = jQuery("#password").val();
  

    if (jQuery.trim(full_name) == '') {       
        showError("Please enter full name.", "full_name");
        
        hasError = 1;
    } else {
        changeError("full_name");
    }

   
    if (jQuery.trim(password) == '') {
            showError("Please enter password.", "password");
        hasError = 1;
    } else {
        changeError("password");
    }

    if (jQuery.trim(email) == '') {
     
            showError("Please enter email address.", "email");
        
        hasError = 1;
    } else if (isValidEmail(email)) {
        changeError("email");
    } else {
        
            showError("Please enter valid email address.", "email");
        }
        
    
    if (jQuery.trim(mobile) == '') {
       
            showError("Please enter mobile number", "mobile");
        
        hasError = 1;
    } else if (isPhone(mobile) == false) {
       
            showError("Please enter valid mobile number", "mobile");
       
    } else {
        changeError("mobile");
    }


    if (isValidEmail(email)) {
        if (isEmailExist(jQuery.trim(email)) == "1") {        
        showError("Email address is already registered with us.", "email");
            

            hasError = 1;
        } else {
            changeError("email");
          
        }

    }

    if (hasError == 1) {
        return false;
    } else {

        var BookingData = jQuery(ele).serializeFormJSON();

        var q = JSON.stringify(BookingData);

        console.log(q);
        jQuery.ajax({
            dataType: 'json',
            type: 'POST',
            url: base_url + 'Portal/AddExternalSignup',
            data: {'jsonObj': q},
            cache: false,
            success: function (res) {
            
                    swal(
                            'Thank You',
                            'User added sucessfully.',
                            'success'
                            ).then(function () {
                       location.reload();
                    });
                

            }
        });
        return false;
    }
}


function validateWebniarForm(ele)
{

    var hasError = 0;
    var full_name = jQuery("#full_name").val();
    var email = jQuery("#email").val();
    var mobile = jQuery("#mobile").val();
    var courses = jQuery("#courses_id").val();
  

    if (jQuery.trim(full_name) == '') {       
        showError("Please enter full name.", "full_name");
        
        hasError = 1;
    } else {
        changeError("full_name");
    }

   
    if (jQuery.trim(courses) == '') {
            showError("Please slecet courses.", "courses");
        hasError = 1;
    } else {
        changeError("courses");
    }

    if (jQuery.trim(email) == '') {
     
            showError("Please enter email address.", "email");
        
        hasError = 1;
    } else if (isValidEmail(email)) {
        changeError("email");
    } else {
        
            showError("Please enter valid email address.", "email");
        }
        
    
    if (jQuery.trim(mobile) == '') {
       
            showError("Please enter mobile number", "mobile");
        
        hasError = 1;
    } else if (isPhone(mobile) == false) {
       
            showError("Please enter valid mobile number", "mobile");
       
    } else {
        changeError("mobile");
    }



    if (hasError == 1) {
        return false;
    } else {

        var BookingData = jQuery(ele).serializeFormJSON();

        var q = JSON.stringify(BookingData);

        console.log(q);
        jQuery.ajax({
            dataType: 'json',
            type: 'POST',
            url: base_url + 'Portal/AddWebniar',
            data: {'jsonObj': q},
            cache: false,
            success: function (res) {
            
                    swal(
                            'Thank You',
                            'User added sucessfully for Webinar.',
                            'success'
                            ).then(function () {
                       location.reload();
                    });
                

            }
        });
        return false;
    }
}
function PreLession(course_id,lession_no)
{
    jQuery.ajax({
        type: "POST",
        url: base_url + "Portal/ValidatePreLession",
        data: 'course_id=' + course_id+ '&lession_no=' + lession_no,
        beforeSend: function () {

        },
        success: function (res) {
           jQuery("#main").html(res);


        }
    }); 
        return false;

    
}

function NextLession(course_id,lession_no)
{
    jQuery.ajax({
        type: "POST",
        url: base_url + "Portal/ValidateNextLession",
        data: 'course_id=' + course_id+ '&lession_no=' + lession_no,
        beforeSend: function () {

        },
        success: function (res) {
           jQuery("#main").html(res);


        }
    }); 
        return false;

    
}

$('.mnumber').keypress(function (e) {
    var arr = [];
    var kk = e.which;
    for (i = 48; i < 58; i++)
        arr.push(i);
    if (!(arr.indexOf(kk) >= 0))
        e.preventDefault();

});

function isEmailExist(email) {
    var user = {};
    user.account = {};
    user.account.emailaddress = email;
    var q = JSON.stringify(user);

    var result = jQuery.ajax({
        url: base_url + "Login/checkemailaddress",
        type: 'POST',
        data: {'jsonObj': q},
        cache: false,
        async: false,
        success: function (eMsg) {
        }
    }).responseText;
    return result;
}

function validateExternalLoginForm(ele)
{
    var hasError = 0;
    var user_email = jQuery("#user_email").val();
    var user_password = jQuery("#user_password").val();
    
    if (jQuery.trim(user_password) == '') {
         showError("Please enter password.", "user_password");
        hasError = 1;
    } else {
        changeError("user_password");
    }
    if (jQuery.trim(user_email) == '') {
        showError("Please enter email address.", "user_email");
       
        hasError = 1;
    } else if (isValidEmail(user_email) == false) {
       
            showError("Please enter valid email address.", "user_email");
        
        hasError = 1;

    } else {
        changeError("user_email");
    }


    if (hasError == 1) {

        return false;
    } else {
        var BookingData = jQuery(ele).serializeFormJSON();
        var q = JSON.stringify(BookingData);
        console.log(q);
        jQuery.ajax({
            dataType: 'json',
            type: 'POST',
            url: base_url + 'Portal/CheckExternalLogin',
            data: {'jsonObj': q},
            cache: false,
            success: function (res) {

                if ((res.status) != false) {
                    changeError("user_password");
                    window.location.replace(base_url);
                   

                } else {

                    showError("Please enter valid username and password.", "user_password");
                }

            }
        });
        return false;
    }

    return false;
    
}

function validateContactForm(ele)
{

    var hasError = 0;
    var full_name = jQuery("#full_name").val();
    var email = jQuery("#email").val();
    var mobile = jQuery("#mobile").val();
    var courses = jQuery("#courses_id").val();
    var subject = jQuery("#subject").val();
    var message = jQuery("#message").val();
  

 if (jQuery.trim(subject) == '') {       
        showError("Please enter subject.", "subject");
        
        hasError = 1;
    } else {
        changeError("subject");
    }
    
     if (jQuery.trim(message) == '') {       
        showError("Please enter message.", "message");
        
        hasError = 1;
    } else {
        changeError("message");
    }
    
    if (jQuery.trim(full_name) == '') {       
        showError("Please enter full name.", "full_name");
        
        hasError = 1;
    } else {
        changeError("full_name");
    }

   
    if (jQuery.trim(courses) == '') {
            showError("Please slecet courses.", "courses");
        hasError = 1;
    } else {
        changeError("courses");
    }

    if (jQuery.trim(email) == '') {
     
            showError("Please enter email address.", "email");
        
        hasError = 1;
    } else if (isValidEmail(email)) {
        changeError("email");
    } else {
        
            showError("Please enter valid email address.", "email");
        }
        
    
    if (jQuery.trim(mobile) == '') {
       
            showError("Please enter mobile number", "mobile");
        
        hasError = 1;
    } else if (isPhone(mobile) == false) {
       
            showError("Please enter valid mobile number", "mobile");
       
    } else {
        changeError("mobile");
    }



    if (hasError == 1) {
        return false;
    } else {

        var BookingData = jQuery(ele).serializeFormJSON();

        var q = JSON.stringify(BookingData);

        console.log(q);
        jQuery.ajax({
            dataType: 'json',
            type: 'POST',
            url: base_url + 'Portal/AddContact',
            data: {'jsonObj': q},
            cache: false,
            success: function (res) {
            
                    swal(
                            'Thank You',
                            'Details Added sucessfully.',
                            'success'
                            ).then(function () {
                       location.reload();
                    });
                

            }
        });
        return false;
    }
}


function validateChangePassword(ele)
{

    var hasError = 0;
    var new_password = jQuery("#new_password").val();
    var re_new_password = jQuery("#re_new_password").val();
    
  

 if (jQuery.trim(new_password) == '') {       
        showError("Please enter new password.", "new_password");
        
        hasError = 1;
    } else {
        changeError("new_password");
    }
    
     if (jQuery.trim(re_new_password) == '') {       
        showError("Please re enter new password.", "re_new_password");
        
        hasError = 1;
    } else {
        changeError("re_new_password");
    }
    if((new_password!='') && (re_new_password!='')) {
    if ((jQuery.trim(new_password))!= (jQuery.trim(re_new_password))) {       
        showError("Both password should be same", "re_new_password");
        
        hasError = 1;
    } else {
        changeError("re_new_password");
    }

    }
   


    if (hasError == 1) {
        return false;
    } else {

        var BookingData = jQuery(ele).serializeFormJSON();

        var q = JSON.stringify(BookingData);

        console.log(q);
        jQuery.ajax({
            dataType: 'json',
            type: 'POST',
            url: base_url + 'Portal/CheckChangePassword',
            data: {'jsonObj': q},
            cache: false,
            success: function (res) {
            
                    swal(
                            'Thank You',
                            'Password Changed sucessfully.',
                            'success'
                            ).then(function () {
                      // location.reload();
                       location.href = base_url;
                    });
                

            }
        });
        return false;
    }
}


function validateForgotPassword(ele)
{

    var hasError = 0;
     var user_email = jQuery("#user_email").val();
    
    
    if (jQuery.trim(user_email) == '') {
        showError("Please enter email address.", "user_email");
       
        hasError = 1;
    } else if (isValidEmail(user_email) == false) {
       
            showError("Please enter valid email address.", "user_email");
        
        hasError = 1;

    } else {
        changeError("user_email");
    }


    if (hasError == 1) {
        return false;
    } else {

        var BookingData = jQuery(ele).serializeFormJSON();

        var q = JSON.stringify(BookingData);

        console.log(q);
        jQuery.ajax({
            dataType: 'json',
            type: 'POST',
            url: base_url + 'Portal/CheckForgotPassword',
            data: {'jsonObj': q},
            cache: false,
            success: function (res) {
            
                    swal(
                            'Thank You',
                            'We reset the password and mailed you Please check inbox/spam.',
                            'success'
                            ).then(function () {
                      // location.reload();
                       location.href = base_url;
                    });
                

            }
        });
        return false;
    }
}