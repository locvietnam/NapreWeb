<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Report</title>
<style>
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
</style>
</head>

<body>
	<div>
		<table class="w100 bw">
			<tr>
				<td class="text-r w30">
					<img style="width: 179px;" src="{$base_tlp_admin}/img/images/logo-top-pdf.png" alt="A-Line">
				</td>
				<td class="text-c w40">
						{$title_page}
				</td>
				<td class="text-c w30">
					<img class="h50" src="{$base_tlp_admin}/img/images/logo-right-pdf.png" alt="A-Line">
				</td>
			</tr>
		</table>
	</div>
	<div style="background-color: #38385b; height: 40px; margin: 0px; padding: 0px; line-height: 0px;">
		<table class="w100 wcorlor">
			<tr>
				<td class="text-r wS6">
					<img style="width: 36px;" src="{$base_tlp_admin}/img/images/lich-pdf.png" alt="A-Line">
				</td>
				<td class="text-l wS6 hline30">
				{$datereport}
				</td>
				<td class="text-r wS6">
					<img style="width: 36px;" src="{$base_tlp_admin}/img/images/user-pdf.png" alt="A-Line">
				</td>
				<td class="text-l wS6 hline30">
				{$user_fullname}
				</td>
				<td class="text-r wS6">
					<img style="width: 36px;" src="{$base_tlp_admin}/img/images/dep-pdf.png" alt="A-Line">
				</td>
				<td class="text-l wS6 hline30">
				{$department_name}
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%; vertical-align:middle;" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<th class="h40 w30 wcorlor hline33" style="background-color: #A72529;">{$lable.reportchecklist_day_of_month}
				</th>
				<th class="h40 w20 wcorlor hline33" style="background-color: #A72529;">{$lable.reportchecklist_percent_completion}(%)
				</th>
				<th class="h40 w50 wcorlor hline33" style="background-color: #A72529;">{$lable.reportchecklist_icon}
				</th>
			</tr>                        
			{if $list}
				{foreach from=$list item=item}
			<tr>
				<td class="h20 w30 hline33 text-l" style="background-color: #fff; border-bottom: 1px solid #F3DAF3; ">
				&nbsp;{$item->fdate_add}
				</td>
				<td class="h20 w30 hline33 text-c" style="background-color: #fff; border-left: 1px solid #F3DAF3;border-bottom: 1px solid #F3DAF3;">
				{$item->percent}
				</td>
				<td class="h20 w50 hline33 text-c" style="background-color: #fff; border-left: 1px solid #F3DAF3; border-right: 1px solid #F3DAF3; border-bottom: 1px solid #F3DAF3;   ">
						{foreach from=$item->users item=itemSub}
							{if $itemSub.emotion_icon eq 1 }
									<img class="h35" src="{$base_tlp_admin}/img/icon/mat-1-xanh.png" alt="{$itemSub.user_fullname}">

							{else if $itemSub.emotion_icon eq 2}
									<img class="h35" src="{$base_tlp_admin}/img/icon/mat-2-xanh.png" alt="{$itemSub.user_fullname}">

							{else if $itemSub.emotion_icon eq 3}
									<img class="h35" src="{$base_tlp_admin}/img/icon/mat-3-xanh.png" alt="{$itemSub.user_fullname}">
							{/if}
						{/foreach} 
				</td>
			</tr>
			{/foreach}
			{/if}
			<tr>
				<td class="hline45 bw text-r" style=" border-left: 1px solid #F3DAF3;border-bottom: 1px solid #F3DAF3;">
					{$lable.total_percent}:&nbsp;
				</td>
				<td class="hline45 bw text-c" style=" border-left: 1px solid #F3DAF3;border-bottom: 1px solid #F3DAF3;">
					{$sum_percent}(%)
				</td>
				<td class="text-c" style="border-left: 1px solid #F3DAF3;border-right: 1px solid #F3DAF3;border-bottom: 1px solid #F3DAF3;">
					<img class="h40" src="{$base_tlp_admin}/img/icon/mat-3-xanh.png" alt="{$itemSub.user_fullname}">
				</td>
			</tr>                 
		</table>
	</div>
	<div>
		<table style="width: 100%;">
			<tr>
				<td class="w5">&nbsp;</td>
				<td class="w90 text-l hline30" style="border: 1px solid #F3DAF3;">
					<div class="hline30">
					{$lable.report_comment}:
					<br/>
					{$report_comment}
					</div>
				</td>
				<td class="w5">&nbsp;</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width: 100%;">		
			<tr>
				<td class="w5">&nbsp;</td>
				<td class="w90" style="text-align: right; height: 25px; padding: 7px;" align="right">
					{$lable.staff_report}:
					{$staff_report}
				</td>
				<td class="w5">&nbsp;</td>
			</tr>
		</table>
	</div>
</body>
</html>
