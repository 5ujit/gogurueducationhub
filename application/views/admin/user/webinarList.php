     <div class="page-content-wrapper" ng-controller="WebinarListController">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Webinars
                            
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->

                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BREADCRUMB -->
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_dashboard');?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span class="active">Webinars </span>
                    </li>
                </ul>
                <!-- END PAGE BREADCRUMB -->
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                 <div class="row">
                        <div class="col-md-9">
                            <h3 class="text-primary">Webinar Enquires List - <b> {{filteredItems.length}}</b> 
                             <span ng-if="filteredItems.length == 1">Item </span>
                            <span ng-if="filteredItems.length > 1">Items </span>
                            </h3>
                        </div>
                        <div class="col-md-3 text-right">
                         <a href="<?php echo base_url(); ?>Admin/WebinarExcel" title="Download">Download Webinar Enquires  <i class="fa fa-file-excel-o fa-1x" aria-hidden="true"></i></a>
                        </div>
                    </div>

                            </div>
                            
                            <div class="portlet-body">
    <!-- Content Header (Page header) -->
   
       <div class="card-body">
                    <div class="row">

                       

                        <div class="col-md-12">
                            <div class="table-responsive">    
                                <table class="table table-checkable order-column dataTable no-footer table-bordered">
                                    <thead>
                                        <tr>
                                             <th>S No</th>
                                            <th>Full Name  </th>
                                            <th>Email  </th>
                                            <th>Mobile No  </th>
                                            <th>Courses  </th>  
                                            <th>Upload Date  </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr dir-paginate="ConatctList in filteredItems   = ( dataResult.ConatctList | filter : {full_name:search,banner_type:banner_type }   )| itemsPerPage: 10 ">
                                            <td><span ng-bind="ConatctList.number"></span></td>
                                            <td><span ng-bind="ConatctList.full_name"></span>
                                            </td>
                                            
                                            <td ><span ng-bind="ConatctList.email"></span></td>
                                            <td><span ng-bind="ConatctList.mobile"></span></td>
                                                <td width="20%"><span ng-bind="ConatctList.course_name"></span>
                                                   <span ng-bind="ConatctList.course_id" ng-show="a"></span>
                                                
                                                </td>
                                         
                                        <td width="15%"><span ng-bind="ConatctList.upload_date"></span> <br>
                                            <span ng-bind="ConatctList.user_name" class="label label-default"></span>
                                        </td>
                                        <td width="15%">
                                           
                                            <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="DeleteWebinar(ConatctList.webinar_id)" ><i class="fa fa-trash fa-2x" aria-hidden="true"></i> </a>
                                           
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