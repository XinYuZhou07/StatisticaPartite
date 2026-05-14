<?php
include "connect_db.php";
include_once "predizione.php";

$sql_elenco = "SELECT id, squadra1, squadra2 FROM partite";
$elenco = $conn->query($sql_elenco);

$match_id = $_POST['match_id'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Analisi Matchup</title>
    <style>
        body {
          font-family: sans-serif;
          max-width: 600px; margin: auto;
          padding: 20px;
          background: #f4f4f4;
        }
        .card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin-top: 20px;
      }
        select {
          width: 100%;
          padding: 10px;
        }
        .vs-title{
          text-align: center;
          font-size: 1.5em;
          font-weight: bold;
          color: #1e3a8a;
        }
        .bar-container {
          background: #eee;
          height: 30px;
          border-radius: 15px;
          overflow: hidden;
          display: flex; margin: 20px 0;
        }
        .bar {
          height: 100%;
          display: flex;
          align-items: center;
          justify-content: center;
          color: white;
          font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="card">
        <h3>Analizza una partita del database</h3>
        <form method="POST">
            <select name="match_id" onchange="this.form.submit()">
                <option value="">Seleziona Match</option>
                <?php while($row = $elenco->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>" <?= ($match_id == $row['id']) ? 'selected' : '' ?>>
                        <?= $row['squadra1'] ?> vs <?= $row['squadra2'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </form>
    </div>

    <?php 
    if($match_id) {
        $q = $conn->query("SELECT squadra1, squadra2 FROM partite WHERE id = $match_id");
        $m = $q->fetch_assoc();
        $s1 = $m['squadra1'];
        $s2 = $m['squadra2'];

        $pote1 = potereAttaccoS1v2($s1, $s2, $conn);
        $pote2 = potereAttaccoS1v2($s2, $s1, $conn);
        
        $prob1 = probabilitaVittoriaS1($pote1, $pote2);
        $prob2 = 100 - $prob1;
    ?>
        <div class="card">
            <div class="vs-title"><?= $s1 ?> <span style="color:red">VS</span> <?= $s2 ?></div>
            
            <div class="bar-container">
                <div class="bar" style="width: <?= $prob1 ?>%; background: #3b82f6;"><?= round($prob1) ?>%</div>
                <div class="bar" style="width: <?= $prob2 ?>%; background: #ef4444;"><?= round($prob2) ?>%</div>
            </div>
            
            <p><strong>Analisi Storica:</strong></p>
            <ul>
                <li>Win Rate <?= $s1 ?>: <?= round(frequenzaRelativa($s1, $conn) * 100) ?>%</li>
                <li>Win Rate <?= $s2 ?>: <?= round(frequenzaRelativa($s2, $conn) * 100) ?>%</li>
            </ul>
        </div>
    <?php } ?>

</body>
</html>