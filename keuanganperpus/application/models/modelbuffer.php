<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : buffer  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelbuffer extends CI_Model {
    function __construct() {
        parent::__construct();
    }

   function getTotalFromBuffer($xidnota){
      $xStr  = "SELECT SUM(total) as total  FROM buffer  WHERE  idnota ='".$xidnota."'";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row->total;
   }

   function isidpluinbuffer($xidnota,$xidplu) {
        $xStr = "SELECT " .
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
                "idlokasi," .
                "prosenpotong," .
                "isclear,idnota" .
                " FROM buffer  WHERE idplu = '" . $xidplu . "' and idnota ='".$xidnota."'";
        
             $query = $this->db->query($xStr);
             $rows =$query->row();

        return !empty ($rows->idx);
        //return $xStr ;
    }

    function getArrayListbuffer() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
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
                "idlokasi," .
                "prosenpotong," .
                "isclear,idnota" .
                " FROM buffer   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->idplu;
        }
        return $xBuffResul;
    }

    function getListbuffer($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where idplu like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
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
                "idlokasi," .
                "prosenpotong," .
                "isclear,idnota" .
                " FROM buffer WHERE idnota = '".$this->session->userdata('nonota')."' order by idx DESC ";
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailbuffer($xidx) {
        $xStr = "SELECT " .
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
                "idlokasi," .
                "prosenpotong," .
                "isclear,idnota" .
                " FROM buffer  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function GetIdpegawaiByNoNota($xidNota) {
        $xStr = "SELECT " .
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
                "idlokasi," .
                "prosenpotong," .
                "isclear,idnota" .
                " FROM buffer  WHERE idnota = '" . $xidNota . "' and idpegawai IS NOT NULL";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexbuffer() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
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
                "idlokasi," .
                "prosenpotong," .
                "isclear,idnota" .
                " FROM buffer order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertbuffer($xidx, $xidplu, $xidjenistransaksi, $xidstatusplu, $xidgrouppengguna,
                             $xidpegawai, $xidunitkerja, $xidstatusdinas,  $xjumlahsatuan,
                             $xnominalpersatuan, $xtotal, $xiduser, $xidlokasi, $xprosenpotong, $xisclear,$xidnota) {
        $xStr = " INSERT INTO buffer( " .
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
                "idlokasi," .
                "prosenpotong," .
                "isclear,idnota) VALUES('" . $xidx . "','" . $xidplu . "','" . $xidjenistransaksi .
                                    "','" . $xidstatusplu . "','" . $xidgrouppengguna . "','" . $xidpegawai . "','" .
                                    $xidunitkerja . "','" . $xidstatusdinas . "',current_date,current_time,'" . $xjumlahsatuan . "','" .
                                    $xnominalpersatuan . "','" . $xtotal . "','" . $xiduser . "','" .
                                    $xidlokasi . "','" . $xprosenpotong . "','" . $xisclear . "','".$xidnota."')";
        $query = $this->db->query($xStr);
        return $xStr;
    }

    Function setUpdatebuffer($xidx, $xidplu, $xidjenistransaksi, $xidstatusplu, $xidgrouppengguna, $xidpegawai, $xidunitkerja, $xidstatusdinas,
                              $xjumlahsatuan, $xnominalpersatuan, $xtotal, $xiduser, $xidlokasi, $xprosenpotong, $xisclear,$xidnota) {
        $xStr = " UPDATE buffer SET " .
                "idx='" . $xidx . "'," .
                "idplu='" . $xidplu . "'," .
                "idjenistransaksi='" . $xidjenistransaksi . "'," .
                "idstatusplu='" . $xidstatusplu . "'," .
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
                "idlokasi='" . $xidlokasi . "'," .
                "prosenpotong='" . $xprosenpotong . "'," .
                "isclear='" . $xisclear .",".
                "idnota='".$xidnota."'".
                "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xStr;
    }

    function setDeletebuffer($xidx) {
        $xStr = " DELETE FROM buffer WHERE buffer.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>