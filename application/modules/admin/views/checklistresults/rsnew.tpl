			<section class="content-header">
            	<form class="form-horizontal margin-none" action="" method="get" name="fnewchecklistresults" id="fnewchecklistresults" data-required_day_month_year="{$lable.please_choose_day_month_year}" data-requiredstaff="{$lable.staff_required}" data-requireddayorhospital="{$lable.dayorhospital}" >
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

                        <label class="col-sm-2 control-label">
                        {$lable.staff}
                        </label>
                        <div class="col-sm-3">
                            <select class="form-control" name="staff_id" id="staff_id">
                                <option value="">---</option>
                                {if $datastaff}
                                    {foreach from=$datastaff item=itemStaff}
                                <option {if isset($smarty.get.staff_id) && $smarty.get.staff_id eq $itemStaff->user_id}selected{/if} value="{$itemStaff->user_id}">{$itemStaff->user_fullname}</option>
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
                            <th style="min-width: 100px; width: 120px;">{$lable.date}</th>
                            <th style="min-width: 150px; width: 150px;">{$lable.checklist}</th>
                            <th style="min-width: 120px; width: 100px;">{$lable.staff}</th>
                            <th style="min-width: 100px; width: 120px;">{$lable.situation}</th>
                            <th style="min-width: 100px; width: 120px;">{$lable.emoticon}</th>                            
                            <th style="min-width: 120px; width: 120px;">{$lable.task}</th>
                        </tr>                        
                        {if $list}
                        	{foreach from=$list item=item key = k}
                        <tr>
                            <td>
                                {$item.fdate_add}
                            </td>
                            <td class="text-danger f-mont f-16">
                             {$item.title}
                            </td>
                            <td>
                                {$item.user_fullname}
                            </td>  
                            {if $item.situation eq 1 && $item.checklist_of_user eq $item.submit_checklist_of_user}
                            <td>                            
                            <img src="{$base_tlp_admin}/img/icon/icon-checked.png" alt="icon-checked" title="Completed">
                            </td>
                            {else}
                            <td class="bg-danger">
                            {$lable.situation_incomplete}
                            </td>
                            {/if}
                            <td>
                                {if $item.emotion_icon eq 1 }
                                    {if $item.is_comment eq 0}
                                        <img src="{$base_tlp_admin}/img/icon/mat-1.png" alt="{$item.user_fullname}">
                                    {else}
                                        <a href="{$base_url_admin}/comment.html?submitid={$item.submit_id}">
                                        <img src="{$base_tlp_admin}/img/icon/mat-1-xanh.png" alt="{$item.user_fullname}">
                                        </a>
                                    {/if}
                                {else if $item.emotion_icon eq 2}
                                    {if $item.is_comment eq 0}
                                        <img src="{$base_tlp_admin}/img/icon/mat-2.png" alt="{$item.user_fullname}">
                                    {else}
                                        <a href="{$base_url_admin}/comment.html?submitid={$item.submit_id}">
                                        <img src="{$base_tlp_admin}/img/icon/mat-2-xanh.png" alt="{$item.user_fullname}">
                                        </a>
                                    {/if}                                            
                                {else if $item.emotion_icon eq 3}
                                    {if $item.is_comment eq 0}
                                        <img src="{$base_tlp_admin}/img/icon/mat-3.png" alt="{$item.user_fullname}">
                                    {else}
                                        <a href="{$base_url_admin}/comment.html?submitid={$item->submit_id}">
                                        <img src="{$base_tlp_admin}/img/icon/mat-3-xanh.png" alt="{$item.user_fullname}">
                                        </a>
                                    {/if}
                                {else if $item.emotion_icon eq 0}
                                    <img src="{$base_tlp_admin}/img/icon/mat-1.png" alt="{$item.user_fullname}">
                                {/if}
                            </td>
                            
                            <td>
                                {if $item.is_submit > 0 }
                                    <a class="btn btn-info" href="{$base_url_admin}/checklist-results/list-notice.html?checklistcategoryid={$item.parent_category_id}&finddate={$item.finddates}&staffid={$item.user_id}&submitid={$item.submit_id}" title="{$lable.checklist_edit}">{$lable.checklist_edit}</a>
                                    <a class="btn btn-nbox-shadow rstrash" href="javascript:void(0);" data-submit_id="{$item.submit_id}" data-user_id="{$item.user_id}" >
                                    <i class="fa fa-trash"></i>
                                    </a>
                                    {else}
                                    <a class="btn btn-primary" href="{$base_url_admin}/checklist-results/list-notice.html?checklistcategoryid={$item.parent_category_id}&finddate={$item.finddates}&staffid={$item.user_id}&submitid={$item.submit_id}" title="{$lable.add_new_result_checklist}"><i class="fa fa-plus"></i></a>
                                {/if}
                            </td>
                        </tr>
                        {/foreach}
                        {/if}
                        
                    </table>
                </div>
            </section>