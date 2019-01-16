<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use mailer\PHPMailer;
/*
 * 应用公共函数文件，函数不能定义为public类型，
 * 如果我们要使用我们定义的公共函数，直接在我们想用的地方直接调用函数即可。
 * */
// 公共发送邮件函数
function sendEmail($mail_title,$email_content, $toemail){
    $mail = new PHPMailer();
    $mail->isSMTP();// 使用SMTP服务
    $mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
    $mail->Host = "smtp.ym.163.com";// 发送方的SMTP服务器地址
    $mail->SMTPAuth = true;// 是否使用身份验证
    $mail->Username = "ghost@unou.win";// 发送方的邮箱用户名
    $mail->Password = "rade26564356";// 发送方的邮箱密码
    $mail->SMTPSecure = "";// ssl=null
    $mail->Port = 25;// 端口
    $mail->setFrom("ghost@unou.win","Ghost");// 设置发件人信息，如邮件格式说明中的发件人，这里会显示为Ghost(xxxx@163.com）
    $mail->addAddress($toemail,'');// 设置收件人信息，如邮件格式说明中的收件人，这里会显示为(yyyy@163.com)
    $mail->addReplyTo("ghost@unou.win","Reply");// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
    //$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
    //$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
    //$mail->addAttachment("bug0.jpg");// 添加附件
    $mail->Subject = $mail_title;// 邮件标题
    $mail->Body = $email_content;// 邮件正文
    //$mail->AltBody = "This is the plain text纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用

    if(!$mail->send()){// 发送邮件
        return $mail->ErrorInfo;
        // echo "Message could not be sent.";
        // echo "Mailer Error: ".$mail->ErrorInfo;// 输出错误信息
    }else{
        return 1;
    }
}
