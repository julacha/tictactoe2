<link rel="stylesheet" href="style.css">



<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'DB.php';
$game = new DB('tictactoe');
?>

<?php if (array_key_exists('game-id', $_REQUEST) && (int) $_REQUEST['game-id'] > 0) {
  $id = (int) $_REQUEST['game-id'];

  if (array_key_exists('r', $_REQUEST) && array_key_exists('c', $_REQUEST)) {
    $c = (int) $_REQUEST['c'];
    $r = (int) $_REQUEST['r'];
    echo $c . " r: " . $r;
    if ($c >= 1 && $c <= 3 && $r >= 1 && $r <= 3) {
      $game->update($id, [
        "c{$c}r{$r}" => "IF(`next-to-move` = 0, 2, 1)",
        "`next-to-move`" => "IF(`next-to-move` = 0, 1, 0)"
      ]);
    }
    header("location: /?game-id=$id");
  }

  $board = $game->get($id);

?>
  <div class="container">

    <?php
    for ($r = 1; $r <= 3; $r++) :
      for ($c = 1; $c <= 3; $c++) :
        if ($board["c{$c}r{$r}"] == 2) {
          $value = "X";
        } else {
          $value = $board["c{$c}r{$r}"] == 1 ? "O" : "";
        }
    ?>

        <a href="?c=<?= $c ?>&r=<?= $r ?>&game-id=<?= $id; ?>"><?= $value; ?></a>
    <?php
      endfor;
    endfor;
    ?>

  </div>

<?php } else { ?>
  <a class="btn" href="startgame.php">start game</a>


<?php
  $game->getAll();
}
?>