<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayDocuments extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('document','',TRUE);
   $this->load->model('history','',TRUE);
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
    
    $data['chart_num'] = $chart_num;
    $data['documents'] = $this->document->getAllDocuments($chart_num);

     if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }

$this->load->library('form_validation');


    if (!empty($_FILES['documents']))
   {


    $config = array(
    'upload_path' => "uploads/",
    'upload_url' => base_url() . "uploads/",
    'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx|txt|rtf"
    );

    $this->load->library('upload', $config);

    $files = $_FILES;
    $cpt = count($_FILES['documents']['name']);
    for($i=0; $i<$cpt; $i++){
        $_FILES['documents']['name']= $files['documents']['name'][$i];
        $_FILES['documents']['type']= $files['documents']['type'][$i];
        $_FILES['documents']['tmp_name']= $files['documents']['tmp_name'][$i];
        $_FILES['documents']['error']= $files['documents']['error'][$i];
        $_FILES['documents']['size']= $files['documents']['size'][$i];    

        $fileName = uniqid() . 'file_' . $files['documents']['name'][$i];
        $fileName =  urlencode($fileName);
        log_message('Error','file name : ' . $fileName);
        $config['file_name'] = $fileName;
        $this->upload->initialize($config);

        if ($this->upload->do_upload('documents')) {
            $this->upload->data();
             $url = base_url() . "files/" . $fileName;
             $this->document->addDocument($chart_num,$url);
           $this->session->set_flashdata('results', 'Document(s) successfully uploaded to the database.');

        } 

    }

     $data['documents'] = $this->document->getAllDocuments($chart_num);
     $data['title'] = 'Display All Documents for ' . $chart_num;
     $this->load->template('displaydocuments_view', $data);

   }else{
     $data['title'] = 'Display All Documents for ' . $chart_num;
     $this->load->template('displaydocuments_view', $data);
   }


 }


 
  function remove_document($vars)
 {

  $id = $vars[1];
  $chart_num = $vars[0];

    if($id == null){
      show_404();
    }

    if($chart_num == null){
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
        $this->session->set_flashdata('results', 'You do not have the correct permission to modify an animal.');
        redirect('/displayanimal/'.$chart_num, 'refresh');
     }

   $this->document->removeDocument($id);

     $date = date('Y-m-d H:i:s');
      $sd = $this->session->userdata('logged_in');
      $user= $sd['username'];
      $this->history->addHistoryEntry($user,$date,"Removed an animal's document with the ID of : " . $chart_num[0]);

   $this->load->library('form_validation');

   $this->session->set_flashdata('results', 'Document successfully removed from the database.');

    redirect('/displaydocuments/'.$chart_num, 'refresh');

 }


 
}
 
?>