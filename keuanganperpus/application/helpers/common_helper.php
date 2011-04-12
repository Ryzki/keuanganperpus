<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  //class common extends helpers {
//      function common(){
//       parent::helpers();
//      }
//      
           function getArrayObj($xNamaObject,$xValue,$xWidth,$rows=0,$cols=0){
                                            $data = array(
                                                     'name'        => $xNamaObject,
                                                     'id'          => $xNamaObject,
                                                     'value'       => $xValue,
                                                     'style'       => 'width:'.$xWidth.'px;',
                                                     'rows'       => $rows,
                                                     'cols'       => $cols
                                                      );
                         
                      return $data; 
                   }
              function getArrayObjCheckBox($xNamaObject,$xValue,$ischecked,$xWidth,$rows=0,$cols=0){
                                            $data = array(
                                                     'name'        => $xNamaObject,
                                                     'id'          => $xNamaObject,
                                                     'value'       => $xValue,
                                                     'class'       => 'chk',
                                                     'style'       => 'width:'.$xWidth.'px;margin:10px;',
                                                     'checked'     => set_checkbox($xNamaObject, $xValue,$ischecked)
                                                      );

                      return $data;
                   }
                   
   function setForm($xName,$xCaption,$xForm,$xAtrib=''){
           $xBufResult  = '<p> <label for="'.$xName.'">'.$xCaption.'<span class="small">'.$xAtrib.'</span>'.'</label> '.$xForm.'</p>';    
          return $xBufResult;
    }   
    
    function setFormNF($xName,$xCaption,$xForm,$xAtrib=''){
           $xBufResult  = '<dl> <dt> <label for="'.$xName.'">'.$xCaption.'</label></dt> <dd>'.$xForm.'</dd> </dl> ';    
          return $xBufResult;
    }   
    
    function setNFRadio($xName,$xCaption,$xForm,$xAtrib=''){
     $xBufResult  = $xForm.' <label for="'.$xName.'" class ="opt">'.$xCaption.'</label>  ';    
          return $xBufResult;
    }
    
    function setFormNFRadio($xName,$xCaption,$xForm,$xAtrib=''){
           $xBufResult  = '<dl> <dt> <label for="'.$xName.'" >'.$xCaption.'</label></dt>  <dd> '.$xForm.'</dd></dl> ';    
          return $xBufResult;
    }
    
   function setFormNoP($xName,$xCaption,$xForm,$xAtrib=''){
           $xBufResult  = '<label for="'.$xName.'">'.$xCaption.'<span class="small">'.$xAtrib.'</span>'.'</label> '.$xForm.'';    
          return $xBufResult;
    } 
     
    function addCell($xContent,$xStyle,$xisheader=false){
        //width: 150px;
      $xClassCell =''; 
    if($xisheader==true)
      $xClassCell ='class="header"';
      
//    return   '<div class="'.$xClassCell.'" style="'.$xStyle.'">'.$xContent.'</div>';
      return   '<span '.$xClassCell.' style="'.$xStyle.'">'.$xContent.'</span>';
         
   }
   
   function addRow($Cells){
    //  return '<span class="row">'.$Cells.'</div>';    
    return $Cells;
   }
    
  function GetGrid($xRowsCells, $xWidth,$xHeight){
      //return   '<div id="tabledata" name ="tabledata" class="tc1" style="width:'.$xWidth.'px;height:'.$xHeight.'px;">'.$xRowsCells.'<div style="clear:both;"></div></div>';
    return $xRowsCells; 
      
   }  
   
   function addJS($xUrl){
       //alert("http://<?php echo base_url();index.php?/csearch/setviewsearch/"+document.getElementById('edSearch').value+"/0"); 
       //csearch/setviewsearch/"+document.getElementById("edSearch").value+"/0"
   return  ' <script type="text/javascript">'.
       '   function edit(idrec){'.
       '     document.location="index.php?/'.$xUrl.'/"+idrec+"/edit";'.
       '    }'.
       '   function search(idrec){'.
       ' if(document.getElementById(\'edSearch\').value!=""){'.
       '     document.location="index.php?/'.$xUrl.'/"+document.getElementById(\'edSearch\').value+"/search";'.
       '    }'.
       '    }'.
       '   function hapus(idrec,ket){'.
       ' if (confirm("Anda yakin Akan menghapus data "+ket+"?")) {'.
       '      document.location="index.php?/'.$xUrl.'/"+idrec+"/hapus";'.
       '     }'.
       '  }'.
       '</script>     ';

   }
   
  function setlayout($xHeader,$xMnHeader,$xContent,$xMnKanan,$xMnKiri,$xFooter){
  return   ' <div id="container">'.               
            '  <div id="header"><h1><div>'.$xHeader.'</div></h1></div>'.
            '  <div id="logovoxus"><h1><img src="'.base_url().'resource/images/voxuslogo.png" width="100%" height="100%"/></h1></div>'.
             ' <div id="mnhead"><div id="myslidemenu"  class="jqmenuatas">'.$xMnHeader.'</div></div>'.
             '  <div id="wrapper">'.
             '     <div id="contentx">'.
                   $xContent.   
             '    </div>'.
             ' <div id="extra"><p> '.$xMnKiri.'</p></div>   </div>'.
            ' <div id="navigation"><p>'.$xMnKanan.'</p></div>'.
            //' <div id="extra"><p> '.$xMnKiri.'</p></div>'.
            ' <div id="footer"><p>'.$xFooter.'</p></div>
            
            </div>';
} 

