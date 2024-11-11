     <div class="page-content-wrapper" ng-controller="CourseListController">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Course
                            
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

                <span class="active">Category</span>
                
            </li>
            <li>

                <span class="active">Course</span>
                <i class="fa fa-circle"></i>
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
                            <h3 class="text-primary">Course List - <b> {{filteredItems.length}}</b> 
                            <span ng-if="filteredItems.length == 1">Item </span>
                            <span ng-if="filteredItems.length > 1">Items </span>
                            </h3>
                        </div>
                        <div class="col-md-2 text-right">
                            <a href="<?php echo base_url(); ?>Course/AddCourse"  class="btn btn-success fill">Add Course</a>
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
                                            <option value="">All Category</option>
                                            <option value="{{CategoryList.category_id}}" ng-repeat="CategoryList in dataResult.CategoryList">{{CategoryList.category_name}}</option>
                                        </select>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" ng-model="search" placeholder="Course Name"> 
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                        <div class="col-md-12">
                            <div class="table-responsive">    
                                <table class="table table-checkable order-column dataTable no-footer table-bordered">
                                    <thead>
                                        <tr>
                                             <th>S No</th>
                                            <th>Category Name  </th>
                                            <th>Course Name </th> 
                                            <th>Duration(In month) </th> 
                                            <th>Zoom Duration  </th> 
                                            <th>Mentor </th> 
                                            <th>Course Mode</th> 
                                            <th>Status  </th>
                                           <th>Published Date   </th>
                                           <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr dir-paginate="data in filteredItems   = ( dataResult.data | filter : {test_name:search,course_id:course_id }   )| itemsPerPage: 10 ">
                                            <td><span ng-bind="data.number"></span></td>
                                            <td><span ng-bind="data.category_name"></span>
                                            <td width="15%"><span ng-bind="data.course_name"></span>
                                                <span ng-bind="data.course_id" ng-show="a"></span>
                                            </td>
                                           
                                            <td><span ng-bind="data.course_duration"></span> <br>
                                            <span ng-bind="data.course_duration_remarks" class="label label-success"></span>
                                            </td>
                                            <td><span ng-bind="data.zoom_duration"></span> <br>
                                            <span ng-bind="data.zoom_schedule" class="label label-success"></span>
                                            </td>
                                            <td>
                                            <span ng-if="data.mentor_id == 1">Mr. Vinod Gupta </span>
                                            <span ng-if="data.mentor_id == 2">Ms. Geeta Chaudhary </span>
                                            </td>
                                            <td>
                                            <span ng-if="data.course_mode == 0">Offline</span>
                                            <span ng-if="data.course_mode == 1">Online</span>
                                            </td>
                                             
                                            <td width="10%">
                                                  <span ng-if="data.status == 0">Unpublished</span>  
                                                  <span ng-if="data.status == 1">Published</span>
                                            </td>
                                            <td width="10%"><span ng-bind="data.upload_date"></span> <br>
                                            <span ng-bind="data.user_name" class="label label-default"></span>
                                            </td>
                                        <td width="10%">
                                          
                                           <a class="btn btn-link btn-xs" href="javaScript:void(0);" ng-click="EditCoursess(data.course_id)"><i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> </a> 
                                           <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="DeleteCourses(data.course_id, data.status)" ><i class="fa fa-trash fa-2x" aria-hidden="true"></i> </a>
                                           <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="ActiveCoursess(data.course_id, data.status)" ng-if="data.status == 0"> <button type="button" class="btn btn-success btn-sm">Publish</button></a>
                                           <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="ActiveCoursess(data.course_id, data.status)" ng-if="data.status == 1"> <button type="button" class="btn btn-success btn-sm">Unpublish</button></a>
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