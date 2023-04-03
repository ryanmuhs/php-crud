<?php
  $host = "localhost";
  $user = "root";
  $pass = "";
  $db = "db_crud_dasar";

  // connect ke db
  $conn = mysqli_connect($host, $user, $pass, $db);

  if(!$conn){
      die("Unable connect to database");
  }
  $nama = "";
  $nim = "";
  $jurusan = "";
  $sukses = "";
  $error = "";
  

  if(isset($_GET['op'])){
    $op = $_GET['op'];
  } else {
    $op = "";
  }

  if($op == 'delete'){
    $id = $_GET['id'];
    $sql1 = "delete from mahasiswa where id = '$id'";
    $q1 = mysqli_query($conn,$sql1);
    if($q1){
      $sukses = "Data berhasil dihapus";
    }else{
      $error = "Gagal menghapus data";
    }
  }
  // edit
  if($op == 'edit'){
    $id = $_GET['id'];
    $sql1 = "select * from mahasiswa where id = '$id'";
    $q1 = mysqli_query($conn,$sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama = $r1['nama'];
    $nim = $r1['nim'];
    $jurusan = $r1['jurusan'];

    if($nim == ''){
      $error = "Data tidak ditemukan!";
    }
  }

  // ketika tombol Simpan data diklik
  if(isset($_POST['simpan'])){
    // ngambil dari property name
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];

    // memastikan variabel nama, nim, dan jurusan ada isinya atau tidak
    if($nama && $nim && $jurusan){
      if($op == 'edit'){
        $sql1 = "update mahasiswa set nama = '$nama', nim = '$nim', jurusan = '$jurusan' where id = '$id'";
        $q1 = mysqli_query($conn,$sql1);
        if ($q1) {
          $sukses = "Data berhasil diupdate";
        } else {
          $error = "Data gagal diupdate";
        }
      } else { // update
        $sql1 = "insert into mahasiswa(nama, nim, jurusan) values ('$nama', '$nim', '$jurusan')";
        $q1 = mysqli_query($conn,$sql1);
  
        // conditinal utk sukses/tidaknya input data
        if($q1){
          $sukses = "Berhasil memasukkan data baru";
        } else {
          $error = "Gagal memasukkan data";
        }
      }
      // pake command sql
    } else {
      $error = "Terjadi kesalahan! Silakan masukkan semua data!";
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD - Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <div class="mx-auto">
      <!-- utk input data -->
      <div class="card">
        <div class="card-header">
            Create / Edit Data Mahasiswa
        </div>
        <div class="card-body">
          <?php
            if($error){
          ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $error ?>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
              </div>
          <?php
              header("refresh:5;url=index.php"); // 5 detik
            }
            ?>
            <?php
            if($sukses){
              ?>
              <div class="alert alert-success" role="alert">
                <?php echo $sukses ?>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
              </div>
              <?php
              header("refresh:5;url=index.php"); // 5 detik
            }
          ?>

          <form action="" method="post">
            <div class="mb-3">
              <label for="nama" class="col-sm-2 col-form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
            </div>
            <div class="mb-3">
              <label for="nim" class="col-sm-2 col-form-label">NIM</label>
              <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
            </div>
            <div class="mb-3">
              <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
              <select class="form-control" id="jurusan" name="jurusan">
                <option value="">- Pilih Jurusan -</option>
                <option value="sisfo" <?php if($jurusan == "sisfo") echo "selected" ?>>Sistem Informasi</option>
                <option value="if" <?php if($jurusan == "if") echo "selected" ?>>Informatika</option>
                <option value="ds" <?php if($jurusan == "ds") echo "selected" ?>>Data Science</option>
              </select>
            </div>
            <div class="col-12">
              <input type="submit" class="btn btn-primary" value="Simpan" name="simpan"></input>
              <!-- <input type="submit" class="btn btn-warning" value="Edit" name="edit"></input> -->
              
            </div>

          </form>
        </div>
      </div>

      <!-- Utk mengeluarkan data -->
      <div class="card">
        <div class="card-header text-white bg-secondary">
            Data Mahasiswa
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">NIM</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Aksi</th>
              </tr>
              <tbody>
                <?php 
                  $sql2 = "select * from mahasiswa order by id desc";
                  $q2 = mysqli_query($conn,$sql2);
                  while($r2 = mysqli_fetch_array($q2)){
                    $id = $r2['id'];
                    $nama = $r2['nama'];
                    $nim = $r2['nim'];
                    $jurusan = $r2['jurusan'];
                    $urut = 1;

                ?>
                    <tr>
                      <th scope="row"><?php echo $urut++ ?></th>
                      <td scope="row"><?php echo $nama ?></td>
                      <td scope="row"><?php echo $nim ?></td>
                      <td scope="row"><?php echo $jurusan ?></td>
                      <td scope="row">
                        <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                        <!-- <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a> -->
                        
                        <a href="index.php?op=delete&id=<?php echo $id ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Yakin Hapus Data?')">Hapus</button></a>
                        
                      </td>

                    </tr>
                    <?php 
                  }
                  ?>
                ?>
              </tbody>
            </thead>
          </table>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>