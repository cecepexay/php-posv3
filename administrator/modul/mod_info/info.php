<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
<script language="JavaScript" type="text/JavaScript">

 function showsiswa()
 {
 <?php

 // membaca semua info
 $query = "SELECT * FROM info";
 $hasil = mysql_query($query);

 // membuat if untuk masing-masing pilihan info beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $idinfo = $data['id_info'];

   // membuat IF untuk masing-masing info
   echo "if (document.form_info.info.value == \"".$idinfo."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing info
   $query2 = "SELECT * FROM siswa WHERE id_info = '$idinfo'";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('siswa').innerHTML = \"<select name='ketua'><option value='0' selected>--Pilih--</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['id_siswa']."'>".$data2['nama_lengkap']."</option>";
   }
   $content .= "</select>\";";
   echo $content;
   echo "}\n";
 }

 ?>
 }
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

$aksi="modul/mod_info/aksi_info.php";
$aksi_siswa = "administrator/modul/mod_siswa/aksi_siswa.php";
switch($_GET[act]){
  // Tampil info
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM info ORDER BY id_info");

      echo "<h2>Manajemen Info</h2><hr>
          <input type=button class='btn btn-info' value='Tambah Info' onclick=\"window.location.href='?module=info&act=tambahinfo';\">";
      echo "<br><br><table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>
          <tr><th>No</th><th>Id info</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){       
       echo "<tr><td>$no</td>
             <td>$r[id_info]</td>
             <td>$r[nama]</td>";
             
             echo "<td><a href='?module=info&act=editinfo&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a> |
                 <a href=javascript:confirmdelete('$aksi?module=info&act=hapusinfo&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
      
    }
    echo "</table>";
    }
    elseif ($_SESSION[leveluser]=='pegawai'){
        echo "<h2>Data Info</h2><hr>";
      echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>
          <tr><th>No</th><th>Id info</th><th>Deskripsi</th></tr></thead>";

         $tampil = mysql_query("SELECT * FROM info ORDER BY id_info");
     
    $no=1;
    while ($r=mysql_fetch_array($tampil)){       
       echo "<tr><td>$no</td>
             <td>$r[id_info]</td>
             <td>$r[nama]</td>";
             
             echo "</tr>";
      $no++;
      
    }
    echo "</table>";
    }
    break;
    
    case "tambahinfo":
    if ($_SESSION[leveluser]=='admin'){
    echo "<form method=POST action='$aksi?module=info&act=input_info'>
          <fieldset>
          <legend>Tambah Info</legend>
          <dl class='inline'>
          <dt><label>Id Info</label></dt>        <dd> : <input type=text name='id_info' ></dd>
          <dt><label>Deskripsi Info</label></dt>      <dd> : <input type=text name='nama' size='60'></dd>
          
          
          </dl>
          <div class='buttons'>
          <input class='btn btn-info' type=submit value=Simpan>
          <input class='btn btn-info' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset></form>";
    }
    elseif ($_SESSION[leveluser]=='pegawai'){
        echo "<form name='form_info' method=POST action='$aksi?module=info&act=input_waliinfo'>
          <fieldset>
          <legend>Info yang anda ampu</legend>
          <dl class='inline'>
          <dt><label>Deskripsi </label></dt>    <dd> <select name='info' onChange='showsiswa()'>
                                      <option value=0 selected>--pilih--</option>";
                                      $tampilk = mysql_query("SELECT * FROM info WHERE id_pegawai ='0' ORDER BY id_info");
                                      while($r=mysql_fetch_array($tampilk)){
                                            echo "<option value=$r[id_info]>$r[nama]</option>";
                                      }echo"</select></dd>
          
          <p align=center><input type=submit class='btn btn-info' value=Simpan>
                            <input type=button class='btn btn-info' value=Batal onclick=self.history.back()></p>
         </dl></fieldset</form>";

    }
    break;

    case "editinfo":
    if ($_SESSION[leveluser]=='admin'){
    $tampil = mysql_query("SELECT * FROM info WHERE id = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
    $getnip = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$r[id_pegawai]'");
    $nipp = mysql_fetch_array($getnip);
    $getnis = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
    $niss = mysql_fetch_array($getnis);
    
    echo "<form method=POST action='$aksi?module=info&act=update_info'>
          <input type=hidden name=id value='$r[id]'>
          <fieldset>
          <legend>Edit Info</legend>
          <dl class='inline'>
          <dt><label>Id Info</label></dt>       <dd> : <input type=text name='id_info' value='$r[id_info]') </dd>
          <dt><label>Deskripsi Info</label></dt>     <dd> : <input type=text name='nama' value='$r[nama]'></dd>
         
          
          </dl>
          <div class='buttons'>
          <input class='btn btn-info' type=submit value=Update>
          <input class='btn btn-info' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset></form>";
    }
    elseif ($_SESSION[leveluser]=='pegawai'){
    $tampil = mysql_query("SELECT * FROM info WHERE id = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
     echo "<form method=POST action='$aksi?module=info&act=update_waliinfo'>
    <input type=hidden name=id value='$r[id]'>
          <fieldset>
              <legend>Edit Info</legend>
              <dl class='inline'>
          <dt><label>Deskripsi </label></dt>   <dd>: <select name='info' onChange='showsiswa()'>
                                      <option value='$r[id_info]' selected>$r[nama]</option>";
                                      $tampilk = mysql_query("SELECT * FROM info WHERE id_pegawai ='0' ORDER BY id_info");
                                      while($t=mysql_fetch_array($tampilk)){
                                            echo "<option value=$t[id_info]>$t[nama]</option>";
                                      }echo"</select></dd>
          
         <p align=center><input type=submit class='btn btn-info' value=Simpan>
                            <input type=button class='btn btn-info' value=Batal onclick=self.history.back()></p>
         </dl></fieldset</form>";
    }
    elseif ($_SESSION[leveluser]=='siswa'){
         echo"<br><b class='judul'>Edit Info</b><br><p class='garisbawah'></p>
         <form method=POST action='$aksi_siswa?module=siswa&act=update_info_siswa'>";
         $tampil = mysql_query("SELECT * FROM info WHERE id = '$_GET[id]'");
         $r = mysql_fetch_array($tampil);
         echo "<table>
          <tr><td>Deskripsi </td>   <td>: <select name='id_info'>
                                      <option value='$r[id_info]' selected>$r[nama]</option>";
                                      $tampilk = mysql_query("SELECT * FROM info ORDER BY id_info");
                                      while($t=mysql_fetch_array($tampilk)){
                                            echo "<option value=$t[id_info]>$t[nama]</option>";
                                      }echo"</select></td></tr>
        <tr><td colspan=2><input type=submit class='tombol' value='Update'>
                          <input type=button class='tombol' value='Batal'
                          onclick=self.history.back()></td></tr>
        </form></table>";
    }
    break;


case "detailinfo":
    $detail=mysql_query("SELECT * FROM info WHERE id_info='$_GET[id]'");
   
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='information msg'>Detail Info</div>";
    echo "<br><table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>
          <tr><th>Id Info</th><th>Deskripsi</th><th>Ketua Info</th><th>Aksi</th></tr></thead>";

    while ($r=mysql_fetch_array($detail)){
       echo "<tr>
             <td>$r[id_info]</td>
             <td>$r[nama]</td>";
             
             echo"<td><a href='?module=info&act=editinfo&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a> |
                 <a href=javascript:confirmdelete('$aksi?module=info&act=hapusinfo&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      }
    echo "</table>
          <div class='buttons'>
          <br><input class='btn btn-info' type=button value=Kembali onclick=self.history.back()>
          </div>";
    }else{
        echo "<form><fieldset>
              <legend>Detail Info</legend>
              <dl class='inline'>";
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>
          <tr><th>No</th><th>Deskripsi</th><th>Ketua Info</th><th>Aksi</th></tr></thead>";
    $no = 1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr>
             <td>$no</td>
             <td>$r[nama]</td>";
             $getpegawai = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$r[id_pegawai]'");
             $cek = mysql_num_rows($getpegawai);
             if (!empty($cek)){
             while($p=mysql_fetch_array($getpegawai)){
             echo "<td><a href=?module=admin&act=detailpegawai&id=$r[id_pegawai] title='Detail Pengelola'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             $getsiswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
             $cek_siswa = mysql_num_rows($getsiswa);
             if (!empty($cek_siswa)){
             while($s=mysql_fetch_array($getsiswa)){
             echo "<td><a href=?module=siswa&act=detailsiswa&id=$s[id_siswa] title='Detail Siswa'>$s[nama_lengkap]</a></td>";
             }
             }else{
                 echo "<td></td>";
             }
             echo"<td><a href='?module=info&act=editinfo&id=$r[id]' title='Edit'> <img src='images/icons/edit.png' alt='Edit' /></a>|
                      <input type=button class='button small White' value='Lihat Siswa' onclick=\"window.location.href='?module=siswa&act=lihatmurid&id=$r[id_info]';\">";
       $no++;
      }
    echo "</table></dl></fieldset</form>
    <br> <input type=button class='btn btn-info' value=Kembali onclick=self.history.back()>";
    }

    break;

 
}
}
?>
