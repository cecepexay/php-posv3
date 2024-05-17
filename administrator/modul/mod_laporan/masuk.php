<?php
error_reporting(0);
// MUKHLISIN

include ('class.ezpdf.php');
  
$pdf = new Cezpdf();
 
// Set margin dan font
$pdf->ezSetCmMargins(3, 3, 3, 3);
$pdf->selectFont('fonts/Courier.afm');

$all = $pdf->openObject();

// Tampilkan logo
$pdf->setStrokeColor(0, 0, 0, 1);
$pdf->addJpegFromFile('logo.jpg',20,800,69);

// Teks di tengah atas untuk judul header
$pdf->addText(350, 550, 16,'<b>Laporan Surat Masuk</b>');

// Garis atas untuk header
$pdf->line(10, 795, 578, 795);

// Garis bawah untuk footer
$pdf->line(10, 50, 830, 50);
// Teks kiri bawah
$pdf->addText(30,34,8,'Dicetak tgl:' . date( 'd-m-Y, H:i:s') . '                                                                                                         Support by MUKHLISIN') ;

$pdf->closeObject();

// Tampilkan object di semua halaman
$pdf->addObject($all, 'all');

// Baca input tanggal yang dikirimkan user
$mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
$selesai=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];

// Koneksi ke database dan tampilkan datanya

include "../../../configurasi/koneksi.php";

// Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$sql = mysql_query("select * from surat_masuk where tgl_surat BETWEEN '$mulai' AND '$selesai' order by tgl_surat");
$jml = mysql_num_rows($sql);
if ($jml > 1){
$i = 1;
while($r = mysql_fetch_array($sql)){

$kategori = mysql_query("SELECT * FROM kategori WHERE id_kategori = '$r[id_kategori]'");
             $cek_kategori = mysql_num_rows($kategori);
             if(!empty($cek_kategori)){
             while($k=mysql_fetch_array($kategori)){
			 
$pelajaran = mysql_query("SELECT * FROM rak WHERE id_rak = '$r[id_rak]'");
             $cek_pelajaran = mysql_num_rows($pelajaran);
             if(!empty($cek_pelajaran)){
             while($p=mysql_fetch_array($pelajaran)){
			 
$pelajaran2 = mysql_query("SELECT * FROM rak WHERE id_rak = '$r[id_rak]'");
             $p2 = mysql_fetch_array($pelajaran2);
             $pegawai2 = mysql_query("SELECT * FROM pegawai WHERE id_pegawai = '$p2[id_pegawai]'");
             $cek_pegawai2 = mysql_num_rows($pegawai2);
             if(!empty($cek_pegawai2)){
                 while ($p3= mysql_fetch_array($pegawai2)){			 

  $data[$i]=array('<b>No</b>'=>$i, 
  				  '<b>No Surat</b>'=>$r[no_surat], 
                  '<b>Judul</b>'=>$r[judul], 
                  '<b>Tanggal Surat</b>'=>$r[tgl_surat], 
                  '<b>Nama File</b>'=>$r[nama_file], 
                  '<b>Kategori</b>'=>$k[nama], 
				  '<b>Rak</b>'=>$p[nama], 
				  '<b>Pembuat</b>'=>$p3[nama_lengkap],
                  '<b>lampiran</b>'=>$r[lampiran]);
	
  $i++;
}
}
}
}
}
}
}
$pdf->ezTable($data, '', '', '');


// Penomoran halaman
$pdf->ezStartPageNumbers(320, 15, 8);
$pdf->ezStream();

}
else{
  
$m=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
$s=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];
  
  echo "Tidak ada data surat masuk pada tanggal $m s/d $s";
}
?>
