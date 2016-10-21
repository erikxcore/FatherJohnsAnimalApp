<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayTests extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('test','',TRUE);
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
    $data['alltests'] = $this->test->getTest();

     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display All Preventative Tests';
     $this->load->template('displaytests_view', $data);

 }
 
  function removetest($id){
    if($id[0] == null){
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify a test.');
        redirect('/displaytests', 'refresh');
    }

    $this->test->removeTest($id[0]);

    $this->session->set_flashdata('results', 'Test successfully removed from the database.');
    
    redirect('/displaytests', 'refresh');

 }

 
}
 
?>