<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_6-2 ログイン</title>
</head>

<body>

<span style = "font-size : 50px;">今日の夕食なーんだ？？</span> <br>

<?php
    $dsn = 'mysql:dbname=***;host=localhost';
	$user = '***';
	$password = 'PASSWORD';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $sql = "CREATE TABLE IF NOT EXISTS user_table"
    ." ("
    . "user_id INT AUTO_INCREMENT PRIMARY KEY,"
    . "user_name char(32),"
    . "login_password char(32)"
    .");";
    $stmt = $pdo->query($sql);

    $message = "";

    //ログイン
    if(isset($_POST['user_id'])){
        $user_id = $_POST['user_id'];
        $login_password = $_POST['login_password'];
        if($user_id == ""){//ユーザーIDが空白
            $message = "ユーザーIDを入力してください";
        }elseif($login_password == ""){//パスワードが空白
            $message = "パスワードを入力してください";
        }else{
            $sql = 'SELECT * FROM user_table WHERE user_id=:user_id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id2, PDO::PARAM_INT);
            $user_id2 = $user_id;
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $result) {
                $result_id = $result["user_id"];
                $result_password = $result["login_password"];
            }
            if($login_password != $result_password){//パスワードが違う
                $message = "パスワードが無効です";
            }else{
                header("Location: https://tb-220862.tech-base.net/mission_6-2_upload.php");
                exit;
            }
        }
    }


    ?>

【 ログイン 】<br>
    <form action="" method="post">
       ユーザーID： 　<input type="num" name="user_id"> <br>
       パスワード：　 <input type="password" name="login_password"> <br>
        <input type="submit" name="submit" value = "ログイン">
    </form>
    <br>


 新規登録は   <a href = "https://tb-220862.tech-base.net/mission_6-2_registration.php" target = "_blank">こちら</a>
 <br>
 <br>
 
 <?php
    if($message != ""){
    echo $message;
    }
    ?>