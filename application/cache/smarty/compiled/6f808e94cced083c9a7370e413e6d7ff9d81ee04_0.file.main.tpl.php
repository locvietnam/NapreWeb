<?php /* Smarty version 3.1.28-dev/21, created on 2017-10-03 09:32:33
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\setup\main.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2011159d33d115ed6f5_70908381%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f808e94cced083c9a7370e413e6d7ff9d81ee04' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\setup\\main.tpl',
      1 => 1506994567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2011159d33d115ed6f5_70908381',
  'variables' => 
  array (
    'base_tlp_admin' => 0,
    'keyword' => 0,
    'lable' => 0,
    'list' => 0,
    'v' => 0,
    'links' => 0,
    'base_url_admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_59d33d11667b34_44645074',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59d33d11667b34_44645074')) {
function content_59d33d11667b34_44645074 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2011159d33d115ed6f5_70908381';
?>
            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">Add language</h4>
                    <div class="group-btn">
                        <a class="hoverJS" href="javascript:void(0);" data-toggle="modal" data-target="#modalAddlang" title="Create">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/icon-add.png">
                        </a>
                    </div>
                </div>
                <div class="box-header p-l-0 p-r-0">
                    <form method="get" action="" name="box_search">
                        <div class="col-md-4 pad-left-0 p-r-0">
                            <input class="form-control" id="appendedInputButtons" type="text" name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
" placeholder="Tìm kiếm ..." />
                        </div>
                        <div class="col-md-2 pad-left-0 p-r-0">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><strong><?php echo $_smarty_tpl->tpl_vars['lable']->value['search'];?>
</strong></button>
							</div>
						</div>
                    </form>
                    <div class="separator"></div>
                </div>
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-custom text-center variables-list">
                        <tr class="text-purple text-bold f-16">
                            <th style="min-width: 100px; width: 100px;">Name</th>
                            <th style="min-width: 150px; width: 150px;">Lang</th>
                            <th>Value</th>
                            <th>&nbsp;</th>
                        </tr>
                        <?php
$foreach_0_v_sav['s_item'] = isset($_smarty_tpl->tpl_vars['v']) ? $_smarty_tpl->tpl_vars['v'] : false;
$foreach_0_v_sav['s_key'] = isset($_smarty_tpl->tpl_vars['k']) ? $_smarty_tpl->tpl_vars['k'] : false;
$_from = $_smarty_tpl->tpl_vars['list']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['v']->_loop = false;
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$foreach_0_v_sav['item'] = $_smarty_tpl->tpl_vars['v'];
?>
                        <tr>
                            <td ><?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['v']->value->lang;?>
</td>
                            <td>
                            <label class="lab-<?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>
__<?php echo $_smarty_tpl->tpl_vars['v']->value->lang;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value->value;?>
</label>
                            <input class="form-control" onkeyup="update(this, event);" value="<?php echo $_smarty_tpl->tpl_vars['v']->value->value;?>
" style="display:none" id="<?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>
__<?php echo $_smarty_tpl->tpl_vars['v']->value->lang;?>
"  name="<?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>
__<?php echo $_smarty_tpl->tpl_vars['v']->value->lang;?>
" />
                            </td>
                            <td style="width:120px;">
                           <!-- <a class="hoverJS" href="javascript:void(0);" title="Delete">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/icon-delete.png">
                            </a>-->
                            <a class="btn btn-danger lang_values" data-id="<?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>
__<?php echo $_smarty_tpl->tpl_vars['v']->value->lang;?>
" href="javascript:void(0);" title="Edit" style="border-radius:50%; padding:4px 7px;">
                                <i class="fa fa-edit"></i>
                            </a>
                            </td>
                        </tr>
                        <?php
$_smarty_tpl->tpl_vars['v'] = $foreach_0_v_sav['item'];
}
if ($foreach_0_v_sav['s_item']) {
$_smarty_tpl->tpl_vars['v'] = $foreach_0_v_sav['s_item'];
}
if ($foreach_0_v_sav['s_key']) {
$_smarty_tpl->tpl_vars['k'] = $foreach_0_v_sav['s_key'];
}
?>
                    </table>
                </div>
                <?php echo $_smarty_tpl->tpl_vars['links']->value;?>

                <!-- /Table -->
                
                <!-- modal-Addlang -->
                <div class="modal modal-purple fade" id="modalAddlang">
                    <div class="modal-dialog modal-purple">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-center">Add language</h4>
                                <button type="button" class="close">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body-content">
                                    <form name="fAddLang" id="fAddLang" class='form-horizontal' method="post" action="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/setup/add">
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">
                                            Name
                                            <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input id="name" name="name" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">
                                            Language
                                            <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <select id="lang" name="lang" class="form-control" style="padding-top:1px;" >
                                                    <option value="ja">Japan</option>
                                                    <option value="en">English</option>
                                                </select>                        
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">
                                            Value
                                            <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input id="value" name="value" class="form-control" />
                                            </div>
                                        </div>
                                        
                                        <hr class="row clearfix m-lr-25"></hr>
                                        <div class="row">
                                            <div class="col-xs-6">
                                            </div>
                                            <div class="col-xs-6">
                                                <button type="submit" class="btn bg-danger btn-custom btn-block">解約</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Modal-addlang -->
            </section>
<?php }
}
?>