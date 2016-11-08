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



 function addAdopter($name,$phone,$address,$email,$city,$license){

   $data = array(
    'name' => $name,
    'phone' => $phone,
    'address' => $address,
    'email' => $email,
    'city' => $city,
    'license' => $license
    ); 

    return $this -> db ->insert('adopter', $data);
 }

 function getAdopterById($id){
    $this -> db -> from('adopter');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function editAdopter($id,$name,$phone,$address,$email,$city,$license){
   $data = array(
    'name' => $name,
    'phone' => $phone,
    'address' => $address,
    'email' => $email,
    'city' => $city,
    'license' => $license
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

//Remove the incoming chart number from the array on the incoming ID
//If somehow the adoptee doesn't have the assigned chart number do nothing since that call is erroneous
 function removeAssignedAdopter($id,$chart_num){
   $adopter_result = $this->adopter->getAdopterById($id);

   if(isset($adopter_result[0]['chart_num'])){
    $chart_array = unserialize($adopter_result[0]['chart_num']);  
    if(in_array($chart_num,$chart_array)){
      $chart_array = array_diff($chart_array, array($chart_num));
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