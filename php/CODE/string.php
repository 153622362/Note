<?php
// 查找
$str = '  username';
$res = [];
preg_match("/\S*$/", $str, $res)
var_dump($res);

// 分割
// 替换