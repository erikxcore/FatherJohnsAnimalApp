<?php
Class Adopter_document extends CI_Model
{

 function getAllDocuments($adopter_num){
   $this -> db -> from('adopter_documents');
   $this -> db -> where('adopter_num', $adopter_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }


 function addDocument($adopter_num,$url){
   $data = array(
    'adopter_num' => $adopter_num,
    'url' => $url,
    ); 

    return $this -> db ->insert('adopter_documents', $data);
 }

 function removeDocument($id){

$this->db->from('adopter_documents');
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
    $this -> db -> from('adopter_documents');
    $this -> db -> where('id', $id);
    return $this->db->delete('adopter_documents' ,$data);
 }

 function getDocumentById($id){
    $this -> db -> from('adopter_documents');
    $this -> db -> where('id', $id);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function record_count_documents($adopter_num) {
        $this -> db -> from('adopter_documents');
        $this -> db -> where('adopter_num',$adopter_num);
        $query = $this -> db -> get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

  function record_count_documents_all() {
        return $this->db->count_all("adopter_documents");
    }



}

 ?>