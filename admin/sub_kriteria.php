<?php require_once "header.php"; 
if (isset($_GET['ubah'])){
  $data = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM sub_kriteria WHERE id_sub_kriteria = '$_GET[id_sub_kriteria]'"));
}
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Sub Kriteria</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Form Sub Kriteria</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="POST">
                <div class="col-12">
                  <label class="form-label">Kriteria</label>
                  <select name="id_kriteria" class="form-control" required>
                      <option value="">--pilih kriteria--
                      </option>
                      <?php $sql = mysqli_query($k, "SELECT * FROM kriteria");
                      while($data2 = mysqli_fetch_array($sql)){
                      ?>
                      <option value="<?= $data2['id_kriteria'] ?>" <?php if(isset($_GET['ubah'])){ if ($data['id_kriteria'] = $data2['id_kriteria']){ echo 'selected'; }} ?>><?= $data2['nama_kriteria'] ?>
                    </option>
                      <?php } ?>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label">Kategori</label>
                  <input type="text" name="kategori" class="form-control" value="<?php if(isset($_GET['ubah'])){ echo $data['kategori']; } ?>" placeholder="">
                </div>
                <div class="col-6">
                  <label class="form-label">Nilai</label>
                  <input type="text" name="nilai" class="form-control" onkeypress="return isNumberKey(event)" value="<?php if(isset($_GET['ubah'])){ echo $data['nilai']; } ?>" placeholder="">
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
              <h5 class="card-title">Data Sub Kriteria</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Kode Kriteria</th>
                    <th scope="col">Kriteria</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = mysqli_query($k, "SELECT * FROM kriteria inner join sub_kriteria on sub_kriteria.id_kriteria=kriteria.id_kriteria");
                  while($data = mysqli_fetch_array($sql)){
                  ?>
                  <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <th scope="row">
                      <a href="?ubah&id_sub_kriteria=<?= $data['id_sub_kriteria'] ?>"><button class="btn btn-warning">Ubah</button></a>
                      <a href="?hapus&id_sub_kriteria=<?= $data['id_sub_kriteria'] ?>" onclick="return confirm('Hapus?')"><button class="btn btn-danger">Hapus</button></a>
                    </th>
                    <td scope="row"><?= $data['kode_kriteria']; ?></td>
                    <td scope="row"><?= $data['nama_kriteria']; ?></td>
                    <td scope="row"><?= $data['kategori']; ?></td>
                    <td scope="row"><?= $data['nilai']; ?></td>
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
      mysqli_query($k, "INSERT INTO sub_kriteria VALUES (NULL, '$_POST[id_kriteria]', '$_POST[kategori]', '$_POST[nilai]')");
      echo "<script>alert('Berhasil Simpan'); document.location = '?'</script>";
    
  }elseif(isset($_POST['ubah'])){
      mysqli_query($k, "UPDATE sub_kriteria SET id_kriteria='$_POST[id_kriteria]', kategori='$_POST[kategori]', nilai='$_POST[nilai]' WHERE id_kriteria = '$_GET[id_kriteria]'");
      echo "<script>alert('Berhasil Ubah'); document.location = '?'</script>";
      
  }elseif(isset($_GET['hapus'])){
      mysqli_query($k, "DELETE FROM kriteria WHERE id_kriteria='$_GET[id_kriteria]'");
      echo "<script>alert('Berhasil Hapus'); document.location = '?'</script>";
      
  }