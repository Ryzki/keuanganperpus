<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : anggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrlaprealisasirab extends CI_Controller {
    
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
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />'.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.core.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.widget.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.datepicker.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/thickbox.js"></script>'.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxrab.js"></script>
                 <script language="javascript" type="text/javascript">

                    setawalpribadi();

                 </script>   ';
//'<div id="tablereport" name ="tablereport"> </div>' 
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormReport($xidx),'<div id="tablereport" name ="tablereport"> </div>'  , '', $xAddJs, '');
    }

    function setDetailFormReport($xidx) {
        $this->load->helper('form');
        $this->load->helper('common');
        $this->load->model('modeltahunanggaran');
        $xStrTahun = $this->session->userdata('tanggal');

        $xBufResult = setForm('edBulan', 'Bulan', form_dropdown('edBulan', getArrayBulan(),'0','id="edBulan" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidtahunanggaran', 'Tahun Anggaran', form_dropdown('edidtahunanggaran', $this->modeltahunanggaran->getArrayListtahunanggaran(), '0', 'id="edidtahunanggaran" width="150px" ')) . '<div class="spacer"></div>';
        
        //$xBufResult .= setForm('edunitkerja', 'Unit Kerja', form_dropdown('edunitkerja', $this->modelunitkerja->getArrayListunitkerja(), '0', 'id="edunitkerja" width="150px" onchange="onCbJenisTransksiChange();"')) . '<div class="spacer"></div>';
        //$xBufResult .= setForm('edidstatusPLU', 'Status PLU', form_dropdown('edidstatusPLU', $this->modelstatusplu->getArrayListstatusplu(), '0', 'id="edidstatusPLU" width="150px"')) . '<div class="spacer"></div>';
        
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Tampil Data', 'onclick="dotampillaporanrab(false);"') . form_button('btNew', 'Export Ke Excel', 'onclick="dotampillaporanrab(true);"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function dotampillaporan(){
     $this->load->helper('json');
     $xBulan = $_POST['edbulan'];
     $xTahun = $_POST['edidtahunanggaran'];
     $this->json_data['data'] =$this->getReport($xBulan,$xTahun);
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
    function getReport($xBulan,$tahun) {
        //$xIdEdit = $_POST['edidx'];
        $this->load->helper('form');
        $this->load->helper('common');

        $arrayrow = $this->getrow($xBulan,$tahun);
        $xBufresult ='<table>';
        for($i=0;$i<count($arrayrow);$i++){
            $xBufresult .= '<tr>'. $arrayrow[$i].'</tr>';
        }
        $xBufresult .='</table>';
       $array = getArrayBulan();
       $nmbulan =  $array[str_pad($xBulan, 2, '0',STR_PAD_LEFT)];
       $this->load->model('modeltahunanggaran');
       $rowtahun= $this->modeltahunanggaran->getDetailtahunanggaran($tahun);
        $judul = "LAPORAN  <br />".
                 "REALISASI RENCANA ANGGARAN BELANJA  <br />".
                            "BULAN ".$nmbulan." ".$rowtahun->TahunAnggaran."<br />";
                 //"POS : ".$rowunitkerja->NmUnitKerja;
        return '<div id="tablereport" name ="tablereport" class="tablereport" style="width:700px;" align="center"><h3>'.$judul.' </h3>' . $xBufresult . '</div>';
    }


    function getrow($xbulan,$tahun){
        //Prepare data untuk membuat reporttable
        /*
       *
          1. buat array untuk row
       *  2. tambahkan cell
       */
                          
       $this->load->model('modelrab');
       $xQuery = $this->modelrab->getListraball();
       $array = getArrayBulan();
       $nmbulan =  $array[str_pad($xbulan, 2, '0',STR_PAD_LEFT)];
       $arrayrow[0] = '<td><b>Kode RAB</b></td><td><b>KETERANGAN</b></td><td><b>POS RAB</b></td><td><b>Realisasi <br />Bulan '.$nmbulan.' </b></td> <td><b>Realisasi <br/>Sampai '.$nmbulan.'</b></td> <td><b>Saldo</b></td> <td><b>Prosentase <br /> Realisasi</b></td>';
       $i=1;
      $xarrayhari[0]=0;
                 $Totalposting = 0;
                 $Totalbulan =0;
                 $Totalsampaibulan =0;
                 $Totalsaldo = 0;
                 $Totalprosentase = 0;

       if(!empty($xQuery) ){
           foreach($xQuery->result() as $row){
             $this->load->model('modelpostingrab');
             $rowposting = $this->modelpostingrab->getDetailpostingrabbyidrabtahun($row->idx,$tahun);
             $this->load->model('modelrealisasirab');
             $rowbulan = $this->modelrealisasirab->getrealisasibulan($xbulan,$tahun,$row->idx);
             $rowsampaibulan = $this->modelrealisasirab->getrealisasisampaibulan($xbulan,$tahun,$row->idx);

                 $posting = 0;
                 $bulan =0;
                 $sampaibulan =0;
                 $saldo = 0;
                 $prosentase = 0;


             if(!empty ($rowposting->nominalposting)){
                 $posting = $rowposting->nominalposting;
             } else{
                 $posting = '';
             }

             if(!empty ($rowbulan->nominal))
             {
               $bulan =$rowbulan->nominal;
             }

             if(!empty ($rowsampaibulan->nominal))
             {
               $sampaibulan =$rowsampaibulan->nominal;
             }

             if(empty ($posting)){
                 $posting = '_';
                 $bulan ='_';
                 $sampaibulan ='_';
                 $saldo = '_';
                 $prosentase = '_';
             } else{
                 $Totalposting += $posting;
                 $Totalbulan += $bulan;
                 $Totalsampaibulan +=$sampaibulan;
                 


                 $saldo = $posting - $sampaibulan ;
                 $Totalsaldo +=$saldo;
                 
                 $prosentase = ($sampaibulan/$posting)*100;
                 $posting = number_format($posting, 0, '.', ',');
                 $bulan =number_format($bulan, 0, '.', ',');
                 $sampaibulan =number_format($sampaibulan, 0, '.', ',');
                 $saldo = number_format($saldo, 0, '.', ',');
                 $prosentase = number_format($prosentase, 2, '.', ',')."%";

             }


             //echo "Test".$ArrayHari[$i]; hari,idpegawai,idunitkerja $this->modeltransaksi->getnamapegawairekapdinas($xBulan,$tahun,$edidlokasi,$edunitkerja,$hari)
             $arrayrow[$i]= '<td>'.$row->kodeRAB.'</td><td>'.str_pad($row->JudulRAB, strlen($row->JudulRAB)+strlen($row->kodeRAB), "__", STR_PAD_LEFT) .'</td><td align ="right">'.$posting.
                            '</td><td align ="right">'.$bulan.'</td><td align ="right">'.$sampaibulan.'</td><td align ="right">'.$saldo
                           .'</td><td align ="center">'.$prosentase.' </td>';
             
            $i++;

        }
       }
       
       $arrayrow[$i]= '<td>_</td><td><b>Jumlah</b></td><td align ="right"><b>'.number_format($Totalposting, 0, '.', ',').
                            '</b></td><td align ="right"><b>'.number_format($Totalbulan, 0, '.', ',').'</b></td><td align ="right"><b>'.number_format($Totalsampaibulan, 0, '.', ',').
                            '</b></td><td align ="right"><b>'.number_format($Totalsaldo, 0, '.', ',').'</b></td><td align ="center"><b>'.number_format(($Totalsampaibulan/$Totalposting)*100, 2, '.', ',')."%".'</b> </td>';


    return $arrayrow;
    }


    

}

?>