/**
 * Created by Administrator on 2017/7/13.
 */

//手机号码正则
var telPa=/^1(3[0-9]|5([0-3]|[5-9])|8(0|[5-9]))\d{8}$/;

//验证码数字正则
var codePa=/^\d{6}$/;

//验证码字母数字正则
var codePa=/^[a-zA-Z0-9_]{4}$/;

//用户名正则验证
function user_validation(userName){
    var userPa=/^[a-zA-Z0-9_]{2,16}$/;
    return userPa.test(userName);
}

//文章标题验证
function title_validation(titleName){
    var titlePa=/^.{1,20}$/;
    return titlePa.test(titleName);
}
//文章内容验证
function article_validation(articleName){
    var articlePa=/^.{10,}$/;
    return articlePa.test(articleName);
}

//至少6位并由数字和字母组成：var pwd= /^(?!\d+$)(?![A-Za-z]+$)[a-zA-Z0-9]{6,}$/;
//至少6位并由字母（区分大小写）、数字、符号其中2种组成：
//var pwd = /^(?!\d+$)(?![A-Za-z]+$)(?![-.!@#$%^&*()+?><]+$)[a-zA-Z0-9-.!@#$%^&*()+?><]{6,}$/;
//密码长度正则验证/^.{6,12}$/
function password_validation(pwValue){
    var pwPa=/^.{6,12}$/;
    return pwPa.test(pwValue);
}
//确认密码验证
function password_re_validation(pwValue,rpwValue){
    return (password_validation(pwValue) && pwValue==rpwValue);
}
//邮箱正则
function email_validation(emailValue){
    var emailPa=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
    return emailPa.test(emailValue);
}
//重置,清空表格内的各项值
function resetForm(formObj){
    formObj.find("input").val("");
}