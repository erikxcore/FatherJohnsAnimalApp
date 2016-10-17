<?php
Class Vaccination extends CI_Model
{

 function getAllVaccination($chart_num){
   $this -> db -> from('vaccination');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function get_all_vaccination_paged($limit, $start, $chart_num) {
    $this -> db ->limit($limit, $start);
    $this -> db -> from('vaccination');
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


 function addVaccination($chart_num,$date_given,$date_completed,$name,$serial_num){

   $data = array(
    'chart_num' => $chart_num,
    'date_given' => $date_given,
    'date_completed' => $date_completed,
    'name' => $name,
    'serial_num' => $serial_num,
    ); 

    return $this -> db ->insert('vaccination', $data);
 }

 function removeVaccination($id){
          $data = array(
        'id' => $id,
      );
    $this -> db -> from('vaccination');
    $this -> db -> where('id', $id);
    return $this->db->delete('vaccination' ,$data);
 }

 function getVaccinationById($id){
    $this -> db -> from('vaccination');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function editVaccination($id,$date_given,$date_completed,$name,$serial_num){

  $data = array(
    'date_given' => $date_given,
    'date_completed' => $date_completed,
    'name' => $name,
    'serial_num' => $serial_num,
    ); 

    $this -> db -> from('vaccination');
    $this -> db -> where('id', $id);
    return $this->db->update('vaccination' ,$data);
 }

 //The following is for the ability to add/edit/remove vaccinations to master list instead of relying on a manually entered list

 function getVaccinationName(){
   $this -> db -> from('vaccinations');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getVaccinationNameById($id){
    $this -> db -> from('vaccinations');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function addVaccinationName($name){
   $data = array(
    'name' => $name,
    ); 
    return $this -> db ->insert('vaccinations', $data);
 }

 function editVaccinationName($id,$name){
 $data = array(
    'name' => $name,
    ); 
    $this -> db -> from('vaccinations');
    $this -> db -> where('id', $id);
    return $this->db->update('vaccinations' ,$data);
 }

 function removeVaccinationName($id){
    $data = array(
        'id' => $id,
      );
    $this -> db -> from('vaccinations');
    $this -> db -> where('id', $id);
    return $this->db->delete('vaccinations' ,$data);
 }

}

 ?>