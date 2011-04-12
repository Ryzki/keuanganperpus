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
          url: getBaseURL()+"index.php/ctrtransaksi/search/", 
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
    url: getBaseURL()+"index.php/ctrtransaksi/editrec/", 
   data: "edidx="+edidx, 
  cache: false, 
 dataType: 'json', 
     type: 'POST', 
  success: function(json){ 
       $("#edidx").val(json.idx); 
       $("#edidplu").val(json.idplu); 
       $("#edidjenistransaksi").val(json.idjenistransaksi); 
       $("#edidpegawai").val(json.idpegawai); 
       $("#edidunitkerja").val(json.idunitkerja); 
       $("#edidstatusdinas").val(json.idstatusdinas); 
       $("#edtanggal").val(json.tanggal); 
       $("#edjam").val(json.jam); 
       $("#edjumlahsatuan").val(json.jumlahsatuan); 
       $("#ednominalpersatuan").val(json.nominalpersatuan); 
       $("#edtotal").val(json.total); 
       $("#ediduser").val(json.iduser); 
       $("#ednominaldenda").val(json.nominaldenda); 
       $("#ediddendasparta").val(json.iddendasparta); 
       $("#edidlokasi").val(json.idlokasi); 
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
 $("#edidplu").val(""); 
 $("#edidjenistransaksi").val(""); 
 $("#edidpegawai").val(""); 
 $("#edidunitkerja").val(""); 
 $("#edidstatusdinas").val(""); 
 $("#edtanggal").val(""); 
 $("#edjam").val(""); 
 $("#edjumlahsatuan").val(""); 
 $("#ednominalpersatuan").val(""); 
 $("#edtotal").val(""); 
 $("#ediduser").val(""); 
 $("#ednominaldenda").val(""); 
 $("#ediddendasparta").val(""); 
 $("#edidlokasi").val(""); 
  }); 
 } 
         function dosimpan(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrtransaksi/simpan/", 
   data: "edidx="+$("#edidx").val()+"&edidplu="+$("#edidplu").val()+"&edidjenistransaksi="+$("#edidjenistransaksi").val()+"&edidpegawai="+$("#edidpegawai").val()+"&edidunitkerja="+$("#edidunitkerja").val()+"&edidstatusdinas="+$("#edidstatusdinas").val()+"&edtanggal="+$("#edtanggal").val()+"&edjam="+$("#edjam").val()+"&edjumlahsatuan="+$("#edjumlahsatuan").val()+"&ednominalpersatuan="+$("#ednominalpersatuan").val()+"&edtotal="+$("#edtotal").val()+"&ediduser="+$("#ediduser").val()+"&ednominaldenda="+$("#ednominaldenda").val()+"&ediddendasparta="+$("#ediddendasparta").val()+"&edidlokasi="+$("#edidlokasi").val(), 
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

         function dohapus(edidx,edidplu){ 
         if (confirm("Anda yakin Akan menghapus data "+edidplu+"?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrtransaksi/deletetable/", 
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


