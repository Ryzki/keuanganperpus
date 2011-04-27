<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : anggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrlapsetoran extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Laporan Setoran Kerekanan </h3>' . form_open_multipart('ctranggotabaca/inserttable', array('id' => 'form', 'name' => 'form')) . '<div class="garis"></div>';
        $xAddJs = link_tag('resource/js/themes/base/jquery.ui.all.css') .
                  link_tag('resource/css/jquery.treeview.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>'.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxsetoran.js"></script> '.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.core.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.widget.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.treeview.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.cookie.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/demo.js"></script>'.
                '
                 <script language="javascript" type="text/javascript">

                    setlapsetoran();
                 

                 </script>   ';
        //'<div id="tablereport" name ="tablereport"> </div>'  $this->getReport('4', '12', '4')
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormReport($xidx), $this->getReport('4', '2011', '1') , '', $xAddJs, '');
    }

    function getlistrabb($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->model('modelrab');
        return '<div id="browser"> <div id="lstreeview" name="lstreeview" class="treev">' . $this->modelrab->gettreereport() . '</div></div>';
    }

    function setDetailFormReport($xidx) {
        $this->load->helper('form');
        $this->load->helper('common');
        $this->load->model('modelrekanan');
        $xStrTahun = $this->session->userdata('tanggal');
        $this->load->model('modelrab');
        $xBufResult = setForm('edBulan', 'Bulan', form_dropdown('edBulan', getArrayBulan(), '0', 'id="edBulan" width="150px"'));
        $xBufResult .= setForm('edTahun', 'Tahun', form_input(getArrayObj('edTahun',  substr($xStrTahun, 0, 4), '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidrekanan', 'idrekanan', form_dropdown('edidrekanan', $this->modelrekanan->getArrayListrekanan(), '0', 'id="edidrekanan" width="150px"')) . '<div class="spacer"></div>';
       
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Tampil Data', 'onclick="dotampillaporansetoran(false);"') . form_button('btNew', 'Export Ke Excel', 'onclick="dotampillaporansetoran(true);"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function dotampillaporan() {
        $this->load->helper('json');
        $xBulan = $_POST['edbulan'];
        $xTahun = $_POST['edtahun'];
        $edidrekanan = $_POST['edidrekanan'];
        $this->json_data['data'] = $this->getReport($xBulan, $xTahun,$edidrekanan);
        // $this->json_data['data'] = "coba";
        echo json_encode($this->json_data);
    }

    
    function getReport($xBulan, $tahun,$edidrekanan) {
        //$xIdEdit = $_POST['edidx'];
        $this->load->helper('form');
        $this->load->helper('common');
        $arrayrow = $this->getrow($xBulan, $tahun,$edidrekanan);
        $xBufresult = '<table>';

        for ($i = 0; $i < count($arrayrow); $i++) {
            $xBufresult .= '<tr>' . $arrayrow[$i] . '</tr>';
        }

        $xBufresult .='</table>';
        $array = getArrayBulan();
        $nmbulan = $array[str_pad($xBulan, 2, '0', STR_PAD_LEFT)];
        $this->load->model('modelrekanan');
        $rowrekanan = $this->modelrekanan->getDetailrekanan($edidrekanan);
        
        $judul = "PERPUSTAKAAN UNIVERSITAS SANATA DHARMA  <br />" .
                 "DATA SETORAN KE  ".$rowrekanan->NamaRekanan."<br />".
                 "BULAN " . $nmbulan . " " . $tahun. "<br />";
          return '<div id="tablereport" name ="tablereport" class="tablereport" style="width:700px;" align="center"><h3>' . $judul . ' </h3>' . $xBufresult . '</div>';
    }

    function getrow($xbulan,$xtahun,$xidrekanan) {
        //Prepare data untuk membuat reporttable
        /*
         *
          1. buat array untuk row
         *  2. tambahkan cell
         */

        $this->load->model('modelsetoran');
        $xQuery = $this->modelsetoran->getlistSetoranBulan($xbulan,$xtahun,$xidrekanan);
        $arrayrow[0] = '<td><b>NO</b></td><td><b>Tanggal</b></td><td width="500px"><b>Setoran Untuk</b></td><td><b>Jumlah</b></td> ';
        $i = 1;
        $Totalsaldo = 0;
        if (!empty($xQuery)) {
            foreach ($xQuery->result() as $row) {
                $this->load->model('modelstatusplu');
                $rowstatusplu = $this->modelstatusplu->getDetailstatusplu($row->idstatusplu);
                $arrayrow[$i] = '<td>'.$i.'. </td><td>'.$row->tanggal.'</td><td width="500px">'.$rowstatusplu->Status.'</td><td align="right">'.number_format($row->nominal, 0, '.', ',').'</td> ';
                $Totalsaldo += $row->nominal;
                $i++;
            }
        }

        $arrayrow[$i] = '<td><b>_</b></td><td><b>_</b></td><td width="500px"><b>Jumlah</b></td><td align="right"><b>'.number_format($Totalsaldo, 0, '.', ',').'</b></td> ';

        return $arrayrow;
    }

}

?>