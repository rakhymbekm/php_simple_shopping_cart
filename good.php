<?php

$img_src = "";

require_once "db.php";

$pdo = connect();

try {

  if ($pdo) {
    if (!array_key_exists('id', $_GET)) {
      die("Request should contain an id of a product");
    }

    $row = request($pdo, 'SELECT * FROM goods WHERE id = ' . $_GET['id']);

    if ($row) {
      echo '<br>';
      $img_src = $row['illustration_path'];

      $content = '<tr>';
      $content .= '<td>';
      $content .= $row['name'];
      $content .= '<form id="form'.$row['id'].'"';
      $content .= ' action="cart_handler.php"';
      $content .= ' method="POST">';
      $content .= '<input type="hidden"';
      $content .= ' name="goodname"';
      $content .= ' value="'.$row['name'].'">';
      $content .= '</td>';
      $content .= '</form>';
      $content .= '';
      $content .= '<td>'.$row['price'];
      $content .= '<input form="form'.$row['id'].'"';
      $content .= 'type="hidden"';
      $content .= ' name="goodprice"';
      $content .= ' value="'.$row['price'].'">';
      $content .= '</td>';
      $content .= '<td>'.$row['description'].'</td>';
      $content .= '<td>';
      $content .= '<input form="form'.$row['id'].'"';
      $content .= 'type="hidden"';
      $content .= ' name="goodid"';
      $content .= ' value='.$row['id'].'>';
      $content .= '<input form="form'.$row['id'].'"';
      $content .= ' type="hidden"';
      $content .= ' name="from"';
      $content .= ' value='.$_SERVER['REQUEST_URI'].'>';
      $content .= '<input form="form'.$row['id'].'"';
      $content .= ' type="submit"';
      $content .= ' value="Себетке салу">';
      $content .= '</td>';
      $content .= '</tr>';
    }
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}
?>

<!DOCTYPE html>

<html>

<head>

  <title>Product page</title>

  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width,initial-scale=1" />

  <meta name="description" content="" />

</head>

<body>
    <p><a href="/catalog.php">Products catalog</a></p>
    <p><a href="/cart.php">Cart</a></p>
    <h1>Product page</h2>
    <p><img width="300" height="300" src="<?= $img_src ?>" alt="Product illustration"></p>
    <table>
        <thead>
        <tr>
          <th>Product name</th>
          <th>Price</th>
          <th>Description</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $content ?>
    </tbody>
  </table>
</body>

</html>
