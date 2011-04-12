<?php 
  class ctrmenu extends CI_Controller { 
  function __construct()
    {
        parent::__construct();
    }
/*
<div id="myslidemenu" class="jqueryslidemenu">
<ul>
<li><a href="http://www.dynamicdrive.com">Item 1</a></li>
<li><a href="#">Item 2</a></li>
<li><a href="#">Folder 1</a>
  <ul>
  <li><a href="#">Sub Item 1.1</a></li>
  <li><a href="#">Sub Item 1.2</a></li>
  <li><a href="#">Sub Item 1.3</a></li>
  <li><a href="#">Sub Item 1.4</a></li>
  </ul>
</li>
<li><a href="#">Item 3</a></li>
<li><a href="#">Folder 2</a>
  <ul>
  <li><a href="#">Sub Item 2.1</a></li>
  <li><a href="#">Folder 2.1</a>
    <ul>
    <li><a href="#">Sub Item 2.1.1</a></li>
    <li><a href="#">Sub Item 2.1.2</a></li>
    <li><a href="#">Folder 3.1.1</a>
        <ul>
            <li><a href="#">Sub Item 3.1.1.1</a></li>
            <li><a href="#">Sub Item 3.1.1.2</a></li>
            <li><a href="#">Sub Item 3.1.1.3</a></li>
            <li><a href="#">Sub Item 3.1.1.4</a></li>
            <li><a href="#">Sub Item 3.1.1.5</a></li>
        </ul>
    </li>
    <li><a href="#">Sub Item 2.1.4</a></li>
    </ul>
  </li>
  </ul>
</li>
<li><a href="http://www.dynamicdrive.com/style/">Item 4</a></li>
</ul>
<br style="clear: left" />
</div>
*/
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
          url: "'.site_url('ctrmenu/search/').'", 
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

   function doedit(edidmenu){ 
 $(document).ready(function(){ 
 $.ajax({ 
    url: "'.site_url('ctrmenu/editrec/').'", 
   data: "edidmenu="+edidmenu, 
  cache: false, 
 dataType: \'json\', 
     type: \'POST\', 
  success: function(json){ 
       $("#edidmenu").val(json.idmenu); 
       $("#ednmmenu").val(json.nmmenu); 
       $("#edtipemenu").val(json.tipemenu); 
       $("#edidkomponen").val(json.idkomponen); 
       $("#ediduser").val(json.iduser); 
       $("#edparentmenu").val(json.parentmenu); 
       $("#edurlci").val(json.urlci); 
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
 $("#edidmenu").val("0"); 
 $("#ednmmenu").val(""); 
 $("#edtipemenu").val(""); 
 $("#edidkomponen").val(""); 
 $("#ediduser").val(""); 
 $("#edparentmenu").val(""); 
 $("#edurlci").val(""); 
  }); 
 } 
         function dosimpan(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: "'.site_url('ctrmenu/simpan/').'", 
   data: "edidmenu="+$("#edidmenu").val()+"&ednmmenu="+$("#ednmmenu").val()+"&edtipemenu="+$("#edtipemenu").val()+"&edidkomponen="+$("#edidkomponen").val()+"&ediduser="+$("#ediduser").val()+"&edparentmenu="+$("#edparentmenu").val()+"&edurlci="+$("#edurlci").val(), 
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

         function dohapus(edidmenu,ednmmenu){ 
         if (confirm("Anda yakin Akan menghapus data "+ednmmenu+"?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: "'.site_url('ctrmenu/deletetable/').'", 
                 data: "edidmenu="+edidmenu, 
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
           curvyCorners(setting, "div#header h1");   
           curvyCorners(setting, "div#mnhead"); 
          } 
     addEvent(window, \'load\', initCorners); 
          
     dosearch(0); 
     </script> ';
 return $xBufResult;
 }

 function createform($xidmenu,$xAwal=0,$xSearch=''){
  $this->load->helper('form');
    //$this->load->helper('html');
  $xForm = '<div id="stylized" class="myform"> <h2>Pengisian Menu</h2>'.form_open_multipart('ctrmenu/inserttable',array('id'=>'form','name'=>'form')).'<div class="garis"></div>';
  $this->load->model('modelgetmenu'); 
  echo  $this->modelgetmenu->SetViewPerpus($xForm.$this->setDetailFormmenu($xidmenu),$this->getlistmenu($xAwal,$xSearch),'',$this->setAjax());
    
   /*  $xMnKiri = $this->modelgetmenu->getMenuSampingKiri(); 
     $xMnAtas = $this->modelgetmenu->getMenuAtas(); 
     $xMnKanan = $this->modelgetmenu->getMenuSampingKanan(); 
     $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrmenu/inserttable',array('id'=>'form','name'=>'form'));
     $xBufResult .= $this->setDetailFormmenu($xidmenu).'</form></div>';
     $xBufResult .= $this->getlistmenu($xAwal,$xSearch);
     $xShow = setlayout('Header Judul',$xMnAtas,$xBufResult,$xMnKanan,$xMnKiri,'copy right diar'); 
      echo '<!doctype html>      
       <html><head>'.
      link_tag('resource/css/layout.css').
      link_tag('resource/css/font.css').
      link_tag('resource/css/artikel.css').
      link_tag('resource/css/advertise.css').
      link_tag('resource/css/frmlayout.css').
      //link_tag('resource/css/menuatas.css'). 
      link_tag('resource/css/menusamping.css').
      link_tag('resource/css/jqmenuatas.css').

     '
     <!--[if lte IE 7]>
    <style type="text/css">
    html .jqueryslidemenu{height: 1%;} 
    </style>
    <![endif]-->
     <script language="javascript" type="text/javascript" src="'.base_url().'resource/js/jquery.js"></script>'. 
     '<script language="javascript" type="text/javascript" src="'.base_url().'resource/js/jqmenuatas.js"></script>'. 
      $this->setAjax().      '</head>
       <body>'.
       $xShow.
        '</body>   '.
 '</html>';
*/
}

 function setDetailFormmenu($xidmenu){
  $this->load->helper('form'); 
  $this->load->model('modelmenu');
  $this->load->model('modelkomponen');
  $this->load->model('modeltipemenu');
  $row = $this->modelmenu->getDeatilmenu($xidmenu); 
    $xBufResult = '';
   if(empty($row)){
     $xidmenu ='0';
     $xnmmenu ='';
     $xtipemenu ='';
     $xidkomponen ='';
     $xiduser ='';
     $xparentmenu ='';
     $xurlci ='';
 } else 
 { 
 $xidmenu = $row->idmenu; 
 $xnmmenu = $row->nmmenu; 
 $xtipemenu = $row->tipemenu; 
 $xidkomponen = $row->idkomponen; 
 $xiduser = $row->iduser; 
 $xparentmenu = $row->parentmenu; 
 $xurlci = $row->urlci; 
   }
$this->load->helper('common');
  $xBufResult = '<input type="hidden" name="edidmenu" id="edidmenu" value="0" />'. 
  $xBufResult .= setForm('ednmmenu','nmmenu',form_input(getArrayObj('ednmmenu',$xnmmenu,'200'))).'<div class="spacer"></div>';
  $xBufResult .= setForm('edtipemenu','tipemenu',form_dropdown('edtipemenu',$this->modeltipemenu->getArrayListtipemenu(),'0','id="edtipemenu"')).'<div class="spacer"></div>';
  $xBufResult .= setForm('edidkomponen','idkomponen',form_dropdown('edidkomponen',$this->modelkomponen->getArrayListKomponen(),'0','id="edidkomponen"')).'<div class="spacer"></div>';
  $xBufResult .= setForm('ediduser','Apakah Bisa Klik ',form_input(getArrayObj('ediduser','0','200')),'Ketik 0 YA, 1 Tidak').'<div class="spacer"></div>';
  $xBufResult .= setForm('edparentmenu','parentmenu',form_dropdown('edparentmenu',$this->modelmenu->getArrayListmenu(),'0','id="edparentmenu"')).'<div class="spacer"></div>';
  $xBufResult .= setForm('edurlci','urlci',form_input(getArrayObj('edurlci',$xurlci,'100'))).'<div class="spacer"></div>';
  $xBufResult .= '<div class="garis"></div>'.form_button('btSimpan','simpan','onclick="dosimpan();"').form_button('btNew','new','onclick="doClear();"').'<div class="spacer"></div>'; 
 return $xBufResult;
 
}

function  inserttable(){ 
$xidmenu = $_POST['edidmenu'];
$xnmmenu = $_POST['ednmmenu'];
$xtipemenu = $_POST['edtipemenu'];
$xidkomponen = $_POST['edidkomponen'];
$xiduser = $_POST['ediduser'];
$xparentmenu = $_POST['edparentmenu'];
$xurlci = $_POST['edurlci'];

 $this->load->model('modelmenu');
 if($xidmenu!='0'){
     $this->modelmenu->setUpdatemenu($xidmenu,$xnmmenu,$xtipemenu,$xidkomponen,$xiduser,$xparentmenu,$xurlci);
  } else 
 { 
    $this->modelmenu->setInsertmenu($xidmenu,$xnmmenu,$xtipemenu,$xidkomponen,$xiduser,$xparentmenu,$xurlci);
 }
 $this->createform('0'); 
}

  function getlistmenu($xAwal,$xSearch){ 
      $xLimit = 3;
      $this->load->helper('form');
      $this->load->helper('common');
       $xbufResult =addRow(addCell('idmenu','width:30px;',true).
         addCell('nmmenu','width:150px;',true).
         addCell('tipemenu','width:100px;',true).
         //addCell('idkomponen','width:100px;',true).
         //addCell('iduser','width:100px;',true).
         addCell('parentmenu','width:100px;',true).
         addCell('urlci','width:100px;',true).
addCell('Edit/Hapus','width:100px;text-align:center;',true));
       $this->load->model('modelmenu');
       $xQuery = $this->modelmenu->getListmenu($xAwal,$xLimit,$xSearch);
        foreach ($xQuery->result() as $row)
          { 
              $xButtonEdit = '<img src="'.base_url().'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\''.$row->idmenu.'\');" style="border:none;width:20px"/>';
              $xButtonHapus = '<img src="'.base_url().'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\''.$row->idmenu.'\',\''.substr($row->nmmenu,0,20).'\');" style="border:none;">';
              $xbufResult .= addRow(         addCell($row->idmenu,'width:30px;').
         addCell($row->nmmenu,'width:150px;').
         addCell($row->tipemenu,'width:100px;').
         //addCell($row->idkomponen,'width:100px;').
        // addCell($row->iduser,'width:100px;').
         addCell($row->parentmenu,'width:100px;').
         addCell($row->urlci,'width:100px;').
addCell($xButtonEdit.'&nbsp/&nbsp'.$xButtonHapus,'width:100px;'));
          }
        $xButtonADD  = '<img src="'.base_url().'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';  
         $xInput      = form_input(getArrayObj('edSearch','','300')); 
        $xButtonSearch = '<img src="'.base_url().'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />'; 
        $xButtonPrev = '<img src="'.base_url().'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch('.($xAwal-3).');"/>';
        $xButtonNext = '<img src="'.base_url().'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch('.($xAwal+3).');" />';
        $xRowCells = addCell($xButtonADD,'width:100px;height:25px;',true).
                addCell($xInput,'width:300px;border-right:0px;',true).
                addCell($xButtonSearch,'width:60px;height:25px;',true).
                addCell($xButtonPrev.'&nbsp&nbsp'.$xButtonNext,'width:50px;height:25px;',true)
;   return '<div id="tabledata" name ="tabledata" class="tc1" style="width:650px;">'.$xbufResult.$xRowCells.'</div>';   
}


function actionrecord($xIdRec='',$xAction=''){
 $this->load->model('modelmenu');
     switch($xAction){
       case 'edit':
          $this->createform($xIdRec,$this->session->userdata('awal'));
        break;
     case 'hapus':
          $this->modelmenu->setDeletemenu($xIdRec); 
          $this->createform('0');  
       break;
     case 'search' :
        $this->createform('0','0',$xIdRec);
     break; }  
 } 


 function editrec(){ 
   $xIdEdit  = $_POST['edidmenu']; 
   $this->load->model('modelmenu');  
    $row = $this->modelmenu->getDeatilmenu($xIdEdit); 
   $this->load->helper('json'); 
 $this->json_data['idmenu'] = $row->idmenu; 
 $this->json_data['nmmenu'] = $row->nmmenu; 
 $this->json_data['tipemenu'] = $row->tipemenu; 
 $this->json_data['idkomponen'] = $row->idkomponen; 
 $this->json_data['iduser'] = $row->iduser; 
 $this->json_data['parentmenu'] = $row->parentmenu; 
 $this->json_data['urlci'] = $row->urlci; 
   echo json_encode($this->json_data);
   } 

 function deletetable(){ 
 $edidmenu = $_POST['edidmenu']; 
 $this->load->model('modelmenu'); 
 $this->modelmenu->setDeletemenu($edidmenu); 
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
 $this->json_data['tabledata'] = $this->getlistmenu($xAwal,$xSearch); 
 echo json_encode($this->json_data); 
  } 

 function  simpan(){ 
 $this->load->helper('json'); 
   if(!empty($_POST['edidmenu'])) 
 { 
  $xidmenu =  $_POST['edidmenu']; 
   } else{ 
  $xidmenu = '0'; 
  } 
        $xnmmenu = $_POST['ednmmenu'];         $xtipemenu = $_POST['edtipemenu'];         $xidkomponen = $_POST['edidkomponen'];         $xiduser = $_POST['ediduser'];         $xparentmenu = $_POST['edparentmenu'];         $xurlci = $_POST['edurlci'];       $this->load->model('modelmenu'); 
 if($xidmenu!='0'){   $xStr =  $this->modelmenu->setUpdatemenu($xidmenu,$xnmmenu,$xtipemenu,$xidkomponen,$xiduser,$xparentmenu,$xurlci); 
  } else 
  { 
    $xStr =  $this->modelmenu->setInsertmenu($xidmenu,$xnmmenu,$xtipemenu,$xidkomponen,$xiduser,$xparentmenu,$xurlci); 
  } 
 } }
?>