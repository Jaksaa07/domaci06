<?php
    include 'db.php';

    (isset($_POST['grad_id']) && $_POST['grad_id'] != "") ? $grad_id = $_POST['grad_id'] : header("location: new.php?msg=err1");
    (isset($_POST['tip_oglasa_id']) && $_POST['tip_oglasa_id'] != "") ? $tip_oglasa_id = $_POST['tip_oglasa_id'] : header("location: new.php?msg=err2");
    (isset($_POST['tip_nekretnine_id']) && $_POST['tip_nekretnine_id'] != "") ? $tip_nekretnine_id = $_POST['tip_nekretnine_id'] : header("location: new.php?msg=err3");
    (isset($_POST['povrsina']) && $_POST['povrsina'] != "") ? $povrsina = $_POST['povrsina'] : header("location: new.php?msg=err4");
    (isset($_POST['cijena']) && $_POST['cijena'] != "") ? $cijena = $_POST['cijena'] : header("location: new.php?msg=err5");
    (isset($_POST['godina_izgradnje']) && $_POST['godina_izgradnje'] != "") ? $godina_izgradnje = $_POST['godina_izgradnje'] : header("location: new.php?msg=err6");
    (isset($_POST['opis']) && $_POST['opis'] != "") ? $opis = $_POST['opis'] : header("location: new.php?msg=err7");

    $insert = "INSERT INTO nekretnine (grad_id, tip_oglasa_id, tip_nekretnine_id, povrsina, cijena, godina_izgradnje, opis)
                VALUES ($grad_id, $tip_oglasa_id, $tip_nekretnine_id, $povrsina, $cijena, $godina_izgradnje, '$opis')";

    $pdo->exec($insert);

    header("location: index.php?msg=success");
?>

