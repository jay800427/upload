<?PHP
    // $file=fopen("text.txt","w");//創建一個hello.txt的檔案

    // $str="hello world! \r\ntoday is a good day,very good day12";//設定一個字串

    //把99乘法表寫入到一個文件黨裡面
    // $str="";
    // for($i=1;$i<=9;$i++){
    //     for($j=1;$j<=9;$j++){
    //         $str=$str. $i."*".$j."=".($i*$j)."\r\n";
            
    //     }
    // }
    //把亂數寫入到一個文件黨裡面
    $file=fopen("etax.csv","w");//創建一個etax.csv的檔案(此檔案可以用excel開啟)
    $str="";//非文件檔案，起始都要給它一個空值
    for($i=0;$i<100;$i++){//跑100次
        $num=rand(10000000,9999999);//範圍在10000000~9999999的隨機亂數
        $month=rand(1,12);//範圍在1~12的隨機數字
        $str=$str.$num.",".$month."\r\n";//印出上面的隨機亂數，中間要用","分開，否則excel開起來不會分隔開來
    }
    fwrite($file,$str);//在hello.txt這個檔案裡寫入剛剛的字串

    fclose($file);
?>