<?php
class skin_users{

//===========================================================================
// <rsf:emailHtmlForgot:desc::trigger:>
//===========================================================================
function emailHtmlForgot($obj="",$password="") {global $bw, $vsLang;
$this->vsLang = $vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
		<div class="forgot-pass-form">
<p><span>{$this->vsLang->getWords('userName','Tên đăng nhập')} : {$obj->getName()}</span></p>
<p><span>{$this->vsLang->getWords('userNewPass','Mật khẩu mới')} : {$password} </span></p>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <rsf:registerUserForm:desc::trigger:>
//===========================================================================
function registerUserForm($message='') {global $bw, $vsLang;


//--starthtml--//
$BWHTML .= <<<EOF
		<div class="spmoi_all">
<div class="spm_title">{$vsLang->getWordsGlobal("user_title_reg","Đăng ký thành viên")}</div>
<div class="box_spm">
<div class="error"></div>
<div class="reg_form">
<form method="post" name="regist" onsubmit="if(regist_submit()){ regist.ok.disabled=true; regist.ok.html=&#39;Wait...&#39;;} else { return false }">
<input type="hidden" name="userBirthday" id="userBirthday" value="{$bw->input['userBirthday']}" />
<table style="width: 100%">
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_name","Tên đăng nhập")}:</label></td>
<td class="reg_r"><input type="text" name="userName" id="userName" value="{$bw->input['userName']}" onblur="validUsername();" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_pass","Mật khẩu")}:</label></td>
<td class="reg_r"><input type="password" name="userPassword" id="userPassword" value="{$bw->input['userPassword']}" onblur="validPass1();" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_pass_re","Nhập lại password")}:</label></td>
<td class="reg_r"><input type="password" name="repassword" id="repassword" value="{$bw->input['repassword']}" onblur="validPass2();" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_email","Email")}:</label></td>
<td class="reg_r"><input type="text" name="userEmail" id="userEmail" value="{$bw->input['userEmail']}" onblur="validMail();" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_email_re","Nhập lại email")}:</label></td>
<td class="reg_r"><input type="text" name="reemail" id="reemail" value="{$bw->input['reemail']}" onblur="validMail2();" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_fullname","Họ và tên")}:</label></td>
<td class="reg_r"><input type="text" name="userFullName" id="userFullName" value="{$bw->input['userFullName']}" onblur="validFullName();" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_date","Ngày sinh")}:</label></td>
<td class="reg_r reg_bd">
<select name="user_day" id="user_day"></select> 
<select name="user_month" id="user_month"></select> 
<select name="user_year" id="user_year"></select> 
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_address","Địa chỉ")}:</label></td>
<td class="reg_r"><input type="text" name="userAddress" id="userAddress" value="{$bw->input['userAddress']}" onblur="validAddress();" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_phone","Điện thoại")}:</label></td>
<td class="reg_r"><input type="text" name="userPhone" id="userPhone" value="{$bw->input['userPhone']}" onblur="validPhone();" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_cache","Mã bảo vệ")}:</label></td>
<td class="reg_r">
<img id="siimage" class="captcha1" src="{$bw->vars['board_url']}/captcha/securimage_show.php" style="vertical-align: middle; width: 170px; border: 1px #ccc solid;"/>
<a href="#" onclick="document.getElementById('siimage').src = '{$bw->vars['board_url']}/captcha/securimage_show.php?sid=' + Math.random(); return false"><img src="{$bw->vars['img_url']}/reg_refesh.jpg" class="captcha1" style="vertical-align: middle;"></a>
</td>
</tr>
<tr>
<td class="reg_l"></td>
<td class="reg_r"><input type="text" name="captcha" id="check_code" value="{$bw->input['captcha']}" onblur="validCode();" /></td>
</tr>
<tr>
<td class="reg_l"></td>
<td class="reg_r">
<input class="btn_contact ok" name="Submit1" type="submit" value="{$vsLang->getWordsGlobal("user_submit","đăng ký")}" /><input class="btn_contact" name="Reset1" type="reset" value="{$vsLang->getWordsGlobal("user_destroy","Hủy")}" /></td>
</tr>
</table>
</form>
</div>
</div>
</div>
<div class="clear"></div>

<script language="javascript" type="text/javascript">
var arrayMonth =new Array(31,28,31,30,31,30,31,30,31,30,31,30);
$(document).ready(function()
{
var date=new Date();
var y = 1900 + date.getYear();
if(date.getMonth()==2){
var d = new Date("2,29,"+y);
if(d.getDate()==29)
arrayMonth[1]=29;
else 
arrayMonth[1]=28;
}
var i;
for(i=1;i<=arrayMonth[date.getMonth()];i++){
$("#user_day").append("<option value='"+i+"' >"+i+"</option>");
}
for(i=1;i<=12;i++){
$("#user_month").append("<option value='"+i+"' >"+i+"</option>");
}
for(i=1900+ date.getYear();i>=1900+ date.getYear()-70;i--){
$("#user_year").append("<option value='"+i+"' >"+i+"</option>");
}
vsf.jSelect(date.getDate(),'user_day');
vsf.jSelect(date.getMonth()+1,'user_month');
vsf.jSelect(1900+ date.getYear(),'user_year');
});
function createDay(day,month,year){
  var arrayMonth =new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
  if(month==2){
   var d=new Date("2,29,"+year);
   if(d.getDate()==29)
    arrayMonth[2]=29;
   else 
   arrayMonth[2]=28;
  }
  var i;
  $("select[id*='user_day']").find('option').detach();
  for(i=1;i<=arrayMonth[month];i++){
   $("#user_day").append("<option value='"+i+"'>"+i+"</option>");
  }
  if(day >= arrayMonth[month]) 
  day = arrayMonth[month];
  vsf.jSelect(day,'user_day');
}
function changDate(){
var d = $("#user_day").val();
var m = $("#user_month").val()-1;
var y = $("#user_year").val();
var i;
$("#user_day").html("<option value='0'>{$vsLang->getWords('day','Ngày')}</option>");
if(m==1)
{
var d = new Date("2,29,"+y);
if(d.getDate()==29)
arrayMonth[1] = 29;
else 
arrayMonth[1] = 28;
}
for(i=1;i<=arrayMonth[m];i++){
$("#user_day").append("<option value='"+i+"' >"+i+"</option>");
}
if(d > arrayMonth[m])
d = arrayMonth[m];
vsf.jSelect(d,'user_day');
}
 $("#user_month").change(function () {
                 var year = $("select[id*='user_year']").find(':selected').text();
                 var day = $("select[id*='user_day']").find(':selected').text();
        createDay(day,this.value,year)                
          })
           
   $("#user_year").change(function () {
            var month = $("select[id*='user_month']").find(':selected').text();
                var day = $("select[id*='user_day']").find(':selected').text();
       createDay(day,month,this.value)
          })
$('#userPassword').keypress(function(e){
    if((e.which >=65 && e.which <=90)) {
    jAlert("{$vsLang->getWords('capslock_onpress','Vui lòng tắt bỏ phím capslock!')}",'{$bw->vars['global_websitename']} Dialog');
    }
});

$('#repassword').keypress(function(e){
    if((e.which >=65 && e.which <=90)) {
    jAlert("{$vsLang->getWords('capslock_onpress','Vui lòng tắt bỏ phím capslock!')}",'{$bw->vars['global_websitename']} Dialog');
    }
});

function checkMail(mail){
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
if (!filter.test(mail))
return false;
return true;
}
function validUsername(){
re_acc= "^[a-zA-Z0-9][a-zA-Z0-9]*$"
if($("#userName").val().search(re_acc) == -1){
$(".error").html( "<i>{$vsLang->getWords('err_user_name','Vui lòng nhập tên đăng nhập hợp lệ')}</i>");
return false;
}
if($("#userName").val().length < 4){
$(".error").html( "<i>{$vsLang->getWords('err_user_name_length','Phải ít nhất 4 ký tự')}</i>");
return false;
}
$("#error").html( "");
return true;
}

function validMail(){
if($("#userEmail").val().indexOf("@")==-1){
$(".error").html( "<i>{$vsLang->getWords('err_email','Vui lòng nhập địa chỉ email hợp lệ')}</i>");
return false;
}
if($("#userEmail").val().indexOf(".")==-1){
$(".error").html( "<i>{$vsLang->getWords('err_email','Vui lòng nhập địa chỉ email hợp lệ')}</i>");
return false;
}

if($("#userEmail").val().lastIndexOf(".")==$("#userEmail").val().length-1){
$(".error").html( "<i>{$vsLang->getWords('err_email','Vui lòng nhập địa chỉ email hợp lệ')}</i>");
return false;
}

if($("#userEmail").val().indexOf("@")!=$("#userEmail").val().lastIndexOf("@")){
$(".error").html( "<i>{$vsLang->getWords('err_email','Vui lòng nhập địa chỉ email hợp lệ')}</i>");
return false;
}

if(!checkMail($("#userEmail").val())){
$(".error").html( "<i>{$vsLang->getWords('err_email','Vui lòng nhập địa chỉ email hợp lệ')}</i>");
return false;
}
$("#error").html( "");
return true;
}

function validMail2(){
if($("#reemail").val().indexOf("@")==-1)
{
$(".error").html( "<i>{$vsLang->getWords('err_email','Vui lòng nhập địa chỉ email hợp lệ')}</i>");
return false;
}
if($("#reemail").val().indexOf(".")==-1)
{
$(".error").html( "<i>{$vsLang->getWords('err_email','Vui lòng nhập địa chỉ email hợp lệ')}</i>");
return false;
}
if($("#reemail").val().lastIndexOf(".")==$("#reemail").val().length-1)
{
$(".error").html( "<i>{$vsLang->getWords('err_email','Vui lòng nhập địa chỉ email hợp lệ')}</i>");
return false;
}
if($("#reemail").val().indexOf("@")!=$("#reemail").val().lastIndexOf("@"))
{
$(".error").html( "<i>{$vsLang->getWords('err_email','Vui lòng nhập địa chỉ email hợp lệ')}</i>");
return false;
}
if(!checkMail($("#reemail").val()))
{
$(".error").html( "<i>{$vsLang->getWords('err_email','Vui lòng nhập địa chỉ email hợp lệ')}</i>");
return false;
}
if($("#reemail").val() != $("#userEmail").val())
{
$(".error").html( "<i>{$vsLang->getWords('err_email_re','Email xác nhận không chính xác. Vui lòng nhập lại')}</i>");
return false;
}
$("#error").html( "");
return true;
}

function validPass1(){
re_acc= "^[a-zA-Z0-9][a-zA-Z0-9]*$"
if($("#userPassword").val() == "" || $("#userPassword").val().search(re_acc) == -1 ){
$(".error").html( "<i>{$vsLang->getWords('err_pass','Vui lòng nhập mật khẩu của bạn.')}</i>");
return false;
}

if($("#userPassword").val().length < 6){
$(".error").html( "<i>{$vsLang->getWords('err_pass_length','Phải ít nhất 6 ký tự')}</i>");
return false;
}
$("#error").html( "");
return true;
}

function validPass2(){
if($("#repassword").val() == ""){
$(".error").html( "<i>{$vsLang->getWords('err_pass_re','Mật khẩu xác nhận không chính xác. Vui lòng nhập lại')}</i>");
return false;
}

if($("#repassword").val() != $("#userPassword").val()){
$(".error").html( "<i>{$vsLang->getWords('err_pass_re','Mật khẩu xác nhận không chính xác. Vui lòng nhập lại')}</i>");
return false;
}
$("#error").html( "");
return true;
}
function validFullName(){
if($("#userFullName").val() == ""){
$(".error").html( "<i>{$vsLang->getWords('err_fullname','Vui lòng nhập họ và tên')}</i>");
return false;
}
$("#error").html( "");
return true;
}
function validAddress(){
if($("#userAddress").val() == ""){
$(".error").html( "<i>{$vsLang->getWords('err_address','Vui lòng nhập địa chỉ')}</i>");
return false;
}
$("#error").html( "");
return true;
}
function validPhone(){
if($("#userPhone").val() == ""){
$(".error").html( "<i>{$vsLang->getWords('err_phone','Vui lòng nhập điện thoại')}</i>");
return false;
}
$("#error").html( "");
return true;
}
function validCode(){
if($("#check_code").val() == ""){
$(".error").html( "<i>{$vsLang->getWords('err_code','Vui lòng nhập mã xác nhận')}</i>");
return false;
}
$("#error").html( "");
return true;
}

function regist_submit(){
if(!validUsername())return false;
if(!validMail())return false;
if(!validMail2())return false;
if(!validPass1())return false;
if(!validPass2())return false;
if(!validFullName())return false;
if(!validAddress())return false;
if(!validPhone())return false;
if(!validCode())return false;
if($('#user_day').val()==0||$('#user_month').val()==0||$('#user_year').val()==0) {
jAlert('{$vsLang->getWords('e_date_wrong','Nhập vào đầy đủ thông số ngày tháng năm!')}','{$bw->vars['global_websitename']} Dialog');
return false;
}else{
var day = $('#user_day').val();
var month = $('#user_month').val();
var year  = $('#user_year').val();
var numdayofmonth = new Date(year, month, 0).getDate();
if(day>numdayofmonth){
var messa = "Tháng ["+month+"/"+year+"] chi có ["+numdayofmonth+"] ngày không thể có ngày ["+day+"].Nhập lại ngày";
jAlert(messa,'{$bw->vars['global_websitename']} Dialog');
return false;
}
var value = day+"/"+month+"/"+year;
$('#userBirthday').val(value);
}
return true;
}

$(document).ready(function(){
{$message}
})
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <rsf:changePasswordForm:desc::trigger:>
//===========================================================================
function changePasswordForm($message='') {global $bw, $vsLang, $vsUser, $vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
		<div class="new_pro">
<div class="new_pro_top">
<span>{$vsLang->getWordsGlobal("user_change_pass","Lấy Lại Mật Khẩu")}</span> </div>
</div>
<div class="error"></div>
<div class="reg_form">
<form method="post" name="user-infor-form" id="user-infor-form">
<input type="hidden" name="userId" value="{$vsUser->obj->getId()}" />
<table style="width: 100%">
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_pass_old","Mật khẩu cũ")}:</label></td>
<td class="reg_r"><input type="password" name="userOldPassword" id="userOldPassword" value="{$bw->input['userOldPassword']}"/></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_pass_new","Mật khẩu mới")}:</label></td>
<td class="reg_r"><input type="password" name="userNewPassword" id="userNewPassword" value="{$bw->input['userNewPassword']}"/></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_pass_new_re","Nhập lại mật khẩu mới")}:</label></td>
<td class="reg_r"><input type="password" name="userNewPasswordRe" id="userNewPasswordRe" value="{$bw->input['userNewPasswordRe']}"/></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_cache","Mã bảo vệ")}:</label></td>
<td class="reg_r">
<img id="siimage" class="captcha1" src="{$bw->vars['board_url']}/captcha/securimage_show.php" />
<a href="#" onclick="document.getElementById('siimage').src = '{$bw->vars['board_url']}/captcha/securimage_show.php?sid=' + Math.random(); return false"><img src="{$bw->vars['img_url']}/reg_refesh.jpg" class="captcha1"></a>
</td>
</tr>
<tr>
<td class="reg_l"></td>
<td class="reg_r"><input type="text" name="captcha" id="check_code" /></td>
</tr>
<tr>
<td class="reg_l"></td>
<td class="reg_r">
<input class="reg_btn" id="submit" name="submit" type="submit" value="{$vsLang->getWordsGlobal("user_infor_update","Cập nhật")}" />
</tr>
</table>
</form>
</div>
<div class="clear"></div>

<script language="javascript" type="text/javascript">

EOF;
if($message) {
$BWHTML .= <<<EOF

$(document).ready(function(){
       jAlert('{$message}','{$bw->vars['global_websitename']} Dialog');
});

EOF;
}

$BWHTML .= <<<EOF

$('#userOldPassword').keypress(function(e){
    if((e.which >=65 && e.which <=90)){
    jAlert("{$vsLang->getWords('capslock_onpress','Vui lòng tắt bỏ phím capslock!')}",'{$bw->vars['global_websitename']} Dialog');
    }
});
$('#userNewPassword').keypress(function(e){
    if((e.which >=65 && e.which <=90)){
    jAlert("{$vsLang->getWords('capslock_onpress','Vui lòng tắt bỏ phím capslock!')}",'{$bw->vars['global_websitename']} Dialog');
    }
});
$('#userNewPasswordRe').keypress(function(e){
    if((e.which >=65 && e.which <=90)) {
    jAlert("{$vsLang->getWords('capslock_onpress','Vui lòng tắt bỏ phím capslock!')}",'{$bw->vars['global_websitename']} Dialog');
    }
});
function validCode(){
if($("#check_code").val() == ""){
jAlert('{$vsLang->getWords('err_code','Vui lòng nhập mã xác nhận')}','{$bw->vars['global_websitename']} Dialog');
$('#check_code').focus();
return false;
}
return true;
}
$('#submit').click(function(){
if(!$("#userOldPassword").val()){
jAlert("{$vsLang->getWords('error_login_old_pas','Vui lòng nhập mật khẩu cũ!')}",'{$bw->vars['global_websitename']} Dialog');
$('#userOldPassword').focus();
return false;
}
if(jQuery.trim($('#userNewPassword').val())=="" || $('#userNewPassword').val()!=$('#userNewPasswordRe').val()) {
jAlert('{$vsLang->getWords('e_confirm_wrong','Mật khẩu xác nhận không chính xác!')}','{$bw->vars['global_websitename']} Dialog');
$('#userNewPassword').focus();
return false;
};
if(!validCode())
return false;
$('#user-infor-form').submit()
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <rsf:userInforForm:desc::trigger:>
//===========================================================================
function userInforForm($message='') {global $bw, $vsLang, $vsUser, $vsMenu, $vsPrint, $vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
		<div class="new_pro">
<div class="new_pro_top">
<span>{$vsLang->getWordsGlobal("user_infor","Thông tin thành viên")}</span> </div>
</div>
<div class="error"></div>
<div class="reg_form">
<form method="post" name="user-infor-form" id="user-infor-form">
<input type="hidden" name="userId" value="{$vsUser->obj->getId()}" />
<input type="hidden" name="userName" value="{$vsUser->obj->getName()}" />
<input type="hidden" name="userBirthday" id="userBirthday" value="" />
<table style="width: 100%">
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_name","Tên đăng nhập")}:</label></td>
<td class="reg_r"><input type="text" name="userName" id="userName" value="{$vsUser->obj->getName()}" readonly="readonly" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_email","Email")}:</label></td>
<td class="reg_r"><input type="text" name="userEmail" id="userEmail" value="{$vsUser->obj->getEmail()}"/></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_fullname","Họ và tên")}:</label></td>
<td class="reg_r"><input type="text" name="userFullName" id="userFullName" value="{$vsUser->obj->getFullName()}" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_date","Ngày sinh")}:</label></td>
<td class="reg_r reg_bd">
<select name="user_day" id="user_day"></select> 
<select name="user_month" id="user_month"></select> 
<select name="user_year" id="user_year"></select>
</td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_address","Địa chỉ")}:</label></td>
<td class="reg_r"><input type="text" name="userAddress" id="userAddress" value="{$vsUser->obj->getAddress()}" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_phone","Điện thoại")}:</label></td>
<td class="reg_r"><input type="text" name="userPhone" id="userPhone" value="{$vsUser->obj->getPhone()}" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_cache","Mã bảo vệ")}:</label></td>
<td class="reg_r">
<img id="siimage" class="captcha1" src="{$bw->vars['board_url']}/captcha/securimage_show.php" />
<a href="#" onclick="document.getElementById('siimage').src = '{$bw->vars['board_url']}/captcha/securimage_show.php?sid=' + Math.random(); return false"><img src="{$bw->vars['img_url']}/reg_refesh.jpg" class="captcha1"></a>
</td>
</tr>
<tr>
<td class="reg_l"></td>
<td class="reg_r"><input type="text" name="captcha" id="check_code" /></td>
</tr>
<tr>
<td class="reg_l"></td>
<td class="reg_r">
<input class="reg_btn" id="submit" name="submit" type="submit" value="{$vsLang->getWordsGlobal("user_infor_update","Cập nhật")}" />
</tr>
</table>
</form>
</div>
<div class="clear"></div>

<script language="javascript" type="text/javascript">
var arrayMonth =new Array(31,28,31,30,31,30,31,30,31,30,31,30);
function validCode(){
if($("#check_code").val() == ""){
jAlert('{$vsLang->getWords('err_code','Vui lòng nhập mã xác nhận')}','{$bw->vars['global_websitename']} Dialog');
$('#check_code').focus();
return false;
}
return true;
}
$(document).ready(function()
{
{$message}
var date = "{$vsUser->obj->getBirthday()}";
var list = date.split("/");
var date=new Date();
var month = list[1]?list[1]-1:date.getMonth();
var y = 1900 + date.getYear();
if(date.getMonth()==2){
var d = new Date("2,29,"+y);
if(d.getDate()==29)
arrayMonth[1]=29;
else 
arrayMonth[1]=28;
}
var i;
for(i=1;i<=arrayMonth[month];i++){
$("#user_day").append("<option value='"+i+"' >"+i+"</option>");
}
for(i=1;i<=12;i++){
$("#user_month").append("<option value='"+i+"' >"+i+"</option>");
}
for(i=1900+ date.getYear();i>=1900+ date.getYear()-70;i--){
$("#user_year").append("<option value='"+i+"' >"+i+"</option>");
}
if(date){
var the_USERFORM= window.document.getElementById('user-infor-form');
vsf.select(list[0],the_USERFORM.user_day);
vsf.select(list[1],the_USERFORM.user_month);
vsf.select(list[2],the_USERFORM.user_year);
}else{
vsf.jSelect(date.getDate(),'user_day');
vsf.jSelect(date.getMonth()+1,'user_month');
vsf.jSelect(1900+ date.getYear(),'user_year');
}
});
function createDay(day,month,year){
  var arrayMonth =new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
  if(month==2){
   var d=new Date("2,29,"+year);
   if(d.getDate()==29)
    arrayMonth[2]=29;
   else 
   arrayMonth[2]=28;
  }
  var i;
  $("select[id*='user_day']").find('option').detach();
  for(i=1;i<=arrayMonth[month];i++){
   $("#user_day").append("<option value='"+i+"'>"+i+"</option>");
  }
  if(day >= arrayMonth[month]) 
  day = arrayMonth[month];
  vsf.jSelect(day,'user_day');
}

function changDate(){
var d = $("#user_day").val();
var m = $("#user_month").val()-1;
var y = $("#user_year").val();
var i;
$("#user_day").html("<option value='0'>{$vsLang->getWords('day','Ngày')}</option>");
if(m==1)
{
var d = new Date("2,29,"+y);
if(d.getDate()==29)
arrayMonth[1] = 29;
else 
arrayMonth[1] = 28;
}
for(i=1;i<=arrayMonth[m];i++){
$("#user_day").append("<option value='"+i+"' >"+i+"</option>");
}
if(d > arrayMonth[m])
d = arrayMonth[m];
vsf.jSelect(d,'user_day');
}
 $("#user_month").change(function () {
                 var year = $("select[id*='user_year']").find(':selected').text();
                 var day = $("select[id*='user_day']").find(':selected').text();
        createDay(day,this.value,year)                
          })
           
   $("#user_year").change(function () {
            var month = $("select[id*='user_month']").find(':selected').text();
                var day = $("select[id*='user_day']").find(':selected').text();
       createDay(day,month,this.value)
          })
          
function checkMail(mail){
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
if (!filter.test(mail))
return false;
return true;
}

$('#submit').click(function(){
if(!$('#userEmail').val() || !checkMail($('#userEmail').val())) {
jAlert('{$vsLang->getWords('err_email','Vui lòng nhập địa chỉ email hợp lệ')}','{$bw->vars['global_websitename']} Dialog');
$('#userEmail').focus();
return false;
}
if(!$('#userFullName').val()) {
jAlert('{$vsLang->getWords('err_contact_name_blank','Vui lòng nhập họ tên!')}','{$bw->vars['global_websitename']} Dialog');
$('#userFullName').focus();
return false;
}
if($('#user_day').val()==0||$('#user_month').val()==0||$('#user_year').val()==0) {
jAlert('{$vsLang->getWords('e_date_wrong','Nhập vào đầy đủ thông số ngày tháng năm!')}','{$bw->vars['global_websitename']} Dialog');
return false;
}else{
var day = $('#user_day').val();
var month = $('#user_month').val();
var year  = $('#user_year').val();
var numdayofmonth = new Date(year, month, 0).getDate();
if(day>numdayofmonth){
var messa = "Tháng ["+month+"/"+year+"] chi có ["+numdayofmonth+"] ngày không thể có ngày ["+day+"].Nhập lại ngày";
jAlert(messa,'{$bw->vars['global_websitename']} Dialog');
return false;
}
var value = day+"/"+month+"/"+year;
$('#userBirthday').val(value);
}
if(!validCode())
return false;
$('#user-infor-form').submit()
});
$('#bt_cancel').click(function(){
$( "form" )[ 1 ].reset()
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <rsf:forgotPasswordForm:desc::trigger:>
//===========================================================================
function forgotPasswordForm($message='') {global $bw, $vsLang, $vsUser, $vsMenu, $vsPrint, $vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
		<div class="new_pro">
<div class="new_pro_top">
<span>{$vsLang->getWordsGlobal("user_forgot_password","Lấy Lại Mật Khẩu")}</span> </div>
</div>
<div class="error"></div>
<div class="reg_form">
<form method="post" name="user-forgot-form" id="user-forgot-form">
<table style="width: 100%">
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_email","Email")}:</label></td>
<td class="reg_r"><input type="text" name="userEmail" id="userEmail" value="{$bw->input['userEmail']}" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_cache","Mã bảo vệ")}:</label></td>
<td class="reg_r">
<img id="siimage" class="captcha1" src="{$bw->vars['board_url']}/captcha/securimage_show.php" />
<a href="#" onclick="document.getElementById('siimage').src = '{$bw->vars['board_url']}/captcha/securimage_show.php?sid=' + Math.random(); return false"><img src="{$bw->vars['img_url']}/reg_refesh.jpg" class="captcha1"></a>
</td>
</tr>
<tr>
<td class="reg_l"></td>
<td class="reg_r"><input type="text" name="captcha" id="check_code" /></td>
</tr>
<tr>
<td class="reg_l"></td>
<td class="reg_r">
<input class="reg_btn" id="submit" name="submit" type="submit" value="{$vsLang->getWordsGlobal("user_infor_update","Cập nhật")}" />
</tr>
</table>
</form>
</div>
<div class="clear"></div>
<script language="javascript" type="text/javascript">
$(document).ready(function(){

EOF;
if($message) {
$BWHTML .= <<<EOF

       jAlert("{$message}","{$bw->vars['global_websitename']} Dialog");
       
EOF;
}

$BWHTML .= <<<EOF

});
function checkMail(mail){
var filter = /^([a-zA-Z0-9_\\.\\-])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+$/;
if (!filter.test(mail))
return false;
return true;
}
function validCode(){
if($("#check_code").val() == ""){
jAlert('{$vsLang->getWords('err_code','Vui lòng nhập mã xác nhận')}','{$bw->vars['global_websitename']} Dialog');
$('#check_code').focus();
return false;
}
return true;
}
$('#user-forgot-form').submit(function(){
if(!$("#userEmail").val()){
jAlert("{$vsLang->getWords('error_email','Vui lòng nhập email!')}",'{$bw->vars['global_websitename']} Dialog');
$('#userEmail').focus();
return false;
}
if(!checkMail($('#userEmail').val())) {
jAlert('{$vsLang->getWords('err_type_email','Email không hợp lệ!')}','{$bw->vars['global_websitename']} Dialog');
$('#userEmail').focus();
return false;
}
if(!validCode())
return false;
$('#user-forgot-form').submit()
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <rsf:loginForm:desc::trigger:>
//===========================================================================
function loginForm($message='') {global $bw, $vsLang, $vsUser, $vsMenu, $vsPrint, $vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
		<div class="new_pro">
<div class="new_pro_top">
<span>{$vsLang->getWords('user_title_login','Đăng nhập')}</span> </div>
</div>
<div class="error"></div>
<div class="reg_form">
<form method="post" name="user-login-form" id="user-login-form" action="{$bw->base_url}users/login-process/">
<table style="width: 100%">
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("global_account","Tài khoản")}:</label></td>
<td class="reg_r"><input type="text" name="userName" id="userName" value="{$bw->input['userName']}" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("global_password","Mật khẩu")}:</label></td>
<td class="reg_r"><input type="password" name="userPassword" id="userPassword" value="{$bw->input['userPassword']}" /></td>
</tr>
<tr>
<td class="reg_l"><label id="Label1">{$vsLang->getWordsGlobal("user_cache","Mã bảo vệ")}:</label></td>
<td class="reg_r">
<img id="siimage" class="captcha1" src="{$bw->vars['board_url']}/captcha/securimage_show.php" />
<a href="#" onclick="document.getElementById('siimage').src = '{$bw->vars['board_url']}/captcha/securimage_show.php?sid=' + Math.random(); return false"><img src="{$bw->vars['img_url']}/reg_refesh.jpg" class="captcha1"></a>
</td>
</tr>
<tr>
<td class="reg_l"></td>
<td class="reg_r"><input type="text" name="captcha" id="check_code" /></td>
</tr>
<tr>
<td class="reg_l"></td>
<td class="reg_r">
<input class="reg_btn" id="submit" name="submit" type="submit" value="{$vsLang->getWordsGlobal("global_login_bt","Đăng nhập")}" />
</tr>
</table>
</form>
</div>
<div class="clear"></div>
<script language="javascript" type="text/javascript">
$(document).ready(function(){

EOF;
if($message) {
$BWHTML .= <<<EOF

       jAlert("{$message}","{$bw->vars['global_websitename']} Dialog");
       
EOF;
}

$BWHTML .= <<<EOF

});
function validCode(){
if($("#check_code").val() == ""){
jAlert('{$vsLang->getWords('err_code','Vui lòng nhập mã xác nhận')}','{$bw->vars['global_websitename']} Dialog');
$('#check_code').focus();
return false;
}
return true;
}
$('#user-login-form').submit(function(){
if(!$("#userName").val()){
jAlert("{$vsLang->getWords('error_username','Vui lòng nhập tên đăng nhập!')}",'{$bw->vars['global_websitename']} Dialog');
$('#userName').focus();
return false;
}
if(!$("#userPassword").val()){
jAlert("{$vsLang->getWords('error_email','Vui lòng nhập mật khẩu!')}",'{$bw->vars['global_websitename']} Dialog');
$('#userPassword').focus();
return false;
}
if(!validCode())
return false;
$('#user-login-form').submit()
});
</script>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>