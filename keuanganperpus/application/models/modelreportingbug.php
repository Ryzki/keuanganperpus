<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : reportingbug  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelreportingbug extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListreportingbug() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "lokasi," .
                "keterangan," .
                "tanggapan," .
                "iduser," .
                "tanggal," .
                "jam," .
                "tanggaltanggapan," .
                "jamtanggapan" .
                " FROM reportingbug   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->lokasi;
        }
        return $xBuffResul;
    }

    function getListreportingbug($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where lokasi like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "lokasi," .
                "keterangan," .
                "tanggapan," .
                "iduser," .
                "tanggal," .
                "jam," .
                "tanggaltanggapan," .
                "jamtanggapan" .
                " FROM reportingbug $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailreportingbug($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "lokasi," .
                "keterangan," .
                "tanggapan," .
                "iduser," .
                "tanggal," .
                "jam," .
                "tanggaltanggapan," .
                "jamtanggapan" .
                " FROM reportingbug  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexreportingbug() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "lokasi," .
                "keterangan," .
                "tanggapan," .
                "iduser," .
                "tanggal," .
                "jam," .
                "tanggaltanggapan," .
                "jamtanggapan" .
                " FROM reportingbug order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertreportingbug($xidx, $xlokasi, $xketerangan, $xtanggapan, $xiduser, $xtanggal, $xjam, $xtanggaltanggapan, $xjamtanggapan) {
        $xStr = " INSERT INTO reportingbug( " .
                "idx," .
                "lokasi," .
                "keterangan," .
                "tanggapan," .
                "iduser," .
                "tanggal," .
                "jam," .
                "tanggaltanggapan," .
                "jamtanggapan) VALUES('" . $xidx . "','" . $xlokasi . "','" . $xketerangan . "','" . $xtanggapan . "','" . $xiduser . "','" . $xtanggal . "','" . $xjam . "','" . $xtanggaltanggapan . "','" . $xjamtanggapan . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setInsertreportingbugsmall($xlokasi, $xketerangan) {

        $xiduser = $this->session->userdata('idpegawai');
        if (empty($xiduser)) {
            $xiduser = 0;
        }

        $xStr = " INSERT INTO reportingbug( " .
                "lokasi," .
                "keterangan," .
                "iduser," .
                "tanggal," .
                "jam
              ) VALUES('" . $xlokasi . "','" . $xketerangan . "','" . $xiduser . "',current_date,current_time)";
        $query = $this->db->query($xStr);
        return $xStr;
    }

    Function setUpdatereportingbug($xidx, $xlokasi, $xketerangan, $xtanggapan, $xiduser, $xtanggal, $xjam, $xtanggaltanggapan, $xjamtanggapan) {
        $xStr = " UPDATE reportingbug SET " .
                "idx='" . $xidx . "'," .
                "lokasi='" . $xlokasi . "'," .
                "keterangan='" . $xketerangan . "'," .
                "tanggapan='" . $xtanggapan . "'," .
                "iduser='" . $xiduser . "'," .
                "tanggal='" . $xtanggal . "'," .
                "jam='" . $xjam . "'," .
                "tanggaltanggapan='" . $xtanggaltanggapan . "'," .
                "jamtanggapan='" . $xjamtanggapan . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletereportingbug($xidx) {
        $xStr = " DELETE FROM reportingbug WHERE reportingbug.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>