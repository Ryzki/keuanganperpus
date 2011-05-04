<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : transaksi  * di Buat oleh Diar PHP Generator * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */
class modeldenda extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


 //***************** Update 4 april ********************************
 function getNamaMhs($xNim){
  $xStr = " select Nama  from anggota WHERE No_Anggota like '%".$xNim."%' limit 1";
  $query = $this->db->query($xStr);
  $row = $query->row();
  if(!empty ($row->Nama))
  {return $row->Nama; }
  else{
      return "";
  }

 }

 function getdendaperharilokasi($TglDenda,$xLokasi) {
        $xStr = "SELECT " .
                "NamaMHS,  " .
                "NIM," .
                "idjenistransaksi,".
                "jumlahsatuan," .
                "nominalpersatuan " .
                " FROM transaksi  WHERE tanggal = '" . $TglDenda. "' and idlokasi ='".$xLokasi."' and idjenistransaksi = '1' ";
        $query = $this->db->query($xStr);
        //$row = $query->row();
        return $query;
    }

//****************update 28 maret 2011**********
 function setDeletetransaksianggotabaca($xidx)
{
 $xStr =  " DELETE FROM transaksi WHERE transaksi.idpegawai = '".$xidx."'";

 $query = $this->db->query($xStr);
}

Function setInserttransaksidenda($xidx,$xNIM,$xidjenistransaksi,$xidpegawai,$xidunitkerja,
                              $xidstatusdinas,$xjumlahsatuan,$xnominalpersatuan,
                              $xtotal,$xiduser,$xnominaldenda,$xiddendasparta,$xidlokasi,$xNama)
{
  $xStr =  " INSERT INTO transaksi( ".
              "idx,".
              "NIM,".
              "idjenistransaksi,".
              "idpegawai,".
              "idunitkerja,".
              "idstatusdinas,".
              "tanggal,".
              "jam,".
              "jumlahsatuan,".
              "nominalpersatuan,".
              "total,".
              "iduser,".
              "nominaldenda,".
              "iddendasparta,".
              "idlokasi,NamaMhs) VALUES('".$xidx."','".$xNIM."','".$xidjenistransaksi."','".$xidpegawai."','".$xidunitkerja."','".$xidstatusdinas."',current_date,current_time,'".$xjumlahsatuan."','".$xnominalpersatuan."','".$xtotal."','".$xiduser."','".$xnominaldenda."','".$xiddendasparta."','".$xidlokasi."','".$xNama."')";

// return $xStr;
$query = $this->db->query($xStr);
return $xidx;

}


 Function setUpdatetransaksidenda($xidx,$xNIM,$xidjenistransaksi,$xidpegawai,$xidunitkerja,$xidstatusdinas,$xjumlahsatuan,
                               $xnominalpersatuan,$xtotal,$xiduser,$xnominaldenda,$xiddendasparta,$xidlokasi,$xNama)
{
  $xStr =  " UPDATE transaksi SET ".
             "idx='".$xidx."',".
             "NIM='".$xNIM."',".
             "idjenistransaksi='".$xidjenistransaksi."',".
             "idpegawai='".$xidpegawai."',".
             "idunitkerja='".$xidunitkerja."',".
             "idstatusdinas='".$xidstatusdinas."',".
             "tanggal=current_date,".
             "jam=current_time,".
             "jumlahsatuan='".$xjumlahsatuan."',".
             "nominalpersatuan='".$xnominalpersatuan."',".
             "total='".$xtotal."',".
             "iduser='".$xiduser."',".
             "nominaldenda='".$xnominaldenda."',".
             "iddendasparta='".$xiddendasparta."',".
             "idlokasi='".$xidlokasi."',".
             "NamaMHS = '".$xNama."'".
             "  WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}
//**


function getArrayListtransaksi(){ /* spertinya perlu lock table*/
 $xBuffResul = array();
 $xStr =  "SELECT ".
      "idx,".
      "NIM,".
      "idjenistransaksi,".
      "idpegawai,".
      "idunitkerja,".
      "idstatusdinas,".
      "tanggal,".
      "jam,".
      "jumlahsatuan,".
      "nominalpersatuan,".
      "total,".
      "iduser,".
      "nominaldenda,".
      "iddendasparta,".
      "idlokasi".
" FROM transaksi   order by idx ASC ";
 $query = $this->db->query($xStr);
 foreach ($query->result() as $row)
 {
   $xBuffResul[$row->idx] = $row->NIM;
   }
return $xBuffResul;
}

function getListtransaksi($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){
     $xSearch = " Where NIM like '%".$xSearch."%' and tanggal = current_date and idjenistransaksi = '1'" ;
 } else {
     $xSearch = " Where  tanggal = current_date and idjenistransaksi = '1'" ;
 }
 $xStr =   "SELECT ".
      "idx,".
      "NIM,".
      "idjenistransaksi,".
      "idpegawai,".
      "idunitkerja,".
      "idstatusdinas,".
      "tanggal,".
      "jam,".
      "jumlahsatuan,".
      "nominalpersatuan,".
      "total,".
      "iduser,".
      "nominaldenda,".
      "iddendasparta,".
      "idlokasi,NamaMhs ".
" FROM transaksi $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;
 $query = $this->db->query($xStr);
 return $query ;
}


