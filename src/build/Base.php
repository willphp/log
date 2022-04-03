<?php
/*--------------------------------------------------------------------------
 | Software: [WillPHP framework]
 | Site: www.113344.com
 |--------------------------------------------------------------------------
 | Author: no-mind <24203741@qq.com>
 | WeChat: www113344
 | Copyright (c) 2020-2022, www.113344.com. All Rights Reserved.
 |-------------------------------------------------------------------------*/
namespace willphp\log\build;
use willphp\config\Config;
class Base {
	protected $dir; //日志保存目录
	protected $log = []; //日志信息
	/**
	 * 初始化
	 */
	public function __construct() {
		$this->dir(Config::get('log.dir', 'log'));
	}	
	/**
	 * 设置日志保存目录
	 * @param $dir 目录路径
	 * @return $this
	 */
	public function dir($dir) {		
		if (!$this->createDir($dir)) {
			throw new \Exception('Log directory creation failed or is not writable.');
		}
		$this->dir = $dir;
		return $this;
	}
	/**
	 * 创建目录
	 * @param $dir 目录路径
 	 * @param $auth 目录权限
	 * @return bool
	 */
	protected function createDir($dir, $auth = 0755) {
		if (!empty($dir)) {
			return is_dir($dir) or mkdir($dir, $auth, true);
		}
		return false;
	}
	/**
	 * 记录日志
	 * @param string $message 日志内容
	 * @param string $level   错误等级
	 * @return bool
	 */
	public function record($message, $level = 'ERROR') {
		$this->log[] = date('[ c ]').$level.':'.$message.PHP_EOL;		
		return true;
	}
	/**
	 * 写入日志
	 * @param string $message 日志内容
	 * @param string $level   错误等级
	 * @return bool
	 */
	public function write($message, $level = 'ERROR') {
		$file = $this->dir.'/'.date('Y_m_d').'.log';		
		return error_log(date('[ c ]').$level.':'.$message.PHP_EOL, 3, $file, null);
	}
	/**
	 * 存储日志
	 * @return void
	 */
	protected function save() {
		if (!empty($this->log)) {
			$file = $this->dir.'/'.date('Y_m_d').'.log';			
			return error_log(implode('', $this->log), 3, $file, null);
		}
	}
	/**
	 * 结束时自动存储日志
	 */
	public function __destruct() {
		$this->save();
	}		
}