<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_6-2 新規登録</title>
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

    if(isset($_POST['user_name'])){
        $user_name = $_POST['user_name'];
        $login_password = $_POST['login_password'];
        if($user_name == ""){//名前が空白
            $message = "名前を入力してください";
        }elseif($login_password == ""){//パスワードが空白
            $message = "パスワードを入力してください";
        }else{
            $sql = $pdo -> prepare("INSERT INTO user_table (user_name, login_password) VALUES (:user_name, :login_password)");//データ入力
            $sql -> bindParam(':user_name', $user_name2, PDO::PARAM_STR);
            $sql -> bindParam(':login_password', $login_password2, PDO::PARAM_STR);
            $user_name2 = $user_name;
            $login_password2 = $login_password; 
            $sql -> execute();
            echo "<hr>";
            
            
            $sql = 'SELECT * FROM user_table WHERE user_name=:user_name';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_name', $user_name3, PDO::PARAM_INT);
            $user_name3 = $user_name;
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $result) {
                $user_id = $result["user_id"];
                $user_name = $result["user_name"];
            }
            $message = "登録が完了しました" . "<br>" . "<br>" . "ユーザーID：" . $user_id . "<br>" . "ユーザー名：" . $user_name . "<br>";
        }
    }

    ?>

【 新規登録 】<br>
    <form action="" method="post">
       ユーザー名： 　<input type="text" name="user_name"> <br>
       パスワード：　 <input type="password" name="login_password"> <br>
        <input type="submit" name="submit" value = "登録">
    </form>
    <br>

    <?php
    if($message != ""){
    echo $message;
    }
    ?>