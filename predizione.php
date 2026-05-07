<?php
include "connect_db.php";
include "calcFreqRel.php";

//$squad1 = $_POST["squadra1"];
//$squad2 = $_POST["squadra2"];

$squad1 = "Manchester City";
$squad2 = "Liverpool";
$attS1 = potereAttaccoS1v2($squad1, $squad2, $conn);
$attS2 = potereAttaccoS1v2($squad2, $squad1, $conn);

$prob1 = probabilitaVittoriaS1($attS1, $attS2);
$prob2 = probabilitaVittoriaS1($attS2, $attS1);


echo "Probabilita di vittoria (con memoria) di S1: " . "<br>";
echo ($prob1);
echo "<br>";

echo "Probabilita di vittoria (con memoria) di S2: " . "<br>";
echo ($prob2);
echo "<br>";


//senza tenere conto delle partite passate
/* $probVittS1 = ($attS1 / ($attS1 + $attS2)) * 100;
 */


//tenendo conto delle partite passate
// $probVittS1 = ($attS1 * 0.80) + 
/* $sql = "SELECT COUNT(*) FROM partite WHERE (squadra1 LIKE '" . $squad1 . "' OR squadra2 LIKE '" . $squad1 . "') AND (squadra1 LIKE '" . $squad2 . "' OR squadra2 LIKE '" . $squad2 . "')";
$res = $conn->query($query);
if($res->num_rows > 0){
    $nPartitePass = $res["count"];
    $sql = "SELECT vincitore v FROM partite WHERE (squadra1 LIKE '" . $squad1 . "' OR squadra2 LIKE '" . $squad1 . "') AND (squadra1 LIKE '" . $squad2 . "' OR squadra2 LIKE '" . $squad2 . "')";
    $res = $conn->query($query);
    if($res->num_rows > 0){
        $nVittS1 = 0;
        while($row = $res->fetch_assoc()){
            if($row["v"] == $squad1){
                $nVittS1 ++;
            }
        }
        $attS1 = $attS1 * 0.8 + $nVittS1 / $nPartitePass * 0.2; 
    }
}else{

} */



function potereAttaccoS1($squad1, $squad2, $conn){
    $nGoalF1 = 0;
    $nGoalS2 = 0;

    //calcola numero di goal squad1
    $sql = "SELECT punteggio1 points FROM partite WHERE squadra1 LIKE '" . $squad1 . "'";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $nGoalF1 += $row["points"];
        }
    }
    $sql = "SELECT punteggio2 points FROM partite WHERE squadra2 LIKE '" . $squad1 . "'";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $nGoalF1 += $row["points"];
        }
    }
    //calcolo la media dei goal per partita
    $nGoalF1 = $nGoalF1/contaPartite($squad1, $conn);


    //calcolo numero goal subuti squad2
    $sql = "SELECT punteggio1 points FROM partite WHERE squadra2 LIKE '" . $squad2 . "'";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $nGoalS2 += $row["points"];
        }
    }
    $sql = "SELECT punteggio2 points FROM partite WHERE squadra1 LIKE '" . $squad2 . "'";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $nGoalS2 += $row["points"];
        }
    }
    $nGoalS2 = $nGoalS2/contaPartite($squad2, $conn);


    $freqRelSQ1 = frequenzaRelativa($squad1, $conn);

    return (($nGoalF1 + $nGoalS2) / 2) * $freqRelSQ1;
}

function potereAttaccoS1v2($squad1, $squad2, $conn){
    $attS1 = potereAttaccoS1($squad1, $squad2, $conn);
    
    // tengo memoria dell epartite passate
    $sql = "SELECT COUNT(*) c FROM partite WHERE (squadra1 LIKE '" . $squad1 . "' OR squadra2 LIKE '" . $squad1 . "') AND (squadra1 LIKE '" . $squad2 . "' OR squadra2 LIKE '" . $squad2 . "')";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
        $row = $res->fetch_assoc();
        $nPartitePass = $row["c"];
        if($nPartitePass != 0){
            $sql = "SELECT vincitore v FROM partite WHERE (squadra1 LIKE '" . $squad1 . "' OR squadra2 LIKE '" . $squad1 . "') AND (squadra1 LIKE '" . $squad2 . "' OR squadra2 LIKE '" . $squad2 . "')";
            $res = $conn->query($sql);
            if($res->num_rows > 0){
                $nVittS1 = 0;
                while($row = $res->fetch_assoc()){
                    if($row["v"] == $squad1){
                        $nVittS1 ++;
                    }
                }
                $attS1 = $attS1 * 0.8 + $nVittS1 / $nPartitePass * 0.2; 
            }
        }
        
    }

    return $attS1;
}

function probabilitaVittoriaS1($attS1, $attS2){
    return ($attS1 / ($attS1 + $attS2)) * 100;
}