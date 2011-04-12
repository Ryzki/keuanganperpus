<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : anggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctranggotabaca extends CI_Controller {

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
        $this->load->model('modelhargajenistransaksi');
        $row= $this->modelhargajenistransaksi->getDetailhargaIdJnsTransaksi('2');
        $xHarga  =number_format($row->biaya, 0, '.', ',');
        $xForm = '<div id="stylized" class="myform"><h3>Isi / Edit  Anggota Baca (Biaya Rp. '.$xHarga.')</h3>' . form_open_multipart('ctranggotabaca/inserttable', array('id' => 'form', 'name' => 'form')).'<div class="garis"></div>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxanggotabaca.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormanggotabaca($xidx), $this->getlistanggotabaca($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormanggotabaca($xidx) {
        $this->load->helper('form');
        $this->load->model('modelanggotabaca');
        $row = $this->modelanggotabaca->getDetailanggotabaca($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xNoIdentitas = '';
            $xNama = '';
            $xidJenisAnggota = '';
            $xAlamat = '';
            $xKota = '';
            $xkodepos = '';
            $xNotelp = '';
            $xemail = '';
        } else {
            $xidx = $row->idx;
            $xNoIdentitas = $row->NoIdentitas;
            $xNama = $row->Nama;
            $xidJenisAnggota = $row->idJenisAnggota;
            $xAlamat = $row->Alamat;
            $xKota = $row->Kota;
            $xkodepos = $row->kodepos;
            $xNotelp = $row->Notelp;
            $xemail = $row->email;
        }
        $this->load->helper('common');
        $this->load->model('modeljenisanggotabaca');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />' .
        $xBufResult .= setForm('edNoIdentitas', 'No.Identitas', form_input(getArrayObj('edNoIdentitas', $xNoIdentitas, '150'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNama', 'Nama', form_input(getArrayObj('edNama', $xNama, '200'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidJenisAnggota', 'Jenis Anggota', form_dropdown('edidJenisAnggota', $this->modeljenisanggotabaca->getArrayListjenisanggotabaca(),'0','id="edidJenisAnggota" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edAlamat', 'Alamat', form_input(getArrayObj('edAlamat', $xAlamat, '400'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edKota', 'Kota', form_input(getArrayObj('edKota', $xKota, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edkodepos', 'Kode Pos', form_input(getArrayObj('edkodepos', $xkodepos, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNotelp', 'No Telp', form_input(getArrayObj('edNotelp', $xNotelp, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edemail', 'Email', form_input(getArrayObj('edemail', $xemail, '120'))) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function inserttable() {
        $xidx = $_POST['edidx'];
        $xNoIdentitas = $_POST['edNoIdentitas'];
        $xNama = $_POST['edNama'];
        $xidJenisAnggota = $_POST['edidJenisAnggota'];
        $xAlamat = $_POST['edAlamat'];
        $xKota = $_POST['edKota'];
        $xkodepos = $_POST['edkodepos'];
        $xNotelp = $_POST['edNotelp'];
        $xemail = $_POST['edemail'];

        $this->load->model('modelanggotabaca');
        if ($xidx != '0') {
            $this->modelanggotabaca->setUpdateanggotabaca($xidx, $xNoIdentitas, $xNama, $xidJenisAnggota, $xAlamat, $xKota, $xkodepos, $xNotelp, $xemail);
        } else {
            $this->modelanggotabaca->setInsertanggotabaca($xidx, $xNoIdentitas, $xNama, $xidJenisAnggota, $xAlamat, $xKota, $xkodepos, $xNotelp, $xemail);
        }
        $this->createform('0');
    }

    function getlistanggotabaca($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                        addCell('NoIdentitas', 'width:100px;', true) .
                        addCell('Nama', 'width:100px;', true) .
                        addCell('Alamat', 'width:100px;', true) .
                        addCell('Notelp', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modelanggotabaca');
        $xQuery = $this->modelanggotabaca->getListanggotabaca($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->NoIdentitas, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
                            addCell($row->NoIdentitas, 'width:100px;') .
                            addCell($row->Nama, 'width:100px;') .
                            addCell($row->Alamat, 'width:100px;') .
                            addCell($row->Notelp, 'width:100px;') .
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
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:650px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modelanggotabaca');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modelanggotabaca->setDeleteanggotabaca($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelanggotabaca');
        $row = $this->modelanggotabaca->getDetailanggotabaca($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['NoIdentitas'] = $row->NoIdentitas;
        $this->json_data['Nama'] = $row->Nama;
        $this->json_data['idJenisAnggota'] = $row->idJenisAnggota;
        $this->json_data['Alamat'] = $row->Alamat;
        $this->json_data['Kota'] = $row->Kota;
        $this->json_data['kodepos'] = $row->kodepos;
        $this->json_data['Notelp'] = $row->Notelp;
        $this->json_data['email'] = $row->email;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelanggotabaca');
        $this->load->model('modelhargajenistransaksi');
        $this->modelanggotabaca->setDeleteanggotabaca($edidx);
        $this->modelhargajenistransaksi->setDeletetransaksianggotabaca($xidx);
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
        $this->json_data['tabledata'] = $this->getlistanggotabaca($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xNoIdentitas = $_POST['edNoIdentitas'];
        $xNama = $_POST['edNama'];
        $xidJenisAnggota = $_POST['edidJenisAnggota'];
        $xAlamat = $_POST['edAlamat'];
        $xKota = $_POST['edKota'];
        $xkodepos = $_POST['edkodepos'];
        $xNotelp = $_POST['edNotelp'];
        $xemail = $_POST['edemail'];
        $this->load->model('modelanggotabaca');
        $this->load->model('modeltransaksi');
        $this->load->model('modelhargajenistransaksi');
        if ($xidx != '0') {
            $xStr = $this->modelanggotabaca->setUpdateanggotabaca($xidx, $xNoIdentitas, $xNama, $xidJenisAnggota, $xAlamat, $xKota, $xkodepos, $xNotelp, $xemail);
        } else {
            $xStr = $this->modelanggotabaca->setInsertanggotabaca($xidx, $xNoIdentitas, $xNama, $xidJenisAnggota, $xAlamat, $xKota, $xkodepos, $xNotelp, $xemail);
            $row= $this->modelhargajenistransaksi->getDetailhargaIdJnsTransaksi('2');
            //$xHarga  =number_format($row->biaya, 0, '.', ',');
            $xiduser =  $this->session->userdata('idpegawai');
            $xidlokasi =  $this->session->userdata('idlokasi');
           $xtanggal =  $this->session->userdata('tanggal');
           $rowlast =   $this->modelanggotabaca->getLastIndexanggotabaca();
           $xStr = $this->modeltransaksi->setInserttransaksi($xidx, '0', '2', $rowlast->idx, '0', '0', $xtanggal, '01:01:01', '1', $row->biaya, $row->biaya, $xiduser, '0', '', $xidlokasi);

            //$xStr = $this->modeltransaksi->setInserttransaksi($xidx, $xidplu, $xidjenistransaksi, $xidpegawai, $xidunitkerja, $xidstatusdinas, $xtanggal, $xjam, $xjumlahsatuan, $xnominalpersatuan, $xtotal, $xiduser, $xnominaldenda, $xiddendasparta, $xidlokasi);
        }
    }

}

?>