function setlayoutview($xHeader,$xMnHeader,$xContent,$xImageView,$xFooterMenu,$xFooter){
  return   ' <div id="container">'.
           '<div id="footer"><p><marquee behavior="scroll" direction="left">SEKOLAH TIARA KASIH, DEMO WEB, SEKOLAH TIARA KASIH, DEMO WEB,  SEKOLAH TIARA KASIH, DEMO WEB</marquee></p></div>'.
           '  <div>'.$xHeader.'</div>'.
            //'  <div id="logovoxus"><h1><img src="'.base_url().'resource/images/voxuslogo.png" width="100%" height="100%"/></h1></div>'.
            // ' <div id="mnhead"><div id="myslidemenu"  class="jqmenuatas">'.$xMnHeader.'</div></div>'.
             '  <div id="wrapper">'.
             '     <div id="contentview" class="contentview">'.
             //'        <div id="homeview">'.$xContent.'</div>'.
             //'        <div id="gambarview1"><img src="'.base_url().'resource/css/img/tebudigital.png" width="400px" height="50px"/></div>'.
            // '        <div id="keterangan">Membangun Sistem Informasi Dengan Teknologi Terkini</div>'.
             '        <div id="gambarview2">'.$xImageView.'</div>'.
           //  '        <div id="gambarview3">gambarview3</div>'.
             '    </div> '.
             ' </div>'.
             //' <div id="extra"><p> '.$xMnKiri.'</p></div>   </div>'.
            //' <div id="navigation"><p>'.$xMnKanan.'</p></div>'.
            //' <div id="extra"><p> '.$xMnKiri.'</p></div>'.
            ' <div>'.$xFooterMenu.'</div>
            <div id="footer"><p>'.$xFooter.'</p></div>
            
            </div>';
} 

function setlayoutviewdetail($xHeader,$xMnHeader,$xContent,$xImageView,$xFooterMenu,$xFooter){
  if(empty ($xContent))
   $xContent = 'kosong'  ;
  return   ' <div id="container">'.
           '<div id="footer"><p><marquee behavior="scroll" direction="left">SEKOLAH TIARA KASIH, DEMO WEB, SEKOLAH TIARA KASIH, DEMO WEB,  SEKOLAH TIARA KASIH, DEMO WEB</marquee></p></div>'.
           '  <div>'.$xHeader.'</div>'.
           '  <div id="wrapper">'.
           '     <div id="contentviewdetail" class="contentview">'.
           '        <div id="homeviewdetail">'.$xContent.'</div>'.
             '    </div> '.
             ' </div>'.
             ' <div>'.$xFooterMenu.'</div>
              <div id="footer"><p>'.$xFooter.'</p></div>
            
            </div>';
}

function setlayoutNF($xHeader,$xMnHeader,$xContent,$xMnKanan,$xFooterMenu,$xFooter){
   return   '  <div id="container">'.
           '<div id="footer"><p><marquee behavior="scroll" direction="left">SEKOLAH TIARA KASIH, DEMO WEB, SEKOLAH TIARA KASIH, DEMO WEB,  SEKOLAH TIARA KASIH, DEMO WEB</marquee></p></div>'.
           '  <div>'.$xHeader.'</div>'.

            //'  <div id="logovoxus"><h1><img src="'.base_url().'resource/images/voxuslogo.png" width="100%" height="100%"/></h1></div>'.
            // ' <div id="mnhead"><div id="myslidemenu"  class="jqmenuatas">'.$xMnHeader.'</div></div>'.
            '    <div id="wrapper">'.
            '     <div id="contentv" class="contentv">'.
            '        <div id="contentadmin">'.$xContent.'</div>'.
             //'        <div id="gambarview1"><img src="'.base_url().'resource/css/img/tebudigital.png" width="400px" height="50px"/></div>'.
             //'        <div id="gambarview1"></div>'.
            // '        <div id="gambarview2">'.$xImageView.'</div>'.
           //  '        <div id="gambarview3">gambarview3</div>'.
             '      </div> '.
             '   </div>'.
             //' <div id="extra"><p> '.$xMnKiri.'</p></div>   </div>'.
            ' <div id="navigation"><p>'.$xMnKanan.'</p></div>'.
            //' <div id="extra"><p> '.$xMnKiri.'</p></div>'.
            ' <div>'.$xFooterMenu.'</div>
            <div id="footer"><p>'.$xFooter.'</p></div>

            </div>';

      /*  return   ' <div id="container">'.
            '  <div id="header"><h1>'.$xHeader.'</h1></div>'.
             ' <div id="mnhead"><div id="myslidemenu"  class="jqmenuatas">'.$xMnHeader.'</div></div>'.
             '  <div id="wrapper">'.
             '    <div id="contentNF">'.
                 $xContent.
             '    </div>'.
             '    </div>'.
            //' <div id="navigation"><p>'.$xMnKanan.'</p></div>'.
            ' <div id="extra"><p> '.$xMnKiri.'</p></div>'.
            ' <div id="footer"><p>'.$xFooter.'</p></div>

            </div>';
 */}

function setviewperpus($xMnHeader,$xContent,$xKet,$xGambarKiri,$xMnKanan){
   
  return   ' <div id="utama">
               <div id="kop">
                 <div id="logo"><img src="'.base_url().'resource/images/logo.png" width="100px" height="100px"/></div>
                 <div id="kopperpus">SISTEM INFORMASI ADMINISTRASI KEUANGAN TERPADU<br /><br />
                                     PERPUSTAKAAN UNIVERSITAS SANATA DHARMA
                                  </div>
              </div>

             
                <div id="isi">
                <div id="mnhead"><div id="myslidemenu"  class="jqmenuatas">'.$xMnHeader.'</div></div>
                <div id="navigation">'.$xMnKanan.'</div>'.
                  $xContent.'
                  
                  </div>

                

              </div> <!-- end Of Utama -->';
            



  
      

} 
 
 
?>
