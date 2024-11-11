<div class="page-content-wrapper" ng-controller="CourseController">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">

        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_dashboard'); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
              <li>

                <span class="active">Category</span>
                 <i class="fa fa-circle"></i>
            </li>
            <li>

                <span class="active">Course</span>
                
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-red-sunglo bold uppercase">Course</span>

                        </div>

                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form ng-submit="submitCourseForm()" method="post" id="CourseForm" name="CourseForm" class="form-horizontal form-row-seperated">
                            <div class="form-body">

                              <div class="form-group">
                                    <label class="control-label col-md-2">Category Name</label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="course_id" name="category_id" ng-model="category_id" >
                                            <option value="">Select</option>
                                            <option value="{{CategoryList.category_id}}" ng-repeat="CategoryList in dataResult.CategoryList">{{CategoryList.category_name}}</option>
                                        </select>
                                        <span id="ErrorDivcategory_id" class="error_text"></span>
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="control-label col-md-2">Course Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control"  name="course_name" id="course_name" ng-model="course_name">
                                        <span id="ErrorDivtest_name" class="error_text"></span>
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-2">Course Duration</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control"  name="course_duration" id="course_duration" ng-model="course_duration"  >
                                        <span id="ErrorDivcourse_duration" class="error_text"></span>
                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                    <label class="control-label col-md-2">Course Duration Remark</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control"  name="course_duration_remarks" id="course_duration_remarks" ng-model="course_duration_remarks" >
                                        <span id="ErrorDivcourse_duration_remarks" class="error_text"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2"> Zoom Duration (In mins)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control"  name="zoom_duration" id="zoom_duration" ng-model="zoom_duration"  >
                                        <span id="ErrorDivzoom_duration" class="error_text"></span>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-2">Zoom Schedule</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control"  name="zoom_schedule" id="zoom_schedule" ng-model="zoom_schedule" >
                                        <span id="ErrorDivzoom_schedule" class="error_text"></span>
                                    </div>
                                </div>
                                     <div class="form-group">
                                    <label class="control-label col-md-2">Mentor </label>
                                    <div class="col-md-10">
                                         <select class="form-control" name="mentor_id" id="mentor_id" ng-model="mentor_id">
                                                            <option value="">Please Select</option>
                                                            <option value="1">Ms. Geeta Chaudhary </option>
                                                            <option value="2">Mr. Vinod Gupta </option>                                                                                                                       
                                                        </select>
                                        <span id="ErrorDivmentor_id" class="error_text"></span>
                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                    <label class="control-label col-md-2">Course Mode </label>
                                    <div class="col-md-10">
                                         <select class="form-control" name="course_mode" id="course_mode" ng-model="course_mode">
                                                            <option value="">Please Select</option>
                                                            <option value="1">Online</option>
                                                            <option value="0">Offline </option>                                                                                                                       
                                                        </select>
                                        <span id="ErrorDivquestion_type" class="error_text"></span>
                                    </div>
                                </div>
                                  
                                <div class="form-group">
                                    <label class="control-label col-md-2">Course Type </label>
                                    <div class="col-md-10">
                                         <select class="form-control" name="course_type" id="course_type" ng-model="course_type">
                                                            <option value="">Please Select</option>
                                                            <option value="0">Free</option>
                                                            <option value="1">Paid </option>                                                                                                                       
                                                        </select>
                                        <span id="ErrorDivquestion_type" class="error_text"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Course Fee </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control"  name="course_fee" id="course_fee" ng-model="course_fee" maxlength="3" numbers-only>
                                        <span id="ErrorDivquestion_type" class="error_text"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Description</label>
                                    <div class="col-md-10">
                                        <summernote ng-model="editordescription" height="250"></summernote>
                                          <span id="ErrorDivshort_description" class="error_text"></span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2">Images</label>
                                    <div class="col-md-4">

                                        <input type="text" name="store_image_id" id="store_image_id" ng-model="store_image_id" style="display:none;">
                                        <div class="multifile" id="pmulitplefileuploader"> Upload </div>
                                        <div class="imgstatus txtval" name="imgstatus2" id='imgstatus2'></div>
                                        <span ng-repeat="JpgEditImageList in JpgImageListResult">
                                            <div class="col-md-5" id="div_{{JpgEditImageList.image_id}}">
                                                 <button style="margin-left: 5px;" type="button" class="close" ng-click="delStoreImage(JpgEditImageList.image_id)" id="button_{{JpgEditImageList.image_id}}"><span aria-hidden="true">×</span></button>
                                                <img id="{{JpgEditImageList.image_id}}" src="{{JpgEditImageList.image_name}}" class="thumbnail img-responsive" style=" width: 80px; margin-top: 5px; display: block;" />
                                               
                                            </div>
                                        </span>
                                        <span id="Errorjpg_image_id" class="error_text"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">{{button}}</button>
                                                <a href="<?php echo base_url(); ?>Course/Test" class="btn default">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"> </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

</div>