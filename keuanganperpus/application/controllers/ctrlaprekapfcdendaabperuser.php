<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : anggotabaca  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrlaprekapfcdendaabperuser extends CI_Controller {
    
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
        
        $xForm = '<div id="stylized" class="myform"><h3>Laporan Harian Transaksi Per USER SISTEM </h3>' . form_open_multipart('ctranggotabaca/inserttable', array('id' => 'form', 'name' => 'form')) . '<div class="garis"></div>';
        $xAddJs =link_tag('resource/js/themes/base/jquery.ui.all.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.core.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.widget.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.datepicker.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxdenda.js"></script>
                 <script language="javascript" type="text/javascript">

                    setcbuserbytanggal();

                 </script>   ';
         // $this->getReport("2011-05-02",'1','3')
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormReport($xidx),'<div id="tablereport" name ="tablereport"> </div>' , '', $xAddJs, '');
    }

    function setDetailFormReport($xidx) {
        $this->load->helper('form');
        $this->load->helper('common');
        $this->load->model('modeljenistransaksi');
        $this->load->model('modelstatusplu');
        $this->load->model('modeldenda');

        $xTanggal = $this->session->userdata('tanggal');
        $xBufResult = setForm('edtgldenda', 'Tanggal Transaksi', form_input(getArrayObj('edtgldenda', '', '120'),'','onchange="dotanggalchange();"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidUser', 'User Sistem', form_dropdown('edidUser',array("0"=>"-"),'0','id="edidUser"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidjenistransaksi', 'Jenis Transaksi', form_dropdown('edidjenistransaksi', $this->modeljenistransaksi->getArrayListjenistransaksi(), '0', 'id="edidjenistransaksi" width="150px" onchange="onCbJenisTransksiChange();"')) . '<div class="spacer"></div>';
        //$xBufResult .= setForm('edidstatusPLU', 'Status PLU', form_dropdown('edidstatusPLU', $this->modelstatusplu->getArrayListstatusplu(), '0', 'id="edidstatusPLU" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Tampil Data', 'onclick="dotampillaporanperuser(false);"') . form_button('btNew', 'Export Ke Excel', 'onclick="dotampillaporanperuser(true);"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function  setCbUserByTanggal(){
     $this->load->helper('json');
     $xTanggal = $_POST['edTanggal'];
      $this->load->model('modeldenda');
     $query = $this->modeldenda->getarrayuser($xTanggal);
     $xBufresult = '<option value="0">-</option>';
     foreach ($query->result() as $row) {
       $xBufresult .= '<option value="'.$row->iduser.'">'.$row->Nama.'</option>';
     }
      $this->json_data['idUser'] = $this->session->userdata('idpegawai');
      $this->json_data['data'] = $xBufresult;
      echo json_encode($this->json_data);
    }



    function  dotampillaporan(){
     $xTanggal = $_POST['edtgldenda'];
     $xUser = $_POST['edidUser'];
     $xJnsTransaksi = $_POST['edidjenistransaksi'];
     
     $this->load->helper('json');
     $this->json_data['data'] =$this->getReport($xTanggal,$xUser,$xJnsTransaksi);
     echo json_encode($this->json_data);
    }

    function getReport($xTanggal,$xUser,$xJnsTransaksi) {
        //$xIdEdit = $_POST['edidx'];
        $this->load->helper('form');
        $this->load->helper('common');

        $arrayrow = $this->getrow($xTanggal,$xUser,$xJnsTransaksi);
        $xBufresult ='<table border="1px solid">';
        for($i=0;$i<count($arrayrow);$i++){
            $xBufresult .= '<tr>'. $arrayrow[$i].'</tr>';
        }
        $xBufresult .='</table>';
        
            $this->load->model('modeljenistransaksi');
            $rowjudul = $this->modeljenistransaksi->getDetailjenistransaksi($xJnsTransaksi);
             $Judul = $rowjudul->jenistransaksi;
        

        $judul = "PERPUSTAKAAN UNIVERSITAS SANATA DHARMA <br />".
                 "LAPORAN HARIAN USER : ".$this->session->userdata('user')." <br />".
                 "TANGGAL ".$xTanggal." <br />".
                 "UNTUK TRANSAKSI ".$Judul." <br />";
        return '<div id="tablereport" name ="tablereport" class="tablereport" style="width:700px;" align="center"><h3>'.$judul.' </h3>' . $xBufresult . '</div>';
    }

    

    function getrow($xTanggal,$xUser,$xJnsTransaksi){
        //Prepare data untuk membuat reporttable
        /*
       *
          1. buat array untuk row
       *  2. tambahkan cell
       */

       if($xJnsTransaksi=="1"){
       $arrayrow[0] = '<td>NO</td>';
       $arrayrow[0] .= '<td>Jam</td>';
       $arrayrow[0] .= '<td width="500px">Nama</td>';
       $arrayrow[0] .= '<td>Nominal Denda</td>';
       $arrayrow[0] .= '<td>Lokasi</td>';
       $i=1;
       $jumlahtotal =0;
       $this->load->model('modeltransaksi');
       $xQuery = $this->modeltransaksi->getSQLDasarPertanggaldenda($xTanggal,$xUser);
       foreach ($xQuery->result() as $row) {
            $arrayrow[$i]= '<td>'.$i.'</td>';
            $arrayrow[$i].= '<td>'.$row->jam.'</td>';
            $arrayrow[$i].= '<td>('. $row->NIM.') '.$row->NamaMHS.'</td>';
            $arrayrow[$i].= '<td align="right">'.number_format($row->nominalpersatuan,0, '.', ',').'</td>';
            $arrayrow[$i].= '<td>'.$row->nmlokasi.'</td>';
            $jumlahtotal +=$row->nominalpersatuan;
            $i++;
        }
            $arrayrow[$i]= '<td> </td>';
            $arrayrow[$i].= '<td> </td>';
            
            $arrayrow[$i].= '<td>Jumlah  </td>';
            $arrayrow[$i].= '<td align="right"> '.number_format($jumlahtotal, 0, '.', ',').' </td>';
            $arrayrow[$i].= '<td> </td>';
       }

       if($xJnsTransaksi=="2"){
       $arrayrow[0] = '<td>NO</td>';
       $arrayrow[0] .= '<td>Jam</td>';
       $arrayrow[0] .= '<td width="500px">Nama</td>';
       $arrayrow[0] .= '<td>Nominal</td>';
       $arrayrow[0] .= '<td>Lokasi</td>';
       $i=1;
       $jumlahtotal =0;
       $this->load->model('modeltransaksi');
       $xQuery = $this->modeltransaksi->getSQLDasarPertanggalanggotabaca($xTanggal,$xUser);
       foreach ($xQuery->result() as $row) {
            $arrayrow[$i]= '<td>'.$i.'</td>';
            $arrayrow[$i].= '<td>'.$row->jam.'</td>';
            $arrayrow[$i].= '<td>'.$row->Nama.'</td>';
            $arrayrow[$i].= '<td align="right">'.number_format($row->nominalpersatuan,0, '.', ',').'</td>';
            $arrayrow[$i].= '<td>'.$row->nmlokasi.'</td>';
            $jumlahtotal +=$row->nominalpersatuan;
            $i++;
        }
            $arrayrow[$i]= '<td> </td>';
            $arrayrow[$i].= '<td> </td>';
            
            $arrayrow[$i].= '<td>Jumlah  </td>';
            $arrayrow[$i].= '<td align="right"> '.number_format($jumlahtotal, 0, '.', ',').' </td>';
            $arrayrow[$i].= '<td> </td>';
       }

       if($xJnsTransaksi=="3"){
       $arrayrow[0] = '<td>NO</td>';
       $arrayrow[0] .= '<td>Jam</td>';
       $arrayrow[0] .= '<td width="500px">Nama Produk</td>';
       $arrayrow[0] .= '<td>Nominal</td>';
       $arrayrow[0] .= '<td>Lokasi</td>';
       $i=1;
       $jumlahtotal =0;
       $this->load->model('modeltransaksi');
       $xQuery = $this->modeltransaksi->getSQLDasarPertanggalfotokopi($xTanggal,$xUser);
       foreach ($xQuery->result() as $row) {
            $arrayrow[$i]= '<td>'.$i.'</td>';
            $arrayrow[$i].= '<td>'.$row->jam.'</td>';
            $arrayrow[$i].= '<td>'.$row->NamaProduk.'('.$row->jumlahsatuan.' lembar, @ '.$row->nominalpersatuan.')'.'</td>';
            $arrayrow[$i].= '<td align="right">'.number_format(($row->jumlahsatuan*$row->nominalpersatuan),0, '.', ',').'</td>';
            $arrayrow[$i].= '<td>'.$row->nmlokasi.'</td>';
            $jumlahtotal +=($row->jumlahsatuan*$row->nominalpersatuan);
            $i++;
        }
            $arrayrow[$i]= '<td> </td>';
            $arrayrow[$i].= '<td> </td>';
            
            $arrayrow[$i].= '<td>Jumlah  </td>';
            $arrayrow[$i].= '<td align="right"> '.number_format($jumlahtotal, 0, '.', ',').' </td>';
            $arrayrow[$i].= '<td> </td>';
       }
    return $arrayrow;
    }


    

}

?>