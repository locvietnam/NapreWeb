<?php /* Smarty version 3.1.28-dev/21, created on 2017-11-20 02:25:13
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:264225a122ef98ac5a3_70703603%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee4824629927265723c629b5cf682c52428c0681' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\footer.tpl',
      1 => 1511139950,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '264225a122ef98ac5a3_70703603',
  'variables' => 
  array (
    'user_data' => 0,
    'base_url_admin' => 0,
    'base_tlp_admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_5a122ef98c0c92_01150087',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a122ef98c0c92_01150087')) {
function content_5a122ef98c0c92_01150087 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '264225a122ef98ac5a3_70703603';
?>
<!-- popup-logout -->
    <div class="modal modal-purple modal-center fade" id="modalLogout">
        <div class="modal-dialog modal-xs modal-purple">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="text-center">
                        <?php echo $_smarty_tpl->tpl_vars['user_data']->value->user_fullname;?>
 さん、お疲れ様 でした。<br>ありがとうございます！
                    </p>
                    <div class="row">
                        <div class="col-sm-8 col-xs-10 col-sm-offset-2 col-xs-offset-1">
                        	<form action="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/login/logout">
                            <button type="submit" class="btn btn-danger btn-custom btn-block">終了</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /popup-logout -->

    <!-- Library JavaScript
    ================================================== -->
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        window.jQuery || document.write('<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/jquery-1.11.3.min.js"><\/script>')
    <?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/moment.js"><?php echo '</script'; ?>
>
    <!--<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/daterangepicker.js"><?php echo '</script'; ?>
>-->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/ui/1.12.1/jquery-ui.js"><?php echo '</script'; ?>
>	
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/select2.min.js"><?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/main.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/custom.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/update.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/lchung-custom.js"><?php echo '</script'; ?>
>

</body>

</html><?php }
}
?>