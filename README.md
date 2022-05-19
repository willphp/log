# 日志管理

log组件用于记录网站日志

#开始使用

####安装组件

使用 composer 命令进行安装或下载源代码使用。

    composer require willphp/log

> WillPHP框架已经内置此组件，无需再安装。

####调用示例

    \willphp\log\Log::dir(__DIR__.'/log')->write('错误信息', 'ERROR'); 

####日志目录

定义默认目录：
	
	define('LOG_PATH', __DIR__.'/log');
	
自定义目录：
	
	Log::dir(__DIR__.'/log');

####记录日志

记录日志会在请求结束时自动写入日志文件

    Log::record('日志信息', 'DEBUG');  

####写入日志

    Log::write('日志信息', 'ERROR');  
