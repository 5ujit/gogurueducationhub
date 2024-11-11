<div class="page-content-wrapper" ng-controller="TopicController">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">

        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_dashboard'); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>

                <span class="active">Course</span>
                 <i class="fa fa-circle"></i>
                
            </li>
               <li>
                <span class="active">Topics</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-red-sunglo bold uppercase">Topics</span>

                        </div>

                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form ng-submit="submitTopicsForm()" method="post" id="TopicsForm" name="TopicsForm" class="form-horizontal form-row-seperated">
                            <div class="form-body">

                                
                                       <div class="form-group">
                                    <label class="control-label col-md-2">Category Name</label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="course_id" name="category_id" ng-model="category_id" ng-change="CoureseLists(category_id);">
                                            <option value="">Select</option>
                                            <option value="{{CategoryList.category_id}}" ng-repeat="CategoryList in dataResult.CategoryList">{{CategoryList.category_name}}</option>
                                        </select>
                                        <span id="ErrorDivcategory_id" class="error_text"></span>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-2">Course Name</label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="course_id" name="course_id" ng-model="course_id" >
                                            <option value="">Select</option>
                                            <option value="{{CourseList.course_id}}" ng-repeat="CourseList in CourseResult.CourseList">{{CourseList.course_name}}</option>
                                        </select>
                                        <span id="ErrorDivcourse_name" class="error_text"></span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2">Lesson no </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control"  name="lession_no" id="lession_no" ng-model="lession_no" numbers-only>
                                        <span id="ErrorDivlession_no" class="error_text"></span>
                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                    <label class="control-label col-md-2">Topic Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control"  name="topic_name" id="topic_name" ng-model="topic_name">
                                        <span id="ErrorDivtopic_name" class="error_text"></span>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-2">Description</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="short_description" id="short_description" ng-model="short_description"></textarea>
                                        <span id="ErrorDivshort_description" class="error_text"></span>
                                    </div>
                                </div>
                                
                                

                                <input type="text" ng-model="topic_id" style="display:none;">

                                <div class="form-group">
                                    <label class="control-label col-md-2">Topic Material</label>
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
                                
                                 <div class="form-group">
                                            <label class="control-label col-md-2">YouTube Link</label>
                                            <div class="col-md-10">
                                              <input type="text" class="form-control"  name="youtube_link" id="youtube_link" ng-model="youtube_link">
                                                 <span id="ErrorDivyoutube_link" class="error_text"></span>
                                            </div>
                                        </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">{{button}}</button>
                                                <a href="<?php echo base_url(); ?>Course/Topics" class="btn default">Cancel</a>
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