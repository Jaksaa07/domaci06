<?php
    include 'db.php';

    $where_arr = [];
    $where_arr[] = " 1 = 1 ";

    if ( isset($_GET['grad_id']) && $_GET['grad_id'] != "" ) {
        $grad_id = $_GET['grad_id'];
        $where_arr[] = " g.id = " . $_GET['grad_id'] . " ";
    }
    if ( isset($_GET['tip_oglasa_id']) && $_GET['tip_oglasa_id'] != "" ) {
        $tip_oglasa_id = $_GET['tip_oglasa_id'];
        $where_arr[] = " tipo.id = " . $_GET['tip_oglasa_id'] . " ";
    }
    if ( isset($_GET['tip_nekretnine_id']) && $_GET['tip_nekretnine_id'] != "" ) {
        $tip_nekretnine_id = $_GET['tip_nekretnine_id'];
        $where_arr[] = " tipn.id = " . $_GET['tip_nekretnine_id'] . " ";
    }
    if ( isset($_GET['min_povrsina']) && $_GET['min_povrsina'] != "" ) {
        $min_povrsina = $_GET['min_povrsina'];
        $where_arr[] = " povrsina >= " . $_GET['min_povrsina'] . " ";
    }
    if ( isset($_GET['max_povrsina']) && $_GET['max_povrsina'] != "" ) {
        $max_povrsina = $_GET['max_povrsina'];
        $where_arr[] = " povrsina <= " . $_GET['max_povrsina'] . " ";
    }
    if ( isset($_GET['min_cijena']) && $_GET['min_cijena'] != "" ) {
        $min_cijena = $_GET['min_cijena'];
        $where_arr[] = " cijena >= " . $_GET['min_cijena'] . " ";
    }
    if ( isset($_GET['max_cijena']) && $_GET['max_cijena'] != "" ) {
        $max_cijena = $_GET['max_cijena'];
        $where_arr[] = " cijena <= " . $_GET['max_cijena'] . " ";
    }
    if ( isset($_GET['godina_izgradnje']) && $_GET['godina_izgradnje'] != "" ) {
        $godina_izgradnje = $_GET['godina_izgradnje'];
    }
    if ( isset($_GET['opis']) && $_GET['opis'] != "" ) {
        $opis = $_GET['opis'];
    }
    if ( isset($_GET['status']) && $_GET['status'] != "" ) {
        $status = $_GET['status'];
        $where_arr[] = " status = 1 ";
    }
    if ( isset($_GET['datum_prodaje']) && $_GET['datum_prodaje'] != "" ) {
        $datum_prodaje = $_GET['datum_prodaje'];
    }

    $where_str = implode("AND", $where_arr);

    $stmt = $pdo->prepare("SELECT *, g.ime AS ime_grada, tipo.ime AS tip_oglasa, tipn.ime AS tip_nekretnine 
                            FROM `nekretnine` 
                            LEFT JOIN `gradovi` g ON grad_id = g.id 
                            LEFT JOIN `tipovi_oglasa` tipo ON tip_oglasa_id = tipo.id 
                            LEFT JOIN `tipovi_nekretnine` tipn ON tip_nekretnine_id = tipn.id
                            WHERE $where_str");
    
    // var_dump($stmt);
    // exit();
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domaci 06</title>
    <link rel="stylesheet" href="./index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="table">
        <h2 class="title">Nekretnine: </h2>
        <table>
            <thead>
                <tr>
                    <th>Grad</th>
                    <th>Tip oglasa</th>
                    <th>Tip nekretnine</th>
                    <th>Povrsina</th>
                    <th>Cijena</th>
                    <th>Godina izgradnje</th>
                    <th>Opis</th>
                    <th>Status</th>
                    <th>Datum prodaje</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($stmt->fetchAll() as $row) {
                        $id_temp = $row['id'];
                        $row['status'] ? $st = "prodato" : $st = "dostupno";
                        $link1 = "./edit.php?id=$id_temp";
                        $link2 = "./delete.php?id=$id_temp";
                        $link3 = "./details.php?id=$id_temp";
                        echo "<tr>"; 
                        echo "  <td>" . $row['ime_grada'] . "</td>";
                        echo "  <td>" . $row['tip_oglasa'] . "</td>";
                        echo "  <td>" . $row['tip_nekretnine'] . "</td>";
                        echo "  <td>" . $row['povrsina'] . "</td>";
                        echo "  <td>" . $row['cijena'] . "</td>";
                        echo "  <td>" . $row['godina_izgradnje'] . "</td>";
                        echo "  <td>" . $row['opis'] . "</td>";
                        echo "  <td>" . $st . "</td>";
                        echo "  <td>" . $row['datum_prodaje'] . "</td>";
                        echo "  <td><a href='$link1'><img src='edit.svg' /></a></td>";
                        echo "  <td><a href='$link2'><img src='delete.svg' /></a></td>";
                        echo "</tr>";
                    }
                ?>
        </tbody>
        </table>
        <div class="buttons">
            <a class="btn btn-new" href="./new.php">Add new</a>
            <a class="btn btn-new" href="./index.php">Reset filters</a>
        </div>
    </div>
    <div class="form">
        <h2 class="title">Filters:</h2>
        <form action="./index.php" method="GET">
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

            <label for="min_povrsina">Minimalna povrsina:</label>
            <input type="text" name="min_povrsina" id="min_povrsina">
            <label for="max_povrsina">Maksimalna povrsina:</label>
            <input type="text" name="max_povrsina" id="max_povrsina">

            <label for="min_cijena">Minimalna cijena:</label>
            <input type="text" name="min_cijena" id="min_cijena">
            <label for="max_cijena">Maksimalna cijena:</label>
            <input type="text" name="max_cijena" id="max_cijena">

            <label for="status">Dostupno: </label>
            <input type="checkbox" name="status" id="status" value="dostupno">

            <input class="btn" type="submit">
        </form>
    </div>
</body>
</html>