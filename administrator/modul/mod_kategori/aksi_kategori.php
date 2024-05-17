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

// Input kategori
if ($module=='kategori' AND $act=='input_kategori'){
  mysql_query("INSERT INTO kategori(id_kategori,
                                 nama,
                                 id_pegawai)
	                       VALUES('$_POST[id_kategori]',
                                '$_POST[nama]',
                                '$_POST[id_pegawai]')");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='kategori' AND $act=='hapuskategori'){
  mysql_query("DELETE FROM kategori WHERE id = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='kategori' AND $act=='hapuswalikategori'){
  $kategori = mysql_query("SELECT * FROM siswa WHERE id_kategori = '$_GET[id]'");
  $r = mysql_fetch_array($kategori);

  mysql_query("UPDATE siswa SET jabatan = 'Siswa'
                                WHERE id_siswa = '$r[id_siswa]'");
  mysql_query("UPDATE kategori SET id_pegawai  = '0',
                                id_siswa  = '0'
                        WHERE id = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='kategori' AND $act=='update_kategori'){
  mysql_query("UPDATE kategori SET id_kategori = '$_POST[id_kategori]',
                                nama = '$_POST[nama]',
                                id_pegawai  = '$_POST[id_pegawai]'
                                
                        WHERE id = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
}
elseif ($module=='kategori' AND $act=='input_walikategori'){
  $cari = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$_POST[kategori]'");
  $r = mysql_fetch_array($cari);
  mysql_query("UPDATE kategori SET id_pegawai  = '$_SESSION[idpegawai]',
                                id_siswa  = '$_POST[ketua]'
                        WHERE id = '$r[id]'");
  mysql_query("UPDATE siswa SET jabatan = 'Ketua Kelas'
                                WHERE id_siswa = '$_POST[ketua]'");
  header('location:../../media_admin.php?module=home');
}

elseif ($module=='kategori' AND $act=='update_walikategori'){
  $cek = mysql_query("SELECT * FROM kategori WHERE id = '$_POST[id]'");
  $c = mysql_fetch_array($cek);
  $cek_siswa = mysql_query("SELECT id_siswa FROM kategori WHERE id = '$_POST[id]'");
  $s=mysql_num_rows($cek_siswa);
  $cari = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$_POST[kategori]'");
  $r = mysql_fetch_array($cari);

  if ($_POST['kategori']==$c[id_kategori]){

    if(!empty($s)){
         mysql_query("UPDATE siswa SET jabatan = 'siswa'
                                WHERE id_siswa = '$c[id_siswa]'");
         mysql_query("UPDATE kategori SET id_siswa  = '$_POST[ketua]'
                        WHERE id = '$_POST[id]'");
         mysql_query("UPDATE siswa SET jabatan = 'Ketua Kelas'
                                WHERE id_siswa = '$_POST[ketua]'");
    }else{
        mysql_query("UPDATE kategori SET id_siswa  = '$_POST[ketua]'
                        WHERE id = '$_POST[id]'");
    }
  }else{
      if (!empty($s)){
      mysql_query("UPDATE siswa SET jabatan = 'siswa'
                                WHERE id_siswa = '$c[id_siswa]'");
      mysql_query("UPDATE kategori SET id_pegawai  = '0',
                                id_siswa  = '0'
                        WHERE id = '$_POST[id]'");

      mysql_query("UPDATE kategori SET id_pegawai  = '$_SESSION[idpegawai]',
                                id_siswa  = '$_POST[ketua]'
                        WHERE id = '$r[id]'");
      mysql_query("UPDATE siswa SET jabatan = 'Ketua Kelas'
                                WHERE id_siswa = '$_POST[ketua]'");
      }else{
          mysql_query("UPDATE kategori SET id_pegawai  = '0',
                                id_siswa  = '0'
                        WHERE id = '$_POST[id]'");

          mysql_query("UPDATE kategori SET id_pegawai  = '$_SESSION[idpegawai]',
                                id_siswa  = '$_POST[ketua]'
                        WHERE id = '$r[id]'");
          mysql_query("UPDATE siswa SET jabatan = 'Ketua Kelas'
                                WHERE id_siswa = '$_POST[ketua]'");
      }
  }
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='kategori' AND $act=='update_kategori_siswa'){
    mysql_query("UPDATE siswa SET id_kategori         = '$_POST[id_kategori]'
                                WHERE  id_siswa    = '$_SESSION[idsiswa]'");

header('location:../../../media.php?module=kategori');
}

}
?>
