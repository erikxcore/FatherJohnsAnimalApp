<?php
Class Vaccination_history extends CI_Model
{

 function getAllVaccination($chart_num){
   $this -> db -> from('vaccination_history');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function addVaccinationHistory($chart_num,$entry){
  $data = array(
  'chart_num' => $chart_num,
  'entry' => $entry,
  );
  return $this -> db ->insert('vaccination_history', $data);
 }

}
 ?>