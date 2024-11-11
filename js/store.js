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
    
app.controller("TraineeController",function($scope,$http,$location,$timeout,$rootScope,$window){

$scope.delStoreImage = function (image_id) {
var park_image=$('#store_image_id').val();  
var after=park_image.replace(image_id+",", '');
$('#store_image_id').val(after);  
$("#"+image_id).remove();
$("#button_"+image_id).remove();
$("#div_"+image_id).remove();
};


$scope.button='Submit';	
$scope.csv ="";
$scope.module=true; 
var responce = angular.fromJson($window.localStorage.getItem("UserList")); //string convert to object and get value
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
		$scope.user_id = responce.UserDet.user_id;
                $scope.first_name = responce.UserDet.first_name;
                $scope.last_name = responce.UserDet.last_name;
                $scope.speciality = responce.UserDet.speciality;
                $scope.region = responce.UserDet.region;
                $scope.password = responce.UserDet.password;                
                $scope.email = responce.UserDet.email;                
                $scope.mobile = responce.UserDet.mobile;        
                $scope.store_image_id = responce.UserDet.jpg_image_id;              
               }
$scope.UsersubmitForm = function(){
 var numbericreg = /^(?:[1-9]\d*|\d)$/;
 var phnrgx = /^([987]{1})(\d{1})(\d{8})$/;
 var emailrgx = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$|^$/;
 var count = 0;
 var fd = false;
 var fd = new FormData();
        
    var first_name = angular.element(document.querySelector('[name="first_name"]')).val().trim();
    var last_name = angular.element(document.querySelector('[name="last_name"]')).val().trim();
    var email = angular.element(document.querySelector('[name="email"]')).val().trim();
    var mobile = angular.element(document.querySelector('[name="mobile"]')).val().trim();
     
     if(first_name == null || first_name == undefined || first_name == ""){
      angular.element(document.querySelector('[id="errorfirst_name"]')).html('').append("Please enter first name");
      count++;
    } else {
      angular.element(document.querySelector('[id="errorfirst_name"]')).html('').append("");
    }
     if(last_name == null || last_name == undefined || last_name == ""){
      angular.element(document.querySelector('[id="errorlast_name"]')).html('').append("Please enter last name");
      count++;
    } else {
      angular.element(document.querySelector('[id="errorlast_name"]')).html('').append("");
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
			url:pathname+'Portal/SaveUser',
				cache:false,
				method:'POST',
				headers : {
                                   'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
                                data    :($scope.formData),                               
				
		}).then(function successCallback(responce){
                    console.log(responce.data);
                    $scope.user_id = 0;
                   if((responce.data.status==true )&&(responce.data.msg == true))
                   {
                       $scope.button='Submit';
                      swal(
                            'Good job!',
                            'Trainee Added Successfully',
                            'success'
                          ).then(function() {
                          location.href = pathname+'Portal';
                          //$scope.loadContent(); 
            });
                   }
                   else if((responce.data.status == true) && (responce.data.msg == false))
                   {
                       localStorage.clear();
                       $scope.button='Submit';
                         swal(
                            'Good job!',
                            'Trainee Updated Successfully',
                            'success'
                          ).then(function() {
                                   //  $scope.loadContent();
                                   location.href = pathname+'Portal';
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
