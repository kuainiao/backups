<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>excel信息</title>
    <meta http-equiv = 'Content-Type' content = 'text/html; charset = utf-8' />
    <meta name = 'keywords' content = 'excel信息' />
    <link rel = 'stylesheet' type = 'text/css' href = '/ExcelJoinMysqlFinal/Public/css/HomeCss/reset.css' />
    <link rel = 'stylesheet' type = 'text/css' href = '/ExcelJoinMysqlFinal/Public/css/HomeCss/login.css' />
</head>

<body>

    <div class = 'father'>

        <div class = 'left'></div>

        <div class = 'right'>

            <form action = '/ExcelJoinMysqlFinal/index.php/Home/Index/ShenCheck' method = 'post'>

                <div class = 'span'>

                    <span>用户名</span>

                    <span>密码</span>

                </div>

                <div class = 'inputs'>
                    
                    <input type = 'text' name = 'user' placeholder = '请出入用户名，例如二蛋' />

                    <input type = 'password' name = 'pwd' placeholder = '请出入用户名，例如二蛋的密码' />

                </div>

                <input type = 'submit' name = 'sub' value = '登录' class = 'sub'/>
                
            </form>

        </div>

    </div>

</body>