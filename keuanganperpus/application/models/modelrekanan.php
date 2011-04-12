<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : rekanan  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */  class modelrekanan extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


function getArrayListrekanan(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx,".
      "NamaRekanan,".
      "alamat,".
      "NoTelephon,".
      "NamaPenanggungJawab,".
      "NoTelpPenanggungJawab".
" FROM rekanan   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->NamaRekanan; 
   } 
return $xBuffResul;
}

function getListrekanan($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where NamaRekanan like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx,".
      "NamaRekanan,".
      "alamat,".
      "NoTelephon,".
      "NamaPenanggungJawab,".
      "NoTelpPenanggungJawab".
" FROM rekanan $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}


function getDetailrekanan($xidx){
 $xStr =   "SELECT ".
      "idx,".
      "NamaRekanan,".
      "alamat,".
      "NoTelephon,".
      "NamaPenanggungJawab,".
      "NoTelpPenanggungJawab".
" FROM rekanan  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


function getLastIndexrekanan(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx,".
      "NamaRekanan,".
      "alamat,".
      "NoTelephon,".
      "NamaPenanggungJawab,".
      "NoTelpPenanggungJawab".
" FROM rekanan order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


 Function setInsertrekanan($xidx,$xNamaRekanan,$xalamat,$xNoTelephon,$xNamaPenanggungJawab,$xNoTelpPenanggungJawab)
{
  $xStr =  " INSERT INTO rekanan( ".
              "idx,".
              "NamaRekanan,".
              "alamat,".
              "NoTelephon,".
              "NamaPenanggungJawab,".
              "NoTelpPenanggungJawab) VALUES('".$xidx."','".$xNamaRekanan."','".$xalamat."','".$xNoTelephon."','".$xNamaPenanggungJawab."','".$xNoTelpPenanggungJawab."')";
$query = $this->db->query($xStr);
 return $xidx;
}


 Function setUpdaterekanan($xidx,$xNamaRekanan,$xalamat,$xNoTelephon,$xNamaPenanggungJawab,$xNoTelpPenanggungJawab)
{
  $xStr =  " UPDATE rekanan SET ".
             "idx='".$xidx."',".
             "NamaRekanan='".$xNamaRekanan."',".
             "alamat='".$xalamat."',".
             "NoTelephon='".$xNoTelephon."',".
             "NamaPenanggungJawab='".$xNamaPenanggungJawab."',".
             "NoTelpPenanggungJawab='".$xNoTelpPenanggungJawab."' WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}


 function setDeleterekanan($xidx)
{
 $xStr =  " DELETE FROM rekanan WHERE rekanan.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
}

}
?>