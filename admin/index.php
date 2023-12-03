<?php require_once "header.php"; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Dashboard</h5>

              <p>Tahun 1968 perusahaan milik pemerintah (PT PP Berdikari) mengambil alih kepemilikan PT Asuransi Timur Jauh (sebuah perusahaan swasta 
                yang berdiri tahun 1953). Semenjak itu, Perusahaan ini menjadi salah satu anak perusahaan PT PP Berdikari. Sesuai Peraturan Pemerintah 
                No. 22/2000 sejak tanggal 7 April 2000 PT PP Berdikari menjadi Badan Usaha Milik Negara (BUMN) dan secara resmi berubah nama menjadi 
                PT Berdikari (Persero) dan sebagai pemegang saham tunggal PT Berdikari Insurance. Sejak tahun 1972 hingga kini, PT Berdikari Insurance
                telah banyak mengalami perubahan dalam berbagai kebijakannya dan saat ini tengah berupaya melakukan pengembangan yang agresif dalam 
                mencapai pertumbuhan potensial, dinamis dan juga tingkat profesionalisme yang lebih baik untuk mengantisipasi terhadap era globalisasi.
                Saat ini PT Berdikari Insurance mempunyai 17 (tujuh belas) Kantor Cabang dan 1 (satu) Kantor Unit Pemasaran yang tersebar di seluruh
                Indonesia. Keberadaan cabang-cabang ini merupakan bukti komitmen perusahaan untuk melayani nasabah dengan sumber daya optimum yang 
                tersedia.

              </p>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php require_once "footer.php"; 

  if(isset($_POST['simpan'])){
      $simpan = mysqli_query($k, "INSERT INTO pengguna VALUES (NULL, '$_POST[nama]', '$_POST[jabatan]', '$_POST[username]', '$_POST[password]')");

      if($simpan){
          echo "<script>alert('Berhasil Simpan'); document.location = 'pengguna.php'</script>";
      }else{
          echo "<script>alert('Gagal Simpan'); document.location = 'pengguna.php'</script>";
      }

  }elseif(isset($_POST['ubah'])){
      $ubah = mysqli_query($k, "UPDATE pengguna SET nama='$_POST[nama]', jabatan='$_POST[jabatan]', username='$_POST[username]', password='$_POST[password]' WHERE id_pengguna='$_GET[id_pengguna]'");

      if($ubah){
          echo "<script>alert('Berhasil Ubah'); document.location = 'pengguna.php'</script>";
      }else{
          echo "<script>alert('Gagal Ubah'); document.location = 'pengguna.php'</script>";
      }

  }elseif(isset($_GET['hapus'])){
      $hapus = mysqli_query($k, "DELETE FROM pengguna WHERE id_pengguna='$_GET[id_pengguna]'");

      if($hapus){
          echo "<script>alert('Berhasil Hapus'); document.location = 'pengguna.php'</script>";
      }else{
          echo "<script>alert('Gagal Hapus'); document.location = 'pengguna.php'</script>";
      }
      
  }

?>