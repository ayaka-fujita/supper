<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<span style = "font-size : 50px;">今日の夕食なーんだ？？</span> <br>
    <p><?= $menu ?></p>
    <p><?= $comment ?></p>
    <p><?= $user_name ?></p>
    <p><img src = "<?= $image_path[0] ?>", height = "150", width = "150"></p>
    <p><img src = "<?= $image_path[1] ?>", height = "150", width = "150"></p>
    <p><img src = "<?= $image_path[2] ?>", height = "150", width = "150"></p>

    
    <form action = "mission_6-2_upload.php" method = "post">
        <button type = "submit" name = "return">入力に戻る</button>
    </form>
</body>
</html>