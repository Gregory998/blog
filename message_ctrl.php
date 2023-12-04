<?php
    $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");


    if ( !empty($_POST['title']) && !empty($_POST['subtitle']) && !empty($_POST['content']) ) {

        $sql = "INSERT INTO message ( title, subtitle, content, like_msg) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['title'], $_POST['subtitle'], $_POST['content'], 0]);
        header("Location:index.php?message=Message ajouté&status=text-success");
        die();
    }else {
        header("Location:index.php?message=Veuillez remplir le formulaire correctement&status=text-danger");
        die();
    }



