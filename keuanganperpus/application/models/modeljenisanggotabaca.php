<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : jenisanggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */  class modeljenisanggotabaca extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


function getArrayListjenisanggotabaca(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx,".
      "jenisanggotabaca".
" FROM jenisanggotabaca   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->jenisanggotabaca; 
   } 
return $xBuffResul;
}

function getListjenisanggotabaca($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where jenisanggotabaca like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx,".
      "jenisanggotabaca".
" FROM jenisanggotabaca $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}


function getDetailjenisanggotabaca($xidx){
 $xStr =   "SELECT ".
      "idx,".
      "jenisanggotabaca".
" FROM jenisanggotabaca  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


function getLastIndexjenisanggotabaca(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx,".
      "jenisanggotabaca".
" FROM jenisanggotabaca order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


 Function setInsertjenisanggotabaca($xidx,$xjenisanggotabaca)
{
  $xStr =  " INSERT INTO jenisanggotabaca( ".
              "idx,".
              "jenisanggotabaca) VALUES('".$xidx."','".$xjenisanggotabaca."')";
$query = $this->db->query($xStr);
 return $xidx;
}


 Function setUpdatejenisanggotabaca($xidx,$xjenisanggotabaca)
{
  $xStr =  " UPDATE jenisanggotabaca SET ".
             "idx='".$xidx."',".
             "jenisanggotabaca='".$xjenisanggotabaca."' WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}


 function setDeletejenisanggotabaca($xidx)
{
 $xStr =  " DELETE FROM jenisanggotabaca WHERE jenisanggotabaca.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
}

}
?>