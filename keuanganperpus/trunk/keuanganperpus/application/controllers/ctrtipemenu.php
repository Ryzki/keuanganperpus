<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Control : tipemenu  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */  class ctrtipemenu extends Controller { 
  function ctrtipemenu() 
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
          url: "'.site_url('ctrtipemenu/search/').'", 
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

   function doedit(edidTipeMenu){ 
 $(document).ready(function(){ 
 $.ajax({ 
    url: "'.site_url('ctrtipemenu/editrec/').'", 
   data: "edidTipeMenu="+edidTipeMenu, 
  cache: false, 
 dataType: \'json\', 
     type: \'POST\', 
  success: function(json){ 
       $("#edidTipeMenu").val(json.idTipeMenu); 
       $("#edNmTipeMenu").val(json.NmTipeMenu); 
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
 $("#edidTipeMenu").val("0"); 
 $("#edNmTipeMenu").val(""); 
  }); 
 } 
         function dosimpan(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: "'.site_url('ctrtipemenu/simpan/').'", 
   data: "edidTipeMenu="+$("#edidTipeMenu").val()+"&edNmTipeMenu="+$("#edNmTipeMenu").val(), 
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

         function dohapus(edidTipeMenu,edNmTipeMenu){ 
         if (confirm("Anda yakin Akan menghapus data "+edNmTipeMenu+"?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: "'.site_url('ctrtipemenu/deletetable/').'", 
                 data: "edidTipeMenu="+edidTipeMenu, 
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
     </script> ';
 return $xBufResult;
 }

 function createform($xidTipeMenu,$xAwal=0,$xSearch=''){
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu'); 
     $xMnKiri = $this->modelgetmenu->getMenuSampingKiri(); 
     $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrtipemenu/inserttable',array('id'=>'form','name'=>'form'));
     $xBufResult .= $this->setDetailFormtipemenu($xidTipeMenu).'</form></div>';
     $xBufResult .= $this->getlisttipemenu($xAwal,$xSearch);
  $xShow = setlayout('Header Judul','MenuHeader',$xBufResult,'Menu Kanan',$xMnKiri,'copy right diar'); 
      echo '<!doctype html>       <html><head>'.
      link_tag('system/application/views/css/frmlayout.css').
      link_tag('system/application/views/css/menuatas.css').
      link_tag('system/application/views/css/menusamping.css').
      link_tag('system/application/views/css/mainlayout.css').
       '<script language="javascript" type="text/javascript" src="'.base_url().'system/application/views/js/curvycorners.src.js"></script>'. 
       '<script language="javascript" type="text/javascript" src="'.base_url().'system/application/views/js/jquery.js"></script>'. 
      $this->setAjax().      '</head>
       <body>'.
       $xShow.
        '</body>   '.
 '</html>';

}

 function setDetailFormtipemenu($xidTipeMenu){
  $this->load->helper('form'); 
  $this->load->model('modeltipemenu');
  $row = $this->modeltipemenu->getDeatiltipemenu($xidTipeMenu); 
    $xBufResult = '';
   if(empty($row)){
     $xidTipeMenu ='0';
     $xNmTipeMenu ='';
 } else 
 { 
 $xidTipeMenu = $row->idTipeMenu; 
 $xNmTipeMenu = $row->NmTipeMenu; 
   }
$this->load->helper('common');
  $xBufResult = '<input type="hidden" name="edidTipeMenu" id="edidTipeMenu" value="0" />'. 
  $xBufResult .= setForm('edNmTipeMenu','NmTipeMenu',form_input(getArrayObj('edNmTipeMenu',$xNmTipeMenu,'100'))).'<div class="spacer"></div>';
  $xBufResult .= '<div class="garis"></div>'.form_button('btSimpan','simpan','onclick="dosimpan();"').form_button('btNew','new','onclick="doClear();"').'<div class="spacer"></div>'; 
 return $xBufResult;
 
}

function  inserttable(){ 
$xidTipeMenu = $_POST['edidTipeMenu'];
$xNmTipeMenu = $_POST['edNmTipeMenu'];

 $this->load->model('modeltipemenu');
 if($xidTipeMenu!='0'){
     $this->modeltipemenu->setUpdatetipemenu($xidTipeMenu,$xNmTipeMenu);
  } else 
 { 
    $this->modeltipemenu->setInserttipemenu($xidTipeMenu,$xNmTipeMenu);
 }
 $this->createform('0'); 
}

  function getlisttipemenu($xAwal,$xSearch){ 
      $xLimit = 3;
      $this->load->helper('form');
      $this->load->helper('common');
       $xbufResult =addRow(         addCell('idTipeMenu','width:100px;',true).
         addCell('NmTipeMenu','width:100px;',true).
addCell('Edit/Hapus','width:70px;text-align:center;',true));
       $this->load->model('modeltipemenu');
       $xQuery = $this->modeltipemenu->getListtipemenu($xAwal,$xLimit,$xSearch);
        foreach ($xQuery->result() as $row)
          { 
              $xButtonEdit = '<img src="'.base_url().'system/application/views/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\''.$row->idTipeMenu.'\');" style="border:none;width:20px"/>';
              $xButtonHapus = '<img src="'.base_url().'system/application/views/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\''.$row->idTipeMenu.'\',\''.substr($row->NmTipeMenu,0,20).'\');" style="border:none;">';
              $xbufResult .= addRow(         addCell($row->idTipeMenu,'width:100px;').
         addCell($row->NmTipeMenu,'width:100px;').
addCell($xButtonEdit.'&nbsp/&nbsp'.$xButtonHapus,'width:100px;'));
          }
        $xButtonADD  = '<img src="'.base_url().'system/application/views/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';  
         $xInput      = form_input(getArrayObj('edSearch','','150')); 
        $xButtonSearch = '<img src="'.base_url().'system/application/views/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />'; 
        $xButtonPrev = '<img src="'.base_url().'system/application/views/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch('.($xAwal-3).');"/>';
        $xButtonNext = '<img src="'.base_url().'system/application/views/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch('.($xAwal+3).');" />';
        $xRowCells = addCell($xButtonADD,'width:100px;height:25px;',true).
                addCell($xInput,'width:200px;border-right:0px;',true).
                addCell($xButtonSearch,'width:160px;height:25px;',true).
                addCell($xButtonPrev.'&nbsp&nbsp'.$xButtonNext,'width:40px;height:25px;',true)
;   return '<div id="tabledata" name ="tabledata" class="tc1" style="width:415px;">'.$xbufResult.$xRowCells.'</div>';   
}


function actionrecord($xIdRec='',$xAction=''){
 $this->load->model('modeltipemenu');
     switch($xAction){
       case 'edit':
          $this->createform($xIdRec,$this->session->userdata('awal'));
        break;
     case 'hapus':
          $this->modeltipemenu->setDeletetipemenu($xIdRec); 
          $this->createform('0');  
       break;
     case 'search' :
        $this->createform('0','0',$xIdRec);
     break; }  
 } 


 function editrec(){ 
   $xIdEdit  = $_POST['edidTipeMenu']; 
   $this->load->model('modeltipemenu');  
    $row = $this->modeltipemenu->getDeatiltipemenu($xIdEdit); 
   $this->load->helper('json'); 
 $this->json_data['idTipeMenu'] = $row->idTipeMenu; 
 $this->json_data['NmTipeMenu'] = $row->NmTipeMenu; 
   echo json_encode($this->json_data);
   } 

 function deletetable(){ 
 $edidTipeMenu = $_POST['edidTipeMenu']; 
 $this->load->model('modeltipemenu'); 
 $this->modeltipemenu->setDeletetipemenu($edidTipeMenu); 
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
 $this->json_data['tabledata'] = $this->getlisttipemenu($xAwal,$xSearch); 
 echo json_encode($this->json_data); 
  } 

 function  simpan(){ 
 $this->load->helper('json'); 
   if(!empty($_POST['edidTipeMenu'])) 
 { 
  $xidTipeMenu =  $_POST['edidTipeMenu']; 
   } else{ 
  $xidTipeMenu = '0'; 
  } 
        $xNmTipeMenu = $_POST['edNmTipeMenu'];       $this->load->model('modeltipemenu'); 
 if($xidTipeMenu!='0'){   $xStr =  $this->modeltipemenu->setUpdatetipemenu($xidTipeMenu,$xNmTipeMenu); 
  } else 
  { 
    $xStr =  $this->modeltipemenu->setInserttipemenu($xidTipeMenu,$xNmTipeMenu); 
  } 
 } }
?>