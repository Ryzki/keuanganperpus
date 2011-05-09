<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : rab  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelrab extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*Update 09 mei 2011 ***************/
    function getLastKodeRABbyParrent($xIdParent) {
                $xStr = "SELECT " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview " .
                " FROM rab WHERE idparent = '".$xIdParent."' order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
      if(!empty ($row->kodeRAB)){
//        //ambil kode terakhir kemudian + 1 dan munculkan;
          $xArrayKode = explode('.', $row->kodeRAB);
//          $xKodeRAB = count($xArrayKode);
          $xKodeRAB = '';
          $xKodeLast = $xArrayKode[count($xArrayKode)-1];
           $xKodeLast += 1;
//           //$xKodeRAB = $xArrayKode[0];
           for($i=0;$i<=count($xArrayKode)-2;$i++){
             $xKodeRAB = $xKodeRAB.'.' . $xArrayKode[$i];
//
           }
           $xKodeRAB .= '.'.str_pad($xKodeLast. '', 3, '0', STR_PAD_LEFT);


      }else//jika kosong berarti child
      {
        $rowrab = $this->getDetailrab($xIdParent);
        $xKodeRAB =  $rowrab->kodeRAB.'.'.'001';
      }
       if(strpos($xKodeRAB,'.')==0){
         $xKodeRAB = substr($xKodeRAB, 1);
       }
       return $xKodeRAB;
      // return 'aaa';
    }

    function getListraballbyidx() {
                $xStr = "SELECT " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview" .
                " FROM rab  order by idx ASC ";
        $query = $this->db->query($xStr);
        return $query;
    }

    function getKodeRABbyUrut($xIdxRAB,$xIdxParent){
     $xStrSet  = "set @urut :=0";
     $this->db->query($xStrSet);
     $xStr = "Select urut,idx,JudulRAB,idparent,kodeRAB from(select @urut :=  @urut + 1  as urut ,idx,JudulRAB,idparent,kodeRAB,isview from keuperpususd.rab where idparent ='".$xIdxParent."') tb1 where idx='".$xIdxRAB."' ";
     $query = $this->db->query($xStr);
     $row = $query->row();
     return $row;

    }


    /*     * **********edit  02 april 2011 ******** */

    function getDetailrabparent($xidparent) {
        /*  if($xid=='0'){
          $xWhere = " WHERE  parent = 0";
          } else
          {
          $xWhere = " WHERE  parent = '".$xparent."'";
          //$xWhere = " WHERE  left(parent,length('".$xid."')) = '".$xid."'";
          }
         */
        $xWhere = " WHERE  idparent = '" . $xidparent . "'";

        $xStr = "SELECT " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview" .
                " FROM rab  $xWhere order by idx Desc limit 1";
                

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;

// return $xStr;
    }
    
    function getListraball() {
                $xStr = "SELECT " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview" .
                " FROM rab  where isview = 'Y' order by kodeRAB ASC  ";
        $query = $this->db->query($xStr);
        return $query;
    }

    
    function getListForTree($xParent='') {
        if (!empty($xParent)) {
            $xParent = " Where idparent = '" . $xParent . "'";
        } else {
            $xParent = " Where  idparent = '0'";
        }
        $xSearch = " " . $xParent;

// $xStr =   "SELECT ".
//      "id,".
//      "idakun,".
//      "namaakun,".
//      "isgroup,".
//      "isdebet,".
//      "parent".
//      " FROM akun $xSearch order by id ";

        $xStr = "SELECT " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview" .
                " FROM rab  $xSearch order by idx ASC ";
        $query = $this->db->query($xStr);

        return $query;
    }

    function GetChild($xQuery) {
        $xBufResult = "";
        if (!empty($xQuery)) {

            foreach ($xQuery->result() as $row) {
                //$xRowUrl =  $row->urlci;
                //if(empty($xRowUrl)){
                // $xRowUrl = 'ctrblueprint/index/'.$row->id;
                //}

                $xChild = $this->GetChild($this->getListForTree($row->idx));
                if (!empty($xChild)) {
                    $xBufResult .= setlitree(site_url('#'), '<span class="folder" onclick="doedit(' . $row->idx . ');">' . $row->JudulRAB . '</span>', $xChild);
                } else {
                    $xBufResult .= setlitree(site_url('#'), '<span class="file" onclick="doedit(' . $row->idx . ');">' . $row->JudulRAB . '</span>', $xChild);
                }
                //$xChild  = $this->GetChild($this->getListForTree($row->idmenu));
                //$xBufResult .= setli(site_url($xRowUrl),$row->nmmenu,$xChild);
            }

            if (!empty($xBufResult))
                $xBufResult = setul('', $xBufResult);
        }
        return $xBufResult;
    }

    function gettreeview() {
        $xBufResult = "";
        $this->load->helper('menu');
        $this->load->helper('url');
        $xQuery = $this->getListForTree("");
        foreach ($xQuery->result() as $row) {
            $xChild = $this->GetChild($this->getListForTree($row->idx));
            $xBufResult .= setlitree(site_url('#'), '<span class="folder" onclick="doedit(' . $row->idx . ');">' . $row->JudulRAB . '</span>', $xChild);
            //$xBufResult .= setli(site_url($row->urlci),'<span class="folder">'.$row->nmmenu.'</span>',$xChild);
        }
        //$xBufResult = setul('menuatas',$xBufResult);
        $xBufResult = setultree(' id="browser" class="filetree" ', $xBufResult);

        return $xBufResult;
    }

    function GetChildforposting($xQuery) {
        $xBufResult = "";
        if (!empty($xQuery)) {

            foreach ($xQuery->result() as $row) {
                //$xRowUrl =  $row->urlci;
                //if(empty($xRowUrl)){
                // $xRowUrl = 'ctrblueprint/index/'.$row->id;
                //}

                $xChild = $this->GetChildforposting($this->getListForTree($row->idx));
                if (!empty($xChild)) {
                    $xBufResult .= setlitree(site_url('#'), '<span class="folder" onclick="doeditposting(' . $row->idx . ');">' . $row->JudulRAB . '</span>', $xChild);
                } else {
                    $xBufResult .= setlitree(site_url('#'), '<span class="file" onclick="doeditposting(' . $row->idx . ');">' . $row->JudulRAB . '</span>', $xChild);
                }
                //$xChild  = $this->GetChild($this->getListForTree($row->idmenu));
                //$xBufResult .= setli(site_url($xRowUrl),$row->nmmenu,$xChild);
            }

            if (!empty($xBufResult))
                $xBufResult = setul('', $xBufResult);
        }
        return $xBufResult;
    }

    function gettreeviewforposting() {
        $xBufResult = "";
        $this->load->helper('menu');
        $this->load->helper('url');
        $xQuery = $this->getListForTree("");
        foreach ($xQuery->result() as $row) {
            $xChild = $this->GetChildforposting($this->getListForTree($row->idx));
            $xBufResult .= setlitree(site_url('#'), '<span class="folder" onclick="doeditposting(' . $row->idx . ');">' . $row->JudulRAB . '</span>', $xChild);
            //$xBufResult .= setli(site_url($row->urlci),'<span class="folder">'.$row->nmmenu.'</span>',$xChild);
        }
        //$xBufResult = setul('menuatas',$xBufResult);
        $xBufResult = setultree(' id="browser" class="filetree" ', $xBufResult);

        return $xBufResult;
    }

    function chforreport($xQuery) {
        $xBufResult = "";
        if (!empty($xQuery)) {
            foreach ($xQuery->result() as $row) {
                 $xChild = $this->chforreport($this->getListForTree($row->idx));
                if (!empty($xChild)) {
                    $xBufResult .= setlitree(site_url('#'), '<span class="folder" onclick="dosetcb(' . $row->idx . ');">' . $row->JudulRAB . '</span>', $xChild);
                } else {
                    $xBufResult .= setlitree(site_url('#'), '<span class="file" onclick="dosetcb(' . $row->idx . ');">' . $row->JudulRAB . '</span>', $xChild);
              }

            if (!empty($xBufResult))
                $xBufResult = setul('', $xBufResult);
        }
        return $xBufResult;
    }
    }
    
    function gettreereport() {
        $xBufResult = "";
        $this->load->helper('menu');
        $this->load->helper('url');
        $xQuery = $this->getListForTree("");
        foreach ($xQuery->result() as $row) {
            $xChild = $this->chforreport($this->getListForTree($row->idx));
            $xBufResult .= setlitree(site_url('#'), '<span class="folder" onclick="dosetcb(' . $row->idx . ');">' . $row->JudulRAB . '</span>', $xChild);
            
        }
        
        $xBufResult = setultree(' id="browser" class="filetree" ', $xBufResult);

        return $xBufResult;
    }

    function getArrayListrabnotarray() {
        //$xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview" .
                " FROM rab   order by idx ASC ";
        $query = $this->db->query($xStr);
        $xBufResult = "<option value=\"0\" selected=\"selected\">-</option>";

// $xBuffResul['0'] = "-";
        foreach ($query->result() as $row) {
            // $xBuffResul[$row->id] = $row->namaakun;

            $xBufResult .= "<option value=\"" . $row->idx . "\" >" . $row->JudulRAB . "</option>";
        }
        return $xBufResult;
    }


  function setDeleterabbykodeRAB($kodeRAB) {
        $xStr = " DELETE FROM rab WHERE left(kodeRAB,length('".$kodeRAB."')) = '" . $kodeRAB . "'";

        $query = $this->db->query($xStr);
    }


    function GettreeChildchk($xQuery) {
        $xBufResult = "";
        if (!empty($xQuery)) {

            foreach ($xQuery->result() as $row) {
                //$xRowUrl =  $row->urlci;
                //if(empty($xRowUrl)){
                // $xRowUrl = 'ctrblueprint/index/'.$row->id;
                //}

                $xChild = $this->GettreeChildchk($this->getListForTree($row->idx));
                if (!empty($xChild)) {
                    $xBufResult .= setlitreechk( $row->idx , $row->JudulRAB, $xChild);
                } else {
                    $xBufResult .= setlitreechk($row->idx , $row->JudulRAB, $xChild);
                }
                //$xChild  = $this->GetChild($this->getListForTree($row->idmenu));
                //$xBufResult .= setli(site_url($xRowUrl),$row->nmmenu,$xChild);
            }

            if (!empty($xBufResult))
                $xBufResult = setul('', $xBufResult);
        }
        return $xBufResult;
    }

    function gettreeviewchk() {
        $xBufResult = "";
        $this->load->helper('menu');
        $this->load->helper('url');
        $xQuery = $this->getListForTree("");
        foreach ($xQuery->result() as $row) {
            $xChild = $this->GettreeChildchk($this->getListForTree($row->idx));
            $xBufResult .= setlitreechk( $row->idx ,$row->JudulRAB , $xChild);
            //$xBufResult .= setli(site_url($row->urlci),'<span class="folder">'.$row->nmmenu.'</span>',$xChild);
        }
        //$xBufResult = setul('menuatas',$xBufResult);
        $xBufResult = setultree('id="tree"', $xBufResult);

        return $xBufResult;
    }
