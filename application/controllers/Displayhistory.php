<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayHistory extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('history','',TRUE);
   $this->load->library("pagination");
 }
 

 function index()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

 if($this->session->userdata('goduser') != 1){
        $this->session->set_flashdata('results', 'You do not have the correct permission to view event history.');
        redirect('/home', 'refresh');
   }


    $config["base_url"] = base_url() . "displayhistory";
    $config["total_rows"] = $this->history->record_count();
    $config["per_page"] = 10;
    $config["uri_segment"] = 2;
    $choice = $config["total_rows"] / $config["per_page"];
    $config["num_links"] = round($choice);

    $this->pagination->initialize($config);

      if($this->uri->segment(2)){
      $page = ($this->uri->segment(2)) ;
      }
      else{
      $page = 0;
      }

    $data["allhistory"] = $this->history
        ->get_history_paged($config["per_page"], $page);
    $data["links"] = $this->pagination->create_links();


     $data['title'] = 'Display All Activity';
     $this->load->template('displayhistory_view', $data);

 }



 

 
}
 
?>