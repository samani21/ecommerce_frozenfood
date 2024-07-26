<?php
include "koneksi.php";
if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];


    $stmt = $koneksi->prepare("SELECT id FROM user WHERE verification_code = ?");
    $stmt->bind_param("s", $verification_code);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id);
        $stmt->fetch();

        $stmt->close();

        $stmt = $koneksi->prepare("UPDATE user SET is_verified = 1, verification_code = '' WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
?>
            <script>
                window.location = "http://localhost/bikafrozen/login.php";
            </script>
<?php
        } else {
            echo "Failed to verify email.";
        }
    } else {
        echo "Invalid verification code.";
    }

    $stmt->close();
    $koneksi->close();
} else {
    echo "No verification code provided.";
}
