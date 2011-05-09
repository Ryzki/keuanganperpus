<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : rab  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrrab extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Pengisian Data judul RAB </h>' . form_open_multipart('ctrrab/inserttable', array('id' => 'form', 'name' => 'form')) . '<div class="garis"></div>';
        $xAddJs = 
                link_tag('resource/css/jquery.treeview.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxrab.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.treeview.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.cookie.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/demo.js"></script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormrab($xidx), $this->getlistrab($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormrab($xidx) {
        $this->load->helper('form');
        $this->load->model('modelrab');
        $row = $this->modelrab->getDetailrab($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xJudulRAB = '';
            $xidparent = '';
            $xkodeRAB = '';
            $xkodeRABUSD = '';
            $xisView = 'N';
        } else {
            $xidx = $row->idx;
            $xJudulRAB = $row->JudulRAB;
            $xidparent = $row->idparent;
            $xkodeRAB = $row->kodeRAB;
            $xkodeRABUSD = $row->kodeRABUSD;
            $xisView = $row->isview;
        }
        $this->load->helper('common');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />';
        $xBufResult .= setForm('edJudulRAB', 'Judul RAB', form_input(getArrayObj('edJudulRAB', $xJudulRAB, '200'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidparent', 'Parent RAB', form_dropdown('edidparent', $this->modelrab->getArrayListrab(), '0', 'id="edidparent" width="150px" onchange="dochangeparent();"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edkodeRAB', 'Kode RAB', form_input(getArrayObj('edkodeRAB', $xkodeRAB, '200'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edkodeRABUSD', 'Kode RAB di USD', form_input(getArrayObj('edkodeRABUSD', $xkodeRABUSD, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edisview', 'Tampilkan RAB',form_checkbox(getArrayObjCheckBox('edisview', $xisView,TRUE, "0")),'Uncheck Apabila RAB ini Sudah Tidak Digunakan'). '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . form_button('btHapus', 'delete', 'onclick="dohapus();"').form_button('btRepair', 'Repair Data', 'onclick="dorepair();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    
    function getlistrab($xAwal, $xSearch) {
        $xLimit = 3;
        /*        $this->load->helper('form');
          $this->load->helper('common');
          $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
          addCell('JudulRAB', 'width:100px;', true) .
          addCell('idparent', 'width:100px;', true) .
          addCell('kodeRAB', 'width:100px;', true) .
          addCell('kodeRABUSD', 'width:100px;', true) .
          addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
          $this->load->model('modelrab');
          $xQuery = $this->modelrab->getListrab($xAwal, $xLimit, $xSearch);
          foreach ($xQuery->result() as $row) {
          $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
          $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->JudulRAB, 0, 20) . '\');" style="border:none;">';
          $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
          addCell($row->JudulRAB, 'width:100px;') .
          addCell($row->idparent, 'width:100px;') .
          addCell($row->kodeRAB, 'width:100px;') .
          addCell($row->kodeRABUSD, 'width:100px;') .
          addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
          }
          $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
          $xInput = form_input(getArrayObj('edSearch', '', '150'));
          $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
          $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
          $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
          $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
          addCell($xInput, 'width:200px;border-right:0px;', true) .
          addCell($xButtonSearch, 'width:460px;border-right:0px;border-left:0px;', true) .
          addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
          ;
          return '<div id="tabledata" name ="tabledata" class="tc1" style="width:415px;">' . $xbufResult . $xRowCells . '</div>';
         *
         */

//return '<div id="lstreeview" name="lstreeview" class="treev">'.$this->modelrab->gettreeview().'</div>';
        $this->load->model('modelrab');
        return '<div id="browser"> <div id="lstreeview" name="lstreeview" class="treev">' . $this->modelrab->gettreeview() . '</div></div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modelrab');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modelrab->setDeleterab($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    
   function  getKodeRABbyUrut($xIdxRAB,$xIdxParent){
        if(empty($xIdxParent))
          $xIdxParent='0';

       if($xIdxParent!='0'){
              $this->load->model('modelrab');
              $rowparent = $this->modelrab->getDetailrab($xIdxParent);
              $row= $this->modelrab->getKodeRABbyUrut($xIdxRAB,$xIdxParent);
              $xKodeRABParent = $rowparent->kodeRAB;
              $xkodeRAB = $xKodeRABParent . '.' . str_pad($row->urut . '', 3, '0', STR_PAD_LEFT);
       } else
       {
          $this->load->model('modelrab');
          $rowparent = $this->modelrab->getDetailrab($xIdxRAB);
          $xkodeRAB = $rowparent->kodeRAB;
           //$xkodeRAB=$xIdxParent;
       }

        return $xkodeRAB;
   }

   function dorepair(){
    $this->load->model('modelrab');
    $xQuery =  $this->modelrab->getListraballbyidx();
    
    foreach ($xQuery->result() as $row) {
       $xKodeRAB = $this->getKodeRABbyUrut($row->idx,$row->idparent);
       $this->modelrab->setUpdateKodeRab($row->idx, $xKodeRAB);

    }

    
   }

   function doChange(){
         //if (isset($_POST['edidparent'])) {
            $xIdParent = $_POST['edidparent'];
//          } else {
//
//            $xIdParent = "0";
//          }

      $this->load->helper('json');
      $this->json_data['kodeRAB'] = $this->getkoderab($xIdParent);
      echo json_encode($this->json_data);

   }

   function getkoderab($xIdParent) {
        $this->load->model('modelrab');
        $kodeRAB = $this->modelrab->getLastKodeRABbyParrent($xIdParent);
        return $kodeRAB;
   }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelrab');
        $row = $this->modelrab->getDetailrab($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['JudulRAB'] = $row->JudulRAB;
        $this->json_data['idparent'] = $row->idparent;
        $this->json_data['kodeRAB'] = $row->kodeRAB;
        //$this->json_data['kodeRAB'] = $this->getKodeRABbyUrut($row->idx, $row->idparent);//$row->kodeRAB;
        $this->json_data['kodeRABUSD'] = $row->kodeRABUSD;
        $this->json_data['edisview'] = $row->isview;

        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $kodeRAB = $_POST['kodeRAB'];
        $this->load->model('modelrab');
        $this->modelrab->setDeleterab($edidx);
        $this->modelrab->setDeleterabbykodeRAB($kodeRAB);
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
        $this->load->model('modelrab');
        $this->json_data['lstreeview'] = $this->getlistrab($xAwal, $xSearch);
        $this->json_data['edidparent'] = $this->modelrab->getArrayListrabnotarray();
        $this->json_data['edkodeRAB'] = $this->getkoderab('0');

        //$this->json_data['lstreeview'] = '';
       // $this->json_data['edidparent'] = '';
       // $this->json_data['edkodeRAB'] = '';


        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xJudulRAB = $_POST['edJudulRAB'];
        $xidparent = $_POST['edidparent'];
        $xkodeRAB = $_POST['edkodeRAB'];
        $xkodeRABUSD = $_POST['edkodeRABUSD'];
        $xisview = $_POST['edisview'];
        $this->load->model('modelrab');
        if ($xidx != '0') {
            $xStr = $this->modelrab->setUpdaterab($xidx, $xJudulRAB, $xidparent, $xkodeRAB, $xkodeRABUSD,$xisview);
        } else {
            $xStr = $this->modelrab->setInsertrab($xidx, $xJudulRAB, $xidparent, $xkodeRAB, $xkodeRABUSD,$xisview);
        }
    }

}

?>