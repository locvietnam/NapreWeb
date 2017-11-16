<?php /* Smarty version 3.1.28-dev/21, created on 2017-10-04 02:57:56
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\login\header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2421259d4321430f557_69334241%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e739a598a6ba1df4628b0cf425057b14154a59a2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\login\\header.tpl',
      1 => 1506994561,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2421259d4321430f557_69334241',
  'variables' => 
  array (
    'lable' => 0,
    'base_tlp_admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_59d4321431f768_14751887',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59d4321431f768_14751887')) {
function content_59d4321431f768_14751887 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2421259d4321430f557_69334241';
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
    <title><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_login_title'];?>
</title>

    <!-- Load Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700,900|Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/main.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/custom.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/css/skins/default.css" rel="stylesheet">

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
	var base_tpl_admin = "<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
";
	
    if ( /*@cc_on!@*/ false && document.documentMode === 10)
    {
        document.documentElement.className += ' ie ie10';
    }
	
    <?php echo '</script'; ?>
>
</head>

<body class="login-page skin-default"><?php }
}
?>