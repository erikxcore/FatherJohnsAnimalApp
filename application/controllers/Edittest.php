<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditTest extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
   $this->load->model('test','',TRUE);
   $this->load->model('test_history','',TRUE);

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
 

 function index($chart_num,$id)
 {
    if($chart_num == null){
      show_404();
    }

    if($id == null){
      show_404();
    }

    $data['animal'] = $this->animal->getAnimalById($chart_num);
    $data['test'] = $this->test->getAnimalTestById($id[0]);
    
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify an animal.');
        redirect('/displayanimal/'.$chart_num, 'refresh');
     }

   $this->form_validation->set_rules('id', 'ID', 'trim|required');
   $this->form_validation->set_rules('chart_num', 'Chart Number', 'trim|required');
   $this->form_validation->set_rules('test_name', 'Test Name', 'trim|required');
   $this->form_validation->set_rules('date_tested', 'Date Tested', 'trim|required');
   $this->form_validation->set_rules('result', 'Result', 'trim');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Edit An Animal\'s Test';
     $this->load->template('edittest_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->edit_test($this->input->post('id'),$this->input->post('test_name'),$this->input->post('date_tested'),$this->input->post('result'),$this->input->post('chart_num'));
     $this->session->set_flashdata('results', 'Test succesfully modified!');
     redirect('/editanimal/'.$chart_num, 'refresh');
   }else{
     $data['title'] = 'Edit An Animal\'s Test';
     $this->load->template('edittest_view', $data);
   }
 

 }

 function edit_test($id,$name,$date_tested,$results,$chart_num){
    $session_data = $this->session->userdata('logged_in');

         
         if( $results == "TRUE" ){
          $results = true;
         }else if( $results == "FALSE" ) {
          $results = false;
         }

    $date_converted = date('Y-m-d', strtotime($date_tested));

    $result = $this->test->editAnimalTest($id,$date_converted,$name,$results);

    $entry = "Test " . $name . " for " . $chart_num . ' has been updated on ' . date('Y-m-d') . '. Date tested is now ' . $date_converted . '. Results are now: ' . $results . " <br/> by " . $session_data['username'];

    if($result){
      $this->test_history->addTestHistory($chart_num,$entry);
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem editing the animal\'s test.');
      return false;
    }
 }

 

 
}
 
?>