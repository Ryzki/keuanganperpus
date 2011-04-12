<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : usermenu  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelusermenu extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListusermenu() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "iduser," .
                "idmenu" .
                " FROM usermenu   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->iduser;
        }
        return $xBuffResul;
    }

    function getListusermenu($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where iduser like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "iduser," .
                "idmenu" .
                " FROM usermenu $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailusermenu($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "iduser," .
                "idmenu" .
                " FROM usermenu  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }
  function getDetailusermenubyidmnusr($idmenu,$iduser) {
        $xStr = "SELECT " .
                "idx," .
                "iduser," .
                "idmenu" .
                " FROM usermenu  WHERE iduser = '" . $iduser . "' and idmenu = '" . $idmenu . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        //return $xStr;
        return $row;
    }
    function getLastIndexusermenu() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "iduser," .
                "idmenu" .
                " FROM usermenu order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertusermenu($xidx, $xiduser, $xidmenu) {
        $xStr = " INSERT INTO usermenu( " .
                "idx," .
                "iduser," .
                "idmenu) VALUES('" . $xidx . "','" . $xiduser . "','" . $xidmenu . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdateusermenu($xidx, $xiduser, $xidmenu) {
        $xStr = " UPDATE usermenu SET " .
                "idx='" . $xidx . "'," .
                "iduser='" . $xiduser . "'," .
                "idmenu='" . $xidmenu . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeleteusermenu($xidx) {
        $xStr = " DELETE FROM usermenu WHERE usermenu.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

    function setDeleteusermenubyuser($xiduser) {
        $xStr = " DELETE FROM usermenu WHERE usermenu.iduser = '" . $xiduser . "'";
        $query = $this->db->query($xStr);
    }

}

?>