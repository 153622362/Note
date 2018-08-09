<?php
Class Magicmethods
{
	public $name = 'a';
	public function __construct()
	{
		echo '__construct----##创建了一个对象'.'<br>';
	}

	public function __destruct()
	{
		echo '__destruct----##'.$this->name.'释放了一个对象'.'<br>';
	}

	public function __set($name,$value)
	{
		echo "__set----##设置的成员属性{$name}等于{$value}不存在".'<br>';
	}

	public function __get($name)
	{
		echo "__get----##获取成员属性{$name}不存在".'<br>';
	}

	public function __isset($name)
	{
		echo "__isset----##isset({$name})成员属性{$name}不存在".'<br>';
	}

	public function __unset($name)
	{
		echo "__unset----##unset({$name})成员属性{$name}不存在".'<br>';
	}	

	public function __toString()
	{
		return "__toString----##当类被当成字符串时的反应：我是一个类".__CLASS__.'<br>';

	}

	public function __clone()
	{
		$this->name = 'b';
		echo "__clone----##克隆出来的对象调用了此方法".__CLASS__.'<br>';
	}

	public function __call($name, $aarguments)
	{
		echo "__call----##调用了一个不存在的方法{$name}".'<br>';
	}

	public function __sleep()
	{
		echo "__sleep----##serialize()方法串行化调用此方法"."<br>";
		return [];
	}

	public function __wakeup()
	{
		echo "__wakeup----##unserialize()方法串行化调用此方法"."<br>";
	}

	public function __invoke($arg)
	{
		echo '__invoke----##当对象被当作函数调用'.$arg.'<br>';
	}

	public static function __callStatic($name, $aarguments)
	{
		echo "__callStatic----##调用了一个不存在的静态方法{$name}".'<br>';
	}


	public function __set_state()
	{
		echo '__set_state----##var_export()导出类方法调用了这个方法'.'<br>';
	}

	public function __debugInfo() 
	{
		echo '__debugInfo----##var_dump()显示的内容';
	}




}

$obj = new Magicmethods(); //调用__construct()
$obj->a = 3; //调用__set()
$obj->b; //调用__get();
isset($obj->c); //调用__isset
empty($obj->c); //调用__isset
unset($obj->c); //调用__unset
echo $obj; //调用__toString
$obj2 = clone $obj; //调用__clone
$obj->test(); //调用__call()
$str = serialize($obj); //调用__sleep()
unserialize($str); //调用__wakeup
$obj(5); //调用__invoke
$obj::test(); //调用__callstatic
var_export($obj); //调用__set_state
echo '<br>';
var_dump($obj);
echo '<br>';