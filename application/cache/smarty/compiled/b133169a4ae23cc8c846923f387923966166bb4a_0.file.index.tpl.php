<?php /* Smarty version 3.1.28-dev/21, created on 2017-11-20 03:07:18
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\layout\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:60745a1238d6c389b5_64853433%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b133169a4ae23cc8c846923f387923966166bb4a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\layout\\index.tpl',
      1 => 1511143587,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60745a1238d6c389b5_64853433',
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_5a1238d6c7aa01_75045253',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a1238d6c7aa01_75045253')) {
function content_5a1238d6c7aa01_75045253 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '60745a1238d6c389b5_64853433';
?>
	<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

    <div class="wrapper">
        <!-- main-header -->
        <?php echo $_smarty_tpl->getSubTemplate ("sidebar_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

        <!-- /main-header -->

        <!-- main-sidebar -->
        <?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

        <!-- /main-sidebar -->

        <!-- main-wrapper -->
        <div class="content-wrapper">
        	
        	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['content']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

            
        </div>
        <!-- /content-wrapper -->

        <!-- main-footer -->
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['current_control']->value)."/main-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>
        
        <!-- /main-footer -->
    </div>
	
    <?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>