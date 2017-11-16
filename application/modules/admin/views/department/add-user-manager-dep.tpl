            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.add_user_manager_dept}</h4>
                </div>
                <div class="widget-body innerAll inner-2x">
            
                    <form class="form-horizontal margin-none" name="fusermanagerdept" id="fusermanagerdept" method="post" action="" enctype="multipart/form-data">
                      
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
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.users}</label>
                            <div class="col-sm-4" id="user_id_manager">
                            	
                                    {foreach from=$listUser item=vl}
                                    	<label {if $vl.Bmanager_id eq $vl.Amanager_id && $data->department_id eq $vl.department_id} class="disabled" {/if}>
                                        <input {if $vl.Bmanager_id eq $vl.Amanager_id && $data->department_id eq $vl.department_id} disabled="disabled" {/if} type="checkbox" name="data[user_id][]" value="{$vl['Amanager_id']}" 
                                        	{foreach from=$data->user_idArr item=user_id}
                                        {if $vl['Amanager_id'] == $user_id} checked {/if} 
                                        {/foreach}
                                         />
                                        {$vl['user_fullname']} ({$vl['role_name']} {$vl['department_name']})
                                    	</label><br />
                                    {/foreach}
                                <span class="error red">{form_error('data[user_id][]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-2"> &nbsp; </div>
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary"> {$lable.btn_save} </button>
                                <a href="{$base_url_admin}/department/user-manager-dep.html" class="btn btn-default"> {$lable.btn_cancel} </a>
                            </div>
                        </div>
                    </form>
    
                </div><!-- /.widget-body -->
            </section>