<?php

// ログの表示
ini_set('log_errors','On');
ini_set('error_log','php.log');


// （2）post送信されているかemptyでチェック
if(!empty($_POST['username'])){
    print_r($_POST);

  //（3）post情報を変数に入れる 　　
  $username = $_POST['username'];
  $email = $_POST['email'];

//
 try{
     // （4）DBへ接続の準備
  $dsn = 'mysql:dbname=user;host=localhost;charset=utf8mb4';
  $user = 'root';
  $password = 'A-QVPpTF7v8M';
  $options = array(
    // SQL実行失敗時には例外をスローしてくれる
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // カラム名をキーとする連想配列で取得する．これが一番ポピュラーな設定
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
    // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,);

    // （5）PDOオブジェクトを生成してDBへ接続
    $dbh = new PDO($dsn,$user,$password,$options);

    // （6）SQL文の作成：usersテーブルに名前情報を登録する。
    $sql = 'INSERT INTO users　(name,email) VALUES　(:user_name,:email)';
    echo $sql;
    // （7）prepareメソッドを使ってSQLへ接続準備
    $stmt = $dbh->prepare($sql);

    // （8）SQLの実行:executeメソッドでプレースホルダに値をセット
    $stmt->execute(array(
      ':user_name' => $username,
      ':email' => $email
    ));


  }catch(Exception $e){
    echo "エラー";
    error_log('エラーが発生しました：' .$e->getMessage());
  }

  }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>php：プレースホルダ</title>
</head>
<body>

<section class="main">

<form action="" method="post" class="form-container">
<!-- （1）formタグからpost送信 -->
<label for="" class="label-username">お名前：</label>
<input type="text" name="username" class="input-username" placeholder="お名前">
<label for="" class="label-username">メール：</label>
<input type="text" name="email" class="input-email" placeholder="メール">
<input type="submit" class="btn" value="送信する">

</form>


</section>

</body>
</html>