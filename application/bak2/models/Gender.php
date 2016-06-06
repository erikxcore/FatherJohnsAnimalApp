<?php
Class Gender extends CI_Model
{

 function getGenderName(){
   $this -> db -> from('sex');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getGenderNameById($id){
    $this -> db -> from('sex');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function addGenderName($name){
   $data = array(
    'name' => $name,
    ); 
    return $this -> db ->insert('sex', $data);
 }

 function editGenderName($id,$name){
 $data = array(
    'name' => $name,
    ); 
    $this -> db -> from('sex');
    $this -> db -> where('id', $id);
    return $this->db->update('sex' ,$data);
 }

 function removeGenderName($id){
    $data = array(
        'id' => $id,
      );
    $this -> db -> from('sex');
    $this -> db -> where('id', $id);
    return $this->db->delete('sex' ,$data);
 }

}

 ?>