# 日志管理
log组件用于记录网站日志

#开始使用

####安装组件
使用 composer 命令进行安装或下载源代码使用(依赖willphp/config组件)。

    composer require willphp/log

> WillPHP 框架已经内置此组件，无需再安装。

####调用示例

    \willphp\log\Log::dir('./log')->write('错误信息', 'ERROR'); //写入错误信息

####日志目录

`config/log.php`配置文件可设置默认日志目录：
	
	'dir' => './log', //默认日志目录
	

####记录日志
记录日志会在请求结束时自动写入日志文件

    Log::record('日志信息', Log::DEBUG);  //第二个参数为日志级别

####写入日志

    Log::write('日志信息', Log::ERROR);  //第二个参数为日志级别


####日志级别

	const FATAL = 'FATAL';          //严重错误: 导致系统崩溃无法使用
	const ERROR = 'ERROR';          //一般错误: 一般性错误
	const WARNING = 'WARNING';      //警告性错误: 需要发出警告的错误
	const NOTICE = 'NOTICE';        //通知: 程序可以运行但是还不够完美
	const DEBUG = 'DEBUG';          //调试: 调试信息
	const SQL = 'SQL';              //SQL：调试模式SQL语句
	const EXCEPTION = 'EXCEPTION';  //异常错误	



