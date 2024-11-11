<div class="page-content-wrapper" ng-controller="AboutProductController">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">

        <ul class="page-breadcrumb breadcrumb">
            <li>
               <a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_dashboard'); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Import</span>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Trainee </span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-red-sunglo bold uppercase">Import Trainee</span>

                        </div>

                    </div>
                 
                        <!-- BEGIN FORM-->
                        
                      
                        <form role="form" name="parkForm" id="parkForm" enctype="multipart/form-data" action="<?php echo base_url(); ?>Import/UploadUser" method="post">
                            <div class="row">
                                
                                
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input">
                                        <label for="inputEmail3" class="colcontrol-label">Upload CSV File</label>
                                        <input type="file" name="file_source" id="file_source" class="form-control" > 
                                        <div class="form-control-focus"> </div>
                                        <?php if($msg!='') { ?>
                                        <span id="ErrorDiv" class="error_text"> <?PHP echo $msg;?></span>
                                        <?php } ?>
                                        
                                    </div>
                                </div>

                                <div class="form-actions text-right">
                                    <button type="submit" class="btn green">Import Trainee</button>
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