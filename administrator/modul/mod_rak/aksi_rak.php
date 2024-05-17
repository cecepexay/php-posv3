<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Input mapel
if ($module=='rak' AND $act=='input_rak'){
    mysql_query("INSERT INTO rak(id_rak,
                                 nama,
                                 id_kategori,
                                 id_pegawai,
                                 deskripsi)
	                       VALUES('$_POST[id_rak]',
                                '$_POST[nama]',
                                '$_POST[id_kategori]',
                                '$_POST[id_pegawai]',
                                '$_POST[deskripsi]')");
  header('location:../../media_admin.php?module='.$module);
}

// Input mapel
elseif ($module=='rak' AND $act=='input_rak_pegawai'){
    $cek = mysql_query("SELECT * FROM rak WHERE id_rak = '$_POST[id_rak]'");
    $ada = mysql_fetch_array($cek);
    mysql_query("UPDATE rak SET id_pegawai         = '$_SESSION[idpegawai]',
                                         deskripsi         = '$_POST[deskripsi]'
                                         WHERE  id     = '$ada[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='rak' AND $act=='update_rak'){
   mysql_query("UPDATE rak SET id_rak  = '$_POST[id_rak]',
                                                    nama   = '$_POST[nama]',
                                                  id_kategori = '$_POST[id_kategori]',
                                               id_pegawai         = '$_POST[id_pegawai]',
                                         deskripsi         = '$_POST[deskripsi]'
                                         WHERE  id     = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='rak' AND $act=='update_rak_pegawai'){
   $pelajaran = mysql_query("SELECT * FROM rak WHERE id = '$_POST[id]'");
   $data = mysql_fetch_array($pelajaran);
   $pelajaran2 = mysql_query("SELECT * FROM rak WHERE id_rak = '$_POST[id_rak]'");
   $data2 = mysql_fetch_array($pelajaran2);

   if ($_POST['id_rak'] == $data['id_rak']){
        mysql_query("UPDATE rak SET deskripsi  = '$_POST[deskripsi]'
                                         WHERE  id     = '$_POST[id]'");
   }else{
       mysql_query("UPDATE rak SET id_pegawai         = '0',
                                         deskripsi         = ''
                                         WHERE  id     = '$data[id]'");

       mysql_query("UPDATE rak SET id_pegawai         = '$_SESSION[idpegawai]',
                                         deskripsi         = '$_POST[deskripsi]'
                                         WHERE  id     = '$data2[id]'");
   }
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='rak' AND $act=='hapus'){
  mysql_query("DELETE FROM rak WHERE id = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='rak' AND $act=='hapus_mapel_pegawai'){
  mysql_query("UPDATE rak SET id_pegawai   = '0',
                                         deskripsi     = ''
                                         WHERE  id     = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

}
?>
