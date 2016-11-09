<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FileController extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->helper('file');

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

public function index($file_name){
  log_message('error','FIle name:' . $file_name);

  if($this->session->userdata('logged_in'))
   {    
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
   }
   else
   {
     redirect('login', 'refresh');
   }


        if (preg_match('^[A-Za-z0-9]{2,32}+[.]{1}[A-Za-z]{3,4}$^', $file_name)) // validation
            {
            $file = './uploads/'.$file_name;
            //log_message('error','URL is : ' . $file);
            if (file_exists($file)) // check the file is existing 
                {
                //log_message('error','File does exist : ' . $file);
                header('Content-Type: '.get_mime_by_extension($file));
                readfile($file);
                }
            else show_404();
            }
      

}
 
}
 
?>