<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : jenipengguna  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modeljenipengguna extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListjenipengguna() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "JenisPengguna" .
                " FROM jenipengguna   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->JenisPengguna;
        }
        return $xBuffResul;
    }

    function getListjenipengguna($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where JenisPengguna like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "JenisPengguna" .
                " FROM jenipengguna $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailjenipengguna($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "JenisPengguna" .
                " FROM jenipengguna  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexjenipengguna() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "JenisPengguna" .
                " FROM jenipengguna order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertjenipengguna($xidx, $xJenisPengguna) {
        $xStr = " INSERT INTO jenipengguna( " .
                "idx," .
                "JenisPengguna) VALUES('" . $xidx . "','" . $xJenisPengguna . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatejenipengguna($xidx, $xJenisPengguna) {
        $xStr = " UPDATE jenipengguna SET " .
                "idx='" . $xidx . "'," .
                "JenisPengguna='" . $xJenisPengguna . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletejenipengguna($xidx) {
        $xStr = " DELETE FROM jenipengguna WHERE jenipengguna.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>