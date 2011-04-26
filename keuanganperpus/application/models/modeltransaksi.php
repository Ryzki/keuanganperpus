<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : transaksi  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modeltransaksi extends CI_Model {

    function __construct() {
        parent::__construct();
    }

 //***************Update 26 April 2011 *************
  function getSQLDasarRekap($xBulan,$tahun) {
     return "  Select trx.idx, trx.idplu,tanggal,day(tanggal) hari,jumlahsatuan,nominalpersatuan,
                (select JenisPengguna from jenipengguna as jnsp Where jnsp.idx=plu.idjnspengguna limit 1) as pengg,plu.idjnspengguna,
                (Select jenistransaksi from jenistransaksi  where  jenistransaksi.idx = trx.idjenistransaksi) jnstrx,
                (Select Status from statusplu  where  statusplu.idx = plu.idstatusPLU) statusPLU,plu.idstatusPLU ,
                idpegawai,idunitkerja,trx.idjenistransaksi,idlokasi
                from transaksi as trx
                left join produkplu as plu on(trx.idplu=plu.KodePLU) where month(tanggal)='".$xBulan."' and year(tanggal)='".$tahun.
                "'  order by tanggal ASC, trx.idjenistransaksi DESC ";
    
    }

   function getRekapAll($xBulan,$tahun){
      $query = $this->db->query(' Select *, sum(jumlahsatuan*nominalpersatuan) jumlah from ('.$this->getSQLDasarRekap($xBulan, $tahun).') as tb1 group by tanggal,idjenistransaksi,idstatusPLU ');
      return  $query;
   }

   function getRekapTransaksiStatus($xBulan,$tahun,$jnstransaksi,$statusplu=''){
      $xWhere  = "WHERE idjenistransaksi = '".$jnstransaksi."'";
      if(!empty ($statusplu)){
          $xWhere  .=" And  idstatusPLU = '".$statusplu."'";
      }

      $query = $this->db->query(' Select *, sum(jumlahsatuan*nominalpersatuan) jumlah from ('.$this->getSQLDasarRekap($xBulan, $tahun).') as tb1 '.$xWhere.' group by tanggal,idjenistransaksi,idstatusPLU ');
      return  $query;
   }

   function getlistcombounitkerjaofthemonth($xBulan,$tahun,$idlokasi){
      $query = $this->db->query(' Select *, sum(jumlahsatuan*nominalpersatuan) jumlah from ('.$this->getSQLDasarRekap($xBulan, $tahun).') Where idlokasi ="'.$idlokasi.'" and idjnspengguna = "2" as tb1 group by tanggal,idjenistransaksi,idstatusPLU ');
     return  $query;
   }
//****************update 28 maret 2011**********
    function getSQLDasar($xBulan,$tahun) {
        return "(Select trx.idx, trx.idplu,plu.idjnspengguna,tanggal,day(tanggal) hari,jumlahsatuan,nominalpersatuan,plu.idstatusPLU ,
                (select JenisPengguna from jenipengguna as jnsp Where jnsp.idx=plu.idjnspengguna limit 1) as pengg
                from transaksi as trx
                inner join produkplu as plu on(trx.idplu=plu.KodePLU) where month(tanggal)='" . $xBulan . "' and year(tanggal)='".$tahun."' and  idlokasi = '".$this->session->userdata('idlokasi')."' order by plu.idjnspengguna) as tb1";
    }

    function getlembarsum($xidplu, $xtanggal, $xBulan,$tahun) {
        $xStr = 'Select sum(jumlahsatuan) as jmllembar from ' . $this->getSQLDasar($xBulan,$tahun) . ' where day(tanggal) = "' . $xtanggal . '"  and  idplu= "' . $xidplu . '" ';
        $query = $this->db->query($xStr);
        //echo $xStr."\n";
        $row = $query->row();
        return $row->jmllembar;
    }

    function getarraystatusplu($xBulan,$xIdSTatus,$tahun) {
        $xStr = 'Select distinct(idplu) as idplu from ' . $this->getSQLDasar($xBulan,$tahun) . '  where idstatusPLU  = "'.$xIdSTatus.'" order by idplu ASC';
        $query = $this->db->query($xStr);
        $i = 0;
        $xBuffResul =null;
        foreach ($query->result() as $row) {
            $xBuffResul[$i] = $row->idplu;
            $i++;
        }
        return $xBuffResul;
    }

    function getarrayhari($xBulan,$tahun) {
        $xBuffResul[0] = 'Tgl';
        $xStr = 'Select distinct(hari) as arrayhari from ' . $this->getSQLDasar($xBulan,$tahun) . ' order by arrayhari ASC';
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
                "idjenistransaksi," .
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