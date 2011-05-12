<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : postingrab  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrpostingrab extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Pengisian Anggaran RAB</h3>' . form_open_multipart('ctrpostingrab/inserttable', array('id' => 'form', 'name' => 'form')) . '<div class="garis"></div>';
        $xAddJs = link_tag('resource/css/jquery.treeview.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxpostingrab.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.treeview.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.cookie.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/demo.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                '<script  type=text/javascript>
                            $(function() {
                             $("#stylized input#ednominalposting").autoNumeric();
                                 //$("#ednominalposting").autoNumeric();
                             });
                        </script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormpostingrab($xidx), $this->getlistpostingrab($xAwal, '', $xSearch), '', $xAddJs, '');
    }

    function getlistrab($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->model('modelrab');
        return '<div id="browser"> <div id="lstreeview" name="lstreeview" class="treev">' . $this->modelrab->gettreeviewforposting() . '</div></div>';
    }

    function setDetailFormpostingrab($xidx) {
        $this->load->helper('form');
        $this->load->model('modelpostingrab');
        $row = $this->modelpostingrab->getDetailpostingrab($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xidrab = '';
            $xidtahunanggaran = '';
            $xnominalposting = '';
            $xtglisi = '';
            $xjam = '';
            $xiduser = '';
        } else {
            $xidx = $row->idx;
            $xidrab = $row->idrab;
            $xidtahunanggaran = $row->idtahunanggaran;
            $xnominalposting = $row->nominalposting;
            $xtglisi = $row->tglisi;
            $xjam = $row->jam;
            $xiduser = $row->iduser;
        }
        $this->load->helper('common');
        $this->load->model('modelrab');
        $this->load->model('modeltahunanggaran');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />';
        $xBufResult .= setForm('edidtahunanggaran', 'Tahun Anggaran', form_dropdown('edidtahunanggaran', $this->modeltahunanggaran->getArrayListtahunanggaran(), '0', 'id="edidtahunanggaran" width="150px" ')) . '<div class="spacer"></div>';
        $xBufResult .= $this->getlistrab('', '') . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidrab', 'R A B', form_dropdown('edidrab', $this->modelrab->getArrayListrab(), '0', 'id="edidrab" width="150px" onchange="doedidrabchange();"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ednominalposting', 'Nominal ', form_input(getArrayObj('ednominalposting', $xnominalposting, '100'))) . '<div class="spacer"></div>';

        /* $xBufResult .= setForm('edtglisi', 'tglisi', form_input(getArrayObj('edtglisi', $xtglisi, '100'))) . '<div class="spacer"></div>';
          $xBufResult .= setForm('edjam', 'jam', form_input(getArrayObj('edjam', $xjam, '100'))) . '<div class="spacer"></div>';
          $xBufResult .= setForm('ediduser', 'iduser', form_input(getArrayObj('ediduser', $xiduser, '100'))) . '<div class="spacer"></div>';
         *
         */
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Simpan', 'onclick="dosimpan();"') . form_button('btNew', 'Baru', 'onclick="doClear();"') .form_button('btNew', 'Repair Data Posting', 'onclick="dorepair();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

   function dorepair(){
       $xidTahunAnggaran =  $_POST['xthnanggaran'];
       $this->load->model('modelpostingrab');
       $xQuery = $this->modelpostingrab->getlistpostingrabbyidtahun($xidTahunAnggaran);
       
       foreach ($xQuery->result() as $row) {
        if($this->getisparent($row->idrab))
         {
             $this->modelpostingrab->setUpdatepostingrabrepair($row->idrab);
         }
       }
//        $this->load->helper('json');
//        $this->json_data['data'] = $xBufResult;
//        echo json_encode($this->json_data);
   
   }

   function  getisparent($xIdRAB){
    $this->load->model('modelpostingrab');
    return $this->modelpostingrab->getIsParrent($xIdRAB);
   }


    function getlistpostingrab($xAwal, $xthnanggaran, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:40px;', true) .
                        addCell('R A B', 'width:200px;', true) .
                        addCell('Thn Anggaran', 'width:100px;', true) .
                        addCell('Nominal', 'width:100px;text-align:center;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modelpostingrab');
        $xQuery = $this->modelpostingrab->getListpostingrab($xAwal, $xLimit, $xthnanggaran, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->idrab, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:40px;') .
                            addCell($row->JudulRAB, 'width:200px;') .
                            addCell($row->TahunAnggaran, 'width:100px;') .
                            addCell(number_format($row->nominalposting, 2, ',', '.'), 'width:100px;text-align:right;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:40px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:40px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:600px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modelpostingrab');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modelpostingrab->setDeletepostingrab($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelpostingrab');
        $row = $this->modelpostingrab->getDetailpostingrab($xIdEdit);
        $this->load->helper('json');
        if (!empty($row)) {
            $this->json_data['idx'] = $row->idx;
            $this->json_data['idrab'] = $row->idrab;
            $this->json_data['idtahunanggaran'] = $row->idtahunanggaran;
            $this->json_data['nominalposting'] = number_format($row->nominalposting, 0, ',', '.');
            $this->json_data['tglisi'] = $row->tglisi;
            $this->json_data['jam'] = $row->jam;
            $this->json_data['iduser'] = $row->iduser;
            $xisParent = $this->getisparent($row->idrab) ;
            $this->json_data['isparent'] = $xisParent;
            if($xisParent){
             //$this->json_data['nominalposting'] = number_format($this->modelpostingrab->getSumPostingrabbyparrenttahun($row->idrab,$row->idtahunanggaran) , 0, ',', '.');
               $this->json_data['nominalposting'] = $this->modelpostingrab->getSumPostingrabbyparrenttahun($row->idrab,$row->idtahunanggaran);
            }

            $this->json_data['isdataada'] = true;

        } else {
            $this->json_data['isdataada'] = false;
            
        }

        echo json_encode($this->json_data);
    }

    function searchidposting() {
        $xidrab = $_POST['xidrab'];
        $xthnanggaran = $_POST['xthnanggaran'];
        $this->load->model('modelpostingrab');
        $row = $this->modelpostingrab->getDetailpostingrabbyidrabtahun($xidrab, $xthnanggaran);
        $this->load->helper('json');
        if (!empty($row)) {

            $this->json_data['isadadata'] = true;
            $this->json_data['idx'] = $row->idx;
            $this->json_data['idrab'] = $row->idrab;
            $this->json_data['idtahunanggaran'] = $row->idtahunanggaran;
            $this->json_data['nominalposting'] = number_format($row->nominalposting, 0, ',', '.');
            $xisParent = $this->getisparent($row->idrab) ;
            $this->json_data['isparent'] = $xisParent;
            if($xisParent){
             $this->json_data['nominalposting'] = number_format($this->modelpostingrab->getSumPostingrabbyparrenttahun($row->idrab,$row->idtahunanggaran) , 0, ',', '.');
             //  $this->json_data['nominalposting'] = $this->modelpostingrab->getSumPostingrabbyparrenttahun($row->idrab,$row->idtahunanggaran);
            }
        } else {
            $this->json_data['isadadata'] = false;
            $this->json_data['idx'] = '0';
            $this->json_data['idrab'] = $xidrab;
            $this->json_data['idtahunanggaran'] = $xthnanggaran;

        }

        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelpostingrab');
        $this->modelpostingrab->setDeletepostingrab($edidx);
    }

    function search() {
        $xAwal = $_POST['xAwal'];
        $xSearch = $_POST['xSearch'];
        $xthnanggaran = $_POST['xthnanggaran'];
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
        $this->json_data['tabledata'] = $this->getlistpostingrab($xAwal, $xthnanggaran, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }

        $xidrab = $_POST['edidrab'];
        $xidtahunanggaran = $_POST['edidtahunanggaran'];
        $xnominalposting = $_POST['ednominalposting'];
        $xtglisi = $_POST['edtglisi'];
        $xjam = $_POST['edjam'];
        $xiduser = $this->session->userdata('idpegawai');
        ;

        $this->load->model('modelpostingrab');
        if ($xidx != '0') {
            $xStr = $this->modelpostingrab->setUpdatepostingrab($xidx, $xidrab, $xidtahunanggaran, str_replace('.', '', $xnominalposting), $xiduser);
        } else {
            $xStr = $this->modelpostingrab->setInsertpostingrab($xidx, $xidrab, $xidtahunanggaran, str_replace('.', '', $xnominalposting), $xiduser);
        }
    }

}

?>