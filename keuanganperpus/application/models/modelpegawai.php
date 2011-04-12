<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : pegawai  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelpegawai extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//***** Update 28 Maret  ****
    function getDataLogin($xUser, $xPassword) {
        $xStr = "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "idUnitKerja," .
                "NoTelpon," .
                "user," .
                "password," .
                "idLokasi,current_date tanggal" .
                " FROM pegawai  WHERE user = '" . addslashes($xUser) . "' and password = '" . addslashes($xPassword) . "'";
        //echo $xStr;
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getDataPegawai($xNpp) {
        $xStr = "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "idUnitKerja,(select NmUnitKerja from unitkerja where unitkerja.idx =pegawai.idUnitKerja) as nmunitkerja," .
                "NoTelpon," .
                "user," .
                "password," .
                "idLokasi,current_date tanggal" .
                " FROM pegawai  WHERE npp = '" . $xNpp . "'";
        //echo $xStr;
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

//*************//


    function getArrayListpegawai() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "idUnitKerja," .
                "NoTelpon," .
                "user," .
                "password," .
                "idLokasi" .
                " FROM pegawai   order by idx ASC ";
        $query = $this->db->query($xStr);
        $xBuffResul[0] = '-';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->Nama;
        }
        return $xBuffResul;
    }

    function getListpegawai($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where npp like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "idUnitKerja," .
                "NoTelpon," .
                "user," .
                "password," .
                "idLokasi" .
                " FROM pegawai $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailpegawai($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "idUnitKerja," .
                "NoTelpon," .
                "user," .
                "password," .
                "idLokasi" .
                " FROM pegawai  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexpegawai() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "idUnitKerja," .
                "NoTelpon," .
                "user," .
                "password," .
                "idLokasi" .
                " FROM pegawai order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertpegawai($xidx, $xnpp, $xNama, $xidUnitKerja, $xNoTelpon, $xuser, $xpassword, $xidLokasi) {
        $xStr = " INSERT INTO pegawai( " .
                "idx," .
                "npp," .
                "Nama," .
                "idUnitKerja," .
                "NoTelpon," .
                "user," .
                "password," .
                "idLokasi) VALUES('" . $xidx . "','" . $xnpp . "','" . $xNama . "','" . $xidUnitKerja . "','" . $xNoTelpon . "','" . $xuser . "','" . $xpassword . "','" . $xidLokasi . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatepegawai($xidx, $xnpp, $xNama, $xidUnitKerja, $xNoTelpon, $xuser, $xpassword, $xidLokasi) {
        $xStr = " UPDATE pegawai SET " .
                "idx='" . $xidx . "'," .
                "npp='" . $xnpp . "'," .
                "Nama='" . $xNama . "'," .
                "idUnitKerja='" . $xidUnitKerja . "'," .
                "NoTelpon='" . $xNoTelpon . "'," .
                "user='" . $xuser . "'," .
                "password='" . $xpassword . "'," .
                "idLokasi='" . $xidLokasi . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletepegawai($xidx) {
        $xStr = " DELETE FROM pegawai WHERE pegawai.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>