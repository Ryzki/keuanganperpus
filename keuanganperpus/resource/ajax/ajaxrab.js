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
        $("#edkodeRAB").attr('disabled', true);
        $.ajax({
            url: getBaseURL()+"index.php/ctrrab/search/",
            data: "xAwal="+xAwal+"&xSearch="+xSearch,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                //$("#tabledata").html(json.tabledata);
                $("#edidparent").html(json.edidparent);
                $("#lstreeview").html(json.lstreeview);
                $("#edkodeRAB").val(json.edkodeRAB);

                //$("#edkodeRABUSD").val(json.edkodeRAB);
                  $('#edisview').attr('checked',true);
              
                $("#browser").treeview();


            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end  = xmlHttpRequest.responseText.search("</title>");
                errorMsg = " error on search ";
                if (start > 0 && end > 0)
                    alert(" "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error "+errorMsg);
            }
        });
    });
} 

function doedit(edidx){
      $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrrab/editrec/",
            data: "edidx="+edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#edidx").val(json.idx);
                $("#edJudulRAB").val(json.JudulRAB);
                $("#edidparent").val(json.idparent);
                $("#edkodeRAB").val(json.kodeRAB);
                $("#edkodeRABUSD").val(json.kodeRABUSD);
                if(json.edisview=='Y'){
                 $('#edisview').attr('checked',true);
                 //$('#ededisview').is(':checked')
                } else
                {
                  $('#edisview').attr('checked',false);
                }

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
        $("#edJudulRAB").val("");
        $("#edidparent").val("0");
        $("#edkodeRAB").val("");
        $("#edkodeRABUSD").val("");
        $('#edisview').attr('checked',true);

         dosearch(0);
    });
}

function dosimpan(){ 
    $(document).ready(function(){

        var xischecked = 'N';
               if( $('#edisview').is(':checked')){
                xischecked = 'Y';
               }

        $.ajax({
            url: getBaseURL()+"index.php/ctrrab/simpan/",
            data: "edidx="+$("#edidx").val()+"&edJudulRAB="+$("#edJudulRAB").val()+"&edidparent="+$("#edidparent").val()+"&edkodeRAB="+$("#edkodeRAB").val()+
                   "&edkodeRABUSD="+$("#edkodeRABUSD").val()+"&edisview="+xischecked,
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

function dohapus(){
   $(document).ready(function(){
    if (confirm("Anda yakin Akan menghapus data "+$("#edJudulRAB").val()+"?"))
    {
        
            $.ajax({
                url: getBaseURL()+"index.php/ctrrab/deletetable/",
                data: "edidx="+$("#edidx").val()+"&kodeRAB="+$("#edkodeRAB").val(),
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
                    errorMsg = " error on HAPUS ";
                    if (start > 0 && end > 0)
                        alert(" "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                    else
                        alert("with database "+errorMsg);
                }
            });
        
    }
   });
} 

function dorepair(){
   $(document).ready(function(){
    if (confirm("Semua Kode RAB Akan Disesuaikan Menurut Index RAB,\n Anda yakin Akan Me-repair Semua Kode RAB ? \n Gunakan SOP sbb : \n1. Backup Dahulu Table RAB \n2. Sesudah Yakin Klik Tombol OK"))
    {

            $.ajax({
                url: getBaseURL()+"index.php/ctrrab/dorepair/",
                data: "edidx="+$("#edidx").val()+"&kodeRAB="+$("#edkodeRAB").val(),
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function(json){
                    alert("Repair Data Sudah di lakukan !!!");
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    start = xmlHttpRequest.responseText.search("<title>") + 7;
                    end = xmlHttpRequest.responseText.search("</title>");
                    errorMsg = " error on REPAIR ";
                    if (start > 0 && end > 0)
                        alert(" "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                    else
                        alert("with database "+errorMsg);
                }
            });

    }
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

function dochangeparent(){
 $(document).ready(function(){
     //alert("Haloo "+$("#edidparent").val());
  $.ajax({
       url: getBaseURL()+"index.php/ctrrab/doChange/",
      data: "edidparent="+$("#edidparent").val(),
     cache: false,
  dataType: 'json',
      type: 'POST',
   success: function(json){
       
        $("#edkodeRAB").val(json.kodeRAB);
      //  $("#edkodeRABUSD").val(json.kodeRAB);
        

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
function exporttoexcel(data){
  window.open(getBaseURL()+"resource/SaveToExcel.php?datatodisplay="+data, "laporan", "status=1,toolbar=1");
}

function setawalpribadi(){
$(document).ready(function(){
       $("#edBulan").val(getbulan());
 });
}
function dotampillaporanrab(isexport){

    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlaprealisasirab/dotampillaporan/",
            data: "edbulan="+$("#edBulan").val()+"&edidtahunanggaran="+$("#edidtahunanggaran").val(),
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


function dosetcb(edidx){
     alert("hallolll");
    $(document).ready(function(){
        $("#edidrab").val(edidx);

    });
}

addEvent(window, 'load', initCorners);
dosearch(0);


