<?php require_once "header.php"; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Uji Tes</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Form Data Uji Tes</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="POST">
                <div class="col-12">
                  <label class="form-label">Nama Calon</label>
                  <select name="id_karyawan" class="form-control" required>
                      <option value="">-- Pilih Calon --</option>
                      <?php $query = mysqli_query($k, "select * from karyawan where id_karyawan not in (select id_karyawan from alternatif) order by nama_calon asc");
                      while ($calon = mysqli_fetch_array($query)) { ?>
                          <option value="<?= $calon['id_karyawan']; ?>" <?php if (isset($_GET['ubah'])) {
                                if ($data['id_karyawan'] == $calon['id_karyawan']) {
                                    echo "selected";
                                }
                            } ?>><?= $calon['nama_calon']; ?></option>
                      <?php } ?>
                  </select>
                </div>
                    <?php
                    $sql = mysqli_query($k, "select * from kriteria");
                    while ($nilai = mysqli_fetch_array($sql)) {
                        ?>
                        <div class="col-6">
                            <label class="form-label">
                                <?= $nilai['nama_kriteria']; ?> :
                            </label>
                            <select name="id<?= $nilai['id_kriteria']; ?>" class="form-control" required>
                                <?php
                                $query = mysqli_query($k, "select * from sub_kriteria where id_kriteria='$nilai[id_kriteria]'");
                                while ($detail = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?= $detail['id_sub_kriteria']; ?>"><?= $detail['kategori']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                <div class="text-lef">
                  <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                  <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Uji Tes</h5>
              <form method="get">
                <button type="submit" name="moora" class="btn btn-warning form-control">Rekomendasi Calon Ketua Tim Project</button>
              </form>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Penilaian</th>
                    <th scope="col">Hasil</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = mysqli_query($k, "select *, alternatif.id_alternatif as alternatif_id from karyawan inner join alternatif on alternatif.id_karyawan=karyawan.id_karyawan order by alternatif.hasil desc");
                  while($data = mysqli_fetch_array($sql)){
                  ?>
                  <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <td scope="row">
                      <a href="?hapus&id_alternatif=<?= $data['alternatif_id'] ?>" onclick="return confirm('Hapus?')"><button class="btn btn-danger">Hapus</button></a>
                    </td>
                    <td scope="row"><?= $data['nama_calon']; ?></td>
                    <td scope="row">
                      <?php if($data['peringkat']!==NULL){ ?>
                      Rekomendasi:
                      <?= $data['peringkat']; ?> <br>
                      <?php } ?>
                      <?php $query = mysqli_query($k, "select * from penilaian inner join sub_kriteria on sub_kriteria.id_sub_kriteria=penilaian.id_sub_kriteria inner join kriteria on kriteria.id_kriteria=sub_kriteria.id_kriteria where penilaian.id_alternatif='$data[alternatif_id]'");
                      while ($detail = mysqli_fetch_array($query)) {
                          echo "<b>" . $detail['nama_kriteria'] . ":</b> " . $detail['kategori'] . " <br>Nilai: " . $detail['nilai_bobot'] . "<br>";
                      } ?>
                  </td>
                  <td scope="row">
                      <?php if ($data['hasil'] == NULL or $data['hasil'] == 0) {
                          echo "Belum dihitung";
                      } else {
                          echo $data['hasil'];
                      } ?>
                  </td>
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

if (isset($_POST['simpan'])) {
  $sql = mysqli_query($k, "insert into alternatif values (NULL, '$_SESSION[id_pengguna]', '$_POST[id_karyawan]', NULL,NULL)");
  if ($sql) {
      $id_alternatif = mysqli_insert_id($k);
      $sql = mysqli_query($k, "select * from kriteria");
      while ($data = mysqli_fetch_array($sql)) {
          $id_sub_kriteria = $_POST['id' . $data['id_kriteria']];
          $nilai = mysqli_fetch_array(mysqli_query($k, "select * from sub_kriteria where id_sub_kriteria='$id_sub_kriteria'"));
          mysqli_query($k, "insert into penilaian values(NULL, '$id_alternatif', '$id_sub_kriteria', '$nilai[nilai]')");
      }
      echo "<script> alert('Data berhasil disimpan'); window.location = '?' </script>";
  }
} elseif (isset($_GET['hapus'])) {
  mysqli_query($k, "delete from alternatif where id_alternatif = '$_GET[id]'");
  echo "<script> alert('Data berhasil dihapus'); window.location = '?' </script>";
  
}elseif (isset($_GET['moora'])) {
  $sql = mysqli_query($k, "select * from alternatif");
  $alternatif = mysqli_num_rows($sql);
  if ($alternatif > 0) {
      while ($data = mysqli_fetch_array($sql)) {
          $query = mysqli_query($k, "select * from penilaian where id_alternatif='$data[id_alternatif]'");
          while ($nilai = mysqli_fetch_array($query)) {
              $total[] = $nilai['nilai_bobot'];
              $id_sub_kriteria[] = $nilai['id_sub_kriteria'];
          }
      }

      $penilaian = mysqli_num_rows(mysqli_query($k, "select * from penilaian"));
      $kriteria = mysqli_num_rows(mysqli_query($k, "select * from kriteria"));
      for ($x = 0; $x < $kriteria; $x++) {
          $hitung = 0;
          for ($y = $x; $y < $penilaian; $y += $kriteria) {
              $hitung += pow($total[$y], 2);
          }
          $jumlah[] = round(sqrt($hitung), 4);
      }

      for ($x = 0; $x < $kriteria; $x++) {
          $hitung = 0;
          for ($y = $x; $y < $penilaian; $y += $kriteria) {
              $cek = mysqli_fetch_array(mysqli_query($k, "select * from kriteria inner join sub_kriteria on sub_kriteria.id_kriteria=kriteria.id_kriteria where sub_kriteria.id_sub_kriteria='$id_sub_kriteria[$y]'"));
              $hitung = round(((round($total[$y] / $jumlah[$x], 2)) * $cek['bobot_kriteria']), 4);
              $optimasi[] = $hitung;
              $jenis[] = $cek['jenis'];
          }
      }

      //echo print_r($optimasi);
      for ($x = 0; $x < $alternatif; $x++) {
          $max = 0;
          $min = 0;
          for ($y = $x; $y < $penilaian; $y += $alternatif) {
              //echo $optimasi[$y] . "(jenis)" . $jenis[$y] . "<br>";
              if ($jenis[$y] == "Benefit") {
                  $max += $optimasi[$y];
                  //echo $max . "<br>";
              } elseif ($jenis[$y] == "Cost") {
                  $min += $optimasi[$y];
              }
          }
          // echo "<br>";
          //echo $max . "<br>";
          $yi[] = $max - $min;
      }
      //echo print_r($yi);
      $sql = mysqli_query($k, "select * from alternatif");
      $x = 0;
      while ($data = mysqli_fetch_array($sql)) {
          //echo $yi[$x] . "<br>";
          mysqli_query($k, "update alternatif set hasil='$yi[$x]' where id_alternatif='$data[id_alternatif]'");
          $x++;
      }

      $sql = mysqli_query($k, "select *, alternatif.id_alternatif as alternatif_id from karyawan inner join alternatif on alternatif.id_karyawan=karyawan.id_karyawan order by alternatif.hasil desc");
      $x = 1;
      while ($data = mysqli_fetch_array($sql)) {
          mysqli_query($k, "update alternatif set peringkat='$x' where id_alternatif='$data[id_alternatif]'");
          $x++;
      }

      echo "<script> alert('Data uji tes berhasil dihitung'); window.location = '?' </script>";
  } else {
      echo "<script> alert('Data uji tes masih kosong'); window.location = '?' </script>";
  }
} ?>