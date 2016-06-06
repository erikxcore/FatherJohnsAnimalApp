<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class VerifyLogin extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }
 
 function index()
 {
   $this->load->library('form_validation');
 
   $this->form_validation->set_rules('username', 'Username', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
 
   if($this->form_validation->run() == FALSE)
   {
     $this->load->view('login_view');
   }
   else
   {
     redirect('home', 'refresh');
   }
 
 }
 
 function check_database($password)
 {
   $username = $this->input->post('username');
 
   $result = $this->user->login($username, $password);
 
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->id,
         'username' => $row->username
       );
       $this->session->set_userdata('logged_in', $sess_array);
       
       $result2 = $this->user->is_superuser($username);
       if($result2){
          $this->session->set_userdata('superuser', true);
       }else{
          $this->session->set_userdata('superuser', false);
       }

       $result3 = $this->user->is_goduser($username);
       if($result3){
          $this->session->set_userdata('goduser', true);
       }else{
          $this->session->set_userdata('goduser', false);
       }

       /*Can probably change this to use an authentication library and change auth types to auth levels*/

     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
}
?>