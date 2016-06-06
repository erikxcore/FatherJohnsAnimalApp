<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class PromoteUser extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }
 
 function index()
 {
  $this->load->library('form_validation');

  $data['usernames'] = $this->user->getAllNonSuperUsers();
  
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

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Promote a User';
     $this->load->template('promoteuser_view', $data);
   }
   else
   {
     $this->promote_user($this->input->post('username'));
     $this->session->set_flashdata('results', 'User succesfully promoted!');
     redirect('/promoteuser', 'refresh');
   }
 
 }

  function promote_user($username){
    $result = $this->user->set_superuser($username);

    if($result){
      return TRUE;
    }else{
      $this->form_validation->set_message('check_database', 'There was a problem promoting ' . $username);
      return false;
    }
 }


}
?>