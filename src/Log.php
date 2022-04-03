<?php
/*--------------------------------------------------------------------------
 | Software: [WillPHP framework]
 | Site: www.113344.com
 |--------------------------------------------------------------------------
 | Author: no-mind <24203741@qq.com>
 | WeChat: www113344
 | Copyright (c) 2020-2022, www.113344.com. All Rights Reserved.
 |-------------------------------------------------------------------------*/
namespace willphp\log;
use willphp\log\build\Base;
class Log {
	const FATAL = 'FATAL';          //严重错误: 导致系统崩溃无法使用
	const ERROR = 'ERROR';          //一般错误: 一般性错误
	const WARNING = 'WARNING';      //警告性错误: 需要发出警告的错误
	const NOTICE = 'NOTICE';        //通知: 程序可以运行但是还不够完美
	const DEBUG = 'DEBUG';          //调试: 调试信息
	const SQL = 'SQL';              //SQL：调试模式SQL语句
	const EXCEPTION = 'EXCEPTION';  //异常错误	
	protected static $link;	
	public static function single()	{
		if (!self::$link) {
			self::$link = new Base();
		}
		return self::$link;
	}	
	public function __call($method, $params) {
		return call_user_func_array([self::single(), $method], $params);
	}	
	public static function __callStatic($name, $arguments) {
		return call_user_func_array([self::single(), $name], $arguments);
	}
}