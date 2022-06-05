<?php

$content = '';

require_once "db.php";

$pdo = connect();

try {
  if ($pdo) {
    $rows = request($pdo, 'SELECT * FROM goods', true);

    if ($rows) {
      foreach ($rows as $index => $row) {
        $content .= '<tr><td>';
        $content .= '<form id="form'.$index.'"';
        $content .= ' action="/cart_handler.php" method="POST">';
        $content .= '<a href="/good.php?id='.$row['id'].'">'.$row['name'];
        $content .= '</a><input type="hidden" name="goodname" value="';
        $content .= $row['name'].'">';
        $content .= '</form>';
        $content .= '</td>';
        $content .= '<td>'.$row['price'];
        $content .= '<input form="form'.$index.'"';
        $content .= ' type="hidden" name="goodprice" value="';
        $content .= $row['price'].'"></td>';
        $content .= '<td>';
        $content .= '<input form="form'.$index.'" type="hidden" ';
        $content .= 'name="goodid" value='.$row['id'].'>';
        $content .= '<input form="form'.$index.'" type="hidden" ';
        $content .= 'name="from" value='.$_SERVER['REQUEST_URI'].'>';
        $content .= '<input form="form'.$index.'" type="submit" ';
        $content .= 'value="Себетке салу">';
        $content .= '</td>';
        $content .= '</tr>';
      }
    }
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}
?>

<!DOCTYPE html>

<html>

<head>

  <title>Products catalog</title>

  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width,initial-scale=1" />

  <meta name="description" content="" />

</head>

<body>
    <p><a href="/cart.php">Cart</a></p>
    <table>
        <thead>
        <tr>
          <th>Product name</th>
          <th>Price</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $content ?>
    </tbody>
  </table>
</body>

</html>
