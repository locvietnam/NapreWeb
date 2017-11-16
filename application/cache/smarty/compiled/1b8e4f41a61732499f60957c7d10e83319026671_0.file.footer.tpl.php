<?php /* Smarty version 3.1.28-dev/21, created on 2017-10-04 02:57:56
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\login\footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:338959d4321432fa37_37782055%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b8e4f41a61732499f60957c7d10e83319026671' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\login\\footer.tpl',
      1 => 1506994560,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '338959d4321432fa37_37782055',
  'variables' => 
  array (
    'base_tlp_admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_59d43214337c72_32745176',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59d43214337c72_32745176')) {
function content_59d43214337c72_32745176 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '338959d4321432fa37_37782055';
?>
<p class="login-copyright">Copyright ©, 2015 A-LINE. All rights reserved.</p>

    <!-- Library JavaScript
    ================================================== -->
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
		
        window.jQuery || document.write('<?php echo '<script'; ?>
 src="assets/js/jquery-1.11.3.min.js"><\/script>')
		
    <?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/main.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/custom.js"><?php echo '</script'; ?>
>

</body>

</html><?php }
}
?>