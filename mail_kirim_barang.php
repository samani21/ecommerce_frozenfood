<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendPengirmanBarang($email, $id_order)
{
    include "koneksi.php";
    $data = [];
    $pesanan = mysqli_query($koneksi, "SELECT pesanan.*,barang.nm_barang FROM pesanan join barang on barang.id_barang = pesanan.id_barang WHERE id_order = $id_order");
    while ($row = mysqli_fetch_array($pesanan)) {
        $data[] = $row; // Mengisi array data dengan hasil query
    }

    // Membuat string HTML dari array data
    $dataHtml = "<h3>Detail Pesanan:</h3><ul>";
    foreach ($data as $item) {
        $dataHtml .= "<li>ID Barang: " . $item['id_barang'] . "</li>";
        $dataHtml .= "<li>Nama Barang: " . $item['nm_barang'] . "</li>";
        $dataHtml .= "<li>Jumlah: " . $item['jumlah'] . "</li>";
        $dataHtml .= "<li>Harga: " . $item['harga'] . "</li><br>";
    }
    $dataHtml .= "</ul>";

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'yogadwimaulanaaa@gmail.com';             // SMTP username
        $mail->Password = 'tajotfkkpdtexeyx';                 // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('yogadwimaulanaaa@gmail.com', 'Yoga');
        $mail->addAddress($email);                            // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Pengiriman Barang';
        $mail->Body    = "Berikut adalah detail pesanan Anda:<br><br>$dataHtml";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
