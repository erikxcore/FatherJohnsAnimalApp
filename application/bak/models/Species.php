<?php
Class Species extends CI_Model
{

 function getSpeciesName(){
   $this -> db -> from('species');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getSpeciesNameById($id){
    $this -> db -> from('species');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function addSpeciesName($name){
   $data = array(
    'name' => $name,
    ); 
    return $this -> db ->insert('species', $data);
 }

 function editSpeciesName($id,$name){
 $data = array(
    'name' => $name,
    ); 
    $this -> db -> from('species');
    $this -> db -> where('id', $id);
    return $this->db->update('species' ,$data);
 }

 function removeSpeciesName($id){
    $data = array(
        'id' => $id,
      );
    $this -> db -> from('species');
    $this -> db -> where('id', $id);
    return $this->db->delete('species' ,$data);
 }

}

 ?>