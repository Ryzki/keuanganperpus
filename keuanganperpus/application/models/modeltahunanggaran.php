<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : tahunanggaran  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modeltahunanggaran extends CI_Model {

    function __construct() {
        parent::__construct();
    }
/****************  07 April 2011 *******************/
 function getDetailtahunanggaranbystatusaktif() {
        $xStr = "SELECT " .
                "idx," .
                "TahunAnggaran," .
                "statusaaktif" .
                " FROM tahunanggaran  WHERE statusaaktif = 'Y'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

 /***************** End off 07 April 2011 *******************/
    function getArrayListtahunanggaran() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "TahunAnggaran," .
                "statusaaktif" .
                " FROM tahunanggaran   order by idx Desc ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->TahunAnggaran;
        }
        return $xBuffResul;
    }

    function getListtahunanggaran($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where TahunAnggaran like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "TahunAnggaran," .
                "statusaaktif" .
                " FROM tahunanggaran $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailtahunanggaran($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "TahunAnggaran," .
                "statusaaktif" .
                " FROM tahunanggaran  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndextahunanggaran() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "TahunAnggaran," .
                "statusaaktif" .
                " FROM tahunanggaran order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInserttahunanggaran($xidx, $xTahunAnggaran, $xstatusaaktif) {
        $xStr = " INSERT INTO tahunanggaran( " .
                "idx," .
                "TahunAnggaran," .
                "statusaaktif) VALUES('" . $xidx . "','" . $xTahunAnggaran . "','" . $xstatusaaktif . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatetahunanggaran($xidx, $xTahunAnggaran, $xstatusaaktif) {
        $xStr = " UPDATE tahunanggaran SET " .
                "idx='" . $xidx . "'," .
                "TahunAnggaran='" . $xTahunAnggaran . "'," .
                "statusaaktif='" . $xstatusaaktif . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdateNotAktif() {
        $xStr = " UPDATE tahunanggaran SET " .
                " statusaaktif='N' ";
        $query = $this->db->query($xStr);
        //return $xidx;
    }

    function setDeletetahunanggaran($xidx) {
        $xStr = " DELETE FROM tahunanggaran WHERE tahunanggaran.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>