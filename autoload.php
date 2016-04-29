<?php

function __autoload($classe) {
  include_once "classes/{$classe}.class.php";
}

$db = new DB();
$db->getConnection();

 ?>
