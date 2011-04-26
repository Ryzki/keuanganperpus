<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : jenistransaksi  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modeljenistransaksi extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListjenistransaksi() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "jenistransaksi," .
                "isedittable" .
                " FROM jenistransaksi   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->jenistransaksi;
        }
        return $xBuffResul;
    }

    function getListjenistransaksi($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where jenistransaksi like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "jenistransaksi," .
                "isedittable" .
                " FROM jenistransaksi $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailjenistransaksi($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "jenistransaksi," .
                "isedittable" .
                " FROM jenistransaksi  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexjenistransaksi() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "jenistransaksi," .
                "isedittable" .
                " FROM jenistransaksi order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertjenistransaksi($xidx, $xjenistransaksi, $xisedittable) {
        $xStr = " INSERT INTO jenistransaksi( " .
                "idx," .
                "jenistransaksi," .
                "isedittable) VALUES('" . $xidx . "','" . $xjenistransaksi . "','" . $xisedittable . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatejenistransaksi($xidx, $xjenistransaksi, $xisedittable) {
        $xStr = " UPDATE jenistransaksi SET " .
                "idx='" . $xidx . "'," .
                "jenistransaksi='" . $xjenistransaksi . "'," .
                "isedittable='" . $xisedittable . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletejenistransaksi($xidx) {
        $xStr = " DELETE FROM jenistransaksi WHERE jenistransaksi.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>