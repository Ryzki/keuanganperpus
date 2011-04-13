<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : anggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrdenda extends CI_Controller {

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
        $row = $this->modelhargajenistransaksi->getDetailhargaIdJnsTransaksi('2');
        $xHarga = number_format($row->biaya, 0, '.', ',');
        $xForm = '<div id="stylized" class="myform"><h3>Isi Pembayaran Denda </h3>' . form_open_multipart('ctranggotabaca/inserttable', array('id' => 'form', 'name' => 'form')) . '<div class="garis"></div>';
        $xAddJs = link_tag('resource/js/themes/base/jquery.ui.all.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.core.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.widget.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.datepicker.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxdenda.js"></script>';
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
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />';
        $xBufResult .= '<input type="hidden" name="edidsparta" id="edidsparta" value="0" />';
        $xBufResult .= setForm('edtgldenda', 'Tanggal Denda', form_input(getArrayObj('edtgldenda', $xemail, '120'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNoIdentitas', 'NIM', form_input(getArrayObj('edNoIdentitas', $xNoIdentitas, '150'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNama', 'Nama', form_input(getArrayObj('edNama', $xNama, '200'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edDendaSparta', 'Denda', form_input(getArrayObj('edDendaSparta', $xAlamat, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= form_button('btSimpan', 'Get From Sparta', 'onclick="dogetsparta();"') . '<div class="spacer"></div>';
        $xBufResult .= setForm('edDenda', 'Di Bayar', form_input(getArrayObj('edDenda', $xAlamat, '100'))) . '<div class="spacer"></div>';
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
                        addCell('NIM', 'width:100px;', true) .
                        addCell('Denda', 'width:100px;', true) .
                        addCell('Dibayar', 'width:100px;', true) .
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
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true);
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:550px;">' . $xbufResult . $xRowCells . '</div>';
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
        /*
        data: "edidx="+$("#edidx").val()+
                "&edidsparta="+$("#edidsparta").val()+
                "&edNoIdentitas="+$("#edNoIdentitas").val()+
                "&edDendaSparta="+$("#edDendaSparta").val()+
                "&edDenda="+$("#edDenda").val()
        */

        $xidplu = '0';
        $xidsparta = $_POST['edidsparta'];
        $xidjenistransaksi = '1';

        $xidpegawai = $_POST['edNoIdentitas'];
        $xidunitkerja = '0';
        $xidstatusdinas = '0';
        //$xtanggal = $_POST['edtanggal'];
        //$xjam = $_POST['edjam'];



        $xtanggal = $_POST['edtgldenda'] ;
        $xjumlahsatuan = $_POST['edjumlahsatuan'];
        $xnominalpersatuan = $_POST['ednominalpersatuan'];
        $xtotal = $_POST['edtotal'];
        $xiduser = $this->session->userdata('idpegawai');
        $xnominaldenda = $_POST['ednominaldenda'];
        $xiddendasparta = $_POST['ediddendasparta'];
        $xidlokasi = $this->session->userdata('idlokasi');
        $this->load->model('modeldenda');
        $xStr = 'kosong';
        if ($xidx != '0') {
            $xStr = $this->modeldenda->setUpdatetransaksidenda($xidx, $xidplu, $xidjenistransaksi, $xidpegawai, $xidunitkerja, $xidstatusdinas, str_replace('.', '', $xjumlahsatuan),
                            $xnominalpersatuan, $xtotal, $xiduser, $xnominaldenda, $xiddendasparta, $xidlokasi);
        } else {
            $xStr = $this->modeldenda->setInserttransaksidenda($xidx, $xidplu, $xidjenistransaksi, $xidpegawai, $xidunitkerja,
                            $xidstatusdinas, str_replace('.', '', $xjumlahsatuan), $xnominalpersatuan,
                            $xtotal, $xiduser, $xnominaldenda, $xiddendasparta, $xidlokasi);
        }
        $this->json_data['data'] = $xStr;
        echo json_encode($this->json_data);
    }

}

?>