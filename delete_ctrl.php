<?php 

$pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");
 

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM message WHERE id= $id";
    $stmt = $pdo->prepare($sql);
    if ( $stmt->execute() ) {
        $regen = regenerateMessage();
        $response = [
            "id" => $id,
            "message" => "Tous s'est bien passé !!",
            "regen" => $regen
        ];
    }else {
        $response = [ 
            "message" => "Erreur lors de la suppression du message, WHESH !!",
        ];
    }
    echo json_encode($response);
}


function regenerateMessage() {
    $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");
    $sql = "SELECT * FROM message";
    $stmt = $pdo->query($sql);
    $messages = $stmt->fetchall(PDO::FETCH_ASSOC);
    $mess = "";

    foreach ($messages as $message) {
        $mess .= "<div class='card text-center my-2' style='width: 18rem;'>";
        $mess .= "<div class='card-body'>";
        $mess .= "<h5 class='card-title'>" . htmlentities($message['title']) ."</h5>";
        $mess .= "<h6 class='card-subtitle mb-2 text-body-secondary'>" . htmlentities($message['subtitle']) ."</h6>";
        $mess .= "<p class='card-text'>" . htmlentities($message['content']) ."</p>";
        $mess .= "<button class='btn btn-danger delete' data-id='" . htmlentities($message['id']) . "'>Supprimer message " . htmlentities($message['id']) . "</button>";
        $mess .= "</div>";
        $mess .= "</div>";
    }
      
    return $mess;
}
?>
