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

 // membaca semua kategori
 $query = "SELECT * FROM kategori";
 $hasil = mysql_query($query);

 // membuat if untuk masing-masing pilihan kategori beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $idkategori = $data['id_kategori'];

   // membuat IF untuk masing-masing kategori
   echo "if (document.form_kategori.kategori.value == \"".$idkategori."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing kategori
   $query2 = "SELECT * FROM siswa WHERE id_kategori = '$idkategori'";
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

$aksi="modul/mod_kategori/aksi_kategori.php";
$aksi_siswa = "administrator/modul/mod_siswa/aksi_siswa.php";
switch($_GET[act]){
  // Tampil kategori
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM kategori ORDER BY id_kategori");

      echo "<h2>Manajemen Kategori</h2><hr>
          <input type=button class='btn btn-info' value='Tambah Kategori' onclick=\"window.location.href='?module=kategori&act=tambahkategori';\">";
      echo "<br><br><table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>
          <tr><th>No</th><th>Id kategori</th><th>Kategori</th><th>Pengelola</th><th>Aksi</th></tr></thead>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){       
       echo "<tr><td>$no</td>
             <td>$r[id_kategori]</td>
             <td>$r[nama]</td>";
             $pegawai = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$r[id_pegawai]'");
                    $ada_pegawai = mysql_num_rows($pegawai);
                    if(!empty($ada_pegawai)){
                    while($p=mysql_fetch_array($pegawai)){
                            echo "<td><a href=?module=admin&act=detailpegawai&id=$r[id_pegawai] title='Detail Pengelola'>$p[nama_lengkap]</a></td>";
                    }
                    }else{
                            echo "<td></td>";
                   
                    }
             echo "<td>
			 <div class='hidden-phone visible-desktop action-buttons'>
													<a class='green' href='?module=kategori&act=editkategori&id=$r[id]'>
														<i class='icon-pencil bigger-130'></i>													</a>

													<a class='red' href=javascript:confirmdelete('$aksi?module=kategori&act=hapuskategori&id=$r[id]')>
														<i class='icon-trash bigger-130'></i>													</a>												</div>

			</td></tr>";
      $no++;
      
    }
    echo "</table>";
    }
    elseif ($_SESSION[leveluser]=='pegawai'){
         echo"<h2>Daftar Kategori</h2><hr>";
         $tampil_kategori = mysql_query("SELECT * FROM kategori WHERE id_pegawai = '$_SESSION[idpegawai]'");
         $ketemu=mysql_num_rows($tampil_kategori);
         if (!empty($ketemu)){
                echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>
                <tr><th>No</th><th>Kategori</th><th>Pengelola</th></tr></thead>";

                $no=1;
                while ($r=mysql_fetch_array($tampil_kategori)){
                    echo "<tr><td>$no</td>
                    <td>$r[nama]</td>";

                    $pegawai = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$_SESSION[idpegawai]'");
                    $ada_pegawai = mysql_num_rows($pegawai);
                    if(!empty($ada_pegawai)){
                    while($p=mysql_fetch_array($pegawai)){
                            echo "<td><a href=?module=admin&act=detailpegawai&id=$r[id_pegawai] title='Detail Pengelola'>$p[nama_lengkap]</a></td>";
                    }
                    }else{
                            echo "<td></td>";
                   
                    }
                    
                $no++;
                }
                echo "</table>";
                }else{
                    echo "<script>window.alert('Tidak ada kategori yang anda ampu,kembali ke home untuk menambah');
                    window.location=(href='?module=home')</script>";
                }
    }
    break;
    
    case "tambahkategori":
    if ($_SESSION[leveluser]=='admin'){
    echo "<form method=POST action='$aksi?module=kategori&act=input_kategori'>
          <fieldset>
          <legend>Tambah Kategori</legend>
          <dl class='inline'>
          <dt><label>Id Kategori</label></dt>        <dd> : <input type=text name='id_kategori'></dd>
          <dt><label>Nama Kategori</label></dt>      <dd> : <input type=text name='nama'></dd>
          <dt><label>Pengelola</label></dt>      <dd> : <select name='id_pegawai'>
                                      <option value=0 selected>-- Pilih Pegawai --</option>";
                                      $tampil=mysql_query("SELECT * FROM pegawai ORDER BY nama_lengkap");
                                      while($r=mysql_fetch_array($tampil)){
                                      echo "<option value=$r[id_pegawai]>$r[nama_lengkap]</option>";
                                      }echo "</select></dd>
          
          </dl>
          <div class='buttons'>
          <input class='btn btn-info' type=submit value=Simpan>
          <input class='btn btn-info' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset></form>";
    }
    elseif ($_SESSION[leveluser]=='pegawai'){
        echo "<form name='form_kategori' method=POST action='$aksi?module=kategori&act=input_walikategori'>
          <fieldset>
          <legend>Kategori yang anda ampu</legend>
          <dl class='inline'>
          <dt><label>Kategori </label></dt>    <dd> <select name='kategori' onChange='showsiswa()'>
                                      <option value=0 selected>--pilih--</option>";
                                      $tampilk = mysql_query("SELECT * FROM kategori WHERE id_pegawai ='0' ORDER BY id_kategori");
                                      while($r=mysql_fetch_array($tampilk)){
                                            echo "<option value=$r[id_kategori]>$r[nama]</option>";
                                      }echo"</select></dd>
          
          <p align=center><input type=submit class='btn btn-info' value=Simpan>
                            <input type=button class='btn btn-info' value=Batal onclick=self.history.back()></p>
         </dl></fieldset</form>";

    }
    break;

    case "editkategori":
    if ($_SESSION[leveluser]=='admin'){
    $tampil = mysql_query("SELECT * FROM kategori WHERE id = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
    $getnip = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$r[id_pegawai]'");
    $nipp = mysql_fetch_array($getnip);
    $getnis = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$r[id_siswa]'");
    $niss = mysql_fetch_array($getnis);
    
    echo "<form method=POST action='$aksi?module=kategori&act=update_kategori'>
          <input type=hidden name=id value='$r[id]'>
          <fieldset>
          <legend>Edit Kategori</legend>
          <dl class='inline'>
          <dt><label>Id Kategori</label></dt>       <dd> : <input type=text name='id_kategori' value='$r[id_kategori]') </dd>
          <dt><label>Nama Kategori</label></dt>     <dd> : <input type=text name='nama' value='$r[nama]'></dd>
          <dt><label>Pengelola</label></dt>     <dd> : <select name='id_pegawai'>";
                                 
                                      echo "<option value='$nipp[id_pegawai]' selected>$nipp[nama_lengkap]</option>";
                                      $tampil=mysql_query("SELECT * FROM pegawai ORDER BY nama_lengkap");
                                      while($p=mysql_fetch_array($tampil)){
                                      echo "<option value=$p[id_pegawai]>$p[nama_lengkap]</option>";
                                      }echo "</select></dd>
          
          </dl>
          <div class='buttons'>
          <input class='btn btn-info' type=submit value=Update>
          <input class='btn btn-info' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset></form>";
    }
    elseif ($_SESSION[leveluser]=='pegawai'){
    $tampil = mysql_query("SELECT * FROM kategori WHERE id = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
     echo "<form method=POST action='$aksi?module=kategori&act=update_walikategori'>
    <input type=hidden name=id value='$r[id]'>
          <fieldset>
              <legend>Edit Kategori</legend>
              <dl class='inline'>
          <dt><label>Kategori </label></dt>   <dd>: <select name='kategori' onChange='showsiswa()'>
                                      <option value='$r[id_kategori]' selected>$r[nama]</option>";
                                      $tampilk = mysql_query("SELECT * FROM kategori WHERE id_pegawai ='0' ORDER BY id_kategori");
                                      while($t=mysql_fetch_array($tampilk)){
                                            echo "<option value=$t[id_kategori]>$t[nama]</option>";
                                      }echo"</select></dd>
          
         <p align=center><input type=submit class='btn btn-info' value=Simpan>
                            <input type=button class='btn btn-info' value=Batal onclick=self.history.back()></p>
         </dl></fieldset</form>";
    }
    
    break;


case "detailkategori":
    $detail=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
   
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='information msg'>Detail Kategori</div>";
    echo "<br><table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>
          <tr><th>Id Kategori</th><th>Kategori</th><th>Pengelola</th><th>Aksi</th></tr></thead>";

    while ($r=mysql_fetch_array($detail)){
       echo "<tr>
             <td>$r[id_kategori]</td>
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
     
             echo"<td><a href='?module=kategori&act=editkategori&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a><a href=javascript:confirmdelete('$aksi?module=kategori&act=hapuskategori&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      }
    echo "</table>
          <div class='buttons'>
          <br><input class='btn btn-info' type=button value=Kembali onclick=self.history.back()>
          </div>";
    }else{
        echo "<form><fieldset>
              <legend>Detail Kategori</legend>
              <dl class='inline'>";
    echo "<table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>
          <tr><th>No</th><th>Kategori</th><th>Pengelola</th><th>Aksi</th></tr></thead>";
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
             echo"<td><a href='?module=kategori&act=editkategori&id=$r[id]' title='Edit'> <img src='images/icons/edit.png' alt='Edit' /></a>|
                      <input type=button class='button small White' value='Lihat Siswa' onclick=\"window.location.href='?module=siswa&act=lihatmurid&id=$r[id_kategori]';\">";
       $no++;
      }
    echo "</table></dl></fieldset</form>
    <br> <input type=button class='btn btn-info' value=Kembali onclick=self.history.back()>";
    }

    break;

 
}
}
?>
