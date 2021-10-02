<?php
ini_set('display_errors', 1);

function curl($url)
{
    $ch = curl_init();

    // set URL
    curl_setopt($ch, CURLOPT_URL, $url);
    // return as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $hasil = curl_exec($ch);

    curl_close($ch);
    return $hasil;
}

function getHigh()
{
    $regis = curl("https://indodax.com/api/tickers");
    $result = json_decode($regis, true);
    $list_high = "";

    foreach ($result as $tickers) {
        foreach ($tickers as $aset => $a) {
            if ($a['last'] == $a['high']) {
                $list_high = $list_high . "\n$aset";
            }
        }
    }

    $pesan = "Daftar market dengan nilai tinggi Hari ini : $list_high";
    return $pesan;
}

function getLow()
{
    $regis = curl("https://indodax.com/api/tickers");
    $result = json_decode($regis, true);
    $list_low = "";


    foreach ($result as $tickers) {
        foreach ($tickers as $aset => $a) {
            if ($a['last'] == $a['low']) {
                $list_low = $list_low . "\n$aset";
            }
        }
    }

    $pesan = "Daftar market dengan nilai rendah Hari ini : $list_low";
    return $pesan;
}
