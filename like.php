
<?php
$pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");

if (isset($_POST['like_msg']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql_like = "SELECT like_msg FROM message WHERE id = $id"; 
    $stmt_like = $pdo->query($sql_like);

    $nbrLike = $stmt_like->fetch(PDO::FETCH_ASSOC);

    if (is_array($nbrLike)) {
        $like = $nbrLike['like_msg'];
        $newQuantityL = $like + $_POST['like_msg'];

        $sqlL = "UPDATE message SET like_msg = $newQuantityL WHERE id = $id";
        $stmtL = $pdo->prepare($sqlL);

        if ($stmtL->execute()) {
            $response = [
                "message" => "Succès!",
                "newQuantityLike" => $newQuantityL
            ];
        } else {
            $response = [
                "message" => "Erreur lors de la mise à jour de la base de données."
            ];
        }
    } else {
        $response = [
            "message" => "Erreur interne dans la base de données."
        ];
    }


    echo json_encode($response);
    exit();
}
