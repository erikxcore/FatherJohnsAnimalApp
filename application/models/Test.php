<?php
Class Test extends CI_Model
{

 function getAllTest($chart_num){
   $this -> db -> from('tests');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function get_all_test_paged($limit, $start, $chart_num) {
    $this -> db ->limit($limit, $start);
    $this -> db -> from('tests');
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


 function addAnimalTest($chart_num,$date_tested,$name,$results){

   $data = array(
    'chart_num' => $chart_num,
    'date_tested' => $date_tested,
    'name' => $name,
    'results' => $results,
    ); 

    return $this -> db ->insert('tests', $data);
 }

 function removeAnimalTest($id){
          $data = array(
        'id' => $id,
      );
    $this -> db -> from('tests');
    $this -> db -> where('id', $id);
    return $this->db->delete('tests' ,$data);
 }

 function getAnimalTestById($id){
    $this -> db -> from('tests');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function editAnimalTest($id,$date_tested,$name,$results){

  $data = array(
    'date_tested' => $date_tested,
    'name' => $name,
    'results' => $results,
    ); 

    $this -> db -> from('tests');
    $this -> db -> where('id', $id);
    return $this->db->update('tests' ,$data);
 }

 //The following is for the ability to add/edit/remove tests to master list instead of relying on a manually entered list

 function getTest(){
   $this -> db -> from('test');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getTestById($id){
    $this -> db -> from('test');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

   function getTestsForCats(){
    $this -> db -> from('test');
    $this -> db -> where('species', "Cat");
   $query = $this -> db -> get();
   return $query->result_array();
 }

   function getTestsForDogs(){
    $this -> db -> from('test');
    $this -> db -> where('species', "Dog");
   $query = $this -> db -> get();
   return $query->result_array();
 }


 function addTest($name,$species){
   $data = array(
    'name' => $name,
    'species' => $species
    ); 
    return $this -> db ->insert('test', $data);
 }

 function editTest($id,$name,$species){
 $data = array(
    'name' => $name,
    'species' => $species
    ); 
    $this -> db -> from('test');
    $this -> db -> where('id', $id);
    return $this->db->update('test' ,$data);
 }

 function removeTest($id){
    $data = array(
        'id' => $id,
      );
    $this -> db -> from('test');
    $this -> db -> where('id', $id);
    return $this->db->delete('test' ,$data);
 }

}

 ?>