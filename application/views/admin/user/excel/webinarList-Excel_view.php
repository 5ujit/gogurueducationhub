<table id="example1" class="table table-bordered table-striped">
            <thead>
                
                    <tr>
                                            <th>Sr. No.</th>
                                            <th>Full Name  </th>
                                            <th>Email  </th>
                                            <th>Mobile No  </th>
                                            <th>Course   </th>  
                                            <th>Upload Date  </th>
                                            
                                        </tr>
                   
             
            </thead>

            <tbody>
                <?php
                $i=1;
                foreach ($ContactList as $ContactLists) {
                                      ?>
                    <tr>
                       <td><?php echo $i; ?>.</td>
                       <td><?PHP echo $ContactLists['full_name']; ?>  </td>
                       <td><?PHP echo $ContactLists['email']; ?></td>
                       <td><?PHP echo $ContactLists['mobile']; ?></td>
                        <td><?PHP $course_id=$ContactLists['courses_id']; 
                        $CourseDetails = $this->Model->getSqlData("SELECT * FROM  rm_admin_category_course_details WHERE course_id='$course_id' ");
                if (!empty($CourseDetails)) {
                    $course_name = $CourseDetails[0]['course_name'];
                } else {
                    
                   $course_name="NA";
                }
                echo $course_name;
                       ?></td>
                 
                     
                      
                                                                 
                       <td><?PHP echo $ContactLists['upload_date']; ?></td>                  
                        
                    
                    </tr>
                    <?php $i++;
                }
                ?>
            </tbody>
        </table>

     
          
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Webinar-List.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>     
      