<?php /* Smarty version 3.1.28-dev/21, created on 2017-10-03 08:05:16
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\reportchecklist\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1179859d3289c0830d0_97079444%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48ef96fabb3c03bd1227c4dc7bcb17f51123301b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\reportchecklist\\index.tpl',
      1 => 1506994583,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1179859d3289c0830d0_97079444',
  'variables' => 
  array (
    'lable' => 0,
    'hospitalData' => 0,
    'itemH' => 0,
    'departmentData' => 0,
    'itemD' => 0,
    'yearData' => 0,
    'monthData' => 0,
    'list' => 0,
    'item' => 0,
    'itemSub' => 0,
    'base_tlp_admin' => 0,
    'sum_percent' => 0,
    'base_url_admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_59d3289c12a382_29638620',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59d3289c12a382_29638620')) {
function content_59d3289c12a382_29638620 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1179859d3289c0830d0_97079444';
?>
            <section class="content-header">
                
                <form class="form-horizontal margin-none" name="freportchecklist" id="freportchecklist" method="get" action="" enctype="multipart/form-data">
                      
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        <?php echo $_smarty_tpl->tpl_vars['lable']->value['choose_hospital'];?>

                        </label>
                        <div class="col-sm-4">
                            <select class="form-control" name="hospital_id" id="hospital_id">
                               <option>---</option>
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

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        <?php echo $_smarty_tpl->tpl_vars['lable']->value['choose_department'];?>

                        </label>
                        <div class="col-sm-4">
                            <select class="form-control" name="department_id" id="department_id">
                                <?php if ($_smarty_tpl->tpl_vars['departmentData']->value) {?>
                                    <?php
$foreach_1_itemD_sav['s_item'] = isset($_smarty_tpl->tpl_vars['itemD']) ? $_smarty_tpl->tpl_vars['itemD'] : false;
$_from = $_smarty_tpl->tpl_vars['departmentData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['itemD'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['itemD']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['itemD']->value) {
$_smarty_tpl->tpl_vars['itemD']->_loop = true;
$foreach_1_itemD_sav['item'] = $_smarty_tpl->tpl_vars['itemD'];
?>
                                <option <?php if (isset($_GET['department_id']) && $_GET['department_id'] == $_smarty_tpl->tpl_vars['itemD']->value->department_id) {?>selected<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['itemD']->value->department_id;?>
"><?php echo $_smarty_tpl->tpl_vars['itemD']->value->department_name;?>
</option>
                                    <?php
$_smarty_tpl->tpl_vars['itemD'] = $foreach_1_itemD_sav['item'];
}
if ($foreach_1_itemD_sav['s_item']) {
$_smarty_tpl->tpl_vars['itemD'] = $foreach_1_itemD_sav['s_item'];
}
?>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        <?php echo $_smarty_tpl->tpl_vars['lable']->value['year_month'];?>

                        </label>
                        <div class="col-sm-4">
                            <select class="form-control" name="year" id="year">
                            <?php echo $_smarty_tpl->tpl_vars['yearData']->value;?>

                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="month" id="month">
                            <?php echo $_smarty_tpl->tpl_vars['monthData']->value;?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-2"> &nbsp; </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary"> <?php echo $_smarty_tpl->tpl_vars['lable']->value['btn_view'];?>
 </button>
                        </div>
                    </div>
                </form>
            </section>

            <section class="content">
                <div class="table-responsive">
                    <table class="table table-bordered table-custom text-center text-bold" style="width: 99%;">
                        <tr class="text-purple f-16">
                            <th style="min-width: 20%; width: 20%;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['reportchecklist_day_of_month'];?>

							</th>
                            <th style="min-width: 20%; width: 20%;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['reportchecklist_percent_completion'];?>
(%)
							</th>
                            <th style="min-width: 60%; width: 60%;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['reportchecklist_icon'];?>
</th>
                        </tr>                        
                        <?php if ($_smarty_tpl->tpl_vars['list']->value) {?>
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
                        <tr>
                            <td class="text-danger f-mont f-16"><?php echo $_smarty_tpl->tpl_vars['item']->value->fdate_add;?>
 </td>
                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value->percent;?>
</td>
                            <td>
                                <div class="row">
                                	<?php
$foreach_3_itemSub_sav['s_item'] = isset($_smarty_tpl->tpl_vars['itemSub']) ? $_smarty_tpl->tpl_vars['itemSub'] : false;
$_from = $_smarty_tpl->tpl_vars['item']->value->users;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['itemSub'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['itemSub']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['itemSub']->value) {
$_smarty_tpl->tpl_vars['itemSub']->_loop = true;
$foreach_3_itemSub_sav['item'] = $_smarty_tpl->tpl_vars['itemSub'];
?>
                                    <div class="item-user col-lg-3 col-md-3 col-xs-4 col-4">                           
                                        <?php if ($_smarty_tpl->tpl_vars['itemSub']->value['emotion_icon'] == 1) {?>
                                                <img  src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-1-xanh.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                                            
                                        <?php } elseif ($_smarty_tpl->tpl_vars['itemSub']->value['emotion_icon'] == 2) {?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-2-xanh.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                                                                                    
                                        <?php } elseif ($_smarty_tpl->tpl_vars['itemSub']->value['emotion_icon'] == 3) {?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-3-xanh.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                                        <?php }?>
                                    </div>
                                    <?php
$_smarty_tpl->tpl_vars['itemSub'] = $foreach_3_itemSub_sav['item'];
}
if ($foreach_3_itemSub_sav['s_item']) {
$_smarty_tpl->tpl_vars['itemSub'] = $foreach_3_itemSub_sav['s_item'];
}
?>                            		
                                </div>
                            </td>
                        </tr>
                        <?php
$_smarty_tpl->tpl_vars['item'] = $foreach_2_item_sav['item'];
}
if ($foreach_2_item_sav['s_item']) {
$_smarty_tpl->tpl_vars['item'] = $foreach_2_item_sav['s_item'];
}
?>
                        <?php }?>
						<tr>
							<td>
								<?php echo $_smarty_tpl->tpl_vars['lable']->value['total_percent'];?>

							</td>
							<td>
								<?php echo $_smarty_tpl->tpl_vars['sum_percent']->value;?>
(%)
							</td>
							<td></td>
						</tr>                        
                    </table>
                </div>
                <form class="form-horizontal margin-none" name="freportchecklist" id="fexportreportchecklist" method="post" action="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/export-pdf.html" >
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        <?php echo $_smarty_tpl->tpl_vars['lable']->value['report_comment'];?>

                        </label>
                        <div class="col-sm-4">
                            <textarea class="form-control" name="report_comment" id="report_comment"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        <?php echo $_smarty_tpl->tpl_vars['lable']->value['staff_report'];?>

                        </label>
                        <div class="col-sm-4">
                            <input class="form-control" name="staff_report" id="staff_report"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-2"> &nbsp; </div>
                        <div class="col-xs-4">
                          <input name="hospital_id" type="hidden" value="<?php if (isset($_GET['hospital_id'])) {
echo $_GET['hospital_id'];
}?>">
                          <input name="department_id" type="hidden" value="<?php if (isset($_GET['department_id'])) {
echo $_GET['department_id'];
}?>">
                          <input name="year" type="hidden" value="<?php if (isset($_GET['year'])) {
echo $_GET['year'];
}?>">
                          <input name="month" type="hidden" value="<?php if (isset($_GET['month'])) {
echo $_GET['month'];
}?>">                          
                           <?php if ($_smarty_tpl->tpl_vars['list']->value) {?>
                            <button type="submit" class="btn btn-primary"> <?php echo $_smarty_tpl->tpl_vars['lable']->value['btn_exportPDF'];?>
 </button>
                            <?php }?>
                        </div>
                    </div>
                </form>
            </section><?php }
}
?>