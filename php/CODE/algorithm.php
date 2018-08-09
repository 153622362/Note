<?php
$arr = array(46,1,22,3,44,5,6,7,88,9);
//起泡算法
function mysort(&$arr)
{
	$len = count($arr);

	for ($i=0; $i < $len-1 ; $i++) { 
		for ($j=0; $j < $len-$i-1 ; $j++) { 
			if ($arr[$j] > $arr[$j+1]) {
				$tmp = $arr[$j];
				$arr[$j] = $arr[$j+1];
			}
		}
	}
}

// mysort($arr);
// var_dump($arr);

//二分排序、快速排序
function qsort($arr)
{
	if (!is_array($arr) || empty($arr)) {
		return [];
	}
	$len = count($arr);

	if ($len <=1) {
		return $arr;
	}
	$key = $arr[0];
	$left = [];
	$right = [];

	for ($i=1; $i < $len ; $i++) { 
		if ($arr[$i] <= $key) {
			$left[] = $arr[$i];
		}else{
			$right[] = $arr[$i];
		}
	}
	$left = qsort($left);
	$right=qsort($right);
	$key = [$key];
	return array_merge($left,$key,$right);
}
// var_dump(qsort($arr));

