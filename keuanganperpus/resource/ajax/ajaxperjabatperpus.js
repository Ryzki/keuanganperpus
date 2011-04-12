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
          url: getBaseURL()+"index.php/ctrperjabatperpus/search/", 
          data: "xAwal="+xAwal+"&xSearch="+xSearch, 
          cache: false, 
          dataType: 'json', 
          type: 'POST', 
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

   function doedit(edidx){ 
 $(document).ready(function(){ 
 $.ajax({ 
    url: getBaseURL()+"index.php/ctrperjabatperpus/editrec/", 
   data: "edidx="+edidx, 
  cache: false, 
 dataType: 'json', 
     type: 'POST', 
  success: function(json){ 
       $("#edidx").val(json.idx); 
       $("#edidPegawai").val(json.idPegawai); 
       $("#edidjabatan").val(json.idjabatan); 
       $("#edtglawaljawabatan").val(json.tglawaljawabatan); 
       $("#edtglakhirjabatan").val(json.tglakhirjabatan); 
       $("#edidunitkerja").val(json.idunitkerja); 
     }, 
 error: function (xmlHttpRequest, textStatus, errorThrown) { 
 start = xmlHttpRequest.responseText.search("<title>") + 7; 
     end = xmlHttpRequest.responseText.search("</title>"); 
 errorMsg = "OnEdit "; 
 if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
  else 
 alert("Error juga "+errorMsg); 
 } 
 }); 
 }); 
 } 
 function doClear(){ 
 $(document).ready(function(){ 
 $("#edidx").val("0"); 
 $("#edidPegawai").val(""); 
 $("#edidjabatan").val(""); 
 $("#edtglawaljawabatan").val(""); 
 $("#edtglakhirjabatan").val(""); 
 $("#edidunitkerja").val(""); 
  }); 
 } 
         function dosimpan(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrperjabatperpus/simpan/", 
   data: "edidx="+$("#edidx").val()+"&edidPegawai="+$("#edidPegawai").val()+"&edidjabatan="+$("#edidjabatan").val()+"&edtglawaljawabatan="+$("#edtglawaljawabatan").val()+"&edtglakhirjabatan="+$("#edtglakhirjabatan").val()+"&edidunitkerja="+$("#edidunitkerja").val(), 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
                 success: function(msg){ 
                     doClear(); 
                     dosearch('-99'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                     start = xmlHttpRequest.responseText.search("<title>") + 7; 
                     end = xmlHttpRequest.responseText.search("</title>"); 
                     errorMsg =  " On Simpan "; 
                     if (start > 0 && end > 0) 
                         alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
                     else 
                         alert("Error juga "+errorMsg); 
               } 
           }); 
         }); 
         } 

         function dohapus(edidx,edidPegawai){ 
         if (confirm("Anda yakin Akan menghapus data "+edidPegawai+"?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrperjabatperpus/deletetable/", 
                 data: "edidx="+edidx, 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
                 success: function(json){ 
                    doClear(); 
                    dosearch('-99'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                     start = xmlHttpRequest.responseText.search("<title>") + 7; 
                     end = xmlHttpRequest.responseText.search("</title>"); 
                     errorMsg = " HAPUS "; 
                     if (start > 0 && end > 0) 
                         alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
                     else 
                         alert("Error juga "+errorMsg); 
               } 
           }); 
         }); 
        } 
        } 


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
     addEvent(window, 'load', initCorners); 
     dosearch(0); 


