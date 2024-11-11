var adminApp = angular.module("RVLabData",['720kb.datepicker','summernote','angularUtils.directives.dirPagination']);
var pathname = "http://localhost/rama/";
//var pathname="https://www.ramahospital.com/";

adminApp.controller('CategoryNameController',function($scope,$http,$location,$timeout,$window)
{


$scope.delImage = function (image_id) {

var park_image=$('#park_image_id').val();  
var after=park_image.replace(image_id+",", '');
//alert(after);
$('#park_image_id').val(after);  
$("#"+image_id).remove();
$("#button_"+image_id).remove();
$("#div_"+image_id).remove();


    }; 
    
$scope.button='Submit';	

var responce = angular.fromJson($window.localStorage.getItem("CategoryList")); //string convert to object and get value
var CategoryImageListResult = angular.fromJson($window.localStorage.getItem("CategoryEditImageList"));
if(CategoryImageListResult!=null){
         $scope.CategoryImageListResult=CategoryImageListResult;
     }
     else
     {
         $scope.CategoryImageListResult='';
     }
            if(responce != null){
                $scope.button='Update';	
		$scope.category_id = responce.CategoryDet.category_id;
                $scope.category_name = responce.CategoryDet.category_name;
		$scope.park_image_id = responce.CategoryDet.image_id;
               }


$scope.BankNameForm=function(){

        var category_name = angular.element(document.querySelector('[name="category_name"]')).val().trim();
        var park_image_id = angular.element(document.querySelector('[name="park_image_id"]')).val().trim();
       	var category_id = ($scope.category_id)?$scope.category_id:0;//angular.element(document.querySelector('[name="dep_id"]')).val().trim();
       
        angular.element(document.querySelector('[id="success_msg"]')).html("");
	count=0;
        
    

	if(category_name == '' || category_name == null || category_name == 'undefined'){
          	angular.element(document.querySelector('[id="ErrorDiv"]')).html('').append("Please enter Category Name");
		count++;
	} else {
		angular.element(document.querySelector('[id="ErrorDiv"]')).html('').append("");
	}
             if(park_image_id == null || park_image_id == undefined || park_image_id == ""){
     angular.element(document.querySelector('[id="Errorpark_image_id"]')).html('').append("Please Upload Category Image!");
      count++;
    } else {
      angular.element(document.querySelector('[id="Errorpark_image_id"]')).html('').append("");
    }
        //count++;
	if(count>0){
		return false;
	}
        
	else{
	
        return $http({
			url:pathname+'admin/AddCategory',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({ category_id:category_id,category_name:category_name,park_image_id:park_image_id })
		}).then(function successCallback(responce){
               
                    localStorage.clear();
			console.log(responce);
			if(responce.data.status==true)
                        {
                            $scope.category_id=0;
                            $scope.button='Submit';
                            swal(
                            'Thank you.',
                            'Category updated successfully.',
                            'success'
                          ).then(function() {
                                          location.href = 'Category';
            });
                        }
                        else
                        {
                           angular.element(document.querySelector('[id="success_msg"]')).addClass("error_text"); 
                           angular.element(document.querySelector('[id="success_msg"]')).html(responce.data.msg); 
                        }
		},function errorCallback(responce){
		  //console.log(responce);
		});
	}
};
});




