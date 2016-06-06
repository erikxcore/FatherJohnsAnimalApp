<?php
Class User extends CI_Model
{

 function login($username, $password)
 {
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
   $this -> db -> limit(1);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
    $data = $query->result_array();
    if(password_verify($password,$data[0]['password'])){
     return $query->result();
    }else{
      return false;
    }
   }
   else
   {
     return false;
   }
 }

 function add($username,$password){
  $data = array(
 'username' => $username,
 'password' => $password,
  );

  $this -> db -> from('users');
  $this -> db -> where('username', $username);

    return $this -> db ->insert('users', $data);
  }

 function username_check($username){
   $this -> db -> select('username');
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
    return true;
   }else{
    return false;
   }
 }

 function is_superuser($username){
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
    $data = $query->result_array();
    if($data[0]['superuser'] == "1"){
    return true;
    }else{
      return false;
    }
   }else{
    return false;
   }
 }

  function is_goduser($username){
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
    $data = $query->result_array();
    if($data[0]['goduser'] == "1"){
    return true;
    }else{
      return false;
    }
   }else{
    return false;
   }
 }

 function set_superuser($username){
      $data = array(
     'username' => $username,
     'superuser' => 1,
      );

    $this -> db -> from('users');
    $this -> db -> where('username', $username);

    return $this->db->update('users' ,$data);
 }

 function remove_superuser($username){
    $data = array(
      'username' => $username,
      'superuser' => 0,
    );
    $this -> db -> from('users');
    $this -> db -> where('username', $username);
    return $this->db->update('users' ,$data);
 }

 function remove($username){
      $data = array(
     'username' => $username,
      );
    $this -> db -> from('users');
    $this -> db -> where('username', $username);

    return $this->db->delete('users' ,$data);
 }

 function getAllUsers(){
   $block = "admin";
   $this -> db -> from('users');
   $this -> db -> where('username !=',$block); 
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function getAllSuperUsers(){
   $block = "admin";
   $this -> db -> from('users');
   $this -> db -> where('superuser', 1);
   $this -> db -> where('username !=',$block);  
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAllNonSuperUsers(){
   $block = "admin";
   $this -> db -> from('users');
   $this -> db -> where('superuser', 0);
   $this -> db -> where('username !=',$block);  
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function changePassword($username,$password){
      $data = array(
      'username' => $username,
      'password' => $password,
    );
    $this -> db -> from('users');
    $this -> db -> where('username', $username);  
    return $this->db->update('users' ,$data);
 }


}
?>