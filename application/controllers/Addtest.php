<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddTest extends CI_Controller {
 
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
    //echo $data['animal'];

    if( strtoupper($data['animal'][0]['species']) == "DOG"){
      $data['tests'] = $this->test->getTestsForDogs();
    }else if( strtoupper($data['animal'][0]['species']) == "CAT"){
      $data['tests'] = $this->test->getTestsForCats();
    }

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

   $i = 0;
   //poor implementation
   foreach($data['tests'] as $test) { 
     $this->form_validation->set_rules('test_name_'.$i, 'Test Name', 'trim');
     $this->form_validation->set_rules('test_check_'.$i, 'Test Check', 'trim');
     $this->form_validation->set_rules('date_given_'.$i, 'Date Given', 'trim');
     $this->form_validation->set_rules('results_'.$i, 'Results', 'trim');
     $i++;
   }

   $processed = false;
   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add an Animal\'s Preventative Test';
     $this->load->template('addtest_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {
     $i = 0;
     $test_to_add = array();
     
     foreach($data['tests'] as $test) { 
     if($this->input->post('test_check_'.$i) == "enabled"){
      $processed = true;
      $test = array();
      if($this->input->post('result_'.$i) == "TRUE"){
        $results = true;
      }else{
        $results = false;
      }
      array_push($test,$this->input->post('date_given_'.$i),$this->input->post('test_name_'.$i),$results);
      array_push($test_to_add,$test);
     }
      $i++;
     }

     if(!$processed){
           $data['title'] = 'Add an Animal\'s Preventative Test';
          $this->session->set_flashdata('results', 'Please enable at least one test!');
           $this->load->template('addtest_view', $data);
     }else{

     $this->add_test($this->input->post('chart_num'),$test_to_add);
     $this->session->set_flashdata('results', 'Preventative test succesfully added!');

     redirect('/editanimal/'.$chart_num, 'refresh');
    }
   }else{
     $data['title'] = 'Add an Animal\'s Preventative Test';
     $this->load->template('addtest_view', $data);
    }

 }

 function add_test($chart_num,$test_to_add){
    $session_data = $this->session->userdata('logged_in');

    $result = true;
    $entry = null;

    foreach($test_to_add as $test) { 
         $date_converted = date('Y-m-d', strtotime($test['0']));

        try{
        $this->test->addAnimalTest($chart_num,$date_converted,$test['1'],$test['2']);

        $entry = $entry . "Test " . $test['1'] . " for " . $chart_num . ' has been added on ' . date('Y-m-d') . '. Date given is now ' . $date_converted . ' Results were : ' . $test['2'] . '<br/>' . " by " . $session_data['username'];


        }catch(Exception $e){
          $result = false;
          goto return_results;
        }
      //0 - Date Given 1 - Name 2 - Results
    }



    if($result){

            $this->test_history->addTestHistory($chart_num,$entry);

      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding the animal\'s test.');
      return false;
    }

      return_results:
      $this->session->set_flashdata('results', 'There was a problem adding the animal\'s test.');
      return false;

 }

 

 
}
 
?>