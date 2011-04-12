<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : tipemenu  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */
class modeltipemenu extends CI_Model {
  function __construct()
    {
        parent::__construct();
    }


function getArrayListtipemenu(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idTipeMenu,".
      "NmTipeMenu".
" FROM tipemenu   order by idTipeMenu ASC ";
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idTipeMenu] = $row->NmTipeMenu; 
   } 
return $xBuffResul;
}

function getListtipemenu($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where NmTipeMenu like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idTipeMenu,".
      "NmTipeMenu".
" FROM tipemenu $xSearch order by idTipeMenu DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}


function getDeatiltipemenu($xidTipeMenu){
 $xStr =   "SELECT ".
      "idTipeMenu,".
      "NmTipeMenu".
" FROM tipemenu  WHERE idTipeMenu = '".$xidTipeMenu."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


function getLastIndextipemenu(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idTipeMenu,".
      "NmTipeMenu".
" FROM tipemenu order by idTipeMenu DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


 Function setInserttipemenu($xidTipeMenu,$xNmTipeMenu)
{
  $xStr =  " INSERT INTO tipemenu( ".
              "idTipeMenu,".
              "NmTipeMenu) VALUES('".$xidTipeMenu."','".$xNmTipeMenu."')";
$query = $this->db->query($xStr);
 return $xidTipeMenu;
}


 Function setUpdatetipemenu($xidTipeMenu,$xNmTipeMenu)
{
  $xStr =  " UPDATE tipemenu SET ".
             "idTipeMenu='".$xidTipeMenu."',".
             "NmTipeMenu='".$xNmTipeMenu."' WHERE idTipeMenu = '".$xidTipeMenu."'";
 $query = $this->db->query($xStr);
 return $xidTipeMenu;
}


 function setDeletetipemenu($xidTipeMenu)
{
 $xStr =  " DELETE FROM tipemenu WHERE tipemenu.idTipeMenu = '".$xidTipeMenu."'";

 $query = $this->db->query($xStr);
}

}
?>