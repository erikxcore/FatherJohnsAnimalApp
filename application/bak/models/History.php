<?php
Class History extends CI_Model
{

 function getAllHistory(){
   $this -> db -> from('history');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getHistoryByUser($user){
    $this -> db -> from('history');
    $this -> db -> where('user', $user);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getHistoryByDate($date){
    $this -> db -> from('history');
    $this -> db -> where('date', $date);
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function addHistoryEntry($user,$date,$notes){
   $data = array(
    'user' => $user,
    'date' => $date,
    'notes' => $notes,
    ); 
    return $this -> db ->insert('history', $data);
 }

  function record_count() {
        return $this->db->count_all("history");
    }

  function get_history_paged($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("history");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }


}

 ?>