adminApp.controller('SubCategoryNameController',function($scope,$http,$location,$timeout,$rootScope,$window)
{

$scope.button='Submit';	

	
var responce = angular.fromJson($window.localStorage.getItem("SubCategoryList")); //string convert to object and get value
var SubCategoryImageListResult = angular.fromJson($window.localStorage.getItem("SubCategoryEditImageList"));
if(SubCategoryImageListResult!=null){
         $scope.SubCategoryImageListResult=SubCategoryImageListResult;
     }
     else
     {
         $scope.SubCategoryImageListResult='';
     }
            if(responce != null){
                $scope.button='Update';	
		$scope.category_id = responce.SubCategoryDet.category_id;
                $scope.sub_category_id = responce.SubCategoryDet.sub_category_id;
                $scope.sub_category_name = responce.SubCategoryDet.sub_category_name;
		$scope.park_image_id = responce.SubCategoryDet.image_id;
               }
               
$scope.SubCatForm=function(){

        var sub_category_name  = angular.element(document.querySelector('[name="sub_category_name"]')).val().trim();
        var category_id  = angular.element(document.querySelector('[name="category_id"]')).val().trim();
	var sub_category_id = ($scope.sub_category_id)?$scope.sub_category_id:0;//angular.element(document.querySelector('[name="dep_id"]')).val().trim();
        var park_image_id = angular.element(document.querySelector('[name="park_image_id"]')).val().trim();
        angular.element(document.querySelector('[id="success_msg"]')).html("");
	count=0;
        if(category_id == '' || category_id == null || category_id == 'undefined'){
		angular.element(document.querySelector('[id="ErrorDivcategory_id"]')).html('').append("Please Select Category Type");
		count++;
	} else {
		angular.element(document.querySelector('[id="ErrorDivcategory_id"]')).html('').append("");
	}
        
	if(sub_category_name == '' || sub_category_name == null || sub_category_name == 'undefined'){
		angular.element(document.querySelector('[id="ErrorDiv"]')).html('').append("Please enter Sub Category Type");
		count++;
	} else {
		angular.element(document.querySelector('[id="ErrorDiv"]')).html('').append("");
	}
         if(park_image_id == null || park_image_id == undefined || park_image_id == ""){
     angular.element(document.querySelector('[id="Errorpark_image_id"]')).html('').append("Please Upload Sub Category Image!");
      count++;
    } else {
      angular.element(document.querySelector('[id="Errorpark_image_id"]')).html('').append("");
    }
        //count++;
	if(count>0){
		return false;
	}
        
	else{
	
        return $http({
			url:pathname+'admin/AddSubCategory',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({ sub_category_id:sub_category_id,sub_category_name:sub_category_name,category_id:category_id,park_image_id:park_image_id })
		}).then(function successCallback(responce){
                   
			console.log(responce);
			if(responce.data.status==true)
                        {
                             localStorage.clear();
                               $scope.sub_category_id=0;
                            $scope.button='Submit';
                            swal(
                            'Thank you.',
                            'Sub Category updated successfully.',
                            'success'
                          ).then(function() {
                                          location.href = 'SubCategory';
            });
                        }
                        else
                        {
                           angular.element(document.querySelector('[id="success_msg"]')).addClass("error_text"); 
                           angular.element(document.querySelector('[id="success_msg"]')).html(responce.data.msg); 
                        }
		},function errorCallback(responce){
		  //console.log(responce);
		});
	}
};
$scope.SubCategoryContent = function(){
     
    return $http({
			url:pathname+'Admin/SubCategoryListing',
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
$scope.SubCategoryContent();

});


adminApp.controller('SubCategoryNameListController',function($scope,$http,$location,$timeout,$rootScope,$window)
{

$scope.SubCategoryImageList = function (sub_category_id) {

     $http({
        url:pathname+'Admin/SubCategoryImage',
        method:'POST',
        headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                },
        data:$.param( {sub_category_id:sub_category_id} )
    }).then(function successCallback(responce){
     $scope.ImageResult = responce.data;
     
      },function errorCallback(responce){
      //console.log(responce);
      });
    //  $scope.loadContent();
   };
   
$scope.EditSubCategoryTypes=function(sub_category_id){
   
  
     return $http({
			url:pathname+'Admin/EditSubCategory',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({sub_category_id:sub_category_id})
		}).then(function successCallback(responce){
                   
                    $rootScope.SubCategoryList = responce.data;     
                    var token = JSON.stringify($rootScope.SubCategoryList); // object convert to string
                    $window.localStorage.setItem("SubCategoryList",token); // set item value
        
                    if(responce.data.SubCategoryImageList!=undefined){
                    $rootScope.SubCategoryImageList = responce.data.SubCategoryImageList;     
                    var token = JSON.stringify($rootScope.SubCategoryImageList); // object convert to string
                    $window.localStorage.setItem("SubCategoryEditImageList",token);  // set item value
                    }
                    $window.location = pathname+'Admin/SubCategoryAdd';
                },function errorCallback(responce){
		  console.log(responce);
		});
};
$scope.ActiveSubCategoryTypes=function(sub_category_id,status){
    var status_text=(status==1)?"unpublish":"publish";
swal({
   title: "Are you sure, you want to " +status_text +" the Sub Category?",   
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    
     return $http({
			url:pathname+'Admin/ActiveSubCategory',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({sub_category_id:sub_category_id,status:status})
		}).then(function successCallback(responce){
		    $scope.SubCategoryContent();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
  });
};

$scope.DeleteSubCategoryTypes=function(sub_category_id){
  
  swal({
  title: "Please confirm record deletion. ",
  text: "Once you delete the sub category, you will not be able to recover it.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Sub Category deleted successfully.", {
      icon: "success",
    });
     return $http({
			url:pathname+'Admin/DeleteSubCategory',
				cache:false,
				method:'POST',
				headers : {
                                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				},
				data:$.param({sub_category_id:sub_category_id})
		}).then(function successCallback(responce){
		    
                   $scope.SubCategoryContent();
                },function errorCallback(responce){
		  //console.log(responce);
		});
  } else {
    
    return false;
  }
  });
 
};
$scope.SubCategoryContent = function(){
     
    return $http({
			url:pathname+'Admin/SubCategoryListing',
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
$scope.SubCategoryContent();

});


