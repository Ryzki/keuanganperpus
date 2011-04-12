<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : rekanan  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrrekanan extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform">' . form_open_multipart('ctrrekanan/inserttable', array('id' => 'form', 'name' => 'form')).'<div class="garis"></div>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxrekanan.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormrekanan($xidx), $this->getlistrekanan($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormrekanan($xidx) {
        $this->load->helper('form');
        $this->load->model('modelrekanan');
        $row = $this->modelrekanan->getDetailrekanan($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xNamaRekanan = '';
            $xalamat = '';
            $xNoTelephon = '';
            $xNamaPenanggungJawab = '';
            $xNoTelpPenanggungJawab = '';
        } else {
            $xidx = $row->idx;
            $xNamaRekanan = $row->NamaRekanan;
            $xalamat = $row->alamat;
            $xNoTelephon = $row->NoTelephon;
            $xNamaPenanggungJawab = $row->NamaPenanggungJawab;
            $xNoTelpPenanggungJawab = $row->NoTelpPenanggungJawab;
        }
        $this->load->helper('common');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />' .
        $xBufResult .= setForm('edNamaRekanan', 'Nama Rekanan', form_input(getArrayObj('edNamaRekanan', $xNamaRekanan, '200'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edalamat', 'Alamat', form_input(getArrayObj('edalamat', $xalamat, '300'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNoTelephon', 'No Telepon', form_input(getArrayObj('edNoTelephon', $xNoTelephon, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNamaPenanggungJawab', 'Nama Penanggung Jawab', form_input(getArrayObj('edNamaPenanggungJawab', $xNamaPenanggungJawab, '200'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNoTelpPenanggungJawab', 'NoTelp Penanggung Jawab', form_input(getArrayObj('edNoTelpPenanggungJawab', $xNoTelpPenanggungJawab, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function inserttable() {
        $xidx = $_POST['edidx'];
        $xNamaRekanan = $_POST['edNamaRekanan'];
        $xalamat = $_POST['edalamat'];
        $xNoTelephon = $_POST['edNoTelephon'];
        $xNamaPenanggungJawab = $_POST['edNamaPenanggungJawab'];
        $xNoTelpPenanggungJawab = $_POST['edNoTelpPenanggungJawab'];

        $this->load->model('modelrekanan');
        if ($xidx != '0') {
            $this->modelrekanan->setUpdaterekanan($xidx, $xNamaRekanan, $xalamat, $xNoTelephon, $xNamaPenanggungJawab, $xNoTelpPenanggungJawab);
        } else {
            $this->modelrekanan->setInsertrekanan($xidx, $xNamaRekanan, $xalamat, $xNoTelephon, $xNamaPenanggungJawab, $xNoTelpPenanggungJawab);
        }
        $this->createform('0');
    }

    function getlistrekanan($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                        addCell('NamaRekanan', 'width:100px;', true) .
                        addCell('alamat', 'width:100px;', true) .
                        addCell('NoTelephon', 'width:100px;', true) .
                        addCell('Pen.Jawab', 'width:100px;', true) .
                       // addCell('NoTelp', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modelrekanan');
        $xQuery = $this->modelrekanan->getListrekanan($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->NamaRekanan, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
                            addCell($row->NamaRekanan, 'width:100px;') .
                            addCell($row->alamat, 'width:100px;') .
                            addCell($row->NoTelephon, 'width:100px;') .
                            addCell($row->NamaPenanggungJawab, 'width:100px;') .
                          //  addCell($row->NoTelpPenanggungJawab, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:40px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:660px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modelrekanan');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modelrekanan->setDeleterekanan($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelrekanan');
        $row = $this->modelrekanan->getDetailrekanan($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['NamaRekanan'] = $row->NamaRekanan;
        $this->json_data['alamat'] = $row->alamat;
        $this->json_data['NoTelephon'] = $row->NoTelephon;
        $this->json_data['NamaPenanggungJawab'] = $row->NamaPenanggungJawab;
        $this->json_data['NoTelpPenanggungJawab'] = $row->NoTelpPenanggungJawab;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelrekanan');
        $this->modelrekanan->setDeleterekanan($edidx);
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
        $this->json_data['tabledata'] = $this->getlistrekanan($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xNamaRekanan = $_POST['edNamaRekanan'];
        $xalamat = $_POST['edalamat'];
        $xNoTelephon = $_POST['edNoTelephon'];
        $xNamaPenanggungJawab = $_POST['edNamaPenanggungJawab'];
        $xNoTelpPenanggungJawab = $_POST['edNoTelpPenanggungJawab'];
        $this->load->model('modelrekanan');
        if ($xidx != '0') {
            $xStr = $this->modelrekanan->setUpdaterekanan($xidx, $xNamaRekanan, $xalamat, $xNoTelephon, $xNamaPenanggungJawab, $xNoTelpPenanggungJawab);
        } else {
            $xStr = $this->modelrekanan->setInsertrekanan($xidx, $xNamaRekanan, $xalamat, $xNoTelephon, $xNamaPenanggungJawab, $xNoTelpPenanggungJawab);
        }
    }

}

?>