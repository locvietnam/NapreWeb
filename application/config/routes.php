<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// Modules User default controller
$route['admin'] = "admin/home";

//lchung add
$route['admin/index.html'] = "admin/home";


$route['admin/users.html'] = "admin/users";
$route['admin/users/add.html'] = "admin/users/add";
$route['admin/users/inactive.html'] = "admin/users/inactive";
$route['admin/users/reset-user.html'] = "admin/users/resetuser";
$route['admin/profile.html'] = "admin/users/profile";

$route['admin/department.html'] = "admin/department";
$route['admin/department/add.html'] = "admin/department/add";
$route['admin/department/user-manager-dep.html'] = "admin/department/usermanagerdep";
$route['admin/department/add-user-manager-dep.html'] = "admin/department/addusermanagerdep";
$route['admin/department/del-user-manager-dep.html'] = "admin/department/delusermanagerdep";

$route['admin/department/user-assign-dept.html'] = "admin/department/userassigndept";
$route['admin/department/add-user-assign-dept.html'] = "admin/department/adduserassigndept";
$route['admin/department/del-user-assign-dept.html'] = "admin/department/deluserassigndept";
$route['admin/department/reset-user-assign.html'] = "admin/department/resetuserassigndept";


$route['admin/setup.html'] = "admin/setup";
$route['admin/checklist.html'] = "admin/checklist/index";
$route['admin/checklist-create.html'] = "admin/checklist/addchecklist";
$route['admin/checklist-user.html'] = "admin/checklist/checklistuser";
$route['admin/add-checklist-user.html'] = "admin/checklist/adduserchecklist";

$route['admin/checklist-results.html'] = "admin/checklistresults";
$route['admin/checklist-results/list-notice.html'] = "admin/checklistresults/listnotice";

$route['admin/arrangement-table.html'] = "admin/arrangementtable";
$route['admin/arrangementtable/get-dept-of-manager.html'] = "admin/arrangementtable/getDeptofmanager";

$route['admin/comments.html'] = "admin/comment/listcm";
$route['admin/comment.html'] = "admin/comment";
$route['admin/message.html'] = "admin/message/index";
$route['admin/reports.html'] = "admin/report";
$route['admin/report-detail.html'] = "admin/report/detail";

$route['admin/banner.html'] = "admin/banner";
$route['admin/banner/add.html'] = "admin/banner/add";

$route['admin/hospital.html'] = "admin/hospital";
$route['admin/hospital/add.html'] = "admin/hospital/add";
$route['admin/hospital/reset-hospital.html'] = "admin/hospital/resethospital";

$route['admin/report-check-list.html'] = "admin/reportchecklist";
$route['admin/export-report-check-list.html'] = "admin/reportchecklist/export";
$route['admin/get-department-ajx.html'] = "admin/reportchecklist/getDepartmentAjx";
$route['admin/export-pdf.html'] = "admin/reportchecklist/exportpdf";



/*
// Blog
$route['blog'] = "home/blog";
$route['blog/ajxitems'] = "home/blog/ajxitems";
$route['blog/ajxcatitems'] = "home/blog/ajxcatitems";
$route['blog/(:any)'] = "home/blog/detail/$1";
$route['blog/category/(:any)'] = "home/blog/category/$1";

//Search
$route['search'] = "home/search";
$route['search/autocomplete'] = "home/search/autocomplete";
$route['search/autocomplete/(:any)'] = "home/search/autocomplete/$1";
$route['search/ajaxlisttour'] = "home/search/ajaxlisttour";
$route['search/ajaxcompare']  = "home/search/ajaxcompare";
$route['search/ajaxremovetour']  = "home/search/ajaxremovetour";

//facebook
$route['user_authentication'] = "home/user_authentication";

$route['search/test']  = "home/search/test";

//Profile
$route['profile'] = "home/profile";
$route['profile/update'] = "home/profile/update";

//Agency
$route['agency/(:any)'] = "home/agency/index/$1";

// view tour
$route['tour/(:any)'] = "home/tour/index/$1";

//downlad tour
$route['download/(:any)'] = "home/download/index/$1";
*/
