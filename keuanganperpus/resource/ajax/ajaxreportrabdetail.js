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
       $("#edidrab").attr('disabled', true);
       $("#edidrab").hide("slow");

 });
}

function dotampillaporanrab(isexport){

    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrlaprealisasirabdetail/dotampillaporan/",
            data: "edbulan="+$("#edBulan").val()+"&edidtahunanggaran="+$("#edidtahunanggaran").val()+"&edidrab="+$("#edidrab").val(),
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
     
    $(document).ready(function(){
        $("#edidrab").val(edidx);
        dotampillaporanrab(false);

    });
}



