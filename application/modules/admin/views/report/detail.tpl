 			<section class="content-header text-success">
                <ul class="list-inline">
                    <li class="text-success"><span class="icon-calendar"></span> {date('Y/m/d')}</li>
                </ul>
            </section>

            <section class="content">
                <div class="table-responsive content-report">
                	<form class="form-horizontal margin-none" name="frm_data" id="frm_data" method="post" action="" enctype="multipart/form-data">
                    <!-- Table -->
                    <table class="table table-bordered table-custom text-center">
                        <tr class="text-purple f-18 text-bold">
                            <th style="min-width: 200px;">{$lable.report_people_departments_etc}</th>
                            <th>{$lable.report_event}</th>
                        </tr>
                        {foreach from=$manager_report item=item key = k }
                        <tr class="f-16">
                            <td>
                            <a href="#add{$k}" class="icon-add left left-xs" data-toggle="collapse" aria-expanded="false" class="collapsed"></a>
                            {$item.depart}
                            </td>
                            <td>
                            	{foreach from=$item.field item=itemSub key = ksub}
                                
                                {assign var="keys1" value='staff_event_'|cat:$ksub}
                                {assign var="keys2" value='nursing_dept_event_'|cat:$ksub}
                                <div class="col-xs-12">
                                    <input class="text-default border-bottom" type="text" name="data[field][{$k}][]" placeholder="{$itemSub}" {if count($detail)  > 0 } value="{if $k eq 1}{$detail[0].$keys1}{else}{$detail[0].$keys2}{/if}" {/if} class="border-bottom">
                                </div>
                                {/foreach}
                            </td>
                        </tr>
                        {/foreach}
                        {foreach from=$manager_report item=item key = ks }
                        
                        <tr id="add{$ks}" class="panel-collapse collapse f-16 {if count($detail)  > 1 } in {/if}" aria-expanded="false">
                            <td><a href="#add{$ks}" class="icon-add left left-xs" data-toggle="collapse" aria-expanded="false" class="collapsed">
                            </a>{$item.depart}</td>
                            <td>
                                {foreach from=$item.field item=itemSub key = ksub}
                                {assign var="keys1" value='staff_event_'|cat:$ksub}
                                {assign var="keys2" value='nursing_dept_event_'|cat:$ksub}
                                <div class="col-xs-12">
                                    <input class="text-default border-bottom" type="text" name="data[field][{$ks}][]" placeholder="{$itemSub}" class="border-bottom" {if count($detail)  > 0 } value="{if $ks eq 1 && isset($detail[1]) }{$detail[1].$keys1}{else}{if isset($detail[1])}{$detail[1].$keys2}{/if}{/if}" {/if}>
                                </div>
                                {/foreach}
                            </td>
                        </tr>                        
                        {/foreach}
                    </table>
                    <!-- /Table -->
                    {if !isset($smarty.get.id) || $smarty.get.id eq 0 }
                    <div class="form-group">
                            <div class="col-xs-12 ">
                            	{if $user_data->role_id eq 5 }<!--Chi co nhom Manager moi duoc report-->
                                <button type="submit" class="btn btn-primary pull-right"> {$lable.btn_report} </button>
                                {/if}
                            </div>
                        </div>
                     {/if}
                    </form>
                </div>
            </section>