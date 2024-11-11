     <div class="page-content-wrapper" ng-controller="PortalUserListController">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Portal Users
                            
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
                        <span class="active">User</span>
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
                            <h3 class="text-primary">User List - <b> {{filteredItems.length}}</b> 
                             <span ng-if="filteredItems.length == 1">Item </span>
                            <span ng-if="filteredItems.length > 1">Items </span>
                            </h3>
                        </div>
                                     
                              <div class="col-md-3 text-right">
                         <a href="<?php echo base_url(); ?>Admin/UserExcel" title="Download">Download User List  <i class="fa fa-file-excel-o fa-1x" aria-hidden="true"></i></a>
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
                                            <th>Status</th>
                                            <th>Upload Date  </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr dir-paginate="UserList in filteredItems   = ( dataResult.UserList | filter : {name:search,banner_type:banner_type }   )| itemsPerPage: 10 ">
                                            <td><span ng-bind="UserList.number"></span></td>
                                            <td><span ng-bind="UserList.full_name"></span>
                                                 
                                            </td>
                                    
                                            
                                            <td><span ng-bind="UserList.email"></span></td>
                                            <td><span ng-bind="UserList.mobile"></span></td>
                                           <td>
                                                  <span ng-if="UserList.status == 0">Inactive</span>  
                                                  <span ng-if="UserList.status == 1">Active</span>
                                                </td>
                                        <td><span ng-bind="UserList.upload_date"></span> 
                                           
                                        </td>
                                        <td width="20%">
                                           <a class="btn btn-link btn-xs" href="javaScript:void(0);" ng-click="EditUsers(UserList.user_id)"><i class="fa fa-inr fa-2x" aria-hidden="true"></i> </a> 
                                            <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="DeleteUsers(UserList.user_id, UserList.status)" ><i class="fa fa-trash fa-2x" aria-hidden="true"></i> </a>
                                           <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="ActiveUsers(UserList.user_id, UserList.status)" ng-if="UserList.status == 0"> <button type="button" class="btn btn-danger btn-sm"> Activate  </button></a>
                                            <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="ActiveUsers(UserList.user_id, UserList.status)" ng-if="UserList.status == 1"> <button type="button" class="btn btn-default btn-sm"> Deactivate </button></a>
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

                                    <div id="imageDiv" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Profile Picture </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="#" class="form-horizontal" role="form">
                                                        <div class="form-group">
                                                            <div ng-repeat="ImageDet in ImageResult.ImageDet">
                        <img src="{{ImageDet.image_name}}" class="img-responsive"/>
                    
                    </div>
                                                        </div>
                                                        
                                                        
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>