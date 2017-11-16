			<section class="content-header">
                <ul class="list-inline">
                    <li class="text-success"><span class="icon-calendar"></span> {$finddate}</li>
                </ul>
            </section>

            <section class="content">            
            {if $list}
                {if isset($smarty.get.submitid)}
                <form class="form-horizontal margin-none" action="" method="post" name="fupdatechecklistresults" id="fupdatechecklistresults">
            	{/if}
                {foreach from=$list item=itemPa }
                <div class="box box-solid">
                    <div class="box-header">
                            <h4 class="box-title" style="font-size:24px;">{$itemPa.checklist_category}</h4>
                    </div>
                </div>
            		{if !empty($itemPa.subcate) }
					{foreach from=$itemPa.subcate item=item }
                <div class="box box-solid" style="margin-left:20px;">
                    <div class="box-header">
                        <h4 class="box-title">{$item.checklist_category}</h4>
                    </div>
                    <div class="box-body checklist" style="margin-left:40px;">
                        <ul class="list-unstyled">
                        	{foreach from=$item.checklist item=itemSub}
                            <li> 
                            	{if $itemSub->checklist_checked eq 1 }
                                <input type="checkbox" id="cb{$itemSub->checklist_id}" name="submit_checklist_id[]" value="{$itemSub->checklist_id}" checked />
                                <label class="icon-check" for="cb{$itemSub->checklist_id}">
                                   <strong>{$itemSub->user_fullname}: </strong> <span>{$itemSub->title}</span>
                                </label>
                                {else}
                                <input type="checkbox" id="cb{$itemSub->checklist_id}" name="submit_checklist_id[]" value="{$itemSub->checklist_id}" />
                                <label class="icon-check" for="cb{$itemSub->checklist_id}">
                                   <strong>{$itemSub->user_fullname}: </strong> <span>{$itemSub->title}</span>
                                </label>
                                {/if}
                            </li>
                            {/foreach}                            
                        </ul>
                    </div>
                </div>
                		{/foreach}
                	{/if}
				{/foreach}
                {if isset($smarty.get.submitid)}
                <div class="form-group">            
                    <label class="col-sm-1 control-label">
                    {$lable.reportchecklist_day_of_month}
                    </label>
                    <div class="col-sm-2">
                        <input class="form-control" placeholder="Select Date add" name="data[date_add]" value="{if isset($smarty.get.finddate)}{$smarty.get.finddate}{/if}" />
                    </div>
                </div>
                <div class="form-group">            
                    <label class="col-sm-1 control-label">
                    {$lable.emoticon}
                    </label>
                    <div class="col-sm-11">
                        <img class="emoticon emoticon-0 selectd" src="{$base_tlp_admin}/img/icon/mat-1.png" data-val="0" alt="{$lable.emoticon}">
                        <img class="emoticon" src="{$base_tlp_admin}/img/icon/mat-1.png" data-val="1" alt="{$lable.emoticon}">
                        <img class="emoticon" src="{$base_tlp_admin}/img/icon/mat-2.png" data-val="2" alt="{$lable.emoticon}">
                        <img class="emoticon" src="{$base_tlp_admin}/img/icon/mat-3.png" data-val="3" alt="{$lable.emoticon}">
                    </div>
                </div>

                <div class="form-group text-center">
                        <div class="col-xs-12">
                            
                            <input type="hidden" id="emoticon" name="data[emoticon]" value="0" />
                            <input type="hidden" id="submit_checklist_id" name="data[submit_checklist_id]" value="" />
                            <input type="hidden" name="data[staffid]" value="{if isset($smarty.get.staffid)}{$smarty.get.staffid}{/if}" />
                            <input type="hidden" name="data[submitid]" value="{if isset($smarty.get.submitid)}{$smarty.get.submitid}{/if}" />
                            <button type="submit" class="btn btn-primary"> {$lable.update} </button>
                        </div>
                    </div>
                    
                </form>
                {/if}
                {/if}
                

            </section>
<style>
    .emoticon.selectd{
        border: 1px solid #f00;
    }
    .emoticon{
        width: 50px;
    }
    .emoticon-0{
        width: 80px;
    }
</style>        