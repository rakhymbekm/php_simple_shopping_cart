<?php
session_start();
$content = '';
$total = 0;

if (array_key_exists("goods", $_SESSION) && count($_SESSION["goods"]) > 0) {
  foreach($_SESSION["goods"] as $id => $good) {
    $content .= '<tr>';
    foreach($good as $column => $row) {
      if ($column === 'name') {
        $content .= '<td>';
        $content .= '<form id="form'.$id.'"';
        $content .= ' action="/cart_handler.php"';
        $content .= ' method="POST">';
        $content .= '<a href="/good.php?id=';
        $content .= $id.'">'.$row.'</a>';
        $content .= '<input type="hidden" name="goodname" value="';
        $content .= $row.'">';
        $content .= '<input type="hidden" name="off" ';
        $content .= 'value="true">';
        $content .= '</form>';
        $content .= '</td>';
      }

      if ($column === 'price') {
        $total += intval($row);
        $content .= '<td>'.$row;
        $content .= '<input form="form'.$id.'"';
        $content .= ' type="hidden"';
        $content .= ' name="goodprice" value="';
        $content .= $row.'"></td>';
        $content .= '<td>';
        $content .= '<input form="form'.$id.'" type="hidden" ';
        $content .= 'name="goodid" value='.$id.'>';
        $content .= '<input form="form'.$id.'"';
        $content .= ' type="hidden" name="from"';
        $content .= ' value="'.$_SERVER['REQUEST_URI'].'">';
        $content .= '<input form="form'.$id.'"';
        $content .= ' type="submit" value="Себеттен алу">';
        $content .= '</td>';
      }

      
    }
    $content .= '</tr>';
  }
}
?>

<!DOCTYPE html>

<html>

<head>

  <title>Себет беті</title>

  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width,initial-scale=1" />

  <meta name="description" content="" />

</head>

<body>
    <p><a href="/catalog.php">Тауарлар каталогі</a></p>
    <h1>Себет</h1>
    <table>
        <thead>
        <tr>
          <th>Тауар аты</th>
          <th>Тауар бағасы</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $content ?>
    </tbody>
  </table>
  <p>Төлемге: <?=$total?>&#8376;</p>
</body>

</html>