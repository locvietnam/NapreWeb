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
<body style="font-size:24px;">
	<div style="width:100%;height:60px;">
		<table class="w100 bw" style="width:100%;">
			<tr>
				<td class="text-r w30" style="text-align:center;">
					&nbsp; <img style="height:50px;" src="{$base_tlp_admin}/img/logo-header-pdf.png" alt="A-Line">
				</td>
				<td class="text-c w40" style="font-size:22px;font-weight:bold;color:#38385B;">
                    {$title_page}<br />
                    <span style="color:#A72529;">{$datereport}</span>
                </td>
				<td class="text-c w30" style="text-align:center;">
					<img style="height:50px;" src="{$base_tlp_admin}/img/images/logo-right-pdf.png" alt="A-Line">
				</td>
			</tr>
		</table>
	</div>
	<div id="top" style="background-color:#38385b;height:60px;margin:0;padding:0;text-align:center;">
    	<br />
		<table class="w100 wcorlor" style="width:80%;">
			<tr>
                <td class="w70">
                    <table class="w100">
                        <tr>
                            <td class="w20 text-r">
                                <img style="height:30px;" src="{$base_tlp_admin}/img/images/dep-pdf.png" alt="A-Line">
                            </td>
                            <td class=" text-l" style="width:400px;"><br/>
                                {$hospital_name} 様
                            </td>
                        </tr>
                    </table>
                </td>
				<td class="w30">
                    <table class="w100">
                        <tr>
                            <td class="w80 text-r" style="width:400px;">
                                <img style="height:30px;" src="{$base_tlp_admin}/img/Icon-pdf-report.png" alt="A-Line">
                            </td>
                            <td class=" text-l" style="width:250px;"><br/>
                                {$department_name}
                            </td>
                        </tr>
                    </table>
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table style="width:100%;vertical-align:middle;height:50px;" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<th class="h40 w30 wcorlor" style="width:12%;height:50px;background-color:#A72529;text-align:center;font-size:22px; font-weight:bold;line-height:30px;"><br/>{$lable.reportchecklist_day_of_month}
				</th>
				<th class="h40 w20 wcorlor hline33" style="width:23%;background-color:#A72529;text-align:center;font-size:22px; font-weight:bold;line-height:30px;">{$lable.reportchecklist_percent_completion}(%)
				</th>
				<th class="h40 w50 wcorlor hline33" style="width:65%;background-color:#A72529;text-align:center;font-size:22px; font-weight:bold;line-height:30px;">{$lable.reportchecklist_icon}
				</th>
			</tr>                        
			{if $list}
				{foreach from=$list item=item}
			<tr>
				<td class="h20 w30 hline33 text-l" style="width:12%;background-color: #fff; border-left: 1px solid #F3DAF3; border-right: 1px solid #F3DAF3; border-bottom: 1px solid #F3DAF3;text-align:center;color:#38385B;">
				&nbsp;{$item->fdate_add}
				</td>
				<td class="h20 w30 hline33 text-c" style="width:23%;background-color: #fff; border-right: 1px solid #F3DAF3;border-bottom: 1px solid #F3DAF3;color:#38385B;font-weight:bold;">
				{$item->percent}
				</td>
				<td class="h20 w50 hline33 text-c" style="width:65%;background-color: #fff; border-right: 1px solid #F3DAF3; border-right: 1px solid #F3DAF3; border-bottom: 1px solid #F3DAF3;">
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
				<td class="hline45 bw text-c" style=" border-left:1px solid #F3DAF3;border-bottom:1px solid #F3DAF3;font-size:25px;color:#38385B;font-weight:bold;">
					{$lable.total_percent}:&nbsp;
				</td>
				<td class="hline45 bw text-c" style=" border-left:1px solid #F3DAF3;border-bottom:1px solid #F3DAF3;font-size:25px;color:#38385B;font-weight:bold;">
					平均達成率 <br />{$sum_percent}%
				</td>
				<td class="text-c" style="border-left: 1px solid #F3DAF3;border-right: 1px solid #F3DAF3;border-bottom: 1px solid #F3DAF3;">
					<img class="h40" src="{$base_tlp_admin}/img/icon/mat-2-xanh.png" height="80" />
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
					{$lable.report_comment}:
					<br/>
					{$report_comment}
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
					{$lable.staff_report}:
					{$staff_report}
				</td>
				<td class="w5">&nbsp;</td>
			</tr>
		</table>
	</div>
</body>
</html>
