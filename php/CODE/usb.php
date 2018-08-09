<?php

//多态
interface USB{
	const WIDTH = 12;
	const HEIGHT = 13;

	function load();
	function run();
	function stop();
}

class Computer {
	function useUSB(USB $usb) {
		$usb -> load();
		$usb -> run();
		$usb -> stop();
	}
}

class Mouse implements USB{
	function load() {
		echo '加载鼠标成功!'.PHP_EOL;
	}

	function run() {
		echo '允许鼠标成功!'.PHP_EOL;
	}
	function stop() {
		echo '鼠标结束工作!'.PHP_EOL;
	}
}

class Worker {
	public static function work()
	{
		$m = new Mouse();
		$c = new Computer();
		$c->useUSB($m);
	}
}
Worker::work();


//图形计算器设计
abstract class Shape
{
	protected $name;

	abstract function zhou();
	abstract function view();

}

class Triangle extends Shape
{
	private $bianchang1;
	private $bianchang2;
	private $bianchang3;

	function __construct($arr = [])
	{
		if (!empty($arr)) {
			$this->bianchang1 = $arr['bianchang1'];
			$this->bianchang2 = $arr['bianchang2'];
			$this->bianchang3 = $arr['bianchang3'];
		}
	}

	function zhou()
	{
		return $this->bianchang1 + $this->bianchang2 + $this->bianchang3;
	}

	function view()
	{
		$html = '<form method="post" action="usb.php">
		边长1：<input type="input" name="bianchang1">
		边长2：<input type="input" name="bianchang2">
		边长3：<input type="input" name="bianchang3">'
		echo $html;
	}

}