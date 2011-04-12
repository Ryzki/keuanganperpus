<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : perjabatperpus  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class ctrperjabatperpus extends CI_Controller {

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
        $xForm = '<div id="stylized" class="myform"><h3>Isi / Edit Pejabat Perpustakaan </h3>' . form_open_multipart('ctrperjabatperpus/inserttable', array('id' => 'form', 'name' => 'form')).'<div class="garis"></div>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                link_tag('resource/js/themes/base/jquery.ui.all.css').
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxperjabatperpus.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
        '<script language="javascript" type="text/javascript" src="'.base_url().'resource/js/ui/jquery.ui.core.js"></script>'.
                 '<script language="javascript" type="text/javascript" src="'.base_url().'resource/js/ui/jquery.ui.widget.js"></script>'.
                '<script language="javascript" type="text/javascript" src="'.base_url().'resource/js/ui/jquery.ui.datepicker.js"></script>'.
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>
                    <script type="text/javascript">
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


                        //$("#stylized input#edtglawaljawabatan" ).datepicker({ dateFormat: \'yy-mm-dd\', showOn: \'button\', buttonImage: \''.base_url().'resource/imgbtn/calendar.gif\', buttonImageOnly: true });
                            $("#stylized input#edtglawaljawabatan" ).datepicker({ dateFormat: \'yy-mm-dd\'});
                        $("#stylized input#edtglawaljawabatan" ).val(yy+"-"+strpad(mm+1)+"-"+strpad(dd));

                       // $("#stylized input#edtglakhirjabatan" ).datepicker({ dateFormat: \'yy-mm-dd\', showOn: \'button\', buttonImage: \''.base_url().'resource/imgbtn/calendar.gif\', buttonImageOnly: true });
                        $("#stylized input#edtglakhirjabatan" ).datepicker({ dateFormat: \'yy-mm-dd\'});
                        $("#stylized input#edtglakhirjabatan" ).val((yy30+1900)+"-"+strpad((mm30+1))+"-"+strpad(dd30));

                       // $("#form input#edtanggalAkhirJournal" ).datepicker({ dateFormat: \'yy-mm-dd\', showOn: \'button\', buttonImage: \''.base_url().'system/application/views/imgbtn/calendar.gif\', buttonImageOnly: true });
                       // $("#form input#edtanggalAkhirJournal" ).val(yy+"-"+strpad(mm+1)+"-"+strpad(dd));

                       // $("#form input#edwaktu" ).val(strpad(hh)+":"+strpad(mnt));


                   });

//                    $(document).ready(function() {
//                                $(\'#edwaktu\').timepicker({
//                                    showPeriod: false,
//                                    showLeadingZero: false
//                                });
//                            });

                    </script>
                 ';

        echo $this->modelgetmenu->SetViewPerpus($xForm . $this->setDetailFormperjabatperpus($xidx), $this->getlistperjabatperpus($xAwal, $xSearch), '', $xAddJs, '');
    }

    function setDetailFormperjabatperpus($xidx) {
        $this->load->helper('form');
        $this->load->model('modelperjabatperpus');
        $row = $this->modelperjabatperpus->getDetailperjabatperpus($xidx);
        $xBufResult = '';
        if (empty($row)) {
            $xidx = '0';
            $xidPegawai = '';
            $xidjabatan = '';
            $xtglawaljawabatan = '';
            $xtglakhirjabatan = '';
            $xidunitkerja = '';
        } else {
            $xidx = $row->idx;
            $xidPegawai = $row->idPegawai;
            $xidjabatan = $row->idjabatan;
            $xtglawaljawabatan = $row->tglawaljawabatan;
            $xtglakhirjabatan = $row->tglakhirjabatan;
            $xidunitkerja = $row->idunitkerja;
        }
        $this->load->helper('common');
        $this->load->model('modelunitkerja');
          $this->load->model('modeljabatan');
          $this->load->model('modelpegawai');

        $xBufResult = '<input type="hidden" name="edidx" id="edidx" value="0" />' .
         $xBufResult .= setForm('edidPegawai', 'Nama Pegawai', form_dropdown('edidPegawai', $this->modelpegawai->getArrayListpegawai(),'0','id="edidPegawai" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidjabatan', 'Jabatan', form_dropdown('edidjabatan', $this->modeljabatan->getArrayListjabatan(),'0','id="edidjabatan" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edtglawaljawabatan', 'Tgl Awal Menjabat', form_input(getArrayObj('edtglawaljawabatan', $xtglawaljawabatan, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edtglakhirjabatan', 'Tgl akhir Menjabat', form_input(getArrayObj('edtglakhirjabatan', $xtglakhirjabatan, '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidunitkerja', 'Unit Kerja Perpus', form_dropdown('edidunitkerja', $this->modelunitkerja->getArrayListunitkerja(),'0','id="edidunitkerja" width="150px"')) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="doClear();"') . '<div class="spacer"></div>';
        return $xBufResult;
    }

    function inserttable() {
        $xidx = $_POST['edidx'];
        $xidPegawai = $_POST['edidPegawai'];
        $xidjabatan = $_POST['edidjabatan'];
        $xtglawaljawabatan = $_POST['edtglawaljawabatan'];
        $xtglakhirjabatan = $_POST['edtglakhirjabatan'];
        $xidunitkerja = $_POST['edidunitkerja'];

        $this->load->model('modelperjabatperpus');
        if ($xidx != '0') {
            $this->modelperjabatperpus->setUpdateperjabatperpus($xidx, $xidPegawai, $xidjabatan, $xtglawaljawabatan, $xtglakhirjabatan, $xidunitkerja);
        } else {
            $this->modelperjabatperpus->setInsertperjabatperpus($xidx, $xidPegawai, $xidjabatan, $xtglawaljawabatan, $xtglakhirjabatan, $xidunitkerja);
        }
        $this->createform('0');
    }

    function getlistperjabatperpus($xAwal, $xSearch) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = addRow(addCell('idx', 'width:100px;', true) .
                         addCell('idjabatan', 'width:100px;', true) .
                        addCell('tglawaljawabatan', 'width:100px;', true) .
                        addCell('tglakhirjabatan', 'width:100px;', true) .
                        addCell('idunitkerja', 'width:100px;', true) .
                        addCell('Edit/Hapus', 'width:100px;text-align:center;', true));
        $this->load->model('modelperjabatperpus');
        $xQuery = $this->modelperjabatperpus->getListperjabatperpus($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idx . '\',\'' . substr($row->idPegawai, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= addRow(addCell($row->idx, 'width:100px;') .
                            addCell($row->idjabatan, 'width:100px;') .
                            addCell($row->tglawaljawabatan, 'width:100px;') .
                            addCell($row->tglakhirjabatan, 'width:100px;') .
                            addCell($row->idunitkerja, 'width:100px;') .
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
        $this->load->model('modelperjabatperpus');
        switch ($xAction) {
            case 'edit':
                $this->createform($xIdRec, $this->session->userdata('awal'));
                break;
            case 'hapus':
                $this->modelperjabatperpus->setDeleteperjabatperpus($xIdRec);
                $this->createform('0');
                break;
            case 'search' :
                $this->createform('0', '0', $xIdRec);
                break;
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelperjabatperpus');
        $row = $this->modelperjabatperpus->getDetailperjabatperpus($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['idPegawai'] = $row->idPegawai;
        $this->json_data['idjabatan'] = $row->idjabatan;
        $this->json_data['tglawaljawabatan'] = $row->tglawaljawabatan;
        $this->json_data['tglakhirjabatan'] = $row->tglakhirjabatan;
        $this->json_data['idunitkerja'] = $row->idunitkerja;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelperjabatperpus');
        $this->modelperjabatperpus->setDeleteperjabatperpus($edidx);
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
        $this->json_data['tabledata'] = $this->getlistperjabatperpus($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xidPegawai = $_POST['edidPegawai'];
        $xidjabatan = $_POST['edidjabatan'];
        $xtglawaljawabatan = $_POST['edtglawaljawabatan'];
        $xtglakhirjabatan = $_POST['edtglakhirjabatan'];
        $xidunitkerja = $_POST['edidunitkerja'];
        $this->load->model('modelperjabatperpus');
        if ($xidx != '0') {
            $xStr = $this->modelperjabatperpus->setUpdateperjabatperpus($xidx, $xidPegawai, $xidjabatan, $xtglawaljawabatan, $xtglakhirjabatan, $xidunitkerja);
        } else {
            $xStr = $this->modelperjabatperpus->setInsertperjabatperpus($xidx, $xidPegawai, $xidjabatan, $xtglawaljawabatan, $xtglakhirjabatan, $xidunitkerja);
        }
    }

}

?>