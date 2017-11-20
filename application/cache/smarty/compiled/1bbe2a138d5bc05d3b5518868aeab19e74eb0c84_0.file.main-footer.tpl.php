<?php /* Smarty version 3.1.28-dev/21, created on 2017-11-20 02:25:13
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\home\main-footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:288815a122ef9896a51_24061667%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bbe2a138d5bc05d3b5518868aeab19e74eb0c84' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\home\\main-footer.tpl',
      1 => 1511139951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '288815a122ef9896a51_24061667',
  'variables' => 
  array (
    'links' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_5a122ef989a029_47637061',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a122ef989a029_47637061')) {
function content_5a122ef989a029_47637061 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '288815a122ef9896a51_24061667';
?>
		<div class="main-footer">
            <div class="content-footer">
            	<?php echo $_smarty_tpl->tpl_vars['links']->value;?>

                <!--<div class="col-lg-3 col-md-4 col-sm-6 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-1">
                    <a href="#" title="次へ" class="btn btn-danger btn-block btn-custom">次へ</a>
                </div>-->
            </div>
        </div><?php }
}
?>