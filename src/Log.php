<?php
/*--------------------------------------------------------------------------
 | Software: [WillPHP framework]
 | Site: www.113344.com
 |--------------------------------------------------------------------------
 | Author: 无念 <24203741@qq.com>
 | WeChat: www113344
 | Copyright (c) 2020-2022, www.113344.com. All Rights Reserved.
 |-------------------------------------------------------------------------*/
namespace willphp\log;
class Log {
	protected static $link;
	public static function single()	{
		if (!self::$link) {
			self::$link = new LogBuilder();
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
class LogBuilder {
	protected $dir;
	protected $log = [];
	public function __construct() {
		$dir = defined('LOG_PATH')? LOG_PATH : __DIR__.'/log';
		$this->dir($dir);
	}
	public function dir($dir) {
		if (!$this->createDir($dir)) {
			throw new \Exception('Log directory creation failed or is not writable.');
		}
		$this->dir = $dir;
		return $this;
	}
	protected function createDir($dir, $auth = 0755) {
		if (!empty($dir)) {
			return is_dir($dir) or mkdir($dir, $auth, true);
		}
		return false;
	}
	public function record($message, $level = 'ERROR') {
		$this->log[] = date('[ c ]').$level.':'.$message.PHP_EOL;
		return true;
	}
	public function write($message, $level = 'ERROR') {
		$file = $this->dir.'/'.date('Y_m_d').'.log';
		return error_log(date('[ c ]').$level.':'.$message.PHP_EOL, 3, $file, null);
	}
	public function __destruct() {
		if (!empty($this->log)) {
			$file = $this->dir.'/'.date('Y_m_d').'.log';
			return error_log(implode('', $this->log), 3, $file, null);
		}
	}
}