<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";
include "../../../configurasi/library.php";
include "../../../configurasi/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='surat_keluar' AND $act=='input_surat_keluar'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $tipe_file   = $_FILES['fupload']['type'];
  $direktori_file = "../../../files_materi/$nama_file";

  $extensionList = array("zip", "rar", "doc", "docx", "ppt", "pptx", "pdf","jpeg","jpg","xlsx");
  $pecah = explode(".", $nama_file);
  $ekstensi = $pecah[1];

$tgl_surat=$_POST[thn].'-'.$_POST[bln].'-'.$_POST[tgl];

  //cari pembuat
  $pelajaran = mysql_query("SELECT * FROM rak WHERE id_rak = '$_POST[id_rak]'");
  $data_mapel = mysql_fetch_array($pelajaran);
  $pegawai = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$data_mapel[id_pegawai]'");
  $cek_pegawai = mysql_num_rows($pegawai);
  if(!empty($cek_pegawai)){
  // Apabila ada file yang diupload
  if (!empty($lokasi_file)){
  
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=surat_keluar&act=tambahsurat_keluar')</script>";
            }
      elseif (!in_array($ekstensi, $extensionList)){
               
                echo "<script>window.alert('Tipe file tidak diijinkan');
                window.location=('../../media_admin.php?module=surat_keluar&act=tambahsurat_keluar')</script>";
        }
        else{
                    UploadFile($nama_file);
                    mysql_query("INSERT INTO surat_keluar(judul,
                                    id_kategori,
                                    id_rak,
                                    nama_file,
                                    tgl_posting,
                                    pembuat,
									pengirim,
									lampiran,
									deskripsi,
									no_surat,
									tgl_surat)
                            VALUES('$_POST[judul]',
                                   '$_POST[id_kategori]',
                                   '$_POST[id_rak]',
                                   '$nama_file',
                                   '$tgl_sekarang',
                                    '$data_mapel[id_pegawai]',
									'$_POST[pengirim]',
									'$_POST[lampiran]',
									'$_POST[deskripsi]',
									'$_POST[no_surat]',
									'$tgl_surat')");
                    header('location:../../media_admin.php?module='.$module);
            }

    }
  else{
    mysql_query("INSERT INTO surat_keluar(judul,                                    
                                    id_kategori,
                                    id_rak,
                                    tgl_posting,
                                    pembuat,
									pengirim,
									lampiran,
									deskripsi,
									no_surat,
									tgl_surat)
                            VALUES('$_POST[judul]',                                   
                                   '$_POST[id_kategori]',
                                   '$_POST[id_rak]',
                                   '$tgl_sekarang',
                                    '$data_mapel[id_pegawai]',
									'$_POST[pengirim]',
									'$_POST[lampiran]',
									'$_POST[deskripsi]',
									'$_POST[no_surat]',
									'$tgl_surat')");
  header('location:../../media_admin.php?module='.$module);
  }
  }else{
      // Apabila ada file yang diupload
  if (!empty($lokasi_file)){

      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=surat_keluar&act=tambahsurat_keluar')</script>";
            }
      elseif (!in_array($ekstensi, $extensionList)){

                echo "<script>window.alert('Tipe file tidak diijinkan');
                window.location=('../../media_admin.php?module=surat_keluar&act=tambahsurat_keluar')</script>";
        }
        else{
                    UploadFile($nama_file);
                    mysql_query("INSERT INTO surat_keluar(judul,
                                    id_kategori,
                                    id_rak,
                                    nama_file,
                                    tgl_posting,
                                    pembuat,
									pengirim,
									lampiran,
									deskripsi,
									no_surat,
									tgl_surat)
                            VALUES('$_POST[judul]',
                                   '$_POST[id_kategori]',
                                   '$_POST[id_rak]',
                                   '$nama_file',
                                   '$tgl_sekarang',
                                   '$_SESSION[leveluser]',
								   '$_POST[pengirim]',
									'$_POST[lampiran]',
									'$_POST[deskripsi]',
									'$_POST[no_surat]',
									'$tgl_surat')");
                    header('location:../../media_admin.php?module='.$module);
            }

    }
  else{
    mysql_query("INSERT INTO surat_keluar(judul,
                                    id_kategori,
                                    id_rak,
                                    tgl_posting,
                                    pembuat,
									pengirim,
									lampiran,
									deskripsi,
									no_surat,
									tgl_surat)
                            VALUES('$_POST[judul]',
                                   '$_POST[id_kategori]',
                                   '$_POST[id_rak]',
                                   '$tgl_sekarang',
                                   '$_SESSION[leveluser]',
								   '$_POST[pengirim]',
									'$_POST[lampiran]',
									'$_POST[deskripsi]',
									'$_POST[no_surat]',
									'$tgl_surat')");
  header('location:../../media_admin.php?module='.$module);
  }
}
}

