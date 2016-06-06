<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class ChangeAllPassword extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }
 
 function index()
 {
  $this->load->library('form_validation');
  $data['usernames'] = $this->user->getAllUsers();


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
 
   $this->form_validation->set_rules('username', 'Username', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Change Password';
     $this->load->template('changeallpassword_view', $data);
   }
   else
   {
     $this->change_all_password($this->input->post('username'),$this->input->post('password'));
     $this->session->set_flashdata('results', 'Password succesfully changed!');
     redirect('/changeallpassword', 'refresh');
   }
 
 }

 function change_all_password($username,$password){
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