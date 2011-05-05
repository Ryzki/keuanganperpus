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
            url: getBaseURL()+"index.php/ctrdenda/search/",
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
            url: getBaseURL()+"index.php/ctrdenda/editrec/",
            data: "edidx="+edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#edidx").val(json.idx);
                $("#edidsparta").val(json.iddendasparta);
                $("#edNoIdentitas").val(json.NoIdentitas);
                $("#edNama").val(json.Nama);
                $("#edDendaSparta").val(json.nominaldenda);
                $("#edDenda").val(json.nominalpersatuan);
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
        $("#edidsparta").val("");
        $("#edNama").val("");
        $("#edNoIdentitas").val("");
        $("#edDendaSparta").val("");
        $("#edDenda").val("");
    });
} 
function dosimpan(){ 
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrdenda/simpan/",
            data: "edidx="+$("#edidx").val()+
                "&edtgldenda="+$("#edtgldenda").val()+
                "&edidsparta="+$("#edidsparta").val()+
                "&edNoIdentitas="+$("#edNoIdentitas").val()+
                "&edDendaSparta="+$("#edDendaSparta").val()+
                "&edDenda="+$("#edDenda").val()+
                "&edNama="+$("#edNama").val(),
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

function dohapus(edidx,edNoIdentitas){ 
    if (confirm("Anda yakin Akan menghapus data "+edNoIdentitas+"?"))
    {
        $(document).ready(function(){
            $.ajax({
                url: getBaseURL()+"index.php/ctrdenda/deletetable/",
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
function strpad(val){
    return (!isNaN(val) && val.toString().length==1)?"0"+val:val;
}

function settanggal(){
    
    $(document).ready(function() {
        var currentTimeAndDate = new Date();
        var Date30 = new Date();
        var date = new Date();
        Date30.setDate(Date30.getDate()-30);



        var dd = date.getDate();
        var mm = date.getMonth();
        var yy = date.getYear();

        var hh = date.getHours();
        var mnt = date.getMinutes();

        var dd30 = Date30.getDate();
        var mm30 = Date30.getMonth();
        var yy30 = Date30.getYear();

        yy  = (yy < 1000) ? yy + 1900 : yy;



        $("#stylized input#edtgldenda" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#stylized input#edtgldenda" ).val(yy+"-"+strpad(mm+1)+"-"+strpad(dd));




    });  
}

function setnominal(){
    $(document).ready(function() {
        $("#stylized input#edDenda").autoNumeric();
        $("#stylized input#edDendaSparta").autoNumeric();
    //$("#ednominal").autoNumeric();
    });
}

function exporttoexcel(data){
  window.open(getBaseURL()+"resource/SaveToExcel.php?datatodisplay="+data, "laporan", "status=1,toolbar=1");
}

function dotampillapdendaharian(isexport){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlapdendaharian/dotampillaporan/",
            data: "edidlokasi="+$("#edidlokasi").val()+"&edtgldenda="+$("#edtgldenda").val(),
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

function dotampilnamamhs(){
  $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrdenda/dogetnamamhs/",
            data: "edNoIdentitas="+$("#edNoIdentitas").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
           // alert('tess'+json.harga);
             if(json.isada){
              $("#edNama").val(json.Nama);
             } else{
                alert('Data Yang Anda Cari Tidak Ditemukan');    
             }
           
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On Tampil search nama ";
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

function dotampillaporanperuser(isexport){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlaprekapfcdendaabperuser/dotampillaporan/",
            data: "edidUser="+$("#edidUser").val()+"&edtgldenda="+$("#edtgldenda").val()+"&edidjenistransaksi="+$("#edidjenistransaksi").val(),
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

function onCbJenisTransksiChange(){
 $(document).ready(function(){
    if($("#edidjenistransaksi").val()!="3"){
       $("#edidstatusPLU").attr('disabled', true);
       $("#edidstatusPLU").val('0');
    }else
    {
     $("#edidstatusPLU").attr('disabled', false);
    }
 });
 }


function dokeypresseed(){
    $(document).ready(function(){
        $("#edidstatusPLU").attr('disabled', true);
        $("#edNama").attr('disabled', true);
        $('#edNoIdentitas').bind('keypress', function(e) {
            if(e.keyCode==13){
               if($('#edjumlahsatuan').val!=''){
                  dotampilnamamhs();

               }

            }
        });




    });
}

function setcbuserbytanggal(){
  $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlaprekapfcdendaabperuser/setCbUserByTanggal/",
            data: "edTanggal="+$("#edtgldenda").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
            //alert('tess'+json.data);
            $("#edidUser").html("");
            $(json.data).appendTo("#edidUser");
            //$("#edidUser").html(json.data);
            $('#edidUser').val(json.idUser);
            $("#edidUser").attr('disabled', $('option:selected', '#edidUser').index() != 0);

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
function dotanggalchange(){
setcbuserbytanggal();
}

settanggal();
setnominal();
dokeypresseed();
