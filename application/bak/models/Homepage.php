<?php
Class Homepage extends CI_Model
{

 function enableHomePage(){
  $data = array(
  'enabled' => 'true',
  );
   $this -> db -> from('homepage_options');
   $this -> db -> where('id', '1');
   return $this->db->update('homepage_options' ,$data);
 }

 function disableHomePage(){
  $data = array(
  'enabled' => 'false',
  );
   $this -> db -> from('homepage_options');
   $this -> db -> where('id', '1');
   return $this->db->update('homepage_options' ,$data);
 }

function editSections($amount){
    $data = array(
  'sections' => $amount,
  );
   $this -> db -> from('homepage_options');
   $this -> db -> where('id', '1');
   return $this->db->update('homepage_options' ,$data);
}

function editSectionsJson($json){
    $data = array(
  'sections_json' => $json,
  );
   $this -> db -> from('homepage_options');
   $this -> db -> where('id', '1');
   return $this->db->update('homepage_options' ,$data);

}

function getSectionsAmount(){
   $this -> db -> select('sections');
   $this -> db -> from('homepage_options');
   $this -> db -> where('id', '1');
   $query = $this -> db -> get();
   return $query->result_array();
}

function getSectionsJson(){
   $this -> db -> select('sections_json');
   $this -> db -> from('homepage_options');
   $this -> db -> where('id', '1');
   $query = $this -> db -> get();
   return $query->result_array();
}

 function getHomePageEnabled(){
   $this -> db -> select('enabled');
   $this -> db -> from('homepage_options');
   $this -> db -> where('id', '1');
   $query = $this -> db -> get();

   if($query->result_array()[0]['enabled'] == true){
    return true;
   }else{
    return false;
   }
 }

 function getAllHomepageDetails(){
   $this -> db -> from('homepage_options');
   $this -> db -> where('id', '1');
   $query = $this -> db -> get();
   return $query->result_array();
 }


}

 ?>