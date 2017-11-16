            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.add_member}</h4>
                </div>
                <div class="widget-body innerAll inner-2x">
            
                    <form class="form-horizontal margin-none" name="frm_data" id="frm_data" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" value="{$data->user_id}" name="data[user_id]" />
    
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.username}</label>
                            <div class="col-sm-4">
                                <input type="text" name="data[user_name]" id="user_name" value="{$data->user_name}" class="form-control" onblur="hideFieldRequire('valid_user_name')"/>
                                <span class="error red">{form_error('data[user_name]')}</span>
                                <span class="error red">{form_error('data[user_name_exist]')}</span>
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.password}</label>
                            <div class="col-sm-4">
                                <input type="password" name="data[user_password]" id="user_password" value="" class="form-control" onblur="hideFieldRequire('valid_confirm_new_pwd')"/>
                                <span class="error red">{form_error('data[user_password]')}</span>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.confirm_password}</label>
                            <div class="col-sm-4">
                                <input type="password" name="data[repassword]" id="repassword" value="" class="form-control" />
                                <span class="error red">{form_error('data[repassword]')}</span>
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> {$lable.full_name}</label>
                            <div class="col-sm-4">
                                <input type="text" name="data[user_fullname]" id="user_fullname" value="{$data->user_fullname}" class="form-control"/>
                                <span class="error red">{form_error('data[user_fullname]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{$lable.email}</label>
                            <div class="col-sm-4">
                                <input type="text" name="data[user_email]" id="user_email" value="{$data->user_email}" class="form-control" />
                                <span class="error red">{form_error('data[user_email_exist]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{$lable.phone}</label>
                            <div class="col-sm-4">
                                <input type="text" name="data[user_phone]" id="user_phone" value="{$data->user_phone}" class="form-control" />
                                <span class="error red">{form_error('data[user_phone_exist]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.user_role}</label>
                            <div class="col-sm-4">
                                <select {if isset($smarty.get.id) && $smarty.get.id > 0 }disabled="disabled"{/if} id="role_id" name="data[role_id]" class="form-control">
                                    <option value=""> --- {$lable.select_option} --- </option>
                                    {foreach from=$roles item=vl}
                                        <option {if $vl->role_id == $data->role_id} selected {/if} value="{$vl->role_id}"> {$vl->role_name}</option>
                                    {/foreach}
                                </select>
                                <span class="error red">{form_error('data[role_id]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-2"> &nbsp; </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary"> {$lable.btn_save} </button>
                            </div>
                        </div>
                    </form>
    
                </div><!-- /.widget-body -->
            </section>