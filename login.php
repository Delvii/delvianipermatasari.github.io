<?php
require "config.php";
session_start();

// Memeriksa method post yang dikirim ke halaman ini
if (isset($_POST["loginadmin"])) {
    $nama = $_POST["nama"];
    $password = $_POST["password"];

    $admin = findOne("SELECT * FROM admin WHERE nama = '$nama'");
    if ($admin != null) {

        // Memeriksa apakah password benar
        if (password_verify($password, $admin["password"])) {

            // Membuat session login berupa id user
            $_SESSION["loginadmin"] = $admin["id"];

            // Login ke halaman admin
            if ($admin["role"] == "admin") {
                $_SESSION["admin"] = true;
                echo "
 					<script>
 						document.location.href = 'index.php';
 					</script>";
            }
        } else {
            echo "
 				<script>
 					alert('Password salah');
 					document.location.href = 'loginadmin.php';
 				</script>";
        }
    } else {
        echo "
 			<script>
 				alert('admin belum terdaftar, silahkan register');
 				document.location.href = 'registeradmin.php';
 			</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Index 02</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
<!--===============================================================================================-->
	<link href="assets/css/nucleo-icons.css" rel="stylesheet" />
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100 agaatasan" style="padding-top: 40px; margin-top: 0;">

			<form class="contact100-form validate-form" role="form" method="post">

				<span class="contact100-form-title">
					Login <br><br>
				</span>

				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100"><i class="ni ni-email-83"></i> Nama </span>
					<input class="input100" type="text" name="nama" placeholder="isi nama anda" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<span class="label-input100"><i class="ni ni-lock-circle-open"></i> Password</span>
					<input class="input100" type="password" name="password" placeholder="isi password anda" required>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button type="submit" class="contact100-form-btn" name="loginadmin">
							<span>
								Submit
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
			</form>

			<p class="text-center">
				<a href="registeradmin.php">Belum punya akun?</a>
			</p>

		</div>
	</div>

</body>
</html>
