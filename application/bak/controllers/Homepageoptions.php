<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepageoptions extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('homepage','',TRUE);
 } 

 function index()
 {

    $data['homePageOptions'] = $this->homepage->getAllHomepageDetails();

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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify the homepage.');
        redirect('/displaystatuses', 'refresh');
    }

   $this->form_validation->set_rules('enabled', 'Enable Homepage', 'trim');
   $this->form_validation->set_rules('sections', 'Total Sections', 'trim');
   $this->form_validation->set_rules('sections_json', 'Rows per section', 'trim');


 if($this->form_validation->run() == FALSE)
   {
     $data['title'] = 'Modify Homepage';
     $this->load->template('homepageoptions_view', $data);
   }else if($this->form_validation->run() == TRUE)
   {

    if($this->input->post('enabled')){
      $this->enable_homepage_view($this->input->post('enabled'));
    }

    if($this->input->post('sections')){
      $this->edit_sections($this->input->post('sections'));
    }

    if($this->input->post('sections_json')){
      $this->edit_sections_json($this->input->post('sections_json'));
    }

     $data['title'] = 'Modify Homepage';
     redirect('/homepageoptions', 'refresh');

   }else{
     $data['title'] = 'Modify Homepage';
     $this->load->template('homepageoptions_view', $data);
    }

 }

 function enable_homepage_view($option){
     if($option == "true"){
        $result = $this->homepage->enableHomePage();
     }else{
        $result = $this->homepage->disableHomePage();
     }

    if($result){
      $this->session->set_flashdata('results', 'Homepage succesfully modified!');
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem enabling the custom homepage view.');
      return false;
    }

 }

 function edit_sections($amount){
    $result = $this->homepage->editSections($amount);

    if($result){
      $this->session->set_flashdata('results', 'Homepage succesfully modified!');
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem modifying the total amount of sections.');
      return false;
    }
 }

 function edit_sections_json($json){
    $result = $this->homepage->editSectionsJson($json);

    if($result){
      $this->session->set_flashdata('results', 'Homepage succesfully modified!');
      return TRUE;
    }else{
      $this->session->set_flashdata('results', 'There was a problem modifying the amount of rows per section.');
      return false;
    }

 } 

 
}
 
?>