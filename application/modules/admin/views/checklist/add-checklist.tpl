            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple category-name">{$lable.add_user_manager_dept}</h4>
                </div>
                <div class="widget-body innerAll inner-2x">
                    <form class="form-horizontal margin-none" name="fdata" id="fdata" method="post" action="">
                      {if !isset($smarty.get.step) || $smarty.get.step eq 1 }
                      	<input type="hidden" value="1" name="data[step]" />
                      <div class="step-1">
                        
                      	<div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.checklist}</label>
                            <div class="col-sm-4">
                                <input type="text" value="{$data->checklist_category}" id="checklist_category" name="data[checklist_category]" class="form-control" >
                                <span class="error red">{form_error('data[checklist_category]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                            {$lable.choose_hospital}
                            </label>
                            <div class="col-sm-4">
                                <select class="form-control" name="hospital_id" id="hospital_id">
                                   <option value="">---</option>
                                    {if $hospitalData}
                                        {foreach from=$hospitalData item=itemH}
                                    <option {if isset($smarty.get.hospital_id) && $smarty.get.hospital_id eq $itemH.hospital_id}selected{/if} value="{$itemH.hospital_id}">{$itemH.hospital_name}</option>
                                        {/foreach}
                                    {/if}
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.department}</label>
                            <div class="col-sm-4">
                                <select id="checklist_department_id" name="data[department_id]" class="form-control">
                                    <option value=""> --- {$lable.select_option} --- </option>
                                    {foreach from=$listDep item=vl}
                                        <option {if $vl->department_id == $data->department_id} selected {/if} value="{$vl->department_id}"> {$vl->department_name}</option>
                                    {/foreach}
                                </select>
                                <span class="error red">{form_error('data[department_id]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.user_manager}</label>
                            <div class="col-sm-4">
                                <select id="checklist_manager_id" name="data[manager_id]" class="form-control">
                                    <option value=""> --- {$lable.select_option} --- </option>
                                    {foreach from=$listUserManager item=vl}
                                        <option {if $vl->user_id == $data->manager_id} selected {/if} value="{$vl->user_id}"> {$vl->user_fullname}</option>
                                    {/foreach}
                                </select>
                                <span class="error red">{form_error('data[manager_id]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.checklist_type}</label>
                            <div class="col-sm-6">
                                
                                    {foreach from=$listType item=vl}
                                    	<label class="label-class">
                                        	<input class="checklist-type" type="radio" {if $vl->checklist_type_id == $data->checklist_type_id || $vl->checklist_type_id eq 'd' } checked {/if} name="data[checklist_type_id]" value="{$vl->checklist_type_id}" />
                                        	{if $vl->checklist_type eq 'Daily'}
											毎日
											{elseif $vl->checklist_type eq 'The end of month'}
											毎月
											{elseif $vl->checklist_type eq 'Day of weekend' }
											毎週
											{/if}
                                        </label>
                                    {/foreach}
                                <span class="error red">{form_error('data[checklist_type_id]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group dw" style="{if $data->checklist_type_id neq 'dw' }display:none;{/if}">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.weekday_num}</label>
                            <div class="col-sm-6">
                                <select id="role_id" name="data[weekday_num]" class="form-control">
                                    <option value=""> --- {$lable.select_option} --- </option>
                                    {foreach from=$listWeekday item=vl}
                                        <option {if $vl->weekday_num == $data->weekday_num} selected {/if} value="{$vl->weekday_num}">
										{if $vl->day_of_week eq 'Fri'}
										金曜
										{elseif $vl->day_of_week eq 'Mon'}
										月曜
										{elseif $vl->day_of_week eq 'Sat'}
										土曜
										{elseif $vl->day_of_week eq 'Sun'}
										日曜
										{elseif $vl->day_of_week eq 'Thu'}
										木曜
										{elseif $vl->day_of_week eq 'Tue'}
										火曜
										{elseif $vl->day_of_week eq 'Wed'}
										水曜
										{/if}
										</option>
                                    {/foreach}
                                </select>
                                <span class="error red">{form_error('data[weekday_num]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-2"> &nbsp; </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary"> {$lable.btn_save_next} </button>
                            </div>
                        </div>
                     </div><!--End step-1--> 
                     {elseif $smarty.get.step eq 2 }    
                     <input type="hidden" value="2" name="data[step]" />                 
                     <div class="step-2" style="">  
                     	<div class="form-group">
                            <label class="col-sm-4 control-label"><span class="red">* </span> {$lable.checklist_sub_categories}</label>
                            <div class="col-sm-4">
                                <input type="text" value="{$data->checklist_sub_categories[0]}" name="data[checklist_sub_categories][]" class="form-control" >
                            </div>
                            <div class="col-sm-4">
                                <a onClick="sub_categories_add_more();" data-label="{$lable.checklist_sub_categories}" href="javascript:void(0);" class="sub-categories-add-more" title="Add more">
                                    <img src="{$base_tlp_admin}/img/icon/icon-add.png">
                                </a>
                            </div>
                        </div>
                        {if count($data->checklist_sub_categories) > 1 }
                        	{foreach from=$data->checklist_sub_categories item=vl key = k}
                            {if $k neq 0 }
                         <div class="form-group">
                            <label class="col-sm-4 control-label">&nbsp;</label>
                            <div class="col-sm-4">
                                <input type="text" value="{$vl}" name="data[checklist_sub_categories][]" class="form-control" >
                            </div>
                            <div class="col-sm-4">
                                <a onClick="sub_categories_del_more(this);" href="javascript:void(0);" class="sub-categories-add-more" title="Add more">
                                    <img src="{$base_tlp_admin}/img/icon/icon-delete.png">
                                </a>
                            </div>
                        </div>{/if}
                            {/foreach}
                        {/if}                        
                     </div><!--End step-2-->
                     <div class="form-group">
                     	<label class="col-sm-4 control-label">&nbsp;</label>
                            <div class="col-sm-4">
                     			<span class="error red">{form_error('data[checklist_sub_categories][]')}</span>
                            </div>
                     </div>
                     <div class="form-group">
                        <div class="col-xs-2"> &nbsp; </div>
                        <div class="col-xs-2">
                            <button type="submit" class="btn btn-primary"> {$lable.btn_save_next} </button>
                        </div>
                    </div>
                     {elseif $smarty.get.step eq 3 }
                     <input type="hidden" value="3" name="data[step]" />
                     <div class="step-3" style="">  
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.user_staff}</label>
                            <div class="col-sm-4">
                            	
                                    {foreach from=$listUser item=vl}
                                    	<label >
                                        <input type="checkbox" name="data[user_id][]" value="{$vl->user_id}" 
                                        	{foreach from=$data->user_idArr item=user_id}
                                        {if $vl->user_id == $user_id} checked {/if} 
                                        {/foreach}
                                         />
                                        {$vl->user_fullname} ({$vl->role_name})
                                    	</label><br />
                                    {/foreach}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-2"> &nbsp; </div>
                            <div class="col-xs-10">
                            	<i>{$lable.you_can_skip_this_step}</i><br />
                                <button type="submit" class="btn btn-primary"> {$lable.btn_save} </button>
                            </div>
                        </div>
                   	</div><!--End step 3-->
                    {/if}
                    </form>
    
                </div><!-- /.widget-body -->
            </section>