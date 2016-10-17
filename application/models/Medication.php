<?php
Class Medication extends CI_Model
{

 function getAllMedication($chart_num){
   $this -> db -> from('medication');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function get_all_medication_paged($limit, $start, $chart_num) {
    $this -> db ->limit($limit, $start);
    $this -> db -> from('medication');
    $this -> db -> where('chart_num', $chart_num);
    $query = $this -> db -> get(); 

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
}

  function addMedication($chart_num,$date_given,$date_due,$name,$notes){
  $data = array(
  'chart_num' => $chart_num,
  'date_given' => $date_given,
  'date_due' => $date_due,
  'name' => $name,
  'notes' => $notes,
  );
  return $this -> db ->insert('medication', $data);
 }

 function removeMedication($id){
      $data = array(
     'id' => $id,
      );
    $this -> db -> from('medication');
    $this -> db -> where('id', $id);
    return $this->db->delete('medication' ,$data);
 }

  function getMedicationById($id){
    $this -> db -> from('medication');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function editMedication($id,$date_given,$date_due,$name,$notes){
        $data = array(
        'id' => $id,
        'date_given' => $date_given,
        'date_due' => $date_due,
        'name' => $name,
        'notes' => $notes,
      );
    $this -> db -> from('medication');
    $this -> db -> where('id', $id);
    return $this->db->update('medication' ,$data);
 }

}
 ?>