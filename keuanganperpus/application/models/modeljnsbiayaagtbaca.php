<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : jnsbiayaagtbaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modeljnsbiayaagtbaca extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListjnsbiayaagtbaca() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "nmbiaya," .
                "biaya" .
                " FROM jnsbiayaagtbaca   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->nmbiaya;
        }
        return $xBuffResul;
    }

    function getListjnsbiayaagtbaca($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where nmbiaya like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "nmbiaya," .
                "biaya" .
                " FROM jnsbiayaagtbaca $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailjnsbiayaagtbaca($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "nmbiaya," .
                "biaya" .
                " FROM jnsbiayaagtbaca  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexjnsbiayaagtbaca() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "nmbiaya," .
                "biaya" .
                " FROM jnsbiayaagtbaca order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertjnsbiayaagtbaca($xidx, $xnmbiaya, $xbiaya) {
        $xStr = " INSERT INTO jnsbiayaagtbaca( " .
                "idx," .
                "nmbiaya," .
                "biaya) VALUES('" . $xidx . "','" . $xnmbiaya . "','" . $xbiaya . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatejnsbiayaagtbaca($xidx, $xnmbiaya, $xbiaya) {
        $xStr = " UPDATE jnsbiayaagtbaca SET " .
                "idx='" . $xidx . "'," .
                "nmbiaya='" . $xnmbiaya . "'," .
                "biaya='" . $xbiaya . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletejnsbiayaagtbaca($xidx) {
        $xStr = " DELETE FROM jnsbiayaagtbaca WHERE jnsbiayaagtbaca.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>