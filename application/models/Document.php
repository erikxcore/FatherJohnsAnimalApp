<?php
Class Document extends CI_Model
{

 function getAllDocuments($chart_num){
   $this -> db -> from('documents');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }


 function addDocument($chart_num,$url){
   $data = array(
    'chart_num' => $chart_num,
    'url' => $url,
    ); 

    return $this -> db ->insert('documents', $data);
 }

 function removeDocument($id){

$this->db->from('documents');
$this->db->where('id',$id);
$doc_url = $this->db->get();
$doc_url = $doc_url->result_array();
$doc_url[0]['url'] = str_replace('/garret2/files', './uploads', $doc_url[0]['url']);
    if (file_exists($doc_url[0]['url'])) {
        unlink($doc_url[0]['url']);
    }

      $data = array(
        'id' => $id,
      );
    $this -> db -> from('documents');
    $this -> db -> where('id', $id);
    return $this->db->delete('documents' ,$data);
 }

 function getDocumentById($id){
    $this -> db -> from('documents');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function record_count_documents($chart_num) {
        $this -> db -> from('documents');
        $this -> db -> where('chart_num',$chart_num);
        $query = $this -> db -> get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

  function record_count_documents_all() {
        return $this->db->count_all("documents");
    }



}

 ?>