<?php
//1. POSTデータ取得
$title = $_POST["title"];
$artist = $_POST["artist"];
$backnumber = $_POST["backnumber"];
$onairdate = $_POST["onairdate"];
$url = $_POST["url"];
$review = $_POST["review"];


//2. DB接続します
try {
  //最後の''内はPWですが、Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=ren_playlist;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DB_CONECT:'.$e->getMessage()); //どこがエラーになっているのかわかるように「DB_CONECT」だよと
}

//３．データ登録SQL作成
$sql = "INSERT INTO mzkpl_dajets(title,artist,backnumber,onairdate,url,review)VALUES(:title,:artist,:backnumber,:onairdate,:url,:review);";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':artist', $artist, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':backnumber', $backnumber, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':onairdate', $onairdate, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':review', $review, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //true or false

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>
