function dosearch(xAwal){ 
    
    $(document).ready(function(){
        $("#edidrab").attr('disabled',true);
        $.ajax({
            url: getBaseURL()+"index.php/ctrrealisasirab/search/",
            data: "xAwal="+xAwal+"&xSearch="+$("#edidrab").val(),
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
            url: getBaseURL()+"index.php/ctrrealisasirab/editrec/",
            data: "edidx="+edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#ednominal").attr('disabled',false);
                $("#edidx").val(json.idx);
                $("#edtanggal").val(json.tanggal);
                $("#edjam").val(json.jam);
                $("#edidrab").val(json.idrab);
                $("#edketerangan").val(json.keterangan);
                $("#ednominal").val(json.nominal);
                $("#ediduser").val(json.iduser);
                $("#edidthnanggaran").val(json.idthnanggaran);
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
         $("#edjam").val("");
        $("#edidrab").val("");
        $("#edketerangan").val("");
        $("#ednominal").val("");
        $("#ediduser").val("");
        $("#edidthnanggaran").val("");
    });
} 
function dosimpan(){ 
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrrealisasirab/simpan/",
   data: "edidx="+$("#edidx").val()+"&edtanggal="+$("#edtanggal").val()+"&edjam="+$("#edjam").val()+"&edidrab="+$("#edidrab").val()+"&edketerangan="+$("#edketerangan").val()+"&ednominal="+$("#ednominal").val()+"&ediduser="+$("#ediduser").val()+"&edidthnanggaran="+$("#edidthnanggaran").val(),
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

function dohapus(edidx,edtanggal){ 
    if (confirm("Anda yakin Akan menghapus data "+edtanggal+"?"))
    {
        $(document).ready(function(){
            $.ajax({
                url: getBaseURL()+"index.php/ctrrealisasirab/deletetable/",
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
                 tl: {radius: 10}, // top left
                 tr: {radius: 10}, // top right
                 bl: {radius: 6}, // bottom left
                 br: {radius: 6}, // bottom right
        antiAlias: true
    }
    curvyCorners(setting, "div#mnhead h1");
} 
addEvent(window, 'load', initCorners); 
dosearch(0);

function doeditposting(edidx){

    $(document).ready(function(){

        $("#edidrab").val(edidx);
        doedidrabchange();
    });
}

function doedidrabchange(){
  $(document).ready(function(){
       $.ajax({
            url: getBaseURL()+"index.php/ctrrealisasirab/searchidrealisasi/",
            data: "xidrab="+$("#edidrab").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                //$("#edidx").val(json.idx);
                doClear();
                $("#edidrab").val(json.idrab);
               // $("#edidtahunanggaran").val(json.idtahunanggaran);
               // $("#ednominal").val(json.nominalposting);
                
                  if(json.isparent){
                     $("#ednominal").attr('disabled',true);
                  } else
                  {
                    $("#ednominal").attr('disabled',false);
                  }
                  $("#tabledata").html(json.tabledata);
                  
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end  = xmlHttpRequest.responseText.search("</title>");
                errorMsg = " error on search ";
                if (start > 0 && end > 0)
                    alert(" "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga"+errorMsg);
            }
        });
  });
}

