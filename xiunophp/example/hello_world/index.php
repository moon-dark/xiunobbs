<?php

/*
	访问：
	xiunophp/example/hello_world/index.php?name=Jack
	
	结果：
	Hello, Jack
*/

include '../../xiunophp.php';

$name = param('name');

include './hello.htm';

?>