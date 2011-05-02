<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
    /* Class  Control : statusplu  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrstatusplu extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Isi / Edit Status PLU</h3>' . form_open_multipart('ctrstatusplu/inserttable', array('id' => 'form', 'name' => 'form')).'<div class="garis"></div>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxstatusplu.js"></script>'.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                 '
                 <script  type=text/javascript>
                            $(function() {
                             $("#edProsenReguler").autoNumeric();
                             $("#edProsenPusd").autoNumeric();
                             });
                        </script>';
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormstatusplu($xidx), $this->getliststatusplu($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormstatusplu($xidx) {
        $this->load->helper('form');
        $this->load->model('modelstatusplu');
        $row = $this->modelstatusplu->getDetailstatusplu($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xStatus = '';
        } else {
            $xidx = $row->idx;
            $xStatus = $row->Status;
        }
        $this->load->helper('common');
        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />' ;
        $xBufResult .= setForm('edStatus', 'Status PLU', form_input(getArrayObj('edStatus', $xStatus, '200'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edProsenReguler', 'Prosentase Reguler', form_input(getArrayObj('edProsenReguler', $xStatus, '50')),'Prosentase Untuk Pemotongan Non PUSD').'%' . '<div class="spacer"></div>';
        $xBufResult .= setForm('edProsenPusd', 'Prosentase PUSD', form_input(getArrayObj('edProsenPusd', $xStatus, '50')),'Prosentase Untuk Pemotongan  PUSD').'%' . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Simpan', 'onclick="dosimpan();"') . form_button('btNew', 'Baru', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    

    function getliststatusplu($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                        addCell('Status', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modelstatusplu');
        $xQuery = $this->modelstatusplu->getListstatusplu($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->Status, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
                            addCell($row->Status, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:100px;', true) .
                addCell($xInput, 'width:100px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:40px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:415px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modelstatusplu');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modelstatusplu->setDeletestatusplu($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelstatusplu');
        $row = $this->modelstatusplu->getDetailstatusplu($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['Status'] = $row->Status;
        $this->json_data['prosenreguler'] = $row->prosenreguler;
        $this->json_data['prosenperpus'] = $row->prosenperpus;

        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelstatusplu');
        $this->modelstatusplu->setDeletestatusplu($edidx);
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
        $this->json_data['tabledata'] = $this->getliststatusplu($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xStatus = $_POST['edStatus'];
        $xprosenreguler = $_POST['edProsenReguler'];
        $xprosenperpus = $_POST['edProsenPusd'];

        $this->load->model('modelstatusplu');
        if ($xidx != '0') {
            $xStr = $this->modelstatusplu->setUpdatestatusplu($xidx, $xStatus,$xprosenreguler,$xprosenperpus);
        } else {
            $xStr = $this->modelstatusplu->setInsertstatusplu($xidx, $xStatus,$xprosenreguler,$xprosenperpus);
        }
    }

}

?>