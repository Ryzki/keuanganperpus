<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : realisasirab  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelrealisasirab extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    /****************09 mei 2011*************/
    function getSumRealisasirabbyparrentsampaibulan($xParent,$xbulan,$tahun) {
        $this->load->model('modelrab');
        $row = $this->modelrab->getDetailrab($xParent);

        $xStr = "SELECT " .
                " sum(nominal) nominal " .
                " FROM realisasirab
                  inner join rab on (left(rab.kodeRAB,length('".$row->kodeRAB."'))= '".$row->kodeRAB."') and (rab.idx = realisasirab.idrab)
                  WHERE  month(realisasirab.tanggal) <= '" . $xbulan . "' and realisasirab.idthnanggaran = '".$tahun."'";
       $query = $this->db->query($xStr);
       $row = $query->row();
        if(!empty($row->nominal)){
          return $row->nominal;
       } else
       {
        return 0;
       }    
       // return $xStr;
    }

    function getSumRealisasirabbyparrentbulan($xParent,$xbulan,$tahun) {
        $this->load->model('modelrab');
        $row = $this->modelrab->getDetailrab($xParent);

        $xStr = "SELECT " .
                " sum(nominal) nominal " .
                " FROM realisasirab
                  inner join rab on (left(rab.kodeRAB,length('".$row->kodeRAB."'))= '".$row->kodeRAB."') and (rab.idx = realisasirab.idrab)
                  WHERE  month(realisasirab.tanggal) = '" . $xbulan . "' and realisasirab.idthnanggaran = '".$tahun."'";
       $query = $this->db->query($xStr);
       $row = $query->row();
       if(!empty($row->nominal)){
          return $row->nominal;
       } else
       {
        return 0;
       }
       // return $xStr;
    }
   /****** update tanggal 27 April 2011 */

   function getlistrealisasirabreport($xbulan,$tahun,$idrab){
           $xStr = "SELECT " .
                "idx," .
                "tanggal," .
                "jam," .
                "idrab,(Select JudulRAB from rab Where rab.idx = realisasirab.idrab) as JudulRAB," .
                "keterangan," .
                "nominal," .
                "iduser," .
                "idthnanggaran,(Select TahunAnggaran from tahunanggaran where tahunanggaran.idx=realisasirab.idthnanggaran) as TahunAnggaran" .
                " FROM realisasirab  WHERE month(tanggal) = '" . $xbulan . "' and idthnanggaran = '".$tahun."' and idrab = '".$idrab."'";

        $query = $this->db->query($xStr);
        
        return $query;
   }

   function getrealisasibulan($xbulan,$tahun,$idrab){
           $xStr = "SELECT " .
                "idx," .
                "tanggal," .
                "jam," .
                "idrab,(Select JudulRAB from rab Where rab.idx = realisasirab.idrab) as JudulRAB," .
                "keterangan," .
                "sum(nominal) nominal," .
                "iduser," .
                "idthnanggaran,(Select TahunAnggaran from tahunanggaran where tahunanggaran.idx=realisasirab.idthnanggaran) as TahunAnggaran" .
                " FROM realisasirab  WHERE month(tanggal) = '" . $xbulan . "' and idthnanggaran = '".$tahun."' and idrab = '".$idrab."' group by idrab";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
   }

function getrealisasisampaibulan($xbulan,$tahun,$idrab){
           $xStr = "SELECT " .
                "idx," .
                "tanggal," .
                "jam," .
                "idrab,(Select JudulRAB from rab Where rab.idx = realisasirab.idrab) as JudulRAB," .
                "keterangan," .
                "SUM(nominal) as nominal," .
                "iduser," .
                "idthnanggaran,(Select TahunAnggaran from tahunanggaran where tahunanggaran.idx=realisasirab.idthnanggaran) as TahunAnggaran" .
                " FROM realisasirab  WHERE month(tanggal) <= '" . $xbulan . "' and idthnanggaran = '".$tahun."' and idrab = '".$idrab."' group by idrab";

        $query = $this->db->query($xStr);
        

        $row = $query->row();
        return $row;
   }

   /*endd   */

    function getArrayListrealisasirab() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "tanggal," .
                "jam," .
                "idrab,(Select JudulRAB from rab Where rab.idx = realisasirab.idrab) as JudulRAB," .
                "keterangan," .
                "nominal," .
                "iduser," .
                "idthnanggaran,(Select TahunAnggaran from tahunanggaran where tahunanggaran.idx=realisasirab.idthnanggaran) as TahunAnggaran" .
                " FROM realisasirab   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->tanggal;
        }
        return $xBuffResul;
    }

    function getListrealisasirab($xAwal, $xLimit, $xSearch='') {

        //if (!empty($xSearch)) {
            $xSearch = "Where idrab = '" . $xSearch . "'";
       // }

        $xStr = "SELECT " .
                "idx," .
                "tanggal," .
                "jam," .
                "idrab,(Select JudulRAB from rab Where rab.idx = realisasirab.idrab) as JudulRAB," .
                "keterangan," .
                "nominal," .
                "iduser," .
                "idthnanggaran,(Select TahunAnggaran from tahunanggaran where tahunanggaran.idx=realisasirab.idthnanggaran) as TahunAnggaran" .
                " FROM realisasirab ".$xSearch ." order by idx DESC limit " . $xAwal . "," . $xLimit;

        $query = $this->db->query($xStr);
        return $query;
        return $xStr;
    }

    function getDetailrealisasirab($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "tanggal," .
                "jam," .
                "idrab,(Select JudulRAB from rab Where rab.idx = realisasirab.idrab) as JudulRAB," .
                "keterangan," .
                "nominal," .
                "iduser," .
                "idthnanggaran,(Select TahunAnggaran from tahunanggaran where tahunanggaran.idx=realisasirab.idthnanggaran) as TahunAnggaran" .
                " FROM realisasirab  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexrealisasirab() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "tanggal," .
                "jam," .
                "idrab," .
                "keterangan," .
                "nominal," .
                "iduser," .
                "idthnanggaran" .
                " FROM realisasirab order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertrealisasirab($xidx, $xtanggal,  $xidrab, $xketerangan, $xnominal, $xiduser, $xidthnanggaran) {
        $xStr = " INSERT INTO realisasirab( " .
                "idx," .
                "tanggal," .
                "jam," .
                "idrab," .
                "keterangan," .
                "nominal," .
                "iduser," .
                "idthnanggaran) VALUES('" . $xidx . "','" . $xtanggal . "',current_time,'" . $xidrab . "','" . $xketerangan . "','" . $xnominal . "','" . $xiduser . "','" . $xidthnanggaran . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdaterealisasirab($xidx, $xtanggal,  $xidrab, $xketerangan, $xnominal, $xiduser, $xidthnanggaran) {
        $xStr = " UPDATE realisasirab SET " .
                "idx='" . $xidx . "'," .
                "tanggal='" . $xtanggal . "'," .
                "jam=current_time," .
                "idrab='" . $xidrab . "'," .
                "keterangan='" . $xketerangan . "'," .
                "nominal='" . $xnominal . "'," .
                "iduser='" . $xiduser . "'," .
                "idthnanggaran='" . $xidthnanggaran . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeleterealisasirab($xidx) {
        $xStr = " DELETE FROM realisasirab WHERE realisasirab.idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
    }

}

?>