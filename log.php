<?php
  try
  {
  $pdo=new PDO('mysql:dbname=chat;host=127.0.0.1','root','pass');
  }catch(PDOExepetion $e)
  {
    exit('データベースに接続できませんでした'.$e->getMessage());
  }
  $stmt=$pdo->query('SET NAMES utf8');
  if(!$stmt)
  {
    $info=$pdo->errorInfo();
    exit($info[2]);
  }
  //最新の8件を表示
  $stmt=$pdo->query('SELECT*FROM chat WHERE id>(SELECT MAX(id) FROM chat)-8');
  if(!$stmt)
  {
    $info =$pdo->errorInfo();
    exit($info[2]);
  }
  while($data=$stmt->fetch(PDO::FETCH_ASSOC))
  {
    echo $data['id']."---".$data['date']."<br>".$data['log']."<br>";
  }
  $pdo =null;
  ?>
