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
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxfotokopibulan.js"></script>';

        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormReport($xidx), $this->getReport('4','2011'), '', $xAddJs, '');
    }

    function setDetailFormReport($xidx) {
        $this->load->helper('form');
        $this->load->helper('common');
        //$this->load->model('modeljenisanggotabaca');
        $xStrTahun = $this->session->userdata('tanggal');

        $xBufResult = setForm('edBulan', 'Bulan', form_dropdown('edBulan', getArrayBulan(),'0','id="edBulan" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edTahun', 'Tahun', form_input(getArrayObj('edTahun',  substr($xStrTahun, 0, 4), '100'))) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Tampil Data', 'alt="#tablereport?height=300&width=400&inlineId=myOnPageContent" title="add a caption to title attribute / or leave blank" class="thickbox" type="button" value="Show"   onclick="dotampillaporan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
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

        $judul = "LAPORAN KEUANGAN FOTOKOPI,PRINT DAN JILID HARIAN ".$rowlokasi->NmLokasi.'<br />'.
                 "PERPUSTAKAAN UNIVERSITAS SANATA DHARMA <br />".
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
       $ArrayHari = $this->modeltransaksi->getarrayhari($xbulan,$tahun);
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
       
       $xarrayFC = $this->modeltransaksi->getarraystatusplu($xbulan,"1",$tahun);

       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$ArrayHari ,$xbulan,$xArrayTotalFC,$xArrayTotal,$tahun);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalFC = $xBufarrayrow[1];
         }
       }
       if($xArrayTotalFC!=null)
       $arrayrow = $this->addTotal($arrayrow, $ArrayHari, $xArrayTotalFC);

       /****** Print *///
       $xarrayFC = $this->modeltransaksi->getarraystatusplu($xbulan,"3",$tahun);

       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$ArrayHari ,$xbulan,$xArrayTotalPrintBiasa,$xArrayTotal,$tahun);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalPrintBiasa = $xBufarrayrow[1];
         }
       }
       if($xArrayTotalPrintBiasa!=null)
       $arrayrow = $this->addTotal($arrayrow, $ArrayHari, $xArrayTotalPrintBiasa);

       $xarrayFC = $this->modeltransaksi->getarraystatusplu($xbulan,"2",$tahun);

       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$ArrayHari ,$xbulan,$xArrayTotalPrintColor,$xArrayTotal,$tahun);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalPrintColor = $xBufarrayrow[1];
         }
       }

       if($xArrayTotalPrintColor!=null)
       $arrayrow = $this->addTotal($arrayrow, $ArrayHari, $xArrayTotalPrintColor);

       //******************** Jilid
       $xarrayFC = $this->modeltransaksi->getarraystatusplu($xbulan,"4",$tahun);

       if(!empty($xarrayFC) ){
         for($i=0;$i<count($xarrayFC);$i++){
            $xBufarrayrow = $this->addkolom($arrayrow, $xarrayFC[$i],$ArrayHari ,$xbulan,$xArrayTotalJilid,$xArrayTotal,$tahun);
            $arrayrow = $xBufarrayrow[0];
            $xArrayTotalJilid = $xBufarrayrow[1];
         }
       }
       if($xArrayTotalJilid!=null)
       $arrayrow = $this->addTotal($arrayrow, $ArrayHari, $xArrayTotalJilid);


    return $arrayrow;
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