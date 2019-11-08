<?php
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳圖案機制
 * 3.取得圖檔資源
 * 4.進行圖形處理
 *   ->圖形縮放
 *   ->圖形加邊框
 *   ->圖形驗證碼
 * 5.輸出檔案
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
<h1 class="header">圖形處理練習</h1>
<!---建立檔案上傳機制--->



<!----縮放圖形----->
<?php
$imgSrc="car.png";
$imgInfo=getimagesize($imgSrc);
$rate=0.5;
//計算縮放後的大小
$dst_w=$imgInfo[0]*$rate;
$dst_h=$imgInfo[1]*$rate;

$abc=imagecreatetruecolor($dst_w,$dst_h);
echo $abc;
$src1=imagecreatefrompng($imgSrc);
echo $src1;
imagecopyresampled($abc,$src1,0,0,0,0,$dst_w,$dst_h,$imgInfo[0],$imgInfo[1]);
imagepng($abc,"abc.png");




$thm=imagecreatetruecolor(200,200);//創造一張200*200的圖片(預設是黑色)
$src=imagecreatefrompng("test.png");//從來源處選取一張圖片
imagecopyresampled($thm,$src,0,0,0,0,200,200,100,100);//重新取樣

imagepng($thm,"thm.png");//以png格式輸出到瀏覽器上面
$img=imagecreatetruecolor(100,100);
$bg=imagecreatetruecolor(50,50);

$background = imagecolorallocate($bg,255,0,0);
imagefill($bg,0,0,$background);
//imagecopymerge(來源圖片,目標圖片,來源圖片開始的X座標,來源圖片開始的Y座標,目標圖片開始的X座標,目標圖片開始的Y座標，目標圖片的寬,目標圖片的高,透明度)
imagecopymerge($img,$bg,25,25,0,0,50,50,100);

imagepng($img,"test.png");
imagepng($bg,"bg.png");
?>

<img src="test.png">
<img src="bg.png">
<img src="thm.png"><!--顯示這張圖片-->
<img src="car.png">
<img src="abc.png">
<!----圖形加邊框----->


<!----產生圖形驗證碼----->



</body>
</html>