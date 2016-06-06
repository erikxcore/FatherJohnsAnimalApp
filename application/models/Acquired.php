<?php
Class Acquired extends CI_Model
{

 function getAcquiredName(){
   $this -> db -> from('acquired_method');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAcquiredNameById($id){
    $this -> db -> from('acquired_method');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function addAcquiredName($name){
   $data = array(
    'name' => $name,
    ); 
    return $this -> db ->insert('acquired_method', $data);
 }

 function editAcquiredName($id,$name){
 $data = array(
    'name' => $name,
    ); 
    $this -> db -> from('acquired_method');
    $this -> db -> where('id', $id);
    return $this->db->update('acquired_method' ,$data);
 }

 function removeAcquiredName($id){
    $data = array(
        'id' => $id,
      );
    $this -> db -> from('acquired_method');
    $this -> db -> where('id', $id);
    return $this->db->delete('acquired_method' ,$data);
 }

}

 ?>