<?php /* Smarty version 3.1.28-dev/21, created on 2017-11-20 02:25:13
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\index\main.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:10165a122ef9858bf1_41248375%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba1166b07c24c82c68594f174c04ee5c73090670' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\index\\main.tpl',
      1 => 1511139951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10165a122ef9858bf1_41248375',
  'variables' => 
  array (
    'list' => 0,
    'item' => 0,
    'user_data' => 0,
    'lable' => 0,
    'base_tlp_admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_5a122ef987f484_93761671',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a122ef987f484_93761671')) {
function content_5a122ef987f484_93761671 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '10165a122ef9858bf1_41248375';
?>
        <section class="content-header text-success">
            <ul class="list-inline">
                <li class="text-success"><span class="icon-calendar"></span> <?php echo date('Y/m/d');?>
</li>
            </ul>
        </section>
        
        <section class="content">
            <?php if ($_smarty_tpl->tpl_vars['list']->value) {?>
                <?php
$foreach_0_item_sav['s_item'] = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_from = $_smarty_tpl->tpl_vars['list']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$foreach_0_item_sav['item'] = $_smarty_tpl->tpl_vars['item'];
?>
            <!-- box -->
            <div class="box box-solid">
                <div class="box-header">
                    <h4 class="box-title text-purple f-mont"><?php if ($_smarty_tpl->tpl_vars['item']->value['message_type'] == 'U') {?>Top manager<?php } else { ?>A-LINE<?php }?></h4>
                </div>
                <div class="box-body">
                    <p class="time text-success"><?php echo $_smarty_tpl->tpl_vars['item']->value['ftime'];?>

                    <?php if ($_smarty_tpl->tpl_vars['item']->value['user_id_received'] == $_smarty_tpl->tpl_vars['user_data']->value->user_id) {?>
                    	<a style="cursor:pointer; float:right;" onclick="deleteMessage(this, '<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
','<?php echo $_smarty_tpl->tpl_vars['lable']->value['confirm_del'];?>
?');" >
                        <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/icon-delete.png">
                        </a>
                    <?php }?></p>
                    <p><?php echo $_smarty_tpl->tpl_vars['item']->value['contents'];?>
</p>
                </div>
            </div>
            <!-- /box -->
                <?php
$_smarty_tpl->tpl_vars['item'] = $foreach_0_item_sav['item'];
}
if ($foreach_0_item_sav['s_item']) {
$_smarty_tpl->tpl_vars['item'] = $foreach_0_item_sav['s_item'];
}
?>
            <?php }?>
        </section>
<?php }
}
?>