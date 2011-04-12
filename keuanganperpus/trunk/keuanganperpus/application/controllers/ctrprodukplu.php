<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : produkplu  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrprodukplu extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h2>Pengisian Data Produk/PLU </h2>' . form_open_multipart('ctrprodukplu/inserttable', array('id' => 'form', 'name' => 'form')).'<div class="garis"></div>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxprodukplu.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>'.
                    '<script  type=text/javascript>
                            $(function() {
                             $("#stylized input#edharga").autoNumeric();
                             //$("#edharga").autoNumeric();
                             });
                        </script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormprodukplu($xidx), $this->getlistprodukplu($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormprodukplu($xidx) {
        $this->load->helper('form');
        $this->load->model('modelprodukplu');
        $row = $this->modelprodukplu->getDetailprodukplu($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xKodePLU = '';
            $xidJnsPengguna = '';
            $xNamaProduk = '';
            $xSingkatan = '';
            $xidstatusPLU = '';
            $xidrekanan = '';
            $xharga = '';
            $xidjenistransaksi = '';
        } else {
            $xidx = $row->idx;
            $xKodePLU = $row->KodePLU;
            $xidJnsPengguna = $row->idJnsPengguna;
            $xNamaProduk = $row->NamaProduk;
            $xSingkatan = $row->Singkatan;
            $xidstatusPLU = $row->idstatusPLU;
            $xidrekanan = $row->idrekanan;
            $xharga = $row->harga;
            $xidjenistransaksi = $row->idjenistransaksi;
        }
        $this->load->helper('common');
        $this->load->model('modeljenipengguna');
        $this->load->model('modelstatusplu');
        $this->load->model('modelrekanan');
        $this->load->model('modeljenistransaksi');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />' .
        $xBufResult .= setForm('edKodePLU', 'KodePLU', form_input(getArrayObj('edKodePLU', $xKodePLU, '100')));
        $xBufResult .= setForm('edidJnsPengguna', 'Grouping Pengguna',  form_dropdown('edidJnsPengguna', $this->modeljenipengguna->getArrayListjenipengguna(),'0','id="edidJnsPengguna" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNamaProduk', 'NamaProduk', form_input(getArrayObj('edNamaProduk', $xNamaProduk, '300'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edSingkatan', 'Singkatan', form_input(getArrayObj('edSingkatan', $xSingkatan, '100')),'Cth:A3,A4,Jilid,Print') . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidstatusPLU', 'Status PLU', form_dropdown('edidstatusPLU', $this->modelstatusplu->getArrayListstatusplu(),'0','id="edidstatusPLU" width="150px"')). '<div class="spacer"></div>';
        $xBufResult .= setForm('edidrekanan', 'Rekanan', form_dropdown('edidrekanan', $this->modelrekanan->getArrayListrekanan(),'0','id="edidrekanan" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edharga', 'Harga', form_input(getArrayObj('edharga', $xharga, '100'))). '<div class="spacer"></div>';
        $xBufResult .= setForm('edidjenistransaksi', 'Jenistransaksi', form_dropdown('edidjenistransaksi', $this->modeljenistransaksi->getArrayListjenistransaksi(),'0','id="edidjenistransaksi" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function inserttable() {
        $xidx = $_POST['edidx'];
        $xKodePLU = $_POST['edKodePLU'];
        $xidJnsPengguna = $_POST['edidJnsPengguna'];
        $xNamaProduk = $_POST['edNamaProduk'];
        $xSingkatan = $_POST['edSingkatan'];
        $xidstatusPLU = $_POST['edidstatusPLU'];
        $xidrekanan = $_POST['edidrekanan'];
        $xharga = $_POST['edharga'];
        $xidjenistransaksi = $_POST['edidjenistransaksi'];

        $this->load->model('modelprodukplu');
        if ($xidx != '0') {
            $this->modelprodukplu->setUpdateprodukplu($xidx, $xKodePLU, $xidJnsPengguna, $xNamaProduk, $xSingkatan, $xidstatusPLU, $xidrekanan, $xharga, $xidjenistransaksi);
        } else {
            $this->modelprodukplu->setInsertprodukplu($xidx, $xKodePLU, $xidJnsPengguna, $xNamaProduk, $xSingkatan, $xidstatusPLU, $xidrekanan, $xharga, $xidjenistransaksi);
        }
        $this->createform('0');
    }

    function getlistprodukplu($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                        addCell('KodePLU', 'width:100px;', true) .
                        addCell('idJnsPengguna', 'width:100px;', true) .
                        addCell('harga', 'width:100px;', true) .
                        addCell('idjenistransaksi', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modelprodukplu');
        $xQuery = $this->modelprodukplu->getListprodukplu($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->KodePLU, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
                            addCell($row->KodePLU, 'width:100px;') .
                            
                            addCell($row->NamaProduk, 'width:100px;') .
                            addCell($row->harga, 'width:100px;') .
                            addCell($row->idjenistransaksi, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:40px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:650px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modelprodukplu');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modelprodukplu->setDeleteprodukplu($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelprodukplu');
        $row = $this->modelprodukplu->getDetailprodukplu($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['KodePLU'] = $row->KodePLU;
        $this->json_data['idJnsPengguna'] = $row->idJnsPengguna;
        $this->json_data['NamaProduk'] = $row->NamaProduk;
        $this->json_data['Singkatan'] = $row->Singkatan;
        $this->json_data['idstatusPLU'] = $row->idstatusPLU;
        $this->json_data['idrekanan'] = $row->idrekanan;
        $this->json_data['harga'] = $row->harga;
        $this->json_data['idjenistransaksi'] = $row->idjenistransaksi;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelprodukplu');
        $this->modelprodukplu->setDeleteprodukplu($edidx);
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
        $this->json_data['tabledata'] = $this->getlistprodukplu($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xKodePLU = $_POST['edKodePLU'];
        $xidJnsPengguna = $_POST['edidJnsPengguna'];
        $xNamaProduk = $_POST['edNamaProduk'];
        $xSingkatan = $_POST['edSingkatan'];
        $xidstatusPLU = $_POST['edidstatusPLU'];
        $xidrekanan = $_POST['edidrekanan'];
        $xharga = $_POST['edharga'];
        $xidjenistransaksi = $_POST['edidjenistransaksi'];
        $this->load->model('modelprodukplu');
        if ($xidx != '0') {
            $xStr = $this->modelprodukplu->setUpdateprodukplu($xidx, $xKodePLU, $xidJnsPengguna, $xNamaProduk, $xSingkatan, $xidstatusPLU, $xidrekanan, str_replace('.','',$xharga) , $xidjenistransaksi);
        } else {
            $xStr = $this->modelprodukplu->setInsertprodukplu($xidx, $xKodePLU, $xidJnsPengguna, $xNamaProduk, $xSingkatan, $xidstatusPLU, $xidrekanan, str_replace('.','',$xharga), $xidjenistransaksi);
        }
    }

}

?>