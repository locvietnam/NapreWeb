{include file="login/header.tpl"}

<div class="login-box">
    <div class="login-logo">
        <a href="index.html"><img src="{$base_tlp_admin}/img/logo-dark.png" alt="A-Line"></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-content">
		{if $error neq ''} {include file="error.tpl"} {/if}
        <form role="form" method="post" action="{$base_url_admin}/login/">
            <div class="form-group has-feedback">
                <input name="username" type="text" class="form-control" placeholder="{$lable.username}">
            </div>
            <div class="form-group has-feedback">
                <input name="password" type="password" class="form-control" placeholder="{$lable.password}">
            </div>
            <div class="form-group has-feedback m-t-50">
                <button type="submit" class="form-control bg-danger hoverJS">{$lable.btn_login}
                    <span class="icon-arrow-right"></span>
                </button>
                <div class="checkbox">
                    <label>
                    	<a href="{$base_url_admin}/forgot/">{$lable.forgot_password}</a>
                    </label>
                </div>
            </div>
        </form>

    </div>
</div>

{include file="login/footer.tpl"}
