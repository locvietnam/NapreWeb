<?php /* Smarty version 3.1.28-dev/21, created on 2017-11-20 02:25:13
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:256855a122ef96ea4f0_36752759%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0ba9a587b9ce3a62d3a69e880f96dd49b50ffb5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\header.tpl',
      1 => 1511139950,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '256855a122ef96ea4f0_36752759',
  'variables' => 
  array (
    'lable' => 0,
    'base_tlp_admin' => 0,
    'base_url' => 0,
    'base_url_admin' => 0,
    'current_control' => 0,
    'current_method' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_5a122ef9723e93_96315694',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a122ef9723e93_96315694')) {
function content_5a122ef9723e93_96315694 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '256855a122ef96ea4f0_36752759';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_cpanel_title'];?>
</title>

    <!-- Load Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700,900|Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" media="all" href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/daterangepicker.css" />-->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/js/ui/1.12.1/themes/smoothness/jquery-ui.css">
	
	<link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/select2.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/main.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/custom.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/update.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/skins/default.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/lchung.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
    <?php echo '<script'; ?>
>
		var base_url = "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
";
		var base_url_admin = "<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
"; 
		var base_tlp_admin = "<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
"; 
		var current_control = "<?php echo $_smarty_tpl->tpl_vars['current_control']->value;?>
";
		var current_method  = "<?php echo $_smarty_tpl->tpl_vars['current_method']->value;?>
";
		
		var require_input_field	= "<?php echo stripslashes($_smarty_tpl->tpl_vars['lable']->value['require_input_field']);?>
";
		var message_confirm_del = "<?php echo $_smarty_tpl->tpl_vars['lable']->value['confirm_del'];?>
?";
	
    <?php echo '</script'; ?>
>
</head>

<body class="skin-default sidebar-mini"><?php }
}
?>