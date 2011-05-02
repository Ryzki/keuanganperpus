<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : setoran  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrsetoran extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Setoran Ke Rekanan </h3>' . form_open_multipart('ctrsetoran/inserttable', array('id' => 'form', 'name' => 'form')). '<div class="garis"></div>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                 link_tag('resource/js/themes/base/jquery.ui.all.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxsetoran.js"></script>'.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.core.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.widget.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/autoNumeric.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.datepicker.js"></script> <script type="text/javascript">
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
                             $("#stylized input#ednominal").attr(\'disabled\', true);
                             });
                        </script>
                    ';
                
        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormsetoran($xidx), $this->getlistsetoran($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormsetoran($xidx) {
        $this->load->helper('form');
        $this->load->model('modelsetoran');
        $row = $this->modelsetoran->getDetailsetoran($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xNoBuktiSetoran = '';
            $xtanggal = '';
            $xidrekanan = '';
            $xnominal = '';
            $xidstatusplu = '';
            $xiduser = '';
            $xidlokasi = '';
        } else {
            $xidx = $row->idx;
            $xNoBuktiSetoran = $row->NoBuktiSetoran;
            $xtanggal = $row->tanggal;
            $xidrekanan = $row->idrekanan;
            $xnominal = $row->nominal;
            $xidstatusplu = $row->idstatusplu;
            $xiduser = $row->iduser;
            $xidlokasi = $row->idlokasi;
        }
        $this->load->helper('common');
         $this->load->model('modelrekanan');
          $this->load->model('modelstatusplu');

        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />';
        $xBufResult .= setForm('edNoBuktiSetoran', 'NoBuktiSetoran', form_input(getArrayObj('edNoBuktiSetoran', $xNoBuktiSetoran, '100'))) ;
        $xBufResult .= setForm('edtanggal', 'Tanggal ', form_input(getArrayObj('edtanggal', $xtanggal, '100'))) . '<div class="spacer"></div>';

        $xBufResult .= setForm('edidrekanan', 'Rekanan ', form_dropdown('edidrekanan', $this->modelrekanan->getArrayListrekanan(), '0', 'id="edidrekanan" width="150px"')) ;
        $xBufResult .= setForm('edidstatusplu', 'Status PLU', form_dropdown('edidstatusplu', $this->modelstatusplu->getArrayListstatusplu(), '0', 'id="edidstatusplu" width="150px" onchange="gethargaplu();"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ednominal', 'Nominal ', form_input(getArrayObj('ednominal', $xnominal, '100'))). '<div class="spacer"></div>' ;
        
//        $xBufResult .= setForm('ediduser', 'iduser', form_input(getArrayObj('ediduser', $xiduser, '100'))) . '<div class="spacer"></div>';
//        $xBufResult .= setForm('edidlokasi', 'idlokasi', form_input(getArrayObj('edidlokasi', $xidlokasi, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistsetoran($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:40px;', true) .
                        addCell('NoBuktiSetoran', 'width:100px;', true) .
                        addCell('tanggal', 'width:100px;', true) .
                        addCell('idrekanan', 'width:100px;', true) .
                        addCell('Nominal', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modelsetoran');
        $xQuery = $this->modelsetoran->getListsetoran($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->NoBuktiSetoran, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:40px;') .
                            addCell($row->NoBuktiSetoran, 'width:100px;') .
                            addCell($row->tanggal, 'width:100px;') .
                            addCell($row->idrekanan, 'width:100px;') .
                            addCell($row->nominal, 'width:100px;') .
                            addCell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus, 'width:100px;'));
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + $xLimit) . ');" />';
        $xRowCells = addCell($xButtonADD, 'width:40px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:60px;border-right:0px;border-left:0px;', true) .
                addCell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, 'width:100px;border-left:0px;', true)
        ;
        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:600px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function actionrecord($xIdRec='', $xAction='') {
        $this->load->model('modelsetoran');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modelsetoran->setDeletesetoran($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelsetoran');
        $row = $this->modelsetoran->getDetailsetoran($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['NoBuktiSetoran'] = $row->NoBuktiSetoran;
        $this->json_data['tanggal'] = $row->tanggal;
        $this->json_data['idrekanan'] = $row->idrekanan;
        $this->json_data['nominal'] = $row->nominal;
        $this->json_data['idstatusplu'] = $row->idstatusplu;
        $this->json_data['iduser'] = $row->iduser;
        $this->json_data['idlokasi'] = $row->idlokasi;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelsetoran');
        $this->modelsetoran->setDeletesetoran($edidx);
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
        $this->json_data['tabledata'] = $this->getlistsetoran($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function gethargastatusplu(){
        $xidstatusplu = $_POST['xidstatusplu'];
        $xtanggal = $_POST['xtanggal'];

        $this->load->model('modelsetoran');
        $xjmlsetoran =  $this->modelsetoran->getSetoranBulan($xtanggal,$xidstatusplu);
        $this->load->helper('json');
        $this->json_data['setoran'] = $xjmlsetoran;
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xNoBuktiSetoran = $_POST['edNoBuktiSetoran'];
        $xtanggal = $_POST['edtanggal'];
        $xidrekanan = $_POST['edidrekanan'];
        $xnominal = $_POST['ednominal'];
        $xidstatusplu = $_POST['edidstatusplu'];
        $xiduser = $this->session->userdata('idpegawai');
        $xidlokasi = $this->session->userdata('idlokasi');
        $this->load->model('modelsetoran');

        if ($xidx != '0') {
            $xStr = $this->modelsetoran->setUpdatesetoran($xidx, $xNoBuktiSetoran, $xtanggal, $xidrekanan, str_replace('.', '', $xnominal), $xidstatusplu, $xiduser, $xidlokasi);
        } else {
            $xStr = $this->modelsetoran->setInsertsetoran($xidx, $xNoBuktiSetoran, $xtanggal, $xidrekanan, str_replace('.', '', $xnominal), $xidstatusplu, $xiduser, $xidlokasi);
        }
    }

}

?>