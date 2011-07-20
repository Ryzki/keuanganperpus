<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : transaksi  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrtransaksifotokopiwithnota extends CI_Controller {

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
        $xAddJs = 
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                 '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.printElement.js"></script>'.
                  '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxtransaksifotokopiwithnota.js"></script>' .                  
                  '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                  '<script  type=text/javascript>
                            $(function() {
                            // $("#stylized input#edjumlahsatuan").autoNumeric();
                             $("#edBayar").autoNumeric();
                             });
                        </script>';

        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormtransaksi($xidx), $this->getlisttransaksinota($xAwal, $xSearch).'<br /><div id="cetak"></div>', '', $xAddJs, '');
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
        $this->load->model('modelunitkerja');
        $this->load->model('modeljenipengguna');
        $this->load->model('modelnota');
        $xBufResult  = '<input type="hidden" name="edidx" id="edidx" value="0" />'.
                       '<input type="hidden" name="edidjenistransaksi" id="edidjenistransaksi" value="0" />';
                       //'<input type="hidden" name="edidgrouppengguna" id="edidgrouppengguna" value="0" />';
        $xBufResult .= setForm('edidgrouppengguna', 'Jenis Pembayaran', form_dropdown('edidgrouppengguna', $this->modeljenipengguna->getArrayListjenipengguna(), '0', 'id="edidgrouppengguna" style  = "width:150px;" onchange="onCbgrouppenggunaChange();"'));
        $xBufResult .= setForm('edNoNota', 'Kode Nota', form_input(getArrayObj('edNoNota', '', '150'))).'<div class="spacer"></div>';
        $xBufResult .='<div id="nmproduk"></div>'. '<div class="spacer"></div>';
        $xBufResult .='<div id="nmpegawai"></div>'. '<div class="spacer"></div>';
        $xBufResult .='<div id="showhide">'. setForm('edidpegawai', 'NPP', form_input(getArrayObj('edidpegawai', $xidpegawai, '100'))) ;
        $xBufResult .= setForm('edunitkerja', 'Unit Kerja', form_dropdown('edunitkerja', $this->modelunitkerja->getArrayListunitkerja(), '0', 'id="edunitkerja" width="100px" onchange="onCbunitkerjaChange();"')) . '<div class="spacer"></div></div>';
        

        $xBufResult .= setForm('edidplu', 'Kode PLU', form_input(getArrayObj('edidplu', $xidplu, '50')),'Ketikkan Kode PLU dan Tekan ENTER');
        //$xBufResult .= setForm('edidjenistransaksi', 'idjenistransaksi', form_input(getArrayObj('edidjenistransaksi', $xidjenistransaksi, '100'))) . '<div class="spacer"></div>';
       //$xBufResult .= setForm('edidtext', 'edidtext', form_textarea(getArrayObj('edidtext', $xidjenistransaksi, '100','5','50'))) . '<div class="spacer"></div>';

        /*$xBufResult .= setForm('edidstatusdinas', 'idstatusdinas', form_input(getArrayObj('edidstatusdinas', $xidstatusdinas, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edtanggal', 'tanggal', form_input(getArrayObj('edtanggal', $xtanggal, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edjam', 'jam', form_input(getArrayObj('edjam', $xjam, '100'))) . '<div class="spacer"></div>';*/
        $xBufResult .= form_input(getArrayObj('ednominalpersatuan', $xnominalpersatuan, '80'));
        $xBufResult .= setForm('edjumlahsatuan', 'Jumlah', form_input(getArrayObj('edjumlahsatuan', $xjumlahsatuan, '50')),'Masukkan Jumlah dan Tekan ENTER');
        //$xBufResult .= setForm('ednominalpersatuan', 'Harga', form_input(getArrayObj('ednominalpersatuan', $xnominalpersatuan, '80')));

        //$xBufResult .= setForm('edtotal', 'Total', form_input(getArrayObj('edtotal', $xtotal, '80'))) . '<div class="spacer"></div>';
        $xBufResult .=form_input(getArrayObj('edtotal', $xtotal, '80'));
        //$xBufResult .= setForm('edchkispusd', 'buku pusd', form_button(getArrayObj('edchkispusd', $xtotal, '40'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edchkispusd', 'Buku USD ',form_checkbox(getArrayObjCheckBox('edchkispusd', 'N', FALSE, "0"),'Y',TRUE,'onclick=doclickchkbkusd();'),'Check Bila untuk Buku milik PUSD(Pot 20%)') . '<div class="spacer"></div>'.'<div class="garis"></div>'; //form_checkbox( $row->nmmenu, $row->idmenu);
        
        /*$xBufResult .= setForm('ediduser', 'iduser', form_input(getArrayObj('ediduser', $xiduser, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ednominaldenda', 'nominaldenda', form_input(getArrayObj('ednominaldenda', $xnominaldenda, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ediddendasparta', 'iddendasparta', form_input(getArrayObj('ediddendasparta', $xiddendasparta, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidlokasi', 'idlokasi', form_input(getArrayObj('edidlokasi', $xidlokasi, '100'))) . '<div class="spacer"></div>';*/

        $xBufResult .= $this->getlisttransaksibuffer('0', ''). '<div class="spacer"></div>'.'<div class="garis"></div>';
        $xBufResult .= setForm('edHarusBayar', 'Harus Bayar', form_input(getArrayObj('edHarusBayar', '', '150'))). '<div class="spacer"></div>';
        $xBufResult .= setForm('edBayar', 'Jumlah Uang', form_input(getArrayObj('edBayar', $xjumlahsatuan, '150')),'Masukkan jumlah Uang dan Tekan ENTER'). '<div class="spacer"></div>';
        $xBufResult .= setForm('edSisa', 'Sisa Pembayaran', form_input(getArrayObj('edSisa', $xjumlahsatuan, '150'))). '<div class="spacer"></div>'.'<div class="garis"></div>';


        $xBufResult .= form_button('btSimpan', 'Simpan', 'onclick="dosimpan();" id="btSimpan"') . form_button('btNew', 'Baru', 'onclick="doClearNota();"'). form_button('btNew', 'Cetak/Simpan', 'onclick="doCetak();"')  . '<div class="spacer"></div>';

        return $xBufResult;
    }


    function getlisttransaksibuffer($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(
                        addCell('idx', 'width:40px;', true) .
                        addCell('Kode Plu', 'width:50px;', true) .
                        addCell('Tanggal', 'width:60px;', true) .
                        addCell('Jam', 'width:60px;', true) .
                        addCell('Jumlah', 'width:50px;', true) .
                        addCell('Harga', 'width:100px;', true) .
                        addCell('Total', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:80px;text-align:center;', true));
        $this->load->model('modelbuffer');
        $xQuery = $this->modelbuffer->getListbuffer($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doeditbuffer(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapusbuffer(\'' . $row->idx . '\',\'' . substr($row->idplu, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:40px;') .
                            addCell($row->idplu, 'width:50px;') .
                            addCell($row->tanggal, 'width:60px;') .
                            addCell($row->jam, 'width:60px;') .
                            addCell($row->jumlahsatuan, 'width:50px;text-align:center;') .
                            addCell(number_format($row->nominalpersatuan, 0, ',', '.'), 'width:100px; text-align:right;') .
                            addCell(number_format($row->total, 0, ',', '.'), 'width:100px;text-align:right;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:80px;'));
        }
        $xButtonADD = '';//<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = '';//form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '';//<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '';//<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearchbuffer(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '';//<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearchbuffer(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:175px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledatabuffer" name ="tabledatabuffer" class="tc1" style="width:650px;">' . $xbufResult . '</div>';
    }

    function getlisttransaksinota($xAwal, $xSearch) {
        $xLimit = 10;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(
                        addCell('NoNota', 'width:130px;', true) .
                        addCell('Tanggal', 'width:100px;', true) .
                        addCell('Jam', 'width:100px;', true) .
                        addCell('Nominal', 'width:100px;', true) .
                        addCell('Di Bayar', 'width:100px;', true) .
                        addCell('Sisa', 'width:100px;', true));
                        //addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modelnota');
        $xQuery = $this->modelnota->getListnota($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '';'<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idnota . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idnota . '\',\'' . substr($row->idnota, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idnota, 'width:130px;') .
                            addCell($row->tanggal, 'width:100px;') .
                            addCell($row->jam, 'width:100px;') .
                            addCell(number_format($row->nominal, 0, ',', '.'), 'width:100px;text-align:right;') .
                            addCell(number_format($row->dibayar, 0, ',', '.'), 'width:100px;text-align:right;') .
                            addCell(number_format($row->sisa, 0, ',', '.'), 'width:100px;text-align:right;'));
                            //addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:250px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledatanota" name ="tabledatanota" class="tc1" style="width:700px;">' . $xbufResult . $xRowCells . '</div>';
    }

  function editrecbuffer() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelbuffer');
        $row = $this->modelbuffer->getDetailbuffer($xIdEdit);
        $this->load->helper('json');
   //       $this->json_data['idx'] = "test";
        $this->load->model('modelpegawai');
        $rowpegawai = $this->modelpegawai->getDetailpegawai($row->idpegawai);


        $this->json_data['idx'] = $row->idx;
        $this->json_data['idplu'] = $row->idplu;
        $this->json_data['idjenistransaksi'] = $row->idjenistransaksi;
        $this->json_data['idjenipengguna'] = $row->idgrouppengguna;
        $this->json_data['idpegawai'] = $rowpegawai->npp;
        $this->json_data['namapeg'] = $rowpegawai->Nama;
        $this->json_data['idunitkerja'] = $row->idunitkerja;
        $this->json_data['idstatusdinas'] = $row->idstatusdinas;
        $this->json_data['tanggal'] = $row->tanggal;
        $this->json_data['jam'] = $row->jam;
        $this->json_data['jumlahsatuan'] = $row->jumlahsatuan;
        $this->json_data['nominalpersatuan'] = $row->nominalpersatuan;
        $this->json_data['total'] = $row->total;
        $this->json_data['iduser'] = $row->iduser;
        $this->json_data['idlokasi'] = $row->idlokasi;
        $this->json_data['idnota'] = $row->idnota;
        $this->session->set_userdata('nonota',$row->idnota);

        echo json_encode($this->json_data);
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelbuffer');
        $row = $this->modelbuffer->getDetailbuffer($xIdEdit);
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
        $this->json_data['edchkispusd'] = $row->isbukuperpus;

        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modeltransaksi');
        $this->modeltransaksi->setDeletetransaksi($edidx);
    }
function deletetablebuffer() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelbuffer');
        $this->modelbuffer->setDeletebuffer($edidx);
    }

    function tampildataPLU(){
    $this->load->helper('json');
    if (!empty($_POST['kodeplu'])) {
            $xkodeplu = $_POST['kodeplu'];
        } else {
            $xkodeplu = '0';
        }
        $xidJnsPengguna = $_POST['edidgrouppengguna'];
        $this->load->model('modelprodukplu');
        $rowplu = $this->modelprodukplu->getDetailprodukplubykodeandjnsgroup($xkodeplu,$xidJnsPengguna);
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
          $this->json_data['idUnitKerja'] = $rowpegawai->idUnitKerja;
        }else{
          $this->json_data['isdataada'] = false;
        }

        echo json_encode($this->json_data);

    }

    function searchbuffer() {
        
        $this->load->helper('json');
        $this->json_data['tabledatabuffer'] = $this->getlisttransaksibuffer('0', '');
        echo json_encode($this->json_data);
    }

    function searchnota() {
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
        $this->json_data['tabledata'] = $this->getlisttransaksinota($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }
/*
 perbaiki :
 * 1. belum bisa menyimpan data pegawai dan unit kerja
 * 2. field dinas atau pribadi disi otomatis berdasrkan kode PLU

 */

function simpantobuffer(){
    $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xkodeplu = $_POST['edidplu'];
        $xidjenistransaksi = $_POST['edidjenistransaksi'];
        $xidpegawai = $_POST['edidpegawai'];
        $xidunitkerja = $_POST['edidunitkerja'];
        $this->load->model('modelpegawai');
        
        if(!empty($xidpegawai)){
          $rowpegawai = $this->modelpegawai->getDataPegawai($xidpegawai);
          if(!empty($rowpegawai)){
            $xidunitkerja = $rowpegawai->idUnitKerja;
            $xidpegawai = $rowpegawai->idx;
          }
        } else {
           $xidpegawai='';
        }
//        //$xtanggal = $_POST['edtanggal'];
//        //$xjam = $_POST['edjam'];
        $xedNoNota = $_POST['edNoNota'];
        $xtanggal =  $this->session->userdata('tanggal');
        $xjumlahsatuan = $_POST['edjumlahsatuan'];
        $xnominalpersatuan = $_POST['ednominalpersatuan'];
        $xtotal = $_POST['edtotal'];
        $xiduser = $this->session->userdata('idpegawai');
        $xnominaldenda = $_POST['ednominaldenda'];
        $xiddendasparta = $_POST['ediddendasparta'];
        $xchkispusd = $_POST['edchkispusd'];
//
        $xidlokasi = $this->session->userdata('idlokasi');
        $this->load->model('modeltransaksi');
        $this->load->model('modelprodukplu');

        $xRowPLU = $this->modelprodukplu->getDetailprodukbykode($xkodeplu);

        $xidstatusdinas = '0';

        if(!empty($xRowPLU->idJnsPengguna)){
           $xidstatusdinas = $xRowPLU->idJnsPengguna;//nilai di transaksi 1 if dinas

        }
        $this->load->model('modelstatusplu');
        $xProsentase = $this->modelstatusplu->getprosenstatusplu($xRowPLU->idstatusPLU,$xchkispusd);
        $xStr ='kosong';
        $this->load->model('modelbuffer');
        if ($xidx != '0') {
//                             setInsertbuffer($xidx, $xidplu, $xidjenistransaksi, $xidstatusplu, $xidgrouppengguna,
//                             $xidpegawai, $xidunitkerja, $xidstatusdinas,  $xjumlahsatuan,
//                             $xnominalpersatuan, $xtotal, $xiduser, $xidlokasi, $xprosenpotong, $xisclear,$xidnota)

            $xStr = $this->modelbuffer->setUpdatebuffer($xidx, $xkodeplu, '3', $xRowPLU->idstatusPLU,
                                                        $xRowPLU->idJnsPengguna, $xidpegawai, $xidunitkerja,
                                                        $xidstatusdinas, str_replace('.','',$xjumlahsatuan),
                                                        str_replace('.','',$xnominalpersatuan), str_replace('.','',$xtotal), $xiduser,
                                                        $xidlokasi, $xProsentase, 'N',$xedNoNota);

        } else {


            $xStr = $this->modelbuffer->setInsertbuffer($xidx, $xkodeplu, '3', $xRowPLU->idstatusPLU,
                                                        $xRowPLU->idJnsPengguna, $xidpegawai, $xidunitkerja,
                                                        $xidstatusdinas, str_replace('.','',$xjumlahsatuan),
                                                        str_replace('.','',$xnominalpersatuan), str_replace('.','',$xtotal), $xiduser,
                                                        $xidlokasi, $xProsentase, 'N',$xedNoNota);
//            $xStr = $this->modelbuffer->setInsertbuffer('$xidx', '$xidplu', '3', '$xRowPLU->idstatusPLU',
//                                                        '$xRowPLU->idJnsPengguna', '$xidpegawai', '$xidunitkerja',
//                                                        '$xidstatusdinas', str_replace('.','',$xjumlahsatuan),
//                                                        str_replace('.','',$xnominalpersatuan), str_replace('.','',$xtotal), '$xiduser',
//                                                        '$xidlokasi', '$xProsentase', 'N','$xedNoNota');

        }
////
//        $this->json_data['data'] = $xStr;
//        echo json_encode($this->json_data);
    }


    function simpan() {
        $this->load->helper('json');
        $xidnota = $_POST['edNoNota'];
        $xBayar = $_POST['edBayar'];
        $xSisa = $_POST['edSisa'];
        //isi kan dari ajax 
        $this->load->model('modelnota');
        $this->load->model('modelbuffer');
        $xNominal = $this->modelbuffer->getTotalFromBuffer($xidnota);
        $this->modelnota->simpannota($xidnota,$xNominal,str_replace('.', '', $xBayar),str_replace('.', '', $xSisa));
        $this->session->unset_userdata('nonota');
        

        

//        if (!empty($_POST['edidx'])) {
//            $xidx = $_POST['edidx'];
//        } else {
//            $xidx = '0';
//        }
//        $xkodeplu = $_POST['edidplu'];
//        $xidjenistransaksi = $_POST['edidjenistransaksi'];
//        $xidpegawai = $_POST['edidpegawai'];
//        $xidunitkerja = $_POST['edidunitkerja'];
//        $this->load->model('modelpegawai');
//        $rowpegawai = $this->modelpegawai->getDataPegawai($xidpegawai);
//        if(!empty($rowpegawai)){
//           $xidunitkerja = $rowpegawai->idUnitKerja;
//           $xidpegawai = $rowpegawai->idx;
//        }
//
//
//
//        //$xtanggal = $_POST['edtanggal'];
//        //$xjam = $_POST['edjam'];
//        $xtanggal =  $this->session->userdata('tanggal');
//        $xjumlahsatuan = $_POST['edjumlahsatuan'];
//        $xnominalpersatuan = $_POST['ednominalpersatuan'];
//        $xtotal = $_POST['edtotal'];
//        $xiduser = $this->session->userdata('idpegawai');
//        $xnominaldenda = $_POST['ednominaldenda'];
//        $xiddendasparta = $_POST['ediddendasparta'];
//        $xchkispusd = $_POST['edchkispusd'];
//
//        $xidlokasi = $this->session->userdata('idlokasi');
//        $this->load->model('modeltransaksi');
//        $this->load->model('modelprodukplu');
//
//        $xRowPLU = $this->modelprodukplu->getDetailprodukbykode($xkodeplu);
//
//        $xidstatusdinas = '0';
//
//        if(!empty($xRowPLU->idJnsPengguna)){
//           $xidstatusdinas = $xRowPLU->idJnsPengguna;//nilai di transaksi 1 if dinas
//
//        }
//        $this->load->model('modelstatusplu');
//        $xProsentase = $this->modelstatusplu->getprosenstatusplu($xRowPLU->idstatusPLU,$xchkispusd);
//         $xStr ='kosong';
//        if ($xidx != '0') {
//            $xStr = $this->modeltransaksi->setUpdatetransaksiFC($xidx,$xkodeplu,'3',$xRowPLU->idstatusPLU,$xRowPLU->idJnsPengguna,
//                                         $xidpegawai,$xidunitkerja,$xidstatusdinas,str_replace('.','',$xjumlahsatuan),
//                                         $xnominalpersatuan,$xtotal,$xiduser,$xnominaldenda,$xiddendasparta,$xidlokasi,$xchkispusd,$xProsentase);
//        } else {
//            $xStr = $this->modeltransaksi->setInserttransaksiFC($xidx,$xkodeplu,'3',$xRowPLU->idstatusPLU,$xRowPLU->idJnsPengguna,$xidpegawai,$xidunitkerja,
//                              $xidstatusdinas,str_replace('.','',$xjumlahsatuan),$xnominalpersatuan,
//                              $xtotal,$xiduser,$xnominaldenda,$xiddendasparta,$xidlokasi,$xchkispusd,$xProsentase);
//        }
//
//       //$this->json_data['data'] = $xStr." Coba ".$xidpegawai;
//        echo json_encode($this->json_data);

    }


function getlastnota(){
  $this->load->helper('json');
  $this->load->model('modelnota');
  $xNoNota =  $this->modelnota->getNoNota();
  $xSess = $this->session->userdata('nonota');
  if($xSess){
      $xNoNota = $xSess;
  } else{
   //gunakan  setelah simpan ke transaksi isclear true $this->session->unset_userdata('nonota');
   //saat edit data set session nomor nota
   // saat ini simpan nomor nota di table nota dan gunakan untuk buffer
     $this->session->set_userdata('nonota',$xNoNota);
     $this->modelnota->setInsertnotaawal($xNoNota,$this->session->userdata('idpegawai'));
     

  }

  $this->json_data['nonota'] = $xNoNota;
  echo json_encode($this->json_data);
}

function setprintnota(){
         $xNama = $_POST['nmpegawai'];
         $edNoNota = $_POST['edNoNota'];
         $edunitkerja = $_POST['edunitkerja'];

         $edHarusBayar = $_POST['edHarusBayar'];
         $edBayar = $_POST['edBayar'];
         $edSisa = $_POST['edSisa'];


         $xBufResult = '<div id="toPrint">';
         
         $this->load->model('modelbuffer');
         $this->load->model('modelprodukplu');
         $xQuery = $this->modelbuffer->getListbuffer(0, 100, '');
         $xIsiTrx = '<div id="detailnota">';
         foreach ($xQuery->result() as $row) {
            $RowPLU =$this->modelprodukplu->getDetailprodukplubykode($row->idplu);
          $xTd = '<div class="kol1">'.$RowPLU->NamaProduk.'</div>';
          $xTd .= '<div class="kol2">'.$row->jumlahsatuan.'</div>';
          $xTd .= '<div class="kol3">'.number_format($row->total, 0, ',', '.').'</div>';

          $xIsiTrx .= $xTd;
         }
         $xIsiTrx .='</div>';

         $this->load->helper('umum');
                 $xHeader = 'No Nota : '.$edNoNota.'<br /> Tanggal : '.$this->session->userdata('tanggal').' <br />';
//                 if(!empty ($xNama)){
//                  $xHeader .=  'Nama : '.$xNama.'<br />';
//                 }
//                 if(!empty ($edunitkerja)){
//                   $xHeader .=  'Unit Kerja : '.$edunitkerja.'<br />';
//                 }

         
         //            123456789012345678901234567890123456789012345678901234567890
         $xBufResult = '<div id="toPrint">
                       Perpustakaan Universitas Sanata Dharma <br />
                       Mrican,Tromol Pos 29,yogyakarta 55002<br />
                       telp .(0274) 513301,515352 <br />
                       FAX (0274)562383<br />
                       ===========================================================<br />
                       '.$xHeader.'
                       =========================================================== <br />
                       '.$xIsiTrx.'
                       =========================================================== <br />
                       Total Transksi : '.$edHarusBayar.'<br />
                       Jumlah   Bayar : '.$edBayar.'<br />
                       Sisa     Bayar : '.$edSisa.'<br />
                       
                       Petugas : '.$this->session->userdata('nama').' <br />
                       </div>';
       $this->load->helper('json');
       $this->json_data['data'] = $xBufResult;
       //$this->json_data['data'] = $xBufResult.'testttt</div>';
         
        echo json_encode($this->json_data);
       
    }
    
function getJumlahHarusBayar(){
  $this->load->helper('json');
  $this->load->model('modelbuffer');
  $xidnota = $_POST['edNoNota'];
  $xJmlBayar =  $this->modelbuffer->getTotalFromBuffer($xidnota);
  $this->json_data['jumlahbayar'] = number_format($xJmlBayar, 0, ',', '.');
  echo json_encode($this->json_data);
}

function isPLUInBuffer(){
  $xkodeplu = $_POST['edidplu'];
  $xNoNota = $_POST['edNoNota'];
  $this->load->model('modelbuffer');
  $ispluinbuffer = $this->modelbuffer->isidpluinbuffer($xNoNota,$xkodeplu);

  $this->load->helper('json');
  $this->json_data['ispluinbuffer'] = $ispluinbuffer;
  echo json_encode($this->json_data);
}

function getSisaBayar(){

  //$xidnota = $_POST['edNoNota'];
    $xidnota = $this->session->userdata('nonota');
  $edBayar = $_POST['edBayar'];
  $this->load->model('modelbuffer');
  $xJmlBayar =  $this->modelbuffer->getTotalFromBuffer($xidnota);
  $sisa =  str_replace('.', '', $edBayar)-$xJmlBayar;
  $this->load->helper('json');
  $this->json_data['jumlahbayar'] = number_format($xJmlBayar, 0, ',', '.');
  $this->json_data['sisa'] = number_format($sisa, 0, ',', '.');
  echo json_encode($this->json_data);
}

function getNamaPegawai(){
        $xNoNota = $_POST['edNoNota'];
        $this->load->model('modelbuffer');
        $row = $this->modelbuffer->GetIdpegawaiByNoNota($xNoNota);
        $this->load->helper('json');
   //       $this->json_data['idx'] = "test";
        $this->load->model('modelpegawai');
        $rowpegawai = $this->modelpegawai->getDetailpegawai($row->idpegawai);
        if(!empty($rowpegawai->npp)){
        $this->json_data['npp'] = $row->npp;
        }
        

}
function refreshsession(){
 $this->session->unset_userdata('nonota');
}
}
?>