<section class="content p-t-30">
<form action="" method="post">
<input type="text" value="{set_value('username')}" name="username" placeholder="Tài khoản" />
<p class="error">{form_error('username')}</p>
<input type="password" value="{set_value('password')}" name="password" />
<p class="error">{form_error('password')}</p>
<input type="password" value="{set_value('repassword')}" name="repassword" />
<p class="error">{form_error('repassword')}</p>
<button type="submit" >Lưu</button>
</form>
</section>