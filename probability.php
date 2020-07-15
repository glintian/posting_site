<?php 
$e = 0.9 ** 4;
// echo $e;
$row = 5;
$testnum = 50000;
$i = 0;
$result = [];
do{
$var = random_int(1, 2);
array_push($result, $var);
$i += 1;
}while ($i <= $testnum);
$odd = [];
$even = [];
echo(count($result));
for ($i = 0; $i <= $testnum - $row - 1; $i++){
    // echo $i . "<br>";
    if (!in_array(2, array_slice($result, $i, $row))){
        array_push($odd, $result[$i + $row + 1]); 
    }

    if (!in_array(1, array_slice($result, $i, $row))){
        array_push($even, $result[$i + $row + 1]);
    }
}
sort($result);
var_dump(1 - (array_search(2, $result)) / count($result));
echo "<br>";
sort($odd);
//連続1の後に２が出る確率
var_dump(1 - (array_search(2, $odd)) / count($odd));
sort($even);
//連続2の後に1が出る確率
var_dump((array_search(2, $even)) / count($even));

//ルーレットで偶数が５回続いてもその次に偶数が出る確率はやはり50%となる。

$temp = [2, 1, 2, 1, 2, 1, 2, 1, 1, 1];
sort($temp);
var_dump($temp);
var_dump(1- (array_search(2, $temp)) / count($temp));

