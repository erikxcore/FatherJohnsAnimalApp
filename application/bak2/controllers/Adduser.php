<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class AddUser extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }
 
 function index()
 {
  $this->load->library('form_validation');

   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }else{
         redirect('login', 'refresh');
   }
   
   if($this->session->userdata('goduser') != 1){
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify users.');
        redirect('/home', 'refresh');
   }
 
   $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_username_check');
   $this->form_validation->set_rules('password', 'Password', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add a User';
     $this->load->template('adduser_view', $data);
   }
   else
   {
     $this->add_user($this->input->post('username'),$this->input->post('password'));
     $this->session->set_flashdata('results', 'User succesfully added!');
     redirect('/adduser', 'refresh');
   }
 
 }
 
 function username_check($username){
    $result = $this->user->username_check($username);

    if($result){
      $this->form_validation->set_message('username_check', 'There was a problem adding a new user because this username is already taken.');
      return false;
    }else{
      return true;
    }
 }

 function add_user($username,$password){
    $password = password_hash($password, PASSWORD_DEFAULT);
    $result = $this->user->add($username,$password);

    if($result){
      return TRUE;
    }else{
      $this->form_validation->set_message('check_database', 'There was a problem adding a new user.');
      return false;
    }
 }

}
?>