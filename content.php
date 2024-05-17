<?php
// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
  echo "<br><b class='judul'>Hai $_SESSION[namalengkap]</b><br><p class='garisbawah'></p>
        Selamat datang di <b>Web Jurnal</b>.<br><br>
		Hubungi kami : <br>
		Telp : 022 123456<br>
		email : ada@gmail.com<br>
		Kampus ABC, Jalan Kemerdekaan nomor 46 Bandung.
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>

  <p class='garisbawah'></p><p align='right'><b class='judul'>Login : $hari_ini, 
  <span id='date'></span>, <span id='clock'></span></p>";
  }
}
// Bagian kategori
elseif ($_GET['module']=='kategori'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_kategori/kategori.php";
  }
}

// Bagian siswa
elseif ($_GET['module']=='siswa'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_siswa/siswa.php";
  }
}

// Bagian admin
elseif ($_GET['module']=='admin'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_admin/admin.php";
  }
}

// Bagian mapel
elseif ($_GET['module']=='rak'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_rak/rak.php";
  }
}

// Bagian surat_masuk
elseif ($_GET['module']=='surat_masuk'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_surat_masuk/surat_masuk.php";
  }
}

// Bagian surat_masuk
elseif ($_GET['module']=='surat_keluar'){
  if ($_SESSION['leveluser']=='admin'){
      include "administrator/modul/mod_surat_keluar/surat_keluar.php";
  }
}


// Bagian surat_masuk
elseif ($_GET['module']=='quiz'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_quiz/quiz.php";
  }
}

// Bagian surat_masuk
elseif ($_GET['module']=='kerjakan_quiz'){
  if ($_SESSION['leveluser']=='siswa'){
      include "administrator/modul/mod_quiz/soal.php";
  }
}

// Bagian surat_masuk
elseif ($_GET['module']=='nilai'){
  if ($_SESSION['leveluser']=='siswa'){
      include "daftarnilai.php";
  }
}
?>
