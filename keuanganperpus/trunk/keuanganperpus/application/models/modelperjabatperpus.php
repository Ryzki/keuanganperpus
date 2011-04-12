<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : perjabatperpus  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */  class modelperjabatperpus extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


function getArrayListperjabatperpus(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx,".
      "idPegawai,".
      "idjabatan,".
      "tglawaljawabatan,".
      "tglakhirjabatan,".
      "idunitkerja".
" FROM perjabatperpus   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->idPegawai; 
   } 
return $xBuffResul;
}

function getListperjabatperpus($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where idPegawai like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx,".
      "idPegawai,".
      "idjabatan,".
      "tglawaljawabatan,".
      "tglakhirjabatan,".
      "idunitkerja".
" FROM perjabatperpus $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}


function getDetailperjabatperpus($xidx){
 $xStr =   "SELECT ".
      "idx,".
      "idPegawai,".
      "idjabatan,".
      "tglawaljawabatan,".
      "tglakhirjabatan,".
      "idunitkerja".
" FROM perjabatperpus  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


function getLastIndexperjabatperpus(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx,".
      "idPegawai,".
      "idjabatan,".
      "tglawaljawabatan,".
      "tglakhirjabatan,".
      "idunitkerja".
" FROM perjabatperpus order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


 Function setInsertperjabatperpus($xidx,$xidPegawai,$xidjabatan,$xtglawaljawabatan,$xtglakhirjabatan,$xidunitkerja)
{
  $xStr =  " INSERT INTO perjabatperpus( ".
              "idx,".
              "idPegawai,".
              "idjabatan,".
              "tglawaljawabatan,".
              "tglakhirjabatan,".
              "idunitkerja) VALUES('".$xidx."','".$xidPegawai."','".$xidjabatan."','".$xtglawaljawabatan."','".$xtglakhirjabatan."','".$xidunitkerja."')";
$query = $this->db->query($xStr);
 return $xidx;
}


 Function setUpdateperjabatperpus($xidx,$xidPegawai,$xidjabatan,$xtglawaljawabatan,$xtglakhirjabatan,$xidunitkerja)
{
  $xStr =  " UPDATE perjabatperpus SET ".
             "idx='".$xidx."',".
             "idPegawai='".$xidPegawai."',".
             "idjabatan='".$xidjabatan."',".
             "tglawaljawabatan='".$xtglawaljawabatan."',".
             "tglakhirjabatan='".$xtglakhirjabatan."',".
             "idunitkerja='".$xidunitkerja."' WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}


 function setDeleteperjabatperpus($xidx)
{
 $xStr =  " DELETE FROM perjabatperpus WHERE perjabatperpus.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
}

}
?>