{include file="header.tpl"}

<div id="content">

    <div class="innerLR">

        {if $alert neq ''} {include file="notes.tpl"} {/if}
        
        <div class="widget">
            <div class="widget-head">
                <h4 class="heading">{$lable.add_member}</h4>
            </div>
            <div class="widget-body innerAll inner-2x">
            
                <form class="form-horizontal margin-none" name="frm_data" id="frm_data" method="post" action="{$action_url}" enctype="multipart/form-data">
                    <input type="hidden" value="{$data.user_id}" name="data[user_id]" />

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.username}</label>
                        <div class="col-sm-4">
                            <input type="text" name="data[user_name]" id="user_name" value="{$data.user_name}" class="form-control" onblur="hideFieldRequire('valid_user_name')"/>
                            <span id="valid_user_name" class="red"></span>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.password}</label>
                        <div class="col-sm-4">
                            <input type="password" name="data[user_password]" id="user_password" value="" class="form-control" onblur="hideFieldRequire('valid_confirm_new_pwd')"/>
                            <span id="valid_user_password" class="red"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.confirm_password}</label>
                        <div class="col-sm-4">
                            <input type="password" name="data[re-user_password]" id="re-user_password" value="" class="form-control" onblur="hideFieldRequire('valid_confirm_new_pwd')"/>
                            <span id="valid_confirm_new_pwd" class="red"></span>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> {$lable.full_name}</label>
                        <div class="col-sm-4">
                            <input type="text" name="data[user_fullname]" id="user_fullname" value="{$data.user_fullname}" class="form-control"/>
                            <span id="valid_user_fullname" class="red"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.user_role}</label>
                        <div class="col-sm-4">
                            <select id="role_id" name="data[role_id]" class="form-control">
                            	<option value=""> --- {$lable.select_option} --- </option>
                            	{foreach from=$roles item=vl}
                                	<option value="{$vl->role_id}"> {$vl->role_name}</option>
                                {/foreach}
                            </select>
                            <span id="valid_role_id" class="red"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-2"> &nbsp; </div>
                        <div class="col-xs-2">
                            <button type="button" id="btnSaveAdminUser" class="btn btn-primary"> {$lable.btn_save} </button>
                        </div>
                    </div>
                </form>

            </div><!-- /.widget-body -->
        </div><!-- /.widget -->

    </div>    
</div>

{include file="footer.tpl"}

<script src="{$base_tlp_admin}/js/login.js"></script>

<script language="javascript">
var require_username = require_input_field+" {$lable.username}";
var passsword_not_match = "{$lable.passsword_not_match}";
var username_invalid_there_space = "{$lable.username_invalid_there_space}";
var require_role = require_input_field+" {$lable.user_role}";

{literal}
	$(document).ready(function () {
		
	});
{/literal}
</script>