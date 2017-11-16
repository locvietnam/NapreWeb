<?php /* Smarty version 3.1.28-dev/21, created on 2017-10-03 08:05:10
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\home\main-footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:3068059d328962a8ba5_03779090%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bbe2a138d5bc05d3b5518868aeab19e74eb0c84' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\home\\main-footer.tpl',
      1 => 1506994557,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3068059d328962a8ba5_03779090',
  'variables' => 
  array (
    'links' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_59d328962ab6e1_73979025',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59d328962ab6e1_73979025')) {
function content_59d328962ab6e1_73979025 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '3068059d328962a8ba5_03779090';
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