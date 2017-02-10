<?php
class Db_log {
 
    function __construct() {
    }
 
    function logQueries() {

        $CI = & get_instance();
    
        $session_userdata = $CI->session->userdata('logged_in');
            if($session_userdata != null){
                $username = $session_userdata['username'];
            }else{
                $username = "Username was null";
            }
 
        $filepath = APPPATH . 'logs/Query-log' . '.php';
        $handle = fopen($filepath, "a+");
 
        $times = $CI->db->query_times;
        foreach ($CI->db->queries as $key => $query) { 
            $sql = $query . " \n Execution Time:" . $times[$key] . ' by ' . $username;
            fwrite($handle, $sql . "\n\n");
        }
 
        fclose($handle);
    }
 
}
?>