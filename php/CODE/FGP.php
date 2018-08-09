<?php
Class File{
	//PATH_SEPARATOR //分隔符 ;
	//DIRECTORY_SEPARATOR //目录
	public static function getFilePro($filename = 'myself.txt')
	{
		if (file_exists($filename)) {
			echo '文件类型'.filetype($filename).PHP_EOL; //获取文件类型
			echo '是否目录'.is_dir($filename).PHP_EOL;
			echo '是否文件'.is_file($filename).PHP_EOL;
			echo '能否执行'.is_executable($filename).PHP_EOL;
			echo '能否读取'.is_readable($filename).PHP_EOL;
			echo '能否写'.is_writeable($filename).PHP_EOL;
			echo '是否链接符'.is_link($filename).PHP_EOL; //LINUX下才有效
			echo '创建时间'.filectime($filename).PHP_EOL;
			echo '修改时间'.filemtime($filename).PHP_EOL;
			echo '访问时间'.fileatime($filename).PHP_EOL;
			echo '文件及名称'.basename('/a/b/c/d.txt').PHP_EOL;
			echo '文件名称'.basename('/a/b/c/d.txt','.txt').PHP_EOL;
			echo '目录名称'.dirname('/a/b/c/d.txt').PHP_EOL;
			print_r(pathinfo('/a/b/c/d.txt')); // [dirname] => /a/b/c [basename] => d.txt [extension] => txt [filename] => d 
			echo '绝对路径名称'.realpath($filename).PHP_EOL;
			print_r(glob("*.txt")).PHP_EOL; //匹配所有txt文件
			// opendir();
			// readdir();
			// closedir();
			// rewinddir(); //指定的目录流重置到目录的开头。
			// fopen($filename, $mode);
			// fclose($resource);
			// fwrite();
			// feof();
			// file(); //把整个文件读入一个数组中。 无需fopen打开
			// readfile(); //读取一个文件，并输出到输出缓冲 无需fopen打开
			// fgets(); //一次读取一行
			// fgetc(); //打开的文件中读取一个字符
			// fread($resource, 10); //按字符读取
			// filesize(); //文件大小
			echo 'C盘总空间'.self::size(disk_total_space('C:')).PHP_EOL; 
			echo 'C盘可用空间'.self::size(disk_free_space('C:')).PHP_EOL; 
			//touch('a.txt') //创建一个a.txt文件
			//copy('a.txt','b.txt') //复制a.txt文件
			//rename('a.txt','b.txt') //移动或重命名文件
			//ublink('a.txt','b.txt') //删除一个文件
			//ftruncate($resource, 100); //将文件截断到给定的长度
			//file_get_content(); 
 		}
	}

	public static function size($size)
	{
		$s = $size;
		$dw = "";
		if ($size > pow(2,40)) {
			$s = $size / pow(2,40);
			$dw = 'TB';
		} elseif ($size > pow(2,30)) {
			$s = $size / pow(2,30);
			$dw = 'GB';
		}elseif ($size > pow(2,20)) {
			$s = $size / pow(2,20);
			$dw = 'MB';
		}elseif ($size > pow(2,10)) {
			$s = $size / pow(2,10);
			$dw = 'KB';
		}else{
			$s = $size;
			$dw = 'types';
		}

		return $s.$dw;

	}

	public static function Pointer($filename = 'myself.txt')
	{
			$fp = fopen($filename, 'r');
			echo ftell($fp).'<br>'; //当前文件流指针
			fseek($fp, 4); //后移动指针4个字符
			echo ftell($fp).'<br>'; 
			rewind($fp).'<br>'; //重置指针
			echo ftell($fp).'<br>'; 
	}

	public static function fileLock($filename = 'myself.txt', $mess = 'a test ')
	{
		$fp = fopen($filename, 'a');

		if (flock($fp, LOCK_EX)) { //flock($fp, LOCK_EX+LOCK_NB)
			fwrite($fp,$mess);
			flock($fp, LOCK_UN);
			fclose($fp);
			sleep(10);
		}
	}

	public static function uploadFile()
	{
		//ini file_uploads upload_max_filesize post_max_size upload_tmp_dir
		$html = "<form action='test.php' method='post' enctype='multipart/form-data'>";
		$html .= "name:<input type='text' name='username' value=''>";
		$html .= "<input type='hidden' name='MAX_FILE_SIZE' value='1000000'>";
		$html .= "up pic:<input type='file' name='pic' value=''>";
		$html .= "<input type='submit' value='upload' ></form>";
		echo $html;
		if ($_POST) {
			var_dump($_POST);
			var_dump($_FILES);
			// $src = ./dat/xxx.xx
			// move_uploaded_file($_FILES['tmp_name'],$src) //保存文件到系统中
			//判断文件类型
			$arr = explode('.', basename($_FILES['pic']['name']));
			$extension = array_pop($arr);
			if (!in_array($extension,['txt'])) {
				echo '上传文件不合法';
			}
		}
	}

	public static function downloaadFile($filename = 'myself.txt')
	{
		$basename = pathinfo($filename);
		header('Content-Type:text/html'); //指定下载文件类型
		header('Content-Disposition:attachment;filename='.$basename['basename']); //设置文件名字
		header('Content-Length:'.filesize($filename)); //指定文件大小
		readfile($filename); //将内容输出，以便下载
	}
}

