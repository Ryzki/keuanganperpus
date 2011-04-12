<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : jenistransaksi  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrjenistransaksi extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Isi/Edit Jenis Transaksi</h3>' . form_open_multipart('ctrjenistransaksi/inserttable', array('id' => 'form', 'name' => 'form')).'<div class="garis"></div>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxjenistransaksi.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormjenistransaksi($xidx), $this->getlistjenistransaksi($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormjenistransaksi($xidx) {
        $this->load->helper('form');
        $this->load->model('modeljenistransaksi');
        $row = $this->modeljenistransaksi->getDetailjenistransaksi($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xjenistransaksi = '';
            $xisedittable = '';
        } else {
            $xidx = $row->idx;
            $xjenistransaksi = $row->jenistransaksi;
            $xisedittable = $row->isedittable;
        }
        $this->load->helper('common');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />' .
        $xBufResult .= setForm('edjenistransaksi', 'jenistransaksi', form_input(getArrayObj('edjenistransaksi', $xjenistransaksi, '150'))) . '<div class="spacer"></div>';
        //$xBufResult .= setForm('edisedittable', 'isedittable', form_input(getArrayObj('edisedittable', $xisedittable, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function inserttable() {
        $xidx = $_POST['edidx'];
        $xjenistransaksi = $_POST['edjenistransaksi'];
        $xisedittable = $_POST['edisedittable'];

        $this->load->model('modeljenistransaksi');
        if ($xidx != '0') {
            $this->modeljenistransaksi->setUpdatejenistransaksi($xidx, $xjenistransaksi, $xisedittable);
        } else {
            $this->modeljenistransaksi->setInsertjenistransaksi($xidx, $xjenistransaksi, $xisedittable);
        }
        $this->createform('0');
    }

    function getlistjenistransaksi($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                        addCell('jenistransaksi', 'width:100px;', true) .
                        addCell('isedittable', 'width:100px;', true).
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modeljenistransaksi');
        $xQuery = $this->modeljenistransaksi->getListjenistransaksi($xAwal, $xLimit, $xSearch);

        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->jenistransaksi, 0, 20) . '\');" style="border:none;">';
            $xbufisi= addCell($row->idx, 'width:100px;') .
                            addCell($row->jenistransaksi, 'width:100px;').
                            addCell($row->isedittable, 'width:100px;');
            $xbufedit='';
            if($row->isedittable=="Y"){
               $xbufedit = addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;');
            }else{
              $xbufedit = addCell('Read Only', 'width:100px;');
            }
                $xbufResult .=    addRow($xbufisi.$xbufedit);   
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:150px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:60px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:500px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modeljenistransaksi');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modeljenistransaksi->setDeletejenistransaksi($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modeljenistransaksi');
        $row = $this->modeljenistransaksi->getDetailjenistransaksi($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['jenistransaksi'] = $row->jenistransaksi;
        $this->json_data['isedittable'] = $row->isedittable;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modeljenistransaksi');
        $this->modeljenistransaksi->setDeletejenistransaksi($edidx);
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
        $this->json_data['tabledata'] = $this->getlistjenistransaksi($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xjenistransaksi = $_POST['edjenistransaksi'];
        $xisedittable = $_POST['edisedittable'];
        $this->load->model('modeljenistransaksi');
        if ($xidx != '0') {
            $xStr = $this->modeljenistransaksi->setUpdatejenistransaksi($xidx, $xjenistransaksi, $xisedittable);
        } else {
            $xStr = $this->modeljenistransaksi->setInsertjenistransaksi($xidx, $xjenistransaksi, $xisedittable);
        }
    }

}

?>