<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : statusplu  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */  class modelstatusplu extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


function getArrayListstatusplu(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx,".
      "Status".
" FROM statusplu   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->Status; 
   } 
return $xBuffResul;
}

function getListstatusplu($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where Status like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx,".
      "Status".
" FROM statusplu $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}


function getDetailstatusplu($xidx){
 $xStr =   "SELECT ".
      "idx,".
      "Status".
" FROM statusplu  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


function getLastIndexstatusplu(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx,".
      "Status".
" FROM statusplu order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


 Function setInsertstatusplu($xidx,$xStatus)
{
  $xStr =  " INSERT INTO statusplu( ".
              "idx,".
              "Status) VALUES('".$xidx."','".$xStatus."')";
$query = $this->db->query($xStr);
 return $xidx;
}


 Function setUpdatestatusplu($xidx,$xStatus)
{
  $xStr =  " UPDATE statusplu SET ".
             "idx='".$xidx."',".
             "Status='".$xStatus."' WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}


 function setDeletestatusplu($xidx)
{
 $xStr =  " DELETE FROM statusplu WHERE statusplu.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
}

}
?>