<?php /* Smarty version 3.1.28-dev/21, created on 2017-10-04 02:57:56
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\login\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2122359d43214257299_67224954%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c914c9b350185ec7eb67b5440a6eb5ae8bf6f53' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\login\\index.tpl',
      1 => 1506994561,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2122359d43214257299_67224954',
  'variables' => 
  array (
    'base_tlp_admin' => 0,
    'error' => 0,
    'base_url_admin' => 0,
    'lable' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_59d432142ed074_59126490',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59d432142ed074_59126490')) {
function content_59d432142ed074_59126490 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2122359d43214257299_67224954';
echo $_smarty_tpl->getSubTemplate ("login/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="login-box">
    <div class="login-logo">
        <a href="index.html"><img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/logo-dark.png" alt="A-Line"></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-content">
		<?php if ($_smarty_tpl->tpl_vars['error']->value != '') {?> <?php echo $_smarty_tpl->getSubTemplate ("error.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>
 <?php }?>
        <form role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/login/">
            <div class="form-group has-feedback">
                <input name="username" type="text" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['lable']->value['username'];?>
">
            </div>
            <div class="form-group has-feedback">
                <input name="password" type="password" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['lable']->value['password'];?>
">
            </div>
            <div class="form-group has-feedback m-t-50">
                <button type="submit" class="form-control bg-danger hoverJS"><?php echo $_smarty_tpl->tpl_vars['lable']->value['btn_login'];?>

                    <span class="icon-arrow-right"></span>
                </button>
                <div class="checkbox">
                    <label>
                    	<a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/forgot/"><?php echo $_smarty_tpl->tpl_vars['lable']->value['forgot_password'];?>
</a>
                    </label>
                </div>
            </div>
        </form>

    </div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("login/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<?php }
}
?>