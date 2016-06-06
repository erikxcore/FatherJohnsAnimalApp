<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddWeight extends CI_Controller {
 
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
 

 function index($chart_num)
 {

    if($chart_num == null){
      show_404();
    }

    $data['animal'] = $this->animal->getAnimalById($chart_num);
    $data['weights'] = $this->weight->getAllWeights($chart_num);

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


   $this->form_validation->set_rules('chart_num', 'Chart Number', 'trim|required');
   $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
   $this->form_validation->set_rules('date', 'Date', 'trim|required');


   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add an Animal\'s Weight';
     $this->load->template('addweight_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->add_weight($this->input->post('chart_num'),$this->input->post('weight'),$this->input->post('date'));
     $this->session->set_flashdata('results', 'Weight succesfully added!');
      redirect('/editanimal/'.$chart_num, 'refresh');
   }else{
     $data['title'] = 'Add an Animal\'s Weight';
     $this->load->template('addweight_view', $data);
   }
 
 }

 function add_weight($chart_num,$weight,$date){
    $date_converted = date('Y-m-d', strtotime($date));

    $result = $this->weight->add_weight($chart_num,$weight,$date_converted);

    if($result){
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding the animal\'s weight.');
      return false;
    }
 }

 

 
}
 
?>