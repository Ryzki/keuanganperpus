<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : jenisanggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrjenisanggotabaca extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Isi Edit Jenis Anggota Baca<h3>' . form_open_multipart('ctrjenisanggotabaca/inserttable', array('id' => 'form', 'name' => 'form')) . '<div class="garis"></div>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxjenisanggotabaca.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormjenisanggotabaca($xidx), $this->getlistjenisanggotabaca($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormjenisanggotabaca($xidx) {
        $this->load->helper('form');
        $this->load->model('modeljenisanggotabaca');
        $row = $this->modeljenisanggotabaca->getDetailjenisanggotabaca($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xjenisanggotabaca = '';
        } else {
            $xidx = $row->idx;
            $xjenisanggotabaca = $row->jenisanggotabaca;
        }
        $this->load->helper('common');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />' .
                $xBufResult .= setForm('edjenisanggotabaca', 'Jenis Anggota Baca', form_input(getArrayObj('edjenisanggotabaca', $xjenisanggotabaca, '200'))) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function inserttable() {
        $xidx = $_POST['edidx'];
        $xjenisanggotabaca = $_POST['edjenisanggotabaca'];

        $this->load->model('modeljenisanggotabaca');
        if ($xidx != '0') {
            $this->modeljenisanggotabaca->setUpdatejenisanggotabaca($xidx, $xjenisanggotabaca);
        } else {
            $this->modeljenisanggotabaca->setInsertjenisanggotabaca($xidx, $xjenisanggotabaca);
        }
        $this->createform('0');
    }

    function getlistjenisanggotabaca($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                        addCell('jenisanggotabaca', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modeljenisanggotabaca');
        $xQuery = $this->modeljenisanggotabaca->getListjenisanggotabaca($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->jenisanggotabaca, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
                            addCell($row->jenisanggotabaca, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:60px;', true) .
                addCell($xInput, 'width:100px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:40px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:350px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modeljenisanggotabaca');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modeljenisanggotabaca->setDeletejenisanggotabaca($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modeljenisanggotabaca');
        $row = $this->modeljenisanggotabaca->getDetailjenisanggotabaca($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['jenisanggotabaca'] = $row->jenisanggotabaca;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modeljenisanggotabaca');
        $this->modeljenisanggotabaca->setDeletejenisanggotabaca($edidx);
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
        $this->json_data['tabledata'] = $this->getlistjenisanggotabaca($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xjenisanggotabaca = $_POST['edjenisanggotabaca'];
        $this->load->model('modeljenisanggotabaca');
        if ($xidx != '0') {
            $xStr = $this->modeljenisanggotabaca->setUpdatejenisanggotabaca($xidx, $xjenisanggotabaca);
        } else {
            $xStr = $this->modeljenisanggotabaca->setInsertjenisanggotabaca($xidx, $xjenisanggotabaca);
        }
    }

}

?>