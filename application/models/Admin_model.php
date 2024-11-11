<?php 
class Admin_model extends CI_Model
{
		function check_data($table,$array)
		{
			 return $this->db->get_where($table,$array)->row();
		}
                
              
                function select_all_data($table,$array,$order_feild,$order_by)
		{
                        
			$select=$this->db->order_by("$order_feild","$order_by")->get_where($table,$array);
                        return $select->result();
		}
                function indert_data($table,$array)
		{
			 $this-> db->insert($table,$array);
                         return $this->db->insert_id();
		}
                function update_data($table,$array,$where)
                {
                    $this->db->where($where);
                    $this->db->update($table,$array);
                     return "1";
                }
                function enable_disable($table,$id,$value)
                {
                    echo $query = $this->db->query("UPDATE ".$table." SET status= CASE  WHEN status=1 THEN 0 ELSE 1 END where $id=$value");
                    
                    
                    
                }
	function getDataquery($query)
	{
		      $select=$this->db->query($query);
              return $select->row();
	}
	function getAllDataquery($query)
	{
		      $select=$this->db->query($query);
              return $select->result();
	}
	function row_delete($where , $table)
  {

      $this->db->where($where);
      $this->db->delete($table); 
	  return "1";
  }
	
}

?>