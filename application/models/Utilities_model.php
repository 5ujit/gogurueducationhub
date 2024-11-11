<?php
Class Utilities_model extends CI_Model{

function tableInsert($tablename,$val)
    {
        $this->db->insert($tablename, $val);
        if($this->db->affected_rows() == 1){
         return True;
            }
        else
        {
         return False;
        }
    }

    function getListDet($select,$table_name,$order){
       $query = $this->db->query("SELECT $select From $table_name where status='1'  ORDER BY $order ASC");
       $result = $query->result_array();
       return $result;
    }

    function getListDetCond($select,$table_name,$order,$cond){

       $query = $this->db->query("SELECT $select From $table_name where $cond ORDER BY $order ASC");
       $result = $query->result_array();
       return $result;
    }

     function Manage_listing($table_name,$order_by){
       $query = $this->db->query("SELECT * From $table_name ORDER BY $order_by ASC ");
       $result = $query->result_array();

       return $result;

     }

 function edit_listing($table_name,$condition){
       $sql="SELECT * From $table_name  where $condition ";
       $query = $this->db->query($sql);
       $result = $query->result_array();
       return $result;

     }
 function delete_Data($ID_TNM,$ID,$tbl_name){
      $this->db->where($ID_TNM, $ID);
      $this->db->delete($tbl_name);
    }

    function display_Move_Data($ALL,$tab_mane,$List_Name,$ID){
        $query = $this->db->query("select $ALL from $tab_mane where $List_Name = '$ID' ");
        $result = $query->result_array();
        return $result;
    }

    function update_Data($ID,$val,$tbl_name) {
        $this->db->where($ID, $val[$ID]);
        $this->db->update($tbl_name, $val);
        if($this->db->affected_rows() == 1){
         return True;
            } else  {
         return False;
        }
    }


	function getSqlData($sql){
       	$query = $this->db->query($sql);
      	$result=$query->result_array();
      	return $result;
	}

}
?>