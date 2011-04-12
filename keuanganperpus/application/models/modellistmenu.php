<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : listmenu  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */class modellistmenu extends Model {
   function modellistmenu() 
 { 
   parent::Model();
 }


function getArrayListlistmenu(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idlistmenu,".
      "idmenu,".
      "tglisi,".
      "tglupdate,".
      "isaktif".
" FROM listmenu   order by idlistmenu ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idlistmenu] = $row->idmenu; 
   } 
return $xBuffResul;
}

function getListlistmenu($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where idmenu like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idlistmenu,".
      "idmenu,".
      "tglisi,".
      "tglupdate,".
      "isaktif".
" FROM listmenu $xSearch order by idlistmenu DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}


function getDeatillistmenu($xidlistmenu){
 $xStr =   "SELECT ".
      "idlistmenu,".
      "idmenu,".
      "tglisi,".
      "tglupdate,".
      "isaktif".
" FROM listmenu  WHERE idlistmenu = '".$xidlistmenu."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


function getLastIndexlistmenu(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idlistmenu,".
      "idmenu,".
      "tglisi,".
      "tglupdate,".
      "isaktif".
" FROM listmenu order by idlistmenu DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


 Function setInsertlistmenu($xidlistmenu,$xidmenu,$xtglisi,$xtglupdate,$xisaktif)
{
  $xStr =  " INSERT INTO listmenu( ".
              "idlistmenu,".
              "idmenu,".
              "tglisi,".
              "tglupdate,".
              "isaktif) VALUES('".$xidlistmenu."','".$xidmenu."','".$xtglisi."','".$xtglupdate."','".$xisaktif."')";
$query = $this->db->query($xStr);
 return $xidlistmenu;
}


 Function setUpdatelistmenu($xidlistmenu,$xidmenu,$xtglisi,$xtglupdate,$xisaktif)
{
  $xStr =  " UPDATE listmenu SET ".
             "idlistmenu='".$xidlistmenu."',".
             "idmenu='".$xidmenu."',".
             "tglisi='".$xtglisi."',".
             "tglupdate='".$xtglupdate."',".
             "isaktif='".$xisaktif."' WHERE idlistmenu = '".$xidlistmenu."'";
 $query = $this->db->query($xStr);
 return $xidlistmenu;
}


 function setDeletelistmenu($xidlistmenu)
{
 $xStr =  " DELETE FROM listmenu WHERE listmenu.idlistmenu = '".$xidlistmenu."'";

 $query = $this->db->query($xStr);
}

}
?>