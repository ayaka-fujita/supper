<?php

    $dsn = 'mysql:dbname=***;host=localhost';
	$user = '***';
	$password = 'PASSWORD';
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


    if(!isset($_POST["user_name"])){
        echo "post not found";
    }
    else{
        $user_name = $_POST["user_name"];
        $menu = $_POST["menu"];
        $comment = $_POST["comment"];
    }

    if(!isset($_FILES["image1"])){
        echo "image1 not found";
        require_once("./mission_6-2_view.php");
    }
    if(!isset($_FILES["image2"])){
        echo "image2 not found";
        require_once("./mission_6-2_view.php");
    }
    if(!isset($_FILES["image3"])){
        echo "image3 not found";
        require_once("./mission_6-2_view.php");
    }

    // 画像データの入った配列の取得
    $image1 = $_FILES["image1"];
    $image2 = $_FILES["image2"];       
    $image3 = $_FILES["image3"];

    // supper_tableテーブルの総カラム数取得
    $sql = $pdo -> prepare("SELECT count(*) AS 'column' FROM supper_table;"); 
    $sql -> execute();

    // SQLの実行結果を取得
    while ($row = $sql->fetch()) {
        $max_id = (int)$row['column'];
        $max_id_plus_one = $max_id + 1;
    }

    // 画像パスを格納する配列に値を格納
    $image_path = array();
    array_push($image_path, "./image/image" . $max_id_plus_one . "-1.jpg");
    array_push($image_path, "./image/image" . $max_id_plus_one . "-2.jpg");
    array_push($image_path, "./image/image" . $max_id_plus_one . "-3.jpg");

    // 画像データの一時保存名を変更
    move_uploaded_file($image1["tmp_name"] , $image_path[0]);
    move_uploaded_file($image2["tmp_name"] , $image_path[1]);
    move_uploaded_file($image3["tmp_name"] , $image_path[2]);

    // 日付時間取得
    $date = date('Y/m/d h:i:s');
    
    //SQL文組み立て
    $sql = $pdo -> prepare("INSERT INTO supper_table (user_name, menu, comment, image1, image2, image3, date) VALUES (:user_name, :menu, :comment, :image1, :image2, :image3, :date)");

    // 配列に置き換え文字列を格納
    $param = array();
    array_push($param, $user_name);
    array_push($param, $menu);
    array_push($param, $comment);
    array_push($param, $image_path[0]);
    array_push($param, $image_path[1]);
    array_push($param, $image_path[2]);
    array_push($param, $date);

    // 文字列置き換え
    $sql -> bindParam(':user_name', $param[0], PDO::PARAM_STR);
    $sql -> bindParam(':menu', $param[1], PDO::PARAM_STR);
    $sql -> bindParam(':comment', $param[2], PDO::PARAM_STR);
    $sql -> bindParam(':image1', $param[3], PDO::PARAM_STR);
    $sql -> bindParam(':image2', $param[4], PDO::PARAM_STR);
    $sql -> bindParam(':image3', $param[5], PDO::PARAM_STR);
    $sql -> bindParam(':date', $param[6], PDO::PARAM_STR);

    // SQL文実行
    $sql -> execute();

    echo "<hr>";
        
    require_once("./mission_6-2_view.php");

    