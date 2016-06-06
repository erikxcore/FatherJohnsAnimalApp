<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayRuns extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('run','',TRUE);
 }
 

 function removerun($id){
    if($id == null){
      show_404();
    }


     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

   if($this->session->userdata('superuser') != 1){
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a run.');
        redirect('/displayruns', 'refresh');
    }

    $this->run->removeRun($id);

    $this->session->set_flashdata('results', 'Run successfully removed from the database.');
    
    redirect('/displayruns', 'refresh');

 }

 function index()
 {
    $data['allruns'] = $this->run->getAllRuns();

   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display All Runs';
     $this->load->template('displayruns_view', $data);

 }
 

 
}
 
?>