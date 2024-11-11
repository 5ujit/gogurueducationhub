     <div class="page-content-wrapper" ng-controller="CategoryListController">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Category
                            
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
                            <h3 class="text-primary">Category List - <b> {{filteredItems.length}}</b> 
                            <span ng-if="filteredItems.length == 1">Item </span>
                            <span ng-if="filteredItems.length > 1">Items </span>
                            </h3>
                        </div>
                        <div class="col-md-2 text-right">
                            <a href="<?php echo base_url(); ?>Category/AddCategory"  class="btn btn-success fill">Add Category</a>
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
                                            <th>Category Name  </th>
                                            <th>Description  </th>
                                          
                                            <th>Status  </th>
                                           <th>Published Date   </th>
                                           <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr dir-paginate="data in filteredItems   = ( dataResult.data | filter : {name:search,banner_type:banner_type }   )| itemsPerPage: 10 ">
                                            <td><span ng-bind="data.number"></span></td>
                                            <td><span ng-bind="data.category_name"></span> </td>
                                            <td><span ng-bind="data.short_description"></span> </td>
                                            <td>
                                                  <span ng-if="data.status == 0">Unpublished</span>  
                                                  <span ng-if="data.status == 1">Published</span>
                                            </td>
                                        <td ><span ng-bind="data.upload_date"></span> <br>
                                            <span ng-bind="data.user_name" class="label label-default"></span>
                                        </td>
                                        <td>
                                            <a class="btn btn-link btn-xs" href="javaScript:void(0);" ng-click="EditCategorys(data.category_id)"><i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> </a> 
                                            <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="DeleteCategoryss(data.category_id, data.status)" ><i class="fa fa-trash fa-2x" aria-hidden="true"></i> </a>
                                            <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="ActiveCategorys(data.category_id, data.status)" ng-if="data.status == 0"> <button type="button" class="btn btn-success btn-sm">Publish</button></a>
                                            <a href="javaScript:void(0);" class="btn btn-link btn-xs" ng-click="ActiveCategorys(data.category_id, data.status)" ng-if="data.status == 1"> <button type="button" class="btn btn-success btn-sm">Unpublish</button></a>
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
                                                    <h4 class="modal-title">Banner </h4>
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