<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : hargajenistransaksi  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelhargajenistransaksi extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    
    ///*********** Update 28 Maret
    
    function getDetailhargaIdJnsTransaksi($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "idJenisTransaksi," .
                "biaya" .
                " FROM hargajenistransaksi  WHERE idJenisTransaksi = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }
    
    
    ///************
    function getArrayListhargajenistransaksi() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "idJenisTransaksi," .
                "biaya" .
                " FROM hargajenistransaksi   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->idJenisTransaksi;
        }
        return $xBuffResul;
    }

    function getListhargajenistransaksi($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where idJenisTransaksi like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "idJenisTransaksi," .
                "biaya" .
                " FROM hargajenistransaksi $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailhargajenistransaksi($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "idJenisTransaksi," .
                "biaya" .
                " FROM hargajenistransaksi  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    
    function getLastIndexhargajenistransaksi() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "idJenisTransaksi," .
                "biaya" .
                " FROM hargajenistransaksi order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInserthargajenistransaksi($xidx, $xidJenisTransaksi, $xbiaya) {
        $xStr = " INSERT INTO hargajenistransaksi( " .
                "idx," .
                "idJenisTransaksi," .
                "biaya) VALUES('" . $xidx . "','" . $xidJenisTransaksi . "','" . $xbiaya . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatehargajenistransaksi($xidx, $xidJenisTransaksi, $xbiaya) {
        $xStr = " UPDATE hargajenistransaksi SET " .
                "idx='" . $xidx . "'," .
                "idJenisTransaksi='" . $xidJenisTransaksi . "'," .
                "biaya='" . $xbiaya . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletehargajenistransaksi($xidx) {
        $xStr = " DELETE FROM hargajenistransaksi WHERE hargajenistransaksi.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>