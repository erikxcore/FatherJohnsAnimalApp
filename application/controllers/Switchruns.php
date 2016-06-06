<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Switchruns extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('run','',TRUE);
 }

 function _remap($method,$args)
  {

  if (method_exists($this, $method))
  {
  $this->$method($args);
  }
  else
  {
  $this->index($method,$args);
  }

  }
 

 function index()
 {


    $data['runs'] = $this->run->getAllRuns();

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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a run.');
        redirect('/displayruns', 'refresh');
   }

   $this->form_validation->set_rules('id1', 'Run 1', 'trim|required');
   $this->form_validation->set_rules('id2', 'Run 2', 'trim|required');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Switch Runs';
     $this->load->template('switchruns_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     if($this->input->post('id1') != $this->input->post('id2')){
     $this->switchruns($this->input->post('id1'),$this->input->post('id2'));
     redirect('/displayruns', 'refresh');
     }else{
    $this->session->set_flashdata('results', 'You cannot switch a run\'s order position with itself.');
     $data['title'] = 'Switch Runs';
     $this->load->template('switchruns_view', $data);
     }
   }else{
     $data['title'] = 'Switch Runs';
     $this->load->template('switchruns_view', $data);
   }
 
 }

 function switchruns($id1,$id2){

    $result = $this->run->switchRuns($id1,$id2);
    echo $result;
    
    if($result){
      $this->session->set_flashdata('results', 'Runs were succesfully modified!');
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem modifying the runs.');
      return false;
    }
 }

 

 

 
}
 
?>