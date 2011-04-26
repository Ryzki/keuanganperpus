<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : setoran  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelsetoran extends CI_Model {

    function __construct() {
        parent::__construct();
    }

 //***************Update 26 April 2011 *************
    function getSumSetoranBulan($xbulan,$xtahun,$idstatusplu=''){
       $xWhere =" WHERE month(tanggal)= '".$xbulan."' and year(tanggal) = '".$xtahun."' ";
       if(!empty ($idstatusplu))
        $xWhere .=" and  idstatusplu = '".$idstatusplu."'";

        $xStr = "SELECT " .
                "idx," .
                "tanggal," .
                "idrekanan, (Select NamaRekanan from rekanan where  rekanan.idx  = setoran.idrekanan) as NamaRekanan," .
                "Sum(nominal) jumlah,idstatusplu " .
                " FROM setoran ".$xWhere."  group by idrekanan order by idx ASC ";
         $query = $this->db->query($xStr);
         return $query;
    }


  //***************End Off upadte *************
    function getArrayListsetoran() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "NoBuktiSetoran," .
                "tanggal," .
                "idrekanan," .
                "nominal," .
                "idstatusplu," .
                "iduser," .
                "idlokasi" .
                " FROM setoran   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->NoBuktiSetoran;
        }
        return $xBuffResul;
    }

    function getListsetoran($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where NoBuktiSetoran like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "NoBuktiSetoran," .
                "tanggal," .
                "idrekanan," .
                "nominal," .
                "idstatusplu," .
                "iduser," .
                "idlokasi" .
                " FROM setoran $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailsetoran($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "NoBuktiSetoran," .
                "tanggal," .
                "idrekanan," .
                "nominal," .
                "idstatusplu," .
                "iduser," .
                "idlokasi" .
                " FROM setoran  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexsetoran() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "NoBuktiSetoran," .
                "tanggal," .
                "idrekanan," .
                "nominal," .
                "idstatusplu," .
                "iduser," .
                "idlokasi" .
                " FROM setoran order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertsetoran($xidx, $xNoBuktiSetoran, $xtanggal, $xidrekanan, $xnominal, $xidstatusplu, $xiduser, $xidlokasi) {
        $xStr = " INSERT INTO setoran( " .
                "idx," .
                "NoBuktiSetoran," .
                "tanggal," .
                "idrekanan," .
                "nominal," .
                "idstatusplu," .
                "iduser," .
                "idlokasi) VALUES('" . $xidx . "','" . $xNoBuktiSetoran . "','" . $xtanggal . "','" . $xidrekanan . "','" . $xnominal . "','" . $xidstatusplu . "','" . $xiduser . "','" . $xidlokasi . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatesetoran($xidx, $xNoBuktiSetoran, $xtanggal, $xidrekanan, $xnominal, $xidstatusplu, $xiduser, $xidlokasi) {
        $xStr = " UPDATE setoran SET " .
                "idx='" . $xidx . "'," .
                "NoBuktiSetoran='" . $xNoBuktiSetoran . "'," .
                "tanggal='" . $xtanggal . "'," .
                "idrekanan='" . $xidrekanan . "'," .
                "nominal='" . $xnominal . "'," .
                "idstatusplu='" . $xidstatusplu . "'," .
                "iduser='" . $xiduser . "'," .
                "idlokasi='" . $xidlokasi . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletesetoran($xidx) {
        $xStr = " DELETE FROM setoran WHERE setoran.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>