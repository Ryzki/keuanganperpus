<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : transaksi  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrtransaksi extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform">' . form_open_multipart('ctrtransaksi/inserttable', array('id' => 'form', 'name' => 'form'));
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxtransaksi.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>';
        echo $this->modelgetmenu->SetAdmin($xForm . $this->setDetailFormtransaksi($xidx), $this->getlisttransaksi($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormtransaksi($xidx) {
        $this->load->helper('form');
        $this->load->model('modeltransaksi');
        $row = $this->modeltransaksi->getDetailtransaksi($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xidplu = '';
            $xidjenistransaksi = '';
            $xidpegawai = '';
            $xidunitkerja = '';
            $xidstatusdinas = '';
            $xtanggal = '';
            $xjam = '';
            $xjumlahsatuan = '';
            $xnominalpersatuan = '';
            $xtotal = '';
            $xiduser = '';
            $xnominaldenda = '';
            $xiddendasparta = '';
            $xidlokasi = '';
        } else {
            $xidx = $row->idx;
            $xidplu = $row->idplu;
            $xidjenistransaksi = $row->idjenistransaksi;
            $xidpegawai = $row->idpegawai;
            $xidunitkerja = $row->idunitkerja;
            $xidstatusdinas = $row->idstatusdinas;
            $xtanggal = $row->tanggal;
            $xjam = $row->jam;
            $xjumlahsatuan = $row->jumlahsatuan;
            $xnominalpersatuan = $row->nominalpersatuan;
            $xtotal = $row->total;
            $xiduser = $row->iduser;
            $xnominaldenda = $row->nominaldenda;
            $xiddendasparta = $row->iddendasparta;
            $xidlokasi = $row->idlokasi;
        }
        $this->load->helper('common');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />' .
        $xBufResult .= setForm('edidplu', 'idplu', form_input(getArrayObj('edidplu', $xidplu, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidjenistransaksi', 'idjenistransaksi', form_input(getArrayObj('edidjenistransaksi', $xidjenistransaksi, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidpegawai', 'idpegawai', form_input(getArrayObj('edidpegawai', $xidpegawai, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidunitkerja', 'idunitkerja', form_input(getArrayObj('edidunitkerja', $xidunitkerja, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidstatusdinas', 'idstatusdinas', form_input(getArrayObj('edidstatusdinas', $xidstatusdinas, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edtanggal', 'tanggal', form_input(getArrayObj('edtanggal', $xtanggal, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edjam', 'jam', form_input(getArrayObj('edjam', $xjam, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edjumlahsatuan', 'jumlahsatuan', form_input(getArrayObj('edjumlahsatuan', $xjumlahsatuan, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ednominalpersatuan', 'nominalpersatuan', form_input(getArrayObj('ednominalpersatuan', $xnominalpersatuan, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edtotal', 'total', form_input(getArrayObj('edtotal', $xtotal, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ediduser', 'iduser', form_input(getArrayObj('ediduser', $xiduser, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ednominaldenda', 'nominaldenda', form_input(getArrayObj('ednominaldenda', $xnominaldenda, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ediddendasparta', 'iddendasparta', form_input(getArrayObj('ediddendasparta', $xiddendasparta, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidlokasi', 'idlokasi', form_input(getArrayObj('edidlokasi', $xidlokasi, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function inserttable() {
        $xidx = $_POST['edidx'];
        $xidplu = $_POST['edidplu'];
        $xidjenistransaksi = $_POST['edidjenistransaksi'];
        $xidpegawai = $_POST['edidpegawai'];
        $xidunitkerja = $_POST['edidunitkerja'];
        $xidstatusdinas = $_POST['edidstatusdinas'];
        $xtanggal = $_POST['edtanggal'];
        $xjam = $_POST['edjam'];
        $xjumlahsatuan = $_POST['edjumlahsatuan'];
        $xnominalpersatuan = $_POST['ednominalpersatuan'];
        $xtotal = $_POST['edtotal'];
        $xiduser = $_POST['ediduser'];
        $xnominaldenda = $_POST['ednominaldenda'];
        $xiddendasparta = $_POST['ediddendasparta'];
        $xidlokasi = $_POST['edidlokasi'];

        $this->load->model('modeltransaksi');
        if ($xidx != '0') {
            $this->modeltransaksi->setUpdatetransaksi($xidx, $xidplu, $xidjenistransaksi, $xidpegawai, $xidunitkerja, $xidstatusdinas, $xtanggal, $xjam, $xjumlahsatuan, $xnominalpersatuan, $xtotal, $xiduser, $xnominaldenda, $xiddendasparta, $xidlokasi);
        } else {
            $this->modeltransaksi->setInserttransaksi($xidx, $xidplu, $xidjenistransaksi, $xidpegawai, $xidunitkerja, $xidstatusdinas, $xtanggal, $xjam, $xjumlahsatuan, $xnominalpersatuan, $xtotal, $xiduser, $xnominaldenda, $xiddendasparta, $xidlokasi);
        }
        $this->createform('0');
    }

    function getlisttransaksi($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                        addCell('idplu', 'width:100px;', true) .
                        addCell('idjenistransaksi', 'width:100px;', true) .
                        addCell('idpegawai', 'width:100px;', true) .
                        addCell('idunitkerja', 'width:100px;', true) .
                        addCell('idstatusdinas', 'width:100px;', true) .
                        addCell('tanggal', 'width:100px;', true) .
                        addCell('jam', 'width:100px;', true) .
                        addCell('jumlahsatuan', 'width:100px;', true) .
                        addCell('nominalpersatuan', 'width:100px;', true) .
                        addCell('total', 'width:100px;', true) .
                        addCell('iduser', 'width:100px;', true) .
                        addCell('nominaldenda', 'width:100px;', true) .
                        addCell('iddendasparta', 'width:100px;', true) .
                        addCell('idlokasi', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modeltransaksi');
        $xQuery = $this->modeltransaksi->getListtransaksi($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->idplu, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
                            addCell($row->idplu, 'width:100px;') .
                            addCell($row->idjenistransaksi, 'width:100px;') .
                            addCell($row->idpegawai, 'width:100px;') .
                            addCell($row->idunitkerja, 'width:100px;') .
                            addCell($row->idstatusdinas, 'width:100px;') .
                            addCell($row->tanggal, 'width:100px;') .
                            addCell($row->jam, 'width:100px;') .
                            addCell($row->jumlahsatuan, 'width:100px;') .
                            addCell($row->nominalpersatuan, 'width:100px;') .
                            addCell($row->total, 'width:100px;') .
                            addCell($row->iduser, 'width:100px;') .
                            addCell($row->nominaldenda, 'width:100px;') .
                            addCell($row->iddendasparta, 'width:100px;') .
                            addCell($row->idlokasi, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:1460px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:415px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modeltransaksi');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modeltransaksi->setDeletetransaksi($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modeltransaksi');
        $row = $this->modeltransaksi->getDetailtransaksi($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['idplu'] = $row->idplu;
        $this->json_data['idjenistransaksi'] = $row->idjenistransaksi;
        $this->json_data['idpegawai'] = $row->idpegawai;
        $this->json_data['idunitkerja'] = $row->idunitkerja;
        $this->json_data['idstatusdinas'] = $row->idstatusdinas;
        $this->json_data['tanggal'] = $row->tanggal;
        $this->json_data['jam'] = $row->jam;
        $this->json_data['jumlahsatuan'] = $row->jumlahsatuan;
        $this->json_data['nominalpersatuan'] = $row->nominalpersatuan;
        $this->json_data['total'] = $row->total;
        $this->json_data['iduser'] = $row->iduser;
        $this->json_data['nominaldenda'] = $row->nominaldenda;
        $this->json_data['iddendasparta'] = $row->iddendasparta;
        $this->json_data['idlokasi'] = $row->idlokasi;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modeltransaksi');
        $this->modeltransaksi->setDeletetransaksi($edidx);
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
        $this->json_data['tabledata'] = $this->getlisttransaksi($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xidplu = $_POST['edidplu'];
        $xidjenistransaksi = $_POST['edidjenistransaksi'];
        $xidpegawai = $_POST['edidpegawai'];
        $xidunitkerja = $_POST['edidunitkerja'];
        $xidstatusdinas = $_POST['edidstatusdinas'];
        $xtanggal = $_POST['edtanggal'];
        $xjam = $_POST['edjam'];
        $xjumlahsatuan = $_POST['edjumlahsatuan'];
        $xnominalpersatuan = $_POST['ednominalpersatuan'];
        $xtotal = $_POST['edtotal'];
        $xiduser = $_POST['ediduser'];
        $xnominaldenda = $_POST['ednominaldenda'];
        $xiddendasparta = $_POST['ediddendasparta'];
        $xidlokasi = $_POST['edidlokasi'];
        $this->load->model('modeltransaksi');
        if ($xidx != '0') {
            $xStr = $this->modeltransaksi->setUpdatetransaksi($xidx, $xidplu, $xidjenistransaksi, $xidpegawai, $xidunitkerja, $xidstatusdinas, $xtanggal, $xjam, $xjumlahsatuan, $xnominalpersatuan, $xtotal, $xiduser, $xnominaldenda, $xiddendasparta, $xidlokasi);
        } else {
            $xStr = $this->modeltransaksi->setInserttransaksi($xidx, $xidplu, $xidjenistransaksi, $xidpegawai, $xidunitkerja, $xidstatusdinas, $xtanggal, $xjam, $xjumlahsatuan, $xnominalpersatuan, $xtotal, $xiduser, $xnominaldenda, $xiddendasparta, $xidlokasi);
        }
    }

}

?>