<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : produkplu  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelprodukplu extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //********** Updte 29 Maret 2010 *********
    function getDetailprodukplubykode($xkodeplu) {
        $xStr = "SELECT " .
                "idx," .
                "KodePLU," .
                "idJnsPengguna," .
                "NamaProduk," .
                "Singkatan," .
                "idstatusPLU," .
                "idrekanan," .
                "harga," .
                "idjenistransaksi" .
                " FROM produkplu  WHERE KodePLU = '" . $xkodeplu . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }
    //*//
    
    function getArrayListprodukplu() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "KodePLU," .
                "idJnsPengguna," .
                "NamaProduk," .
                "Singkatan," .
                "idstatusPLU," .
                "idrekanan," .
                "harga," .
                "idjenistransaksi" .
                " FROM produkplu   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->KodePLU;
        }
        return $xBuffResul;
    }

    function getListprodukplu($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where (KodePLU like '%" . $xSearch . "%') or (NamaProduk like '%" . $xSearch . "%')";
        }
        $xStr = "SELECT " .
                "idx," .
                "KodePLU," .
                "idJnsPengguna," .
                "NamaProduk," .
                "Singkatan," .
                "idstatusPLU," .
                "idrekanan," .
                "harga," .
                "idjenistransaksi" .
                " FROM produkplu $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailprodukplu($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "KodePLU," .
                "idJnsPengguna," .
                "NamaProduk," .
                "Singkatan," .
                "idstatusPLU," .
                "idrekanan," .
                "harga," .
                "idjenistransaksi" .
                " FROM produkplu  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexprodukplu() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "KodePLU," .
                "idJnsPengguna," .
                "NamaProduk," .
                "Singkatan," .
                "idstatusPLU," .
                "idrekanan," .
                "harga," .
                "idjenistransaksi" .
                " FROM produkplu order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertprodukplu($xidx, $xKodePLU, $xidJnsPengguna, $xNamaProduk, $xSingkatan, $xidstatusPLU, $xidrekanan, $xharga, $xidjenistransaksi) {
        $xStr = " INSERT INTO produkplu( " .
                "idx," .
                "KodePLU," .
                "idJnsPengguna," .
                "NamaProduk," .
                "Singkatan," .
                "idstatusPLU," .
                "idrekanan," .
                "harga," .
                "idjenistransaksi) VALUES('" . $xidx . "','" . $xKodePLU . "','" . $xidJnsPengguna . "','" . $xNamaProduk . "','" . $xSingkatan . "','" . $xidstatusPLU . "','" . $xidrekanan . "','" . $xharga . "','" . $xidjenistransaksi . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdateprodukplu($xidx, $xKodePLU, $xidJnsPengguna, $xNamaProduk, $xSingkatan, $xidstatusPLU, $xidrekanan, $xharga, $xidjenistransaksi) {
        $xStr = " UPDATE produkplu SET " .
                "idx='" . $xidx . "'," .
                "KodePLU='" . $xKodePLU . "'," .
                "idJnsPengguna='" . $xidJnsPengguna . "'," .
                "NamaProduk='" . $xNamaProduk . "'," .
                "Singkatan='" . $xSingkatan . "'," .
                "idstatusPLU='" . $xidstatusPLU . "'," .
                "idrekanan='" . $xidrekanan . "'," .
                "harga='" . $xharga . "'," .
                "idjenistransaksi='" . $xidjenistransaksi . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeleteprodukplu($xidx) {
        $xStr = " DELETE FROM produkplu WHERE produkplu.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>