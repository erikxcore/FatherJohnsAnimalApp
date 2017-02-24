<?php
Class Medication extends CI_Model
{

 function getAllMedication($chart_num){
   $this -> db -> from('medication');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }

   function getAllMedicationByDate($date){
   $query =    $this->db->query('SELECT animals.id,animals.name,animals.chart_num,animals.status,medication.name as medication_name,medication.date_due,medication.date_given FROM animals JOIN medication ON medication.chart_num = animals.chart_num WHERE medication.date_due = "'.$date.'" AND animals.status != "Adopted"');   //improve to return only the unique row instead of repeat rows if an animal has multiple vaccinations due
   //may be better to display all vacations for an animal however
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

  function addMedication($chart_num,$date_given,$date_due,$name,$notes,$duration,$dose){
  $data = array(
  'chart_num' => $chart_num,
  'date_given' => $date_given,
  'date_due' => $date_due,
  'name' => $name,
  'notes' => $notes,
  'duration' => $duration,
  'dose' => $dose,
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

  function editMedication($id,$date_given,$date_due,$name,$notes,$duration,$dose){
        $data = array(
        'id' => $id,
        'date_given' => $date_given,
        'date_due' => $date_due,
        'name' => $name,
        'notes' => $notes,
        'duration' => $duration,
        'dose' => $dose,
      );
    $this -> db -> from('medication');
    $this -> db -> where('id', $id);
    return $this->db->update('medication' ,$data);
 }

}
 ?>