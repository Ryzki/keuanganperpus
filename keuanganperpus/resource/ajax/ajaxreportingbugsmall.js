 function getBaseUR() {
    var url = location.href;
    //********* entire url including querystring - also: window.location.href;**********
    var baseURL = url.substring(0, url.indexOf('/', 14));


    if (baseURL.indexOf('http://localhost') != -1) {
        // Base Url for localhost
        var url = location.href;  // window.location.href;
        var pathname = location.pathname;  // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);

        return baseLocalUrl + "/";
    }
    else {
        // Root Url for domain name
        return baseURL + "/";
    }
 }

         function dosimpanreportingbug(){
         //alert(document.URL);
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseUR()+"index.php/ctrreportingbug/simpansmall/",
                 data: "edlokasi="+document.URL+"&edketeranganbug="+$("#edketeranganbug").val(),
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
                 success: function(json){
                 $("#edketeranganbug").val("");
                 alert("Terimakasih Anda Sudah Berpartisipasi dalam pengembangan Software ini");
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

