<?php
ini_set('display_errors', 1);
require "retrieveData.php";

$token = "token";   // isi dengan token bot yang didapat dari @BotFather
$apiURL = "https://api.telegram.org/bot$token";
$update = json_decode(file_get_contents("php://input"), TRUE);
$chatID = $update["message"]["chat"]["id"];     // mengambil id pengirim pesan
$username = $update["message"]["chat"]["username"];   // mengambil username pengirim pesan
$message = $update["message"]["text"];        // mengambil isi pesan

    if (strpos($message, "/start") === 0) {   // jika pesan mengandung kata "/start" di awal
        // maka akan terkirim pesan sebagai berikut
        file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Halo $username.");
    } elseif (strpos($message, "/pantau") === 0) {    // jika pesan mengandung kata "/pantau" di awal
        $daftarHigh = getHigh();
        $daftarLow = getLow();
        $pesan = str_replace(" ", "%20", "Halo $username. " . urlencode("\n$daftarHigh\n\n$daftarLow"));
        $hasil = file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$pesan");

        if ($hasil == false) {
            file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$message gagal.");
        }
    } else {    // jika pesan tidak mengandung kedua kata tersebut pada awal kalimat
        file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Perintah tidak dikenali.");
    }
