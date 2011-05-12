<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : realisasirab  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrrealisasirab extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Realisasi  RAB </h3>' . form_open_multipart('ctrrealisasirab/inserttable', array('id' => 'form', 'name' => 'form')) . '<div class="garis"></div>';
        $xAddJs =
                link_tag('resource/js/themes/base/jquery.ui.all.css') .
                link_tag('resource/css/jquery.treeview.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxrealisasirab.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.core.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.widget.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery.treeview.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.datepicker.js">
                 </script> <script type="text/javascript">
                    function strpad(val){
                         return (!isNaN(val) && val.toString().length==1)?"0"+val:val;
                      }
                    </script>
                <script type="text/javascript">

                   // jQuery.noConflict();
                    $(function() {
                        var currentTimeAndDate = new Date();
                        var Date30 = new Date();
                        var date = new Date();
                         Date30.setDate(Date30.getDate()-30);



                        var dd = date.getDate();
                        var mm = date.getMonth();
                        var yy = date.getYear();

                        var hh = date.getHours();
                        var mnt = date.getMinutes();

                        var dd30 = Date30.getDate();
                        var mm30 = Date30.getMonth();
                        var yy30 = Date30.getYear();

                          yy  = (yy < 1000) ? yy + 1900 : yy;



                            $("#stylized input#edtanggal" ).datepicker({ dateFormat: \'yy-mm-dd\'});
                        $("#stylized input#edtanggal" ).val(yy+"-"+strpad(mm+1)+"-"+strpad(dd));




                   });
                    </script>
                    <script  type=text/javascript>
                            $(function() {
                             $("#stylized input#ednominal").autoNumeric();
                             //$("#ednominal").autoNumeric();
                             $("#browser").treeview();
                             });
                        </script>
                    ';
        echo $this->modelgetmenu->Setviewperpus($xForm . $this->setDetailFormrealisasirab($xidx), $this->getlistrealisasirab($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormrealisasirab($xidx) {
        $this->load->helper('form');
        $this->load->model('modelrealisasirab');
        $row = $this->modelrealisasirab->getDetailrealisasirab($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xtanggal = '';
            $xjam = '';
            $xidrab = '';
            $xketerangan = '';
            $xnominal = '';
            $xiduser = '';
        } else {
            $xidx = $row->idx;
            $xtanggal = $row->tanggal;
            $xjam = $row->jam;
            $xidrab = $row->idrab;
            $xketerangan = $row->keterangan;
            $xnominal = $row->nominal;
            $xiduser = $row->iduser;
        }
        $this->load->helper('common');
        $this->load->model('modelrab');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />';
        $xBufResult .= $this->getlistrab() . '<div class="spacer"></div>';
        $xBufResult .= setForm('edtanggal', 'Tanggal', form_input(getArrayObj('edtanggal', $xtanggal, '100'))) . '<div class="spacer"></div>';
        //$xBufResult .= setForm('edjam', 'jam', form_input(getArrayObj('edjam', $xjam, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidrab', 'R A B', form_dropdown('edidrab', $this->modelrab->getArrayListrab(), '0', 'id="edidrab" width="150px" onchange="doedidrabchange();"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edketerangan', 'Keterangan', form_input(getArrayObj('edketerangan', $xketerangan, '400'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ednominal', 'Realisasi', form_input(getArrayObj('ednominal', $xnominal, '100'))) . '<div class="spacer"></div>';
        //$xBufResult .= setForm('ediduser', 'iduser', form_input(getArrayObj('ediduser', $xiduser, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistrab() {
        $this->load->model('modelrab');
        return '<div id="browser"> <div id="lstreeview" name="lstreeview" class="treev">' . $this->modelrab->gettreeviewforposting() . '</div></div>';
    }

    function getlistrealisasirab($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:40px;', true) .
                        addCell('Tanggal', 'width:70px;', true) .
                        //addCell('jam', 'width:100px;', true) .
                        addCell('R A B', 'width:100px;', true) .
                        addCell('Keterangan', 'width:180px;', true) .
                        addCell('Realisasi', 'width:90px;text-align:center;', true) .
                        // addCell('iduser', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:70px;text-align:center;', true));
        $this->load->model('modelrealisasirab');
        $xQuery = $this->modelrealisasirab->getListrealisasirab($xAwal, $xLimit, $xSearch);

        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->tanggal, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:40px;') .
                            addCell($row->tanggal, 'width:70px;') .
                            //   addCell($row->jam, 'width:100px;') .
                            addCell($row->JudulRAB, 'width:100px;') .
                            addCell($row->keterangan, 'width:180px;') .
                            addCell(number_format($row->nominal, 2, ',', '.'), 'width:90px;text-align:right;') .
                            //addCell($row->iduser, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:70px;'));
        }

        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:330px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:40px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:600px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modelrealisasirab');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modelrealisasirab->setDeleterealisasirab($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelrealisasirab');
        $row = $this->modelrealisasirab->getDetailrealisasirab($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['tanggal'] = $row->tanggal;
        $this->json_data['jam'] = $row->jam;
        $this->json_data['idrab'] = $row->idrab;
        $this->json_data['keterangan'] = $row->keterangan;
        $this->json_data['nominal'] = number_format($row->nominal, 0, ',', '.');
        $this->json_data['iduser'] = $row->iduser;
        $this->json_data['idthnanggaran'] = $row->idthnanggaran;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelrealisasirab');
        $this->modelrealisasirab->setDeleterealisasirab($edidx);
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

        $this->json_data['tabledata'] = $this->getlistrealisasirab($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function getisparent($xIdRAB) {
        $this->load->model('modelpostingrab');
        return $this->modelpostingrab->getIsParrent($xIdRAB);
    }

    function searchidrealisasi() {
        $xidrab = $_POST['xidrab'];
        $this->json_data['idrab'] = $xidrab;
        $xisParent = $this->getisparent($xidrab);
        $this->json_data['tabledata'] = $this->getlistrealisasirab(0, $xidrab);
        $this->json_data['isparent'] = $xisParent;
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xtanggal = $_POST['edtanggal'];
        $xjam = $_POST['edjam'];
        $xidrab = $_POST['edidrab'];
        $xketerangan = $_POST['edketerangan'];
        $xnominal = $_POST['ednominal'];
        $xiduser = $_POST['ediduser'];
        $xidthnanggaran = $_POST['edidthnanggaran'];
        $xiduser = $this->session->userdata('idpegawai');
        $this->load->model('modeltahunanggaran');
        $rowthnanggaran = $this->modeltahunanggaran->getDetailtahunanggaranbystatusaktif();
        $this->load->model('modelrealisasirab');
        if ($xidx != '0') {
            $xStr = $this->modelrealisasirab->setUpdaterealisasirab($xidx, $xtanggal, $xidrab, $xketerangan, str_replace('.', '', $xnominal), $xiduser, $rowthnanggaran->idx);
        } else {
            $xStr = $this->modelrealisasirab->setInsertrealisasirab($xidx, $xtanggal, $xidrab, $xketerangan, str_replace('.', '', $xnominal), $xiduser, $rowthnanggaran->idx);
        }
    }

}

?>