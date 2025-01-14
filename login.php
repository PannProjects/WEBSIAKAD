<?php
session_start();
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["nama"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM pengguna WHERE nama = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["iduser"] = $row["iduser"];
            $_SESSION["nama"] = $row["nama"];
            $_SESSION["level"] = $row["level"];
            header("location: dashboard.php");
        } else {
            echo "Password Salah Cuy";
        }
    } else {
        echo "Akun Tidak Terdaftar Cuy";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
    <link rel="stylesheet" href="css/style2.css">
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>Sign-In</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Nama" name="nama" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" required>

        <button>Login</button>
        <label>Belum Punya Akun? <a href="register.php">Register</a></label>
    </form>
</body>

</html>