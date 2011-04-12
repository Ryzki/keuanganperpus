<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : anggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modeldenda extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListanggotabaca() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "NoIdentitas," .
                "Nama," .
                "idJenisAnggota," .
                "Alamat," .
                "Kota," .
                "kodepos," .
                "Notelp," .
                "email" .
                " FROM anggotabaca   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->NoIdentitas;
        }
        return $xBuffResul;
    }

    function getListanggotabaca($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where NoIdentitas like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "NoIdentitas," .
                "Nama," .
                "idJenisAnggota," .
                "Alamat," .
                "Kota," .
                "kodepos," .
                "Notelp," .
                "email" .
                " FROM anggotabaca $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailanggotabaca($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "NoIdentitas," .
                "Nama," .
                "idJenisAnggota," .
                "Alamat," .
                "Kota," .
                "kodepos," .
                "Notelp," .
                "email" .
                " FROM anggotabaca  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexanggotabaca() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "NoIdentitas," .
                "Nama," .
                "idJenisAnggota," .
                "Alamat," .
                "Kota," .
                "kodepos," .
                "Notelp," .
                "email" .
                " FROM anggotabaca order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertanggotabaca($xidx, $xNoIdentitas, $xNama, $xidJenisAnggota, $xAlamat, $xKota, $xkodepos, $xNotelp, $xemail) {
        $xStr = " INSERT INTO anggotabaca( " .
                "idx," .
                "NoIdentitas," .
                "Nama," .
                "idJenisAnggota," .
                "Alamat," .
                "Kota," .
                "kodepos," .
                "Notelp," .
                "email) VALUES('" . $xidx . "','" . $xNoIdentitas . "','" . $xNama . "','" . $xidJenisAnggota . "','" . $xAlamat . "','" . $xKota . "','" . $xkodepos . "','" . $xNotelp . "','" . $xemail . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdateanggotabaca($xidx, $xNoIdentitas, $xNama, $xidJenisAnggota, $xAlamat, $xKota, $xkodepos, $xNotelp, $xemail) {
        $xStr = " UPDATE anggotabaca SET " .
                "idx='" . $xidx . "'," .
                "NoIdentitas='" . $xNoIdentitas . "'," .
                "Nama='" . $xNama . "'," .
                "idJenisAnggota='" . $xidJenisAnggota . "'," .
                "Alamat='" . $xAlamat . "'," .
                "Kota='" . $xKota . "'," .
                "kodepos='" . $xkodepos . "'," .
                "Notelp='" . $xNotelp . "'," .
                "email='" . $xemail . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeleteanggotabaca($xidx) {
        $xStr = " DELETE FROM anggotabaca WHERE anggotabaca.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>