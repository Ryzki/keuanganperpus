<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : statusplu  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelstatusplu extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListstatusplu() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xBuffResul[0] = '-';
        $xStr = "SELECT " .
                "idx," .
                "Status,prosenreguler,prosenperpus " .
                " FROM statusplu   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->Status;
        }
        return $xBuffResul;
    }

    function getprosenstatusplu($idstatusplu,$ispusd) { /* spertinya perlu lock table */
        
        $xStr = "SELECT " .
                "idx," .
                "Status,prosenreguler,prosenperpus " .
                " FROM statusplu WHERE idx ='".$idstatusplu."' order by idx ASC ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        $xBufresult = 0;
        if($ispusd=="Y"){
          $xBufresult =   $row->prosenperpus;

        }  else {
          $xBufresult =   $row->prosenreguler;
        }

        return $xBufresult;
        
    }

    function getListstatusplu($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where Status like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "Status,prosenreguler,prosenperpus" .
                " FROM statusplu $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailstatusplu($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "Status,prosenreguler,prosenperpus" .
                " FROM statusplu  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexstatusplu() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "Status,prosenreguler,prosenperpus" .
                " FROM statusplu order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertstatusplu($xidx, $xStatus,$xprosenreguler,$xprosenperpus) {
        $xStr = " INSERT INTO statusplu( " .
                "idx," .
                "Status,prosenreguler,prosenperpus) VALUES('" . $xidx . "','" . $xStatus . "','".$xprosenreguler."','".$xprosenperpus."')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatestatusplu($xidx, $xStatus,$xprosenreguler,$xprosenperpus) {
        $xStr = " UPDATE statusplu SET " .
                "idx='" . $xidx . "'," .
                "Status='" . $xStatus ."',".
                "prosenreguler='".$xprosenreguler."',".
                "prosenperpus='".$xprosenperpus."'".
                " WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletestatusplu($xidx) {
        $xStr = " DELETE FROM statusplu WHERE statusplu.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>