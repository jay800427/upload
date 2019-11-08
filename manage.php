<?php
 $dsn="mysql:host=localhost;charset=utf8;dbname=upload";
 $pdo=new PDO($dsn,"root","");
/**
 * 1.建立資料庫及資料表來儲存檔案資訊
 * 2.建立上傳表單頁面
 * 3.取得檔案資訊並寫入資料表
 * 4.製作檔案管理功能頁面
 */
if(!empty($_FILES)&&$_FILES['file']['error']==0){
    $type=$_FILES['file']['type'];//上傳檔案的類型
    $filename=$_FILES['file']['name'];//上傳檔案的名子
    $note=$_POST['note'];
    $path="./upload/".$filename;
    move_uploaded_file($_FILES['file']['tmp_name'],$path);//搬移檔案到該file的路徑底下

   
    $sql="insert into files( `name`, `type`, `path`,`note`) values ('$filename','$type','$path','$note')";
   $result=$pdo->exec($sql);
   if($result==1){
       echo "上傳成功";
   }else{
       echo "DB有誤";
   }
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案管理功能</title>
    <link rel="stylesheet" href="style.css">
    <style>
    a{
        display:inline-block;
        border:1px solid #ccc;
        padding:5px 15px;
        border-radius: 20px;
        box-shadow: 1px 1px 3px #ccc;
    }
    </style>
</head>
<body>
<h1 class="header">檔案管理練習</h1>
<!----建立上傳檔案表單及相關的檔案資訊存入資料表機制----->
<form action="manage.php" method="post" enctype="multipart/form-data"><!--multipart/form-data 。 指定传输数据为二进制类型，比如图片、mp3、文件。-->
  檔案：<input type="file" name="file"><br>
  說明：<input type="text" name="note"><br>
  <input type="submit" value="上傳">
</form>


<!----透過資料表來顯示檔案的資訊，並可對檔案執行更新或刪除的工作----->
<table>
    <tr>
        <td>id</td>
        <td>name</td>
        <td>type</td>
        <td>縮圖</td>
        <td>path</td>
        <td>create time</td>
        <td>note</td>
        <td>操作</td>
    </tr>

    <?php
        $sql="select * from files";
        $rows=$pdo->query($sql)->fetchAll();
        foreach ($rows as $key => $file) {  
    ?>
    <tr>
        <td><?=$file['id'];?></td><!--給了一個變數叫$file並抓取資料庫裡的id-->
        <td><?=$file['name'];?></td>
        <td><?=$file['type'];?></td>
        <td><img src="<?=$file['path'];?>" style="width:100px;height:50px;"></td>
        <td><?=$file['path'];?></td>
        <td><?=$file['create_time'];?></td>
        <td><?=$file['note'];?></td>
        <td>
            <a href="edit_file.php?id=<?=$file['id'];?>">更新檔案</a>
            <a href="del_file.php?id=<?=$file['id'];?>">刪除檔案</a>
        
        </td>
    </tr>
   
    <?php
     }
    ?>

</table>



</body>
</html>