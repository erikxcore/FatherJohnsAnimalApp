<?php
Class Animal extends CI_Model
{

function add($name,$chart_num,$run_num,$species,$breed,$date_of_arrival,$acquired,$acquired_how,$microchip_num,$age,$sex,$feeding_instructions,$status,$status_date,$behavior_strategy,$notes,$safer_complete,$picture,$user,$user_date,$medical_notes,$adopter){
//request by garret
if($status == "Adopted"){
  $run_num = "";
}

if(!empty($adopter)){
  $this->load->model('adopter','',TRUE);
  $this -> adopter -> assignAdopter($adopter,$chart_num);
}else{
  $adopter = null;
}

$data = array(
'name' => $name,
'chart_num' => $chart_num,
'run_num' => $run_num,
'species' => $species,
'breed' => $breed,
'date_of_arrival' => $date_of_arrival,
'acquired' => $acquired,
'acquired_how' => $acquired_how,
'microchip_num' => $microchip_num,
'age' => $age,
'sex' => $sex,
'feeding_instructions' => $feeding_instructions,
'status' => $status,
'status_date' => $status_date,
'behavior_strategy' => $behavior_strategy,
'notes' => $notes,
'safer_complete' => $safer_complete,
'picture' => $picture,
'user' => $user,
'user_date' => $user_date,
'medical_notes' => $medical_notes,
'adopter' => $adopter
);
return $this -> db ->insert('animals', $data);
}

function edit($name,$chart_num,$run_num,$species,$breed,$date_of_arrival,$acquired,$acquired_how,$microchip_num,$age,$sex,$feeding_instructions,$status,$status_date,$behavior_strategy,$notes,$safer_complete,$picture,$user,$user_date,$medical_notes,$adopter){

//request by garret
if($status == "Adopted"){
  $run_num = "";
}

$this -> db -> where('chart_num', $chart_num);
$animal = $this -> db -> get('animals');
$data = $animal->result_array();

$this->load->model('adopter','',TRUE);
$saved_adopter = $data[0]['adopter'];
//If this animal has an adopter on it already...
if(!empty($saved_adopter)){
  //Check if the incoming information matches, if so don't remove or add.
  //If no match, remove the chart number from the past adopter and assign the new adopter
  if($saved_adopter != $adopter){
    $this-> adopter -> removeAssignedAdopter($saved_adopter,$chart_num);
    $this-> adopter -> assignAdopter($adopter,$chart_num);
  }
}else if(!empty($adopter) && empty($saved_adopter)){ 
  //If animal had no adopter and incoming data has a value assign
  $this-> adopter -> assignAdopter($adopter,$chart_num);
}else if(empty($adopter) && !empty($saved_adopter)){
  //If incoming data has no adopter but animal had one, remove
  $this-> adopter -> removeAssignedAdopter($saved_adopter,$chart_num);
}


//no clean way to handle these symbols with history log
$behavior_strategy_safe = str_replace(",","%2C",$behavior_strategy);
$notes_safe = str_replace(",","%2C",$notes);
$acquired_how_safe = str_replace(",","%2C",$acquired_how);
$feeding_instructions_safe = str_replace(",","%2C",$feeding_instructions);

$data = array(
'name' => $name,
'run_num' => $run_num,
'species' => $species,
'breed' => $breed,
'date_of_arrival' => $date_of_arrival,
'acquired' => $acquired,
'acquired_how' => $acquired_how_safe,
'microchip_num' => $microchip_num,
'age' => $age,
'sex' => $sex,
'feeding_instructions' => $feeding_instructions_safe,
'status' => $status,
'status_date' => $status_date,
'behavior_strategy' => $behavior_strategy_safe,
'notes' => $notes_safe,
'safer_complete' => $safer_complete,
'picture' => $picture,
'user' => $user,
'user_date' => $user_date,
'medical_notes' => $medical_notes,
'adopter' => $adopter
);
    $this -> db -> from('animals');
    $where = "chart_num = " . $chart_num;

    $sql = $this->db->update_string('animals',$data,$where);
    
    $different = $this->mysql_affected_fields($sql);

    $notes_history = implode('<br/>',$different);

    $dataHistory = array(
    'user' => $user,
    'date' => $user_date,
    'notes' => $notes_history,
    ); 

    $this -> db ->insert('history', $dataHistory);

    $data['behavior_strategy'] = $behavior_strategy;
    $data['notes'] = $notes;
    $data['acquired_how'] = $acquired_how;
    $data['feeding_instructions'] = $feeding_instructions;

    $this -> db -> where('chart_num', $chart_num);
    return $this->db->update('animals' ,$data);
}



function remove_image($chart_num){


$this -> db -> where('chart_num', $chart_num);
$animal = $this -> db -> get('animals');
$data = $animal->result_array();
if(isset($data[0]['picture'])){
$data[0]['picture'] = str_replace('/garret2/files', './uploads', $data[0]['picture']);

    if (file_exists($data[0]['picture'])) {
        unlink($data[0]['picture']);
    }
}

  $data = array(
'picture' => null,
);
    $this -> db -> from('animals');
    $this -> db -> where('chart_num', $chart_num);
    return $this->db->update('animals' ,$data);
}

function remove($chart_num){

//Adoptee check
$this -> db -> where('chart_num', $chart_num);
$animal = $this -> db -> get('animals');
$data = $animal->result_array();
$this->load->model('adopter','',TRUE);
$saved_adopter = $data[0]['adopter'];
//If this animal has an adopter on it remove it
if(isset($saved_adopter)){  
    $this-> adopter -> removeAssignedAdopter($saved_adopter,$chart_num);
}

if(isset($data[0]['picture'])){
$data[0]['picture'] = str_replace('/garret2/files', './uploads', $data[0]['picture']);
    if (file_exists($data[0]['picture'])) {
        unlink($data[0]['picture']);
    }
}

      $data = array(
     'chart_num' => $chart_num,
      );
    $this -> db -> from('animals');
    $this -> db -> where('chart_num', $chart_num);
    return $this->db->delete('animals' ,$data);
}

function getAllAnimals(){
   $this -> db -> from('animals');
   $query = $this -> db -> get();
   return $query->result_array();
 }

function get_all_animals_paged($limit, $start) {
    $this->db->limit($limit, $start);
    $query = $this->db->get("animals");

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
}

 function getUsedChartNumbers(){
   $this -> db -> select('chart_num');
   $this -> db -> from('animals');
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function getLastAddedAnimals(){
   $this -> db -> from('animals');
   $this -> db ->limit('5');
   $this -> db ->order_by('id', 'DESC');
   $query = $this -> db -> get();
   return $query->result_array();
 }

//no longer a requirement, not used in official capacity
  function getMedicationRequiredAnimals(){
   $query =    $this->db->query('SELECT animals.id,animals.name,animals.chart_num,medication.name as medication_name,medication.date_due FROM animals JOIN medication ON medication.chart_num = animals.chart_num WHERE medication.date_due < CURRENT_DATE + INTERVAL 1 DAY AND medication.date_due > CURRENT_DATE - INTERVAL 1 DAY ');
   //improve to return only the unique row instead of repeat rows if an animal has multiple medications due
   return $query->result_array();
 }

//dependent on a status named Adopted although thats just what not to display..all other statuses will appear
//to further modify just add and animals.status != &quot; status &quot;...obviously translate the encoding
   function getVaccinationRequiredAnimals(){
   $query =    $this->db->query('SELECT animals.id,animals.name,animals.chart_num,animals.status,vaccination.name as vaccination_name,vaccination.date_completed FROM animals JOIN vaccination ON vaccination.chart_num = animals.chart_num WHERE vaccination.date_completed < CURRENT_DATE + INTERVAL 1 DAY AND vaccination.date_completed > CURRENT_DATE - INTERVAL 1 DAY AND animals.status != "Adopted"');
   //improve to return only the unique row instead of repeat rows if an animal has multiple vaccinations due
   //may be better to display all vacations for an animal however
   return $query->result_array();
 }

   function getVaccinationRequiredDogs(){
   $query =    $this->db->query('SELECT animals.id,animals.species,animals.name,animals.chart_num,animals.status,vaccination.name as vaccination_name,vaccination.date_completed FROM animals JOIN vaccination ON vaccination.chart_num = animals.chart_num WHERE vaccination.date_completed < CURRENT_DATE + INTERVAL 1 DAY AND vaccination.date_completed > CURRENT_DATE - INTERVAL 1 DAY AND animals.status != "Adopted" AND animals.species = "Dog"');
   //improve to return only the unique row instead of repeat rows if an animal has multiple vaccinations due
   //may be better to display all vacations for an animal however
   return $query->result_array();
 }

    function getVaccinationRequiredCats(){
   $query =    $this->db->query('SELECT animals.id,animals.species,animals.name,animals.chart_num,animals.status,vaccination.name as vaccination_name,vaccination.date_completed FROM animals JOIN vaccination ON vaccination.chart_num = animals.chart_num WHERE vaccination.date_completed < CURRENT_DATE + INTERVAL 1 DAY AND vaccination.date_completed > CURRENT_DATE - INTERVAL 1 DAY AND animals.status != "Adopted" AND animals.species = "Cat"');
   //improve to return only the unique row instead of repeat rows if an animal has multiple vaccinations due
   //may be better to display all vacations for an animal however
   return $query->result_array();
 }

   function getOverdueVaccinationRequiredAll(){
     $query =    $this->db->query('SELECT animals.id,animals.species,animals.name,animals.chart_num,animals.status,vaccination.name as vaccination_name,vaccination.date_completed FROM animals JOIN vaccination ON vaccination.chart_num = animals.chart_num WHERE vaccination.date_completed < CURRENT_DATE AND animals.status != "Adopted"');
      //improve to return only the unique row instead of repeat rows if an animal has multiple vaccinations due
   //may be better to display all vacations for an animal however
   return $query->result_array();  
   }

   function getOverdueVaccinationRequiredCats(){
   $query =    $this->db->query('SELECT animals.id,animals.species,animals.name,animals.chart_num,animals.status,vaccination.name as vaccination_name,vaccination.date_completed FROM animals JOIN vaccination ON vaccination.chart_num = animals.chart_num WHERE vaccination.date_completed < CURRENT_DATE AND animals.status != "Adopted" AND animals.species = "Cat"');
      //improve to return only the unique row instead of repeat rows if an animal has multiple vaccinations due
   //may be better to display all vacations for an animal however
   return $query->result_array();
   }

   function getOverdueVaccinationRequiredDogs(){
   $query =    $this->db->query('SELECT animals.id,animals.species,animals.name,animals.chart_num,animals.status,vaccination.name as vaccination_name,vaccination.date_completed FROM animals JOIN vaccination ON vaccination.chart_num = animals.chart_num WHERE vaccination.date_completed < CURRENT_DATE AND animals.status != "Adopted" AND animals.species = "Dog"');
   //improve to return only the unique row instead of repeat rows if an animal has multiple vaccinations due
   //may be better to display all vacations for an animal however
   return $query->result_array();
   }

//following two will only return results if the correct Species exists
 function getAllDogs(){
   $this -> db -> from('animals');
   $this -> db -> where('species', "Dog");
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function get_all_dogs_paged($limit, $start) {
    $this -> db ->limit($limit, $start);
    $this -> db -> from('animals');
    $this -> db -> where('species', "Dog");
    $query = $this -> db -> get(); 

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
}

 function getAllCats(){
   $this -> db -> from('animals');
   $this -> db -> where('species', "Cat");
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function get_all_cats_paged($limit, $start) {
    $this -> db ->limit($limit, $start);
    $this -> db -> from('animals');
    $this -> db -> where('species', "Cat");
    $query = $this -> db -> get(); 

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
}

function getAllAdoptedAnimals(){
   $this -> db -> from('animals');
   $this -> db -> where('status', "Adopted");
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function get_all_adopted_paged($limit, $start) {
    $this -> db ->limit($limit, $start);
    $this -> db -> from('animals');
    $this -> db -> where('status', 'Adopted');
    $query = $this -> db -> get(); 

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
}

  function record_count_adopted() {
        $this -> db -> from('animals');
        $this -> db -> where('status','Adopted');
        $query = $this -> db -> get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

  function record_count_non_adopted() {
        $this -> db -> from('animals');
        $this -> db -> where('status !=','Adopted');
        $query = $this -> db -> get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

  function record_count_dogs() {
        $this -> db -> from('animals');
        $this -> db -> where('species','Dog');
        $query = $this -> db -> get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

  function record_count_cats() {
        $this -> db -> from('animals');
        $this -> db -> where('species','Cat');
        $query = $this -> db -> get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

  function record_count_animals() {
        return $this->db->count_all("animals");
    }

 function getAllNonAdoptedAnimals(){
   $this -> db -> from('animals');
   $this -> db -> where('status !=', "Adopted");
   $query = $this -> db -> get();
   return $query->result_array();
 }

   function get_all_non_adopted_paged($limit, $start) {
    $this -> db ->limit($limit, $start);
    $this -> db -> from('animals');
    $this -> db -> where('status!=', "Adopted");
    $query = $this -> db -> get(); 

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
}

 function getAnimalByID($chart_num){
   $this -> db -> from('animals');
   $this -> db -> where('chart_num', $chart_num);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAnimalByName($name){
   $this -> db -> from('animals');
   $this -> db -> where('name', $name);
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAnimalByRun($run_id){
  //$query = $this->db->query('SELECT * FROM ANIMALS LEFT JOIN RUN ON ANIMALS.RUN_NUM = RUN.ID WHERE ANIMALS.RUN_NUM =' . $run_id);
   $query = $this->db->query('select animals.id as animal_id, animals.name as name, chart_num, run_num, species, breed, date_of_arrival, acquired, acquired_how, microchip_num, age, sex, feeding_instructions, status, status_date, safer_complete, behavior_strategy,notes,picture, user, user_date, run.id as run_id, run.name as run_name from animals left join run on animals.run_num = run.id where run.name =\''.$run_id.'\'');
   return $query->result_array();
 }

   function getAnimalByRunId($run_id){
  //$query = $this->db->query('SELECT * FROM ANIMALS LEFT JOIN RUN ON ANIMALS.RUN_NUM = RUN.ID WHERE ANIMALS.RUN_NUM =' . $run_id);
   $query = $this->db->query('select animals.id as animal_id, animals.name as name, chart_num, run_num, species, breed, date_of_arrival, acquired, acquired_how, microchip_num, age, sex, feeding_instructions, status, status_date, safer_complete, behavior_strategy,notes,picture, user, user_date, run.id as run_id, run.name as run_name from animals left join run on animals.run_num = run.id where run.id = \''.$run_id.'\' limit 1');
   return $query->result_array();
 }


   function getAnimalByStatus($status){
   $this -> db -> from('animals');
   $this -> db -> where('status',$status);
   $query = $this -> db -> get();
   return $query->result_array();
 }

   function getAnimalByAdopter($adopter){
   $this -> db -> from('animals');
   $this -> db -> where('adopter',$adopter);
   $query = $this -> db -> get();
   return $query->result_array();
 }

   function getAnimalRunColor($id){
    $query = $this->db->query('select color, status.name from status left join animals on animals.status = status.name where animals.id = \''.$id.'\'');
   return $query->result_array();
   }

   function getAllAnimalNames(){
   $this -> db -> select('name');
   $this -> db -> from('animals');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAllAnimalChartNums(){
   $this -> db -> select('chart_num');
   $this -> db -> from('animals');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAllAnimalStatuses(){
   $this -> db -> select('name');
   $this -> db -> from('status');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAllAnimalRunNames(){
   $this -> db -> select('name');
   $this -> db -> from('run');
   $query = $this -> db -> get();
   return $query->result_array();
 }

   function getRun($id){
    $this -> db -> from('run');
    $this -> db -> where('id', $id);
    $query = $this -> db -> get();
    return $query->result_array();
 }

 function getAllGenders(){
   $this -> db -> select('name');
   $this -> db -> from('sex');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAllSpecies(){
   $this -> db -> select('name');
   $this -> db -> from('species');
   $query = $this -> db -> get();
   return $query->result_array();
 }

 function getAllStatus(){
   $this -> db -> select('name');
   $this -> db -> from('status');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAllRuns(){
   $this -> db -> from('run');
   $query = $this -> db -> get();
   return $query->result_array();
 }

  function getAllAcquiredMethod(){
   $this -> db -> select('name');
   $this -> db -> from('acquired_method');
   $query = $this -> db -> get();
   return $query->result_array();
 }


function mysql_affected_fields($sql)
{

    $piece1 = explode( "UPDATE ", $sql);
    $piece2 = explode( "SET", $piece1[1]);
    $sql_parts['table'] =  trim($piece2[0]);

    $sql_parts['table'] = str_replace("'","",$sql_parts['table']);
    $sql_parts['table'] = str_replace("`","",$sql_parts['table']);

    $piece1 = explode( "SET ", $sql);
    $piece2 = explode( "WHERE", $piece1[1]);
    $sql_parts['set'] =  trim($piece2[0]);

    $sql_parts['set'] = str_replace("'","",$sql_parts['set']);
    $sql_parts['set'] = str_replace("`","",$sql_parts['set']);

    $fields = explode (",",$sql_parts['set']);
    
    foreach($fields as $field)
    {
        $field_parts = explode("=",$field);

        $field_name = trim($field_parts[0]) ;

        $field_name = str_replace("'","",$field_name);
        $field_name = str_replace("`","",$field_name);

        $field_value = trim($field_parts[1]) ;
        $field_value =str_replace("'","",$field_value);
        $sql_parts['field'][$field_name] = $field_value;
    }

    $piece1 = explode( "WHERE ", $sql);
    $piece2 = explode( ";", $piece1[1]);
    $sql_parts['where'] =  trim($piece2[0]);


    $sql_parts['where'] = preg_replace("/`/","",$sql_parts['where'],2);
    $sql_parts['where'] = str_replace("`","'",$sql_parts['where']);







    $select = "SELECT * FROM ".$sql_parts['table']." WHERE ".$sql_parts['where']."";
    
    $query = $this->db->query($select);

    $result_latest = $query->result_array();
    
    while($row = $result_latest[0])
    {
        foreach($row as $k=>$v)
        {
            if (array_key_exists($k,$sql_parts['field'])){
              if ($sql_parts['field'][$k] != $v){
                //this is all terrible and should be rewritten and replacement done even prior to this if. fast as possible solution.
                if($k != "picture" && $k != "notes" && $k != "feeding_instructions" && $k != "behavior_strategy" && $k != "acquired_how"){
                $different[$k] = $k . " set to " . $sql_parts['field'][$k] . '. </br> Previously, this value was : ' . $v . '</br>';
                }
                //i mean couldn't this be an else?? does this even have to be inside it's own if as were switching off from the value of k
                if($k == "notes" || $k == "behavior_strategy" || $k == "acquired_how" || $k == "feeding_instructions" || $k == "picture"){

                switch($k){
                  case "notes":
                  $sql_parts['field'][$k] = str_replace("%2C",",",$sql_parts['field'][$k]);

                  if($sql_parts['field'][$k] != $v){
                    $different[$k] = $k . " set to " . $sql_parts['field'][$k] . '</br> Previously, this value was : ' . $v . '</br>';
                  }
                  break;

                  case "medical_notes":
                  $sql_parts['field'][$k] = str_replace("%2C",",",$sql_parts['field'][$k]);

                  if($sql_parts['field'][$k] != $v){
                    $different[$k] = $k . " set to " . $sql_parts['field'][$k] . '</br> Previously, this value was : ' . $v . '</br>';
                  }
                  break;


                  case "acquired_how":
                  $sql_parts['field'][$k] = str_replace("%2C",",",$sql_parts['field'][$k]);
             
                  if($sql_parts['field'][$k] != $v){
                    $different[$k] = $k . " set to " . $sql_parts['field'][$k] . '</br> Previously, this value was : ' . $v . '</br>';
                  }
                  break;

                  case "feeding_instructions":

                  $sql_parts['field'][$k] = str_replace("%2C",",",$sql_parts['field'][$k]);

                  if($sql_parts['field'][$k] != $v){
                    $different[$k] = $k . " set to " . $sql_parts['field'][$k] . '</br> Previously, this value was : ' . $v . '</br>';
                  }
                  break;
                  case "behavior_strategy":
                  $sql_parts['field'][$k] = str_replace("%2C",",",$sql_parts['field'][$k]);
                  if($sql_parts['field'][$k] != $v){
                    $different[$k] = $k . " set to " . $sql_parts['field'][$k] . '</br> Previously, this value was : ' . $v . '</br>';
                  }
                  break;
                  case "picture":
                  if($sql_parts['field'][$k] != null && $sql_parts['field'][$k] != "" && $sql_parts['field'][$k] != "NULL" && $sql_parts['field'][$k] != "null"){
                    if($sql_parts['field'][$k] != $v){
                      $different[$k] = $k . " set to " . $sql_parts['field'][$k] . '</br> Previously, this value was : ' . $v . '</br>';
                    }
                  }
                  break;

                }
              }
                }
              }
            }
        break;
        }

return $different;

}

//for future drag n drop
function switchRunNum($run_num1,$run_num2){
//TO DO

}

}
?>