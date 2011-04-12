<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : jabatan  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modeljabatan extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListjabatan() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "NmJabatan" .
                " FROM jabatan   order by idx ASC ";
        $query = $this->db->query($xStr);
        $xBuffResul[0] = '-                        ';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->NmJabatan;
        }
        return $xBuffResul;
    }

    function getListjabatan($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where NmJabatan like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "NmJabatan" .
                " FROM jabatan $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailjabatan($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "NmJabatan" .
                " FROM jabatan  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexjabatan() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "NmJabatan" .
                " FROM jabatan order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertjabatan($xidx, $xNmJabatan) {
        $xStr = " INSERT INTO jabatan( " .
                "idx," .
                "NmJabatan) VALUES('" . $xidx . "','" . $xNmJabatan . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatejabatan($xidx, $xNmJabatan) {
        $xStr = " UPDATE jabatan SET " .
                "idx='" . $xidx . "'," .
                "NmJabatan='" . $xNmJabatan . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletejabatan($xidx) {
        $xStr = " DELETE FROM jabatan WHERE jabatan.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>