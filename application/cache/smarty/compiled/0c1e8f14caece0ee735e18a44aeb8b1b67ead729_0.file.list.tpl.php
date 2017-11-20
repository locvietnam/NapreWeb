<?php /* Smarty version 3.1.28-dev/21, created on 2017-11-20 08:04:04
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\comment\list.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:105755a127e648ae508_24515129%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c1e8f14caece0ee735e18a44aeb8b1b67ead729' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\comment\\list.tpl',
      1 => 1511161442,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105755a127e648ae508_24515129',
  'variables' => 
  array (
    'lable' => 0,
    'hospitalData' => 0,
    'itemH' => 0,
    'datecomment' => 0,
    'strtime' => 0,
    'listDept' => 0,
    'item' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_5a127e6491ee01_16391159',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a127e6491ee01_16391159')) {
function content_5a127e6491ee01_16391159 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '105755a127e648ae508_24515129';
?>
			<section class="content-header">
            	<form action="" method="get" name="fcomments" id="fcomments">
                <div class="col-md-3">
                	<label class="col-sm-4 control-label text-right">
                    <?php echo $_smarty_tpl->tpl_vars['lable']->value['choose_hospital'];?>

                    </label>
                    <div class="col-sm-8">
                        <select class="form-control" name="hospital_id" id="hospital_id">
                           <option value="">---</option>
                            <?php if ($_smarty_tpl->tpl_vars['hospitalData']->value) {?>
                                <?php
$foreach_0_itemH_sav['s_item'] = isset($_smarty_tpl->tpl_vars['itemH']) ? $_smarty_tpl->tpl_vars['itemH'] : false;
$_from = $_smarty_tpl->tpl_vars['hospitalData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['itemH'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['itemH']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['itemH']->value) {
$_smarty_tpl->tpl_vars['itemH']->_loop = true;
$foreach_0_itemH_sav['item'] = $_smarty_tpl->tpl_vars['itemH'];
?>
                            <option <?php if (isset($_GET['hospital_id']) && $_GET['hospital_id'] == $_smarty_tpl->tpl_vars['itemH']->value['hospital_id']) {?>selected<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['itemH']->value['hospital_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['itemH']->value['hospital_name'];?>
</option>
                                <?php
$_smarty_tpl->tpl_vars['itemH'] = $foreach_0_itemH_sav['item'];
}
if ($foreach_0_itemH_sav['s_item']) {
$_smarty_tpl->tpl_vars['itemH'] = $foreach_0_itemH_sav['s_item'];
}
?>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                	<input class="form-control" placeholder="Select Datetime" name="datecomment" value="<?php echo $_smarty_tpl->tpl_vars['datecomment']->value;?>
" />
                	<input type="hidden" id="strtime" value="<?php echo $_smarty_tpl->tpl_vars['strtime']->value;?>
" />
                </div>
                <div class="col-md-3">
                	<select name="dept" id="dept" class="form-control">
                    	<option value=""> --- <?php echo $_smarty_tpl->tpl_vars['lable']->value['select_department'];?>
 --- </option>
                        <?php
$foreach_1_item_sav['s_item'] = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_from = $_smarty_tpl->tpl_vars['listDept']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$foreach_1_item_sav['item'] = $_smarty_tpl->tpl_vars['item'];
?>
                        	<option <?php if (isset($_GET['dept']) && $_GET['dept'] == $_smarty_tpl->tpl_vars['item']->value->department_id) {?>selected<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['item']->value->department_id;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->department_name;?>
</option>
                        <?php
$_smarty_tpl->tpl_vars['item'] = $foreach_1_item_sav['item'];
}
if ($foreach_1_item_sav['s_item']) {
$_smarty_tpl->tpl_vars['item'] = $foreach_1_item_sav['s_item'];
}
?>
                    </select>
                    <input type="submit" style="display:none;" value="search">
                </div>
                </form>
            </section>

            <section class="content">
            	<?php
$foreach_2_item_sav['s_item'] = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_from = $_smarty_tpl->tpl_vars['list']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$foreach_2_item_sav['item'] = $_smarty_tpl->tpl_vars['item'];
?>
                <!-- box -->
                <div class="box box-solid">
                    <div class="box-header">
                        <h4 class="box-title"><?php echo $_smarty_tpl->tpl_vars['item']->value['user_fullname'];?>
</h4>
                    </div>
                    <div class="box-body">
                        <p class="time text-success"><?php echo $_smarty_tpl->tpl_vars['item']->value['fadd_date'];?>
</p>
                        <p><?php echo $_smarty_tpl->tpl_vars['item']->value['comments'];?>
</p>
                    </div>
                </div>
                <!-- /box -->
				<?php
$_smarty_tpl->tpl_vars['item'] = $foreach_2_item_sav['item'];
}
if ($foreach_2_item_sav['s_item']) {
$_smarty_tpl->tpl_vars['item'] = $foreach_2_item_sav['s_item'];
}
?>

            </section><?php }
}
?>