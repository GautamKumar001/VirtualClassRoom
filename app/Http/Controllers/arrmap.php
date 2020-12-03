<?php
$func=function($arr,$arr1)
{
      return [$arr=>$arr1];
};
$arr2=[1,2,3,4,5,6,7,8];
$arr3=["one","two","three","four","five","six","seven","eight"];
//print_r(array_map($func,$arr2,$arr3));
$mapedarr=array_map($func,$arr2,$arr3);

print_r($mapedarr[1][2]);
?>
