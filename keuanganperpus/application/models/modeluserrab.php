<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : userrab  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modeluserrab extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListuserrab() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "iduser," .
                "idrab" .
                " FROM userrab   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->iduser;
        }
        return $xBuffResul;
    }

    function getListuserrab($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where iduser like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "iduser," .
                "idrab" .
                " FROM userrab $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailuserrab($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "iduser," .
                "idrab" .
                " FROM userrab  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexuserrab() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "iduser," .
                "idrab" .
                " FROM userrab order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertuserrab($xidx, $xiduser, $xidrab) {
        $xStr = " INSERT INTO userrab( " .
                "idx," .
                "iduser," .
                "idrab) VALUES('" . $xidx . "','" . $xiduser . "','" . $xidrab . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdateuserrab($xidx, $xiduser, $xidrab) {
        $xStr = " UPDATE userrab SET " .
                "idx='" . $xidx . "'," .
                "iduser='" . $xiduser . "'," .
                "idrab='" . $xidrab . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeleteuserrab($xidx) {
        $xStr = " DELETE FROM userrab WHERE userrab.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>