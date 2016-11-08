<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddAdopter extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('adopter','',TRUE);
   $this->load->model('history','',TRUE);
   $this->load->library('encrypt');
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to add an adopter.');
   		redirect('/home','refresh');
    }

     $this->form_validation->set_rules('name', 'Name', 'trim|required');
     $this->form_validation->set_rules('phone', 'Phone Number', 'trim');
     $this->form_validation->set_rules('address', 'Address', 'trim');
     $this->form_validation->set_rules('city', 'City/Address/Zip', 'trim');
     $this->form_validation->set_rules('email', 'Email Address', 'trim');
     $this->form_validation->set_rules('license', 'Driver License Number', 'trim');

   if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Add an Adopter';
     $this->load->template('addadopter_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {

     $this->add_adopter($this->input->post('name'),$this->input->post('phone'),$this->input->post('address'),$this->input->post('email'),$this->input->post('city'),$this->input->post('license'));
     $this->session->set_flashdata('results', 'Adopter succesfully added!');

     redirect('/displayadopters/', 'refresh');
   }else{
     $data['title'] = 'Add an Adopter';
     $this->load->template('addadopter_view', $data);
    }

 }

 function add_adopter($name,$phone,$address,$email,$city,$license){
    $sd = $this->session->userdata('logged_in');
    $user= $sd['username'];
    $date = date('Y-m-d');
    
    $license = $this->encrypt->encode($license);

    $result = $this->adopter->addAdopter($name,$phone,$address,$email,$city,$license);

  if($result){
      $this->history->addHistoryEntry($user,$date,"Added a new adopter : " . $name);
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem adding a new adopter.');
      return false;
    }
}

 
}
 
?>