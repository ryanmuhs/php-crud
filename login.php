<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_login";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Unable connect to database");
} 

$username = "";
$err = "";
$remember = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
div class="mx-auto">
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
</body>
</html>