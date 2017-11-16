<?php /* Smarty version 3.1.28-dev/21, created on 2017-10-03 08:05:10
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\sidebar_header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2168559d328961b30c2_92266668%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fae334061395fca588dc7dc6eeb25fe517ee314f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\sidebar_header.tpl',
      1 => 1506994556,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2168559d328961b30c2_92266668',
  'variables' => 
  array (
    'base_tlp_admin' => 0,
    'title_page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_59d328961c25c7_38653027',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59d328961c25c7_38653027')) {
function content_59d328961c25c7_38653027 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2168559d328961b30c2_92266668';
?>
<!-- main-header -->
<header class="main-header">
    <a href="index.html" class="logo">
        <span class="logo-mini"><b>A-</b>LI</span>
        <span class="logo-lg"><img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/logo.png" alt="A-Line"></span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="page-title"><?php echo $_smarty_tpl->tpl_vars['title_page']->value;?>
</div>
    </nav>
</header>
<!-- /main-header --><?php }
}
?>