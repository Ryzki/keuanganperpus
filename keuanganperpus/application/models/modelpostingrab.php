<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : postingrab  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelpostingrab extends CI_Model {

    function __construct() {
        parent::__construct();
    }
/**************** 05 April 2011****************/
 function getDetailpostingrabbyidrabtahun($xIdRab,$xThn) {
        $xStr = "SELECT " .
                "idx," .
                "idrab," .
                "idtahunanggaran," .
                "nominalposting," .
                "tglisi," .
                "jam," .
                "iduser" .
                " FROM postingrab  WHERE (idrab = '" . $xIdRab . "') and (idtahunanggaran='".$xThn."')";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

 /*********************************************************/
    function getArrayListpostingrab() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "idrab," .
                "idtahunanggaran," .
                "nominalposting," .
                "tglisi," .
                "jam," .
                "iduser" .
                " FROM postingrab   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->idrab;
        }
        return $xBuffResul;
    }

    function getListpostingrab($xAwal, $xLimit,$thnanggaran, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where idtahunanggaran='".$thnanggaran."' and idrab like '%" . $xSearch . "%'";
        } else{
            $xSearch = "Where idtahunanggaran='".$thnanggaran."'";
        }
        $xStr = "SELECT " .
                "idx," .
                "idrab,(Select JudulRAB from rab Where rab.idx = postingrab.idrab) as JudulRAB," .
                "idtahunanggaran,(Select TahunAnggaran from tahunanggaran where tahunanggaran.idx=postingrab.idtahunanggaran) as TahunAnggaran, " .
                "nominalposting," .
                "tglisi," .
                "jam," .
                "iduser" .
                " FROM postingrab ".$xSearch." order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailpostingrab($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "idrab," .
                "idtahunanggaran," .
                "nominalposting," .
                "tglisi," .
                "jam," .
                "iduser" .
                " FROM postingrab  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexpostingrab() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "idrab," .
                "idtahunanggaran," .
                "nominalposting," .
                "tglisi," .
                "jam," .
                "iduser" .
                " FROM postingrab order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertpostingrab($xidx, $xidrab, $xidtahunanggaran, $xnominalposting,  $xiduser) {
        $xStr = " INSERT INTO postingrab( " .
                "idx," .
                "idrab," .
                "idtahunanggaran," .
                "nominalposting," .
                "tglisi," .
                "jam," .
                "iduser) VALUES('" . $xidx . "','" . $xidrab . "','" . $xidtahunanggaran . "','" . $xnominalposting . "',current_date,'current_time','" . $xiduser . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatepostingrab($xidx, $xidrab, $xidtahunanggaran, $xnominalposting,  $xiduser) {
        $xStr = " UPDATE postingrab SET " .
                "idx='" . $xidx . "'," .
                "idrab='" . $xidrab . "'," .
                "idtahunanggaran='" . $xidtahunanggaran . "'," .
                "nominalposting='" . $xnominalposting . "'," .
                "tglisi='current_date'," .
                "jam='current_time'," .
                "iduser='" . $xiduser . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletepostingrab($xidx) {
        $xStr = " DELETE FROM postingrab WHERE postingrab.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>