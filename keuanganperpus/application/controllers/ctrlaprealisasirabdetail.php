<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : anggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrlaprealisasirabdetail extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Laporan Realisasi RAB </h3>' . form_open_multipart('ctranggotabaca/inserttable', array('id' => 'form', 'name' => 'form')) . '<div class="garis"></div>';
        $xAddJs = link_tag('resource/js/themes/base/jquery.ui.all.css') .
                  link_tag('resource/css/jquery.treeview.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>'.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxreportrabdetail.js"></script> '.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.core.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.widget.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.treeview.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.cookie.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/demo.js"></script>'.
                '
                 <script language="javascript" type="text/javascript">

                    setawalpribadi();
                 

                 </script>   ';
        //'<div id="tablereport" name ="tablereport"> </div>'  $this->getReport('4', '12', '4')
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormReport($xidx), $this->getReport('4', '12', '6') , '', $xAddJs, '');
    }

    function getlistrabb($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->model('modelrab');
        return '<div id="browser"> <div id="lstreeview" name="lstreeview" class="treev">' . $this->modelrab->gettreereport() . '</div></div>';
    }

    function setDetailFormReport($xidx) {
        $this->load->helper('form');
        $this->load->helper('common');
        $this->load->model('modeltahunanggaran');
        $xStrTahun = $this->session->userdata('tanggal');
        $this->load->model('modelrab');

        $xBufResult = setForm('edBulan', 'Bulan', form_dropdown('edBulan', getArrayBulan(), '0', 'id="edBulan" width="150px"'));
        //$xBufResult .= setForm('edidtahunanggaran', 'Tahun Anggaran', form_dropdown('edidtahunanggaran', $this->modeltahunanggaran->getArrayListtahunanggaran(), '0', 'id="edidtahunanggaran" width="150px" ')) . '<div class="spacer"></div>';
        $xBufResult .= form_dropdown('edidtahunanggaran', $this->modeltahunanggaran->getArrayListtahunanggaran(), '0', 'id="edidtahunanggaran" width="150px" '). '<div class="spacer"></div>';
        //$xBufResult .= setForm('edidrab', 'R A B', form_dropdown('edidrab', $this->modelrab->getArrayListrab(), '0', 'id="edidrab" width="150px" onchange="doedidrabchange();"')) . '<div class="spacer"></div>';
        $xBufResult .= form_dropdown('edidrab', $this->modelrab->getArrayListrab(), '0', 'id="edidrab" width="150px" onchange="doedidrabchange();"');
        $xBufResult .= $this->getlistrabb('', '') . '<div class="spacer"></div>';


        //$xBufResult .= setForm('edunitkerja', 'Unit Kerja', form_dropdown('edunitkerja', $this->modelunitkerja->getArrayListunitkerja(), '0', 'id="edunitkerja" width="150px" onchange="onCbJenisTransksiChange();"')) . '<div class="spacer"></div>';
        //$xBufResult .= setForm('edidstatusPLU', 'Status PLU', form_dropdown('edidstatusPLU', $this->modelstatusplu->getArrayListstatusplu(), '0', 'id="edidstatusPLU" width="150px"')) . '<div class="spacer"></div>';

        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Tampil Data', 'onclick="dotampillaporanrab(false);"') . form_button('btNew', 'Export Ke Excel', 'onclick="dotampillaporanrab(true);"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function dotampillaporan() {
        $this->load->helper('json');
        $xBulan = $_POST['edbulan'];
        $xTahun = $_POST['edidtahunanggaran'];
        $xidrab = $_POST['edidrab'];
        $this->json_data['data'] = $this->getReport($xBulan, $xTahun,$xidrab);
        // $this->json_data['data'] = "coba";
        echo json_encode($this->json_data);
    }

    /*    function  setcombounitkerja(){
      $this->load->helper('json');
      $xBulan = $_POST['edbulan'];
      $xTahun = $_POST['edtahun'];
      $edidlokasi = $_POST['edidlokasi'];

      $xBufresult = '';

      $this->load->model('modeltransaksi');
      $xQuery = $this->modeltransaksi->getlistcombounitkerjaofthemonth($xBulan,$xTahun,$edidlokasi);


      foreach ($xQuery->result() as $row) {
      $this->load->model('modelunitkerja');
      $rowunitkerja =  $this->modelunitkerja->getDetailunitkerja($row->idunitkerja);
      $xBufresult .= '<option value="'.$row->idunitkerja.'">'.$rowunitkerja->NmUnitKerja.'</option>';
      }
      $this->json_data['data'] = $xBufresult;
      //$this->json_data['data'] = $xQuery;
      echo json_encode($this->json_data);
      }
     */

    function getReport($xBulan, $tahun,$edidrab) {
        //$xIdEdit = $_POST['edidx'];
        $this->load->helper('form');
        $this->load->helper('common');

        $arrayrow = $this->getrow($xBulan, $tahun,$edidrab);
        $xBufresult = '<table>';
        for ($i = 0; $i < count($arrayrow); $i++) {
            $xBufresult .= '<tr>' . $arrayrow[$i] . '</tr>';
        }
        $xBufresult .='</table>';
        $array = getArrayBulan();
        $nmbulan = $array[str_pad($xBulan, 2, '0', STR_PAD_LEFT)];
        $this->load->model('modeltahunanggaran');
        $rowtahun = $this->modeltahunanggaran->getDetailtahunanggaran($tahun);
        $this->load->model('modelrab');
        $rowrab = $this->modelrab->getDetailrab($edidrab);
        $arkode = explode(".",$rowrab->kodeRAB);
        $post = '';
        $xidrab = "";
        for($i=0;$i<count($arkode);$i++){
           $xidrab .= $arkode[$i];
           $rowrab = $this->modelrab->getDetailrabbykode($xidrab);
           if(!empty ($rowrab->JudulRAB)){
             $post .="-". $rowrab->JudulRAB;
           }
           $xidrab .=".";
        }
        $judul = "PERPUSTAKAAN UNIVERSITAS SANATA DHARMA  <br />" .
                 "DATA PENGELUARAN   <br />" .
                 " POS : ".substr($post, 1)."<br />".
                 "BULAN " . $nmbulan . " " . $rowtahun->TahunAnggaran . "<br />";
        //"POS : ".$rowunitkerja->NmUnitKerja;
        return '<div id="tablereport" name ="tablereport" class="tablereport" style="width:700px;" align="center"><h3>' . $judul . ' </h3>' . $xBufresult . '</div>';
    }

    function getrow($xbulan, $tahun,$edidrab) {
        //Prepare data untuk membuat reporttable
        /*
         *
          1. buat array untuk row
         *  2. tambahkan cell
         */

        $this->load->model('modelrealisasirab');
        $xQuery = $this->modelrealisasirab->getlistrealisasirabreport($xbulan, $tahun,$edidrab);
        $array = getArrayBulan();
        $nmbulan = $array[str_pad($xbulan, 2, '0', STR_PAD_LEFT)];
        $arrayrow[0] = '<td><b>NO</b></td><td><b>Tanggal</b></td><td width="500px"><b>Keterangan</b></td><td><b>Jumlah</b></td> ';
        $i = 1;
        
        
        $Totalsaldo = 0;
        

        if (!empty($xQuery)) {
            foreach ($xQuery->result() as $row) {
                $arrayrow[$i] = '<td>'.$i.'. </td><td>'.$row->tanggal.'</td><td width="500px">'.$row->keterangan.'</td><td align="right">'.number_format($row->nominal, 0, '.', ',').'</td> ';
                $Totalsaldo += $row->nominal;
                $i++;
            }
        }

        $arrayrow[$i] = '<td><b>_</b></td><td><b>_</b></td><td width="500px"><b>Jumlah</b></td><td align="right"><b>'.number_format($Totalsaldo, 0, '.', ',').'</b></td> ';

        return $arrayrow;
    }

}

?>