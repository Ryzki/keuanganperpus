<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : realisasirab  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */  class modelrealisasirab extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


function getArrayListrealisasirab(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx,".
      "tanggal,".
      "jam,".
      "idrab,".
      "keterangan,".
      "nominal,".
      "iduser,".
      "idthnanggaran".
" FROM realisasirab   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->tanggal; 
   } 
return $xBuffResul;
}

function getListrealisasirab($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where tanggal like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx,".
      "tanggal,".
      "jam,".
      "idrab,".
      "keterangan,".
      "nominal,".
      "iduser,".
      "idthnanggaran".
" FROM realisasirab $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}


function getDetailrealisasirab($xidx){
 $xStr =   "SELECT ".
      "idx,".
      "tanggal,".
      "jam,".
      "idrab,".
      "keterangan,".
      "nominal,".
      "iduser,".
      "idthnanggaran".
" FROM realisasirab  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


function getLastIndexrealisasirab(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx,".
      "tanggal,".
      "jam,".
      "idrab,".
      "keterangan,".
      "nominal,".
      "iduser,".
      "idthnanggaran".
" FROM realisasirab order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


 Function setInsertrealisasirab($xidx,$xtanggal,$xjam,$xidrab,$xketerangan,$xnominal,$xiduser,$xidthnanggaran)
{
  $xStr =  " INSERT INTO realisasirab( ".
              "idx,".
              "tanggal,".
              "jam,".
              "idrab,".
              "keterangan,".
              "nominal,".
              "iduser,".
              "idthnanggaran) VALUES('".$xidx."','".$xtanggal."','".$xjam."','".$xidrab."','".$xketerangan."','".$xnominal."','".$xiduser."','".$xidthnanggaran."')";
$query = $this->db->query($xStr);
 return $xidx;
}


 Function setUpdaterealisasirab($xidx,$xtanggal,$xjam,$xidrab,$xketerangan,$xnominal,$xiduser,$xidthnanggaran)
{
  $xStr =  " UPDATE realisasirab SET ".
             "idx='".$xidx."',".
             "tanggal='".$xtanggal."',".
             "jam='".$xjam."',".
             "idrab='".$xidrab."',".
             "keterangan='".$xketerangan."',".
             "nominal='".$xnominal."',".
             "iduser='".$xiduser."',".
             "idthnanggaran='".$xidthnanggaran."' WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}


 function setDeleterealisasirab($xidx)
{
 $xStr =  " DELETE FROM realisasirab WHERE realisasirab.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
}

}
?>