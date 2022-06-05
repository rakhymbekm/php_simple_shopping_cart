<?php
  function redirect() {
    header('Location: ' . $_POST['from']);
  }
  session_start();

  if (!$_POST['from']) {
    die("Request shoud countain the from parameter");
  }

  if ( array_key_exists("goodname", $_POST) 
    && array_key_exists("goodprice", $_POST) 
    && array_key_exists("goodid", $_POST) ) {

    if (!array_key_exists('goods', $_SESSION)) {
      $_SESSION["goods"][$_POST["goodid"]] = [
        'name' => $_POST["goodname"],
        'price'=> $_POST["goodprice"]
      ];
      redirect();
    }

    if (!array_key_exists($_POST["goodid"], $_SESSION["goods"])) {
      $_SESSION["goods"][$_POST["goodid"]] = [
        'name' => $_POST["goodname"],
        'price'=> $_POST["goodprice"]
      ];
      redirect();
    }
    
    if (array_key_exists("off", $_POST)) {
      if (filter_var($_POST["off"], FILTER_VALIDATE_BOOLEAN)) {
        unset($_SESSION["goods"][$_POST["goodid"]]);
      }
    }
    redirect();       
  }
  var_dump($_POST);
?>
