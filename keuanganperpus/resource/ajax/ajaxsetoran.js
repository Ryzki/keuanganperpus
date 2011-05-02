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
        $.ajax({
            url: getBaseURL()+"index.php/ctrsetoran/search/",
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
            url: getBaseURL()+"index.php/ctrsetoran/editrec/",
            data: "edidx="+edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#edidx").val(json.idx);
                $("#edNoBuktiSetoran").val(json.NoBuktiSetoran);
                $("#edtanggal").val(json.tanggal);
                $("#edidrekanan").val(json.idrekanan);
                $("#ednominal").val(json.nominal);
                $("#edidstatusplu").val(json.idstatusplu);
                $("#ediduser").val(json.iduser);
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

function gethargaplu(){
 $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrsetoran/gethargastatusplu/",
            data: "&xidstatusplu="+$("#edidstatusplu").val()+"&xtanggal="+$("#edtanggal").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
              $("#ednominal").val(json.setoran);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On get setoran ";
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
        $("#edNoBuktiSetoran").val("");
        $("#edtanggal").val("");
        $("#edidrekanan").val("");
        $("#ednominal").val("");
        $("#edidstatusplu").val("");
        $("#ediduser").val("");
        $("#edidlokasi").val("");
    });
} 
function dosimpan(){ 
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrsetoran/simpan/",
            data: "edidx="+$("#edidx").val()+"&edNoBuktiSetoran="+$("#edNoBuktiSetoran").val()+"&edtanggal="+$("#edtanggal").val()+"&edidrekanan="+$("#edidrekanan").val()+"&ednominal="+$("#ednominal").val()+"&edidstatusplu="+$("#edidstatusplu").val()+"&ediduser="+$("#ediduser").val()+"&edidlokasi="+$("#edidlokasi").val(),
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

function dohapus(edidx,edNoBuktiSetoran){ 
    if (confirm("Anda yakin Akan menghapus data "+edNoBuktiSetoran+"?"))
    {
        $(document).ready(function(){
            $.ajax({
                url: getBaseURL()+"index.php/ctrsetoran/deletetable/",
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


function strpad(val){
    return (!isNaN(val) && val.toString().length==1)?"0"+val:val;
}

function getbulan(){
    var date = new Date();
    var dd = date.getDate();
    var mm = date.getMonth();
    var yy = date.getYear();
    return strpad(mm+1);
}

function setlapsetoran(){
    $(document).ready(function(){
        $("#edBulan").val(getbulan());
    });
}
function exporttoexcel(data){
    window.open(getBaseURL()+"resource/SaveToExcel.php?datatodisplay="+data, "laporan", "status=1,toolbar=1");
}
function dotampillaporansetoran(isexport){

    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlapsetoran/dotampillaporan/",
            data: "edbulan="+$("#edBulan").val()+"&edtahun="+$("#edTahun").val()+"&edidrekanan="+$("#edidrekanan").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                //alert('tess'+json.harga);
                $("#tablereport").html(json.data);

                if(isexport){
                    exporttoexcel(json.data);
                }

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On Tampil laporan ";
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
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


