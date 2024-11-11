<div class="page-content-wrapper" ng-controller="BulkQuestionPreController">
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
                <span class="active">Test</span>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Questions</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="caption-subject font-red-sunglo bold uppercase">{{dataResult.data[0].course_name}}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="caption-subject font-red-sunglo bold uppercase">Total Questions - <b class="text-primary"> {{dataResult.data[0].tot_no_questions}}</b></span>
                                </div>
                                <div class="col-md-4">
                                    <span class="caption-subject font-red-sunglo bold uppercase">Total Added Questions - <b class="text-primary">{{dataResult.data[0].total_questions_added}}</b></span>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                       
                            <div class="form-body">

                                <div class="panel panel-default" ng-repeat="data in dataResult.data">
                                    <div class="panel-heading"><p><b>Q{{data.number}}. {{data.question_name}}</b></p></div>
                                    <div class="panel-body">
                                        <div class="radio">
                                            <b> a. </b> <label>
                                                <input type="radio" name="{{data.question_id}}" id="{{data.question_id}}" value="option1" checked>
                                                {{data.answer1}}
                                            </label>
                                        </div> 
                                            <div class="radio">
                                            <b> b. </b> <label>
                                                <input type="radio" name="{{data.question_id}}" id="{{data.question_id}}" value="option1" checked>
                                                {{data.answer2}}
                                            </label>
                                        </div>
                                        
                                            <div class="radio">
                                            <b> c. </b> <label>
                                                <input type="radio" name="{{data.question_id}}" id="{{data.question_id}}" value="option1" checked>
                                                {{data.answer3}}
                                            </label>
                                        </div>
                                        
                                            <div class="radio">
                                            <b> d. </b> <label>
                                                <input type="radio" name="{{data.question_id}}" id="{{data.question_id}}" value="option1" checked>
                                                {{data.answer4}}
                                            </label>
                                        </div>
                                        
                                            
                                        
 </div>
                                    </div>
                                </div>
                            </div> </div>


                </div>
                
          
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