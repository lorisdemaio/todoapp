<?php
    include '../config.php';
    
    $id_task = $_POST['id_task'];

    $ql = "UPDATE task SET stato = 'completata' WHERE id = '$id_task'";
    if($conn->query($ql))
    {
        header("Location: ./dashboard.php");
        exit();
    }
    else echo "<span style='color: red;'>Errore nel completamento del task: " . $conn->error . "</span>";
    
?>