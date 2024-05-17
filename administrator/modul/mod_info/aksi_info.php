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

// Input info
if ($module=='info' AND $act=='input_info'){
  mysql_query("INSERT INTO info(id_info,
                                 nama
                                 )
	                       VALUES('$_POST[id_info]',
                                '$_POST[nama]')");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='info' AND $act=='hapusinfo'){
  mysql_query("DELETE FROM info WHERE id = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='info' AND $act=='hapuswaliinfo'){
  $info = mysql_query("SELECT * FROM siswa WHERE id_info = '$_GET[id]'");
  $r = mysql_fetch_array($info);

  mysql_query("UPDATE siswa SET jabatan = 'Siswa'
                                WHERE id_siswa = '$r[id_siswa]'");
  mysql_query("UPDATE info SET id_pegawai  = '0',
                                id_siswa  = '0'
                        WHERE id = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='info' AND $act=='update_info'){
  mysql_query("UPDATE info SET id_info = '$_POST[id_info]',
                                nama = '$_POST[nama]'
                                
                        WHERE id = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
}
elseif ($module=='info' AND $act=='input_waliinfo'){
  $cari = mysql_query("SELECT * FROM info WHERE id_info = '$_POST[info]'");
  $r = mysql_fetch_array($cari);
  mysql_query("UPDATE info SET id_pegawai  = '$_SESSION[idpegawai]',
                                id_siswa  = '$_POST[ketua]'
                        WHERE id = '$r[id]'");
  mysql_query("UPDATE siswa SET jabatan = 'Ketua Kelas'
                                WHERE id_siswa = '$_POST[ketua]'");
  header('location:../../media_admin.php?module=home');
}

elseif ($module=='info' AND $act=='update_waliinfo'){
  $cek = mysql_query("SELECT * FROM info WHERE id = '$_POST[id]'");
  $c = mysql_fetch_array($cek);
  $cek_siswa = mysql_query("SELECT id_siswa FROM info WHERE id = '$_POST[id]'");
  $s=mysql_num_rows($cek_siswa);
  $cari = mysql_query("SELECT * FROM info WHERE id_info = '$_POST[info]'");
  $r = mysql_fetch_array($cari);

  if ($_POST['info']==$c[id_info]){

    if(!empty($s)){
         mysql_query("UPDATE siswa SET jabatan = 'siswa'
                                WHERE id_siswa = '$c[id_siswa]'");
         mysql_query("UPDATE info SET id_siswa  = '$_POST[ketua]'
                        WHERE id = '$_POST[id]'");
         mysql_query("UPDATE siswa SET jabatan = 'Ketua Kelas'
                                WHERE id_siswa = '$_POST[ketua]'");
    }else{
        mysql_query("UPDATE info SET id_siswa  = '$_POST[ketua]'
                        WHERE id = '$_POST[id]'");
    }
  }else{
      if (!empty($s)){
      mysql_query("UPDATE siswa SET jabatan = 'siswa'
                                WHERE id_siswa = '$c[id_siswa]'");
      mysql_query("UPDATE info SET id_pegawai  = '0',
                                id_siswa  = '0'
                        WHERE id = '$_POST[id]'");

      mysql_query("UPDATE info SET id_pegawai  = '$_SESSION[idpegawai]',
                                id_siswa  = '$_POST[ketua]'
                        WHERE id = '$r[id]'");
      mysql_query("UPDATE siswa SET jabatan = 'Ketua Kelas'
                                WHERE id_siswa = '$_POST[ketua]'");
      }else{
          mysql_query("UPDATE info SET id_pegawai  = '0',
                                id_siswa  = '0'
                        WHERE id = '$_POST[id]'");

          mysql_query("UPDATE info SET id_pegawai  = '$_SESSION[idpegawai]',
                                id_siswa  = '$_POST[ketua]'
                        WHERE id = '$r[id]'");
          mysql_query("UPDATE siswa SET jabatan = 'Ketua Kelas'
                                WHERE id_siswa = '$_POST[ketua]'");
      }
  }
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='info' AND $act=='update_info_siswa'){
    mysql_query("UPDATE siswa SET id_info         = '$_POST[id_info]'
                                WHERE  id_siswa    = '$_SESSION[idsiswa]'");

header('location:../../../media.php?module=info');
}

}
?>
