<?php /* Smarty version 3.1.28-dev/21, created on 2017-10-03 08:05:10
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\sidebar.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2644259d328961d1f96_83035789%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b173cee4bf57a720711759f0dc52e0a61651a5e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\sidebar.tpl',
      1 => 1506994552,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2644259d328961d1f96_83035789',
  'variables' => 
  array (
    'base_url_admin' => 0,
    'path_upload' => 0,
    'user_data' => 0,
    'base_url' => 0,
    'base_tlp_admin' => 0,
    'current_control' => 0,
    'current_method' => 0,
    'lable' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_59d32896264706_19965033',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59d32896264706_19965033')) {
function content_59d32896264706_19965033 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2644259d328961d1f96_83035789';
?>
<!-- main-sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
            	<a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/profile.html">
                <?php if (file_exists((($_smarty_tpl->tpl_vars['path_upload']->value).('/')).($_smarty_tpl->tpl_vars['user_data']->value->user_avatar)) == 1 && $_smarty_tpl->tpl_vars['user_data']->value->user_avatar != '') {?>
                <img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/files/uploads/<?php echo $_smarty_tpl->tpl_vars['user_data']->value->user_avatar;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['user_data']->value->user_fullname;?>
" style="max-width:70px;" />
                <?php } else { ?>
                <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/avatar.png" class="img-circle" alt="User Image">
                <?php }?>
                <span class="icon-camera"></span>
                </a>
            </div>
            <div class="pull-left info">
                <p><?php echo $_smarty_tpl->tpl_vars['user_data']->value->user_fullname;?>
</p>
                <p><?php echo $_smarty_tpl->tpl_vars['user_data']->value->role_name;?>
</p>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <?php if ($_smarty_tpl->tpl_vars['user_data']->value->role_id <= 2) {?><!--Chi co Admin CEO duoc vào-->
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'hospital' && $_smarty_tpl->tpl_vars['current_method']->value == 'index') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/hospital.html">
                    <i class="fa fa-hospital-o"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_hospital'];?>
</span>
                </a>
            </li>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['user_data']->value->role_id <= 4) {?><!--Chi co Admin CEO, Top-manage, Manage duoc vao-->
            <li style="display:blok;" <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'reportchecklist' && $_smarty_tpl->tpl_vars['current_method']->value == 'index') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/report-check-list.html">
                    <i class="fa fa-user"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_reportchecklist'];?>
</span>
                </a>
            </li>
            <?php }?>

            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'home' && $_smarty_tpl->tpl_vars['current_method']->value == 'index') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/index.html">
                    <i class="fa fa-sticky-note"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_notice'];?>
</span>
                </a>
            </li>
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'checklistresults' && $_smarty_tpl->tpl_vars['current_method']->value == 'index' || $_smarty_tpl->tpl_vars['current_control']->value == 'checklistresults' && $_smarty_tpl->tpl_vars['current_method']->value == 'listnotice') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/checklist-results.html">
                    <i class="fa fa-list-ul"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_checklist_results'];?>
</span>
                </a>
            </li>
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'comment' && $_smarty_tpl->tpl_vars['current_method']->value == 'index' || $_smarty_tpl->tpl_vars['current_control']->value == 'comment' && $_smarty_tpl->tpl_vars['current_method']->value == 'listcm') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/comments.html">
                    <i class="fa fa-comment"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_comment'];?>
</span>
                </a>
            </li>
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'message' && $_smarty_tpl->tpl_vars['current_method']->value == 'index') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/message.html">
                    <i class="fa fa-envelope"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_message'];?>
</span>
                </a>
            </li>
            <?php if ($_smarty_tpl->tpl_vars['user_data']->value->role_id <= 2 || $_smarty_tpl->tpl_vars['user_data']->value->role_id == 4 || $_smarty_tpl->tpl_vars['user_data']->value->role_id == 5) {?><!--Chi co Admin CEO, Top manager, 5=>manager duoc vào-->
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'checklist' && $_smarty_tpl->tpl_vars['current_method']->value == 'addchecklist') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/checklist-create.html">
                    <i class="fa fa-plus-circle"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_checklist_create'];?>
</span>
                </a>
            </li>
            
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'checklist' && $_smarty_tpl->tpl_vars['current_method']->value == 'checklistuser' || $_smarty_tpl->tpl_vars['current_control']->value == 'checklist' && $_smarty_tpl->tpl_vars['current_method']->value == 'adduserchecklist') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/checklist-user.html">
                    <i class="fa fa-plus-circle"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_checklist_user'];?>
</span>
                </a>
            </li>
            
            <?php }?>
             
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'arrangementtable' && $_smarty_tpl->tpl_vars['current_method']->value == 'index') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/arrangement-table.html">
                    <i class="fa fa-table"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_arrangement_table'];?>
</span>
                </a>
            </li>
            <?php if ($_smarty_tpl->tpl_vars['user_data']->value->role_id <= 5) {?><!--Chi co Top manager & Manager duoc vào sua lai cho admin va seo vao duoc-->
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'report' && $_smarty_tpl->tpl_vars['current_method']->value == 'index' || $_smarty_tpl->tpl_vars['current_control']->value == 'report' && $_smarty_tpl->tpl_vars['current_method']->value == 'detail') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/reports.html">
                    <i class="fa fa-flag"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_report'];?>
</span>
                </a>
            </li>
            <?php }?>
            <!--<li class="menu-item dropdown <?php if ($_smarty_tpl->tpl_vars['current_method']->value == 'setup') {?>active<?php }?>">
            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-gear"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_setup'];?>
</span>
                </a>
            	<ul class="dropdown-menu">
                	<li>
                    	<a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/users.html">
                            <i class="fa fa-user"></i>
                            <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_user'];?>
</span>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/department.html">
                            <i class="fa fa-user"></i>
                            <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_department'];?>
</span>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/checklist.html">
                            <i class="fa fa-user"></i>
                            <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_checklist'];?>
</span>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/setup.html">
                            <i class="fa fa-user"></i>
                            <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_variables'];?>
</span>
                        </a>
                    </li>
                    
                </ul>
                
            </li>-->
            <?php if ($_smarty_tpl->tpl_vars['user_data']->value->role_id < 4) {?>
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'users' && $_smarty_tpl->tpl_vars['current_method']->value == 'index' || $_smarty_tpl->tpl_vars['current_control']->value == 'users' && $_smarty_tpl->tpl_vars['current_method']->value == 'add') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/users.html">
                    <i class="fa fa-user"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_user'];?>
</span>
                </a>
            </li>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['user_data']->value->role_id <= 4) {?><!--Chi co Top manager, Admin CEO HR duoc vào-->
            	<?php if ($_smarty_tpl->tpl_vars['user_data']->value->role_id <= 3) {?><!--Chi co Admin CEO HR duoc vào-->
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'department' && $_smarty_tpl->tpl_vars['current_method']->value == 'index' || $_smarty_tpl->tpl_vars['current_control']->value == 'department' && $_smarty_tpl->tpl_vars['current_method']->value == 'add') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/department.html">
                    <i class="fa fa-user"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_department'];?>
</span>
                </a>
            </li>
            	<?php }?>
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'department' && $_smarty_tpl->tpl_vars['current_method']->value == 'usermanagerdep' || $_smarty_tpl->tpl_vars['current_control']->value == 'department' && $_smarty_tpl->tpl_vars['current_method']->value == 'addusermanagerdep') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/department/user-manager-dep.html">
                    <i class="fa fa-user"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_user_manager_dep'];?>
</span>
                </a>
            </li>
            
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'department' && $_smarty_tpl->tpl_vars['current_method']->value == 'userassigndept' || $_smarty_tpl->tpl_vars['current_control']->value == 'department' && $_smarty_tpl->tpl_vars['current_method']->value == 'adduserassigndept') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/department/user-assign-dept.html">
                    <i class="fa fa-user"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_user_assign_dept'];?>
</span>
                </a>
            </li>
            <?php }?>
           
            
            <?php if ($_smarty_tpl->tpl_vars['user_data']->value->role_id <= 2) {?><!--Chi co Admin CEO duoc vào-->
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'setup' && $_smarty_tpl->tpl_vars['current_method']->value == 'index') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/setup.html">
                    <i class="fa fa-user"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_variables'];?>
</span>
                </a>
            </li>
            
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'banner' && $_smarty_tpl->tpl_vars['current_method']->value == 'index' || $_smarty_tpl->tpl_vars['current_control']->value == 'banner' && $_smarty_tpl->tpl_vars['current_method']->value == 'add') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/banner.html">
                    <i class="fa fa-list-ul"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_banners'];?>
</span>
                </a>
            </li>
            <?php }?>
            <li <?php if ($_smarty_tpl->tpl_vars['current_control']->value == 'checklist' && $_smarty_tpl->tpl_vars['current_method']->value == 'index') {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url_admin']->value;?>
/checklist.html">
                    <i class="fa fa-list-ul"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_checklist'];?>
</span>
                </a>
            </li>
            <li>
                <a href="#modalLogout" data-toggle="modal" data-target="#modalLogout">
                    <i class="fa fa-sign-out"></i>
                    <span><?php echo $_smarty_tpl->tpl_vars['lable']->value['admin_sidebar_logout'];?>
</span>
                </a>
            </li>
        </ul>
    </section>
    <div class="copyright">Copyright ©, 2015 A-LINE. All rights reserved.</div>
</aside>
<!-- /main-sidebar -->

<?php }
}
?>