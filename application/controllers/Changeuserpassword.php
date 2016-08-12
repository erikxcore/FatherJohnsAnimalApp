<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class ChangeUserPassword extends CI_Controller {
 
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

   if($data['username'] === 'demo'){
      $this->form_validation->set_message('check_database', 'There was a problem changing your password.');
      $data['title'] = 'Change Password';
      $this->load->template('changeuserpassword_view', $data);
   }
 
   $this->form_validation->set_rules('username', 'Username', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Change Password';
     $this->load->template('changeuserpassword_view', $data);
   }
   else
   {
     $this->change_password($this->input->post('username'),$this->input->post('password'));
     $this->session->set_flashdata('results', 'Password succesfully changed!');
     redirect('/changeuserpassword', 'refresh');
   }
 
 }

 function change_password($username,$password){
    $password = password_hash($password, PASSWORD_DEFAULT);
    $result = $this->user->changePassword($username,$password);

    if($result){
      return TRUE;
    }else{
      $this->form_validation->set_message('check_database', 'There was a problem changing your password.');
      return false;
    }
 }

}
?>