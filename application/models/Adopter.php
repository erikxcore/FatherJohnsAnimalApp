<?php
Class Adopter extends CI_Model
{

 function getAdopterByChartNum($chart_num){
   $this -> db -> from('adopter');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function get_all_adopter_paged($limit, $start) {
    $this -> db ->limit($limit, $start);
    $this -> db -> from('adopter');
    $query = $this -> db -> get(); 

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
}

  function record_count_adopters() {
        $this -> db -> from('adopter');
        $query = $this -> db -> get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }



 function addAdopter($name,$phone,$address,$email,$city,$license,$blacklisted,$notes){

   $data = array(
    'name' => $name,
    'phone' => $phone,
    'address' => $address,
    'email' => $email,
    'city' => $city,
    'license' => $license,
    'is_blacklisted' => $blacklisted,
    'notes' => $notes
    ); 

    return $this -> db ->insert('adopter', $data);
 }

 function getAdopterById($id){
    $this -> db -> from('adopter');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function editAdopter($id,$name,$phone,$address,$email,$city,$license,$blacklisted,$notes){
   $data = array(
    'name' => $name,
    'phone' => $phone,
    'address' => $address,
    'email' => $email,
    'city' => $city,
    'license' => $license,
    'is_blacklisted' => $blacklisted,
    'notes' => $notes
    ); 

    $this -> db -> from('adopter');
    $this -> db -> where('id', $id);
    return $this->db->update('adopter' ,$data);
 }

 function getAllAdopters(){
   $this -> db -> from('adopter');
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function getAcceptableAdopters(){
   $this -> db -> from('adopter');
   $this -> db -> where('is_blacklisted != 1');
   $query = $this -> db -> get();
   return $query->result_array();
 } 

 function getAdopterByName($name){
   $this -> db -> from('adopter');
   $this -> db -> like('name', $name);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAdopterByPhone($phone){
   $this -> db -> from('adopter');
   $this -> db -> where('phone', $phone);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function getAdopterByAddress($address){
   $this -> db -> from('adopter');
   $this -> db -> like('address', $address);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAdopterByCity($city){
   $this -> db -> from('adopter');
   $this -> db -> like('city', $city);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAdopterByEmail($email){
   $this -> db -> from('adopter');
   $this -> db -> like('email', $email);
   $query = $this -> db -> get();
   return $query->result_array();
 }

//This will assign an adoptee with a chart number. If the adoptee is already assigned we will first
//retrieve that data, check if the newly assigned animal is already assigned to them (if so do nothing)
//if not, then add to the array and save
//Also have to check if another adoptee is assigned - if so, remove
 function assignAdopter($id,$chart_num){
   $adopter_result = $this->adopter->getAdopterById($id);
   if(isset($adopter_result[0]['chart_num'])){
   $chart_array = unserialize($adopter_result[0]['chart_num']);  
   if(!in_array($chart_num,$chart_array)){
    array_push($chart_array,$chart_num);
   }
   $chart_array = serialize($chart_array);
   }else{
    $chart_array = array($chart_num);
    $chart_array = serialize($chart_array);
   }

   $data = array(
    'chart_num' => $chart_array,
    ); 
    $this -> db -> from('adopter');
    $this -> db -> where('id', $id);
    return $this->db->update('adopter' ,$data);
 }

 function addAdopterHistory($id,$chart_num,$status,$date_assigned){
   $data = array(
    'chart_num' => $chart_num,
    'adopter_id' => $id,
    'status' => $status,
    'date_assigned' => $date_assigned
    ); 
   // $this -> db -> from('adopter_history');
   // $this -> db -> where('id', $id);
   if(!empty($id)){
    return $this->db->insert('adopter_history' ,$data);
    }
 }

 function getAdopterHistory($chart_num){
  /*
   $data = array(
    'chart_num' => $chart_num,
    ); 
    $this -> db -> from('adopter_history');
    $this -> db -> where('chart_num', $chart_num);
    return $this->db->update('adopter_history' ,$data);
  */
   $query =    $this->db->query('SELECT adopter.name,adopter.id,adopter_history.adopter_id,adopter_history.chart_num,adopter_history.status,adopter_history.date_assigned FROM adopter JOIN adopter_history ON adopter.id = adopter_history.adopter_id WHERE adopter_history.chart_num = "'.$chart_num.'"');

   return $query->result_array();

 }

/*
 function updateAdopterHistory($id,$chart_num,$status){

 }
*/

//Remove the incoming chart number from the array on the incoming ID
//If somehow the adoptee doesn't have the assigned chart number do nothing since that call is erroneous
 function removeAssignedAdopter($id,$chart_num){

   $adopter_result = $this->adopter->getAdopterById($id);

   if(isset($adopter_result[0]['chart_num'])){
    $chart_array = unserialize($adopter_result[0]['chart_num']);  
    if(in_array($chart_num,$chart_array)){
      $chart_array = array_diff($chart_array, array($chart_num));
      $chart_array = serialize($chart_array);
    }else{
      $chart_array = serialize($chart_array);
    }
  }

    $data = array(
        'chart_num' => $chart_array,
      );
    $this -> db -> from('adopter');
    $this -> db -> where('id', $id);
    return $this->db->update('adopter' ,$data);
 }

 function removeAdopter($id){
    $data = array(
        'id' => $id,
      );
    $this -> db -> from('adopter');
    $this -> db -> where('id', $id);
    return $this->db->delete('adopter' ,$data);
 }


 function removeAdopterByChartNum($chart_num){
    $data = array(
        'chart_num' => null,
      );
    $this -> db -> from('adopter');
    $this -> db -> where('chart_num', $chart_num);
    return $this->db->update('adopter' ,$data);
 }

}

 ?>