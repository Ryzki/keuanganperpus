<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : nota  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelnota extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function getNoNota(){
     $xTgl = $this->session->userdata('tanggal');
     $xTahun = substr($xTgl, 0,4);
     $xBulan = substr($xTgl,5,2);

       $xStr = "SELECT " .
                "idnota," .
                "tanggal," .
                "jam," .
                "nominal," .
                "isclear,iduser" .
                " FROM nota Where left(idnota,6) = ".$xTahun.$xBulan." order by idnota DESC limit 1 ";
     $query = $this->db->query($xStr);
     $row = $query->row();
     
     
     //0123456789
     //2011-05-10
     //
     
     $xSeri = '00000';
     //0123456789
     //20110500001
     if(!empty ($row)){
      $xNoNota = $row->idnota;
      $xSeri = substr($xNoNota, 6, 5);
      $xSeri = $xSeri+1;
      $xSeri = str_pad($xSeri, 5, '0', 'left');
     } else {


      $xSeri = $xSeri+1;
      $xSeri = str_pad($xSeri, 5, '0', 'left');
     }
     return $xTahun.$xBulan.$xSeri;
    }

    function getArrayListnota() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idnota," .
                "tanggal," .
                "jam," .
                "nominal," .
                "isclear" .
                " FROM nota   order by idnota ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idnota] = $row->tanggal;
        }
        return $xBuffResul;
    }

    function getListnota($xAwal, $xLimit, $xSearch='') {
        
        $xStr = "SELECT " .
                "idnota," .
                "tanggal," .
                "jam," .
                "nominal," .
                "isclear,dibayar,sisa" .
                " FROM nota Where  isclear = 'Y' order by idnota DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailnota($xidnota) {
        $xStr = "SELECT " .
                "idnota," .
                "tanggal," .
                "jam," .
                "nominal," .
                "isclear" .
                " FROM nota  WHERE idnota = '" . $xidnota . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexnota() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idnota," .
                "tanggal," .
                "jam," .
                "nominal," .
                "isclear" .
                " FROM nota order by idnota DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertnota($xidnota, $xtanggal, $xjam, $xnominal, $xisclear,$xiduser) {
        $xStr = " INSERT INTO nota( " .
                "idnota," .
                "tanggal," .
                "jam," .
                "nominal," .
                "isclear,iduser) VALUES('" . $xidnota . "','" . $xtanggal . "','" . $xjam . "','" . $xnominal . "','" . $xisclear . "','".$xiduser."')";
        $query = $this->db->query($xStr);
        return $xidnota;
    }

    Function setInsertnotaawal($xidnota,$xiduser) {
        $xStr = " INSERT INTO nota( " .
                "idnota," .
                "tanggal," .
                "jam," .
                "nominal," .
                "isclear,iduser) VALUES('" . $xidnota . "',current_date,current_time,0,'N','".$xiduser."')";
        $query = $this->db->query($xStr);
        return $xidnota;
    }
    Function setUpdatenota($xidnota, $xtanggal, $xjam, $xnominal, $xisclear,$xiduser) {
        $xStr = " UPDATE nota SET " .
                "idnota='" . $xidnota . "'," .
                "tanggal='" . $xtanggal . "'," .
                "jam='" . $xjam . "'," .
                "nominal='" . $xnominal . "'," .
                "isclear='" . $xisclear . "', ".
                "iduser='" . $xiduser . "' ".
               " WHERE idnota = '" . $xidnota . "'";
        $query = $this->db->query($xStr);
        return $xidnota;
    }

    function setDeletenota($xidnota) {
        $xStr = " DELETE FROM nota WHERE nota.idnota = '" . $xidnota . "'";

        $query = $this->db->query($xStr);
    }

    function simpannota($xidnota,$xNominal,$xBayar,$xSisa){
         $xStr = " UPDATE nota SET " .
                   "nominal='" . $xNominal . "'," .
                   "dibayar='" . $xBayar . "'," .
                   "sisa='" . $xSisa . "'," .
                   "isclear='Y' ".
                   " WHERE idnota = '" . $xidnota . "'";
        $query = $this->db->query($xStr);
        $xStr = " Delete from transaksi " .
                  " WHERE idnota = '" . $xidnota . "'";
        $query = $this->db->query($xStr);
/// select insert di buffer ke transaksi
       $xStr = "INSERT INTO transaksi(idplu,idjenistransaksi,idstatusplu,idgrouppengguna,
               idpegawai,idunitkerja,idstatusdinas,tanggal,jam,jumlahsatuan,
               nominalpersatuan,total,iduser,idlokasi,prosenpotong,idnota) SELECT idplu,idjenistransaksi,idstatusplu,idgrouppengguna,
               idpegawai,idunitkerja,idstatusdinas,tanggal,jam,jumlahsatuan,
               nominalpersatuan,total,iduser,idlokasi,prosenpotong,idnota from buffer WHERE idnota = '".$xidnota."'";
       //$query = $this->db->query($xStr);



    }

}

?>