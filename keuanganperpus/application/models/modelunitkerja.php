<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : unitkerja  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelunitkerja extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListunitkerja() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "KdUnitKerjaUSD," .
                "NmUnitKerja" .
                " FROM unitkerja   order by idx ASC ";
        $query = $this->db->query($xStr);
        //$xBuffResul[0] = '-';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->NmUnitKerja;
        }
        return $xBuffResul;
    }

    function getListunitkerja($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where KdUnitKerjaUSD like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "KdUnitKerjaUSD," .
                "NmUnitKerja" .
                " FROM unitkerja $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailunitkerja($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "KdUnitKerjaUSD," .
                "NmUnitKerja" .
                " FROM unitkerja  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexunitkerja() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "KdUnitKerjaUSD," .
                "NmUnitKerja" .
                " FROM unitkerja order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertunitkerja($xidx, $xKdUnitKerjaUSD, $xNmUnitKerja) {
        $xStr = " INSERT INTO unitkerja( " .
                "idx," .
                "KdUnitKerjaUSD," .
                "NmUnitKerja) VALUES('" . $xidx . "','" . $xKdUnitKerjaUSD . "','" . $xNmUnitKerja . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdateunitkerja($xidx, $xKdUnitKerjaUSD, $xNmUnitKerja) {
        $xStr = " UPDATE unitkerja SET " .
                "idx='" . $xidx . "'," .
                "KdUnitKerjaUSD='" . $xKdUnitKerjaUSD . "'," .
                "NmUnitKerja='" . $xNmUnitKerja . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeleteunitkerja($xidx) {
        $xStr = " DELETE FROM unitkerja WHERE unitkerja.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>