error_reporting(E_ALL);

class GD{
	static function usage()
	{
		//1.创建背景 2.绘制图形 3.输出图形 4.释放资源
		//1
		$im = imageCreateTrueColor(200, 200); //创建空白背景
		$white = imagecolorallocate($im, 255, 255, 255); //设置绘图颜色
		$blue = imagecolorallocate($im, 0, 0, 64); 
		//2
		imagefill($im, 0, 0, $blue); //绘制背景
		imageLine($im, 0, 0, 200, 200, $white); //画线
		imagestring($im, 4, 50, 150, 'Sales', $white); //添加字符串
		//3
		header('Content-Type:image/png');
		imagepng($im); //以PNG格式将图像输出
		//4
		imagedestroy($im); //释放资源
	}
	//画图形
	static function shape()
	{
		$im = imageCreateTrueColor(200, 200); //创建空白背景
		$white = imagecolorallocate($im, 255, 255, 255); //设置绘图颜色
		$blue = imagecolorallocate($im, 0, 0, 64); 
		$red = imagecolorallocate($im, 255, 0, 0); 
		$pink = imagecolorallocate($im, 0XFF, 0, 0XFF); 
		imagefill($im, 0, 0, $white); //绘制背景
		imageLine($im, 0, 0, 200, 200, $white); //画线
		imageLine($im, 200, 0, 0, 200, $red); //画线
		//画矩形
		imagerectangle($im, 50, 50, 150, 150, $pink); //空心
		imagefilledrectangle($im, 75, 75, 125, 125, $blue); //实心

		//画圆形
		imageellipse($im, 50, 50, 100, 100, $red); //空心
		imagefilledellipse($im, 150, 150, 100, 100, $red); //实心

		//画弧形
		imagearc($im, 150, 50, 100, 100, -90, 0, $blue); //空心

		//画字符串
		imagestring($im, 5, 50, 150, 'hello world', $blue);  //横立
		imagestringup($im, 5, 50, 150, 'hello world', $blue); //竖立

		imagettftext($im, 20, 0, 10, 100, $blue, './SIMLI.TTF', '哈哈哈'); //用 TrueType 字体向图像写入文本 

		header('Content-Type:image/gif');
		imagegif($im); //以PNG格式将图像输出 第二个参数用来保存到本地
		//
		imagedestroy($im); //释放资源
	}

	//从图形创建背景
	public static function bgFromImg($imgname = 'mysql.png', $string = 'xxx')
	{
		list($width, $height, $type) = getimagesize($imgname);
		$types = [1=>'gif',2=>'jpeg',3=>'png'];
		$creteimage = 'imagecreatefrom'.$types[$type];
		$img = $creteimage($imgname);
		$red = imagecolorallocate($img, 0xFF, 0, 0);

		$x = ($width-imagefontwidth(5) * strlen($string)) /2;
		$y = ($height-imagefontheight(5)) /2;

		imagestring($img, 5, $x, $y, $string, $red);
		header('Content-Type:image/png');

		$save = 'image'.$types[$type];
		$save($img); //第二个参数用来保存到本地

		imagedestroy($img);
	}

