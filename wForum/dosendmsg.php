<?php
require("inc/funcs.php");

require("inc/usermanage.inc.php");

require("inc/user.inc.php");

html_init();

?>
<body>
<script language="javascript" type="text/javascript" src="inc/browser.js"></script>
<div id="msgcontent">
<div onkeydown="if(event.keyCode==13 ) { closeWindow(); } ">
<?php
if ($loginok==1) {
	main();
}else {
	foundErr("本页需要您以正式用户身份登陆之后才能访问！");
}

?>
<table cellpadding=3 cellspacing=1 align=center class=TableBorder1>
<?php
if (isErrFounded()) {
?>
         <tr> 
            <th colspan=3>发送短消息失败</th>
         </tr>
		<tr>
		<td width="100%" class=TableBody1 colspan=2>
		<?php echo $errMsg; ?>
		</td></tr>
<?php
} else {
?>
         <tr> 
            <th colspan=3>发送短消息成功</th>
         </tr>
		<td width="100%" class=TableBody1 colspan=2>
		<?php echo $sucmsg; ?>
		</td></tr>
<?php
}
?>
         </tr>
		<td width="100%" class=TableBody2 colspan=2 align="center">
		<a href="#" onclick="closeWindow();">[关闭]</a>
		</td></tr>
		</table>
<?php

function main(){
	global $_POST;
	if (isset($_POST["destid"]))
		$destid = $_POST["destid"];
	else
		$destid = "";
	if (isset($_POST["msg"]))
		$msg = $_POST["msg"];
	else
		$msg = "";
	if (isset($_POST["destutmp"]))
		$destutmp = $_POST["destutmp"];
	else
		$destutmp = 0;
	settype($destutmp, "integer");

	if (strlen($destid) == 0 || strlen($msg) == 0)	{
?>
<script language="javascript">
	parent.closeWindow();
</script>
<?php
		exit(0);
/*
		foundErr("短信参数错误");
		return false;
*/
	}
	if (bbs_sendwebmsg($destid, $msg, $destutmp, $errmsg)==FALSE){
		foundErr($errmsg);
		return false;
	}
	setSucMsg("消息已成功发送！");
}


?>
</div>
	<script language="javascript">
	oFloater=getParentRawObject("floater");
	oMsg=getRawObject("msgcontent");
	oFloater.innerHTML=oMsg.innerHTML;
	show(oFloater);
	</script>
</body>
