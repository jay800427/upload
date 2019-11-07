<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=upload";
$pdo=new PDO($dsn,"root","");
if(!empty($_FILES) && $_FILES['file']['error']==0){
    $type=$_FILES['file']['type'];
    $filename=$_FILES['file']['name'];
    $path="./upload/";
    $updateTime=date("Y-m-d H:i:s");//date("Y-m-d H:i:s")是系統預設時間
    $id=$_POST['id'];
    move_uploaded_file($_FILES['file']['tmp_name'] , $path . $filename);
    //刪除原本的檔案
    $sql="select * from files where id='$id'";//抓取這張(files)這張表單裡的所有id
    $origin=$pdo->query($sql)->fetch();//定義一個變數($origin)來抓取我要的id
    $origin_file=$origin['path'];//定義一個變數($origin_file)來抓取$origin裡的['path']
    unlink($origin_file);//unlink()刪除檔案
    //更新資料
    $sql="update files set name='$filename',type='$type',update_time='$updateTime',path='" . $path . $filename . "' where id='$id'";
    $result=$pdo->exec($sql);
    if($result==1){
        echo "更新成功";
        header("location:manage.php");//更新完直接跳回manage.php
    }else{
        echo "DB有誤";
    }
}
$id=$_GET['id'];
$sql="select * from files where id='$id'";
$data=$pdo->query($sql)->fetch();
?>
<form action="edit_file.php" method="post" enctype="multipart/form-data"><!--multipart/form-data 。 指定传输数据为二进制类型，比如图片、mp3、文件。-->
<table>
    <tr>
        <td colspan="2">
            <img src="<?=$data['path'];?>" style="width:200px;height:200px">
        </td>

    </tr>
    <tr>
        <td>name</td>
        <td><?=$data['name'];?></td>
    </tr>
    <tr>
        <td>path</td>
        <td><?=$data['path'];?></td>
    </tr>
    <tr>
        <td>type</td>
        <td><?=$data['type'];?></td>
    </tr>
    <tr>
        <td>create_time</td>
        <td><?=$data['create_time'];?></td>
    </tr>
</table>
更新檔案:<input type="file" name="file"><br>
<input type="hidden" name="id" value="<?=$data['id'];?>">
<input type="submit" value="更新">
</form>