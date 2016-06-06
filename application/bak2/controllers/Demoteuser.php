<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class DemoteUser extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }
 
 function index()
 {
  $this->load->library('form_validation');

  $data['usernames'] = $this->user->getAllSuperUsers();
  
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
     $data['title'] = 'Demote a User';
     $this->load->template('demoteuser_view', $data);
   }
   else
   {
     $this->demote_user($this->input->post('username'));
     $this->session->set_flashdata('results', 'User succesfully demoted!');
     redirect('/demoteuser', 'refresh');
   }
 
 }

   function demote_user($username){
    $result = $this->user->remove_superuser($username);

    if($result){
      return TRUE;
    }else{
      $this->form_validation->set_message('check_database', 'There was a problem demoting ' . $username);
      return false;
    }
 }
 

}
?>