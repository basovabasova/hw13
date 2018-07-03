<?php

require_once 'core.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>to-do list</title>
  <style>
    table { 
        border-spacing: 0;
        border-collapse: collapse;
    }

    table td, table th {
        border: 1px solid #ccc;
        padding: 5px;
    }
    
    table th {
        background: #eee;
    }
</style>
</head>
<body>
  <h1>Список дел на сегодня</h1>
  
  <?php if (isset($_GET['edit'])) { ?>
    <form method="POST">
      <input type="text" name="description" placeholder="Описание задачи">
      <input type="submit" name="save1" value="Изменить задачу"><br><br>
    </form>  
  <?php } else { ?>
    <form method="POST">
      <input type="text" name="description" placeholder="Описание задачи">
      <input type="submit" name="save" value="Добавить задачу"><br><br>
    </form>
  <?php } ?>
 
  <table>
    <tr>
      <th>Описание задачи</th>
      <th>Дата добавления</th>
      <th>Статус</th>
      <th></th>
    </tr>

    <?php foreach ($statement as $task): ?>
      <tr>
        <td><?php echo htmlspecialchars($task['description']) ?></td>
        <td><?php echo htmlspecialchars($task['date_added']) ?></td>
        <?php echo htmlspecialchars($task['is_done']) ? '<td style="color: green">Выполнено</td>' : '<td style="color: orange">В процессе</td>' ?>
        <td>
          <a href="?edit=<?=$task['id']?>">Изменить</a>
          <a href="?done=<?=$task['id']?>">Выполнить</a>
          <a href="?delete=<?=$task['id']?>">Удалить</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>  
</body>
</html>