<div class="page-content-wrapper" ng-controller="DashboardListController">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">

        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?><?php echo $this->config->item('admin_dashboard'); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>

                <span class="active">Dashboard</span>

            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-red-sunglo bold uppercase">Dashboard</span>

                        </div>

                    </div>
                    <div class="portlet-body form">

                        <div class="row">
                            <div class="col-lg-4 col-4 text-center">
                                <!-- small box -->
                                <div class="panel panel-default bg-blue">
                                    <div class="panel-body">
                                        <h3 style="color:#fff;">{{dataResult.data[0].total_users}}</h3>
                                        <p style="color:#fff;"><i class="fa fa-users" aria-hidden="true" ></i> Total Category</p>
                                    </div>

                                    <p class="text-right" style="margin-bottom: 3px;padding-right: 10px;">  <a href="<?php echo base_url(); ?>Portal" class="small-box-footer" style="color:#fff;">More info <i class="fa fa-arrow-circle-right"></i></a></p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-4 text-center">
                                <!-- small box -->
                                <div class="panel panel-default bg-purple-soft">
                                    <div class="panel-body">
                                        <h3  style="color:#fff;">{{dataResult.data[0].total_courses}}</h3>
                                        <p  style="color:#fff;"><i class="fa fa-yelp" aria-hidden="true" ></i> Total Courses</p>
                                    </div>

                                    <p class="text-right" style="margin-bottom: 3px;padding-right: 10px;">  <a href="<?php echo base_url(); ?>Course" class="small-box-footer" style="color:#fff;">More info <i class="fa fa-arrow-circle-right"></i></a></p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-4 text-center">
                                <!-- small box -->
                                <div class="panel panel-default bg-blue-soft">
                                    <div class="panel-body">
                                        <h3  style="color:#fff;">{{dataResult.data[0].total_test}}</h3>
                                        <p  style="color:#fff;"><i class="fa fa-book" aria-hidden="true" ></i> Total Topics</p>
                                    </div>

                                    <p class="text-right" style="margin-bottom: 3px;padding-right: 10px;">  <a href="<?php echo base_url(); ?>Course/Test" class="small-box-footer" style="color:#fff;">More info <i class="fa fa-arrow-circle-right"></i></a></p>
                                </div>
                            </div>




                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">


                                     <div class="panel-body">

                                    <h3>Recent Test Activity </h3> 
                                     <div class="col-md-9">
                            <h3 class="text-primary">Total Activity - <b> {{filteredItems.length}}</b> 
                            <span ng-if="filteredItems.length == 1">Item </span>
                            <span ng-if="filteredItems.length > 1">Items </span>
                            </h3>
                        </div>
                      
                                      <div class="col-md-3 text-right">
                         <a href="<?php echo base_url(); ?>Dashboard/Result" title="Download">  <i class="fa fa-file-excel-o fa-2x " aria-hidden="true"></i></a>
                        </div>
                 
                                    
                                     <div class="col-md-5">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" ng-model="search" placeholder="Trainee Name"> 
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                     <div class="col-md-5">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" ng-model="id" placeholder="ID"> 
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>
                                    <div class="col-md-12">
                                        
                                        <div class="table-responsive">    
                                            <table class="table table-checkable order-column dataTable no-footer table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Course Name</th>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Trainee Name</th>
                                                        <th scope="col">Submitted at</th>
                                                        <th scope="col">Score</th>
                                                        <th><center>Download Certificate</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr dir-paginate="data in filteredItems   = ( dataResult.data | filter : {user_name:search,u_ids:id }   )| itemsPerPage: 10 ">
                                                        <td  width="10%"><span ng-bind="data.number"></span></td>
                                                        <td width="10%"><span ng-bind="data.test_name"></span> </td>
                                                        <td width="10%"><span ng-bind="data.u_ids"></span> </td>
                                                        <td width="20%"><span ng-bind="data.user_name"></span> </td>

                                                        <td width="20%"><span ng-bind="data.upload_date"></span>

                                                        </td>

                                                        <td  width="10%"> <span ng-bind="data.marks"></span>/<span ng-bind="data.tot_no_questions"></span>

                                                            ( <span class="text-success" ng-bind="data.test_result"></span> )
                                                        </td>
                                                          <td  width="10%">
                                         
                                          
                                        <center> 
                                           
                                            <a class="btn btn-link btn-xs" href="<?php echo base_url(); ?>Portal/Certificate/{{data.user_id}}" target="_blank" ng-if="data.result!='Faail'"><i class="fa fa-download fa-2x" aria-hidden="true" ></i> </a> </center>
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



                            </div>




                        </div>
                    </div>


                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>


        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