function getDetailtransaksi($xidx){
 $xStr =   "SELECT ".
      "idx,".
      "NIM,".
      "idjenistransaksi,".
      "idpegawai,".
      "idunitkerja,".
      "idstatusdinas,".
      "tanggal,".
      "jam,".
      "jumlahsatuan,".
      "nominalpersatuan,".
      "total,".
      "iduser,".
      "nominaldenda,".
      "iddendasparta,".
      "idlokasi,NamaMhs ".
" FROM transaksi  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


function getLastIndextransaksi(){ /* spertinya perlu lock table*/
 $xStr =   "SELECT ".
      "idx,".
      "NIM,".
      "idjenistransaksi,".
      "idpegawai,".
      "idunitkerja,".
      "idstatusdinas,".
      "tanggal,".
      "jam,".
      "jumlahsatuan,".
      "nominalpersatuan,".
      "total,".
      "iduser,".
      "nominaldenda,".
      "iddendasparta,".
      "idlokasi,NamaMhs".
" FROM transaksi order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


 Function setInserttransaksi($xidx,$xNIM,$xidjenistransaksi,$xidpegawai,$xidunitkerja,$xidstatusdinas,$xtanggal,$xjam,$xjumlahsatuan,$xnominalpersatuan,$xtotal,$xiduser,$xnominaldenda,$xiddendasparta,$xidlokasi)
{
  $xStr =  " INSERT INTO transaksi( ".
              "idx,".
              "NIM,".
              "idjenistransaksi,".
              "idpegawai,".
              "idunitkerja,".
              "idstatusdinas,".
              "tanggal,".
              "jam,".
              "jumlahsatuan,".
              "nominalpersatuan,".
              "total,".
              "iduser,".
              "nominaldenda,".
              "iddendasparta,".
              "idlokasi) VALUES('".$xidx."','".$xNIM."','".$xidjenistransaksi."','".$xidpegawai."','".$xidunitkerja."','".$xidstatusdinas."','".$xtanggal."','".$xjam."','".$xjumlahsatuan."','".$xnominalpersatuan."','".$xtotal."','".$xiduser."','".$xnominaldenda."','".$xiddendasparta."','".$xidlokasi."')";

 //echo $xStr;
$query = $this->db->query($xStr);
 return $xidx;
}


 Function setUpdatetransaksi($xidx,$xNIM,$xidjenistransaksi,$xidpegawai,$xidunitkerja,$xidstatusdinas,$xtanggal,$xjam,$xjumlahsatuan,$xnominalpersatuan,$xtotal,$xiduser,$xnominaldenda,$xiddendasparta,$xidlokasi)
{
  $xStr =  " UPDATE transaksi SET ".
             "idx='".$xidx."',".
             "NIM='".$xNIM."',".
             "idjenistransaksi='".$xidjenistransaksi."',".
             "idpegawai='".$xidpegawai."',".
             "idunitkerja='".$xidunitkerja."',".
             "idstatusdinas='".$xidstatusdinas."',".
             "tanggal='".$xtanggal."',".
             "jam='".$xjam."',".
             "jumlahsatuan='".$xjumlahsatuan."',".
             "nominalpersatuan='".$xnominalpersatuan."',".
             "total='".$xtotal."',".
             "iduser='".$xiduser."',".
             "nominaldenda='".$xnominaldenda."',".
             "iddendasparta='".$xiddendasparta."',".
             "idlokasi='".$xidlokasi."' WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}


 function setDeletetransaksi($xidx)
{
 $xStr =  " DELETE FROM transaksi WHERE transaksi.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
}

}
?>