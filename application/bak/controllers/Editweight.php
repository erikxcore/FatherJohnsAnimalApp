<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditWeight extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
   $this->load->model('weight','',TRUE);
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
    $data['weight'] = $this->weight->getWeightById($id[0]);

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
   $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
   $this->form_validation->set_rules('date', 'Date', 'trim|required');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Edit An Animal\'s Weight';
     $this->load->template('editweight_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->edit_weight($this->input->post('id'),$this->input->post('weight'),$this->input->post('date'));
     $this->session->set_flashdata('results', 'Weight succesfully modified!');
     redirect('/editanimal/'.$chart_num, 'refresh');
   }else{
     $data['title'] = 'Edit An Animal\'s Vaccination';
     $this->load->template('editvaccination_view', $data);
   }
 
 }

 function edit_weight($id,$weight,$date){
    $date_converted = date('Y-m-d', strtotime($date));
    $result = $this->weight->editWeight($id,$weight,$date_converted);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding the animal\'s weight.');
      return false;
    }
 }

 

 
}
 
?>