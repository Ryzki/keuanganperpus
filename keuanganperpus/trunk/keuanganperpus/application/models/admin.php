<?php if (!defined('BASEPATH'))exit('Tidak Diperkenankan mengakses langsung');

class admin extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

function setAjax() {
   $xBufResult = '<script language="javascript" type="text/javascript">
   function dosearch(xAwal){ 
   xSearch =""; 
    try 
        { if ($("#edSearch").val()!=""){ 
              xSearch = $("#edSearch").val();
        } 
         }catch(err){ 
          xSearch =""; 
         } 
         
   if (typeof(xSearch) ==="undefined"){ 
        xSearch =""; 
      } 
    
  $(document).ready(function(){ 
  $.ajax({ 
          url: "' . site_url('admin/search/') . '",
          data: "xAwal="+xAwal+"&xSearch="+xSearch+"&xIdMenu="+$("#edidmenu").val(), 
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
              alert("This Is "+errorMsg);  
         } 
         }); 
       }); 
    } 

   function doedit(edidtranslete){ 
 $(document).ready(function(){ 
 $.ajax({ 
    url: "' . site_url('admin/editrec/') . '",
   data: "edidtranslete="+edidtranslete, 
  cache: false, 
 dataType: \'json\', 
     type: \'POST\', 
  success: function(json){ 
       $("#edidtranslete").val(json.idtranslete); 
       //$("#edisi").val(json.isi); 
       tinyMCE.activeEditor.setContent(json.isi);
       
     //tinyMCE.get(\'text\').getContent   
  //     $("#edidbahasa").val(json.idbahasa); 
  //     $("#edidfield").val(json.idfield); 
  //     $("#edidmenu").val(json.idmenu); 
   //    $("#edidkomponen").val(json.idkomponen); 
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
         $("#edidtranslete").val("0"); 
         // $("#edidmenu").val("0"); 
         $("#edisi").val(""); 
         tinyMCE.activeEditor.setContent("");

         
        // $("#edidbahasa").val(""); 
        // $("#edidfield").val(""); 
        // $("#edidmenu").val(""); 
        // $("#edidkomponen").val(""); 
          }); 
         } 
         
         function dosimpan(){ 
         $(document).ready(function(){ 
          
           $.ajax({ 
                 url: "' . site_url('admin/simpan/') . '",
                 data: "edidtranslete="+$("#edidtranslete").val()+"&edisi="+tinyMCE.activeEditor.getContent()+
                        "&edidmenu="+$("#edidmenu").val()+"&edidkomponen="+$("#edidkomponen").val(), 
                 cache: false, 
                 dataType: \'json\', 
                 type: \'POST\', 
                 success: function(json){ 
                //   doClear(); 
                  dosearch(\'-99\');
                 // tinyMCE.activeEditor.setContent(json.edisi);
                 //  alert(tinyMCE.activeEditor.getContent()); 
                 
                 alert("Data Sudah Di simpan");       
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

    
         function dohapus(edidtranslete){ 
         if (confirm("Anda yakin Akan menghapus data ini?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: "' . site_url('admin/deletetable/') . '",
                 data: "edidtranslete="+edidtranslete, 
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
        //doClear(); 
     </script> 
     <script language="javascript" type="text/javascript">
       $(document).ready(function() {
       function addMCE()
       {
            tinyMCE.execCommand(\'mceRemoveControl\',false,\'id_news_text\');
        tinyMCE.init({
            theme:\'advanced\',
            mode:\'none\'
        });
        tinyMCE.execCommand(\'mceAddControl\',false,\'id_news_text\');
        }


         $("textarea.tinymce").tinymce({                
         script_url : "' . base_url() . 'resource/js/tiny_mce/tiny_mce.js",

               mode : "none",
               theme : "advanced",
                skin : "o2k7",
             plugins : "spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",        
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        //theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

            theme_advanced_buttons3_add : "media",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            extended_valid_elements : "hr[class|width|size|noshade]",
            file_browser_callback : "ajaxfilemanager",
            paste_use_dialog : false,
            theme_advanced_resizing : true,
            theme_advanced_resize_horizontal : true,
            apply_source_formatting : true,
            force_br_newlines : true,
            force_p_newlines : false,    
            relative_urls : true

                });
            });
          

        function ajaxfilemanager(field_name, url, type, win) {
            var ajaxfilemanagerurl = "../../../resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
            switch (type) {
                case "image":
                    break;
                case "media":
                    break;
                case "flash": 
                    break;
                case "file":
                    break;
                default:
                    return false;
            }
            
            tinyMCE.activeEditor.windowManager.open({
                url: "../../../resource/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
                width: 700,
                height: 540,
                inline : "yes",
                modal:true,
                close_previous : "no",
                overlay: {
                backgroundColor:"#000000",
                opacity:.75
                         },
               open: function() {
                setTimeout(\'addMCE()\',2000);
            },
            beforeclose:
                function(){
                    tinyMCE.execCommand(\'mceRemoveControl\',false,\'id_news_text\');
                }          
                
            },{
                window : win,
                input : field_name
            });
        
        
        }
        
     

   </script>
   
     <script type="text/javascript">
        function setImage(file) {
          //alert("Harusnya Set image" + file);
            if(document.all){
  
             document.getElementById(\'previewh\').src = file;
            
             
              }  
            else{
            document.getElementById(\'previewh\').src = file;
            
            }
        }
        </script>
  
      <script type="text/javascript"> 
      $(document).ready(function() {
       $(\'#edgambar\').uploadify({
           \'uploader\': \'' . base_url() . 'resource/js/uploadify/uploadify.swf\',
           \'script\': \'' . base_url() . 'resource/js/uploadify/uploadify.php\',
           //\'script\': \'' . site_url() . '/ctrupload/uploadfile/\',
           \'folder\': \'./resource/uploaded\',
        \'multi\': true,
        \'auto\': true,
        \'fileExt\': \'*.jpg;*.jpeg;*.png;*.gif\',
        \'buttonText\': \'Browse...\',
        \'cancelImg\': \'' . base_url() . 'resource/js/uploadify/cancel.png\',
         \'onError\' : function (a, b, c, d) {
                                 if (d.status == 404)
                                    alert(\'Could not find upload script.\');
                                 else if (d.type === "HTTP")
                                    alert(\'error \'+d.type+": "+d.status);
                                 else if (d.type ==="File Size")
                                    alert(c.name+\' \'+d.type+\' Limit: \'+Math.round(d.sizeLimit/1024)+\'KB\');
                                 else
                                    alert(\'error \'+d.type+": "+d.text);
                            },
        \'onComplete\'     : function(event, queueID, fileObj, response, data) {
                 
                 
           // var img_gal = $(\'<img>\').attr({
              $(\'#previewg\').attr({
                    src: "' . base_url() . 'resource/uploaded/"+fileObj.name,
                    alt: fileObj.name,
                    }).css({
                    position : "relative",
                    top :-30,
                    height: "50px",
                    left:"150px",
                    width : "50px",

                    
                    });   
              //var a_gal = $(\'#preview\').attr({
              $(\'#preview\').attr({
                    href: "' . base_url() . 'resource/uploaded/"+fileObj.name,
                    
                    class : "thickbox",
                    alt: fileObj.name,
                    title: fileObj.name,
                    }).css({
                          top :-30,
                          position : "relative",
                          height: "50px",
                          width : "50px",
                          left:"50px",
                          left:"150px",
                                              });
                $(\'#edidgambar\').val(fileObj.name);    
                
               // a_gal.append(img_gal); 
             // $(\'#gambar\').empty();      
             // $(\'#gambar\').append(a_gal); 
              
             
             // setImage("' . base_url() . 'resource/uploaded/"+fileObj.name);
              
        },
        \'onAllComplete\'     : function() {
             // setImage(fileObj[\'name\']);
                 
        }

      });
         });  
      </script>    
     ';
        return $xBufResult;
    }

    function setAjaxLogin(){
    return  '
    <script type="text/javascript">
    function dologin(){
         $(document).ready(function(){

           $.ajax({
                 url: "' . site_url('admin/dologin/') . '",
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
        

        $xLogin = $this->session->userdata('user');
        if (!empty ($xLogin)) {
            $this->createform($xidmenu, '0', '');
        } else {
            $this->createformlogin($xidmenu, '0', '');
        }
      
    }

    function createform($xidmenu, $xAwal='0', $xSearch='') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('common');
        $this->load->model('modelgetmenu');
        $this->load->model('modelmenu');
        $xBufResult = '';
        $xForm = $this->getformbymenu($xidmenu);

        //$xAddJs = '<script language="javascript" type="text/javascript" src="'.base_url().'resource/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>';
     $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css').
                //link_tag('resource/css/thickbox.css').
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxadmin.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>';
     
        $xRowMenu = $this->modelmenu->getDeatilmenu($xidmenu);
        $xShowList = '';
        if (!empty($xRowMenu))
            if ($xRowMenu->tipemenu == '2') {
                $xShowList = $this->getlisttranslete($xAwal, $xSearch, $xidmenu);
            }

        echo $this->modelgetmenu->SetAdminDolphin($xForm , $xShowList, '', $xAddJs);
    }

    function createformlogin($xidmenu, $xAwal='0', $xSearch='') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('common');
        $this->load->model('modelgetmenu');
        $this->load->model('modelmenu');
        $xBufResult = '';


        $xForm = '<div id="stylized" class="myform" ><h1>Login</h1><div class="garis"> </div>';

        $xForm .= form_open_multipart('ctrtranslete/inserttable', array('id' => 'form', 'name' => 'form'));
        //$xForm .= '<textarea name="content" type="hiden" id="edisi" class="tinymce"></textarea>';
        $xForm .= setForm('edUser', 'User', form_input(getArrayObj('edUser','', '100'))) . '<div class="spacer"></div>';
        $xForm .= setForm('edPassword', 'Password', form_password(getArrayObj('edPassword','', '100'))) . '<div class="spacer"></div>';
        $xForm .= '<div class="garis"></div>'.form_button('btLogin', 'login', 'onclick="dologin();"') . form_button('btCancel', 'Cancel', 'onclick="doClearLogin();"') . '<div class="spacer"></div>';


        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css').
                //link_tag('resource/css/thickbox.css').
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxadmin.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxuploadfy.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce.js"></script>';

        echo $this->modelgetmenu->SetAdminDolphin($xForm, '', 'login', $xAddJs,'' );
    }

    function getformbymenu($xidMenu) {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('common');
        $this->load->model('modelmenu');
        $this->load->model('modeltranslete');
        $this->load->model('modelimage');
        $row = $this->modelmenu->getDeatilmenu($xidMenu);
        $xRow = $this->modeltranslete->getDeatiltransleteWhere(" Where idmenu = '" . $xidMenu . "'");
    //    $xRowImage = $this->modelimage->getDetailimage($row->idmenu, $row->idkomponen);

        $xidx = '0';
        $xisi = '0';

        if (!empty($xRow)) {
            $xidx = $xRow->idtranslete;
            $xisi = $xRow->isi;
        }

        //$xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrtranslete/inserttable',array('id'=>'form','name'=>'form'));
        $xJudul = '';
        if (!empty($row)) {
//            if (!empty($xRowImage->imgurl)) {
//                $xgambar = '<a href ="' . base_url() . 'resource/uploaded/' . $xRowImage->imgurl .
//                        '" class="thickbox" id="preview" ><img src="' . base_url() . 'resource/uploaded/' . $xRowImage->imgurl . '" id="previewg" /></a>';
//            } else {
//                $xgambar = '<a href ="' . base_url() . 'resource/uploaded/white.png' .
//                        '" class="thickbox" id="preview" ><img src="' . base_url() . 'resource/uploaded/white.png" id="previewg" /></a>';
//            }

            $xJudul = $row->nmmenu;
            $xForm = '<div id="stylized" class="myform" ><h1>Isi / Edit ' . $xJudul . '</h1><div class="garis"> </div>';
            $xForm .= '' . form_open_multipart('ctrtranslete/inserttable', array('id' => 'form', 'name' => 'form'));
            $xForm .= '<input type="hidden" name="edidtranslete" id="edidtranslete" value="' . $xidx . '" />';
            $xForm .= '<input type="hidden" name="edidtranslete" id="edidmenu" value="' . $xidMenu . '" />';
            $xForm .= '<input type="hidden" name="edidkomponen" id="edidkomponen" value="' . $row->idkomponen . '" />';
//            if (!empty($xRowImage->imgurl)) {
//                $xForm .= '<input type="hidden" name="edidgambar" id="edidgambar" value="' . $xRowImage->imgurl . '" />';
//            } else {
//                $xForm .= '<input type="hidden" name="edidgambar" id="edidgambar" value="" />';
//            }

            $xForm .= '<textarea name="content" id="edisi" class="tinymce">' . $xisi . '</textarea>';
            // $xForm .= setForm('content','',form_textarea(getArrayObj('content',$xisi,'100'),' class="tinymce" row="20" col="300"'));
            //$xForm .= '<div class="garis"></div><div id="gambar">gambar </div>' . setForm('edgambar', '', form_input(array("id" => "edgambar", "name" => "edgambar", "type" => "file"))) . $xgambar . '<div class="spacer"></div>';
            $xForm .= '<div class="spacer"></div>' . '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="             doClear();"') . '<div class="spacer"></div>';
        } else
            $xForm = '<div id="stylized" class="myform" ><h1>Administrasi Web</h1><div class="garis"> </div>' . form_open_multipart('ctrtranslete/inserttable', array('id' => 'form', 'name' => 'form'));
        return $xForm;
    }

    function getlisttranslete($xAwal, $xSearch, $xIdxMenu) {
        $xLimit = 3;
        $this->load->helper('form');
        $this->load->helper('common');
        $xRowCells = addCell('ID ', 'width:30px;', true) .
                addCell('Isi Menu', 'width:400px;', true) .
                addCell('Edit/Hapus', 'width:100px;text-align:center;', true);

        $xbufResult = addRow($xRowCells);
        $this->load->model('modeltranslete');
        //Where isi like '%".$xSearch."%'"
        $xWhere = '';
        if (!empty($xSearch)) {
            $xWhere = ' Where (idmenu = ' . $xIdxMenu . ') and (isi like "%' . $xSearch . '%")';
        } else {
            $xWhere = ' Where idmenu = ' . $xIdxMenu . ' ';
        }

        $xQuery = $this->modeltranslete->getListtranslete($xAwal, $xLimit, $xWhere);

        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idtranslete . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idtranslete . '\');" style="border:none;">';

            $xbufResult .= addRow(addCell($row->idtranslete, 'width:30px;') .
                            addCell(substr(strip_tags($row->isi), 0, 200), 'width:400px;') .
                            addCell($xButtonEdit . '&nbsp;/&nbsp;' . $xButtonHapus, 'width:100px;'));

            //$xbufResult .= addRow($xRowCells);
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '150'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';

        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - 3) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + 3) . ');" />';

        $xRowCells = addCell($xButtonADD, 'width:30px;', true) .
                addCell($xInput, 'width:200px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:45px;border-left:0px;border-right:0px;text-align:center;', true) .
                addCell($xButtonPrev, 'width:50px;text-align:center;border-right:0px;border-left:0px;', true) .
                addCell($xButtonNext, 'width:50px;text-align:center;border-left:0px;', true);

        return '<div id="tabledata" name ="tabledata" class="tc1" style="width:575px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function dologin() {
        $edUser = $_POST['edUser'];
        $edPassword = $_POST['edPassword'];
        $this->load->model('modelagen');
        $rowuser = $this->modelagen->getlogin($edUser,$edPassword);
        $this->json_data['data'] = false;
        if(!empty ($rowuser)){
            $this->session->set_userdata('user', $rowuser->iduser);
            $this->json_data['data'] = true;
            $this->json_data['location'] = site_url()."/admin/index/1";
        }
       echo json_encode($this->json_data);
        
    }

    function search() {
        $xAwal = $_POST['xAwal'];
        $xSearch = $_POST['xSearch'];
        $xIdMenu = $_POST['xIdMenu'];

        $this->load->helper('json');
        $this->json_data['tabledata'] = 'OK';

        if (($xAwal + 0) == -99) {
            $xAwal = $this->session->userdata('awal', $xAwal);
        }
        if ($xAwal + 0 <= -1) {
            $xAwal = 0;
            $this->session->set_userdata('awal', $xAwal);
        } else {
            $this->session->set_userdata('awal', $xAwal);
        }

        $this->load->model('modelmenu');
        $this->load->model('modeltranslete');
        $xRowMenu = $this->modelmenu->getDeatilmenu($xIdMenu);
        $this->json_data['tabledata'] = '';
        if (!empty($xRowMenu))
            if ($xRowMenu->tipemenu == '2') {
                $this->json_data['tabledata'] = $this->getlisttranslete($xAwal, $xSearch, $xIdMenu);
            } else {
                $this->json_data['tabledata'] = '';
            }
        echo json_encode($this->json_data);
    }

    function editrec() {
        $xIdEdit = $_POST['edidtranslete'];
        $this->load->model('modeltranslete');
        $row = $this->modeltranslete->getDeatiltranslete($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idtranslete'] = $row->idtranslete;
        $this->json_data['isi'] = $row->isi;
        $this->json_data['idbahasa'] = $row->idbahasa;
        $this->json_data['idfield'] = $row->idfield;
        $this->json_data['idmenu'] = $row->idmenu;
        $this->json_data['idkomponen'] = $row->idkomponen;
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidtranslete = $_POST['edidtranslete'];
        $this->load->model('modeltranslete');
        $this->modeltranslete->setDeletetranslete($edidtranslete);
    }
function utf8_urldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');;
  }
    function simpan() {

        //strip_tags($text);
        $this->load->helper('json');
        if (!isset($_POST['edidtranslete'])) {
            $xidtranslete = '0';
        }

        if (!empty($_POST['edidtranslete'])) {
            $xidtranslete = $_POST['edidtranslete'];
        } else {
            $xidtranslete = '0';
        }

        $xisi = $_POST['edisi'];
        $xisi = $this->utf8_urldecode($xisi);
        $xidmenu = $_POST['edidmenu'];
        //$ximgurl = $_POST['edidgambar'];
        $xidbahasa = '1';
        $xidfield = '1';

        $xidkomponen = $_POST['edidkomponen'];
        ;

        $this->load->model('modeltranslete');
        $this->load->model('modelimage');


        $xRow = $this->modeltranslete->getDeatiltransleteWhere(" Where idmenu = '" . $xidmenu . "'");

        $xShowList = '';
        $this->load->model('modelmenu');
        $xRowMenu = $this->modelmenu->getDeatilmenu($xidmenu);
        if (!empty($xRowMenu))
            if ($xRowMenu->tipemenu == '2') {
                $xRow = $this->modeltranslete->getDeatiltransleteWhere(" Where (idmenu = '" . $xidmenu . "') and (idtranslete='" . $xidtranslete . "')");
            }



        if (!empty($xRow)) {
            $xStr = $this->modeltranslete->setUpdatetranslete($xRow->idtranslete, $xisi, $xidbahasa, $xidfield, $xidmenu, $xidkomponen);
            //Function setInsertimage($xidimage,$ximgurl,$xidmenu,$xidField,$xidkomponen)


            $this->json_data['edisi'] = $xStr;
        } else {
            $xStr = $this->modeltranslete->setInserttranslete($xidtranslete, $xisi, $xidbahasa, $xidfield, $xidmenu, $xidkomponen);

            $this->json_data['edisi'] = $xStr;
        }

    //    $this->modelimage->setDeleteimage($xidmenu, $xidkomponen);
     //   $this->modelimage->setInsertimage($xRow->idtranslete, $ximgurl, $xidmenu, '0', $xidkomponen);

        $this->json_data['edisi'] = $xStr;
        echo json_encode($this->json_data);
    }

    
}

?>
