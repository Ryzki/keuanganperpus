function dosearch(xAwal){ 
    xSearch ="";
    try 
    {
        if ($("#edSearch").val()!=""){
            xSearch = $("#edSearch").val();
        } 
    }catch(err){
        xSearch ="";
    }
    if (typeof(xSearch) =="undefined"){
        xSearch ="";
    }

    $(document).ready(function(){
       $("#browser").treeview();
       $("#edidrab").attr('disabled', true);
        $.ajax({
            url: getBaseURL()+"index.php/ctrpostingrab/search/",
            data: "xAwal="+xAwal+"&xSearch="+xSearch+"&xthnanggaran="+$("#edidtahunanggaran").val(),
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
            url: getBaseURL()+"index.php/ctrpostingrab/editrec/",
            data: "edidx="+edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
               if(json.isdataada){
                  $("#edidx").val(json.idx);
                  $("#edidrab").val(json.idrab);
                  $("#edidtahunanggaran").val(json.idtahunanggaran);
                  $("#ednominalposting").val(json.nominalposting);
               } else{
                //doClear();
               }
//                $("#edtglisi").val(json.tglisi);
//                $("#edjam").val(json.jam);
//                $("#ediduser").val(json.iduser);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "OnEdit ";
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

function doeditposting(edidx){
    
    $(document).ready(function(){

        $("#edidrab").val(edidx);
        doedidrabchange();
    });
}

function doClear(){ 
    $(document).ready(function(){
        $("#edidx").val("0");
        $("#edidrab").val("");
        $("#edidtahunanggaran").val("");
        $("#ednominalposting").val("");
        $("#edtglisi").val("");
        $("#edjam").val("");
        $("#ediduser").val("");
    });
} 
function dosimpan(){ 
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrpostingrab/simpan/",
            data: "edidx="+$("#edidx").val()+"&edidrab="+$("#edidrab").val()+"&edidtahunanggaran="+$("#edidtahunanggaran").val()+"&ednominalposting="+$("#ednominalposting").val()+"&edtglisi="+$("#edtglisi").val()+"&edjam="+$("#edjam").val()+"&ediduser="+$("#ediduser").val(),
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

function dohapus(edidx,edidrab){ 
    if (confirm("Anda yakin Akan menghapus data "+edidrab+"?"))
    {
        $(document).ready(function(){
            $.ajax({
                url: getBaseURL()+"index.php/ctrpostingrab/deletetable/",
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
        tl: {
            radius: 10
        }, // top left
        tr: {
            radius: 10
        }, // top right
        bl: {
            radius: 6
        }, // bottom left
        br: {
            radius: 6
        }, // bottom right
        antiAlias: true
    }
    curvyCorners(setting, "div#mnhead h1");
} 
addEvent(window, 'load', initCorners); 
dosearch(0);

function doedidrabchange(){
  $(document).ready(function(){
       $.ajax({
            url: getBaseURL()+"index.php/ctrpostingrab/searchidposting/",
            data: "xidrab="+$("#edidrab").val()+"&xthnanggaran="+$("#edidtahunanggaran").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#edidx").val(json.idx);
                $("#edidrab").val(json.idrab);
                $("#edidtahunanggaran").val(json.idtahunanggaran);
                $("#ednominalposting").val(json.nominalposting);
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


