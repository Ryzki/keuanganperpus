<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : anggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrlaprekapfcdendaab extends CI_Controller {
    
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
        $xForm = '<div id="stylized" class="myform"><h3>LAPORAN PEMASUKKAN : FOTOKOPI,PRINT,DENDA, DAN ANGGOTA BACA  </h3>' . form_open_multipart('ctranggotabaca/inserttable', array('id' => 'form', 'name' => 'form')) . '<div class="garis"></div>';
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
        //'<div id="tablereport" name ="tablereport"> </div>'     $this->getReport('4','2011')
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormReport($xidx), '<div id="tablereport" name ="tablereport"> </div>' , '', $xAddJs, '');
    }

    function setDetailFormReport($xidx) {
        $this->load->helper('form');
        $this->load->helper('common');
        //$this->load->model('modeljenisanggotabaca');
        $this->load->model('modellokasi');
        $xStrTahun = $this->session->userdata('tanggal');

        $xBufResult = setForm('edBulan', 'Bulan', form_dropdown('edBulan', getArrayBulan(),'0','id="edBulan" width="150px"')) ;
        $xBufResult .= setForm('edTahun', 'Tahun', form_input(getArrayObj('edTahun',  substr($xStrTahun, 0, 4), '100'))) . '<div class="spacer"></div>';
        //$xBufResult .= setForm('edidlokasi', 'Lokasi', form_dropdown('edidlokasi', $this->modellokasi->getArrayListlokasi(), '0', 'id="edidlokasi" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Tampil Data', 'onclick="dotampillaporanrekap(false);"') . form_button('btNew', 'Export Ke Excel', 'onclick="dotampillaporanrekap(true);"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function  dotampillaporan(){
     $xBulan = $_POST['edbulan'];
     $xTahun = $_POST['edtahun'];
     $this->load->helper('json');
     $this->json_data['data'] =$this->getReport($xBulan,$xTahun);
     echo json_encode($this->json_data);
    }

    function getReport($xBulan,$tahun) {
        //$xIdEdit = $_POST['edidx'];
        $this->load->helper('form');
        $this->load->helper('common');

        $arrayrow = $this->getrow($xBulan,$tahun);
        $xBufresult ='<table border="1px solid">';
        for($i=0;$i<count($arrayrow);$i++){
            $xBufresult .= '<tr>'. $arrayrow[$i].'</tr>';
        }
        $xBufresult .='</table>';
        $array = getArrayBulan();
       $nmbulan =  $array[str_pad($xBulan, 2, '0',STR_PAD_LEFT)];
        $lokasi = $this->session->userdata('idlokasi');
        $this->load->model('modellokasi');
        $rowlokasi = $this->modellokasi->getDetaillokasi($lokasi);

        $judul = "PERPUSTAKAAN UNIVERSITAS SANATA DHARMA <br />".
                 "DATA PEMASUKKAN : FOTOKOPI,PRINT,DENDA, DAN ANGGOTA BACA <br />".
                 "BULAN ".$nmbulan." ".$tahun;
        return '<div id="tablereport" name ="tablereport" class="tablereport" style="width:700px;" align="center"><h3>'.$judul.' </h3>' . $xBufresult . '</div>';
    }

    function getvalcellfromdatabase($xidplu,$xtanggal,$xBulan,$tahun){
        //digunakan untukmenent
        $this->load->model('modeltransaksi');

       return $this->modeltransaksi->getlembarsum($xidplu,$xtanggal,$xBulan,$tahun);
    }


    function addkolom($xarraydata,$xidplu,$xarrayhari,$xBulan,$xArrayTotalStatus,$xArrayTotal,$tahun){
      //digunakan untukmenentukan tanggal
      //Tambahakan Nilai I untuk rowHeader
      /*$xBufArray[0] = '';
       $xBufArray[1] = '';
       $xBufArray[2] = $xidplu;*/

        $this->load->model('modelprodukplu');
        $rowplu = $this->modelprodukplu->getDetailprodukplubykode($xidplu);
        $xJmlLembar = 0;
        
        for($i=0;$i<count($xarrayhari);$i++){
           $lembar =  $this->getvalcellfromdatabase($xidplu, $xarrayhari[$i],$xBulan,$tahun);
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


    function getrow($xbulan,$tahun){
        //Prepare data untuk membuat reporttable
        /*
       *
          1. buat array untuk row
       *  2. tambahkan cell
       */
       $this->load->model('modeltransaksi');
       $xQuery = $this->modeltransaksi->getRekapAll($xbulan,$tahun);
       $arrayrow[0] = '<td>NO</td>';
       $arrayrow[0] .= '<td>Tanggal</td>';
       $arrayrow[0] .= '<td width="500px">Keterangan</td>';
       $arrayrow[0] .= '<td>Jumlah</td>';
       $i=1;
       $jumlahtotal =0;
       foreach ($xQuery->result() as $row) {
            $arrayrow[$i]= '<td>'.$i.'</td>';
            $arrayrow[$i].= '<td>'.$row->tanggal.'</td>';
            if($row->idjenistransaksi=='3'){
               if(($row->idjnspengguna=='2')|| ($row->idjnspengguna=='3')){
                   $arrayrow[$i].= '<td width="500px">'.$row->statusPLU.' '.$row->pengg.'</td>';
               } else
               {
                  $arrayrow[$i].= '<td width="500px">'.$row->statusPLU.'</td>';
               }
            } else{
               $arrayrow[$i].= '<td width="500px">'.$row->jnstrx.'</td>';
            }
            $arrayrow[$i].= '<td align="right">'.number_format($row->jumlah, 0, '.', ',').'</td>';
            $jumlahtotal +=$row->jumlah;
            $i++;
        }

        $this->load->model('modelsetoran');
        $xQuery = $this->modelsetoran->getSumSetoranBulan($xbulan,$tahun);
        
            $arrayrow[$i]= '<td> </td>';
            $arrayrow[$i].= '<td> </td>';
            $arrayrow[$i].= '<td>  </td>';
            $arrayrow[$i].= '<td> </td>';
        $i++;
            $arrayrow[$i]= '<td> </td>';
            $arrayrow[$i].= '<td> </td>';
            $arrayrow[$i].= '<td>Jumlah  </td>';
            $arrayrow[$i].= '<td align="right"> '.number_format($jumlahtotal, 0, '.', ',').' </td>';
         $i++;
      $TotalSetoran =0;
      foreach ($xQuery->result() as $row) {
            $arrayrow[$i]= '<td> </td>';
            $arrayrow[$i].= '<td> </td>';
            $arrayrow[$i].= '<td>Di Setor ke '.$row->NamaRekanan.' </td>';
            $arrayrow[$i].= '<td align="right"> '.number_format($row->jumlah, 0, '.', ',').' </td>';
            $TotalSetoran +=$row->jumlah;
       $i++;
      }

      
            $arrayrow[$i]= '<td> </td>';
            $arrayrow[$i].= '<td> </td>';
            $arrayrow[$i].= '<td>Jumlah  Pemasukkan Total</td>';
            $arrayrow[$i].= '<td align="right"> '.number_format($jumlahtotal-$TotalSetoran, 0, '.', ',').' </td>';
       $i++;
    return $arrayrow;
    }


    

}

?>