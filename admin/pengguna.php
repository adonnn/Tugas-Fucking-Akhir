<?php require_once "header.php"; 
if (isset($_GET['ubah'])){
  $data = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM pengguna WHERE id_pengguna = '$_GET[id_pengguna]'"));
}
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Pengguna</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Form Pengguna</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="POST">
                <div class="col-6">
                  <label class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control" value="<?php if(isset($_GET['ubah'])){ echo $data['nama']; } ?>" placeholder="">
                </div>
                <div class="col-6">
                  <label class="form-label">Jabatan</label>
                  <select name="jabatan" class="form-control" required>
                      <option value="">--pilih jabatan--</option>
                      <option value="Admin" <?php if(isset($_GET['ubah'])){ if ($data['jabatan'] == "Admin"){ echo 'selected'; }} ?>>Admin</option>
                      <option value="Kepala Bagian Teknik" <?php if(isset($_GET['ubah'])){ if ($data['jabatan'] == "Kepala Bagian Teknik"){ echo 'selected'; }} ?>>Kepala Cabang</option>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" value="<?php if(isset($_GET['ubah'])){ echo $data['username']; } ?>" placeholder="">
                </div>
                <div class="col-6">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" value="<?php if(isset($_GET['ubah'])){ echo $data['password']; } ?>" placeholder="">
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
              <h5 class="card-title">Data Pengguna</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Username</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = mysqli_query($k, "SELECT * FROM pengguna");
                  while($data = mysqli_fetch_array($sql)){
                  ?>
                  <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <td scope="row">
                      <a href="?ubah&id_pengguna=<?= $data['id_pengguna'] ?>"><button class="btn btn-warning">Ubah</button></a>
                      <a href="?hapus&id_pengguna=<?= $data['id_pengguna'] ?>" onclick="return confirm('Hapus?')"><button class="btn btn-danger">Hapus</button></a>
                    </td>
                    <td scope="row"><?= $data['nama']; ?></td>
                    <td scope="row"><?= $data['jabatan']; ?></td>
                    <td scope="row"><?= $data['username']; ?></td>
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