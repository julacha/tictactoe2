<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'DB.php';

$game = new DB('tictactoe');

$id = $game->set([
    'c1r1' => '0',
    'c2r1' => '0',
    'c3r1' => '0',

    'c1r2' => '0',
    'c2r2' => '0',
    'c3r2' => '0',

    'c1r3' => '0',
    'c2r3' => '0',
    'c3r3' => '0',
    'next-to-move' => '0',
]);

if ($id > 0) {
    header("location: /?game-id=$id");
}
