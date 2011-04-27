/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Base url :  src="http://localhost/tebu-digital/resource/js/jquery.js"
 * site URL : http://localhost/tebu-digital/index.php/voxus/setView
 */


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
            //url: "' . site_url('admin/search/') . '",
            url: getBaseURL()+"index.php/perpus/search/",
            data: "xAwal="+xAwal+"&xSearch="+xSearch+"&xIdMenu="+$("#edidmenu").val(),
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
                    alert("This Is "+errorMsg);
            }
        });
    });
}

function doedit(edidtranslete){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/perpus/editrec/",
            data: "edidtranslete="+edidtranslete,
            cache: false,
            dataType: 'json',
            type: 'POST',
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
            url: getBaseURL()+"index.php/perpus/simpan/",
            data: "edidtranslete="+$("#edidtranslete").val()+"&edisi="+encodeURIComponent(tinyMCE.activeEditor.getContent())+
                "&edidmenu="+$("#edidmenu").val()+"&edidkomponen="+$("#edidkomponen").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                //   doClear();
                dosearch('-99');
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
                url: getBaseURL()+"index.php/perpus/deletetable/",
                data: "edidtranslete="+edidtranslete,
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

    function dologin(){
         $(document).ready(function(){
          //alert($("#edUser").val()+"  "+$("#edPassword").val()+getBaseURL()+"index.php/perpus/dologin/");
           $.ajax({
                 url: getBaseURL()+"index.php/perpus/dologin/",
                 data: "edUser="+$("#edUser").val()+"&edPassword="+$("#edPassword").val()+"&edidlokasi="+$("#edidlokasi").val(),
                 cache: false,
                 dataType: 'json',
                 type: 'POST',
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
                     errorMsg =  " on Do Login";
                     if (start > 0 && end > 0)
                         alert("Ada Script Error "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                     else
                         alert("Error CI Script "+errorMsg);
               }
           });
         });
         }
