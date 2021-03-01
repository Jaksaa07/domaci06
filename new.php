<?php
    include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <title>Nova nekretnina</title>
</head>
<body>
    <div class="form">
        <form action="./add_new.php" method="POST">
            <label for="grad">Grad:</label>
            <select name="grad_id" id="grad">
                <option value>Izaberi grad</option>
                <?php
                    $gradovi = $pdo->prepare("SELECT * FROM gradovi");
                    $gradovi->execute();
                    $gradovi->setFetchMode(PDO::FETCH_ASSOC);
                    foreach($gradovi->fetchAll() as $grad) {
                        echo "<option value=" . $grad['id'] . ">" . $grad['ime'] . "</option>";
                    }
                ?>
            </select>
            <label for="tip_oglasa">Tip oglasa:</label>
            <select name="tip_oglasa_id" id="tip_oglasa">
                <option value>Tip oglasa</option>
                <?php
                    $tipovi_oglasa = $pdo->prepare("SELECT * FROM tipovi_oglasa");
                    $tipovi_oglasa->execute();
                    $tipovi_oglasa->setFetchMode(PDO::FETCH_ASSOC);
                    foreach($tipovi_oglasa->fetchAll() as $tip_oglasa) {
                        echo "<option value=" . $tip_oglasa['id'] . ">" . $tip_oglasa['ime'] . "</option>";
                    }
                ?>
            </select>
            <label for="tip_nekretnine">Grad:</label>
            <select name="tip_nekretnine_id" id="tip_nekretnine">
                <option value>Tip nekretnine</option>
                <?php
                    $tipovi_nekretnine = $pdo->prepare("SELECT * FROM tipovi_nekretnine");
                    $tipovi_nekretnine->execute();
                    $tipovi_nekretnine->setFetchMode(PDO::FETCH_ASSOC);
                    foreach($tipovi_nekretnine->fetchAll() as $tip_nekretnine) {
                        echo "<option value=" . $tip_nekretnine['id'] . ">" . $tip_nekretnine['ime'] . "</option>";
                    }
                ?>
            </select>

            <label for="povrsina">Povrsina:</label>
            <input type="number" name="povrsina" id="povrsina">

            <label for="cijena">Cijena:</label>
            <input type="number" name="cijena" id="cijena">

            <label for="godina_izgradnje">Godina izgradnje:</label>
            <input type="number" name="godina_izgradnje" id="godina_izgradnje">

            <label for="opis">Opis:</label>
            <input type="text" name="opis" id="opis">
            

            <input class="btn" type="submit">
        </form>
    </div>
</body>
</html>