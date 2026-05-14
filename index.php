<?php
include "connect_db.php";
include_once "predizione.php";

$sql_elenco = "SELECT squadra1 as squadra FROM partite UNION SELECT squadra2 FROM partite ORDER BY squadra";
$elenco = $conn->query($sql_elenco);

$squad1 = $_POST["sq1"] ?? null;
$squad2 = $_POST["sq2"] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Analisi Matchup</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: auto; padding: 20px; background: #f4f4f4; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-top: 20px; }
        
        /* Layout per allineare le select */
        .select-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 20px;
        }
        .select-box { flex: 1; }
        select { width: 100%; padding: 12px; border-radius: 5px; border: 1px solid #ccc; font-size: 1rem; }
        .vs-label { font-weight: bold; font-size: 1.2em; color: #666; }

        /* Bottone */
        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #1e3a8a;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-submit:hover { background-color: #2563eb; }

        /* Grafica risultati */
        .vs-title { text-align: center; font-size: 1.5em; font-weight: bold; color: #1e3a8a; }
        .bar-container { background: #eee; height: 35px; border-radius: 20px; overflow: hidden; display: flex; margin: 20px 0; border: 1px solid #ddd; }
        .bar { height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.5); }
    </style>
</head>
<body>

    <div class="card">
        <h3 style="text-align: center; margin-top: 0;">Analizza Matchup</h3>
        <form method="POST">
            <div class="select-container">
                <div class="select-box">
                    <select name="sq1">
                        <option value="">Squadra 1</option>
                        <?php while($row = $elenco->fetch_assoc()): ?>
                            <option value="<?= $row['squadra'] ?>" <?= ($squad1 == $row['squadra']) ? 'selected' : '' ?>>
                                <?= $row['squadra'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="vs-label">VS</div>

                <div class="select-box">
                    <?php $elenco->data_seek(0); ?>
                    <select name="sq2">
                        <option value="">Squadra 2</option>
                        <?php while($row = $elenco->fetch_assoc()): ?>
                            <option value="<?= $row['squadra'] ?>" <?= ($squad2 == $row['squadra']) ? 'selected' : '' ?>>
                                <?= $row['squadra'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="btn-submit">CALCOLA</button>
        </form>
    </div>

    <?php 
    if($squad1 && $squad2 && $squad1 != $squad2) {
        $pote1 = potereAttaccoS1v2($squad1, $squad2, $conn);
        $pote2 = potereAttaccoS1v2($squad2, $squad1, $conn);
        
        $prob1 = probabilitaVittoriaS1($pote1, $pote2);
        $prob2 = 100 - $prob1;
    ?>
        <div class="card">
            <div class="vs-title"><?= $squad1 ?> <span style="color:red">VS</span> <?= $squad2 ?></div>
            
            <div class="bar-container">
                <div class="bar" style="width: <?= $prob1 ?>%; background: #3b82f6;"><?= round($prob1) ?>%</div>
                <div class="bar" style="width: <?= $prob2 ?>%; background: #ef4444;"><?= round($prob2) ?>%</div>
            </div>
            
            <p><strong>Dettagli Statistici:</strong></p>
            <ul style="line-height: 1.6;">
                <li>Efficacia Attacco <?= $squad1 ?>: <strong><?= number_format($pote1, 2) ?></strong></li>
                <li>Efficacia Attacco <?= $squad2 ?>: <strong><?= number_format($pote2, 2) ?></strong></li>
                <li>Frequenza Vittorie <?= $squad1 ?>: <?= round(frequenzaRelativa($squad1, $conn) * 100) ?>%</li>
                <li>Frequenza Vittorie <?= $squad2 ?>: <?= round(frequenzaRelativa($squad2, $conn) * 100) ?>%</li>
            </ul>
        </div>
    <?php } ?>

</body>
</html>