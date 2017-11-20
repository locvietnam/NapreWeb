<?php /* Smarty version 3.1.28-dev/21, created on 2017-11-20 06:49:43
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\checklistresults\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:230565a126cf7e66556_85927024%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39eb193b9a2015d355278b61539c015f37c5743f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\checklistresults\\index.tpl',
      1 => 1511156973,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '230565a126cf7e66556_85927024',
  'variables' => 
  array (
    'lable' => 0,
    'finddate' => 0,
    'yearData' => 0,
    'monthData' => 0,
    'dayData' => 0,
    'hospitalData' => 0,
    'itemH' => 0,
    'departmentData' => 0,
    'itemD' => 0,
    'list' => 0,
    'item' => 0,
    'base_url_admin' => 0,
    'base_tlp_admin' => 0,
    'itemSub' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_5a126cf800b2e9_02973737',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a126cf800b2e9_02973737')) {
function content_5a126cf800b2e9_02973737 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '230565a126cf7e66556_85927024';
?>
			<section class="content-header">
            	<form class="form-horizontal margin-none" action="" method="get" name="fchecklistresults" id="fchecklistresults" data-requireddayorhospital="<?php echo $_smarty_tpl->tpl_vars['lable']->value['dayorhospital'];?>
" data-required_day_month_year="<?php echo $_smarty_tpl->tpl_vars['lable']->value['please_choose_day_month_year'];?>
">
                    <ul class="list-inline">
                        <li class="text-success"><span class="icon-calendar"></span> <?php echo $_smarty_tpl->tpl_vars['finddate']->value;?>
</li>
                    </ul>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-2" style="display:none;">
                            <input  class="form-control" placeholder="Select Datetime" name="finddate" value="<?php echo $_smarty_tpl->tpl_vars['finddate']->value;?>
" />
                        </div>

                        <label class="col-sm-1 control-label">
                        <?php echo $_smarty_tpl->tpl_vars['lable']->value['year_month'];?>

                        </label>
                        <div class="col-sm-2">
                            <select class="form-control" name="year" id="year">
                            <?php echo $_smarty_tpl->tpl_vars['yearData']->value;?>

                            </select>
                        </div>
                        <label class="col-sm-1 control-label">
                        <?php echo $_smarty_tpl->tpl_vars['lable']->value['reportchecklist_day_of_month'];?>

                        </label>
                        <div class="col-sm-2">
                            <select class="form-control" name="month" id="month">
                            <?php echo $_smarty_tpl->tpl_vars['monthData']->value;?>

                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="day" id="day">
                            <?php echo $_smarty_tpl->tpl_vars['dayData']->value;?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label text-right">
                        <?php echo $_smarty_tpl->tpl_vars['lable']->value['choose_hospital'];?>

                        </label>
                        <div class="col-sm-2">
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
                        
                        <label class="col-sm-1 control-label">
                        <?php echo $_smarty_tpl->tpl_vars['lable']->value['choose_department'];?>

                        </label>
                        <div class="col-sm-3">
                            <select class="form-control" name="department_id" id="department_id">
                                <option value="">---</option>
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

                    <div class="form-group text-center">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary"> <?php echo $_smarty_tpl->tpl_vars['lable']->value['btn_view'];?>
 </button>
                        </div>
                    </div>

                </form>
            </section>

            <section class="content">
                <div class="table-responsive">
                    <table class="table table-bordered table-custom text-center text-bold">
                        <tr class="text-purple f-16">
                            <th style="min-width: 50px; width: 90px;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['year_month'];?>
</th>
                            <th style="min-width: 100px; width: 110px;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['hospital'];?>
</th>
                            <th style="min-width: 100px; width: 100px;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['department'];?>
</th>
                            <th style="min-width: 110px; width: 110px;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['checklist'];?>
</th>
                            <th style="min-width: 110px; width: 110px;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['situation'];?>
</th>
                            <th style="min-width: 120px; width: 120px;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['comment'];?>
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
                            <td class="text-danger f-mont f-16"><?php echo $_smarty_tpl->tpl_vars['item']->value['fdate_add'];?>
</td>
                            <td class="text-danger f-mont f-16"><?php echo $_smarty_tpl->tpl_vars['item']->value['hospital_name'];?>
</td>
                            <td class="text-danger f-mont f-16"><?php echo $_smarty_tpl->tpl_vars['item']->value['department_name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['checklist_category'];?>
</td>
                            <?php if ($_smarty_tpl->tpl_vars['item']->value['situation'] == 1 && $_smarty_tpl->tpl_vars['item']->value['checklist_of_user'] == $_smarty_tpl->tpl_vars['item']->value['submit_checklist_of_user'] && $_smarty_tpl->tpl_vars['item']->value['submit_checklist_of_user'] > 0) {?>
                            <td>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/checklist-results/list-notice.html?checklistcategoryid=<?php echo $_smarty_tpl->tpl_vars['item']->value['checklist_category_id'];?>
&finddate=<?php echo $_smarty_tpl->tpl_vars['item']->value['finddates'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['lable']->value['situation_incomplete'];?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/icon-checked.png" alt="icon-checked">
                            </a>
                            </td>
                            <?php } else { ?>
                            <td class="bg-danger">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/checklist-results/list-notice.html?checklistcategoryid=<?php echo $_smarty_tpl->tpl_vars['item']->value['checklist_category_id'];?>
&finddate=<?php echo $_smarty_tpl->tpl_vars['item']->value['finddates'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['lable']->value['situation_incomplete'];?>
"><?php echo $_smarty_tpl->tpl_vars['lable']->value['situation_incomplete'];?>
</a>
                            </td>
                            <?php }?>
                            <td>
                                <div class="row">
                                	<?php
$foreach_3_itemSub_sav['s_item'] = isset($_smarty_tpl->tpl_vars['itemSub']) ? $_smarty_tpl->tpl_vars['itemSub'] : false;
$_from = $_smarty_tpl->tpl_vars['item']->value['users'];
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
                                    	<p style="width:100%;display:block; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
"><?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
</p>                             
                                        <?php if ($_smarty_tpl->tpl_vars['itemSub']->value['emotion_icon'] == 1) {?>
                                            <?php if ($_smarty_tpl->tpl_vars['itemSub']->value['comment'] == 0) {?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-1.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                                            <?php } else { ?>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/comment.html?submitid=<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['submit_id'];?>
">
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-1-xanh.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                                                </a>
                                            <?php }?>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['itemSub']->value['emotion_icon'] == 2) {?>
                                            <?php if ($_smarty_tpl->tpl_vars['itemSub']->value['comment'] == 0) {?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-2.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                                            <?php } else { ?>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/comment.html?submitid=<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['submit_id'];?>
">
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-2-xanh.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                                                </a>
                                            <?php }?>                                            
                                        <?php } elseif ($_smarty_tpl->tpl_vars['itemSub']->value['emotion_icon'] == 3) {?>
                                            <?php if ($_smarty_tpl->tpl_vars['itemSub']->value['comment'] == 0) {?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-3.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                                            <?php } else { ?>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/comment.html?submitid=<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['submit_id'];?>
">
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-3-xanh.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                                                </a>
                                            <?php }?>
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
                        
                    </table>
                </div>
            </section><?php }
}
?>