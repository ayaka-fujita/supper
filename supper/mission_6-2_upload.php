<?php

    $dsn = 'mysql:dbname=***;host=localhost';
	$user = '***';
	$password = 'PASSWPRD';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


    $sql = "CREATE TABLE IF NOT EXISTS supper_table"
	    ." ("
	    . "contribution_id INT AUTO_INCREMENT PRIMARY KEY,"
        . "user_name char(32),"
        . "menu TEXT," 
        . "comment TEXT,"
        . "image1 TEXT,"
        . "image2 TEXT,"
        . "image3 TEXT,"
        . "date TEXT"
	    .");";
    $stmt = $pdo->query($sql);
    
?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<span style = "font-size : 50px;">今日の夕食なーんだ？？</span> <br>

【 投稿 】<br>
    <form action="mission_6-2_function.php" method="post" enctype = "multipart/form-data">
        <ul>
            <li>ユーザー名：  <input type="text" value = "" name="user_name"></li>
            <li>メニュー：  <input type="text" value = "" name="menu"></li>
            <li>コメント： <input type="text" value = "" name="comment"></li>
            <li>写真1： <input type="file" value = "写真1" name="image1"></li>
            <li>写真2： <input type="file" value = "写真2" name="image2"></li>
            <li>写真3： <input type="file" value = "写真3" name="image3"></li>
        </ul>
        <input type="submit" name="submit" value = "送信">
    </form>
    <br>
    
</body>
</html>

<?php
//データの表示
    $sql = 'SELECT * FROM supper_table';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		echo $row['contribution_id'].',';
        echo $row['user_name'].',';
        echo $row['menu'].',';
        echo $row['comment'].'<br>';
	echo "<hr>";
    }
