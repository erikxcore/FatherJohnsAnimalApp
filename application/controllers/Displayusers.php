<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class DisplayUsers extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }
 
 function index()
 {

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
 

     $data['title'] = 'Display All Users';
     $this->load->template('displayusers_view', $data);

 
 }


}
?>