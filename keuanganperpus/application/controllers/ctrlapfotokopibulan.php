<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : anggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrlapfotokopibulan extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Laporan Detail Fotokopi/Print/Jilid Perbulan </h3>' . form_open_multipart('ctranggotabaca/inserttable', array('id' => 'form', 'name' => 'form')) . '<div class="garis"></div>';
        $xAddJs = link_tag('resource/js/themes/base/jquery.ui.all.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.core.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.widget.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.datepicker.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxfotokopibulan.js"></script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormReport($xidx), '', '', $xAddJs, '');
    }

    function setDetailFormReport($xidx) {
        $this->load->helper('form');
        $this->load->helper('common');
        //$this->load->model('modeljenisanggotabaca');
        $xBufResult = setForm('edBulan', 'Bulan', form_dropdown('edBulan', getArrayBulan(),'0','id="edBulan" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Tampil Data', 'onclick="dotampil();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function getReport($xBulan) {
        $xIdEdit = $_POST['edidx'];
      
        return '<div id="tablereport" name ="tablereport" class="tablereport" style="width:550px;">' . $xbufResult . $xRowCells . '</div>';
    }
    function gettablefotokopi(){
      /*
       *
       1 cek tanggal

       Select trx.idx, trx.idplu,plu.idjnspengguna,tanggal,jumlahsatuan,nominalpersatuan,
       (select JenisPengguna from jenipengguna as jnsp Where jnsp.idx=plu.idjnspengguna limit 1) as pengg
       from transaksi as trx
       inner join produkplu as plu on(trx.idplu=plu.KodePLU) where month(tanggal)=4 order by plu.idjnspengguna;
       */
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
        $this->json_data['iddendasparta'] = $row->iddendasparta;
        $this->json_data['NoIdentitas'] = $row->NIM;
        //$this->json_data['Nama'] = $row->Nama;
        $this->json_data['nominalpersatuan'] = $row->nominalpersatuan;
        $this->json_data['nominaldenda'] = $row->nominaldenda;

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
        $this->json_data['tabledata'] = $this->getlistDendabyTanggal($xAwal, $xSearch);
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

        $xNIM = $_POST['edNoIdentitas'];
        $xidsparta = $_POST['edidsparta'];
        $xidjenistransaksi = '1';

        $xidpegawai = '0';
        $xidunitkerja = '0';
        $xidstatusdinas = '0';
        //$xtanggal = $_POST['edtanggal'];
        //$xjam = $_POST['edjam'];



        $xtanggal = $_POST['edtgldenda'] ;
        $xjumlahsatuan = '1';
        $xnominalpersatuan = $_POST['edDenda'];
        $xtotal = $xnominalpersatuan;
        $xiduser = $this->session->userdata('idpegawai');
        $xnominaldenda = $_POST['edDendaSparta'];
        $xiddendasparta = $_POST['edidsparta'];
        $xidlokasi = $this->session->userdata('idlokasi');
        $this->load->model('modeldenda');
        $xStr = 'kosong';


        if ($xidx != '0') {
            $xStr = $this->modeldenda->setUpdatetransaksidenda($xidx, $xNIM, $xidjenistransaksi, $xidpegawai, $xidunitkerja,
                               $xidstatusdinas, str_replace('.', '', $xjumlahsatuan),
                               str_replace('.', '', $xnominalpersatuan), str_replace('.', '', $xtotal), $xiduser,
                               str_replace('.', '', $xnominaldenda), $xiddendasparta, $xidlokasi);
        } else {
            $xStr = $this->modeldenda->setInserttransaksidenda($xidx, $xNIM, $xidjenistransaksi, $xidpegawai, $xidunitkerja,
                            $xidstatusdinas, str_replace('.', '', $xjumlahsatuan), str_replace('.', '', $xnominalpersatuan),
                            str_replace('.', '', $xtotal), $xiduser, str_replace('.', '', $xnominaldenda), $xiddendasparta, $xidlokasi);
        }
        $this->json_data['data'] = $xStr;
        echo json_encode($this->json_data);
    }

}

?>