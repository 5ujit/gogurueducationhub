<div class="page-content-wrapper" ng-controller="UserPaymentCtr">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">

        <ul class="page-breadcrumb breadcrumb">
            <li>
               <a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_dashboard');?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">User Management</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-red-sunglo bold uppercase">User Management</span>

                        </div>

                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form ng-submit="PaymentsubmitForm()" method="post" id="Userform" name="Userform" class="form-horizontal form-row-seperated">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Full Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="full_name" name="full_name" ng-model="full_name" maxlength="100" readonly="">
                                        <span id="errorfull_name" class="error_text"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Email Id (Username)</label>
                                    <div class="col-md-10">                                             

                                        <input type="text" class="form-control" id="email" name="email" ng-model="email" maxlength="100"  readonly="">
                                        <span id="erroremail" class="error_text"></span>
                                        <span ng-show="checkUser" class="error_text">{{ unamestatus}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Mobile No </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="mobile" name="mobile" ng-model="mobile" maxlength="10" numbers-only readonly="">
                                        <span id="errormobile" class="error_text"></span>
                                        <span ng-show="checkMobile" class="error_text">{{ mobilestatus}}</span>
                                    </div>
                                </div>
                                
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
                                    <label class="control-label col-md-2">Amount </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control"  name="amount" id="amount" ng-model="amount" numbers-only>
                                        <span id="ErrorDivamount" class="error_text"></span>
                                    </div>
                                </div>
                                
                                
                                 <div class="form-group">
                                    <label class="control-label col-md-2">Description</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="short_description" id="short_description" ng-model="short_description"></textarea>
                                        <span id="ErrorDivshort_description" class="error_text"></span>
                                    </div>
                                </div>
                                
                                


                                <input type="text" ng-model="user_id" style="display:none;">


                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green fill">{{button}}</button>
                                                 <a href="<?php echo base_url(); ?>User" class="btn default">Cancel</a> 
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