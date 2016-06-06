<?php
Class Medication_history extends CI_Model
{

 function getAllHistory($chart_num){
   $this -> db -> from('medication_history');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function addMedicationHistory($chart_num,$entry){
  $data = array(
  'chart_num' => $chart_num,
  'entry' => $entry,
  );
  return $this -> db ->insert('medication_history', $data);
 }

}
 ?>