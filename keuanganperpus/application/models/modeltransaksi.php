<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : transaksi  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modeltransaksi extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//****************update 28 maret 2011**********
    function getSQLDasar($xBulan) {
        return "(Select trx.idx, trx.idplu,plu.idjnspengguna,tanggal,day(tanggal) hari,jumlahsatuan,nominalpersatuan,plu.idstatusPLU ,
                (select JenisPengguna from jenipengguna as jnsp Where jnsp.idx=plu.idjnspengguna limit 1) as pengg
                from transaksi as trx
                inner join produkplu as plu on(trx.idplu=plu.KodePLU) where month(tanggal)='" . $xBulan . "' order by plu.idjnspengguna) as tb1";
    }

    function getlembarsum($xidplu, $xtanggal, $xBulan) {
        $xStr = 'Select sum(jumlahsatuan) as jmllembar from ' . $this->getSQLDasar($xBulan) . ' where day(tanggal) = "' . $xtanggal . '" and  idplu= "' . $xidplu . '" ';
        $query = $this->db->query($xStr);
        //echo $xStr."\n";
        $row = $query->row();
        return $row->jmllembar;
    }

    function getarraystatusplufotocopy($xBulan) {
        $xStr = 'Select distinct(idplu) as idplu from ' . $this->getSQLDasar($xBulan) . '  where idstatusPLU  = "1" order by idplu ASC';
        $query = $this->db->query($xStr);
        $i = 0;
        foreach ($query->result() as $row) {
            $xBuffResul[$i] = $row->idplu;
            $i++;
        }
        return $xBuffResul;
    }

    function getarrayhari($xBulan) {
        $xBuffResul[0] = 'Tgl';
        $xStr = 'Select distinct(hari) as arrayhari from ' . $this->getSQLDasar($xBulan) . ' order by arrayhari ASC';
        $query = $this->db->query($xStr);
        $i = 1;
        foreach ($query->result() as $row) {
            $xBuffResul[$i] = $row->arrayhari;
            $i++;
        }
        $xBuffResul[$i++] = 'Total';
        return $xBuffResul;
    }

    function setDeletetransaksianggotabaca($xidx) {
        $xStr = " DELETE FROM transaksi WHERE transaksi.idpegawai = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

    Function setInserttransaksiFC($xidx, $xidplu, $xidjenistransaksi, $xidstatusplu, $xidgrouppengguna, $xidpegawai, $xidunitkerja, $xidstatusdinas, $xjumlahsatuan, $xnominalpersatuan, $xtotal, $xiduser, $xnominaldenda, $xiddendasparta, $xidlokasi) {
        $xStr = " INSERT INTO transaksi( " .
                "idx," .
                "idplu," .
                "idjenistransaksi," .
                "idstatusplu," .
                "idgrouppengguna," .
                "idpegawai," .
                "idunitkerja," .
                "idstatusdinas," .
                "tanggal," .
                "jam," .
                "jumlahsatuan," .
                "nominalpersatuan," .
                "total," .
                "iduser," .
                "nominaldenda," .
                "iddendasparta," .
                "idlokasi) VALUES('" . $xidx . "','" . $xidplu . "','" . $xidjenistransaksi . "','" . $xidstatusplu . "','" . $xidgrouppengguna . "','" . $xidpegawai . "','" . $xidunitkerja . "','" . $xidstatusdinas . "',current_date,current_time,'" . $xjumlahsatuan . "','" . $xnominalpersatuan . "','" . $xtotal . "','" . $xiduser . "','" . $xnominaldenda . "','" . $xiddendasparta . "','" . $xidlokasi . "')";

// return $xStr;
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatetransaksiFC($xidx, $xidplu, $xidjenistransaksi, $xidstatusplu, $xidgrouppengguna, $xidpegawai, $xidunitkerja, $xidstatusdinas, $xjumlahsatuan, $xnominalpersatuan, $xtotal, $xiduser, $xnominaldenda, $xiddendasparta, $xidlokasi) {
        $xStr = " UPDATE transaksi SET " .
                "idx='" . $xidx . "'," .
                "idplu='" . $xidplu . "'," .
                "idjenistransaksi='" . $xidjenistransaksi . "'," .
                "idstatusplu='" . $xidpegawai . "'," .
                "idgrouppengguna='" . $xidgrouppengguna . "'," .
                "idpegawai='" . $xidpegawai . "'," .
                "idunitkerja='" . $xidunitkerja . "'," .
                "idstatusdinas='" . $xidstatusdinas . "'," .
                "tanggal=current_date," .
                "jam=current_time," .
                "jumlahsatuan='" . $xjumlahsatuan . "'," .
                "nominalpersatuan='" . $xnominalpersatuan . "'," .
                "total='" . $xtotal . "'," .
                "iduser='" . $xiduser . "'," .
                "nominaldenda='" . $xnominaldenda . "'," .
                "iddendasparta='" . $xiddendasparta . "'," .
                "idlokasi='" . $xidlokasi . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

//**


    function getArrayListtransaksi() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "idplu," .
                "idjenistransaksi,idgrouppengguna," .
                "idpegawai," .
                "idunitkerja," .
                "idstatusdinas," .
                "tanggal," .
                "jam," .
                "jumlahsatuan," .
                "nominalpersatuan," .
                "total," .
                "iduser," .
                "nominaldenda," .
                "iddendasparta," .
                "idlokasi" .
                " FROM transaksi   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->idplu;
        }
        return $xBuffResul;
    }

    function getListtransaksi($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where idplu like '%" . $xSearch . "%' and idjenistransaksi='3'";
        } else {
            $xSearch = "Where idjenistransaksi='3'";
        }
        $xStr = "SELECT " .
                "idx," .
                "idplu," .
                "idjenistransaksi,idgrouppengguna," .
                "idpegawai," .
                "idunitkerja," .
                "idstatusdinas," .
                "tanggal," .
                "jam," .
                "jumlahsatuan," .
                "nominalpersatuan," .
                "total," .
                "iduser," .
                "nominaldenda," .
                "iddendasparta," .
                "idlokasi " .
                " FROM transaksi $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailtransaksi($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "idplu," .
                "idjenistransaksi,idgrouppengguna," .
                "idpegawai," .
                "idunitkerja," .
                "idstatusdinas," .
                "tanggal," .
                "jam," .
                "jumlahsatuan," .
                "nominalpersatuan," .
                "total," .
                "iduser," .
                "nominaldenda," .
                "iddendasparta," .
                "idlokasi" .
                " FROM transaksi  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndextransaksi() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "idplu," .
                "idjenistransaksi,idgrouppengguna," .
                "idpegawai," .
                "idunitkerja," .
                "idstatusdinas," .
                "tanggal," .
                "jam," .
                "jumlahsatuan," .
                "nominalpersatuan," .
                "total," .
                "iduser," .
                "nominaldenda," .
                "iddendasparta," .
                "idlokasi" .
                " FROM transaksi order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInserttransaksi($xidx, $xidplu, $xidjenistransaksi, $xidpegawai, $xidunitkerja, $xidstatusdinas, $xtanggal, $xjam, $xjumlahsatuan, $xnominalpersatuan, $xtotal, $xiduser, $xnominaldenda, $xiddendasparta, $xidlokasi) {
        $xStr = " INSERT INTO transaksi( " .
                "idx," .
                "idplu," .
                "idjenistransaksi,idgrouppengguna," .
                "idpegawai," .
                "idunitkerja," .
                "idstatusdinas," .
                "tanggal," .
                "jam," .
                "jumlahsatuan," .
                "nominalpersatuan," .
                "total," .
                "iduser," .
                "nominaldenda," .
                "iddendasparta," .
                "idlokasi) VALUES('" . $xidx . "','" . $xidplu . "','" . $xidjenistransaksi . "','" . $xidpegawai . "','" . $xidunitkerja . "','" . $xidstatusdinas . "','" . $xtanggal . "','" . $xjam . "','" . $xjumlahsatuan . "','" . $xnominalpersatuan . "','" . $xtotal . "','" . $xiduser . "','" . $xnominaldenda . "','" . $xiddendasparta . "','" . $xidlokasi . "')";

        //echo $xStr;
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatetransaksi($xidx, $xidplu, $xidjenistransaksi, $xidpegawai, $xidunitkerja, $xidstatusdinas, $xtanggal, $xjam, $xjumlahsatuan, $xnominalpersatuan, $xtotal, $xiduser, $xnominaldenda, $xiddendasparta, $xidlokasi) {
        $xStr = " UPDATE transaksi SET " .
                "idx='" . $xidx . "'," .
                "idplu='" . $xidplu . "'," .
                "idjenistransaksi='" . $xidjenistransaksi . "'," .
                "idpegawai='" . $xidpegawai . "'," .
                "idunitkerja='" . $xidunitkerja . "'," .
                "idstatusdinas='" . $xidstatusdinas . "'," .
                "tanggal='" . $xtanggal . "'," .
                "jam='" . $xjam . "'," .
                "jumlahsatuan='" . $xjumlahsatuan . "'," .
                "nominalpersatuan='" . $xnominalpersatuan . "'," .
                "total='" . $xtotal . "'," .
                "iduser='" . $xiduser . "'," .
                "nominaldenda='" . $xnominaldenda . "'," .
                "iddendasparta='" . $xiddendasparta . "'," .
                "idlokasi='" . $xidlokasi . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletetransaksi($xidx) {
        $xStr = " DELETE FROM transaksi WHERE transaksi.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>