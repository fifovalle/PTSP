<?php
include 'databases.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $obyekAdmin = new Admin($koneksi);
    $hasil = $obyekAdmin->getAdminByToken($token);
    if ($hasil) {
        $kosongkanToken = $obyekAdmin->updateToken($hasil['ID_Admin'], '');
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset Kata Sandi</title>
        </head>

        <body>
            <h2>Reset Kata Sandi</h2>
            <form action="reset-password.php" method="post">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <label for="password">Kata Sandi Baru:</label><br>
                <input type="password" id="password" name="password"><br>
                <label for="confirm_password">Konfirmasi Kata Sandi Baru:</label><br>
                <input type="password" id="confirm_password" name="confirm_password"><br><br>
                <input type="submit" value="Reset Kata Sandi">
            </form>
        </body>

        </html>
<?php
    } else {
        echo "Token tidak valid.";
    }
} else {
    echo "Token tidak ditemukan dalam URL.";
}
?>