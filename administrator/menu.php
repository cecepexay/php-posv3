<?php
include "../configurasi/koneksi.php";

if ($_SESSION['leveluser']=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
  while ($m=mysql_fetch_array($sql)){
    echo "<li class='garisbawah'><a href='$m[link]'>$m[nama_modul]</a></li>";
  }
}
elseif ($_SESSION['leveluser']=='pegawai'){
  $sql=mysql_query("select * from modul where status='pegawai' and aktif='Y' order by urutan");
  while ($m=mysql_fetch_array($sql)){
    echo "<li class='garisbawah'><a href='$m[link]'>$m[nama_modul]</a></li>";
  }
}
?>
