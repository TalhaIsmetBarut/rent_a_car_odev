<?php

function h($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

function diziYaz($dizi)
{
    echo "<pre>";
    print_r($dizi);
    echo "</pre>";
}

function tabloOku($tablo, $conn)
{
    $sql = "SELECT * FROM $tablo";
    $ornek = mysqli_query($conn, $sql);
    $dizi=[];
    while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)) {
        $dizi[$row[0]]=$row;
    }

    return $dizi;
}

?>
