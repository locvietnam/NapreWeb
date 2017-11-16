            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.add_user_manager_dept}</h4>
                </div>
                <div class="widget-body innerAll inner-2x">
            
                    <form class="form-horizontal margin-none" name="fdepartment_userassigndept" id="fdepartment_userassigndept" method="post" action="" enctype="multipart/form-data">
                      
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.department}</label>
                            <div class="col-sm-4">
                                <select id="department_id" name="data[department_id]" class="form-control">
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
                                <select id="manager_id" name="data[manager_id]" class="form-control">
                                    <option value=""> --- {$lable.select_option} --- </option>
                                    {foreach from=$listUserManager item=vl}
                                        <option {if $vl.user_id == $data->manager_id} selected {/if} value="{$vl.user_id}"> {$vl.user_fullname}</option>
                                    {/foreach}
                                </select>
                                <span class="error red">{form_error('data[manager_id]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.user_staff}</label>
                            <div class="col-sm-4" id="user_id_staff">
                            	
                                    {foreach from=$listUser item=vl}
                                    	<label {if $vl.Buser_id eq $vl.Auser_id } class="disabled" {/if} >
                                        <input {if $vl.Buser_id eq $vl.Auser_id } disabled="disabled" {/if} type="checkbox" name="data[user_id][]" value="{$vl['Auser_id']}" 
                                        	{foreach from=$data->user_idArr item=user_id}
                                        {if $vl['Auser_id'] == $user_id} checked {/if} 
                                        {/foreach}
                                         />
                                        {$vl['user_fullname']} ({$vl['role_name']})
                                    	</label><br />
                                    {/foreach}
                                <span class="error red">{form_error('data[user_id][]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-2"> &nbsp; </div>
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary"> {$lable.btn_save} </button>
                                <a href="{$base_url_admin}/department/user-assign-dept.html" class="btn btn-default"> {$lable.btn_cancel} </a>
                            </div>
                        </div>
                    </form>
    
                </div><!-- /.widget-body -->
            </section>