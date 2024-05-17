<?php
// asep setiawan - www.contoh-ta.com
// lisensi perorangan
// kontak 089657241465
// investasi.saya@gmail.com
?>
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
   echo "if (document.form_surat_keluar.id_kategori.value == \"".$idkategori."\")";
   echo "{";

   // membuat option rak untuk masing-masing kategori
   $query2 = "SELECT * FROM rak WHERE id_kategori = '$idkategori'";
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

 function showpel_pegawai()
 {
 <?php

 // membaca semua kategori
 $query1 = "SELECT * FROM kategori";
 $hasil1 = mysql_query($query1);

 // membuat if untuk masing-masing pilihan kategori beserta isi option untuk combobox kedua
 while ($data1 = mysql_fetch_array($hasil1))
 {
   $idkategori = $data1['id_kategori'];

   // membuat IF untuk masing-masing kategori
   echo "if (document.form_surat_keluar_pegawai.id_kategori.value == \"".$idkategori."\")";
   echo "{";

   // membuat option rak untuk masing-masing kategori
   $query2 = "SELECT * FROM rak WHERE  id_kategori = '$idkategori'";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('pelajaran_pegawai').innerHTML = \"<select name='".id_rak."'>";
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
function fsize($file){
                            $a = array("B", "KB", "MB", "GB", "TB", "PB");
                            $pos = 0;
                            $size = filesize($file);
                            while ($size >= 1024)
                            {
                            $size /= 1024;
                            $pos++;
                            }
                            return round ($size,2)." ".$a[$pos];
                            }
?>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{
$aksi="modul/mod_surat_keluar/aksi_surat_keluar.php";
switch($_GET[act]){
  // Tampil kategori
  default:
  
    if ($_SESSION[leveluser]=='admin'){
                
        $tampil_surat_keluar = mysql_query("SELECT * FROM surat_keluar ORDER BY tgl_surat DESC");
        $cek_surat_keluar = mysql_num_rows($tampil_surat_keluar);
        if(!empty($cek_surat_keluar)){
        echo "<h2>Manajemen Surat Keluar</h2><hr>
          <input class='btn btn-info' type=button value='Surat Keluar' onclick=\"window.location.href='?module=surat_keluar&act=tambahsurat_keluar';\">";
        echo "<br><br><table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>";
		if (empty($_GET['kata'])){
		echo "

          <tr><th>No</th><th>No Surat</th><th>Judul</th><th>Tanggal Surat</th><th>Kategori</th><th>Rak</th><th>Nama File</th><th>Tgl Entry</th><th>Pembuat</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";
       $no=1;
    while ($r=mysql_fetch_array($tampil_surat_keluar)){
	
      $tgl_posting   = tgl_indo($r[tgl_posting]);
	  $tgl_surat   = tgl_indo($r[tgl_surat]);
       echo "<tr><td>$no</td>
	         <td>$r[no_surat]</td>
             <td>$r[judul]</td>
			 <td>$tgl_surat</td>";
             $kategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$r[id_kategori]'");
             $cek_kategori = mysql_num_rows($kategori);
             if(!empty($cek_kategori)){
             while($k=mysql_fetch_array($kategori)){
                 echo "<td><a href=?module=kategori&act=detailkategori&id=$r[id_kategori] title='Detail Kategori'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pelajaran = mysql_query("SELECT * FROM rak WHERE id_rak = '$r[id_rak]'");
             
             $cek_pelajaran = mysql_num_rows($pelajaran);
             if(!empty($cek_pelajaran)){
             while($p=mysql_fetch_array($pelajaran)){
                echo "<td><a href=?module=rak&act=detailpelajaran&id=$r[id_rak] title='Detail pelajaran'>$p[nama]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }

             echo "<td><a href='../downlot.php?file=$r[nama_file]'>$r[nama_file]</a></td>
             <td>$tgl_posting</td>";
             $pelajaran2 = mysql_query("SELECT * FROM rak WHERE id_rak = '$r[id_rak]'");
             $p2 = mysql_fetch_array($pelajaran2);
             $pegawai2 = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$p2[id_pegawai]'");
             $cek_pegawai2 = mysql_num_rows($pegawai2);
             if(!empty($cek_pegawai2)){
                 while ($p3= mysql_fetch_array($pegawai2)){
                 echo "<td>$p3[nama_lengkap]</td>";
             }
             }else{
                 echo "<td>$r[pembuat]</td>";
             }
             echo"
			 <td>$r[deskripsi]</td>
             <td><a href='?module=surat_keluar&act=editsurat_keluar&id=$r[id_file]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a><a href=javascript:confirmdelete('$aksi?module=surat_keluar&act=hapus&id=$r[id_file]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
    }
    echo "</table>";
 
    }

	else{
	
	echo "<div class='right'><form method=get action='$_SERVER[PHP_SELF]'>
          <input type=hidden name=module value=surat_keluar>
          Cari Judul : <input type=text name='kata' size=60> <input type=submit value=Cari>
          </form></div>";
	
    echo "<tr><th>No</th><th>No Surat</th><th>Judul</th><th>Tanggal Surat</th><th>Kategori</th><th>Rak</th><th>Nama File</th><th>Tgl Entry</th><th>Pembuat</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";


    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM surat_keluar WHERE judul LIKE '%$_GET[kata]%' ORDER BY tgl_surat DESC");
    }

  else{
      $tampil=mysql_query("SELECT * FROM surat_keluar 
                           WHERE username='$_SESSION[namauser]'
                           AND judul LIKE '%$_GET[kata]%'       
                           ORDER BY tgl_surat");
    }
    $no = 1;
    while($r=mysql_fetch_array($tampil)){
      $tgl_posting   = tgl_indo($r[tgl_posting]);
	  $tgl_surat   = tgl_indo($r[tgl_surat]);
      echo "<tr><td>$no</td>
	         <td>$r[no_surat]</td>
             <td>$r[judul]</td>
			 <td>$tgl_surat</td>";
             $kategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$r[id_kategori]'");
             $cek_kategori = mysql_num_rows($kategori);
             if(!empty($cek_kategori)){
             while($k=mysql_fetch_array($kategori)){
                 echo "<td><a href=?module=kategori&act=detailkategori&id=$r[id_kategori] title='Detail Kategori'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pelajaran = mysql_query("SELECT * FROM rak WHERE id_rak = '$r[id_rak]'");
             
             $cek_pelajaran = mysql_num_rows($pelajaran);
             if(!empty($cek_pelajaran)){
             while($p=mysql_fetch_array($pelajaran)){
                echo "<td><a href=?module=rak&act=detailpelajaran&id=$r[id_rak] title='Detail pelajaran'>$p[nama]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }

             echo "<td><a href='downlot.php?file=$r[nama_file]'>$r[nama_file]</a></td>
             <td>$tgl_posting</td>";
             $pelajaran2 = mysql_query("SELECT * FROM rak WHERE id_rak = '$r[id_rak]'");
             $p2 = mysql_fetch_array($pelajaran2);
             $pegawai2 = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$p2[id_pegawai]'");
             $cek_pegawai2 = mysql_num_rows($pegawai2);
             if(!empty($cek_pegawai2)){
                 while ($p3= mysql_fetch_array($pegawai2)){
                 echo "<td>$p3[nama_lengkap]</td>";
             }
             }else{
                 echo "<td>$r[pembuat]</td>";
             }
             echo"
			 <td>$r[deskripsi]</td>
             <td><a href='?module=surat_keluar&act=editsurat_keluar&id=$r[id_file]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a><a href=javascript:confirmdelete('$aksi?module=surat_keluar&act=hapus&id=$r[id_file]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
    }
    echo "</table>";

    if ($_SESSION[leveluser]=='admin'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM surat_keluar WHERE judul LIKE '%$_GET[kata]%'"));
    }
    else{
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM surat_keluar WHERE username='$_SESSION[namauser]' AND judul LIKE '%$_GET[kata]%'"));
    }  

echo "<div class=\"pagination\"> $linkHalaman</div>";
  }
    }
	}
 elseif ($_SESSION[leveluser]=='pegawai'){        

     $tampil_surat_keluar = mysql_query("SELECT * FROM surat_keluar ORDER BY tgl_surat DESC");
        $cek_surat_keluar = mysql_num_rows($tampil_surat_keluar);
        if(!empty($cek_surat_keluar)){
        echo "<h2>Manajemen Surat Keluar</h2><hr>
          <input class='btn btn-info' type=button value='Surat Keluar' onclick=\"window.location.href='?module=surat_keluar&act=tambahsurat_keluar';\">";
        echo "<br><br><table id='sample-table-2' class='table table-striped table-bordered table-hover'><thead>";
		if (empty($_GET['kata'])){
		echo "

          <tr><th>No</th><th>No Surat</th><th>Judul</th><th>Tanggal Surat</th><th>Kategori</th><th>Rak</th><th>Nama File</th><th>Tgl Entry</th><th>Pembuat</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";
       $no=1;
    while ($r=mysql_fetch_array($tampil_surat_keluar)){
	
      $tgl_posting   = tgl_indo($r[tgl_posting]);
	  $tgl_surat   = tgl_indo($r[tgl_surat]);
       echo "<tr><td>$no</td>
	         <td>$r[no_surat]</td>
             <td>$r[judul]</td>
			 <td>$tgl_surat</td>";
             $kategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$r[id_kategori]'");
             $cek_kategori = mysql_num_rows($kategori);
             if(!empty($cek_kategori)){
             while($k=mysql_fetch_array($kategori)){
                 echo "<td>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pelajaran = mysql_query("SELECT * FROM rak WHERE id_rak = '$r[id_rak]'");
             
             $cek_pelajaran = mysql_num_rows($pelajaran);
             if(!empty($cek_pelajaran)){
             while($p=mysql_fetch_array($pelajaran)){
                echo "<td>$p[nama]</td>";

             }
             }else{
                 echo"<td></td>";
             }

             echo "<td><a href='../downlot.php?file=$r[nama_file]'>$r[nama_file]</a></td>
             <td>$tgl_posting</td>";
             $pelajaran2 = mysql_query("SELECT * FROM rak WHERE id_rak = '$r[id_rak]'");
             $p2 = mysql_fetch_array($pelajaran2);
             $pegawai2 = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$p2[id_pegawai]'");
             $cek_pegawai2 = mysql_num_rows($pegawai2);
             if(!empty($cek_pegawai2)){
                 while ($p3= mysql_fetch_array($pegawai2)){
                 echo "<td>$p3[nama_lengkap]</td>";
             }
             }else{
                 echo "<td>$r[pembuat]</td>";
             }
             echo"
			 <td>$r[deskripsi]</td>
             <td><a href='?module=surat_keluar&act=editsurat_keluar&id=$r[id_file]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a><a href=javascript:confirmdelete('$aksi?module=surat_keluar&act=hapus&id=$r[id_file]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
    }
    echo "</table>";
 
    }

	else{
	
	echo "<div class='right'><form method=get action='$_SERVER[PHP_SELF]'>
          <input type=hidden name=module value=surat_keluar>
          Cari Judul : <input type=text name='kata' size=60> <input type=submit value=Cari>
          </form></div>";
	
    echo "<tr><th>No</th><th>No Surat</th><th>Judul</th><th>Tanggal Surat</th><th>Kategori</th><th>Rak</th><th>Nama File</th><th>Tgl Entry</th><th>Pembuat</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";


    if ($_SESSION[leveluser]=='pegawai'){
      $tampil = mysql_query("SELECT * FROM surat_keluar WHERE judul LIKE '%$_GET[kata]%' ORDER BY tgl_surat DESC");
    }

  else{
      $tampil=mysql_query("SELECT * FROM surat_keluar 
                           WHERE username='$_SESSION[namauser]'
                           AND judul LIKE '%$_GET[kata]%'       
                           ORDER BY tgl_surat");
    }
    $no = 1;
    while($r=mysql_fetch_array($tampil)){
      $tgl_posting   = tgl_indo($r[tgl_posting]);
	  $tgl_surat   = tgl_indo($r[tgl_surat]);
      echo "<tr><td>$no</td>
	         <td>$r[no_surat]</td>
             <td>$r[judul]</td>
			 <td>$tgl_surat</td>";
             $kategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$r[id_kategori]'");
             $cek_kategori = mysql_num_rows($kategori);
             if(!empty($cek_kategori)){
             while($k=mysql_fetch_array($kategori)){
                 echo "<td><a href=?module=kategori&act=detailkategori&id=$r[id_kategori] title='Detail Kategori'>$k[nama]</td>";
             }
             }else{
                 echo"<td></td>";
             }
             $pelajaran = mysql_query("SELECT * FROM rak WHERE id_rak = '$r[id_rak]'");
             
             $cek_pelajaran = mysql_num_rows($pelajaran);
             if(!empty($cek_pelajaran)){
             while($p=mysql_fetch_array($pelajaran)){
                echo "<td><a href=?module=rak&act=detailpelajaran&id=$r[id_rak] title='Detail pelajaran'>$p[nama]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }

             echo "<td><a href='downlot.php?file=$r[nama_file]'>$r[nama_file]</a></td>
             <td>$tgl_posting</td>";
             $pelajaran2 = mysql_query("SELECT * FROM rak WHERE id_rak = '$r[id_rak]'");
             $p2 = mysql_fetch_array($pelajaran2);
             $pegawai2 = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$p2[id_pegawai]'");
             $cek_pegawai2 = mysql_num_rows($pegawai2);
             if(!empty($cek_pegawai2)){
                 while ($p3= mysql_fetch_array($pegawai2)){
                 echo "<td>$p3[nama_lengkap]</td>";
             }
             }else{
                 echo "<td>$r[pembuat]</td>";
             }
             echo"
			 <td>$r[deskripsi]</td>
             <td><a href='?module=surat_keluar&act=editsurat_keluar&id=$r[id_file]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a><a href=javascript:confirmdelete('$aksi?module=surat_keluar&act=hapus&id=$r[id_file]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
      $no++;
    }
    echo "</table>";

    if ($_SESSION[leveluser]=='pegawai'){
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM surat_keluar WHERE judul LIKE '%$_GET[kata]%'"));
    }
    else{
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM surat_keluar WHERE username='$_SESSION[namauser]' AND judul LIKE '%$_GET[kata]%'"));
    }  

echo "<div class=\"pagination\"> $linkHalaman</div>";
  }
    }
	}
    
    else{
        echo"<br><b class='judul'>Materi</b><br><p class='garisbawah'></p>";

        $ambil_siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_SESSION[idsiswa]'");
        $data_siswa = mysql_fetch_array($ambil_siswa);

        $mapel = mysql_query("SELECT * FROM rak WHERE id_kategori = '$data_siswa[id_kategori]'");
       echo "<table>
          <tr><th>No</th><th>Mata Rak</th><th>Materi</th></tr>";
        $no=1;
        while ($r=mysql_fetch_array($mapel)){
        echo "<tr><td>$no</td>
             <td>$r[nama]</td>";
             echo "<td><input type=button class='tombol' value='Lihat File Materi'
                       onclick=\"window.location.href='?module=surat_keluar&act=daftarsurat_keluar&id=$r[id_rak]';\"></td></tr>";
        $no++;
        }
        echo "</table>";


    }
    break;

case "tambahsurat_keluar":
    if ($_SESSION[leveluser]=='admin'){
    echo "<form name='form_surat_keluar' method=POST action='$aksi?module=surat_keluar&act=input_surat_keluar' enctype='multipart/form-data'>
     <fieldset>
     <legend>Surat Keluar</legend>
     <dl class='inline'>
	 <dt><label>No Surat</label></dt>          <dd><input type=text name='no_surat' size=50></dd>
    <dt><label>Judul</label></dt>              <dd><input type=text name='judul' size=50></dd>
	<dt><label>Tanggal Surat</label></dt><dd>  ";
          combotgl(1,31,'tgl',$tgl_skrg);
          combonamabln(1,12,'bln',$bln_sekarang);
          combothn(1950,$thn_sekarang,'thn',$thn_sekarang);

    echo "</dd>
	<dt><label>Jumlah Lampiran</label></dt>    <dd><input type=text name='lampiran' size=20></dd>
	<dt><label>Pengirim</label></dt>              <dd><input type=text name='pengirim' size=50></dd>
    <dt><label>Jenis Surat</label></dt>              <dd><select name='id_kategori' onChange='showpel()'>
                                          <option value=''>-pilih-</option>";                                          
                                          $cari_kategori = mysql_query("SELECT * FROM kategori ORDER BY nama");
                                          while ($k=mysql_fetch_array($cari_kategori)){
                                          echo"<option value='".$k[id_kategori]."'>".$k[nama]."</option>";
                                          }                                          
                                          echo"</select></dd>
    <dt><label>Rak</label></dt>          <dd><div id='pelajaran'></div></dd>
    <dt><label>File</label></dt>               <dd><input type=file name='fupload' size=40></dd>
	 <dt><label>Deskripsi</label></dt>             <dd>: <textarea name='deskripsi' id='wysiwyg' class='medium' rows='6'></textarea>
    </dl>
          
          <p align=center><input class='btn btn-info' type=submit value=Simpan>
          <input class='btn btn-info' type=button value=Batal onclick=self.history.back()></p>
          
          </fieldset></form>";
    }else{
    echo "
    <form name='form_surat_keluar_pegawai' method=POST action='$aksi?module=surat_keluar&act=input_surat_keluar' enctype='multipart/form-data'>
    <fieldset>
    <legend>Surat Keluar</legend>
    <dl class='inline'>
	<dt><label>No Surat</label></dt>              <dd> <input type=text name='no_surat' size=50></dd>
    <dt><label>Judul</label></dt>              <dd> <input type=text name='judul' size=50></dd>
	<dt><label>Tanggal Surat</label></dt><dd>  ";
          combotgl(1,31,'tgl',$tgl_skrg);
          combonamabln(1,12,'bln',$bln_sekarang);
          combothn(1950,$thn_sekarang,'thn',$thn_sekarang);

    echo "</dd>
	<dt><label>Jumlah Lampiran</label></dt>              <dd><input type=text name='lampiran' size=5></dd>
	<dt><label>Pengirim</label></dt>              <dd><input type=text name='pengirim' size=50></dd>
    <dt><label>Jenis Surat</label></dt>              <dd> <select name='id_kategori' onChange='showpel_pegawai()'>
                                          <option value='0' selected>-pilih-</option>";
                                          
										  
										  
                                          $cari_kategori = mysql_query("SELECT * FROM kategori ORDER BY nama");
                                          while ($k=mysql_fetch_array($cari_kategori)){
                                          echo"<option value='".$k[id_kategori]."'>".$k[nama]."</option>";
                                          }
                                          
                                          echo"</select></dd>
    <dt><label>Rak</label></dt>          <dd> <div id='pelajaran_pegawai'></div></dd>
    <dt><label>File</label></dt>              <dd> <input type=file name='fupload' size=35></dd>
	<dt><label>Deskripsi</label></dt>             <dd>: <textarea name='deskripsi' id='wysiwyg' class='medium' rows='6'></textarea>
    <p align=center><input class='btn btn-info' type=submit value=Simpan>
                      <input class='btn btn-info' type=button value=Batal onclick=\"window.location.href='?module=surat_keluar';\"></p>
    </dl></fieldset></form>";
    }
    break;

case "editsurat_keluar":
    if ($_SESSION[leveluser]=='admin'){
    $edit=mysql_query("SELECT * FROM surat_keluar WHERE id_file = '$_GET[id]'");
    $m=mysql_fetch_array($edit);
    $isikategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$m[id_kategori]'");
    $k=mysql_fetch_array($isikategori);
    $pelajaran = mysql_query("SELECT * FROM rak WHERE id_rak = '$m[id_rak]'");
    $p=mysql_fetch_array($pelajaran);

    echo "
    <form name='form_surat_keluar' method=POST action='$aksi?module=surat_keluar&act=edit_surat_keluar' enctype='multipart/form-data'>
    <input type=hidden name=id value='$m[id_file]'>
    <fieldset>
     <legend>Edit Surat Keluar</legend>
     <dl class='inline'>
	 <dt><label>No Surat</label></dt>              <dd>: <input type=text name='no_surat' value='$m[no_surat]' size=50></dd>
    <dt><label>Judul</label></dt>             <dd>: <input type=text name='judul' value='$m[judul]'></dd>
	 <dt><label>Tanggal Surat</label></dt><dd> : ";
          $get_tgl=substr("$r[tgl_surat]",8,2);
          combotgl(1,31,'tgl',$get_tgl);
          $get_bln=substr("$r[tgl_surat]",5,2);
          combonamabln(1,12,'bln',$get_bln);
          $get_thn=substr("$r[tgl_surat]",0,4);
          combothn(1950,$thn_sekarang,'thn',$get_thn);

    echo "</dd>
	<dt><label>Jumlah Lampiran</label></dt>             <dd>: <input type=text name='lampiran' value='$m[lampiran]'></dd>
	<dt><label>Pengirim</label></dt>             <dd>: <input type=text name='pengirim' value='$m[pengirim]'></dd>
    <dt><label>Jenis Surat</label></dt>               <dd>: <select name='id_kategori' onChange='showpel()'>
                                          <option value='".$k[id_kategori]."' selected>".$k[nama]."</option>";
                                          $pilih="SELECT * FROM kategori ORDER BY nama";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kategori]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></dd>
    <dt><label>Rak</label></dt>           <dd>: <select id='pelajaran' name='id_rak'>
                                          <option value='".$p[id_rak]."' selected>".$p[nama]."</option>
                                          </select></dd>
    <dt><label>File</label></dt>                <dd>: $m[nama_file]</dd>
    <dt><label>Ganti File</label></dt>         <dd>: <input type=file name='fupload' size=40>
                                                     <small>Apabila file tidak diganti, di kosongkan saja</small></dd>
	<dt><label>Deskripsi</label></dt>             <dd>: <textarea name='deskripsi' id='wysiwyg' class='medium' rows='6'>$m[deskripsi]</textarea>
    </dl>

          <p align=center><input class='btn btn-info' type=submit value=Update>
          <input class='btn btn-info' type=button value=Batal onclick=self.history.back()></p>

          </fieldset></form>";
    }
    else{
    $edit=mysql_query("SELECT * FROM surat_keluar WHERE id_file = '$_GET[id]'");
    $m=mysql_fetch_array($edit);
    $isikategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$m[id_kategori]'");
    $k=mysql_fetch_array($isikategori);
    $pelajaran = mysql_query("SELECT * FROM rak WHERE id_rak = '$m[id_rak]'");
    $p=mysql_fetch_array($pelajaran);

    echo "<form name='form_surat_keluar_pegawai' method=POST action='$aksi?module=surat_keluar&act=edit_surat_keluar' enctype='multipart/form-data'>
    <input type=hidden name=id value='$m[id_file]'>
    <fieldset>
    <legend>Edit Surat Keluar</legend>
    <dl class='inline'>
	<dt><label>No Surat</label></dt>              <dd>: <input type=text name='no_surat' value='$m[no_surat]' size=50></dd>
    <dt><label>Judul</label></dt>              <dd>: <input type=text name='judul' value='$m[judul]' size=50></dd>
	<dt><label>Tanggal Lahir</label></dt><dd> : ";
          $get_tgl=substr("$r[tgl_surat]",8,2);
          combotgl(1,31,'tgl',$get_tgl);
          $get_bln=substr("$r[tgl_surat]",5,2);
          combonamabln(1,12,'bln',$get_bln);
          $get_thn=substr("$r[tgl_surat]",0,4);
          combothn(1950,$thn_sekarang,'thn',$get_thn);

    echo "</dd>;
	<dt><label>Jumlah Lampiran</label></dt>             <dd>: <input type=text name='lampiran' value='$m[lampiran]'></dd>
	<dt><label>Pengirim</label></dt>             <dd>: <input type=text name='pengirim' value='$m[pengirim]'></dd>
    <dt><label>Kategori</label></dt>              <dd>: <select name='id_kategori' onChange='showpel_pegawai()'>
                                          <option value='".$k[id_kategori]."' selected>".$k[nama]."</option>";
                                          $pilih="SELECT * FROM kategori WHERE id_pegawai = '$_SESSION[idpegawai]'";
                                          $query=mysql_query($pilih);
                                          while($row=mysql_fetch_array($query)){
                                          echo"<option value='".$row[id_kategori]."'>".$row[nama]."</option>";
                                          }
                                          echo"</select></dd>
    <dt><label>Rak</label></dt>          <dd>: <select id='pelajaran_pegawai' name='id_rak'>
                                          <option value='".$p[id_rak]."' selected>".$p[nama]."</option>
                                          </select></dd>
    <dt><label>File</label></dt>              <dd>: $m[nama_file]</dd>
    <dt><label>Ganti File</label></dt>        <dd>: <input type=file name='fupload' size=40>
	<dt><label>Deskripsi</label></dt>             <dd>: <textarea name='deskripsi' id='wysiwyg' class='medium' rows='6'>$m[deskripsi]</textarea>
    <small>Apabila file tidak diganti, di kosongkan saja</small></dd>
    <p align=center><input class='btn btn-info' type=submit value=Simpan>
                      <input class='btn btn-info' type=button value=Batal onclick=self.history.back()></p>
    </dl></fieldset></form>";
    }
    break;

}
}
?>
