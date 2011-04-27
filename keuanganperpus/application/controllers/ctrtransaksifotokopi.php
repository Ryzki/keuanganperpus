<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : transaksi  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrtransaksifotokopi extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Transaksi Fotokopi/Jilid/Print(Berdasar PLU )</h3>' . form_open_multipart('ctrtransaksi/inserttable', array('id' => 'form', 'name' => 'form')).'<div class="garis"></div>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                  '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxtransaksifotokopi.js"></script>' .
                  '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                  '<script  type=text/javascript>
                            $(function() {
                            // $("#stylized input#edjumlahsatuan").autoNumeric();
                             //$("#edjumlahsatuan").autoNumeric();
                             });
                        </script>';

        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormtransaksi($xidx), $this->getlisttransaksi($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormtransaksi($xidx) {
        $this->load->helper('form');
        $this->load->model('modeltransaksi');
        $row = $this->modeltransaksi->getDetailtransaksi($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xidplu = '';
            $xidjenistransaksi = '';
            $idgrouppengguna = '';
            $xidpegawai = '';
            $xidunitkerja = '';
            $xidstatusdinas = '';
            $xtanggal = '';
            $xjam = '';
            $xjumlahsatuan = '';
            $xnominalpersatuan = '';
            $xtotal = '';
            $xiduser = '';
            $xnominaldenda = '';
            $xiddendasparta = '';
            $xidlokasi = '';
        } else {
            $xidx = $row->idx;
            $xidplu = $row->idplu;
            $xidgrouppengguna = $row->idgrouppengguna;
            $xidjenistransaksi = $row->idjenistransaksi;
            $xidpegawai = $row->idpegawai;
            $xidunitkerja = $row->idunitkerja;
            $xidstatusdinas = $row->idstatusdinas;
            $xtanggal = $row->tanggal;
            $xjam = $row->jam;
            $xjumlahsatuan = $row->jumlahsatuan;
            $xnominalpersatuan = $row->nominalpersatuan;
            $xtotal = $row->total;
            $xiduser = $row->iduser;
            $xnominaldenda = $row->nominaldenda;
            $xiddendasparta = $row->iddendasparta;
            $xidlokasi = $row->idlokasi;
        }
        $this->load->helper('common');
        $xBufResult  = '<input type="hidden" name="edidx" id="edidx" value="0" />'.
                       '<input type="hidden" name="edidjenistransaksi" id="edidjenistransaksi" value="0" />'.
                       '<input type="hidden" name="edidgrouppengguna" id="edidgrouppengguna" value="0" />';
        $xBufResult .= setForm('edidplu', 'Kode PLU', form_input(getArrayObj('edidplu', $xidplu, '100')),'Ketikkan Kode PLU dan Tekan ENTER');
        //$xBufResult .= setForm('edidjenistransaksi', 'idjenistransaksi', form_input(getArrayObj('edidjenistransaksi', $xidjenistransaksi, '100'))) . '<div class="spacer"></div>';
        
        /*$xBufResult .= setForm('edidstatusdinas', 'idstatusdinas', form_input(getArrayObj('edidstatusdinas', $xidstatusdinas, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edtanggal', 'tanggal', form_input(getArrayObj('edtanggal', $xtanggal, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edjam', 'jam', form_input(getArrayObj('edjam', $xjam, '100'))) . '<div class="spacer"></div>';*/
        $xBufResult .= setForm('edjumlahsatuan', 'Jumlah', form_input(getArrayObj('edjumlahsatuan', $xjumlahsatuan, '100')),'Masukkan Jumlah dan Tekan ENTER');
        $xBufResult .= setForm('ednominalpersatuan', 'Harga', form_input(getArrayObj('ednominalpersatuan', $xnominalpersatuan, '100')));
        $xBufResult .= setForm('edtotal', 'Total', form_input(getArrayObj('edtotal', $xtotal, '100'))) . '<div class="spacer"></div>';
        $xBufResult .='<div id="nmproduk"></div>'. '<div class="spacer"></div>';
        $xBufResult .='<div id="nmpegawai"></div>'. '<div class="spacer"></div>';
        $xBufResult .='<div id="showhide">'. setForm('edidpegawai', 'NPP', form_input(getArrayObj('edidpegawai', $xidpegawai, '100'))) ;
        $xBufResult .= setForm('edidunitkerja', 'Unit Kerja', form_input(getArrayObj('edidunitkerja', $xidunitkerja, '200'))).'</div>'.'<div class="spacer"></div>';
        /*$xBufResult .= setForm('ediduser', 'iduser', form_input(getArrayObj('ediduser', $xiduser, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ednominaldenda', 'nominaldenda', form_input(getArrayObj('ednominaldenda', $xnominaldenda, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ediddendasparta', 'iddendasparta', form_input(getArrayObj('ediddendasparta', $xiddendasparta, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidlokasi', 'idlokasi', form_input(getArrayObj('edidlokasi', $xidlokasi, '100'))) . '<div class="spacer"></div>';*/
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    

    function getlisttransaksi($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(
                        addCell('idx', 'width:40px;', true) .
                        addCell('Kode Plu', 'width:50px;', true) .
                        addCell('Tanggal', 'width:60px;', true) .
                        addCell('Jam', 'width:60px;', true) .
                        addCell('Jumlah', 'width:100px;', true) .
                        addCell('Harga', 'width:100px;', true) .
                        addCell('Total', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modeltransaksi');
        $xQuery = $this->modeltransaksi->getListtransaksi($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->idplu, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:40px;') .
                            addCell($row->idplu, 'width:50px;') .
                            addCell($row->tanggal, 'width:60px;') .
                            addCell($row->jam, 'width:60px;') .
                            addCell($row->jumlahsatuan, 'width:100px;') .
                            addCell($row->nominalpersatuan, 'width:100px;') .
                            addCell($row->total, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:60px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:700px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modeltransaksi');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modeltransaksi->setDeletetransaksi($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modeltransaksi');
        $row = $this->modeltransaksi->getDetailtransaksi($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['idplu'] = $row->idplu;
        $this->json_data['idjenistransaksi'] = $row->idjenistransaksi;
        $this->json_data['idjenipengguna'] = $row->idgrouppengguna;
        $this->json_data['idpegawai'] = $row->idpegawai;
        $this->json_data['idunitkerja'] = $row->idunitkerja;
        $this->json_data['idstatusdinas'] = $row->idstatusdinas;
        $this->json_data['tanggal'] = $row->tanggal;
        $this->json_data['jam'] = $row->jam;
        $this->json_data['jumlahsatuan'] = $row->jumlahsatuan;
        $this->json_data['nominalpersatuan'] = $row->nominalpersatuan;
        $this->json_data['total'] = $row->total;
        $this->json_data['iduser'] = $row->iduser;
        $this->json_data['nominaldenda'] = $row->nominaldenda;
        $this->json_data['iddendasparta'] = $row->iddendasparta;
        $this->json_data['idlokasi'] = $row->idlokasi;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modeltransaksi');
        $this->modeltransaksi->setDeletetransaksi($edidx);
    }

    function tampildataPLU(){
    $this->load->helper('json');
    if (!empty($_POST['kodeplu'])) {
            $xkodeplu = $_POST['kodeplu'];
        } else {
            $xkodeplu = '0';
        }
        $this->load->model('modelprodukplu');
        $rowplu = $this->modelprodukplu->getDetailprodukplubykode($xkodeplu);
        if(!empty ($rowplu)){
          $this->json_data['isdataada'] = true;
          $this->json_data['harga'] = $rowplu->harga;
          $this->json_data['NamaProduk'] = $rowplu->NamaProduk;
          //$this->json_data['idgrouppengguna'] = $rowplu->idgrouppengguna;
          $this->json_data['idjenipengguna'] = $rowplu->idJnsPengguna;
          
        }else{
         $this->json_data['isdataada'] = false;
        }
        echo json_encode($this->json_data);


    }

    function tampildataPegawai(){
        $this->load->helper('json');

        if (!empty($_POST['edidpegawai'])) {
            $xNpp = $_POST['edidpegawai'];
        } else {
            $xNpp = '0';
        }

        $this->load->model('modelpegawai');
        $rowpegawai = $this->modelpegawai->getDataPegawai($xNpp);

        if(!empty ($rowpegawai)){
          $this->json_data['isdataada'] = true;
          $this->json_data['npp'] = $rowpegawai->npp;
          $this->json_data['Nama'] = $rowpegawai->Nama;
          $this->json_data['nmunitkerja'] = $rowpegawai->nmunitkerja;
        }else{
          $this->json_data['isdataada'] = false;
        }

        echo json_encode($this->json_data);

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
        $this->json_data['tabledata'] = $this->getlisttransaksi($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }
/*
 perbaiki :
 * 1. belum bisa menyimpan data pegawai dan unit kerja
 * 2. field dinas atau pribadi disi otomatis berdasrkan kode PLU

 */
    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xkodeplu = $_POST['edidplu'];
        $xidjenistransaksi = $_POST['edidjenistransaksi'];
        $xidpegawai = $_POST['edidpegawai'];
        $this->load->model('modelpegawai');
        $rowpegawai = $this->modelpegawai->getDataPegawai($xidpegawai);
        
        if(!empty($rowpegawai)){
           $xidunitkerja = $rowpegawai->idUnitKerja;
           $xidpegawai = $rowpegawai->idx;
        }
        else
        $xidunitkerja ='0';

        
        //$xtanggal = $_POST['edtanggal'];
        //$xjam = $_POST['edjam'];
        $xtanggal =  $this->session->userdata('tanggal');
        $xjumlahsatuan = $_POST['edjumlahsatuan'];
        $xnominalpersatuan = $_POST['ednominalpersatuan'];
        $xtotal = $_POST['edtotal'];
        $xiduser = $this->session->userdata('idpegawai');
        $xnominaldenda = $_POST['ednominaldenda'];
        $xiddendasparta = $_POST['ediddendasparta'];
        $xidlokasi = $this->session->userdata('idlokasi');
        $this->load->model('modeltransaksi');
        $this->load->model('modelprodukplu');
        $xRowPLU = $this->modelprodukplu->getDetailprodukbykode($xkodeplu);
        $xidstatusdinas = '0';
        if(!empty($xRowPLU->idJnsPengguna)){

           $xidstatusdinas = $xRowPLU->idJnsPengguna;//nilai di transaksi 1 if dinas

        }

         $xStr ='kosong';
        if ($xidx != '0') {
            $xStr = $this->modeltransaksi->setUpdatetransaksiFC($xidx,$xkodeplu,'3',$xRowPLU->idstatusPLU,$xRowPLU->idJnsPengguna,
                                         $xidpegawai,$xidunitkerja,$xidstatusdinas,str_replace('.','',$xjumlahsatuan),
                                         $xnominalpersatuan,$xtotal,$xiduser,$xnominaldenda,$xiddendasparta,$xidlokasi);
        } else {
            $xStr = $this->modeltransaksi->setInserttransaksiFC($xidx,$xkodeplu,'3',$xRowPLU->idstatusPLU,$xRowPLU->idJnsPengguna,$xidpegawai,$xidunitkerja,
                              $xidstatusdinas,str_replace('.','',$xjumlahsatuan),$xnominalpersatuan,
                              $xtotal,$xiduser,$xnominaldenda,$xiddendasparta,$xidlokasi);
        }
        $this->json_data['data'] = $xStr." Coba ".$xidpegawai;
        echo json_encode($this->json_data);
    }


}

?>