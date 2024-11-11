var app = angular.module("RVLabData",['720kb.datepicker','summernote','angularUtils.directives.dirPagination']);
//var pathname = "http://localhost/goguru/";
var pathname = "http://www.gogurueducationhub.com/";

app.factory('UserDataDetails',function($http){
var imaxloginData = {};
imaxloginData.checkData = function(data,path){
   
};
return imaxloginData;
});
app.directive('fileModel', ['$parse', function ($parse) {
        return {
           restrict: 'A',
           link: function(scope, element, attrs) {
              element.bind('change', function(){
              $parse(attrs.fileModel).assign(scope,element[0].files)
                 scope.$apply();
              });
           }
        };
}]);

app.directive('numbersOnly', function () {
        return {
            require: 'ngModel',
            link: function (scope, element, attr, ngModelCtrl) {
                function fromUser(text) {
                    if (text) {
                        var transformedInput = text.replace(/[^0-9-]/g, '');
                        if (transformedInput !== text) {
                            ngModelCtrl.$setViewValue(transformedInput);
                            ngModelCtrl.$render();
                        }
                        return transformedInput;
                    }
                    return undefined;
                }
                ngModelCtrl.$parsers.push(fromUser);
            }
        };
    });
    

app.controller("CategoryController",function($scope,$http,$window,UserDataDetails,$rootScope,$window){
$scope.button='Submit';

$scope.delStoreImage = function (image_id) {
var park_image=$('#store_image_id').val();  
var after=park_image.replace(image_id+",", '');
$('#store_image_id').val(after);  
$("#"+image_id).remove();
$("#button_"+image_id).remove();
$("#div_"+image_id).remove();
};
    
var responce = angular.fromJson($window.localStorage.getItem("CategoryList")); //string convert to object and get value
var JpgImageListResult = angular.fromJson($window.localStorage.getItem("JpgEditImageList"));
     if(JpgImageListResult!=null){
         $scope.JpgImageListResult=JpgImageListResult;
     }
     else
     {
         $scope.JpgImageListResult='';
     }
     
            if(responce != null){
                $scope.button='Update';	
		$scope.category_id = responce.CategoryDet.category_id;
                $scope.category_name = responce.CategoryDet.category_name;
                $scope.short_description = responce.CategoryDet.short_description;
                $scope.store_image_id = responce.CategoryDet.jpg_image_id;                
                               
               }
$scope.submitCoursesForm = function(){

 var numbericreg = /^(?:[1-9]\d*|\d)$/;
 var phnrgx = /^([987]{1})(\d{1})(\d{8})$/;
 var emailrgx = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$|^$/;
 var count = 0;
 var fd = false;
 var fd = new FormData();
 
var category_name = angular.element(document.querySelector('[name="category_name"]')).val().trim();
var short_description = angular.element(document.querySelector('[name="short_description"]')).val().trim();

var jpg_image_id = angular.element(document.querySelector('[name="store_image_id"]')).val().trim();
var jpg_image_id_list=jpg_image_id.split(',');
var jpg_image_id_list_count=jpg_image_id_list.length;

if(category_name == null || category_name == undefined || category_name == ""){
     angular.element(document.querySelector('[id="ErrorDivcategory_name"]')).html('').append("Please enter category name");
      count++;
    } else {
      angular.element(document.querySelector('[id="ErrorDivcategory_name"]')).html('').append("");
    }
    
    if(short_description == null || short_description == undefined || short_description == ""){
     angular.element(document.querySelector('[id="ErrorDivshort_description"]')).html('').append("Please enter course description");
      count++;
    } else {
      angular.element(document.querySelector('[id="ErrorDivshort_description"]')).html('').append("");
    }
 
    
 if(jpg_image_id == null || jpg_image_id == undefined || jpg_image_id == ""){
        angular.element(document.querySelector('[id="Errorjpg_image_id"]')).html('').append("Please upload jpg image");
        count++;
        } else if (jpg_image_id_list_count != 2 ){
          
        angular.element(document.querySelector('[id="Errorjpg_image_id"]')).html('').append("Please upload only one jpg image");
        count++;
        } 
    
        else {
            angular.element(document.querySelector('[id="Errorjpg_image_id"]')).html('').append("");
            }   
            
   var category_id = ($scope.category_id)?$scope.category_id:0;
   $scope.formData=$("#CoursesForm").serialize()+'&category_id='+category_id;
   
    if($scope.formData){
    
      if(count>0)
        {
            return false;
        }
        else{
            return $http({
			url:pathname+'Category/SaveCategorys',
				cache:false,
				method:'POST',
				headers : {
                                   'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
                                data:$.param({category_id:category_id,category_name:category_name,jpg_image_id:jpg_image_id,short_description:short_description})
				
		}).then(function successCallback(responce){
                    console.log(responce.data);
                    localStorage.clear();
                    $scope.coupon_id = 0;
                    if((responce.data.status==1 ))
                   {
                             swal(
                            'Thank you.',
                            'Category added successfully',
                            'success'
                          ).then(function() {
                                          location.href = pathname+'Category';
            });
                   }
                   
                       if((responce.data.status==2 ))
                   {
                             swal(
                            'Thank you.',
                            'Category updated successfully.',
                            'success'
                          ).then(function() {
                                          location.href = pathname+'Category';
            });
                   }
                
                },function errorCallback(responce){
		  console.log(responce.data);
		});
            
        }
  }

};


 
});

app.controller('CategoryListController',function($scope,$http,$location,$timeout,$rootScope,$window)
{
localStorage.clear();

$scope.CategoryImageList = function (category_id) {
     $http({
        url:pathname+'Category/AboutCategoryImage',
        method:'POST',
        headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                },
        data:$.param( {category_id:category_id} )
    }).then(function successCallback(responce){
     $scope.ImageResult = responce.data;
     
      },function errorCallback(responce){
      //console.log(responce);
      });
    //  $scope.loadContent();
   };
   
$scope.EditCategorys=function(category_id){
    
  return $http({
			url:pathname+'Category/EditCategorys',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({category_id:category_id})
		}).then(function successCallback(responce){
                    localStorage.clear();
                   $rootScope.CategoryList = responce.data; 
                   if(responce.data.CategoryDet!=undefined){
                     var token = JSON.stringify($rootScope.CategoryList); // object convert to string
                    $window.localStorage.setItem("CategoryList",token);  
                   }
                                      
                   if(responce.data.JpgImageList!=undefined){
                    $rootScope.JpgEditImageList = responce.data.JpgImageList;     
                    var token = JSON.stringify($rootScope.JpgEditImageList); // object convert to string
                    $window.localStorage.setItem("JpgEditImageList",token);  // set item value
                    }
                $window.location = pathname+'Category/AddCategory';
                   
                },function errorCallback(responce){
		  console.log(responce);
		});
};


$scope.ActiveCategorys=function(category_id,status){
var status_text=(status==1)?"unpublish":"publish";
swal({
  title: "Are you sure, you want to " +status_text +" the Category?",  
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    
     return $http({
			url:pathname+'Category/ActiveCategorys',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({category_id:category_id,status:status})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
  });
  
   
};


$scope.DeleteCategoryss=function(category_id){
swal({
 title: "Please confirm record deletion. ",
  text: "Once you delete the Category, you will not be able to recover it.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Category deleted successfully.", {
      icon: "success",
    });
     return $http({
			url:pathname+'Category/DeleteCategorys',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({category_id:category_id})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
});

};


$scope.loadContent1 = function(){
     
    return $http({
			url:pathname+'Category/CategoryListing',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({})
		}).then(function successCallback(responce){
                    //console.log(responce);
                    $scope.dataResult = responce.data;
                },function errorCallback(responce){
		  //console.log(responce);
		});
};
$scope.loadContent1();

});

app.controller("CourseController",function($scope,$http,$window,UserDataDetails,$rootScope,$window){
$scope.button='Submit';

$scope.delStoreImage = function (image_id) {
var park_image=$('#store_image_id').val();  
var after=park_image.replace(image_id+",", '');
$('#store_image_id').val(after);  
$("#"+image_id).remove();
$("#button_"+image_id).remove();
$("#div_"+image_id).remove();
};
    
var responce = angular.fromJson($window.localStorage.getItem("CourseList")); //string convert to object and get value
var JpgImageListResult = angular.fromJson($window.localStorage.getItem("JpgEditImageList"));
     if(JpgImageListResult!=null){
         $scope.JpgImageListResult=JpgImageListResult;
     }
     else
     {
         $scope.JpgImageListResult='';
     }
    
            if(responce != null){
                $scope.button='Update';	
		$scope.course_id = responce.CourseDet.course_id;
                $scope.course_name = responce.CourseDet.course_name;
                $scope.category_id = responce.CourseDet.category_id;
                $scope.editordescription = responce.CourseDet.short_description;
                $scope.course_duration = responce.CourseDet.course_duration;
                $scope.course_duration_remarks = responce.CourseDet.course_duration_remarks;
                $scope.zoom_duration = responce.CourseDet.zoom_duration;
                $scope.zoom_schedule = responce.CourseDet.zoom_schedule;
                $scope.mentor_id = responce.CourseDet.mentor_id;
                $scope.course_mode = responce.CourseDet.course_mode;
                $scope.course_type = responce.CourseDet.course_type;
                $scope.course_fee = responce.CourseDet.course_fee;
                $scope.store_image_id = responce.CourseDet.jpg_image_id;
                
                
                               
               }
$scope.submitCourseForm = function(){

 var numbericreg = /^(?:[1-9]\d*|\d)$/;
 var phnrgx = /^([987]{1})(\d{1})(\d{8})$/;
 var emailrgx = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$|^$/;
 var count = 0;
 var fd = false;
 var fd = new FormData();
 
var category_id = angular.element(document.querySelector('[name="category_id"]')).val().trim();
var course_name = angular.element(document.querySelector('[name="course_name"]')).val().trim();
var course_duration = angular.element(document.querySelector('[name="course_duration"]')).val().trim();
var course_duration_remarks = angular.element(document.querySelector('[name="course_duration_remarks"]')).val().trim();
var zoom_duration = angular.element(document.querySelector('[name="zoom_duration"]')).val().trim();
var zoom_schedule = angular.element(document.querySelector('[name="zoom_schedule"]')).val().trim();
var mentor_id = angular.element(document.querySelector('[name="mentor_id"]')).val().trim();
var course_mode = angular.element(document.querySelector('[name="course_mode"]')).val().trim();
var course_type = angular.element(document.querySelector('[name="course_type"]')).val().trim();
var course_fee = angular.element(document.querySelector('[name="course_fee"]')).val().trim();

var short_description=$scope.editordescription;

var jpg_image_id = angular.element(document.querySelector('[name="store_image_id"]')).val().trim();
var jpg_image_id_list=jpg_image_id.split(',');
var jpg_image_id_list_count=jpg_image_id_list.length;

if(category_id == null || category_id == undefined || category_id == ""){
     angular.element(document.querySelector('[id="ErrorDivcategory_id"]')).html('').append("Please enter category name");
      count++;
    } else {
      angular.element(document.querySelector('[id="ErrorDivcategory_id"]')).html('').append("");
    }
    
    if(short_description == null || short_description == undefined || short_description == ""){
     angular.element(document.querySelector('[id="ErrorDivshort_description"]')).html('').append("Please enter description");
      count++;
    } else {
      angular.element(document.querySelector('[id="ErrorDivshort_description"]')).html('').append("");
    }
 if(course_name == null || course_name == undefined || course_name == ""){
     angular.element(document.querySelector('[id="ErrorDivcourse_name"]')).html('').append("Please enter course name");
      count++;
    } else {
      angular.element(document.querySelector('[id="ErrorDivcourse_name"]')).html('').append("");
    }

        
 if(jpg_image_id == null || jpg_image_id == undefined || jpg_image_id == ""){
        angular.element(document.querySelector('[id="Errorjpg_image_id"]')).html('').append("Please upload jpg image");
        count++;
        } else if (jpg_image_id_list_count != 2 ){
          
        angular.element(document.querySelector('[id="Errorjpg_image_id"]')).html('').append("Please upload only one jpg image");
        count++;
        } 
    
        else {
            angular.element(document.querySelector('[id="Errorjpg_image_id"]')).html('').append("");
            } 
  
   var course_id = ($scope.course_id)?$scope.course_id:0;
   $scope.formData=$("#CourseForm").serialize()+'&course_id='+course_id;
   
    if($scope.formData){
    
      if(count>0)
        {
            return false;
        }
        else{
            return $http({
			url:pathname+'Course/SaveCourse',
				cache:false,
				method:'POST',
				headers : {
                                   'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
                                data:$.param({jpg_image_id:jpg_image_id,course_id:course_id,course_name:course_name,category_id:category_id,short_description:short_description,course_duration:course_duration,course_duration_remarks:course_duration_remarks,zoom_duration,zoom_schedule:zoom_schedule,mentor_id:mentor_id,course_mode:course_mode,course_type:course_type,course_fee:course_fee})
				
		}).then(function successCallback(responce){
                    console.log(responce.data);
                    localStorage.clear();
                    $scope.course_id = 0;
                    if((responce.data.status==1 ))
                   {
                             swal(
                            'Thank you.',
                            'Course created successfully',
                            'success'
                          ).then(function() {
                                          location.href = pathname+'Course';
            });
                   }
                   
                       if((responce.data.status==2 ))
                   {
                             swal(
                            'Thank you.',
                            'Course updated successfully.',
                            'success'
                          ).then(function() {
                                          location.href = pathname+'Course';
            });
                   }
                
                },function errorCallback(responce){
		  console.log(responce.data);
		});
            
        }
  }

};
$scope.loadContent1 = function(){
     
    return $http({
			url:pathname+'Course/CourseListing',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({})
		}).then(function successCallback(responce){
                    //console.log(responce);
                    $scope.dataResult = responce.data;
                },function errorCallback(responce){
		  //console.log(responce);
		});
};
$scope.loadContent1();
 
});

app.controller('CourseListController',function($scope,$http,$location,$timeout,$rootScope,$window)
{
localStorage.clear();

$scope.EditCoursess=function(course_id){
    
  return $http({
			url:pathname+'Course/EditCourse',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({course_id:course_id})
		}).then(function successCallback(responce){
                    localStorage.clear();
                   $rootScope.CourseList = responce.data; 
                   if(responce.data.CourseDet!=undefined){
                     var token = JSON.stringify($rootScope.CourseList); // object convert to string
                    $window.localStorage.setItem("CourseList",token);  
                   }
                        if(responce.data.JpgImageList!=undefined){
                    $rootScope.JpgEditImageList = responce.data.JpgImageList;     
                    var token = JSON.stringify($rootScope.JpgEditImageList); // object convert to string
                    $window.localStorage.setItem("JpgEditImageList",token);  // set item value
                    }                  
                 
                $window.location = pathname+'Course/AddCourse';
                   
                },function errorCallback(responce){
		  console.log(responce);
		});
};


$scope.ActiveCoursess=function(course_id,status){
var status_text=(status==1)?"unpublish":"publish";
swal({
  title: "Are you sure, you want to " +status_text +" the Course?",  
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    
     return $http({
			url:pathname+'Course/ActiveCourse',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({course_id:course_id,status:status})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
  });
  
   
};


$scope.DeleteCourses=function(course_id){
swal({
 title: "Please confirm record deletion. ",
  text: "Once you delete the test, you will not be able to recover it.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Course deleted successfully.", {
      icon: "success",
    });
     return $http({
			url:pathname+'Course/DeleteCourse',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({course_id:course_id})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
});

};


$scope.loadContent1 = function(){
     
    return $http({
			url:pathname+'Course/CourseListing',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({})
		}).then(function successCallback(responce){
                    //console.log(responce);
                    $scope.dataResult = responce.data;
                },function errorCallback(responce){
		  //console.log(responce);
		});
};
$scope.loadContent1();

});

app.controller("TopicController",function($scope,$http,$window,UserDataDetails,$rootScope,$window){
$scope.button='Submit';

$scope.CoureseLists = function (category_id) {
    
     $http({
        url:pathname+'Course/GetCourseList',
        method:'POST',
        headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                },
        data:$.param( {category_id:category_id} )
    }).then(function successCallback(responce){
     $scope.CourseResult = responce.data;
     
      },function errorCallback(responce){
      //console.log(responce);
      });
    //  $scope.loadContent();
   };

$scope.delStoreImage = function (image_id) {
var park_image=$('#store_image_id').val();  
var after=park_image.replace(image_id+",", '');
$('#store_image_id').val(after);  
$("#"+image_id).remove();
$("#button_"+image_id).remove();
$("#div_"+image_id).remove();
};
    
var responce = angular.fromJson($window.localStorage.getItem("TopicList")); //string convert to object and get value
var JpgImageListResult = angular.fromJson($window.localStorage.getItem("JpgEditImageList"));
     if(JpgImageListResult!=null){
         $scope.JpgImageListResult=JpgImageListResult;
     }
     else
     {
         $scope.JpgImageListResult='';
     }
     
            if(responce != null){
                $scope.button='Update';	
		$scope.category_id = responce.TopicDet.category_id;
                var category_id = responce.TopicDet.category_id;
                $scope.CoureseLists(category_id);
                $scope.course_id = responce.TopicDet.course_id;
                $scope.topic_id = responce.TopicDet.topic_id;
                $scope.topic_name = responce.TopicDet.topic_name;
                $scope.lession_no = responce.TopicDet.lession_no;
                $scope.short_description = responce.TopicDet.short_description;
                $scope.store_image_id = responce.TopicDet.jpg_image_id;
                $scope.youtube_link = responce.TopicDet.link;
                               
               }
$scope.submitTopicsForm = function(){

 var numbericreg = /^(?:[1-9]\d*|\d)$/;
 var phnrgx = /^([987]{1})(\d{1})(\d{8})$/;
 var emailrgx = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$|^$/;
 var count = 0;
 var fd = false;
 var fd = new FormData();
 
var category_id = angular.element(document.querySelector('[name="category_id"]')).val().trim();
var course_id = angular.element(document.querySelector('[name="course_id"]')).val().trim();
var short_description = angular.element(document.querySelector('[name="short_description"]')).val().trim();
var topic_name = angular.element(document.querySelector('[name="topic_name"]')).val().trim();
var youtube_link = angular.element(document.querySelector('[name="youtube_link"]')).val().trim();
var lession_no = angular.element(document.querySelector('[name="lession_no"]')).val().trim();

var jpg_image_id = angular.element(document.querySelector('[name="store_image_id"]')).val().trim();
var jpg_image_id_list=jpg_image_id.split(',');
var jpg_image_id_list_count=jpg_image_id_list.length;

if(category_id == null || category_id == undefined || category_id == ""){
     angular.element(document.querySelector('[id="ErrorDivcategory_id"]')).html('').append("Please enter category name");
      count++;
    } else {
      angular.element(document.querySelector('[id="ErrorDivcategory_id"]')).html('').append("");
    }
    
if(course_id == null || course_id == undefined || course_id == ""){
     angular.element(document.querySelector('[id="ErrorDivcourse_name"]')).html('').append("Please enter course name");
      count++;
    } else {
      angular.element(document.querySelector('[id="ErrorDivcourse_name"]')).html('').append("");
    }
    
    if(short_description == null || short_description == undefined || short_description == ""){
     angular.element(document.querySelector('[id="ErrorDivshort_description"]')).html('').append("Please enter course description");
      count++;
    } else {
      angular.element(document.querySelector('[id="ErrorDivshort_description"]')).html('').append("");
    }
 if(topic_name == null || topic_name == undefined || topic_name == ""){
     angular.element(document.querySelector('[id="ErrorDivtopic_name"]')).html('').append("Please enter course topic");
      count++;
    } else {
      angular.element(document.querySelector('[id="ErrorDivtopic_name"]')).html('').append("");
    }
    
// if(jpg_image_id == null || jpg_image_id == undefined || jpg_image_id == ""){
//        angular.element(document.querySelector('[id="Errorjpg_image_id"]')).html('').append("Please upload jpg image");
//        count++;
//        } else if (jpg_image_id_list_count != 2 ){
//          
//        angular.element(document.querySelector('[id="Errorjpg_image_id"]')).html('').append("Please upload only one jpg image");
//        count++;
//        } 
//    
//        else {
//            angular.element(document.querySelector('[id="Errorjpg_image_id"]')).html('').append("");
//            }   
//            
   var topic_id = ($scope.topic_id)?$scope.topic_id:0;
   $scope.formData=$("#TopicsForm").serialize()+'&topic_id='+topic_id;
   
    if($scope.formData){
    
      if(count>0)
        {
            return false;
        }
        else{
            return $http({
			url:pathname+'Course/SaveTopics',
				cache:false,
				method:'POST',
				headers : {
                                   'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
                                //data:$.param({course_id:course_id,topic_id:topic_id,topic_name:topic_name,jpg_image_id:jpg_image_id,short_description:short_description})
				data    :($scope.formData)
		}).then(function successCallback(responce){
                    console.log(responce.data);
                    localStorage.clear();
                    $scope.coupon_id = 0;
                    if((responce.data.status==1 ))
                   {
                             swal(
                            'Thank you.',
                            'Course Topics added successfully',
                            'success'
                          ).then(function() {
                                          location.href = pathname+'Course/Topics';
            });
                   }
                   
                       if((responce.data.status==2 ))
                   {
                             swal(
                            'Thank you.',
                            'Course Topics updated successfully.',
                            'success'
                          ).then(function() {
                                          location.href = pathname+'Course/Topics';
            });
                   }
                
                },function errorCallback(responce){
		  console.log(responce.data);
		});
            
        }
  }

};
$scope.loadContent1 = function(){
     
    return $http({
			url:pathname+'Course/TopicsListing',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({})
		}).then(function successCallback(responce){
                    //console.log(responce);
                    $scope.dataResult = responce.data;
                },function errorCallback(responce){
		  //console.log(responce);
		});
};
$scope.loadContent1();
 
});

app.controller('TopicListController',function($scope,$http,$location,$timeout,$rootScope,$window)
{
localStorage.clear();

$scope.TopicImageList = function (topic_id) {
     $http({
        url:pathname+'Course/AboutTopicImage',
        method:'POST',
        headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                },
        data:$.param( {topic_id:topic_id} )
    }).then(function successCallback(responce){
     $scope.ImageResult = responce.data;
     
      },function errorCallback(responce){
      //console.log(responce);
      });
    //  $scope.loadContent();
   };
   
$scope.Edittopicss=function(topic_id){
    
  return $http({
			url:pathname+'Course/EditTopics',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({topic_id:topic_id})
		}).then(function successCallback(responce){
                    localStorage.clear();
                   $rootScope.TopicList = responce.data; 
                   if(responce.data.TopicDet!=undefined){
                     var token = JSON.stringify($rootScope.TopicList); // object convert to string
                    $window.localStorage.setItem("TopicList",token);  
                   }
                                      
                   if(responce.data.JpgImageList!=undefined){
                    $rootScope.JpgEditImageList = responce.data.JpgImageList;     
                    var token = JSON.stringify($rootScope.JpgEditImageList); // object convert to string
                    $window.localStorage.setItem("JpgEditImageList",token);  // set item value
                    }
                $window.location = pathname+'Course/AddTopics';
                   
                },function errorCallback(responce){
		  console.log(responce);
		});
};


$scope.ActiveTopicss=function(topic_id,status){
var status_text=(status==1)?"unpublish":"publish";
swal({
  title: "Are you sure, you want to " +status_text +" the Topic?",  
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    
     return $http({
			url:pathname+'Course/ActiveTopics',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({topic_id:topic_id,status:status})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
  });
  
   
};


$scope.DeleteTopicss=function(topic_id){
swal({
 title: "Please confirm record deletion. ",
  text: "Once you delete the topic, you will not be able to recover it.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Topic deleted successfully.", {
      icon: "success",
    });
     return $http({
			url:pathname+'Course/DeleteTopic',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({topic_id:topic_id})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
});

};


$scope.loadContent1 = function(){
     
    return $http({
			url:pathname+'Course/TopicsListing',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({})
		}).then(function successCallback(responce){
                    //console.log(responce);
                    $scope.dataResult = responce.data;
                },function errorCallback(responce){
		  //console.log(responce);
		});
};
$scope.loadContent1();

});

app.controller("UserPaymentCtr",function($scope,$http,$window,UserDataDetails){

$scope.CoureseLists = function (category_id) {
    
     $http({
        url:pathname+'Course/GetCourseList',
        method:'POST',
        headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                },
        data:$.param( {category_id:category_id} )
    }).then(function successCallback(responce){
     $scope.CourseResult = responce.data;
     
      },function errorCallback(responce){
      //console.log(responce);
      });
    //  $scope.loadContent();
   };
$scope.button='Submit';	
$scope.csv ="";
$scope.module=true; 
var responce = angular.fromJson($window.localStorage.getItem("UserList")); //string convert to object and get value

       if(responce != null){
                $scope.button='Update';	
		$scope.user_id = responce.UserDet.user_id;
                $scope.full_name = responce.UserDet.full_name;
                $scope.password = responce.UserDet.password;                
                $scope.email = responce.UserDet.email;                
                $scope.mobile = responce.UserDet.mobile;        
                var module_id_list = responce.UserDet.module_id_list;
                if(module_id_list!=null)
                {    
                $scope.csv = module_id_list.slice(0, -1);
            }              
               }
               

 
$scope.loadContent = function(){
  
   $http({
        url:pathname+'Portal/loadUserData',
        method:'POST',
        headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                },
        data:$.param( {} )
    }).then(function successCallback(responce){
     $scope.dataResult = responce.data;
      },function errorCallback(responce){
      console.log(responce);
      });
};
$scope.loadContent();

$scope.PaymentsubmitForm = function(){

 var numbericreg = /^(?:[1-9]\d*|\d)$/;
 var phnrgx = /^([987]{1})(\d{1})(\d{8})$/;
 var emailrgx = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$|^$/;
 var count = 0;
 var fd = false;
 var fd = new FormData();
        
    var category_id = angular.element(document.querySelector('[name="category_id"]')).val().trim();
    var course_id = angular.element(document.querySelector('[name="course_id"]')).val().trim();
    var amount = angular.element(document.querySelector('[name="amount"]')).val().trim();
   
     
     if($scope.category_id == null || $scope.category_id == undefined || $scope.category_id == ""){
      angular.element(document.querySelector('[id="ErrorDivcategory_id"]')).html('').append("Please select Category");
      count++;
    } else {
      angular.element(document.querySelector('[id="ErrorDivcategory_id"]')).html('').append("");
    }
     if($scope.course_id == null || $scope.course_id == undefined || $scope.course_id == ""){
      angular.element(document.querySelector('[id="ErrorDivcourse_name"]')).html('').append("Please select course");
      count++;
    } else {
      angular.element(document.querySelector('[id="ErrorDivcourse_name"]')).html('').append("");
    }
    
    if($scope.amount == null || $scope.amount ==undefined || $scope.amount == ''){

      angular.element( document.querySelector('#ErrorDivamount')).html('').append('Please enter email id');
      count++;

    }  else {

      angular.element( document.querySelector('#ErrorDivamount')).html('').append('');
    

    }

   var user_id = ($scope.user_id)?$scope.user_id:0;
   $scope.formData=$("#Userform").serialize()+'&user_id='+user_id;
   if($scope.formData){
    
     // alert($scope.formData);
      //console.log($scope.project);
    
        if(count>0)
        {
            return false;
        }
        else{
            return $http({
			url:pathname+'Portal/SaveUserPayemnt',
				cache:false,
				method:'POST',
				headers : {
                                   'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
                                data    :($scope.formData),
                                //data:$.param({ user_id:user_id,full_name:full_name,password:password,email:email,mobile:mobile,module_id_list:module_id_list}),
				
		}).then(function successCallback(responce){
                    console.log(responce.data);
                    $scope.user_id = 0;
                   if((responce.data.status==true )&&(responce.data.msg == true))
                   {
                       $scope.button='Submit';
                      swal(
                            'Good job!',
                            'Payment Added Successfully',
                            'success'
                          ).then(function() {
                          location.href = pathname+'User';
                          //$scope.loadContent(); 
            });
                   }
                   else if((responce.data.status == true) && (responce.data.msg == false))
                   {
                       localStorage.clear();
                       $scope.button='Submit';
                         swal(
                            'Good job!',
                            'Payment Updated Successfully',
                            'success'
                          ).then(function() {
                                   //  $scope.loadContent();
                                   location.href = pathname+'User';
            });
                       //$scope.loadprojects();
                   }else{
                       alert("something went wrong");
                       location.reload(); 
                       //$scope.loadprojects();
                   }
                },function errorCallback(responce){
		  console.log(responce.data);
		});
            
        }
  }

};



});

app.controller("UserCtr",function($scope,$http,$window,UserDataDetails){

$scope.CoureseLists = function (category_id) {
    
     $http({
        url:pathname+'Course/GetCourseList',
        method:'POST',
        headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                },
        data:$.param( {category_id:category_id} )
    }).then(function successCallback(responce){
     $scope.CourseResult = responce.data;
     
      },function errorCallback(responce){
      //console.log(responce);
      });
    //  $scope.loadContent();
   };
$scope.button='Submit';	
$scope.csv ="";
$scope.module=true; 
var responce = angular.fromJson($window.localStorage.getItem("UserList")); //string convert to object and get value

       if(responce != null){
                $scope.button='Update';	
		$scope.user_id = responce.UserDet.user_id;
                $scope.full_name = responce.UserDet.full_name;
                $scope.password = responce.UserDet.password;                
                $scope.email = responce.UserDet.email;                
                $scope.mobile = responce.UserDet.mobile;        
                var module_id_list = responce.UserDet.module_id_list;
                if(module_id_list!=null)
                {    
                $scope.csv = module_id_list.slice(0, -1);
            }              
               }
               
// Check username 
 $scope.checkUsername = function(){
 var owner_email = angular.element(document.querySelector('[name="email"]')).val().trim();
    $http({
			url:pathname+'User/CheckUserName',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({username:owner_email})
		}).then(function successCallback(responce){
                     if (responce.data.estatus==1){
                         $scope.checkUser=true;
                         $scope.unamestatus="Username/Email Allredy Exit.!!";
                         $scope.isDisabled = true;

                     }
                     if (responce.data.estatus==0){
                         $scope.checkUser=true;
                         $scope.unamestatus="";
                           $scope.isDisabled = false;

                     }
                     
               },function errorCallback(responce){
      console.log(responce);
      });
};
 
// Check Mobile No 
 $scope.checkMobileValidation = function(){
     
 var owner_mobile = angular.element(document.querySelector('[name="mobile"]')).val().trim();
    $http({
			url:pathname+'User/CheckMobile',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({mobile:owner_mobile})
		}).then(function successCallback(responce){
                     if (responce.data.estatus==1){
                         $scope.checkMobile=true;
                         $scope.mobilestatus="Mobile No. Allredy Exit.!!";
                         $scope.isDisabled = true;

                     }
                     if (responce.data.estatus==0){
                         $scope.checkMobile=true;
                         $scope.mobilestatus=" ";
                          $scope.isDisabled = false;

                     }
                     
               },function errorCallback(responce){
      console.log(responce);
      });
}; 
 
$scope.loadContent = function(){
  
   $http({
        url:pathname+'User/loadUserData',
        method:'POST',
        headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                },
        data:$.param( {} )
    }).then(function successCallback(responce){
     $scope.dataResult = responce.data;
      },function errorCallback(responce){
      console.log(responce);
      });
};
$scope.loadContent();

$scope.UsersubmitForm = function(){

 var numbericreg = /^(?:[1-9]\d*|\d)$/;
 var phnrgx = /^([987]{1})(\d{1})(\d{8})$/;
 var emailrgx = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$|^$/;
 var count = 0;
 var fd = false;
 var fd = new FormData();
        
    var full_name = angular.element(document.querySelector('[name="full_name"]')).val().trim();
    var password = angular.element(document.querySelector('[name="password"]')).val().trim();
    var email = angular.element(document.querySelector('[name="email"]')).val().trim();
    var mobile = angular.element(document.querySelector('[name="mobile"]')).val().trim();
     
     if($scope.full_name == null || $scope.full_name == undefined || $scope.full_name == ""){
      angular.element(document.querySelector('[id="errorfull_name"]')).html('').append("Please enter full name");
      count++;
    } else {
      angular.element(document.querySelector('[id="errorfull_name"]')).html('').append("");
    }
     if($scope.password == null || $scope.password == undefined || $scope.password == ""){
      angular.element(document.querySelector('[id="errorpassword"]')).html('').append("Please enter password");
      count++;
    } else {
      angular.element(document.querySelector('[id="errorpassword"]')).html('').append("");
    }
    
    if($scope.email == null || $scope.email ==undefined || $scope.email == ''){

      angular.element( document.querySelector('#erroremail')).html('').append('Please enter email id');
      count++;

    } else if( $scope.email != ''  && !$scope.email.match(emailrgx)){
       angular.element( document.querySelector('#erroremail')).html('').append('Please enter valid email id');
      count++;
    } else {

      angular.element( document.querySelector('#erroremail')).html('').append('');
      //count=0;

    }

    if($scope.mobile == null || $scope.mobile == undefined || $scope.mobile == ''){

      angular.element( document.querySelector('#errormobile')).html('').append('Please enter mobile number');
      count++;

    }  else {

      angular.element( document.querySelector('#errormobile')).html('').append('');
      count=0;

    }
    var module_id_list = "";
        $('input[name=module_id]:checked').each(function () {
            var status = (this.checked ? $(this).val() : "");
            module_id_list += status + ",";
        });
        
        if(module_id_list == '' || module_id_list == null || module_id_list == 'undefined'){
		angular.element(document.querySelector('[id="ErrorDivmodule"]')).html('').append("Please select module");
		count++;
	} else {
		angular.element(document.querySelector('[id="ErrorDivmodule"]')).html('').append("");
	}
   var user_id = ($scope.user_id)?$scope.user_id:0;
   $scope.formData=$("#Userform").serialize()+'&user_id='+user_id;
   if($scope.formData){
    
     // alert($scope.formData);
      //console.log($scope.project);
    
        if(count>0)
        {
            return false;
        }
        else{
            return $http({
			url:pathname+'User/SaveUser',
				cache:false,
				method:'POST',
				headers : {
                                   'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
                                //data    :($scope.formData),
                                data:$.param({ user_id:user_id,full_name:full_name,password:password,email:email,mobile:mobile,module_id_list:module_id_list}),
				
		}).then(function successCallback(responce){
                    console.log(responce.data);
                    $scope.user_id = 0;
                   if((responce.data.status==true )&&(responce.data.msg == true))
                   {
                       $scope.button='Submit';
                      swal(
                            'Good job!',
                            'User Added Successfully',
                            'success'
                          ).then(function() {
                          location.href = pathname+'User';
                          //$scope.loadContent(); 
            });
                   }
                   else if((responce.data.status == true) && (responce.data.msg == false))
                   {
                       localStorage.clear();
                       $scope.button='Submit';
                         swal(
                            'Good job!',
                            'User Updated Successfully',
                            'success'
                          ).then(function() {
                                   //  $scope.loadContent();
                                   location.href = pathname+'User';
            });
                       //$scope.loadprojects();
                   }else{
                       alert("something went wrong");
                       location.reload(); 
                       //$scope.loadprojects();
                   }
                },function errorCallback(responce){
		  console.log(responce.data);
		});
            
        }
  }

};



});

app.controller('UserListController',function($scope,$http,$location,$timeout,$rootScope,$window)
{
localStorage.clear();

   
$scope.EditUsers=function(user_id){
    
  return $http({
			url:pathname+'User/EditUser',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({user_id:user_id})
		}).then(function successCallback(responce){
                    localStorage.clear();
                   $rootScope.UserList = responce.data; 
                   if(responce.data.UserDet!=undefined){
                     var token = JSON.stringify($rootScope.UserList); // object convert to string
                    $window.localStorage.setItem("UserList",token);  
                   }
                   
                $window.location = pathname+'User/AddUser';
                   
                },function errorCallback(responce){
		  console.log(responce);
		});
};


$scope.ActiveUsers=function(user_id,status){
var status_text=(status==1)?"inactive":"active";
swal({
  title: "Are you sure, you want to " +status_text +" the Content?",  
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    
     return $http({
			url:pathname+'User/ActiveUser',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({user_id:user_id,status:status})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
  });
  
   
};


$scope.DeleteUsers=function(user_id){
swal({
 title: "Please confirm record deletion. ",
  text: "Once you delete the user, you will not be able to recover it.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("User deleted successfully.", {
      icon: "success",
    });
     return $http({
			url:pathname+'User/DeleteUser',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({user_id:user_id})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
});

};


$scope.loadContent1 = function(){
     
    return $http({
			url:pathname+'User/loadUserData',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({})
		}).then(function successCallback(responce){
                    //console.log(responce);
                    $scope.dataResult = responce.data;
                },function errorCallback(responce){
		  //console.log(responce);
		});
};
$scope.loadContent1();

});

app.controller('ContactListController',function($scope,$http,$location,$timeout,$rootScope,$window)
{
localStorage.clear();


$scope.DeleteContact=function(contact_id){
swal({
 title: "Please confirm record deletion. ",
  text: "Once you delete the enquiry, you will not be able to recover it.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Enquiry deleted successfully.", {
      icon: "success",
    });
     return $http({
			url:pathname+'Admin/DeleteContacts',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({contact_id:contact_id})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
});

};


$scope.loadContent1 = function(){
     
    return $http({
			url:pathname+'Admin/loadContactListing',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({})
		}).then(function successCallback(responce){
                    //console.log(responce);
                    $scope.dataResult = responce.data;
                },function errorCallback(responce){
		  //console.log(responce);
		});
};
$scope.loadContent1();

});

app.controller('WebinarListController',function($scope,$http,$location,$timeout,$rootScope,$window)
{
localStorage.clear();


$scope.DeleteWebinar=function(webinar_id){
swal({
 title: "Please confirm record deletion. ",
  text: "Once you delete the enquiry, you will not be able to recover it.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Webinar deleted successfully.", {
      icon: "success",
    });
     return $http({
			url:pathname+'Admin/DeleteWebinars',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({webinar_id:webinar_id})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
});

};


$scope.loadContent1 = function(){
     
    return $http({
			url:pathname+'Admin/loadWebinarListing',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({})
		}).then(function successCallback(responce){
                    //console.log(responce);
                    $scope.dataResult = responce.data;
                },function errorCallback(responce){
		  //console.log(responce);
		});
};
$scope.loadContent1();

});


app.controller('PortalUserListController',function($scope,$http,$location,$timeout,$rootScope,$window)
{
$scope.ImageList = function (user_id) {
     $http({
        url:pathname+'Portal/ProfileImage',
        method:'POST',
        headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                },
        data:$.param( {user_id:user_id} )
    }).then(function successCallback(responce){
     $scope.ImageResult = responce.data;
     
      },function errorCallback(responce){
      //console.log(responce);
      });
    //  $scope.loadContent();
   };
    

localStorage.clear();
  
$scope.EditUsers=function(user_id){
    
  return $http({
			url:pathname+'Portal/EditUser',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({user_id:user_id})
		}).then(function successCallback(responce){
                    localStorage.clear();
                   $rootScope.UserList = responce.data; 
                   if(responce.data.UserDet!=undefined){
                     var token = JSON.stringify($rootScope.UserList); // object convert to string
                    $window.localStorage.setItem("UserList",token);  
                   }
                   if(responce.data.JpgImageList!=undefined){
                    $rootScope.JpgEditImageList = responce.data.JpgImageList;     
                    var token = JSON.stringify($rootScope.JpgEditImageList); // object convert to string
                    $window.localStorage.setItem("JpgEditImageList",token);  // set item value
                    }
                $window.location = pathname+'Portal/AddUser';
                   
                },function errorCallback(responce){
		  console.log(responce);
		});
};


$scope.ActiveUsers=function(user_id,status){
var status_text=(status==1)?"inactive":"active";
swal({
  title: "Are you sure, you want to " +status_text +" the Trainee?",  
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    
     return $http({
			url:pathname+'Portal/ActiveUser',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({user_id:user_id,status:status})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
  });
  
   
};


$scope.DeleteUsers=function(user_id){
swal({
 title: "Please confirm record deletion. ",
  text: "Once you delete the user, you will not be able to recover it.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Trainee deleted successfully.", {
      icon: "success",
    });
     return $http({
			url:pathname+'Portal/DeleteUser',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({user_id:user_id})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
});

};


$scope.loadContent1 = function(){
     
    return $http({
			url:pathname+'Portal/loadUserData',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({})
		}).then(function successCallback(responce){
                    //console.log(responce);
                    $scope.dataResult = responce.data;
                },function errorCallback(responce){
		  //console.log(responce);
		});
};
$scope.loadContent1();

});

app.controller('PaymentListController',function($scope,$http,$location,$timeout,$rootScope,$window)
{
localStorage.clear();


$scope.DeletePayment=function(payment_id){
swal({
 title: "Please confirm record deletion. ",
  text: "Once you delete the payment, you will not be able to recover it.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Payment deleted successfully.", {
      icon: "success",
    });
     return $http({
			url:pathname+'Admin/DeletePayments',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({payment_id:payment_id})
		}).then(function successCallback(responce){
		    $scope.loadContent1();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
});

};


$scope.loadContent1 = function(){
     
    return $http({
			url:pathname+'Admin/loadPaymentListing',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({})
		}).then(function successCallback(responce){
                    //console.log(responce);
                    $scope.dataResult = responce.data;
                },function errorCallback(responce){
		  //console.log(responce);
		});
};
$scope.loadContent1();

});
