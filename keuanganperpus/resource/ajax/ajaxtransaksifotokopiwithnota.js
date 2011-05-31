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
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/searchnota/",
            data: "xAwal="+xAwal+"&xSearch="+xSearch,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#tabledatanota").html(json.tabledata);
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

function dosearchbuffer(xAwal){
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
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/searchbuffer/",
            data: "xAwal="+xAwal+"&xSearch="+xSearch,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#tabledatabuffer").html(json.tabledatabuffer);
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
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/editrec/",
            data: "edidx="+edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#edidx").val(json.idx);
                $("#edidplu").val(json.idplu);
                $("#idjenipengguna").val(json.idjenipengguna);
                $("#edidjenistransaksi").val(json.idjenistransaksi);
                $("#edidpegawai").val(json.idpegawai);
                $("#edidunitkerja").val(json.idunitkerja);
                //       $("#edidstatusdinas").val(json.idstatusdinas);
                //       $("#edtanggal").val(json.tanggal);
                //       $("#edjam").val(json.jam);
                
                $("#edjumlahsatuan").val(json.jumlahsatuan);
                $("#ednominalpersatuan").val(json.nominalpersatuan);
                $("#edtotal").val(json.total);
                if(json.edchkispusd=="Y"){
                    $("#edchkispusd").val('Y');
                    $("#edchkispusd").attr('checked', true);
                }else
                {
                    $("#edchkispusd").val('N');
                    $("#edchkispusd").attr('checked', false);
                }

            //       $("#ediduser").val(json.iduser);
            //       $("#ednominaldenda").val(json.nominaldenda);
            //       $("#ediddendasparta").val(json.iddendasparta);
            //       $("#edidlokasi").val(json.idlokasi);
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

function doeditbuffer(edidx){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/editrecbuffer/",
            data: "edidx="+edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#edidx").val(json.idx);
                $("#edidplu").val(json.idplu);
                $("#idjenipengguna").val(json.idjenipengguna);
                $("#edidjenistransaksi").val(json.idjenistransaksi);

                $("#edidpegawai").val(json.idpegawai);

                $("#edidunitkerja").val(json.idunitkerja);
                //       $("#edidstatusdinas").val(json.idstatusdinas);
                //       $("#edtanggal").val(json.tanggal);
                //       $("#edjam").val(json.jam);

                $("#edjumlahsatuan").val(json.jumlahsatuan);
                $("#ednominalpersatuan").val(json.nominalpersatuan);
                $("#edtotal").val(json.total);
                if(json.edchkispusd=="Y"){
                    $("#edchkispusd").val('Y');
                    $("#edchkispusd").attr('checked', true);
                }else
                {
                    $("#edchkispusd").val('N');
                    $("#edchkispusd").attr('checked', false);
                }

            //       $("#ediduser").val(json.iduser);
            //       $("#ednominaldenda").val(json.nominaldenda);
            //       $("#ediddendasparta").val(json.iddendasparta);
            //       $("#edidlokasi").val(json.idlokasi);
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

function dotampildataPLU(){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/tampildataPLU/",
            data: "kodeplu="+$("#edidplu").val()+"&edidgrouppengguna="+$("#edidgrouppengguna").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                //alert('tess'+json.harga);

                if(json.isdataada){
                    //alert('tess'+json.idjenistransaksi);
                    $("#ednominalpersatuan").val(json.harga);
                    $("#nmproduk").html(json.NamaProduk);
                    $("#edidgrouppengguna").val(json.idjenipengguna);
                    $("#edjumlahsatuan").attr('disabled', false);
                    $("#edjumlahsatuan").focus();

                    doshownamaProduk(true);

                  
                } else
                {
                    alert('Data Yang Anda Cari tidak Ditemukan');
                }
            //       $("#ediduser").val(json.iduser);
            //       $("#ednominaldenda").val(json.nominaldenda);
            //       $("#ediddendasparta").val(json.iddendasparta);
            //       $("#edidlokasi").val(json.idlokasi);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On Tampil PLU ";
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

function dotampilpegawai(){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/tampildataPegawai/",
            data: "edidpegawai="+$("#edidpegawai").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                if(json.isdataada){
                    // alert('tess '+json.idUnitKerja);
                    $("#nmpegawai").val(json.npp);
                    $("#nmpegawai").html(json.Nama);
                    $("#edunitkerja").val(json.idUnitKerja);
                    doshownmpegawai(true);
                } else
               {
                    alert('Data Yang Anda Cari tidak Ditemukan');
                }
            //       $("#ediduser").val(json.iduser);
            //       $("#ednominaldenda").val(json.nominaldenda);
            //       $("#ediddendasparta").val(json.iddendasparta);
            //       $("#edidlokasi").val(json.idlokasi);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On Search Pegawai ";
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

function doclickchkbkusd(){
    if ($("#edchkispusd").val()=='N'){
        $("#edchkispusd").val('Y');
    } else
{
        $("#edchkispusd").val('N');
    }
//alert($("#edchkispusd").val());
}

function onCbunitkerjaChange(){
    if($("#edunitkerja").val()!='0'){

        $("#edidpegawai").val("P.0000");

    }else{
        $("#edidpegawai").val("");
    }


}
function doClearNota(){
$(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/refreshsession/",
            data: "",
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){

            //alert("OK");
            window.location = getBaseURL()+"index.php/ctrtransaksifotokopiwithnota";

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On Search Pegawai ";
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });


}
function doClear(){ 
    $(document).ready(function(){
        $("#edchkispusd").val("N");
        $("#edchkispusd").attr('checked', false);

        $("#edidx").val("0");
        $("#edidplu").val("");

        $("#edidjenistransaksi").val("");
        
        

        // $("#edidstatusdinas").val("");
        // $("#edtanggal").val("");
        // $("#edjam").val("");

        $("#edjumlahsatuan").val("");
        $("#edjumlahsatuan").attr('disabled', true);
        $("#edNoNota").attr('disabled', true);
        $("#edHarusBayar").attr('disabled', true);
        $("#edSisa").attr('disabled', true);
        $("#ednominalpersatuan").val("");
        $("#edtotal").val("");
        setJumlahHarusBayar();

        setNoNota();
        
        //setJumlahHarusBayar();

    // $("#ediduser").val("");
    // $("#ednominaldenda").val("");
    // $("#ediddendasparta").val("");
    // $("#edidlokasi").val("");

    });
}

function dosimpan(){ 
    $(document).ready(function(){
    
        $.ajax({
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/simpan/",
            data: "edNoNota="+$("#edNoNota").val()+"&edBayar="+$("#edBayar").val()+"&edSisa="+$("#edSisa").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                //doClear();
                dosearch('-99');
                dosearchbuffer('-99');
                doshownamaProduk(false);
                doshownmpegawai(false);
                doshowpegawai(false);

               
                $("#edidgrouppengguna").val("");
                $("#edHarusBayar").val("0");
                $("#edSisa").val("0");
                $("#edBayar").val("0");
                $("#edidpegawai").val("");
                $("#edidunitkerja").val("0");
                
                $("#edidgrouppengguna").attr('disabled',false);
                $("#edidplu").focus();
                doshowpegawai(false);

            //$("#edidplu").val(json.data);
            // alert(json.data);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg =  " On Simpan ";
                if (start > 0 && end > 0)
                    alert("E2 Error "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
} 

//function dosimpanbuffer(){
//    $(document).ready(function(){
//        if(($("#edjumlahsatuan").val()=='0')||($("#edjumlahsatuan").val()==''))
//        {
//            alert("Data belum lengkap Terisi");
//            return;
//        }
//
//        $.ajax({
//            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/simpantobuffer/",
//            data: "edidx="+$("#edidx").val()+
//            "&edidplu="+$("#edidplu").val()+
//            "&edidjenistransaksi="+$("#edidjenistransaksi").val()+
//            "&edidpegawai="+$("#edidpegawai").val()+
//            "&edidunitkerja="+$("#edunitkerja").val()+
//            "&edidstatusdinas="+$("#edidstatusdinas").val()+
//            "&edtanggal="+$("#edtanggal").val()+
//            "&edjam="+$("#edjam").val()+
//            "&edjumlahsatuan="+$("#edjumlahsatuan").val()+
//            "&ednominalpersatuan="+$("#ednominalpersatuan").val()+
//            "&edtotal="+$("#edtotal").val()+
//            "&ediduser="+$("#ediduser").val()+
//            "&ednominaldenda="+$("#ednominaldenda").val()+
//            "&ediddendasparta="+$("#ediddendasparta").val()+
//            "&edidlokasi="+$("#edidlokasi").val()+
//            "&edchkispusd="+$("#edchkispusd").val(),
//            cache: false,
//            dataType: 'json',
//            type: 'POST',
//            success: function(json){
//
//                dosearchbuffer('-99');
//                doshownamaProduk(false);
//                doshownmpegawai(false);
//                doshowpegawai(false);
//                setJumlahHarusBayar();
//
//                doClear();
//                $("#edidplu").focus();
//               // $("#edidtext").val(json.data);
//            // alert(json.data);
//            },
//            error: function (xmlHttpRequest, textStatus, errorThrown) {
//                start = xmlHttpRequest.responseText.search("<title>") + 7;
//                end = xmlHttpRequest.responseText.search("</title>");
//                errorMsg =  " On Simpan ";
//                if (start > 0 && end > 0)
//                    alert("E2 Error "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
//                else
//                    alert("Error  "+errorMsg);
//            }
//        });
//    });
//}

function dohapus(edidx,edidplu){ 
    if (confirm("Anda yakin Akan menghapus data "+edidplu+"?"))
    {
        $(document).ready(function(){
            $.ajax({
                url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/deletetable/",
                data: "edidx="+edidx,
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function(json){
                    doClear(); 
                    dosearch('-99');
                    doshownamaProduk(false);
                    doshowpegawai(false);
                    doshownmpegawai(false);

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

function dohapusbuffer(edidx,edidplu){
    if (confirm("Anda yakin Akan menghapus data "+edidplu+"?"))
    {
        $(document).ready(function(){
            $.ajax({
                url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/deletetablebuffer/",
                data: "edidx="+edidx,
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function(json){
                    
                    dosearchbuffer('-99');
                    doshownamaProduk(false);
                    
                    setJumlahHarusBayar();
                //    setSisaBayar();
                    
                    doClear();

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

function setSimpanToBuffer(){
    $(document).ready(function(){
        if(($("#edjumlahsatuan").val()=='0')||($("#edjumlahsatuan").val()==''))
        {
            alert("Data belum lengkap Terisi");
            return;
        }

        $.ajax({
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/simpantobuffer/",
            data: "edidx="+$("#edidx").val()+
            "&edidplu="+$("#edidplu").val()+
            "&edNoNota="+$("#edNoNota").val()+
            "&edidjenistransaksi="+$("#edidjenistransaksi").val()+
            "&edidpegawai="+$("#edidpegawai").val()+
            "&edidunitkerja="+$("#edunitkerja").val()+
            "&edidstatusdinas="+$("#edidstatusdinas").val()+
            "&edtanggal="+$("#edtanggal").val()+
            "&edjam="+$("#edjam").val()+
            "&edjumlahsatuan="+$("#edjumlahsatuan").val()+
            "&ednominalpersatuan="+$("#ednominalpersatuan").val()+
            "&edtotal="+$("#edtotal").val()+
            "&ediduser="+$("#ediduser").val()+
            "&ednominaldenda="+$("#ednominaldenda").val()+
            "&ediddendasparta="+$("#ediddendasparta").val()+
            "&edidlokasi="+$("#edidlokasi").val()+
            "&edchkispusd="+$("#edchkispusd").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                doClear();
                
                doshownamaProduk(false);
                
                setJumlahHarusBayar();
                
                dosearchbuffer('-99');
                 $("#edidplu").focus();
                 
            //$("#edidplu").val(json.data);
            // alert(json.data);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg =  " On Simpan ";
                if (start > 0 && end > 0)
                    alert("E2 Error "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}


function setSisaBayar(){
  $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/getSisaBayar/",
            data: "edBayar="+$("#edBayar").val()+"&edNoNota="+$("#edNoNota").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){

             $("#edSisa").val(json.sisa);

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On Search Pegawai ";
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });

}

function dokeypresseed(){
    $(document).ready(function(){

        $("#ednominalpersatuan").attr('disabled', true);
        $("#edjumlahsatuan").attr('disabled', true);
        $("#edNoNota").attr('disabled', true);
        $("#edtotal").attr('disabled', true);

        $('#edidplu').bind('keypress', function(e) {
            if(e.keyCode==13){
       $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/isPLUInBuffer/",
            data: "edidplu="+$("#edidplu").val()+"&edNoNota="+$("#edNoNota").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
             
             if(!json.ispluinbuffer){
                dotampildataPLU();
              } else{
               alert('Kode PLU Sudah Digunakan di transaksi ini ');
              }

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On Search Pegawai ";
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
       
            //alert('OK');
            // Enter pressed... do anything here...
            }
        });

        $('#edjumlahsatuan').bind('keypress', function(e) {
            if(e.keyCode==13){
                if($('#edjumlahsatuan').val!=''){
                   $('#edtotal').val($("#ednominalpersatuan").val()*$("#edjumlahsatuan").val());

                     setSimpanToBuffer();
                // $("#btSimpan").focus();
                }
               
            //alert('OK');
            // Enter pressed... do anything here...
            }
        });

        $('#edidpegawai').bind('keypress', function(e) {
            if(e.keyCode==13){
                dotampilpegawai();
                if($("#edidpegawai").val()!=""){
                    $("#edidplu").focus();
                }
            //alert('OK');
            // Enter pressed... do anything here...
            }
        });

        $('#edBayar').bind('keypress', function(e) {
            if(e.keyCode==13){
             setSisaBayar();
             $("#btSimpan").focus();
            }
        });



    });
}



function doshowpegawai(isshow){
    $(document).ready(function(){
        if(isshow){
            $("#showhide").show("slow");
        //$("#edidunitkerja").show("slow");
        } else
{
            $("#showhide").hide("slow");
        //$("#nmpegawai").hide("slow");
        // $("#edidunitkerja").hide("slow");
        }

    });
}

function doshownmpegawai(isshow){
    $(document).ready(function(){
        $("#nmpegawai").css({
            "font-size":"18px",
            position :"relative",
            left:150,
            width:200,
            top :0
        //background:"blue",
        });
        if(isshow){
            $("#nmpegawai").show("slow");
        //$("#edidunitkerja").show("slow");
        } else
{
            $("#nmpegawai").hide("slow");
        //$("#edidunitkerja").hide("slow");
        }

    });
}

function doshownamaProduk(isshow){
    $(document).ready(function(){
        $("#nmproduk").css({
            "font-size":"18px",
            position :"relative",
            left:150,
            width:200,
            top :0
        //background:"blue",
        });
        if(isshow){
            $("#nmproduk").show("slow");
        //$("#edidunitkerja").show("slow");
        } else
{
            $("#nmproduk").hide("slow");
        //$("#edidunitkerja").hide("slow");
        }

    });
}

function setJumlahHarusBayar(){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/getJumlahHarusBayar/",
            data: "edNoNota="+$('#edNoNota').val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                
                  if(($("#edidgrouppengguna").val() ==2)||($("#edidgrouppengguna").val()==3)){
                    $("#edBayar").val(json.jumlahbayar);
                     }
                    $("#edHarusBayar").val(json.jumlahbayar);
                    setSisaBayar();
                    
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On setJumlahHarusBayar";
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

function setNoNota(){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/getlastnota/",
            data: '',
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                    $("#edNoNota").val(json.nonota);
               
            //       $("#ediduser").val(json.iduser);
            //       $("#ednominaldenda").val(json.nominaldenda);
            //       $("#ediddendasparta").val(json.iddendasparta);
            //       $("#edidlokasi").val(json.idlokasi);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On Get Last nota "+getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/getlastnota/";
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
dokeypresseed();


doshownamaProduk(false);
doshowpegawai(false);
doshownmpegawai(false);

function onCbgrouppenggunaChange(){

    $(document).ready(function(){

        if(($("#edidgrouppengguna").val() ==2)||($("#edidgrouppengguna").val()==3)){
            doshowpegawai(true);
        } else{
            doshowpegawai(false);
        }
        $("#edidgrouppengguna").attr('disabled',true);
    });
}

function setnamapeg(){
 $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrtransaksifotokopiwithnota/getNamaPegawai/",
            data: "edNoNota="+$('#edNoNota').val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){

                  if(($("#edidgrouppengguna").val() ==2)||($("#edidgrouppengguna").val()==3)){
                    $("#edBayar").val(json.jumlahbayar);
                     }
                    $("#edHarusBayar").val(json.jumlahbayar);
                    setSisaBayar();

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "On setJumlahHarusBayar";
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error  "+errorMsg);
            }
        });
    });
}

doClear();
//** Cek Group Pengguna