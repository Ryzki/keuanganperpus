<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : anggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrlaprekapfcpribadi extends CI_Controller {
    
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
        $xForm = '<div id="stylized" class="myform"><h3>Rekapitulasi Penggunan Fotokopi,Print,Jilid Untuk Keperluan PRIBADI </h3>' . form_open_multipart('ctranggotabaca/inserttable', array('id' => 'form', 'name' => 'form')) . '<div class="garis"></div>';
        $xAddJs = link_tag('resource/js/themes/base/jquery.ui.all.css') .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />'.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.core.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.widget.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.datepicker.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/thickbox.js"></script>'.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxfotokopibulan.js"></script>
                 <script language="javascript" type="text/javascript">

                    setawalpribadi();

                 </script>   ';
//'<div id="tablereport" name ="tablereport"> </div>'
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormReport($xidx), '<div id="tablereport" name ="tablereport"> </div>', '', $xAddJs, '');
    }

    function setDetailFormReport($xidx) {
        $this->load->helper('form');
        $this->load->helper('common');
        $this->load->model('modeljenistransaksi');
        $this->load->model('modelunitkerja');
        $this->load->model('modellokasi');
        $xStrTahun = $this->session->userdata('tanggal');

        $xBufResult = setForm('edBulan', 'Bulan', form_dropdown('edBulan', getArrayBulan(),'0','id="edBulan" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edTahun', 'Tahun', form_input(getArrayObj('edTahun',  substr($xStrTahun, 0, 4), '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidlokasi', 'Lokasi', form_dropdown('edidlokasi', $this->modellokasi->getArrayListlokasi(), '0', 'id="edidlokasi" width="150px"')) . '<div class="spacer"></div>';
        //$xBufResult .= setForm('edunitkerja', 'Unit Kerja', form_dropdown('edunitkerja', $this->modelunitkerja->getArrayListunitkerja(), '0', 'id="edunitkerja" width="150px" onchange="onCbJenisTransksiChange();"')) . '<div class="spacer"></div>';
        //$xBufResult .= setForm('edidstatusPLU', 'Status PLU', form_dropdown('edidstatusPLU', $this->modelstatusplu->getArrayListstatusplu(), '0', 'id="edidstatusPLU" width="150px"')) . '<div class="spacer"></div>';
        
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Tampil Data', 'onclick="dotampillaporanrekappribadi(false);"') . form_button('btNew', 'Export Ke Excel', 'onclick="dotampillaporanrekappribadi(true);"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function dotampillaporan(){
     $this->load->helper('json');
     $xBulan = $_POST['edbulan'];
     $xTahun = $_POST['edtahun'];
     $edidlokasi = $_POST['edidlokasi'];
     
     $this->json_data['data'] =$this->getReport($xBulan,$xTahun,$edidlokasi);
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
    function getReport($xBulan,$tahun,$edidlokasi) {
        //$xIdEdit = $_POST['edidx'];
        $this->load->helper('form');
        $this->load->helper('common');

        $arrayrow = $this->getrow($xBulan,$tahun,$edidlokasi);
        $xBufresult ='<table>';
        for($i=0;$i<count($arrayrow);$i++){
            $xBufresult .= '<tr>'. $arrayrow[$i].'</tr>';
        }
        $xBufresult .='</table>';
       $array = getArrayBulan();
       $nmbulan =  $array[str_pad($xBulan, 2, '0',STR_PAD_LEFT)];
        $lokasi = $this->session->userdata('idlokasi');
        $this->load->model('modellokasi');
        $rowlokasi = $this->modellokasi->getDetaillokasi($edidlokasi);
//        $this->load->model('modelunitkerja');
//        $rowunitkerja = $this->modelunitkerja->getDetailunitkerja($edunitkerja);

        $judul = "LAPORAN KEUANGAN FOTO KOPI DAN PRINT <br />".
                 "KEPERLUAN PRIBADI DAN POTONG GAJI <br />".
                 "DI PERPUSTAKAAN USD ".$rowlokasi->NmLokasi."<br />".
                 "BULAN ".$nmbulan." ".$tahun."<br />";
                 //"POS : ".$rowunitkerja->NmUnitKerja;
        return '<div id="tablereport" name ="tablereport" class="tablereport" style="width:700px;" align="center"><h3>'.$judul.' </h3>' . $xBufresult . '</div>';
    }

    function getvalcellfromdatabase($xidplu,$xtanggal,$xBulan,$tahun,$edidlokasi){
        //digunakan untukmenent
        $this->load->model('modeltransaksi');

       return $this->modeltransaksi->getlembarsumrekappribadi($xidplu,$xtanggal,$xBulan,$tahun,$edidlokasi);
    }


    function addkolom($xarraydata,$xidplu,$xarrayhari,$xBulan,$xArrayTotalStatus,$xArrayTotal,$tahun,$edidlokasi){
      //digunakan untukmenentukan tanggal
      //Tambahakan Nilai I untuk rowHeader
      /*$xBufArray[0] = '';
       $xBufArray[1] = '';
       $xBufArray[2] = $xidplu;*/

        $this->load->model('modelprodukplu');
        $rowplu = $this->modelprodukplu->getDetailprodukplubykode($xidplu);
        $xJmlLembar = 0;
        
        for($i=0;$i<count($xarrayhari);$i++){
           $lembar =  $this->getvalcellfromdatabase($xidplu, $xarrayhari[$i],$xBulan,$tahun,$edidlokasi);
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


    function getrow($xbulan,$tahun,$edidlokasi){
        //Prepare data untuk membuat reporttable
        /*
       *
          1. buat array untuk row
       *  2. tambahkan cell
       */
             $xArrayTotal[0] = "Jumlah";
             $xArrayTotalFC[0] = "Jumlah";
             $xArrayTotalPrintColor[0] = "Jumlah";
             $xArrayTotalPrintBiasa[0] = "Jumlah";
             $xArrayTotalJilid[0] = "Jumlah";
             
       $this->load->model('modeltransaksi');
       $xQuery = $this->modeltransaksi->getarraypribadi($xbulan,$tahun,$edidlokasi);
       $arrayrow[0] = '<td>Nama Pengguna</td><td>NPP</td>';
       $i=1;
      $xarrayhari[0]=0;
       if(!empty($xQuery) ){
           foreach($xQuery->result() as $row){
             $this->load->model('modelpegawai');
             $rowpeg = $this->modelpegawai->getDetailpegawai($row->idpegawai);
             //echo "Test".$ArrayHari[$i]; hari,idpegawai,idunitkerja $this->modeltransaksi->getnamapegawairekapdinas($xBulan,$tahun,$edidlokasi,$edunitkerja,$hari)
             $arrayrow[$i]= '<td>'.$rowpeg->Nama.'</td><td>'.$rowpeg->npp.'</td>';
             $xarrayhari[$i]=$row->idpegawai;
             $xArrayTotal[$i] = 0;
             $xArrayTotalFC[$i] = 0;
             $xArrayTotalPrintColor[$i] = 0;
             $xArrayTotalPrintBiasa[$i] = 0;
             $xArrayTotalJilid[$i] = 0;
            $i++;

        }
       }
       //$i++;
       $xArrayTotal[$i] = "Jumlah";
             $xArrayTotalFC[$i] = "Jumlah";
             $xArrayTotalPrintColor[$i] = "Jumlah";
             $xArrayTotalPrintBiasa[$i] = "Jumlah";
             $xArrayTotalJilid[$i] = "Jumlah";
       $arrayrow[$i]= '<td></td><td>Jumlah</td>';
       $xarrayhari[$i]=0;
       
       $xarrayFC = $this->modeltransaksi->getarraystatusplurekappribadi($xbulan,"1",$tahun,$edidlokasi);

       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$xarrayhari ,$xbulan,$xArrayTotalFC,$xArrayTotal,$tahun,$edidlokasi);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalFC = $xBufarrayrow[1];
            $xArrayTotal = $xBufarrayrow[2];
         }
       } else{
         $xArrayTotalFC = null;
       }

       if($xArrayTotalFC!=null)
        $arrayrow = $this->addTotal($arrayrow, $xarrayhari, $xArrayTotalFC);

       /****** Print *///
       $xarrayFC = $this->modeltransaksi->getarraystatusplurekappribadi($xbulan,"3",$tahun,$edidlokasi);

       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$xarrayhari ,$xbulan,$xArrayTotalPrintBiasa,$xArrayTotal,$tahun,$edidlokasi,$edunitkerja);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalPrintBiasa = $xBufarrayrow[1];
            $xArrayTotal = $xBufarrayrow[2];
         }
       }else{
          $xArrayTotalPrintBiasa=null ;
       }
       if($xArrayTotalPrintBiasa!=null)
       $arrayrow = $this->addTotal($arrayrow, $xarrayhari, $xArrayTotalPrintBiasa);

       $xarrayFC = $this->modeltransaksi->getarraystatusplurekappribadi($xbulan,"2",$tahun,$edidlokasi);
       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$xarrayhari ,$xbulan,$xArrayTotalPrintColor,$xArrayTotal,$tahun,$edidlokasi,$edunitkerja);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalPrintColor = $xBufarrayrow[1];
            $xArrayTotal = $xBufarrayrow[2];
         }
       } else{
         $xArrayTotalPrintColor = null;
       }

       if($xArrayTotalPrintColor!=null)
       $arrayrow = $this->addTotal($arrayrow, $xarrayhari, $xArrayTotalPrintColor);

       //******************** Jilid
       $xarrayFC = $this->modeltransaksi->getarraystatusplurekappribadi($xbulan,"4",$tahun,$edidlokasi);

       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$xarrayhari ,$xbulan,$xArrayTotalJilid,$xArrayTotal,$tahun,$edidlokasi);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalJilid = $xBufarrayrow[1];
            $xArrayTotal = $xBufarrayrow[2];
         }
       }else{
         $xArrayTotalJilid = null;    
       }

       if($xArrayTotalJilid!=null)
         $arrayrow = $this->addTotal($arrayrow, $xarrayhari, $xArrayTotalJilid);

       $arrayrow = $this->addTotal($arrayrow, $xarrayhari, $xArrayTotal);


    return $arrayrow;
    }


    

}

?>