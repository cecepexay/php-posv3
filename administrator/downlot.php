<?php
include "../../../configurasi/koneksi.php";

$direktori = "../../../files_materi/"; // folder tempat penyimpanan file yang boleh didownload
$id_file = $_GET['file'];

$query = "select * from surat_keluar where id_file = $id_file";
$hasil = mysql_query ($query);
$data = mysql_fetch_array($hasil);

$file_extension = strtolower(substr(strrchr($filename,"."),1));

switch($file_extension){
  case "pdf": $ctype="application/pdf"; break;
  case "exe": $ctype="application/octet-stream"; break;
  case "zip": $ctype="application/zip"; break;
  case "docx": $ctype="application/docx"; break;
  case "rar": $ctype="application/rar"; break;
  case "doc": $ctype="application/msword"; break;
  case "doc": $ctype="application/msword"; break;
  case "xls": $ctype="application/vnd.ms-excel"; break;
  case "xlsx": $ctype="application/vnd.ms-excel"; break;
  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
  case "gif": $ctype="image/gif"; break;
  case "png": $ctype="image/png"; break;
  case "jpeg":
  case "jpg": $ctype="image/jpg"; break;
  default: $ctype="application/proses";
}

if ($file_extension=='php'){
  echo "<h1>Access forbidden!</h1>
        <p>Maaf, file yang Anda download sudah tidak tersedia atau filenya (direktorinya) telah diproteksi. <br />
        Silahkan hubungi <a href='mailto:investasi.saya@gmail.com'>webmaster</a>.</p>";
  exit;
}
else{
  header("Content-Type: octet/stream");
  header("Pragma: private"); 
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false); 
  header("Content-Type: $ctype");
  header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
  header("Content-Transfer-Encoding: binary");
  header("Content-Length: ".filesize($direktori.$filename));
  readfile("$direktori$filename");
  exit();   
}
?>
