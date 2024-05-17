<html>
<head>
</head>
<body onLoad="document.postform.elements['judul'].focus();">

<?php

//untuk koneksi database
include "koneksi.php";
	
//untuk menantukan tanggal awal dan tanggal akhir data di database
$min_tanggal=mysql_fetch_array(mysql_query("select min(tgl_posting) as min_tanggal from surat_masuk"));
$max_tanggal=mysql_fetch_array(mysql_query("select max(tgl_posting) as max_tanggal from surat_masuk"));
?>

<form action="modul/mod_laporan/laporank.php" method="post" name="postform">
<table width="435" border="0">
<tr>
    <td width="111">Nama Nasabah</td>
    <td colspan="2"><input type="text" name="judul" value="<?php if(isset($_POST['judul'])){ echo $_POST['judul']; }?>"/></td>
</tr>
<tr>
    <td>Tanggal Awal</td>
    <td colspan="2"><input type="text" name="tanggal_awal" size="15" value="<?php echo $min_tanggal['min_tanggal'];?>"/>
    <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_awal);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>				
    </td>
</tr>
<tr>
    <td>Tanggal Akhir</td>
    <td colspan="2"><input type="text" name="tanggal_akhir" size="15" value="<?php echo $max_tanggal['max_tanggal'];?>"/>
    <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_akhir);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>				
    </td>
</tr>
<tr>
    <td><input type="submit" value="Tampilkan Data" name="cari"></td>
    <td colspan="2">&nbsp;</td>
</tr>
</table>
</form>
<p>

<?php
//di proses jika sudah klik tombol cari
session_start();

 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
if(isset($_POST['cari'])){
	
	//menangkap nilai form
	$judul=$_POST['judul'];
	$tanggal_awal=$_POST['tanggal_awal'];
	$tanggal_akhir=$_POST['tanggal_akhir'];
	
	if(empty($judul) and empty($tanggal_awal) and empty($tanggal_akhir)){
		//jika tidak menginput apa2
		$query=mysql_query("select * from surat_masuk");
		$jumlah=mysql_fetch_array(mysql_query("select sum(uang) as total from tabel_nasabah"));
		
	}else{
		
		?><i><b>Informasi : </b> Pencarian nama nasabah <b><?php echo ucwords($_POST['judul']);?></b> dari tanggal <b><?php echo $_POST['tanggal_awal']?></b> sampai dengan tanggal <b><?php echo $_POST['tanggal_akhir']?></b></i><?php
		
		$query=mysql_query("select * from surat_masuk where judul like '%$judul%' and tgl_posting between '$tanggal_awal' and '$tanggal_akhir'");
		
	}
	
	?>
</p>

<table class="datatable">
	<tr>
    	<th width="34">No</th>
    	<th width="90">Tanggal</th>
    	<th width="131">Nama Nasabah</th>
    	<th width="104">&nbsp;</th>
    </tr>
	<?php
	//untuk penomoran data
	$no=0;
	
	//menampilkan data
	while($row=mysql_fetch_array($query)){
	?>
    <tr>
    	<td><?php echo $no=$no+1; ?></td><td><?php echo $row['tgl_posting']; ?></td><td><?php echo $row['judul'];?></td><td align="right">&nbsp;</td>
    </tr>
    <?php
	}
	?>
    
    <tr>
    	<td colspan="4" align="center"> 
		<?php
		//jika data tidak ditemukan
		if(mysql_num_rows($query)==0){
			echo "<font color=red><blink>Tidak ada data yang dicari!</blink></font>";
		}
		?>        </td>
    </tr>
</table>


<?php
}else{
	unset($_POST['cari']);
}
}
?>

<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
</body>
</html>