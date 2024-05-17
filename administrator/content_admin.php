<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
<?php
include "../configurasi/koneksi.php";
include "../configurasi/library.php";
include "../configurasi/fungsi_indotgl.php";
include "../configurasi/fungsi_combobox.php";
include "../configurasi/class_paging.php";


$aksi_kategori="modul/mod_kategori/aksi_kategori.php";
$aksi_mapel="modul/mod_rak/aksi_rak.php";

// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
  echo "<p>Hai <b>$_SESSION[namalengkap]</b>, Selamat datang di halaman Administrator.<br>
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website.</p>";
          ?>
         <h2>Quick Links</h2>
				<section class="icons"> </section>
<table>
		<th colspan=5><center></center></th>
		<tr>
		  <td width=120 align=center><a href=?module=admin&act=pegawai><img src=images/user.png border=none></a></td>
		  <td width=120 align=center><a href=?module=kategori><img src=images/modul.png border=none></a></td>
		  <td width=120 align=center><a href=?module=surat_masuk><img src=images/berita.png border=none></a></td>
		  <td width=120 align=center><a href="index.php?module=berita"><img src="images/berita.png" border="none" /></a><a href=?module=surat_keluar></a></td>
		  <td width=120 align=center><a href=?module=rak><img src=images/jurusan.png border=none></a></td>
    </tr>
		<tr>
		  <th width=120><b>Manajemen Pegawai</b></th>
		  <th width=120><b>Manajemen Kategori</b></th>
		  <th width=120><b>Surat Masuk</b></th>
		  <th width=120><b>Surat Keluar</b></th>
		  <th width=120><b>Manajamen Rak</b></th>
		</tr>

</table>

<?php 
  }
  elseif ($_SESSION['leveluser']=='pegawai'){
  echo "<label><p>Hai <b>$_SESSION[namalengkap]</b>.<br>
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website.</p>";

         
          //detail pegawai
          $detail_pegawai=mysql_query("SELECT * FROM pegawai WHERE id_pegawai='$_SESSION[idpegawai]'");
          $p=mysql_fetch_array($detail_pegawai);
          $tgl_lahir   = tgl_indo($p[tgl_lahir]);
          echo "<form><fieldset>
              <legend>Detail Profil Anda</legend>
              <dl class='inline'><label>
          <table class='table table-striped table-bordered table-hover'>
          <tr><td rowspan='14'>";if ($p[foto]!=''){
              echo "<ul class='photos sortable'>
                    <img src='../foto_pegawai/medium_$p[foto]'>
                    <div class='links'>
                    <a href='../foto_pegawai/medium_$p[foto]' rel='facebox'>View</a>
                    <div>
                    </ul>";
          }echo "</td><td>Nip</td>  <td> : $p[nip]</td><tr>
          <tr><td>Nama Lengkap</td> <td> : $p[nama_lengkap]</td></tr>
          <tr><td>Username</td>     <td> : $p[username_login]</td></tr>
          <tr><td>Alamat</td>       <td> : $p[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $p[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
          if ($p[jenis_kelamin]=='P'){
           echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
            }
            else{
           echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
            }echo"
          <tr><td>Agama</td>        <td> : $p[agama]</td></tr>
          <tr><td>No.Telp/HP</td>   <td> : $p[no_telp]</td></tr>
          <tr><td>E-mail</td>       <td> : $p[email]</td></tr>
          <tr><td>Website</td>      <td> : <a href=http://$p[website] target=_blank>$p[website]</a></td></tr>       
          <tr><td>Jabatan</td>      <td> : $p[jabatan]</td></tr>
          <tr><td>Aksi</td>         <td> : <input class='btn btn-info' type=button value='Edit Profil' onclick=\"window.location.href='?module=admin&act=editpegawai';\"></td></tr>
          </table></dl></fieldset></form>";

       

  
		echo"
                <p>&nbsp;</p>";
 	}
        else{
             echo "<h2>Home</h2>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di Aplikasi Web Surat V3.</p>
          <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d"));
  echo " | ";
  echo date("H:i:s");
  echo " WIB</p>";
        }
}
// Bagian Modul
elseif ($_GET['module']=='modul'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_modul/modul.php";
  }
}
// Bagian user admin
elseif ($_GET['module']=='admin'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_admin/admin.php";
  }else{
      include "modul/mod_admin/admin.php";
  }
}


// Bagian user admin
elseif ($_GET['module']=='detailpegawai'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_admin/admin.php";
  }else{
      include "modul/mod_admin/admin.php";
  }
}

// Bagian kategori
elseif ($_GET['module']=='kategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kategori/kategori.php";
  }
  elseif ($_SESSION['leveluser']=='pegawai'){
      include "modul/mod_kategori/kategori.php";
  }
  elseif ($_SESSION['leveluser']=='siswa'){
      include "modul/mod_kategori/kategori.php";
  }

}


// Bagian siswa
elseif ($_GET['module']=='siswa'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}




// Bagian Laporan Masuk
elseif ($_GET['module']=='laporan_surat_masuk'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_laporan/laporan.php";
  }else{
      include "modul/mod_laporan/laporan.php";
  }
}

// Bagian Laporan Keluar
elseif ($_GET['module']=='laporan_surat_keluar'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_laporan/laporank.php";
  }else{
      include "modul/mod_laporan/laporank.php";
  }
}


// Bagian siswa
elseif ($_GET['module']=='daftarsiswa'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}

// Bagian siswa
elseif ($_GET['module']=='detailsiswa'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}

// Bagian siswa
elseif ($_GET['module']=='detailsiswapegawai'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_siswa/siswa.php";
  }else{
      include "modul/mod_siswa/siswa.php";
  }
}

// Bagian mata pelajaran
elseif ($_GET['module']=='rak'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_rak/rak.php";
  }
  else{
      include "modul/mod_rak/rak.php";
  }
}

// Bagian surat_masuk
elseif ($_GET['module']=='surat_masuk'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_surat_masuk/surat_masuk.php";
  }else{
      include "modul/mod_surat_masuk/surat_masuk.php";
  }
}

// Bagian surat_keluar
elseif ($_GET['module']=='surat_keluar'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_surat_keluar/surat_keluar.php";
  }else{
      include "modul/mod_surat_keluar/surat_keluar.php";
  }
}

// Bagian Templates
elseif ($_GET['module']=='templates'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_templates/templates.php";
  }
}

// Bagian Templates
elseif ($_GET['module']=='registrasi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_registrasi/registrasi.php";
  }
}

// Bagian Info
elseif ($_GET['module']=='info'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_info/info.php";
  }else{
      include "modul/mod_info/info.php";
  }
}

// Bagian Info
elseif ($_GET['module']=='pencarian_keluar'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_pencarian/laporank.php";
  }else{
      include "modul/mod_pencarian/laporank.php";
  }
}


?>
