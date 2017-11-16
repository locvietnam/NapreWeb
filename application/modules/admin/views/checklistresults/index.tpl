			<section class="content-header">
            	<form class="form-horizontal margin-none" action="" method="get" name="fchecklistresults" id="fchecklistresults">
                    <ul class="list-inline">
                        <li class="text-success"><span class="icon-calendar"></span> {$finddate}</li>
                    </ul>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-2" style="display:none;">
                            <input  class="form-control" placeholder="Select Datetime" name="finddate" value="{$finddate}" />
                        </div>

                        <label class="col-sm-1 control-label">
                        {$lable.year_month}
                        </label>
                        <div class="col-sm-2">
                            <select class="form-control" name="year" id="year">
                            {$yearData}
                            </select>
                        </div>
                        <label class="col-sm-1 control-label">
                        {$lable.reportchecklist_day_of_month}
                        </label>
                        <div class="col-sm-2">
                            <select class="form-control" name="month" id="month">
                            {$monthData}
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" name="day" id="day">
                            {$dayData}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label text-right">
                        {$lable.choose_hospital}
                        </label>
                        <div class="col-sm-2">
                            <select class="form-control" name="hospital_id" id="hospital_id">
                               <option value="">---</option>
                                {if $hospitalData}
                                    {foreach from=$hospitalData item=itemH}
                                <option {if isset($smarty.get.hospital_id) && $smarty.get.hospital_id eq $itemH.hospital_id}selected{/if} value="{$itemH.hospital_id}">{$itemH.hospital_name}</option>
                                    {/foreach}
                                {/if}
                            </select>
                        </div>
                        
                        <label class="col-sm-1 control-label">
                        {$lable.choose_department}
                        </label>
                        <div class="col-sm-3">
                            <select class="form-control" name="department_id" id="department_id">
                                <option value="">---</option>
                                {if $departmentData}
                                    {foreach from=$departmentData item=itemD}
                                <option {if isset($smarty.get.department_id) && $smarty.get.department_id eq $itemD->department_id}selected{/if} value="{$itemD->department_id}">{$itemD->department_name}</option>
                                    {/foreach}
                                {/if}
                            </select>
                        </div>

                    </div>

                    <div class="form-group text-center">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary"> {$lable.btn_view} </button>
                        </div>
                    </div>

                </form>
            </section>

            <section class="content">
                <div class="table-responsive">
                    <table class="table table-bordered table-custom text-center text-bold">
                        <tr class="text-purple f-16">
                            <th style="min-width: 100px; width: 100px;">{$lable.department}</th>
                            <th style="min-width: 120px; width: 120px;">{$lable.checklist}</th>
                            <th style="min-width: 120px; width: 120px;">{$lable.situation}</th>
                            <th style="min-width: 500px; width: 500px;">{$lable.comment}</th>
                        </tr>                        
                        {if $list}
                        	{foreach from=$list item=item}
                        <tr>
                            <td class="text-danger f-mont f-16">{$item->department_name}</td>
                            <td>{$item->checklist_category}</td>
                            {if $item->situation eq 1 && $item->checklist_of_user eq $item->submit_checklist_of_user}
                            <td>
                            <a href="{$base_url_admin}/checklist-results/list-notice.html?checklistcategoryid={$item->checklist_category_id}&finddate={$finddate}" title="{$lable.situation_incomplete}">
                            <img src="{$base_tlp_admin}/img/icon/icon-checked.png" alt="icon-checked">
                            </a>
                            </td>
                            {else}
                            <td class="bg-danger">
                            <a href="{$base_url_admin}/checklist-results/list-notice.html?checklistcategoryid={$item->checklist_category_id}&finddate={$finddate}" title="{$lable.situation_incomplete}">{$lable.situation_incomplete}</a>
                            </td>
                            {/if}
                            <td>
                                <div class="row">
                                	{foreach from=$item->users item=itemSub}
                                    <div class="item-user col-lg-3 col-md-3 col-xs-4 col-4">
                                    	<p style="width:100%;display:block; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="{$itemSub.user_fullname}">{$itemSub.user_fullname}</p>                             
                                        {if $itemSub.emotion_icon eq 1 }
                                            {if $itemSub.comment eq 0}
                                                <img src="{$base_tlp_admin}/img/icon/mat-1.png" alt="{$itemSub.user_fullname}">
                                            {else}
                                                <a href="{$base_url_admin}/comment.html?submitid={$itemSub.submit_id}">
                                                <img src="{$base_tlp_admin}/img/icon/mat-1-xanh.png" alt="{$itemSub.user_fullname}">
                                                </a>
                                            {/if}
                                        {else if $itemSub.emotion_icon eq 2}
                                            {if $itemSub.comment eq 0}
                                                <img src="{$base_tlp_admin}/img/icon/mat-2.png" alt="{$itemSub.user_fullname}">
                                            {else}
                                                <a href="{$base_url_admin}/comment.html?submitid={$itemSub.submit_id}">
                                                <img src="{$base_tlp_admin}/img/icon/mat-2-xanh.png" alt="{$itemSub.user_fullname}">
                                                </a>
                                            {/if}                                            
                                        {else if $itemSub.emotion_icon eq 3}
                                            {if $itemSub.comment eq 0}
                                                <img src="{$base_tlp_admin}/img/icon/mat-3.png" alt="{$itemSub.user_fullname}">
                                            {else}
                                                <a href="{$base_url_admin}/comment.html?submitid={$itemSub.submit_id}">
                                                <img src="{$base_tlp_admin}/img/icon/mat-3-xanh.png" alt="{$itemSub.user_fullname}">
                                                </a>
                                            {/if}
                                        {/if}
                                    </div>
                                    {/foreach}
                            		
                                </div>
                            </td>
                        </tr>
                        {/foreach}
                        {/if}
                        
                    </table>
                </div>
            </section>