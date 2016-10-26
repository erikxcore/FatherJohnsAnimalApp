<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RemoveTest extends CI_Controller {
 
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
 

 function index($chart_num)
 {
    if($chart_num == null){
      show_404();
    }

    $data['animal'] = $this->animal->getAnimalById($chart_num);
    $data['tests'] = $this->test->getAllTest($chart_num);

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

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Remove an Animal\'s Preventative Test';
     $this->load->template('removetest_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $this->remove_test($this->input->post('id'),$chart_num);
     $this->session->set_flashdata('results', 'Preventative test successfully removed!');
     redirect('/editanimal/'.$chart_num, 'refresh');
   }else{
     $data['title'] = 'Remove an Animal\'s Test';
     $this->load->template('removetest_view', $data);
   }

 }

 function remove_test($id,$chart_num){
    $session_data = $this->session->userdata('logged_in');
    $name = $this->test->getAnimalTestById($id)[0]['name'];
    $result = $this->test->removeAnimalTest($id);

    if($result){
          $entry = "Preventative test " . $name . " for " . $chart_num . ' has been updated on ' . date('Y-m-d') . '. Test entry has been removed.' . '<br/>' . " by " . $session_data['username'];
          $this->test_history->addTestHistory($chart_num,$entry);
      return TRUE;
    }else{
                $this->session->set_flashdata('results', 'There was a problem removing the animal\'s test.');
      return false;
    }
 }

 

 
}
 
?>