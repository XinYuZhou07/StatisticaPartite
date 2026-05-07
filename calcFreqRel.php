<?php
include "connect_db.php";

//$squad = $_POST["squadra"];
$squad = "Arsenal";

//conto delle vittorie
$query = "SELECT COUNT(*) count FROM partite WHERE vincitore LIKE '" . $squad . "'";

$res = $conn->query($query);
if($res->num_rows > 0){
    $nVittorie = $res->fetch_assoc();
    //echo "Vittorie: ";
    //echo ($nVittorie["count"]);
    //echo "<br>";
}

//conto delle partite
$query = "SELECT COUNT(*) count FROM partite WHERE squadra1 LIKE '" . $squad . "' OR squadra2 LIKE '" . $squad . "'";

$res = $conn->query($query);
if($res->num_rows > 0){
    $nPartTot = $res->fetch_assoc();
    //echo "Partite totali: ";
    //echo ($nPartTot["count"]);
    //echo "<br>";
}

$freq = $nVittorie["count"]/$nPartTot["count"];
//echo "Frequenza relativa: ";
//echo ($freq);

function contaVittorie($squad, $conn){
    $query = "SELECT COUNT(*) count FROM partite WHERE vincitore LIKE '" . $squad . "'";

    $res = $conn->query($query);
    if($res->num_rows > 0){
        $nVittorie = $res->fetch_assoc();
        return $nVittorie["count"];
    }
}

function contaPartite($squad, $conn){
    $query = "SELECT COUNT(*) count FROM partite WHERE squadra1 LIKE '" . $squad . "' OR squadra2 LIKE '" . $squad . "'";

    $res = $conn->query($query);
    if($res->num_rows > 0){
        $nPartTot = $res->fetch_assoc();
        return $nPartTot["count"];
    }
}

function frequenzaRelativa($squad, $conn){
    return contaVittorie($squad, $conn)/contaPartite($squad, $conn);
}

//echo (frequenzaRelativa("Arsenal", $conn));
