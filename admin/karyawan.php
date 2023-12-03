<?php require_once "header.php"; 
if (isset($_GET['ubah'])){
  $data = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM karyawan WHERE id_karyawan = '$_GET[id_karyawan]'"));
}
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Calon Karyawan Terbaik</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Form Calon Karyawan Terbaik</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="POST">
                <div class="col-4">
                  <label class="form-label">Nama Karyawan</label>
                  <input type="text" name="nama_calon" class="form-control" value="<?php if(isset($_GET['ubah'])){ echo $data['nama_calon']; } ?>" placeholder="">
                </div>
                <div class="col-4">
                  <label class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-control" required>
                      <option value="">--pilih jenis kelamin--</option>
                      <option value="Laki-laki" <?php if(isset($_GET['ubah'])){ if ($data['jenis_kelamin'] == "Laki-laki"){ echo 'selected'; }} ?>>Laki-laki</option>
                      <option value="Perempuan" <?php if(isset($_GET['ubah'])){ if ($data['jenis_kelamin'] == "Perempuan"){ echo 'selected'; }} ?>>Perempuan</option>
                  </select>
                </div>
                <div class="col-4">
                  <label class="form-label">No HP</label>
                  <input type="text" name="no_hp" class="form-control" value="<?php if(isset($_GET['ubah'])){ echo $data['no_hp']; } ?>" placeholder="">
                </div>
                <div class="col-12">
                  <label class="form-label">Alamat</label>
                  <input type="text" name="alamat" class="form-control" value="<?php if(isset($_GET['ubah'])){ echo $data['alamat']; } ?>" placeholder="">
                </div>
                <div class="text-lef">
                  <button type="submit" name="<?php if(isset($_GET['ubah'])){ echo "ubah"; }else{ echo "simpan"; } ?>" class="btn btn-primary">Simpan</button>
                  <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Karyawan Terbaik</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Nama Calon</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">No HP</th>
                    <th scope="col">Alamat</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $sql = mysqli_query($k, "SELECT * FROM karyawan");
                  while($data = mysqli_fetch_array($sql)){
                  ?>
                  <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <td scope="row">
                      <a href="?ubah&id_karyawan=<?= $data['id_karyawan'] ?>"><button class="btn btn-warning">Ubah</button></a>
                      <a href="?hapus&id_karyawan=<?= $data['id_karyawan'] ?>" onclick="return confirm('Hapus?')"><button class="btn btn-danger">Hapus</button></a>
                    </td>
                    <td scope="row"><?= $data['nama_calon']; ?></td>
                    <td scope="row"><?= $data['jenis_kelamin']; ?></td>
                    <td scope="row"><?= $data['no_hp']; ?></td>
                    <td scope="row"><?= $data['alamat']; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php require_once "footer.php"; 

  if(isset($_POST['simpan'])){
     mysqli_query($k, "INSERT INTO karyawan VALUES (NULL, '$_POST[nama_calon]', '$_POST[jenis_kelamin]', '$_POST[no_hp]', '$_POST[alamat]')");          
     echo "<script>alert('Berhasil Simpan'); document.location = '?'</script>";
  
  }elseif(isset($_POST['ubah'])){
      mysqli_query($k, "UPDATE karyawan SET nama_calon='$_POST[nama_calon]', jenis_kelamin='$_POST[jenis_kelamin]', no_hp='$_POST[no_hp]', alamat='$_POST[alamat]' WHERE id_karyawan = '$_GET[id_karyawan]'");
      echo "<script>alert('Berhasil Ubah'); document.location = '?'</script>";
  
    }elseif(isset($_GET['hapus'])){
      mysqli_query($k, "DELETE FROM karyawan WHERE id_karyawan='$_GET[id_karyawan]'");
      echo "<script>alert('Berhasil Hapus'); document.location = ''</script>";
      
  }