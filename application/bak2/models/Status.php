<?php
Class Status extends CI_Model
{

 function getStatusName(){
   $this -> db -> from('status');
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function getColorByStatusName($name){
    $this -> db -> from('status');
    $this -> db -> where('name', $name);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function getColorByStatusId($id){
    $this -> db -> from('status');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getStatusNameById($id){
    $this -> db -> from('status');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }


 function addStatusName($name,$color){
   $data = array(
    'name' => $name,
    'color' => $color,
    ); 
    return $this -> db ->insert('status', $data);
 }

 function editStatusName($id,$name,$color){
 $data = array(
    'name' => $name,
    'color' => $color,
    ); 
    $this -> db -> from('status');
    $this -> db -> where('id', $id);
    return $this->db->update('status' ,$data);
 }

 function removeStatusName($id){
    $data = array(
        'id' => $id,
      );
    $this -> db -> from('status');
    $this -> db -> where('id', $id);
    return $this->db->delete('status' ,$data);
 }

}

 ?>