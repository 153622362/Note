<?php
//反转字符串 strrev()
function strrev2($str = 'ngyhd')
{
	$n = '';
	$m = strlen($str) - 1;
	for ($i=$m; $i >= 0 ; $i--) { 
		$n .= $str[$i];
	}
	var_dump($n);exit;
	return $n;
}

//获取文件扩展名
function extname($filename = 'a.txt')
{
	$arr = explode('.',$filename);
	return array_pop($arr);
}

//获取文件2相对文件1的路径
function abspath($file1='/a/b/c/d.txt',$file2='/a/b/12/43/c.txt')
{
	$a = dirname($file1); // /a/b/c
	$b = dirname($file2); // /a/b/12/43/

	$a = trim($a, '/');	//  a/b/c
	$b = trim($b, '/');  // a/b/12/43

	$arr = explode('/',$a);
	$brr =	explode('/',$b);

	$num = max(count($arr), count($brr)); //比较大小

	for ($i=0; $i < $num ; $i++) { 
		if ($arr[$i] == $brr[$i]) {
			unset($arr[$i]);
			unset($brr[$i]);
		}else{
			break;
		}
	}

	$file1_arr = explode('/', $file1);
	$file1_name = array_pop($file1_arr);
	$path = str_repeat('../', count($brr)).implode('/',$arr).'/'.$file1_name;
	var_dump($path);exit;
	return $path;
}

set_error_handler('my_error'); //自定义错误处理
$message = '';
function my_error($error_type, $error_message, $error_file, $error_line)
{
	global $message;
	$message = "错误类型{$error_type},错误消息{$error_message},错误文件{$error_file},在{$error_line}行".PHP_EOL;
}
// gettype($a);
// echo '111';
// gettype();
// echo '222';
// echo $message;
// EXIT;

//日历
function calendar()
{
		//获取当前年月日
	$year = isset($_GET['year']) ? $_GET['year']: date('Y');
	$month = isset($_GET['month']) ? $_GET['month']: date('m');
	$day = isset($_GET['day']) ? $_GET['day']: date('d');

	$days = date('t', mktime(0, 0, 0, $month, 1, $year));

	$startweek = date('w', mktime(0, 0, 0, $month, 1, $year));

	echo '<table border="1" width="300" align="center">';
	echo '<tr>';
	echo '<th style="background:blue">日</th>';
	echo '<th style="background:blue">一</th>';
	echo '<th style="background:blue">二</th>';
	echo '<th style="background:blue">三</th>';
	echo '<th style="background:blue">四</th>';
	echo '<th style="background:blue">五</th>';
	echo '<th style="background:blue">六</th>';
	echo '</tr>';
	echo '<tr>';
	for ($i=0; $i < $startweek ; $i++) { 
		echo "<td>&nbsp;</td>";
	}

	for ($j=1; $j <= $days ; $j++) { 
		$i++;

		if ($j == $day) {
			echo '<td style="background:green">'.$j.'</td>';
		}else{
			echo "<td>".$j."</td>";
		}

		if ($i%7 == 0) {
			echo '</tr><tr>';
		}
	}
	echo '</tr>';
	echo '</table>';
	exit;
}

function getip()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	} elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	} elseif(!empty($_SERVER['REMOTE_ADDR'])) {
		return $_SERVER['REMOTE_ADDR'];
	}else{
		return '未知IP';
	}
}