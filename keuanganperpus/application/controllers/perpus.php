<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');

class perpus extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function setAjax() {
        $xBufResult = '<script language="javascript" type="text/javascript">
   function SetHtmlList(xIdMenu){ 
   
  $(document).ready(function(){ 
  $.ajax({ 
          url: "' . site_url('voxus/setView/') . '",
          data: "xIdMenu="+xIdMenu, 
          cache: false, 
          dataType: \'json\', 
          type: \'POST\', 
       success: function(json){ 
           $("#contentview").html(json.contentview); 
           //alert(xIdMenu+json.contentview);
        
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
         start = xmlHttpRequest.responseText.search("<title>") + 7; 
          end  = xmlHttpRequest.responseText.search("</title>"); 
       errorMsg = " error on search "; 
          if (start > 0 && end > 0) 
             alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
          else 
              alert("This Is "+errorMsg);  
         } 
         }); 
       }); 
    } 

   function SetHtmlDetail(xIdMenu){    
  $(document).ready(function(){ 
  $.ajax({ 
          url: "' . site_url('voxus/setViewDetailTrn/') . '",
          data: "xIdMenu="+xIdMenu, 
          cache: false, 
          dataType: \'json\', 
          type: \'POST\', 
       success: function(json){ 
           $("#contentview").html(json.contentview); 
           //alert(xIdMenu+json.contentview);
        
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
         start = xmlHttpRequest.responseText.search("<title>") + 7; 
          end  = xmlHttpRequest.responseText.search("</title>"); 
       errorMsg = " error on search "; 
          if (start > 0 && end > 0) 
             alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
          else 
              alert("This Is "+errorMsg);  
         } 
         }); 
       }); 
    }  
   // SetHtmlList("1");
     </script>

     ';

        return $xBufResult;
    }

    function setAjaxLogin() {
        return '
    <script type="text/javascript">
    function dologin(){
         $(document).ready(function(){

           $.ajax({
                 url: "' . site_url('perpus/dologin/') . '",
                 data: "edUser="+$("#edUser").val()+"&edPassword="+$("#edPassword").val(),
                 cache: false,
                 dataType: \'json\',
                 type: \'POST\',
                 success: function(json){

                 if(json.data){
                    document.location = json.location;
                 }else
                 {
                   alert("Login Anda Salah Silahkan di ulangi");
                 }
                 },
               error: function (xmlHttpRequest, textStatus, errorThrown) {
                     start = xmlHttpRequest.responseText.search("<title>") + 7;
                     end = xmlHttpRequest.responseText.search("</title>");
                     errorMsg =  " ";
                     if (start > 0 && end > 0)
                         alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                     else
                         alert("Error juga "+errorMsg);
               }
           });
         });
         }
      </script>
      ';
    }

    function index($xidmenu='0') {

        //$this->load->view('indexRv.php');
        $this->setViewAwal($xidmenu);
    }

    function setViewAwal($xidmenu) {
        $this->load->model('modelgetmenu');
        $xUser = $this->session->userdata('nama');
        if (!empty($xUser)) {
            //echo $xUser.$this->session->userdata('idpegawai');
            echo $this->modelgetmenu->SetViewPerpus('', '', '', '');
            // $this->createformlogin();
        } else {
            $this->createformlogin();
        }
    }

    function logout() {
        //$xLogin = $this->session->userdata('user');
        $this->session->sess_destroy();
        $this->createformlogin();
    }

    function createformlogin() {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('common');
        //$this->session->sess_destroy();
        $this->load->model('modelgetmenu');
        $this->load->model('modelmenu');
        $this->load->model('modellokasi');
        $xBufResult = '';


        $xForm = '<div id="stylized" class="myform" style="margin-left:150px;text-align:center;" ><h1>Login</h1><div class="garis"> </div>';

        $xForm .= form_open_multipart('ctrtranslete/inserttable', array('id' => 'form', 'name' => 'form'));
        //$xForm .= '<textarea name="content" type="hiden" id="edisi" class="tinymce"></textarea>';
        $xForm .= setForm('edUser', 'User', form_input(getArrayObj('edUser', '', '100'))) . '<div class="spacer"></div>';
        $xForm .= setForm('edPassword', 'Password', form_password(getArrayObj('edPassword', '', '100'))) . '<div class="spacer"></div>';
        $xForm .= setForm('edidlokasi', 'Lokasi', form_dropdown('edidlokasi', $this->modellokasi->getArrayListlokasi(), '0', 'id="edidlokasi" width="150px"')) . '<div class="spacer"></div>';
        $xForm .= '<div class="garis"></div>' . form_button('btLogin', 'login', 'onclick="dologin();"') . form_button('btCancel', 'Cancel', 'onclick="doClearLogin();"') . '<div class="spacer"></div>';


        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                //link_tag('resource/css/thickbox.css').
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxadmin.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>';

        echo $this->modelgetmenu->SetViewPerpus($xForm, '', 'login', $xAddJs, '');
    }

    function dologin() {
        $edUser = $_POST['edUser'];
        $edPassword = $_POST['edPassword'];
        $edidlokasi = $_POST['edidlokasi'];
        $this->load->model('modelpegawai');
        $rowuser = $this->modelpegawai->getDataLogin($edUser, $edPassword);
        $this->json_data['data'] = false;

        if (!empty($rowuser)) {
            $this->session->set_userdata('user', $rowuser->user);
            $this->session->set_userdata('idpegawai', $rowuser->idx);
            $this->session->set_userdata('nama', $rowuser->Nama);
            $this->session->set_userdata('idlokasi', $edidlokasi);
            $this->session->set_userdata('tanggal', $rowuser->tanggal);


            $this->json_data['data'] = true;
            $this->json_data['location'] = site_url() . "/perpus/";
        }


        echo json_encode($this->json_data);
    }

}

?>
