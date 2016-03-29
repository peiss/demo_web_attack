<?php
/*
 * class DB
 * 操作数据库的类
 *
 */
class DB{
	private $host="localhost";
	private $name="root";
	private $pass="123456";
	private $db="securetest";
	//数据库类DB的构造函数
	function __construct(){
		$this->connect();
	}
	
	//连接数据库的函数，由构造函数调用
	 function connect(){
		$conn=mysql_connect($this->host,$this->name,$this->pass) or die ("连接出错了".$this->error());
		mysql_select_db($this->db,$conn) or die("没有该数据库：".$this->db);
		if(!mysql_query("SET NAMES 'GBK'"))
		{
			echo "设置数据库字符失败<br>";
		}
	}
	
	 function query($sql) {
		if( !($result=mysql_query($sql)) ){
			echo "<br>执行mysql_query函数失败<br>".mysql_error();
		}
		return $result;
	}
	
	//获取一个course的名称
	function getCourseName($cid){
		$sql = "select * from course where cid=$cid";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		return $row['cname'];
	}
	//取得前一次 MySQL 操作所影响的记录行数
	 function affected_rows() {
		return mysql_affected_rows();
	}
	
	//取得结果集中行的数目
	 function num_rows($result) {
		return @mysql_num_rows($result);
	}

	//释放结果内存
	 function free_result($result) {
		return mysql_free_result($result);
	}
	
	//取得上一步 INSERT 操作产生的 ID 
	 function insert_id() {
		return mysql_insert_id();
	}
	
	//从结果集中取得一行作为枚举数组
	 function fetch_row($query) {
		return mysql_fetch_row($query);
	}
	//从结果集中取得一行作为枚举数组
	 function fetch_array($query) {
		return mysql_fetch_array($query);
	}
	
	 function close() {
		return mysql_close();
	}
	
	 function insert($table,$name,$value){
		$this->query("insert into $table ($name) value ($value)");
		echo "插入成功<br>";
	}
}
$dbconn = new DB();