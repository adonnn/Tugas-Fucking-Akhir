<?php require_once "header.php"; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Ubah Password</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Form Ubah Password</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="POST">
                <div class="col-6">
                  <label class="form-label">Password Baru</label>
                  <input type="password" name="pass1" class="form-control" placeholder="Password Baru">
                </div>
                <div class="col-6">
                  <label class="form-label">Ulangi Password</label>
                  <input type="password" name="pass2" class="form-control" placeholder="Ulangi Password">
                </div>
                <div class="text-lef">
                  <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
                  <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
        
      </div>
    </section>

  </main><!-- End #main -->

<?php require_once "footer.php"; 

  if(isset($_POST['ubah'])){
    if ($_POST['pass1'] == $_POST['pass2']) {
        mysqli_query($k, "UPDATE pengguna SET password='$_POST[pass2]' WHERE id_pengguna='$_SESSION[id_pengguna]'");
        echo "<script>alert('Password berhasil diubah'); document.location = '?'</script>";
    }else{
        echo "<script>alert('Password baru tidak sama'); document.location = '?'</script>";
    }
  }