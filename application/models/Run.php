<?php
Class Run extends CI_Model
{

function getTotalRuns(){
   $this -> db -> from('run');
   $query = $this -> db -> get();
  return $query->num_rows();
}

function getAllRuns(){
   $this -> db -> from('run');
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function getAllRunsByOrder(){
   $this -> db -> from('run');
   //mysql specific
   $where = "!ISNULL(order_num)";
   $this -> db -> where($where);
   $this -> db -> order_by("order_num", "ASC"); 
   $query = $this -> db -> get();
   return $query->result_array(); 
 }

 function getColorAndStatus(){
  $query = $this -> db -> query('select status.color , animals.run_num as animal_run_num, animals.status as animal_status from animals JOIN status on status.name = animals.status where animals.run_num != "" order by animal_run_num ASC');
  return $query->result_array();
 }

  function getRun($id){
    $this -> db -> from('run');
    $this -> db -> where('id', $id);
    $query = $this -> db -> get();
    return $query->result_array();
 }

 function getTakenRuns(){
   $query =    $this->db->query("select DISTINCT run_num from animals where run_num != 'null' AND run_num != ''");
   return $query->result_array();
 }

  function getRunByName($name){
    $this -> db -> from('run');
    $this -> db -> where('name', $name);
    $query = $this -> db -> get();
    return $query->result_array();
 }

 function addRun($name,$order){
  if($order == "" || $order == "0"){
    $order = null;
  }
  
   $data = array(
    'name' => $name,
    'order_num' => $order,
    ); 
    return $this -> db ->insert('run', $data);
 }

 function editRun($id,$name,$order){
  if($order == "" || $order == "0"){
    $order = null;
  }

 $data = array(
    'name' => $name,
    'order_num' => $order,
    ); 
    $this -> db -> from('run');
    $this -> db -> where('id', $id);
    return $this->db->update('run' ,$data);
 }

//not the greatest implementation either, however, don't want to cross feet with different types of dbs and update statements (there is a unique constraint against order num)
 function switchRuns($id1,$id2){
  $run1 = $this->getRun($id1);
  $run2 = $this->getRun($id2);
  $order1 = $run1[0]['order_num'];
  $order2 = $run2[0]['order_num'];
  if($this->editRun($run1[0]['id'],$run1[0]['name'],0) &&
  $this->editRun($run2[0]['id'],$run2[0]['name'],0) &&
  $this->editRun($run1[0]['id'],$run1[0]['name'],$order2) &&
  $this->editRun($run2[0]['id'],$run2[0]['name'],$order1)){
    return true;
  }else{
    return false;
  }

 }

 //not particulary useful since we just use all the data everytime anyway

/*
 function getRunName($id){
   $this -> db -> from('run');
   $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getRunColor($id){
    $this -> db -> from('run');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }
*/

//color is now associated to status
 
/*
 function addRun($name,$color){
   $data = array(
    'name' => $name,
    'color' => $color,
    ); 
    return $this -> db ->insert('run', $data);
 }

 function editRun($id,$name,$color){
 $data = array(
    'name' => $name,
    'color' => $color,
    ); 
    $this -> db -> from('run');
    $this -> db -> where('id', $id);
    return $this->db->update('run' ,$data);
 }

*/

 function removeRun($id){
    $data = array(
        'id' => $id,
      );
    $this -> db -> from('run');
    $this -> db -> where('id', $id);
    return $this->db->delete('run' ,$data);
 }

}

 ?>