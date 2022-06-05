<?php

require_once "db_config.php";

function connect() {
  try {
    $pdo = new PDO(DSN, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}

function request($pdo, $sql, $all = false) {
  $statement = $pdo->query($sql);
  if (!$all) {
    return $statement->fetch();
  }

  return $statement->fetchAll();
}