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
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />'.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.core.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.widget.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.datepicker.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/thickbox.js"></script>'.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxfotokopibulan.js"></script>'.
                '<script language="javascript" type="text/javascript">
                    setawalrekapfotokopiperbulan();
                 </script>   ';
        //'<div id="tablereport" name ="tablereport"> </div>' $this->getReport('4','2011','2')
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormReport($xidx), '<div id="tablereport" name ="tablereport"> </div>', '', $xAddJs, '');
    }

    function setDetailFormReport($xidx) {
        $this->load->helper('form');
        $this->load->helper('common');
        $this->load->model('modellokasi');
        $xStrTahun = $this->session->userdata('tanggal');

        $xBufResult = setForm('edBulan', 'Bulan', form_dropdown('edBulan', getArrayBulan(),'0','id="edBulan" width="150px"')) ;
        $xBufResult .= setForm('edTahun', 'Tahun', form_input(getArrayObj('edTahun',  substr($xStrTahun, 0, 4), '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidlokasi', 'Lokasi', form_dropdown('edidlokasi', $this->modellokasi->getArrayListlokasi(), '0', 'id="edidlokasi" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Tampil Data', 'onclick="dotampillaporanfotokopibulan(false);"') . form_button('btNew', 'Export Ke Excel', 'onclick="dotampillaporanfotokopibulan(true);"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function  dotampillaporan(){
     $xBulan = $_POST['edbulan'];
     $xTahun = $_POST['edtahun'];
     $edidlokasi = $_POST['edidlokasi'];
     $this->load->helper('json');
     $this->json_data['data'] =$this->getReport($xBulan,$xTahun,$edidlokasi);
     echo json_encode($this->json_data);
    }

    function getReport($xBulan,$tahun,$xidlokasi) {
        //$xIdEdit = $_POST['edidx'];
        $this->load->helper('form');
        $this->load->helper('common');

        $arrayrow = $this->getrow($xBulan,$tahun,$xidlokasi);
        $xBufresult ='<table border="1px solid">';
        for($i=0;$i<count($arrayrow);$i++){
            $xBufresult .= '<tr>'. $arrayrow[$i].'</tr>';
        }
        $xBufresult .='</table>';
        $array = getArrayBulan();
       $nmbulan =  $array[str_pad($xBulan, 2, '0',STR_PAD_LEFT)];
        
        $this->load->model('modellokasi');
        $rowlokasi = $this->modellokasi->getDetaillokasi($xidlokasi);

        $judul = "LAPORAN KEUANGAN FOTOKOPI,PRINT DAN JILID HARIAN ".$rowlokasi->NmLokasi.'<br />'.
                 "PERPUSTAKAAN UNIVERSITAS SANATA DHARMA <br />".
                 "BULAN ".$nmbulan." ".$tahun;
        return '<div id="tablereport" name ="tablereport" class="tablereport" style="width:700px;" align="center"><h3>'.$judul.' </h3>' . $xBufresult . '</div>';
    }

    function getvalcellfromdatabase($xidplu,$xtanggal,$xBulan,$tahun,$xidlokasi){
        //digunakan untukmenent
        $this->load->model('modeltransaksi');

       return $this->modeltransaksi->getlembarsum($xidplu,$xtanggal,$xBulan,$tahun,$xidlokasi);
    }


    function addkolom($xarraydata,$xidplu,$xarrayhari,$xBulan,$xArrayTotalStatus,$xArrayTotal,$tahun,$xidlokasi){
      //digunakan untukmenentukan tanggal
      //Tambahakan Nilai I untuk rowHeader
      /*$xBufArray[0] = '';
       $xBufArray[1] = '';
       $xBufArray[2] = $xidplu;*/

        $this->load->model('modelprodukplu');
        $rowplu = $this->modelprodukplu->getDetailprodukplubykode($xidplu);
        $xJmlLembar = 0;
        
        for($i=0;$i<count($xarrayhari);$i++){
           $lembar =  $this->getvalcellfromdatabase($xidplu, $xarrayhari[$i],$xBulan,$tahun,$xidlokasi);
           //$this->arrayTotalFC[$i] +=  $lembar;
           
                         
           $xArrayTotalStatus[$i] += ($lembar*$rowplu->harga);
           $xArrayTotal[$i] += ($lembar*$rowplu->harga);
           
           $xBufArray[$i] = $xarraydata[$i]. '<td align ="center">'. $lembar.'</td>';
           $xJmlLembar +=  $lembar;
        }

       $xBufArray[0] = $xarraydata[0].'<td align ="center">'.$rowplu->NamaProduk.'<br />Rp '.$rowplu->harga.'</td>';
       $xBufArray[count($xarrayhari)-1] = $xarraydata[count($xarrayhari)-1].'<td align ="center">'.$xJmlLembar.'</td>';

       
        $xArrayResult[0] = $xBufArray;
        if($xJmlLembar ==0){
           $xArrayResult[1] = null;
        } else
        {
            $xArrayResult[1] = $xArrayTotalStatus;

        }
        $xArrayResult[2] = $xArrayTotal;

        return $xArrayResult;

    }

    function addTotal($xarraydata,$xarrayhari,$xArrayTotal){
       $xBufTotal =0;
        for($i=0;$i<count($xarrayhari);$i++){
           
           $xBufArray[$i] = $xarraydata[$i]. '<td align ="right">'. number_format($xArrayTotal[$i], 0, '.', ',').'</td>';
           $xBufTotal += $xArrayTotal[$i];

        }
        $xBufArray[0] = $xarraydata[0].'<td align ="center">Total<br />Rp</td>';
        $xBufArray[count($xarrayhari)-1] = $xarraydata[count($xarrayhari)-1].'<td align ="right">'.number_format($xBufTotal, 0, '.', ',').'</td>';
      

        return $xBufArray;

    }


    function getrow($xbulan,$tahun,$xidlokasi){
        //Prepare data untuk membuat reporttable
        /*
       *
          1. buat array untuk row
       *  2. tambahkan cell
       */
       $this->load->model('modeltransaksi');
       $ArrayHari = $this->modeltransaksi->getarrayhari($xbulan,$tahun,$xidlokasi);
       if(!empty($ArrayHari) ){
         for($i=0;$i<count($ArrayHari);$i++){
             //echo "Test".$ArrayHari[$i];
             if ($i==0){
                 $arrayrow[$i]= '<td>'.$ArrayHari[$i].'</td>';
             }else
             { $arrayrow[$i]= '<td>'.$ArrayHari[$i].'</td>';}
             $xArrayTotal[$i] = 0;
             $xArrayTotalFC[$i] = 0;
             $xArrayTotalPrintColor[$i] = 0;
             $xArrayTotalPrintBiasa[$i] = 0;
             $xArrayTotalJilid[$i] = 0;

        }
       }
       
       $xarrayFC = $this->modeltransaksi->getarraystatusplu($xbulan,"1",$tahun,$xidlokasi);

       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$ArrayHari ,$xbulan,$xArrayTotalFC,$xArrayTotal,$tahun,$xidlokasi);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalFC = $xBufarrayrow[1];
            $xArrayTotal = $xBufarrayrow[2];
         }
       }  else {
           $xArrayTotalFC = null;
       }

       if($xArrayTotalFC!=null)
       $arrayrow = $this->addTotal($arrayrow, $ArrayHari, $xArrayTotalFC);

       /****** Print *///
       $xarrayFC = $this->modeltransaksi->getarraystatusplu($xbulan,"3",$tahun,$xidlokasi);

       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$ArrayHari ,$xbulan,$xArrayTotalPrintBiasa,$xArrayTotal,$tahun,$xidlokasi);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalPrintBiasa = $xBufarrayrow[1];
            $xArrayTotal = $xBufarrayrow[2];
         }
       } else {
         $xArrayTotalPrintBiasa=null;
       }

       if($xArrayTotalPrintBiasa!=null)
       $arrayrow = $this->addTotal($arrayrow, $ArrayHari, $xArrayTotalPrintBiasa);

       $xarrayFC = $this->modeltransaksi->getarraystatusplu($xbulan,"2",$tahun,$xidlokasi);

       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$ArrayHari ,$xbulan,$xArrayTotalPrintColor,$xArrayTotal,$tahun,$xidlokasi);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalPrintColor = $xBufarrayrow[1];
            $xArrayTotal = $xBufarrayrow[2];
         }
       }  else{
           $xArrayTotalPrintColor=null;
       }

       if($xArrayTotalPrintColor!=null)
       $arrayrow = $this->addTotal($arrayrow, $ArrayHari, $xArrayTotalPrintColor);

       //******************** Jilid
       $xarrayFC = $this->modeltransaksi->getarraystatusplu($xbulan,"4",$tahun,$xidlokasi);

       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$ArrayHari ,$xbulan,$xArrayTotalJilid,$xArrayTotal,$tahun,$xidlokasi);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalJilid = $xBufarrayrow[1];
            $xArrayTotal = $xBufarrayrow[2];
         }
       }  else {
          $xArrayTotalJilid=null;
       }

       if($xArrayTotalJilid!=null)
       $arrayrow = $this->addTotal($arrayrow, $ArrayHari, $xArrayTotalJilid);

       $arrayrow = $this->addTotal($arrayrow, $ArrayHari, $xArrayTotal);


    return $arrayrow;
    }
}

?>