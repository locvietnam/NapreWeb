<?php /* Smarty version 3.1.28-dev/21, created on 2017-10-05 04:26:40
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\reportchecklist\report.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1438959d5986006bce0_95298204%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '085afdc9f6ad750214f5c116dc3a435de6b230b1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\reportchecklist\\report.tpl',
      1 => 1507170397,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1438959d5986006bce0_95298204',
  'variables' => 
  array (
    'base_tlp_admin' => 0,
    'title_page' => 0,
    'datereport' => 0,
    'hospital_name' => 0,
    'department_name' => 0,
    'lable' => 0,
    'list' => 0,
    'item' => 0,
    'itemSub' => 0,
    'sum_percent' => 0,
    'report_comment' => 0,
    'staff_report' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_59d598600df045_13621064',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_59d598600df045_13621064')) {
function content_59d598600df045_13621064 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1438959d5986006bce0_95298204';
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>Report</title>
<style>
	html {
    font-family: "游ゴシック","YuGothic","overpass-regular",overpass-regular,Helvetica,helvetica,"ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, Osaka, "ＭＳ Ｐゴシック", "MS PGothic",arial, sans-serif;
    font-weight: 500;
    word-break: normal;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    -webkit-text-size-adjust: 100%;
	}
	.text-c{
		text-align: center;
	}
	.text-l{
		text-align: left;
	}
	.text-r{
		text-align: right;
	}
	.text-md{
		vertical-align: middle;
	}
	.h50{
		height: 50px;
	}
	.h40{
		height: 40px;
	}
	.h35{
		height: 35px;
	}
	.h30{
		height: 30px;
	}
	.h25{
		height: 25px;
	}
	.h20{
		height: 20px;
	}
	.ptop10{
		padding-top: 10px;
	}
	.w5{
		min-width: 5%;
		width: 5%;
	}
	.w10{
		min-width: 10%;
		width: 10%;
	}
	.w20{
		min-width: 20%;
		width: 20%;
	}
	.w30{
		min-width: 30%;
		width: 30%;
	}
	.w40{
		min-width: 40%;
		width: 40%;
	}
	.w50{
		min-width: 50%;
		width: 50%;
	}
	.w60{
		min-width: 60%;
		width: 60%;
	}
	.w80{
		width: 80%;
	}
	.w90{
		width: 90%;
	}
	.w100{
		width: 100%;
	}
	.bA72529{
		background-color: #A72529;
		background: #A72529;
	}
	.wcorlor{
		color: #fff;
	}
	.hline20{
		line-height: 20px;
	}
	.hline25{
		line-height: 25px;
	}
	.hline30{
		line-height: 30px;
	}
	.hline33{
		line-height: 35px;
	}
	.hline35{
		line-height: 33px;
	}
	.hline40{
		line-height: 40px;
	}
	.hline45{
		line-height: 45px;
	}
	.bw{
		background-color: #fff;
	}
	.wS6{
		width: 16.66666666666667%;
	}
	#top table tr td{
		height:60px;
		min-height:60px;
		line-height:30px;
	}
	.middle-top{
		height:66px;
		display: table;
		width: 100%;
	}
	.middle-top div{
		vertical-align:middle;display:table-cell;margin-top:20px;
	}
</style>
</head>
<body>
	<div style="width:100%;">
		<table class="w100 bw" style="width:100%;">
			<tr>
				<td class="text-r w30" style="text-align:center;">
					&nbsp; <img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/logo-header-pdf.png" alt="A-Line">
				</td>
				<td class="text-c w40" style="font-size:52px;font-weight:bold;color:#38385B;"><?php echo $_smarty_tpl->tpl_vars['title_page']->value;?>
</td>
				<td class="text-c w30" style="text-align:center;">
					<img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/images/logo-right-pdf.png" alt="A-Line">
				</td>
			</tr>
		</table>
	</div>
	<div id="top" style="background-color:#38385b;height:60px;margin:0;padding:0;text-align:center;">
    	<br />
		<table class="w100 wcorlor" style="width:80%;">
			<tr>
				<td class="text-r wS6 middle-top" style="line-height:30px;width:100px;text-align:center;">
					<img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/images/lich-pdf.png" alt="A-Line" align="middle">
				</td>
				<td class="middle-top" style="font-size:35px;font-weight:bold;width:28%;margin:0;padding:0;line-height:30px" align="middle">
                	<div><?php echo $_smarty_tpl->tpl_vars['datereport']->value;?>
</div>
				</td>
				<td class="text-r wS6" style="line-height:30px;width:90px;text-align:center;">
					<img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/images/user-pdf.png" alt="A-Line">
				</td>
				<td class="middle-top" style="font-size:35px;font-weight:bold;width:25%;margin:0;padding:0;line-height:30px" align="middle">
					<br /><div><?php echo $_smarty_tpl->tpl_vars['hospital_name']->value;?>
 様</div>
				</td>
				<td class="text-r wS6">
					<img src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/images/dep-pdf.png" alt="A-Line">
				</td>
				<td class="middle-top" style="font-size:35px;font-weight:bold;width:40%;margin:0;padding:0;line-height:30px" align="middle">
					<br /><div><?php echo $_smarty_tpl->tpl_vars['department_name']->value;?>
</div>
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width:100%;vertical-align:middle;height:50px;" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<th class="h40 w30 wcorlor" style="width:12%;height:50px;background-color:#A72529;text-align:center;font-size:26px; font-weight:bold;line-height:30px;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['reportchecklist_day_of_month'];?>

				</th>
				<th class="h40 w20 wcorlor hline33" style="width:23%;background-color:#A72529;text-align:center;font-size:26px; font-weight:bold;line-height:30px;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['reportchecklist_percent_completion'];?>
(%)
				</th>
				<th class="h40 w50 wcorlor hline33" style="width:65%;background-color:#A72529;text-align:center;font-size:26px; font-weight:bold;line-height:30px;"><?php echo $_smarty_tpl->tpl_vars['lable']->value['reportchecklist_icon'];?>

				</th>
			</tr>                        
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
			<tr>
				<td class="h20 w30 hline33 text-l" style="width:12%;background-color: #fff; border-left: 1px solid #F3DAF3; border-right: 1px solid #F3DAF3; border-bottom: 1px solid #F3DAF3;text-align:center;color:#38385B;">
				&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value->fdate_add;?>

				</td>
				<td class="h20 w30 hline33 text-c" style="width:23%;background-color: #fff; border-right: 1px solid #F3DAF3;border-bottom: 1px solid #F3DAF3;color:#38385B;font-weight:bold;">
				<?php echo $_smarty_tpl->tpl_vars['item']->value->percent;?>

				</td>
				<td class="h20 w50 hline33 text-c" style="width:65%;background-color: #fff; border-right: 1px solid #F3DAF3; border-right: 1px solid #F3DAF3; border-bottom: 1px solid #F3DAF3;">
                    <?php
$foreach_1_itemSub_sav['s_item'] = isset($_smarty_tpl->tpl_vars['itemSub']) ? $_smarty_tpl->tpl_vars['itemSub'] : false;
$_from = $_smarty_tpl->tpl_vars['item']->value->users;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['itemSub'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['itemSub']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['itemSub']->value) {
$_smarty_tpl->tpl_vars['itemSub']->_loop = true;
$foreach_1_itemSub_sav['item'] = $_smarty_tpl->tpl_vars['itemSub'];
?>
                        <?php if ($_smarty_tpl->tpl_vars['itemSub']->value['emotion_icon'] == 1) {?>
                                <img class="h35" src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-1-xanh.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                        <?php } elseif ($_smarty_tpl->tpl_vars['itemSub']->value['emotion_icon'] == 2) {?>
                                <img class="h35" src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-2-xanh.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                        <?php } elseif ($_smarty_tpl->tpl_vars['itemSub']->value['emotion_icon'] == 3) {?>
                                <img class="h35" src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-3-xanh.png" alt="<?php echo $_smarty_tpl->tpl_vars['itemSub']->value['user_fullname'];?>
">
                        <?php }?>
                    <?php
$_smarty_tpl->tpl_vars['itemSub'] = $foreach_1_itemSub_sav['item'];
}
if ($foreach_1_itemSub_sav['s_item']) {
$_smarty_tpl->tpl_vars['itemSub'] = $foreach_1_itemSub_sav['s_item'];
}
?> 
				</td>
			</tr>
			<?php
$_smarty_tpl->tpl_vars['item'] = $foreach_0_item_sav['item'];
}
if ($foreach_0_item_sav['s_item']) {
$_smarty_tpl->tpl_vars['item'] = $foreach_0_item_sav['s_item'];
}
?>
			<?php }?>
			<tr>
				<td class="hline45 bw text-c" style=" border-left:1px solid #F3DAF3;border-bottom:1px solid #F3DAF3;font-size:25px;color:#38385B;font-weight:bold;">
					<?php echo $_smarty_tpl->tpl_vars['lable']->value['total_percent'];?>
:&nbsp;
				</td>
				<td class="hline45 bw text-c" style=" border-left:1px solid #F3DAF3;border-bottom:1px solid #F3DAF3;font-size:25px;color:#38385B;font-weight:bold;">
					平均達成率 <br /><?php echo $_smarty_tpl->tpl_vars['sum_percent']->value;?>
%
				</td>
				<td class="text-c" style="border-left: 1px solid #F3DAF3;border-right: 1px solid #F3DAF3;border-bottom: 1px solid #F3DAF3;">
					<img class="h40" src="<?php echo $_smarty_tpl->tpl_vars['base_tlp_admin']->value;?>
/img/icon/mat-2-xanh.png" height="80" />
				</td>
			</tr>                 
		</table>
	</div>
	<div>
		<table style="width:100%;">
			<tr>
				<td style="width:2%;">&nbsp;</td>
				<td class="w90 text-l hline30" style="width:96%;border: 1px solid #F3DAF3;color:#38385B;">
					<div class="hline30">
					<?php echo $_smarty_tpl->tpl_vars['lable']->value['report_comment'];?>
:
					<br/>
					<?php echo $_smarty_tpl->tpl_vars['report_comment']->value;?>

					</div>
				</td>
				<td style="width:2%;">&nbsp;</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width:100%;">		
			<tr>
				<td style="width:3%;">&nbsp;</td>
				<td class="w90" style="width:95%;text-align:right;height:25px;padding:7px;font-weight:bold;color:#38385B;font-size:26px;" align="right">
					<?php echo $_smarty_tpl->tpl_vars['lable']->value['staff_report'];?>
:
					<?php echo $_smarty_tpl->tpl_vars['staff_report']->value;?>

				</td>
				<td class="w5">&nbsp;</td>
			</tr>
		</table>
	</div>
</body>
</html>
<?php }
}
?>