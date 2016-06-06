<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddSafer extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('animal','',TRUE);
   $this->load->model('safer','',TRUE);
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
    $this->form_validation->set_rules('test_1', 'Test 1 Results', 'trim|required');
    $this->form_validation->set_rules('test_2', 'Test 2 Results', 'trim|required');
    $this->form_validation->set_rules('test_3', 'Test 3 Results', 'trim|required');
    $this->form_validation->set_rules('test_4', 'Test 4 Results', 'trim|required');
    $this->form_validation->set_rules('test_5', 'Test 5 Results', 'trim|required');
    $this->form_validation->set_rules('test_6', 'Test 6 Results', 'trim|required');
    $this->form_validation->set_rules('test_7', 'Test 7 Results', 'trim|required');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add an Animal\'s SAFER Results';
     $this->load->template('addsafer_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
      $this->add_safer($this->input->post('chart_num'),$this->input->post('test_1'),$this->input->post('test_2'),$this->input->post('test_3'),$this->input->post('test_4'),$this->input->post('test_5'),$this->input->post('test_6'),$this->input->post('test_7'));
      $this->session->set_flashdata('results', 'SAFER results succesfully added!');
      redirect('/editanimal/'.$chart_num, 'refresh');
   }else{
     $data['title'] = 'Add an Animal\'s SAFER Results';
     $this->load->template('addsafer_view', $data);
   }
 

 }

 function add_safer($chart_num,$test_1,$test_2,$test_3,$test_4,$test_5,$test_6,$test_7){
    $this->safer->add_safer_complete($chart_num);
    $result = $this->safer->add_safer_results($chart_num,$test_1,$test_2,$test_3,$test_4,$test_5,$test_6,$test_7);

    if($result){
      return TRUE;
    }else{
                 $this->session->set_flashdata('results', 'There was a problem adding the animal\'s SAFER results.');
      return false;
    }
 }

 

 
}
 
?>