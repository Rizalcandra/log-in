
<!DOCTYPE html>
<html>
<head>
    <title>Rizal log in & register</title>
</head>
<body>
<h2>log in or register</h2>

<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>

    <input type="submit" name="login" value="Login">
    <input type="submit" name="register" value="Register">
</form>

<?php
$filename = "users.txt";

// REGISTER
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $exists = false;
    if (file_exists($filename)) {
        $lines = file($filename);
        foreach ($lines as $line) {
            list($user, $pass) = explode("|", trim($line));
            if ($user === $username) {
                $exists = true;
                break;
            }
        }
    }

    if ($exists) {
        echo "<p style='color:red;'>Username sudah terdaftar!</p>";
    } else {
        file_put_contents($filename, "$username|$password\n", FILE_APPEND);
        echo "<p style='color:green;'>Registrasi berhasil!</p>";
    }
}

// LOGIN
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $found = false;
    if (file_exists($filename)) {
        $lines = file($filename);
        foreach ($lines as $line) {
            list($user, $pass) = explode("|", trim($line));
            if ($user === $username && $pass === $password) {
                $found = true;
                break;
            }
        }
    }

    if ($found) {
        echo "<p style='color:green;'>Login berhasil! Selamat datang, $username.</p>";
    } else {
        echo "<p style='color:red;'>Login gagal! Username atau password salah.</p>";
    }
}
?>
</body>
</html>