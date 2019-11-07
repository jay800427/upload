<?php
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */

 //如果不想用POST的判斷來寫可以用，(!empty($_FILES) && $_FILES['img']['error']==0)，這樣底下即使沒有type="text"也可以做到上傳的判斷(就純粹對檔案做上傳)
 if(!empty($_POST)){//用$_POST來判斷，底下的類型至少要是"text"，或是"submit"，否則值還是有上傳，但是不會有東西
    echo  "有POST的資料<br>";
    echo $_FILES['img']['error'];//顯示錯誤資訊
    echo "<br>";
    echo $_FILES['img']['tmp_name'];//上傳檔案後的暫存資料夾位置(前面的['img']是你檔案路徑下的資料夾名稱)
    echo "<br>";
    echo $_FILES['img']['type'];//上傳檔案的類型
    echo "<br>";
    echo $_FILES['img']['size'];//上傳檔案的尺寸
    echo "<br>";
    move_uploaded_file($_FILES['img']['tmp_name'],"./img/".$_FILES['img']['name']);//搬移檔案到該img的路徑底下
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案上傳</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <h1 class="header">檔案上傳練習</h1>
 <!----建立你的表單及設定編碼----->
 <form action="upload.php" method="post" enctype="multipart/form-data">
  檔案：<input type="file" name="img"><br><!--可以多筆檔案上傳，但是名稱要更改-->
  說明: <input type="text" name="desc"><br>
  <input type="submit" value="上傳">
</form>




<!----建立一個連結來查看上傳後的圖檔---->  
<br><br>
<a href="./img/">查看上傳的檔案</a>


</body>
</html>