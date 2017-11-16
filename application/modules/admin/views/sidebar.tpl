<!-- main-sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
            	<a href="{$base_url_admin}/profile.html">
                {if file_exists( $path_upload|cat:'/'|cat:$user_data->user_avatar ) eq 1 && $user_data->user_avatar neq '' }
                <img src="{$base_url}/files/uploads/{$user_data->user_avatar}" alt="{$user_data->user_fullname}" style="max-width:70px;" />
                {else}
                <img src="{$base_tlp_admin}/img/avatar.png" class="img-circle" alt="User Image">
                {/if}
                <span class="icon-camera"></span>
                </a>
            </div>
            <div class="pull-left info">
                <p>{$user_data->user_fullname}</p>
                <p>{$user_data->role_name}</p>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
           
            <li {if $current_control == 'home' && $current_method == 'index'}class="active"{/if}>
                <a href="{$base_url_admin}/index.html">
                    <i class="fa fa-sticky-note"></i>
                    <span>{$lable.admin_sidebar_notice}</span>
                </a>
            </li>
            <li {if $current_control == 'message' && $current_method == 'index'}class="active"{/if}>
                <a href="{$base_url_admin}/message.html">
                    <i class="fa fa-envelope"></i>
                    <span>{$lable.admin_sidebar_message}</span>
                </a>
            </li>
            
            <li {if $current_control == 'checklistresults' && $current_method == 'index' || $current_control == 'checklistresults' && $current_method == 'listnotice'}class="active"{/if}>
                <a href="{$base_url_admin}/checklist-results.html">
                    <i class="fa fa-list-ul"></i>
                    <span>{$lable.admin_sidebar_checklist_results}</span>
                </a>
            </li>
            
            <li {if $current_control == 'comment' && $current_method == 'index' || $current_control == 'comment' && $current_method == 'listcm'}class="active"{/if}>
                <a href="{$base_url_admin}/comments.html">
                    <i class="fa fa-comment"></i>
                    <span>{$lable.admin_sidebar_comment}</span>
                </a>
            </li>
            {if $user_data->role_id <=5 }<!--Chi co Top manager & Manager duoc vào sua lai cho admin va seo vao duoc-->
            <li {if $current_control == 'report' && $current_method == 'index' || $current_control == 'report' && $current_method == 'detail' }class="active"{/if}>
                <a href="{$base_url_admin}/reports.html">
                    <i class="fa fa-flag"></i>
                    <span>{$lable.admin_sidebar_report}</span>
                </a>
            </li>
            {/if}
            
            {if $user_data->role_id <= 2}<!--Chi co Admin CEO duoc vào-->
            <li {if $current_control == 'hospital' && $current_method == 'index'}class="active"{/if}>
                <a href="{$base_url_admin}/hospital.html">
                    <i class="fa fa-hospital-o"></i>
                    <span>{$lable.admin_sidebar_hospital}</span>
                </a>
            </li>
            {/if}

           {if $user_data->role_id <= 4 }<!--Chi co Top manager, Admin CEO HR duoc vào-->
            	{if $user_data->role_id <= 3 }<!--Chi co Admin CEO HR duoc vào-->
            <li {if $current_control == 'department' && $current_method == 'index' || $current_control == 'department' && $current_method == 'add'}class="active"{/if}>
                <a href="{$base_url_admin}/department.html">
                    <i class="fa fa-user"></i>
                    <span>{$lable.admin_sidebar_department}</span>
                </a>
            </li>
            {/if}
            
            <li {if $current_control == 'arrangementtable' && $current_method == 'index'}class="active"{/if}>
                <a href="{$base_url_admin}/arrangement-table.html">
                    <i class="fa fa-table"></i>
                    <span>{$lable.admin_sidebar_arrangement_table}</span>
                </a>
            </li>
            
            {if $user_data->role_id <= 2 || $user_data->role_id == 4 || $user_data->role_id == 5}<!--Chi co Admin CEO, Top manager, 5=>manager duoc vào-->
            <li {if $current_control == 'checklist' && $current_method == 'addchecklist'}class="active"{/if}>
                <a href="{$base_url_admin}/checklist-create.html">
                    <i class="fa fa-plus-circle"></i>
                    <span>{$lable.admin_sidebar_checklist_create}</span>
                </a>
            </li>
            {/if}
            
            <li {if $current_control == 'checklist' && $current_method == 'index'}class="active"{/if}>
                <a href="{$base_url_admin}/checklist.html">
                    <i class="fa fa-list-ul"></i>
                    <span>{$lable.admin_sidebar_checklist}</span>
                </a>
            </li>
            
            {if $user_data->role_id <= 2 || $user_data->role_id == 4 || $user_data->role_id == 5}<!--Chi co Admin CEO, Top manager, 5=>manager duoc vào-->
            <li {if $current_control == 'checklist' && $current_method == 'checklistuser' || $current_control == 'checklist' && $current_method == 'adduserchecklist'}class="active"{/if}>
                <a href="{$base_url_admin}/checklist-user.html">
                    <i class="fa fa-plus-circle"></i>
                    <span>{$lable.admin_sidebar_checklist_user}</span>
                </a>
            </li>
            
            {/if}
            
            {if $user_data->role_id < 4}
            <li {if $current_control == 'users' && $current_method == 'index' || $current_control == 'users' && $current_method == 'add'}class="active"{/if}>
                <a href="{$base_url_admin}/users.html">
                    <i class="fa fa-user"></i>
                    <span>{$lable.admin_sidebar_user}</span>
                </a>
            </li>
            {/if}
            
            <li {if $current_control == 'department' && $current_method == 'usermanagerdep' || $current_control == 'department' && $current_method == 'addusermanagerdep' }class="active"{/if}>
                <a href="{$base_url_admin}/department/user-manager-dep.html">
                    <i class="fa fa-user"></i>
                    <span>{$lable.admin_sidebar_user_manager_dep}</span>
                </a>
            </li>
            
            <li {if $current_control == 'department' && $current_method == 'userassigndept' || $current_control == 'department' && $current_method == 'adduserassigndept' }class="active"{/if}>
                <a href="{$base_url_admin}/department/user-assign-dept.html">
                    <i class="fa fa-user"></i>
                    <span>{$lable.admin_sidebar_user_assign_dept}</span>
                </a>
            </li>
            
                {if $user_data->role_id <= 4}<!--Chi co Admin CEO, Top-manage, Manage duoc vao-->
            <li style="display:blok;" {if $current_control == 'reportchecklist' && $current_method == 'index'}class="active"{/if}>
                <a href="{$base_url_admin}/report-check-list.html">
                    <i class="fa fa-user"></i>
                    <span>{$lable.admin_sidebar_reportchecklist}</span>
                </a>
            </li>
                {/if}            
            {else}
                {if $user_data->role_id == 5}<!--Chi co Admin CEO, Top manager, 5=>manager duoc vào-->
                <li style="display:blok;" {if $current_control == 'reportchecklist' && $current_method == 'index'}class="active"{/if}>
                <a href="{$base_url_admin}/report-check-list.html">
                    <i class="fa fa-user"></i>
                    <span>{$lable.admin_sidebar_reportchecklist}</span>
                </a>
                </li>
                <li {if $current_control == 'checklist' && $current_method == 'addchecklist'}class="active"{/if}>
                    <a href="{$base_url_admin}/checklist-create.html">
                        <i class="fa fa-plus-circle"></i>
                        <span>{$lable.admin_sidebar_checklist_create}</span>
                    </a>
                </li>
                <li {if $current_control == 'checklist' && $current_method == 'index'}class="active"{/if}>
                    <a href="{$base_url_admin}/checklist.html">
                        <i class="fa fa-list-ul"></i>
                        <span>{$lable.admin_sidebar_checklist}</span>
                    </a>
                </li>
                {/if}
            {/if}
           
            
            {if $user_data->role_id <= 2}<!--Chi co Admin CEO duoc vào-->
            
            <li {if $current_control == 'banner' && $current_method == 'index' || $current_control == 'banner' && $current_method == 'add'}class="active"{/if}>
                <a href="{$base_url_admin}/banner.html">
                    <i class="fa fa-list-ul"></i>
                    <span>{$lable.admin_sidebar_banners}</span>
                </a>
            </li>
            
            <li {if $current_control == 'setup' && $current_method == 'index'}class="active"{/if}>
                <a href="{$base_url_admin}/setup.html">
                    <i class="fa fa-user"></i>
                    <span>{$lable.admin_sidebar_variables}</span>
                </a>
            </li>            
            
            {/if}
            
            <li>
                <a href="#modalLogout" data-toggle="modal" data-target="#modalLogout">
                    <i class="fa fa-sign-out"></i>
                    <span>{$lable.admin_sidebar_logout}</span>
                </a>
            </li>
        </ul>
    </section>
    <div class="copyright">Copyright ©, 2015 A-LINE. All rights reserved.</div>
</aside>
<!-- /main-sidebar -->

