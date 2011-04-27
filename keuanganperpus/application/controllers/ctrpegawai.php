<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : pegawai  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrpegawai extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3> Isi/ Edit Data Pegawai /(Sebagian USD->Hanya untuk yang sering memakai Jasa Perpus)' . form_open_multipart('ctrpegawai/inserttable', array('id' => 'form', 'name' => 'form')).'<div class="garis"></div>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxpegawai.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormpegawai($xidx), $this->getlistpegawai($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormpegawai($xidx) {
        $this->load->helper('form');
        $this->load->model('modelpegawai');
        $this->load->model('modelunitkerja');
        $this->load->model('modellokasi');
        $row = $this->modelpegawai->getDetailpegawai($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xnpp = '';
            $xNama = '';
            $xidUnitKerja = '';
            $xNoTelpon = '';
            $xuser = '';
            $xpassword = '';
            $xidLokasi = '';
        } else {
            $xidx = $row->idx;
            $xnpp = $row->npp;
            $xNama = $row->Nama;
            $xidUnitKerja = $row->idUnitKerja;
            $xNoTelpon = $row->NoTelpon;
            $xuser = $row->user;
            $xpassword = $row->password;
            $xidLokasi = $row->idLokasi;
        }
        $this->load->helper('common');

        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />' .
        $xBufResult .= setForm('ednpp', 'NPP', form_input(getArrayObj('ednpp', $xnpp, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNama', 'Nama Pegawai', form_input(getArrayObj('edNama', $xNama, '200'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidUnitKerja', 'Unit Kerja', form_dropdown('edidUnitKerja', $this->modelunitkerja->getArrayListunitkerja(),'0','id="edidUnitKerja" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNoTelpon', 'No Telpon', form_input(getArrayObj('edNoTelpon', $xNoTelpon, '125'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('eduser', 'User Sistem', form_input(getArrayObj('eduser', $xuser, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edpassword', 'Password', form_password(getArrayObj('edpassword', $xpassword, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidLokasi', 'Lokasi', form_dropdown('edidLokasi', $this->modellokasi->getArrayListlokasi(),'0','id="edidLokasi" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function inserttable() {
        $xidx = $_POST['edidx'];
        $xnpp = $_POST['ednpp'];
        $xNama = $_POST['edNama'];
        $xidUnitKerja = $_POST['edidUnitKerja'];
        $xNoTelpon = $_POST['edNoTelpon'];
        $xuser = $_POST['eduser'];
        $xpassword = $_POST['edpassword'];
        $xidLokasi = $_POST['edidLokasi'];

        $this->load->model('modelpegawai');
        if ($xidx != '0') {
            $this->modelpegawai->setUpdatepegawai($xidx, $xnpp, $xNama, $xidUnitKerja, $xNoTelpon, $xuser, $xpassword, $xidLokasi);
        } else {
            $this->modelpegawai->setInsertpegawai($xidx, $xnpp, $xNama, $xidUnitKerja, $xNoTelpon, $xuser, $xpassword, $xidLokasi);
        }
        $this->createform('0');
    }

    function getlistpegawai($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                        addCell('npp', 'width:100px;', true) .
                        addCell('Nama', 'width:100px;', true) .
                        addCell('idUnitKerja', 'width:100px;', true) .
                        addCell('NoTelpon', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modelpegawai');
        $xQuery = $this->modelpegawai->getListpegawai($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->npp, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
                            addCell($row->npp, 'width:100px;') .
                            addCell($row->Nama, 'width:100px;') .
                            addCell($row->idUnitKerja, 'width:100px;') .
                            addCell($row->NoTelpon, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:60px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:650px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modelpegawai');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modelpegawai->setDeletepegawai($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelpegawai');
        $row = $this->modelpegawai->getDetailpegawai($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['npp'] = $row->npp;
        $this->json_data['Nama'] = $row->Nama;
        $this->json_data['idUnitKerja'] = $row->idUnitKerja;
        $this->json_data['NoTelpon'] = $row->NoTelpon;
        $this->json_data['user'] = $row->user;
        $this->json_data['password'] = $row->password;
        $this->json_data['idLokasi'] = $row->idLokasi;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelpegawai');
        $this->modelpegawai->setDeletepegawai($edidx);
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
        $this->json_data['tabledata'] = $this->getlistpegawai($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xnpp = $_POST['ednpp'];
        $xNama = $_POST['edNama'];
        $xidUnitKerja = $_POST['edidUnitKerja'];
        $xNoTelpon = $_POST['edNoTelpon'];
        $xuser = $_POST['eduser'];
        $xpassword = $_POST['edpassword'];
        $xidLokasi = $_POST['edidLokasi'];
        $this->load->model('modelpegawai');
        if ($xidx != '0') {
            $xStr = $this->modelpegawai->setUpdatepegawai($xidx, $xnpp, $xNama, $xidUnitKerja, $xNoTelpon, $xuser, $xpassword, $xidLokasi);
        } else {
            $xStr = $this->modelpegawai->setInsertpegawai($xidx, $xnpp, $xNama, $xidUnitKerja, $xNoTelpon, $xuser, $xpassword, $xidLokasi);
        }
    }

}

?>