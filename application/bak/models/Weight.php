<?php
Class Weight extends CI_Model
{

function add_weight($chart_num,$weight,$date){
    $data = array(
    'chart_num' => $chart_num,
    'weight' => $weight,
    'date' => $date,
    );
    return $this -> db ->insert('weight', $data);
}

function remove_weight($id){
      $data = array(
     'id' => $id,
      );
    $this -> db -> from('weight');
    $this -> db -> where('id', $id);
    return $this->db->delete('weight' ,$data);
}

function getAllWeights($chart_num){
   $this -> db -> from('weight');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function getWeightById($id){
   $this -> db -> from('weight');
   $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

   function editWeight($id,$weight,$date){
        $data = array(
        'weight' => $weight,
        'date' => $date,
      );
    $this -> db -> from('weight');
    $this -> db -> where('id', $id);
    return $this->db->update('weight' ,$data);
 }

}
 ?>