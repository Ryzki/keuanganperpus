<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : reportingbug  * di Buat oleh Diar PHP Generator *
 * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrreportingbug extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform">' . form_open_multipart('ctrreportingbug/inserttable', array('id' => 'form', 'name' => 'form'));
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxreportingbug.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>';
        echo $this->modelgetmenu->SetAdmin($xForm . $this->setDetailFormreportingbug($xidx), $this->getlistreportingbug($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormreportingbug($xidx) {
        $this->load->helper('form');
        $this->load->model('modelreportingbug');
        $row = $this->modelreportingbug->getDetailreportingbug($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xlokasi = '';
            $xketerangan = '';
            $xtanggapan = '';
            $xiduser = '';
            $xtanggal = '';
            $xjam = '';
            $xtanggaltanggapan = '';
            $xjamtanggapan = '';
        } else {
            $xidx = $row->idx;
            $xlokasi = $row->lokasi;
            $xketerangan = $row->keterangan;
            $xtanggapan = $row->tanggapan;
            $xiduser = $row->iduser;
            $xtanggal = $row->tanggal;
            $xjam = $row->jam;
            $xtanggaltanggapan = $row->tanggaltanggapan;
            $xjamtanggapan = $row->jamtanggapan;
        }
        $this->load->helper('common');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />';
        $xBufResult .= setForm('edlokasi', 'lokasi', form_input(getArrayObj('edlokasi', $xlokasi, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edketerangan', 'keterangan', form_input(getArrayObj('edketerangan', $xketerangan, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edtanggapan', 'tanggapan', form_input(getArrayObj('edtanggapan', $xtanggapan, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ediduser', 'iduser', form_input(getArrayObj('ediduser', $xiduser, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edtanggal', 'tanggal', form_input(getArrayObj('edtanggal', $xtanggal, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edjam', 'jam', form_input(getArrayObj('edjam', $xjam, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edtanggaltanggapan', 'tanggaltanggapan', form_input(getArrayObj('edtanggaltanggapan', $xtanggaltanggapan, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edjamtanggapan', 'jamtanggapan', form_input(getArrayObj('edjamtanggapan', $xjamtanggapan, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistreportingbug($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                        addCell('lokasi', 'width:100px;', true) .
                        addCell('keterangan', 'width:100px;', true) .
                        addCell('tanggapan', 'width:100px;', true) .
                        addCell('iduser', 'width:100px;', true) .
                        addCell('tanggal', 'width:100px;', true) .
                        addCell('jam', 'width:100px;', true) .
                        addCell('tanggaltanggapan', 'width:100px;', true) .
                        addCell('jamtanggapan', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modelreportingbug');
        $xQuery = $this->modelreportingbug->getListreportingbug($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->lokasi, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
                            addCell($row->lokasi, 'width:100px;') .
                            addCell($row->keterangan, 'width:100px;') .
                            addCell($row->tanggapan, 'width:100px;') .
                            addCell($row->iduser, 'width:100px;') .
                            addCell($row->tanggal, 'width:100px;') .
                            addCell($row->jam, 'width:100px;') .
                            addCell($row->tanggaltanggapan, 'width:100px;') .
                            addCell($row->jamtanggapan, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:860px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:415px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modelreportingbug');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modelreportingbug->setDeletereportingbug($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelreportingbug');
        $row = $this->modelreportingbug->getDetailreportingbug($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['lokasi'] = $row->lokasi;
        $this->json_data['keterangan'] = $row->keterangan;
        $this->json_data['tanggapan'] = $row->tanggapan;
        $this->json_data['iduser'] = $row->iduser;
        $this->json_data['tanggal'] = $row->tanggal;
        $this->json_data['jam'] = $row->jam;
        $this->json_data['tanggaltanggapan'] = $row->tanggaltanggapan;
        $this->json_data['jamtanggapan'] = $row->jamtanggapan;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelreportingbug');
        $this->modelreportingbug->setDeletereportingbug($edidx);
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
        $this->json_data['tabledata'] = $this->getlistreportingbug($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xlokasi = $_POST['edlokasi'];
        $xketerangan = $_POST['edketerangan'];
        $xtanggapan = $_POST['edtanggapan'];
        $xiduser = $_POST['ediduser'];
        $xtanggal = $_POST['edtanggal'];
        $xjam = $_POST['edjam'];
        $xtanggaltanggapan = $_POST['edtanggaltanggapan'];
        $xjamtanggapan = $_POST['edjamtanggapan'];
        $this->load->model('modelreportingbug');
        if ($xidx != '0') {
            $xStr = $this->modelreportingbug->setUpdatereportingbug($xidx, $xlokasi, $xketerangan, $xtanggapan, $xiduser, $xtanggal, $xjam, $xtanggaltanggapan, $xjamtanggapan);
        } else {
            $xStr = $this->modelreportingbug->setInsertreportingbug($xidx, $xlokasi, $xketerangan, $xtanggapan, $xiduser, $xtanggal, $xjam, $xtanggaltanggapan, $xjamtanggapan);
        }
    }

    function simpansmall() {
        $this->load->helper('json');
        $xlokasi = $_POST['edlokasi'];
        $xketerangan = $_POST['edketeranganbug'];
        $this->load->model('modelreportingbug');
        $xStr = $this->modelreportingbug->setInsertreportingbugsmall(addslashes($xlokasi), addslashes($xketerangan));

        $this->json_data['data'] = $xStr;
        echo json_encode($this->json_data);
    }

}

?>