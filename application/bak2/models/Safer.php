<?php
Class Safer extends CI_Model
{

function add_safer_results($chart_num,$test_1,$test_2,$test_3,$test_4,$test_5,$test_6,$test_7){
    $data = array(
    'chart_num' => $chart_num,
    'test_1' => $test_1,
    'test_2' => $test_2,
    'test_3' => $test_3,
    'test_4' => $test_4,
    'test_5' => $test_5,
    'test_6' => $test_6,
    'test_7' => $test_7,
    );
    return $this -> db ->insert('safer_result', $data);
}

function remove_safer_results($id){
      $data = array(
     'id' => $id,
      );
    $this -> db -> from('safer_result');
    $this -> db -> where('id', $id);
    return $this->db->delete('safer_result' ,$data);
}

function remove_safer_complete($chart_num){
      $data = array(
     'chart_num' => $chart_num,
     'safer_complete' => 0,
      );
    $this -> db -> from('animals');
    $this -> db -> where('chart_num', $chart_num);
    return $this->db->update('animals' ,$data);
}

function add_safer_complete($chart_num){
      $data = array(
     'chart_num' => $chart_num,
     'safer_complete' => 1,
      );
    $this -> db -> from('animals');
    $this -> db -> where('chart_num', $chart_num);
    return $this->db->update('animals' ,$data);
}

function edit_safer_results($id,$test_1,$test_2,$test_3,$test_4,$test_5,$test_6,$test_7){
        $data = array(
        'id' => $id,
        'test_1' => $test_1,
        'test_2' => $test_2,
        'test_3' => $test_3,
        'test_4' => $test_4,
        'test_5' => $test_5,
        'test_6' => $test_6,
        'test_7' => $test_7,
      );
    $this -> db -> from('safer_result');
    $this -> db -> where('id', $id);
    return $this->db->update('safer_result' ,$data);
}

 function getSaferResults($chart_num){
   $this -> db -> from('safer_result');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }

}
?>