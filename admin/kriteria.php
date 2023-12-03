<?php require_once "header.php"; 
if (isset($_GET['ubah'])){
  $data = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM kriteria WHERE id_kriteria = '$_GET[id_kriteria]'"));
}
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Kriteria</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Form Kriteria</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="POST">
                <div class="col-6">
                  <label class="form-label">Kriteria</label>
                  <input type="text" name="kode_kriteria" class="form-control" value="<?php if(isset($_GET['ubah'])){ echo $data['kode_kriteria']; } ?>" placeholder="Kriteria">
                </div>
                <div class="col-6">
                  <label class="form-label">Nama Kriteria</label>
                  <input type="text" name="nama_kriteria" class="form-control" value="<?php if(isset($_GET['ubah'])){ echo $data['nama_kriteria']; } ?>" placeholder="Nama Kriteria">
                </div>
                <div class="col-6">
                  <label class="form-label">Bobot Kriteria</label>
                  <input type="text" name="bobot_kriteria" class="form-control" onkeypress="return isNumberKey(event)" value="<?php if(isset($_GET['ubah'])){ echo $data['bobot_kriteria']; } ?>" placeholder="Bobot Kriteria">
                </div>
                <div class="col-6">
                  <label class="form-label">Jenis</label>
                  <select name="jenis" class="form-control" required>
                      <option value="">--pilih jenis--</option>
                      <option value="Cost" <?php if(isset($_GET['ubah'])){ if ($data['jenis'] == "Cost"){ echo 'selected'; }} ?>>Cost</option>
                      <option value="Benefit" <?php if(isset($_GET['ubah'])){ if ($data['jenis'] == "Benefit"){ echo 'selected'; }} ?>>Benefit</option>
                  </select>
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
              <h5 class="card-title">Data Kriteria</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Kode Kriteria</th>
                    <th scope="col">Nama Kriteria</th>
                    <th scope="col">Bobot Kriteria</th>
                    <th scope="col">Jenis</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = mysqli_query($k, "SELECT * FROM kriteria");
                  while($data = mysqli_fetch_array($sql)){
                  ?>
                  <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <th scope="row">
                      <a href="?ubah&id_kriteria=<?= $data['id_kriteria'] ?>"><button class="btn btn-warning">Ubah</button></a>
                      <a href="?hapus&id_kriteria=<?= $data['id_kriteria'] ?>" onclick="return confirm('Hapus?')"><button class="btn btn-danger">Hapus</button></a>
                    </th>
                    <td scope="row"><?= $data['kode_kriteria']; ?></td>
                    <td scope="row"><?= $data['nama_kriteria']; ?></td>
                    <td scope="row"><?= $data['bobot_kriteria']; ?></td>
                    <td scope="row"><?= $data['jenis']; ?></td>
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
      $simpan = mysqli_query($k, "INSERT INTO kriteria VALUES (NULL, '$_POST[kode_kriteria]', '$_POST[nama_kriteria]', '$_POST[bobot_kriteria]', '$_POST[jenis]')");

      if($simpan){
          echo "<script>alert('Berhasil Simpan'); document.location = 'kriteria.php'</script>";
      }else{
          echo "<script>alert('Gagal Simpan'); document.location = 'kriteria.php'</script>";
      }

  }elseif(isset($_POST['ubah'])){
      $ubah = mysqli_query($k, "UPDATE kriteria SET kode_kriteria='$_POST[kode_kriteria]', nama_kriteria='$_POST[nama_kriteria]', bobot_kriteria='$_POST[bobot_kriteria]', jenis='$_POST[jenis]' WHERE id_kriteria = '$_GET[id_kriteria]'");

      if($ubah){
          echo "<script>alert('Berhasil Ubah'); document.location = 'kriteria.php'</script>";
      }else{
          echo "<script>alert('Gagal Ubah'); document.location = 'kriteria.php'</script>";
      }

  }elseif(isset($_GET['hapus'])){
      $hapus = mysqli_query($k, "DELETE FROM kriteria WHERE id_kriteria='$_GET[id_kriteria]'");

      if($hapus){
          echo "<script>alert('Berhasil Hapus'); document.location = 'kriteria.php'</script>";
      }else{
          echo "<script>alert('Gagal Hapus'); document.location = 'kriteria.php'</script>";
      }
      
  }

?>