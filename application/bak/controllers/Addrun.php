<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddRun extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('run','',TRUE);
 } 

 function index()
 {

    $data['totalrun'] = $this->run->getTotalRuns();

    $this->load->library('form_validation');

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
        $this->session->set_flashdata('results', 'You do not have the correct permission to add a run.');
        redirect('/home', 'refresh');
    }
   
   $this->form_validation->set_rules('name', 'Name', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add a Run';
     $this->load->template('addrun_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->add_run($this->input->post('name'),$this->input->post('order_num'));
     $this->session->set_flashdata('results', 'Run succesfully added!');
        redirect('/displayruns', 'refresh');
   }else{
     $data['title'] = 'Add a Run';
     $this->load->template('addrun_view', $data);
    }

 }

 function add_run($name,$order){

    $result = $this->run->addRun($name,$order);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding the run. Perhaps the order number is already taken.');
      return false;
    }
 }

 

 
}
 
?>