<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
<script language="JavaScript" type="text/JavaScript">

 function showpel()
 {
 <?php

 // membaca semua kategori
 $query = "SELECT * FROM kategori";
 $hasil = mysql_query($query);

 // membuat if untuk masing-masing pilihan kategori beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $idkategori = $data['id_kategori'];

   // membuat IF untuk masing-masing kategori
   echo "if (document.form_materi.id_kategori.value == \"".$idkategori."\")";
   echo "{";

   // membuat option rak untuk masing-masing kategori
   $query2 = "SELECT * FROM rak WHERE id_kategori = '$idkategori' AND id_pegawai = '0'";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('pelajaran').innerHTML = \"<select name='".id_rak."'>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['id_rak']."'>".$data2['nama']."</option>";
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

$aksi="modul/mod_rak/aksi_rak.php";
switch($_GET[act]){
// Tampil Mata Pelajaran
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil_pelajaran = mysql_query("SELECT * FROM rak ORDER BY id_kategori");
      echo "<h2>Manajemen Rak</h2><hr>
          <input class='btn btn-info' type=button value='Tambah Rak' onclick=\"window.location.href='?module=rak&act=tambahrak';\">";
          echo "<br><br><table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>
          <tr><th>No</th><th>Id Rak</th><th>Nama</th><th>Kategori</th><th>Pengelola</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil_pelajaran)){
       echo "<tr><td>$no</td>
             <td>$r[id_rak]</td>
             <td>$r[nama]</td>";
             $kategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$r[id_kategori]'");
             $cek = mysql_num_rows($kategori);
             if(!empty($cek)){
             while($k=mysql_fetch_array($kategori)){
                 echo "<td><a href=?module=kategori&act=detailkategori&id=$r[id_kategori] title='Detail Kategori'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pegawai = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$r[id_pegawai]'");
             $cek_pegawai = mysql_num_rows($pegawai);
             if(!empty($cek_pegawai)){
             while($p=mysql_fetch_array($pegawai)){
             echo "<td><a href=?module=admin&act=detailpegawai&id=$r[id_pegawai] title='Detail Pengelola'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>
             <td><a href='?module=rak&act=editrak&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a><a href=javascript:confirmdelete('$aksi?module=rak&act=hapus&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
    }
    echo "</table>";
    }
    elseif ($_SESSION[leveluser]=='pegawai'){
     //mata pelajaran

  $tampil_pelajaran = mysql_query("SELECT * FROM rak WHERE id_pegawai = '$_SESSION[idpegawai]'");
  $cek_mapel = mysql_num_rows($tampil_pelajaran);
  if (!empty($cek_mapel)){
    echo"<h2>Daftar Rak</h2><hr>
    ";
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>
          <tr><th>No</th><th>Nama</th><th>Kategori</th><th>Pengelola</th><th>Deskripsi</th></tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil_pelajaran)){
       echo "<tr><td>$no</td>             
             <td>$r[nama]</td>";
             $kategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$r[id_kategori]'");
             $cek = mysql_num_rows($kategori);
             if(!empty($cek)){
             while($k=mysql_fetch_array($kategori)){
                 echo "<td>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pegawai = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$r[id_pegawai]'");
             $cek_pegawai = mysql_num_rows($pegawai);
             if(!empty($cek_pegawai)){
             while($p=mysql_fetch_array($pegawai)){
             echo "<td><a href=?module=admin&act=detailpegawai&id=$r[id_pegawai] title='Detail Pengelola'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>";
      $no++;
    }
    echo "</table>";
        }else{
            echo "<script>window.alert('Tidak ada data');
            window.location=(href='?module=home')</script>";
        }
    }
   
    break;

case "tambahrak":
    if ($_SESSION[leveluser]=='admin'){
        echo "<form method=POST action='$aksi?module=rak&act=input_rak'>
          <fieldset>
          <legend>Tambah Rak</legend>
          <dl class='inline'>
          <dt><label>Id Rak</label></dt>     <dd>: <input type=text name='id_rak' size=10></dd>
          <dt><label>Nama</label></dt>                <dd>: <input type=text name='nama' size=30></dd>
          <dt><label>Kategori</label></dt>                <dd>: <select name='id_kategori'>
                                                  <option value=0 selected>--pilih--</option>";
                                                  $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama");
                                                  while($r=mysql_fetch_array($tampil)){
                                                  echo "<option value=$r[id_kategori]>$r[nama]</option>";
                                                  }echo "</select></dd>
         <dt><label>Pengelola</label></dt>              <dd>: <select name='id_pegawai'>
                                                  <option value=0 selected>--pilih--</option>";
                                                  $tampil_pegawai=mysql_query("SELECT * FROM pegawai ORDER BY nama_lengkap");
                                                  while($p=mysql_fetch_array($tampil_pegawai)){
                                                  echo "<option value=$p[id_pegawai]>$p[nama_lengkap]</option>";
                                                  }echo "</select></dd>
        <dt><label>Deskripsi</label></dt>             <dd>: <textarea name='deskripsi' id='wysiwyg' class='medium' rows='6'></textarea></td><tr>
          </dl>
          <div class='buttons'>
          <input class='btn btn-info' type=submit value=Simpan>
          <input class='btn btn-info' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset></form>";
    }
    elseif ($_SESSION[leveluser]=='pegawai'){
        echo "<form method=POST name='form_materi' action='$aksi?module=rak&act=input_rak_pegawai'>          
          <fieldset>
          <legend>Mata Pelajaran yang di ampu</legend>
          <dl class='inline'>
          <dt><label>Kategori </label></dt>             <dd><select name='id_kategori' onChange='showpel()'>
                                          <option value=''>-pilih-</option>";
                                          $pilih="SELECT * FROM kategori ORDER BY id_kategori";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kategori]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></dd>
          <dt><label>Pelajaran </label></dt>          <dd><div id='pelajaran'><select name='id_rak'></select></div></dd>
          <dt><label>Deskripsi </label></dt>             <dd><textarea name='deskripsi' id='wysiwyg' class='medium' rows='6'></textarea></dd>
          <p align=center><input type=submit class='btn btn-info' value=Simpan>
                      <input type=button class='btn btn-info' value=Batal onclick=self.history.back()></p>
          </dl></fieldset></form>";
    }
    break;

case "editrak":
    if ($_SESSION[leveluser]=='admin'){
        $mapel=mysql_query("SELECT * FROM rak WHERE id = '$_GET[id]'");
        $m=mysql_fetch_array($mapel);
        $kategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$m[id_kategori]'");
        $k = mysql_fetch_array($kategori);
        $pegawai = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$m[id_pegawai]'");
        $d = mysql_fetch_array($pegawai);
        
        echo "
          <form method=POST action='$aksi?module=rak&act=update_rak'>
          <input type=hidden name=id value='$m[id]'>
          <fieldset>
          <legend>Edit Rak</legend>
          <dl class='inline'>
          <dt><label>Id Rak</label></dt>     <dd>: <input type=text name='id_rak' size=10 value='$m[id_rak]'></dd>
          <dt><label>Nama</label></dt>                 <dd>: <input type=text name='nama' size=30 value='$m[nama]'></dd>
          <dt><label>Kategori</label></dt>                <dd>: <select name='id_kategori'>
                                                  <option value='$k[id_kategori]' selected>$k[nama]</option>";
                                                  $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama");
                                                  while($r=mysql_fetch_array($tampil)){
                                                  echo "<option value=$r[id_kategori]>$r[nama]</option>";
                                                  }echo "</select></dd>
         <dt><label>Pengelola</label></dt>              <dd>: <select name='id_pegawai'>
                                                  <option value='$d[id_pegawai]' selected>$d[nama_lengkap]</option>";
                                                  $tampil_pegawai=mysql_query("SELECT * FROM pegawai ORDER BY nama_lengkap");
                                                  while($p=mysql_fetch_array($tampil_pegawai)){
                                                  echo "<option value=$p[id_pegawai]>$p[nama_lengkap]</option>";
                                                  }echo "</select></dd>
        <dt><label>Deskripsi</label></dt>            <dd>: <textarea name='deskripsi' id='wysiwyg' class='medium' rows='6'>$m[deskripsi]</textarea></dd>
        </dl>
          <div class='buttons'>
          <input class='btn btn-info' type=submit value=Update>
          <input class='btn btn-info' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset></form>";
    }else{
        $mapel=mysql_query("SELECT * FROM rak WHERE id = '$_GET[id]'");
        $m=mysql_fetch_array($mapel);
        $kategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$m[id_kategori]'");
        $k = mysql_fetch_array($kategori);
        $pegawai = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$m[id_pegawai]'");
        $d = mysql_fetch_array($pegawai);

        echo "<form method=POST name='form_materi' action='$aksi?module=rak&act=update_rak_pegawai'>
          <input type=hidden name=id value='$m[id]'>
          <fieldset>
          <legend>Edit Rak</legend>
          <dl class='inline'>
          <dt><label>Kategori </label></dt>             <dd><select name='id_kategori' onChange='showpel()'>
                                          <option value='$k[id_kategori]' selected>$k[nama]</option>";
                                          $pilih="SELECT * FROM kategori ORDER BY nama";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kategori]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></dd>
          <dt><label>Pelajaran </label></dt>         <dd><select id='pelajaran' name='id_rak'>
                                          <option value='".$m[id_rak]."' selected>".$m[nama]."</option>
                                          </select></dd>
          <dt><label>Deskripsi </label></dt>         <dd><textarea name='deskripsi' id='wysiwyg' class='medium' rows='6'>$m[deskripsi]</textarea></dd>
          <p align=center><input class='btn btn-info' type=submit value=Simpan>
                      <input class='btn btn-info' type=button value=Batal onclick=self.history.back()></p>
          </dl></fieldset></form>";
    }
    break;
case "detailpelajaran":
    if ($_SESSION[leveluser]=='admin'){
        $detail =mysql_query("SELECT * FROM rak WHERE id_rak = '$_GET[id]'");
        echo "<div class='information msg'>Detail Rak</div>
          <br><table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>
          <tr><th>No</th><th>Id Rak</th><th>Nama</th><th>Kategori</th><th>Pengelola</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";
        $no=1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr><td>$no</td>
             <td>$r[id_rak]</td>
             <td>$r[nama]</td>";
             $kategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$r[id_kategori]'");
             $cek_kategori = mysql_num_rows($kategori);
             if(!empty($cek_kategori)){
             while($k=mysql_fetch_array($kategori)){
                 echo "<td><a href=?module=kategori&act=detailkategori&id=$r[id_kategori] title='Detail Kategori'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pegawai = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$r[id_pegawai]'");
             $cek_pegawai = mysql_num_rows($pegawai);
             if(!empty($cek_pegawai)){
             while($p=mysql_fetch_array($pegawai)){
             echo "<td><a href=?module=admin&act=detailpegawai&id=$r[id_pegawai] title='Detail Pengelola'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td>
             <td><a href='?module=rak&act=editrak&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a><a href=javascript:confirmdelete('$aksi?module=rak&act=hapus&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
    }
    echo "</table>
    <div class='buttons'>
    <br><input class='btn btn-info' type=button value=Kembali onclick=self.history.back()>
    </div>";
    }else{
      $detail =mysql_query("SELECT * FROM rak WHERE id_rak = '$_GET[id]'");
        echo "<span class='judulhead'><p class='garisbawah'>Detail </p></span>
          <table>
          <tr><th>no</th><th>nama</th><th>kategori</th><th>pegawai</th><th>deskripsi</th></tr>";
                    $no=1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr><td>$no</td>             
             <td>$r[nama]</td>";
             $kategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$r[id_kategori]'");
             $cek_kategori = mysql_num_rows($kategori);
             if(!empty($cek_kategori)){
             while($k=mysql_fetch_array($kategori)){
                 echo "<td><a href=?module=kategori&act=detailkategori&id=$r[id_kategori] title='Detail Kategori'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pegawai = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$r[id_pegawai]'");
             $cek_pegawai = mysql_num_rows($pegawai);
             if(!empty($cek_pegawai)){
             while($p=mysql_fetch_array($pegawai)){
             echo "<td><a href=?module=admin&act=detailpegawai&id=$r[id_pegawai] title='Detail Pengelola'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             echo "<td>$r[deskripsi]</td></tr>";
             
      $no++;
    }
    echo "</table>
    <input type=button value=Kembali onclick=self.history.back()>";
    }
    break;
}
}
?>
