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
            url: getBaseURL()+"index.php/ctrprodukplu/search/",
            data: "xAwal="+xAwal+"&xSearch="+xSearch,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
           
                $("#tabledata").html(json.tabledata);
            // $("#tabledata").html(json.tabledata);
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
            url: getBaseURL()+"index.php/ctrprodukplu/editrec/",
            data: "edidx="+edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#edidx").val(json.idx);
                $("#edKodePLU").val(json.KodePLU);
                $("#edidJnsPengguna").val(json.idJnsPengguna);
                $("#edNamaProduk").val(json.NamaProduk);
                $("#edSingkatan").val(json.Singkatan);
                $("#edidstatusPLU").val(json.idstatusPLU);
                $("#edidrekanan").val(json.idrekanan);
                $("#edharga").val(json.harga);
                $("#edidjenistransaksi").val(json.idjenistransaksi);
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
        $("#edKodePLU").val("");
        $("#edidJnsPengguna").val("");
        $("#edNamaProduk").val("");
        $("#edSingkatan").val("");
        $("#edidstatusPLU").val("");
        $("#edidrekanan").val("");
        $("#edharga").val("");
        $("#edidjenistransaksi").val("");
    });
} 
function dosimpan(){ 
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrprodukplu/simpan/",
            data: "edidx="+$("#edidx").val()+"&edKodePLU="+$("#edKodePLU").val()+"&edidJnsPengguna="+$("#edidJnsPengguna").val()+"&edNamaProduk="+$("#edNamaProduk").val()+"&edSingkatan="+$("#edSingkatan").val()+"&edidstatusPLU="+$("#edidstatusPLU").val()+"&edidrekanan="+$("#edidrekanan").val()+"&edharga="+$("#edharga").val()+"&edidjenistransaksi="+$("#edidjenistransaksi").val(),
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

function dohapus(edidx,edKodePLU){ 
    if (confirm("Anda yakin Akan menghapus data "+edKodePLU+"?"))
    {
        $(document).ready(function(){
            $.ajax({
                url: getBaseURL()+"index.php/ctrprodukplu/deletetable/",
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


