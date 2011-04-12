<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : lokasi  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrlokasi extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"> Setting Lokasi Kampus' . form_open_multipart('ctrlokasi/inserttable', array('id' => 'form', 'name' => 'form')).'<div class="garis"></div>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxlokasi.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormlokasi($xidx), $this->getlistlokasi($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormlokasi($xidx) {
        $this->load->helper('form');
        $this->load->model('modellokasi');
        $row = $this->modellokasi->getDetaillokasi($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xNmLokasi = '';
            $xipsegment = '';
        } else {
            $xidx = $row->idx;
            $xNmLokasi = $row->NmLokasi;
            $xipsegment = $row->ipsegment;
        }
        $this->load->helper('common');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />' .
                $xBufResult .= setForm('edNmLokasi', 'NmLokasi', form_input(getArrayObj('edNmLokasi', $xNmLokasi, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edipsegment', 'ipsegment', form_input(getArrayObj('edipsegment', $xipsegment, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function inserttable() {
        $xidx = $_POST['edidx'];
        $xNmLokasi = $_POST['edNmLokasi'];
        $xipsegment = $_POST['edipsegment'];

        $this->load->model('modellokasi');
        if ($xidx != '0') {
            $this->modellokasi->setUpdatelokasi($xidx, $xNmLokasi, $xipsegment);
        } else {
            $this->modellokasi->setInsertlokasi($xidx, $xNmLokasi, $xipsegment);
        }
        $this->createform('0');
    }

    function getlistlokasi($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                        addCell('NmLokasi', 'width:100px;', true) .
                        addCell('ipsegment', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modellokasi');
        $xQuery = $this->modellokasi->getListlokasi($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->NmLokasi, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
                            addCell($row->NmLokasi, 'width:100px;') .
                            addCell($row->ipsegment, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:100px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:60px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:500px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modellokasi');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modellokasi->setDeletelokasi($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modellokasi');
        $row = $this->modellokasi->getDetaillokasi($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['NmLokasi'] = $row->NmLokasi;
        $this->json_data['ipsegment'] = $row->ipsegment;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modellokasi');
        $this->modellokasi->setDeletelokasi($edidx);
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
        $this->json_data['tabledata'] = $this->getlistlokasi($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xNmLokasi = $_POST['edNmLokasi'];
        $xipsegment = $_POST['edipsegment'];
        $this->load->model('modellokasi');
        if ($xidx != '0') {
            $xStr = $this->modellokasi->setUpdatelokasi($xidx, $xNmLokasi, $xipsegment);
        } else {
            $xStr = $this->modellokasi->setInsertlokasi($xidx, $xNmLokasi, $xipsegment);
        }
    }

}

?>