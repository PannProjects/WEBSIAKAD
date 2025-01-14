<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : '';
    $level = isset($_POST["level"]) ? $_POST["level"] : '';

    $sql = "INSERT INTO pengguna (nama, password, level) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($sql);

    $stmt->bind_param("sss", $username, $password, $level);

    if ($stmt->execute()) {
        header("location: login.php");
        exit();
    } else {
        echo "Ada Kesalahan, Coba Lagi! " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>Sign-Up</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Nama" name="username">

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password">

        <label>Opsi</label>
        <div class="select-container">
            <select name="level" required>
                <option value="guru">Guru</option>
                <option value="murid">Murid</option>
            </select>
        </div>

        <button>Register</button>
        <a href="login.php">Sudah Punya Akun? Login</a>
    </form>
</body>

</html>