elseif($module=='surat_keluar' AND $act=='edit_surat_keluar'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $tipe_file   = $_FILES['fupload']['type'];
  $direktori_file = "../../../files_materi/$nama_file";

  $extensionList = array("zip", "rar", "doc", "docx", "ppt", "pptx", "pdf","jpeg","jpg","xlsx");
  $pecah = explode(".", $nama_file);
  $ekstensi = $pecah[1];

$tgl_surat=$_POST[thn].'-'.$_POST[bln].'-'.$_POST[tgl];

  //cari pembuat
  $pelajaran = mysql_query("SELECT * FROM rak WHERE id_rak = '$_POST[id_rak]'");
  $data_mapel = mysql_fetch_array($pelajaran);
  $pegawai = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$data_mapel[id_pegawai]'");
  $cek_pegawai = mysql_num_rows($pegawai);
  if(!empty($cek_pegawai)){
  // Apabila ada file yang diupload
  if (!empty($lokasi_file)){

    if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=surat_keluar')</script>";}
            else{
                if(!in_array($ekstensi, $extensionList)){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=surat_keluar')</script>";
                }else{
                    $cek = mysql_query("SELECT * FROM surat_keluar WHERE id_file = '$_POST[id]'");
                    $r = mysql_fetch_array($cek);
                    if(!empty($r[nama_file])){
                    $file = "../../../files_materi/$r[nama_file]";
                    unlink($file);

                    UploadFile($nama_file);
                    mysql_query("UPDATE surat_keluar SET judul = '$_POST[judul]',
                                    id_kategori = '$_POST[id_kategori]',
                                    id_rak = '$_POST[id_rak]',
                                    nama_file = '$nama_file',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$data_mapel[id_pegawai]',
									pengirim = '$_POST[pengirim]',
									lampiran = '$_POST[lampiran]',
									deskripsi = '$_POST[deskripsi]',
									no_surat = '$_POST[no_surat]',
									tgl_surat = '$tgl_surat'
                            WHERE id_file = '$_POST[id]'");
                    header('location:../../media_admin.php?module='.$module);
                    }else{
                        UploadFile($nama_file);
                        mysql_query("UPDATE surat_keluar SET judul = '$_POST[judul]',
                                    id_kategori = '$_POST[id_kategori]',
                                    id_rak = '$_POST[id_rak]',
                                    nama_file = '$nama_file',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$data_mapel[id_pegawai]',
									pengirim = '$_POST[pengirim]',
									lampiran = '$_POST[lampiran]',
									deskripsi = '$_POST[deskripsi]',
									no_surat = '$_POST[no_surat]',
									tgl_surat = '$tgl_surat'
                            WHERE id_file = '$_POST[id]'");
                        header('location:../../media_admin.php?module='.$module);
                    }
                }

    }

  }
  else{
    mysql_query("UPDATE surat_keluar SET judul = '$_POST[judul]',
                                    id_kategori = '$_POST[id_kategori]',
                                    id_rak = '$_POST[id_rak]',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$data_mapel[id_pegawai]',
									pengirim = '$_POST[pengirim]',
									lampiran = '$_POST[lampiran]',
									deskripsi = '$_POST[deskripsi]',
									no_surat = '$_POST[no_surat]',
									tgl_surat = '$tgl_surat'
                            WHERE id_file = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
  }
  }else{
        // Apabila ada file yang diupload
  if (!empty($lokasi_file)){

    if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file sudah ada, mohon diganti dulu');
            window.location=(href='../../media_admin.php?module=surat_keluar')</script>";}
            else{
                if(!in_array($ekstensi, $extensionList)){
                    echo "<script>window.alert('Tipe File tidak di ijinkan.');
                    window.location=(href='../../media_admin.php?module=surat_keluar')</script>";
                }else{
                    $cek = mysql_query("SELECT * FROM surat_keluar WHERE id_file = '$_POST[id]'");
                    $r = mysql_fetch_array($cek);
                    if(!empty($r[nama_file])){
                    $file = "../../../files_materi/$r[nama_file]";
                    unlink($file);

                    UploadFile($nama_file);
                    mysql_query("UPDATE surat_keluar SET judul = '$_POST[judul]',
                                    id_kategori = '$_POST[id_kategori]',
                                    id_rak = '$_POST[id_rak]',
                                    nama_file = '$nama_file',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$_SESSION[leveluser]',
									pengirim = '$_POST[pengirim]',
									lampiran = '$_POST[lampiran]',
									deskripsi = '$_POST[deskripsi]',
									no_surat = '$_POST[no_surat]',
									tgl_surat = '$tgl_surat'
                            WHERE id_file = '$_POST[id]'");
                    header('location:../../media_admin.php?module='.$module);
                    }else{
                        UploadFile($nama_file);
                        mysql_query("UPDATE surat_keluar SET judul = '$_POST[judul]',
                                    id_kategori = '$_POST[id_kategori]',
                                    id_rak = '$_POST[id_rak]',
                                    nama_file = '$nama_file',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$_SESSION[leveluser]',
									pengirim = '$_POST[pengirim]',
									lampiran = '$_POST[lampiran]',
									deskripsi = '$_POST[deskripsi]',
									no_surat = '$_POST[no_surat]',
									tgl_surat = '$tgl_surat'
                            WHERE id_file = '$_POST[id]'");
                        header('location:../../media_admin.php?module='.$module);
                    }
                }

    }

  }
  else{
    mysql_query("UPDATE surat_keluar SET judul = '$_POST[judul]',
                                    id_kategori = '$_POST[id_kategori]',
                                    id_rak = '$_POST[id_rak]',
                                    tgl_posting = '$tgl_sekarang',
                                    pembuat = '$_SESSION[leveluser]',
									pengirim = '$_POST[pengirim]',
									lampiran = '$_POST[lampiran]',
									deskripsi = '$_POST[deskripsi]',
									no_surat = '$_POST[no_surat]',
									tgl_surat = '$tgl_surat'							
                            WHERE id_file = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
  }

  }
}


elseif($module=='surat_keluar' AND $act=='hapus'){
  $cek = mysql_query("SELECT * FROM surat_keluar WHERE id_file = '$_GET[id]'");
                    $r = mysql_fetch_array($cek);
                    if(!empty($r[nama_file])){
                    $file = "../../../files_materi/$r[nama_file]";
                    unlink($file);
                    
                    mysql_query("DELETE FROM surat_keluar WHERE id_file = '$_GET[id]'");
                    }
                    else{
                        mysql_query("DELETE FROM surat_keluar WHERE id_file = '$_GET[id]'");
                    }
  header('location:../../media_admin.php?module='.$module);

}
}
?>