//********************************************************end edit*************/

    function getArrayListrab($isParentNotShow=false) { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview" .
                " FROM rab   order by idx ASC ";
        $query = $this->db->query($xStr);
        $xBuffResul[0] = '-';
        foreach ($query->result() as $row) {
            if($isParentNotShow){
              $this->load->model('modelpostingrab');
              if(!$this->modelpostingrab->getIsParrent($row->idx)){
                $xBuffResul[$row->idx] = $row->JudulRAB;
              }

            } else{

            $xBuffResul[$row->idx] = $row->JudulRAB;
            }
        }
        return $xBuffResul;
    }

    function getListrab($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where JudulRAB like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview" .
                " FROM rab $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailrab($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview" .
                " FROM rab  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getDetailrabbykode($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview" .
                " FROM rab  WHERE kodeRAB = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexrab() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview" .
                " FROM rab order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertrab($xidx, $xJudulRAB, $xidparent, $xkodeRAB, $xkodeRABUSD,$xisview) {
        $xStr = " INSERT INTO rab( " .
                "idx," .
                "JudulRAB," .
                "idparent," .
                "kodeRAB," .
                "kodeRABUSD,isview) VALUES('" . $xidx . "','" . $xJudulRAB . "','" . $xidparent .
                                           "','" . $xkodeRAB . "','" . $xkodeRABUSD . "','".$xisview."')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdaterab($xidx, $xJudulRAB, $xidparent, $xkodeRAB, $xkodeRABUSD,$xisview) {
        $xStr = " UPDATE rab SET " .
                "idx='" . $xidx . "'," .
                "JudulRAB='" . $xJudulRAB . "'," .
                "idparent='" . $xidparent . "'," .
                "kodeRAB='" . $xkodeRAB . "'," .
                "kodeRABUSD='" . $xkodeRABUSD ."',".
                "isview ='".$xisview."' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdateKodeRab($xidx, $xkodeRAB) {
        $xStr = " UPDATE rab SET " .
                " kodeRAB='" . $xkodeRAB . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xStr;
    }

    function setDeleterab($xidx) {
        $xStr = " DELETE FROM rab WHERE rab.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }


}

?>