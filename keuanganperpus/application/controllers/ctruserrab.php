<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : userrab  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctruserrab extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($xAwal=0, $xSearch='') {
//  $this->load->view('test.php');
        if ($xAwal <= -1) {
            $xAwal = 0;
        } $this->session->set_userdata('awal', $xAwal);
        $this->createform('0', $xAwal);
    }

    function createform($xidx, $xAwal=0, $xSearch='') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->model('modelgetmenu');
        $xForm = '<div id="stylized" class="myform"><h3>Setting Priviledges User R A B</h3>' . form_open_multipart('ctruserrab/inserttable', array('id' => 'form', 'name' => 'form')).'<div class="garis"></div>';
        $xAddJs = link_tag('resource/css/jquery-ui-lightness.css') .
                link_tag('resource/css/jquery.checkboxtree.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuserrab.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery-ui-1.8.9.custom.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.core.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.checkboxtree.js"></script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormuserrab($xidx), '', '', $xAddJs, '');
    }

    function setDetailFormuserrab($xidx) {
        $this->load->helper('form');
        $this->load->model('modeluserrab');
        $this->load->model('modelpegawai');
        $row = $this->modeluserrab->getDetailuserrab($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xiduser = '';
            $xidrab = '';
        } else {
            $xidx = $row->idx;
            $xiduser = $row->iduser;
            $xidrab = $row->idrab;
        }
        $this->load->helper('common');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />';
        $xBufResult .= setForm('NamaUser', 'Nama User', form_dropdown('ediduser', $this->modelpegawai->getArrayListpegawai(), '0', 'id="ediduser" width="150px" onchange="setcheckrab();"')) . '<div class="spacer"></div>';
        $xBufResult .= '<div id="chkmenu">'.$this->setChecboxRab().'</div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function setChecboxRab() {       
        $this->load->model('modelrab');
        return $this->modelrab->gettreeviewchk();
        //return '<div id="browser"> <div id="lstreeview" name="lstreeview" class="treev">' . $this->modelgetrab->getrabForTree() . '</div></div>';
    }

    function isinrab(){
        $this->load->helper('json');
        $this->load->model('modeluserrab');
        $iduser = $_POST['xiduser'];
        $idrab = $_POST['xidrab'];

        $xrow = $this->modeluserrab->getDetailuserrabbyuserpass($idrab,$iduser);
        if(!empty ($xrow->iduser)){
        $this->json_data['isinrab'] = true;
        $this->json_data['idrab'] = $xrow->idrab;
        } else
        {
            $this->json_data['isinrab'] = false;
        $this->json_data['idrab'] = $idrab;
        }

        echo json_encode($this->json_data);

    }

    function getlistuserrab($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                        addCell('iduser', 'width:100px;', true) .
                        addCell('idrab', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modeluserrab');
        $xQuery = $this->modeluserrab->getListuserrab($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->iduser, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
                            addCell($row->iduser, 'width:100px;') .
                            addCell($row->idrab, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:260px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:415px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modeluserrab');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modeluserrab->setDeleteuserrab($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modeluserrab');
        $row = $this->modeluserrab->getDetailuserrab($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['iduser'] = $row->iduser;
        $this->json_data['idrab'] = $row->idrab;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modeluserrab');
        $this->modeluserrab->setDeleteuserrab($edidx);
    }

    function search() {
        $xAwal = $_POST['xAwal'];
        $xSearch = $_POST['xSearch'];
        $this->load->helper('json');
        if (($xAwal + 0) == -99) {
            $xAwal = $this->session->userdata('awal', $xAwal);
        }
        if ($xAwal + 0 <= -1) {
            $xAwal = 0;
            $this->session->set_userdata('awal', $xAwal);
        } else {
            $this->session->set_userdata('awal', $xAwal);
        }
        $this->json_data['tabledata'] = $this->getlistuserrab($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        //$this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $this->load->model('modeluserrab');
        $this->load->model('modelrab');

        $xiduser = $_POST['ediduser'];

        $this->modeluserrab->setDeleteuserbyuser($xiduser);

        $xQuery = $this->modelrab->getListraball();

        foreach ($xQuery->result() as $row) {
            if(isset($_POST['mn'.$row->idx])){
                $xidrab = $_POST['mn'.$row->idx];
                $xStr = $this->modeluserrab->setInsertuserrab($xidx, $xiduser, $xidrab);
            }
        }
//        $xiduser = $_POST['ediduser'];
//        $xidrab = $_POST['edidrab'];
//        $this->load->model('modeluserrab');
//        if ($xidx != '0') {
//            $xStr = $this->modeluserrab->setUpdateuserrab($xidx, $xiduser, $xidrab);
//        } else {
//            $xStr = $this->modeluserrab->setInsertuserrab($xidx, $xiduser, $xidrab);
//        }
    }

}

?>