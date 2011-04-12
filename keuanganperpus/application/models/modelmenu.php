<?php

class modelmenu extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListmenu() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idmenu," .
                "nmmenu," .
                "tipemenu," .
                "idkomponen," .
                "iduser," .
                "parentmenu," .
                "urlci" .
                " FROM menu  order by idmenu ASC";
        $query = $this->db->query($xStr);
        $xBuffResul['0'] = '-';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idmenu] = $row->nmmenu;
        }
        return $xBuffResul;
    }

    function getListmenu($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where nmmenu like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idmenu," .
                "nmmenu," .
                "tipemenu," .
                "idkomponen," .
                "iduser," .
                "parentmenu," .
                "urlci" .
                " FROM menu $xSearch order by idmenu DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getListMenubyKomponen($xIdKomponen) {
        /* if(!empty($xSearch)){
          $xSearch = "Where isi like '%".$xSearch."%'" ;
          } */
        if (empty($xAwal))
            $xAwal = '0';

        $xStr = $xStr = "SELECT " .
                "idmenu," .
                "nmmenu," .
                "tipemenu," .
                "idkomponen," .
                "iduser," .
                "parentmenu," .
                "urlci" .
                " FROM menu WHERE idkomponen ='" . $xIdKomponen . "' Order by idmenu ASC ";

        $query = $this->db->query($xStr);
        return $query;
    }

    function getDeatilmenu($xidmenu) {
        $xStr = "SELECT " .
                "idmenu," .
                "nmmenu," .
                "tipemenu," .
                "idkomponen," .
                "iduser," .
                "parentmenu," .
                "urlci" .
                " FROM menu  WHERE idmenu = '" . $xidmenu . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexmenu() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idmenu," .
                "nmmenu," .
                "tipemenu," .
                "idkomponen," .
                "iduser," .
                "parentmenu," .
                "urlci" .
                " FROM menu order by idmenu DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertmenu($xidmenu, $xnmmenu, $xtipemenu, $xidkomponen, $xiduser, $xparentmenu, $xurlci) {
        $xStr = " INSERT INTO menu( " .
                "idmenu," .
                "nmmenu," .
                "tipemenu," .
                "idkomponen," .
                "iduser," .
                "parentmenu," .
                "urlci) VALUES('" . $xidmenu . "','" . $xnmmenu . "','" . $xtipemenu . "','" . $xidkomponen . "','" . $xiduser . "','" . $xparentmenu . "','" . $xurlci . "')";
        $query = $this->db->query($xStr);
        return $xidmenu;
    }

    Function setUpdatemenu($xidmenu, $xnmmenu, $xtipemenu, $xidkomponen, $xiduser, $xparentmenu, $xurlci) {
        $xStr = " UPDATE menu SET " .
                "idmenu='" . $xidmenu . "'," .
                "nmmenu='" . $xnmmenu . "'," .
                "tipemenu='" . $xtipemenu . "'," .
                "idkomponen='" . $xidkomponen . "'," .
                "iduser='" . $xiduser . "'," .
                "parentmenu='" . $xparentmenu . "'," .
                "urlci='" . $xurlci . "' WHERE idmenu = '" . $xidmenu . "'";
        $query = $this->db->query($xStr);
        return $xidmenu;
    }

    function setDeletemenu($xidmenu) {
        $xStr = " DELETE FROM menu WHERE menu.idmenu = '" . $xidmenu . "'";

        $query = $this->db->query($xStr);
    }

}

?>