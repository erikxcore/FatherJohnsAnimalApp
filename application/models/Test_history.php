<?php
Class Test_history extends CI_Model
{

 function getAllTest($chart_num){
   $this -> db -> from('test_history');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function addTestHistory($chart_num,$entry){
  $data = array(
  'chart_num' => $chart_num,
  'entry' => $entry,
  );
  return $this -> db ->insert('test_history', $data);
 }

}
 ?>