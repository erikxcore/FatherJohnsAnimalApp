<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayTestHistory extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
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

    $data['alltests'] = $this->test_history->getAllTest($chart_num);

     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

     $data['title'] = 'Display All Preventative Tests for ' . $chart_num;
     $this->load->template('displaytesthistory_view', $data);

 }


 
}
 
?>