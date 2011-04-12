<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Control : listmenu  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */  
class ctrlistmenu extends Controller { 
  function ctrlistmenu() 
    { 
  parent::Controller(); 
  } 

function index($xAwal=0,$xSearch=''){
//  $this->load->view('test.php');
 if($xAwal <= -1){
     $xAwal = 0;
  }    $this->session->set_userdata('awal',$xAwal);
    $this->createform('0',$xAwal);
 } 

function setAjax(){ 
  $xBufResult = '<script language="javascript" type="text/javascript">
   function dosearch(xAwal){ 
   xSearch =""; 
    try 
        {             if ($("#edSearch").val()!=""){ 
              xSearch = $("#edSearch").val();
        } 
         }catch(err){ 
          xSearch =""; 
         } 
   if (typeof(xSearch) =="undefined"){ 
     xSearch =""; 
    } 
  $(document).ready(function(){ 
  $.ajax({ 
          url: "'.site_url('ctrlistmenu/search/').'", 
          data: "xAwal="+xAwal+"&xSearch="+xSearch, 
          cache: false, 
          dataType: \'json\', 
          type: \'POST\', 
       success: function(json){ 
           $("#tabledata").html(json.tabledata); 
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
         start = xmlHttpRequest.responseText.search("<title>") + 7; 
          end  = xmlHttpRequest.responseText.search("</title>"); 
       errorMsg = " error on search "; 
          if (start > 0 && end > 0) 
             alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
          else 
              alert("Error juga"+errorMsg);  
         } 
         }); 
       }); 
 } 

   function doedit(edidlistmenu){ 
 $(document).ready(function(){ 
 $.ajax({ 
    url: "'.site_url('ctrlistmenu/editrec/').'", 
   data: "edidlistmenu="+edidlistmenu, 
  cache: false, 
 dataType: \'json\', 
     type: \'POST\', 
  success: function(json){ 
       $("#edidlistmenu").val(json.idlistmenu); 
       $("#edidmenu").val(json.idmenu); 
       $("#edtglisi").val(json.tglisi); 
       $("#edtglupdate").val(json.tglupdate); 
       $("#edisaktif").val(json.isaktif); 
     }, 
 error: function (xmlHttpRequest, textStatus, errorThrown) { 
 start = xmlHttpRequest.responseText.search("<title>") + 7; 
     end = xmlHttpRequest.responseText.search("</title>"); 
 errorMsg = "error "; 
 if (start > 0 && end > 0)  alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
  else 
 alert("Error juga"+errorMsg); 
 } 
 }); 
 }); 
 } 
 function doClear(){ 
 $(document).ready(function(){ 
 $("#edidlistmenu").val("0"); 
 $("#edidmenu").val(""); 
 $("#edtglisi").val(""); 
 $("#edtglupdate").val(""); 
 $("#edisaktif").val(""); 
  }); 
 } 
         function dosimpan(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: "'.site_url('ctrlistmenu/simpan/').'", 
   data: "edidlistmenu="+$("#edidlistmenu").val()+"&edidmenu="+$("#edidmenu").val()+"&edtglisi="+$("#edtglisi").val()+"&edtglupdate="+$("#edtglupdate").val()+"&edisaktif="+$("#edisaktif").val(), 
                 cache: false, 
                 dataType: \'json\', 
                 type: \'POST\', 
                 success: function(msg){ 
                     doClear(); 
                     dosearch(\'-99\'); 
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

         function dohapus(edidlistmenu,edidmenu){ 
         if (confirm("Anda yakin Akan menghapus data "+edidmenu+"?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: "'.site_url('ctrlistmenu/deletetable/').'", 
                 data: "edidlistmenu="+edidlistmenu, 
                 cache: false, 
                 dataType: \'json\', 
                 type: \'POST\', 
                 success: function(json){ 
                    doClear(); 
                    dosearch(\'-99\'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                     start = xmlHttpRequest.responseText.search("<title>") + 7; 
                     end = xmlHttpRequest.responseText.search("</title>"); 
                     errorMsg = " error"; 
                     if (start > 0 && end > 0) 
                         alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
                     else 
                         alert("Error juga "+errorMsg); 
               } 
           }); 
         }); 
        } 
        } 
       </script> 
       <script type="text/javascript"> 
     
     function initCorners() { 
             var setting = { 
                 tl: { radius: 10 }, // top left 
                 tr: { radius: 10 }, // top right 
                 bl: { radius: 6 }, // bottom left 
                 br: { radius: 6 }, // bottom right 
                 antiAlias: true 
             } 
           curvyCorners(setting, "div#mnhead h1"); 
          } 
     addEvent(window, \'load\', initCorners); 
     dosearch(0); 
     </script> 
     
   <script>
    $(function() {
        $("#form input#edtglisi" ).datepicker({ dateFormat: \'yy-mm-dd\', showOn: \'button\', buttonImage: \'calendar.gif\', buttonImageOnly: true });
        $("#form input#edtglupdate" ).datepicker({ dateFormat: \'yy-mm-dd\', showOn: \'button\', buttonImage: \'calendar.gif\', buttonImageOnly: true });
        $("#form input#edisaktif").autoNumeric();
    });
    </script>

     ';
 return $xBufResult;
 }

 function createform($xidlistmenu,$xAwal=0,$xSearch=''){
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu'); 
     $xMnKiri = $this->modelgetmenu->getMenuSampingKiri(); 
     $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrlistmenu/inserttable',array('id'=>'form','name'=>'form'));
     $xBufResult .= $this->setDetailFormlistmenu($xidlistmenu).'</form></div>';
     $xBufResult .= $this->getlistlistmenu($xAwal,$xSearch);
  $xShow = setlayout('Header Judul','MenuHeader',$xBufResult,'Menu Kanan',$xMnKiri,'copy right diar'); 
      echo '<!doctype html>       <html><head>'.
      link_tag('system/application/views/css/frmlayout.css').
      link_tag('system/application/views/css/menuatas.css').
      link_tag('system/application/views/css/menusamping.css').
      link_tag('system/application/views/css/mainlayout.css').
      //link_tag('system/application/views/js/themes/smoothness/jquery-ui-1.8.9.custom.css').
      link_tag('system/application/views/js/themes/base/jquery.ui.all.css').
      
       '<script language="javascript" type="text/javascript" src="'.base_url().'system/application/views/js/curvycorners.src.js"></script>'. 
       '<script language="javascript" type="text/javascript" src="'.base_url().'system/application/views/js/jquery.js"></script>'. 
       '<script language="javascript" type="text/javascript" src="'.base_url().'system/application/views/js/ui/jquery.ui.core.js"></script>'. 
       '<script language="javascript" type="text/javascript" src="'.base_url().'system/application/views/js/ui/jquery.ui.widget.js"></script>'. 
       '<script language="javascript" type="text/javascript" src="'.base_url().'system/application/views/js/ui/jquery.ui.datepicker.js"></script>'. 
       '<script language="javascript" type="text/javascript" src="'.base_url().'system/application/views/js/autoNumeric.js"></script>'. 
      $this->setAjax().      
      '</head>
       <body>'.
       $xShow.
        '</body>   '.
 '</html>';

}

 function setDetailFormlistmenu($xidlistmenu){
  $this->load->helper('form'); 
  $this->load->model('modellistmenu');
  $row = $this->modellistmenu->getDeatillistmenu($xidlistmenu); 
    $xBufResult = '';
   if(empty($row)){
     $xidlistmenu ='0';
     $xidmenu ='';
     $xtglisi ='';
     $xtglupdate ='';
     $xisaktif ='';
 } else 
 { 
 $xidlistmenu = $row->idlistmenu; 
 $xidmenu = $row->idmenu; 
 $xtglisi = $row->tglisi; 
 $xtglupdate = $row->tglupdate; 
 $xisaktif = $row->isaktif; 
   }
$this->load->helper('common');
  $xBufResult = '<input type="hidden" name="edidlistmenu" id="edidlistmenu" value="0" />'. 
  $xBufResult .= setForm('edidmenu','idmenu',form_input(getArrayObj('edidmenu',$xidmenu,'100'))).'<div class="spacer"></div>';
  $xBufResult .= setForm('edtglisi','tglisi',form_input(getArrayObj('edtglisi',$xtglisi,'100'))).'<div class="spacer"></div>';
  $xBufResult .= setForm('edtglupdate','tglupdate',form_input(getArrayObj('edtglupdate',$xtglupdate,'100'))).'<div class="spacer"></div>';
  $xBufResult .= setForm('edisaktif','Auto numeric',form_input(getArrayObj('edisaktif',$xisaktif,'100'),'','class="auto {aSep: \'.\', aDec: \',\', aSign: \'Rp\'}"')).'<div class="spacer"></div>';
  $xBufResult .= '<div class="garis"></div>'.form_button('btSimpan','simpan','onclick="dosimpan();"').form_button('btNew','new','onclick="doClear();"').'<div class="spacer"></div>'; 
 return $xBufResult;
 
}

function  inserttable(){ 
$xidlistmenu = $_POST['edidlistmenu'];
$xidmenu = $_POST['edidmenu'];
$xtglisi = $_POST['edtglisi'];
$xtglupdate = $_POST['edtglupdate'];
$xisaktif = $_POST['edisaktif'];

 $this->load->model('modellistmenu');
 if($xidlistmenu!='0'){
     $this->modellistmenu->setUpdatelistmenu($xidlistmenu,$xidmenu,$xtglisi,$xtglupdate,$xisaktif);
  } else 
 { 
    $this->modellistmenu->setInsertlistmenu($xidlistmenu,$xidmenu,$xtglisi,$xtglupdate,$xisaktif);
 }
 $this->createform('0'); 
}

  function getlistlistmenu($xAwal,$xSearch){ 
      $xLimit = 3;
      $this->load->helper('form');
      $this->load->helper('common');
       $xbufResult =addRow(         addCell('idlistmenu','width:100px;',true).
         addCell('idmenu','width:100px;',true).
         addCell('tglisi','width:100px;',true).
         addCell('tglupdate','width:100px;',true).
         addCell('isaktif','width:100px;',true).
addCell('Edit/Hapus','width:70px;text-align:center;',true));
       $this->load->model('modellistmenu');
       $xQuery = $this->modellistmenu->getListlistmenu($xAwal,$xLimit,$xSearch);
        foreach ($xQuery->result() as $row)
          { 
              $xButtonEdit = '<img src="'.base_url().'system/application/views/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\''.$row->idlistmenu.'\');" style="border:none;width:20px"/>';
              $xButtonHapus = '<img src="'.base_url().'system/application/views/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\''.$row->idlistmenu.'\',\''.substr($row->idmenu,0,20).'\');" style="border:none;">';
              $xbufResult .= addRow(         addCell($row->idlistmenu,'width:100px;').
         addCell($row->idmenu,'width:100px;').
         addCell($row->tglisi,'width:100px;').
         addCell($row->tglupdate,'width:100px;').
         addCell($row->isaktif,'width:100px;').
addCell($xButtonEdit.'&nbsp/&nbsp'.$xButtonHapus,'width:100px;'));
          }
        $xButtonADD  = '<img src="'.base_url().'system/application/views/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';  
         $xInput      = form_input(getArrayObj('edSearch','','150')); 
        $xButtonSearch = '<img src="'.base_url().'system/application/views/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />'; 
        $xButtonPrev = '<img src="'.base_url().'system/application/views/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch('.($xAwal-3).');"/>';
        $xButtonNext = '<img src="'.base_url().'system/application/views/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch('.($xAwal+3).');" />';
        $xRowCells = addCell($xButtonADD,'width:100px;',true).
                addCell($xInput,'width:200px;border-right:0px;',true).
                addCell($xButtonSearch,'width:460px;border-right:0px;border-left:0px;',true).
                addCell($xButtonPrev.'&nbsp&nbsp'.$xButtonNext,'width:40px;border-left:0px;',true)
;   return '<div id="tabledata" name ="tabledata" class="tc1" style="width:415px;">'.$xbufResult.$xRowCells.'</div>';   
}


function actionrecord($xIdRec='',$xAction=''){
 $this->load->model('modellistmenu');
     switch($xAction){
       case 'edit':
          $this->createform($xIdRec,$this->session->userdata('awal'));
        break;
     case 'hapus':
          $this->modellistmenu->setDeletelistmenu($xIdRec); 
          $this->createform('0');  
       break;
     case 'search' :
        $this->createform('0','0',$xIdRec);
     break; }  
 } 


 function editrec(){ 
   $xIdEdit  = $_POST['edidlistmenu']; 
   $this->load->model('modellistmenu');  
    $row = $this->modellistmenu->getDeatillistmenu($xIdEdit); 
   $this->load->helper('json'); 
 $this->json_data['idlistmenu'] = $row->idlistmenu; 
 $this->json_data['idmenu'] = $row->idmenu; 
 $this->json_data['tglisi'] = $row->tglisi; 
 $this->json_data['tglupdate'] = $row->tglupdate; 
 $this->json_data['isaktif'] = $row->isaktif; 
   echo json_encode($this->json_data);
   } 

 function deletetable(){ 
 $edidlistmenu = $_POST['edidlistmenu']; 
 $this->load->model('modellistmenu'); 
 $this->modellistmenu->setDeletelistmenu($edidlistmenu); 
   } 

function search(){ 
  $xAwal = $_POST['xAwal']; 
  $xSearch = $_POST['xSearch']; 
  $this->load->helper('json'); 
  if(($xAwal+0)==-99){ 
     $xAwal = $this->session->userdata('awal',$xAwal); 
    } 
 if($xAwal+0<=-1){ 
   $xAwal = 0; 
     $this->session->set_userdata('awal',$xAwal); 
   } else{ 
    $this->session->set_userdata('awal',$xAwal); 
 } 
 $this->json_data['tabledata'] = $this->getlistlistmenu($xAwal,$xSearch); 
 echo json_encode($this->json_data); 
  } 

 function  simpan(){ 
 $this->load->helper('json'); 
   if(!empty($_POST['edidlistmenu'])) 
 { 
  $xidlistmenu =  $_POST['edidlistmenu']; 
   } else{ 
  $xidlistmenu = '0'; 
  } 
        $xidmenu = $_POST['edidmenu'];         $xtglisi = $_POST['edtglisi'];         $xtglupdate = $_POST['edtglupdate'];         $xisaktif = $_POST['edisaktif'];       $this->load->model('modellistmenu'); 
 if($xidlistmenu!='0'){   $xStr =  $this->modellistmenu->setUpdatelistmenu($xidlistmenu,$xidmenu,$xtglisi,$xtglupdate,$xisaktif); 
  } else 
  { 
    $xStr =  $this->modellistmenu->setInsertlistmenu($xidlistmenu,$xidmenu,$xtglisi,$xtglupdate,$xisaktif); 
  } 
 } }
?>