     <div class="page-content-wrapper" ng-controller="BulkTestListController">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Bulk Upload 
                            
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->

                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BREADCRUMB -->
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                         <a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_dashboard'); ?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span class="active">Bulk Test Listings</span>
                    </li>
                </ul>
                <!-- END PAGE BREADCRUMB -->
                <!-- BEGIN PAGE BASE CONTENT -->
                     <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                 <div class="row">
                        <div class="col-md-10">
                            <h3 class="text-primary">Bulk Test Questions List - <b> {{filteredItems.length}}</b> <span ng-if="filteredItems.length == 1">Item </span>
                            <span ng-if="filteredItems.length > 1">Items </span>
                            </h3>
                        </div>
                        <div class="col-md-2 text-right">
                            <a href="<?php echo base_url(); ?>Import/AddTest"  class="btn btn-success green btn">Add Questions</a>
                        </div>
                    </div>

                            </div>
                            
                            <div class="portlet-body">
    <!-- Content Header (Page header) -->
   
       <div class="card-body">
                    <div class="row">

                             <div class="col-md-5">
                                    <div class="form-group form-md-line-input">
                                         <select class="form-control" id="course_id" name="course_id" ng-model="course_id" >
                                            <option value="">All Courses</option>
                                            <option value="{{CourseList.course_id}}" ng-repeat="CourseList in dataResult.CourseList">{{CourseList.course_name}}</option>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" ng-model="search" placeholder="Test Name"> 
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                        <div class="col-md-12">
                            <div class="table-responsive">    
                                <table class="table table-checkable order-column dataTable no-footer table-bordered">
                                    <thead>
                                        <tr>
                                             <th>S No</th>
                                            <th>Course Name  </th>
                                            <th>Test Name </th> 
                                            <th>Total No. of Questions Uploaded </th>                                         
                                          
                                           <th>Upload Date   </th>
                                           <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr dir-paginate="data in filteredItems   = ( dataResult.data | filter : {test_name:search,course_id:course_id }   )| itemsPerPage: 10 ">
                                            <td><span ng-bind="data.number"></span></td>
                                            <td width="10%"><span ng-bind="data.course_name"></span>   </td>
                                            <td width="20%"><span ng-bind="data.test_name"></span></td>
                                            <span ng-bind="data.course_id" ng-show="d"></span>
                                            <td width="10%"><span ng-bind="data.no_of_questions"></span>   </td>
                                        
                                          
                                        <td width="20%"><span ng-bind="data.upload_date"></span> 
                                        </td>
                                        <td width="25%">
                                           <a class="btn btn-link btn-xs" href="javaScript:void(0);" ng-click="AddQuestionss(data.test_id)" ng-if="data.question_status == 1"><i class="fa fa-plus-square fa-2x" aria-hidden="true" title="Add Questions"></i> </a> 
                                           <a class="btn btn-link btn-xs" href="javaScript:void(0);" ng-click="PriviewQuestionss(data.track_id)"><i class="fa fa-play fa-2x" aria-hidden="true" title="Preview"></i> </a> 
                                            <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="DeleteTests(data.track_id, data.status)" ><i class="fa fa-trash fa-2x" aria-hidden="true"></i> </a>
                                           <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="ActiveTestss(data.track_id, data.status)" ng-if="data.status == 0"> <button type="button" class="btn btn-danger btn-sm">Unpublished</button></a>
                                           <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="ActiveTestss(data.track_id, data.status)" ng-if="data.status == 1"> <button type="button" class="btn btn-default btn-sm">Published</button></a>
                                        </td>
                                    </tr> 
                                    <tr ng-if="dataResult.status == false" class="text-center">
                                        <td colspan="10"><span>No records found</span></td>

                                    </tr>

                                </tbody></table>
                        </div>
                        <dir-pagination-controls max-size="1" direction-links="true" boundary-links="true" >
                        </dir-pagination-controls>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->

                                    

                                </div>