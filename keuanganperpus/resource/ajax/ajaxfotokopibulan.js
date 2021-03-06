
function exporttoexcel(data){
  window.open(getBaseURL()+"resource/SaveToExcel.php?datatodisplay="+data, "laporan", "status=1,toolbar=1");
}

function dotampillapsetoranharian(isexport){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlapdsetorantunaifcharian/dotampillaporan/",
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
                errorMsg = "On Tampil laporan "+xmlHttpRequest.responseText;
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

function dotampillapsetoranhariannontunai(isexport){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlapdsetorannontunaifcharian/dotampillaporan/",
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
                errorMsg = "On Tampil laporan "+xmlHttpRequest.responseText;
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

function dotampillaporanfotokopibulan(isexport){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlapfotokopibulan/dotampillaporan/",
            data: "edbulan="+$("#edBulan").val()+"&edtahun="+$("#edTahun").val()+"&edidlokasi="+$("#edidlokasi").val(),
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
                errorMsg = "On Tampil laporan "+xmlHttpRequest.responseText;
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}


function dotampillaporanfotokopibulantunainontunai(isexport){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlapfotokopibulantunainontunai/dotampillaporan/",
            data: "edbulan="+$("#edBulan").val()+"&edtahun="+$("#edTahun").val()+"&edidlokasi="+$("#edidlokasi").val()+"&edtunainontunai="+$("#edtunainontunai").val(),
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
                errorMsg = "On Tampil laporan "+xmlHttpRequest.responseText;
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

function dotampillaporanrekap(isexport){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlaprekapfcdendaab/dotampillaporan/",
            data: "edbulan="+$("#edBulan").val()+"&edtahun="+$("#edTahun").val(),
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
                errorMsg = "On Tampil laporan "+xmlHttpRequest.responseText;
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

function dotampillaporanrekapdetail(isexport){
    
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlaprekapfcdendaabdetail/dotampillaporan/",
            data: "edbulan="+$("#edBulan").val()+"&edtahun="+$("#edTahun").val()+"&edidjenistransaksi="+$("#edidjenistransaksi").val()+"&edidstatusPLU="+$("#edidstatusPLU").val(),
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
                errorMsg = "On Tampil laporan "+xmlHttpRequest.responseText;
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

function dotampillaporanrekapdinas(isexport){

    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlaprekapfcdinas/dotampillaporan/",
            data: "edbulan="+$("#edBulan").val()+"&edtahun="+$("#edTahun").val()+"&edidlokasi="+$("#edidlokasi").val()+"&edunitkerja="+$("#edunitkerja").val(),
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
                errorMsg = "On Tampil laporan "+xmlHttpRequest.responseText;
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

function dotampillaporanrekappribadi(isexport){

    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlaprekapfcpribadi/dotampillaporan/",
            data: "edbulan="+$("#edBulan").val()+"&edtahun="+$("#edTahun").val()+"&edidlokasi="+$("#edidlokasi").val(),
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
                errorMsg = "On Tampil laporan "+xmlHttpRequest.responseText;
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
function setawalrekapfotokopiperbulan(){
$(document).ready(function(){
       $("#edBulan").val(getbulan());
  });
}

function setawalrekapdetail(){
$(document).ready(function(){
       $("#edBulan").val(getbulan());
       $("#edidstatusPLU").attr('disabled', true);

 });
}

function setawaldinas(){
$(document).ready(function(){
       $("#edBulan").val(getbulan());
      // $("#edunitkerja").attr('disabled', true);
      docblokasichange();
      

 });
}

function setawalpribadi(){
$(document).ready(function(){
       $("#edBulan").val(getbulan());
       
 });
}
function docblokasichange(){
//Celar combo $(“#ComboBox”).html(“”);
//Add to the list: $(“<option value=’9’>Value 9</option>”).appendTo(“#ComboBox”);
$(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlaprekapfcdinas/setcombounitkerja/",
            data: "edbulan="+$("#edBulan").val()+"&edtahun="+$("#edTahun").val()+"&edidlokasi="+$("#edidlokasi").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
            //alert('tess'+json.harga);
            $("#edunitkerja").html("");
            $(json.data).appendTo("#edunitkerja");
             //$("#edunitkerja").attr('disabled', false);

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On Tampil laporan "+xmlHttpRequest.responseText;
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
//   addEvent(window, 'load', initCorners);
//     dosearch(0);
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
settanggal();