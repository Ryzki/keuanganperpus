<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : lokasi  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modellokasi extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListlokasi() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "NmLokasi," .
                "ipsegment" .
                " FROM lokasi   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->NmLokasi;
        }
        return $xBuffResul;
    }

    function getListlokasi($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where NmLokasi like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "NmLokasi," .
                "ipsegment" .
                " FROM lokasi $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetaillokasi($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "NmLokasi," .
                "ipsegment" .
                " FROM lokasi  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexlokasi() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "NmLokasi," .
                "ipsegment" .
                " FROM lokasi order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertlokasi($xidx, $xNmLokasi, $xipsegment) {
        $xStr = " INSERT INTO lokasi( " .
                "idx," .
                "NmLokasi," .
                "ipsegment) VALUES('" . $xidx . "','" . $xNmLokasi . "','" . $xipsegment . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatelokasi($xidx, $xNmLokasi, $xipsegment) {
        $xStr = " UPDATE lokasi SET " .
                "idx='" . $xidx . "'," .
                "NmLokasi='" . $xNmLokasi . "'," .
                "ipsegment='" . $xipsegment . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletelokasi($xidx) {
        $xStr = " DELETE FROM lokasi WHERE lokasi.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>