	//缩放
	public static function thumb($imgname = 'mysql.png', $width = '200', $height = '200')
	{
		list($swidth, $sheight, $type) = getimagesize($imgname);
		$types = [1=>'gif',2=>'jpeg',3=>'png'];
		$creteimage = 'imagecreatefrom'.$types[$type];
		//原图片
		$img = $creteimage($imgname);
		//目标资源
		$dimg = imagecreatetruecolor($width, $height);

		//同等比例缩放
		// if ($width && ($swidth < $sheight)) {
		// 		$width = ($height / $sheight) * $swidth;
		// }else {
		// 		$height = ($width / $swidth) * $sheight;
		// }

		imagecopyresampled($dimg, $img, 0, 0, 0, 0, $width, $height, $swidth, $sheight);  //拷贝部分图形并重新调整大小 把$swidth 变 $width  $sheight 变 $swidth就是剪切


		header('Content-Type:image/png');
		$save = 'image'.$types[$type];
		$save($dimg); //第二个参数用来保存到本地

		imagedestroy($img);
		imagedestroy($dimg);
	}

	//水印效果
	public static function waterMark($imgname ='mysql.png', $string = 'xxx', $watername = 'watermark.png')
	{
		list($swidth, $sheight, $type) = getimagesize($imgname);
		list($wwidth, $wheight, $wtype) = getimagesize($watername);
		$types = [1=>'gif',2=>'jpeg',3=>'png'];
		$creteimage = 'imagecreatefrom'.$types[$type];
		//原图片
		$img = $creteimage($imgname);
		//水印图片
		$wimg = $creteimage($watername);
		//配置颜色
		$white = imagecolorallocate($img, 200, 200, 200);
		$green = imagecolorallocate($img, 0, 200, 0);
		//图片水印
		$x = rand(3, $swidth-$wwidth);
		$y = rand(3, $sheight-$wheight);
		imagecopy($img, $wimg, $x, $y, 0, 0, $wwidth, $wheight); //拷贝图形的一部分

		//字符水印
		$x = rand(3, $swidth-strlen($string)*imagefontwidth(5));
		$y = rand(3, $sheight-imagefontwidth(5)-2);
		imagestring($img, 5, $x, $y, $string, $white);
		imagestring($img, 5, $x+1, $y+1, $string, $green);

		header('Content-Type:image/png');
		$save = 'image'.$types[$type];
		$save($img); //第二个参数用来保存到本地

		imagedestroy($img);

	}

	// 图片旋转
	public static function rotate($imgname='mysql.png',$degress = 50)
	{
		list($width, $height, $type) = getimagesize($imgname);
		$types = [1=>'gif',2=>'jpeg',3=>'png'];
		$creteimage = 'imagecreatefrom'.$types[$type];
		//原图片
		$img = $creteimage($imgname);

		$new = imagerotate($img, $degress, 0);

		header('Content-Type:image/png');
		$save = 'image'.$types[$type];
		$save($new); //第二个参数用来保存到本地

		imagedestroy($img);
		imagedestroy($new);
	}

	//Y轴旋转
	public static function trun_y($imgname = 'mysql.png') 
	{
		list($width, $height, $type) = getimagesize($imgname);
		$types = [1=>'gif',2=>'jpeg',3=>'png'];
		$creteimage = 'imagecreatefrom'.$types[$type];
		//原图片
		$img = $creteimage($imgname);

		$new = imageCreateTrueColor($width, $height);

		for ($y=0; $y < $height; $y++) { 
			imagecopy($new, $img, 0, $height-$y-1, 0, $y, $width, 1); //X轴同理
		}

		header('Content-Type:image/png');
		$save = 'image'.$types[$type];
		$save($new); //第二个参数用来保存到本地

		imagedestroy($img);
		imagedestroy($new);
	}
}


