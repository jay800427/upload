<?php
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳檔案機制
 * 3.取得檔案資源
 * 4.取得檔案內容
 * 5.建立SQL語法
 * 6.寫入資料庫
 * 7.結束檔案
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文字檔案匯入</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="header">文字檔案匯入練習</h1>
<!---建立檔案上傳機制--->



<!----讀出匯入完成的資料----->
<!--實行步驟:
1.先建立資料庫連結
2.讀取你專案底下的一個檔案(範例用csv檔案)
    *語法:fopen("某資料","r")
3.讀取上述資料的每一筆
    *





-->
<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=etx";
$pdo=new PDO($dsn,"root","");
$file=fopen("台灣糖業公司_近5年退休人數.csv","r");//讀取"台灣糖業公司_近5年退休人數.csv"的這個檔案
$line=fgets($file);//從第一行開始讀起，但不處理第一行的資料
while(!feof($file)){

$line=fgets($file);//從第二行開始讀起
// echo $line;
// echo "<br>";
$data=explode(",",$line);//此時會把上面的字串用,隔開，產生出來的是一個陣列
// print_r($data);//陣列要用print_r()來印
// echo "<br>";
if(count($data)>1){//如果這個陣列數量大於一的話
    $sql="INSERT INTO `retire`(`id`, `year`, `num`, `pro`) VALUES ('',".$data[0].",".$data[1].",".$data[2].")";
    $pdo->exec($sql);
              }
}
?>

</body>
</html>