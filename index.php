<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog qui sa mère</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
  <body>
 
  <?php 
  if ( isset($_GET['message']) && isset($_GET['status'])) {
    echo "<h2 class='$_GET[status] text-center'>$_GET[message]</h2>";
  }
  
  $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "");

  $sql = "SELECT * FROM message";
  $stmt = $pdo->query($sql);
  ?>

<div  class="d-flex flex-column justify-content-center align-items-center">

<div class="text-center fixed-bottom w-25 border rounded p-2 bg-white">
        <form action="message_ctrl.php" method="post">

        <label for="title" class="form-label">Votre Titre</label>
        <input class="form-control" type="text" name="title">

        <label for="subtitle" class="form-label">Votre sous titre</label>
        <input class="form-control" type="text" name="subtitle">
            
        <label for="content" class="form-label">Votre message</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="3"></textarea>

        <input class="btn btn-primary my-4" type="submit" value="Envoyer">
        </form>
    </div>

<div id="message-container">
<?php 
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
  <div class="card text-center my-2" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title"><?= htmlentities($row['title']) ?></h5>
      <h6 class="card-subtitle mb-2 text-body-secondary"><?= htmlentities($row['subtitle']) ?></h6>
      <p class="card-text"><?= htmlentities($row['content']) ?></p>
      <!-- data-id => pour le récupérer nous devons faire  "NOM DE L'ELEMENT.dataset.NOM DU DATA" -->
      <!-- exemple dans <p data-quantity="7"></p>  ==> pour le récuperer en js cela donnera  p.dataset.quantity-->
      <button class="btn btn-danger delete" data-id="<?= htmlentities($row['id']) ?>">Supprimer message <?= htmlentities($row['id']) ?></button>
      <button class="btn btn-danger like" data-id="<?= htmlentities($row['msg_like']) ?>">❤️‍🔥 <?= htmlentities($row['msg_like']) ?><span id="msglike"></span></button>
    </div>
  </div>

<?php }?>
</div>




</div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="main.js"></script>
  </body>
</html>