class MPDO
{
	//PDO连接
	public static function connect()
	{
		try{
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=test','root','root', [PDO::ATTR_AUTOCOMMIT=>true,PDO::ATTR_PERSISTENT=>1]); //ATTR_PERSISTENT 持久连接
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //设置错误使用异常的模式 1.PDO::ERRMODE_WARNING 2.PDO::ERRMODE_EXCEPTION

		//exec 查询非结果集 insert update delete create
		//query 处理结果集语句 select desc show
		$rows =$pdo->query('select * from test'); //通过PDOStatement类获取结果 foreach也可以
		if (!$rows) {
			echo $pdo->errorCode();
			print_r( $pdo->errorinfo());
			exit;
		}
	}catch(PDOException $e) {
		echo '数据库连接失败'.$e->getMessage();
		exit;
		}
	}
	//PDO事务
	public static function transaction()
	{
		//1.关闭自动提交 2.开启事务 3.增/删 4.commit/rollback
		try{
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=test','root','root', [PDO::ATTR_AUTOCOMMIT=>false,PDO::ATTR_PERSISTENT=>1]); //ATTR_PERSISTENT 持久连接 ATTR_AUTOCOMMIT 自动提交
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //设置错误使用异常的模式 1.PDO::ERRMODE_WARNING 2.PDO::ERRMODE_EXCEPTION
	}catch(PDOException $e) {
		echo '数据库连接失败'.$e->getMessage();
		exit;
		}

		try{
			$pdo->beginTransaction();
			$rows =$pdo->exec('update test set money = money - 10 where id = 1'); 
			if (!$rows) {
				throw new PDOException("Error Processing Request");
			}
			$rows =$pdo->exec('update test set money = money + 10 where id = 2'); 
			if (!$rows) {
				throw new PDOException("Error Processing Request");
			}
			$pdo->commit();
		}catch(PDOException $e)
		{
			echo '错误'.$e->getMessage();
			$pdo->rollBack();
		}
		$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
	}
	//预处理
	public static function preTreatment()
	{
		try{
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=test','root','root', [PDO::ATTR_AUTOCOMMIT=>true,PDO::ATTR_PERSISTENT=>1]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	
	}catch(PDOException $e) {
		echo '数据库连接失败'.$e->getMessage();
		exit;
		}
		//写法1
		// $stmt = $pdo->prepare('insert into test(name,money) values(?,?)');
		//绑定方法1
		// $stmt->execute(['ngyhd1','202']);
		//绑定方法2
		// $stmt->bindParam(1, $name);
		// $stmt->bindParam(2, $money);
		// $name = 'ngyhd1';
		// $money = '201';
		// $stmt->execute();
		//写法2
		// $stmt = $pdo->prepare('insert into test(name,money) values(:name, :money)');
		//绑定方法1
		// $stmt->execute(['name'=>'ngyhd1','money'=>'203']);
		//绑定方法2
		// $stmt->bindParam(':name', $name);
		// $stmt->bindParam(':money', $money);
		// $name = 'ngyhd1';
		// $money = '204';
		// $stmt->execute();

	}

	public static function dealResult()
	{
		try{
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=test','root','root', [PDO::ATTR_AUTOCOMMIT=>true,PDO::ATTR_PERSISTENT=>1]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	
		}catch(PDOException $e) {
			echo '数据库连接失败'.$e->getMessage();
			exit;
		}

		$stmt = $pdo->prepare('select id,name,money from test where id > ? and id < ?');
		$stmt->execute([1,5]);
		$stmt->setFetchMode(PDO::FETCH_ASSOC); //设置 返回结果是索引数组还是关联数组

		// 方法1
		//PDO::FETCH_ASSOC 关联数组 PDO::FETCH_NUM 索引数组
		// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		// 	print_r($row);
		// 	echo '<br>';
		// }
		// 方法2
		// foreach ($stmt as $row) {
		// 	print_r($row);
		// 	echo '<br>';
		// }
		// 方法3
		// print_r($stmt->fetchAll(); //所有结果
		// 方法4
			// echo $stmt->rowCount(); //行数
			// $pdo->lastInsertId() //最后自增的ID

	}
}