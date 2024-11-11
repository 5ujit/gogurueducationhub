<div class="page-content-wrapper" ng-controller="UserChangePasswordCtr">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">

        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>Admin/Product">User</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Change Password</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-red-sunglo bold uppercase">User </span>

                        </div>

                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form ng-submit="submitPasswordForm()" method="post" id="PasswordForm" name="PasswordForm" class="form-horizontal form-row-seperated">
                            <div class="form-body">
                                 <div class="form-group pwdFld">
                                            <label class="control-label col-md-2">Old Password </label>
                                            
                                            <div class="col-md-10">
                                                <input type="password" class="form-control"  name="old_password" id="old_password" ng-model="old_password" ng-blur="checkUserOldPassword();" maxlength="20">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password spwd" divid="old_password" style="top: 8px;right: 22px;"></span>
                                                 <span id="ErrorDivold_password" class="error_text"></span>
                                                  <span ng-show="checkUser" class="error_text">{{ unamestatus}}</span>
                                            </div>
                                        </div>
                                
                                 <div class="form-group pwdFld">
                                            <label class="control-label col-md-2">New Password</label>
                                            
                                            <div class="col-md-10">
                                                <input type="password" class="form-control"  name="new_password" id="new_password" ng-model="new_password" maxlength="20">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password spwd" divid="new_password" style="top: 8px;right: 22px;"></span>
                                                 <span id="ErrorDivnew_password" class="error_text"></span>
                                            </div>
                                        </div>
                               <div class="form-group pwdFld">
                                            <label class="control-label col-md-2">Reenter New Password</label>
                                            
                                            <div class="col-md-10">
                                                  <input type="password" class="form-control"  name="re_new_password" id="re_new_password" ng-model="re_new_password" maxlength="20">
                                                  <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password spwd" divid="re_new_password" style="top: 8px;right: 22px;"></span>
                                                 <span id="ErrorDivre_new_password" class="error_text"></span>
                                            </div>
                                        </div>
                                 
                             
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green fill" ng-disabled="isDisabled">{{button}}</button>
                                                <button type="reset" class="btn default">Cancel</button>
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


    

