
<div id="page" class="template-agency">
		
		<div class="container">
			<div class="form col-md-offset-4 col-md-4">
            	{if $alert neq ''} {include file="notes.tpl"} {/if}
                
				<h2 class="text-center space-4">{$task}</h2>
                <form class="form-horizontal space-4" name="frm_data" id="frm_data" method="post" action="{$base_url_admin}/forgot/newpassword/?e={$data.email}&d={$data.user_id}" autocomplete="off">
                			
					<div class="form-group">
						<label class="col-sm-6 control-label" for="exampleInputPassword1"><img src="images/icon-password.png" alt="" border="0" /> {$lable.create_new_password}</label>
						<div class="col-sm-6">
                        	
    <input type="password" name="data[new_pwd]" class="form-control" id="new_pwd" maxlength="20" onblur="hideMsg('confirm_new_pwd')">
						</div>
					</div>
                    <div class="form-group">
						<label class="col-sm-6 control-label" for="exampleInputPassword1"><img src="images/icon-password.png" alt="" border="0" /> {$lable.confirm_password} </label>
						<div class="col-sm-6">
                        	
    <input type="password" name="data[confirm_new_pwd]" class="form-control" id="confirm_new_pwd" maxlength="20" onblur="hideMsg('confirm_new_pwd')">
    <span id="valid_confirm_new_pwd" class="red">{$valid.confirm_new_pwd}</span>
						</div>
					</div>
                    
					<div class="signin-text space-2">
						<div class="clearfix"></div>
					</div>
					<div class="space-4">
						<button class="btn btn-primary btn-block" id="btn-changepassword" type="submit"> {$lable.btn_save} </button>
					</div>
				</form>
                <div class="signin-text space-2">
                	&nbsp; 
                    <div class="clearfix"></div>
                    &nbsp; 
                </div>
                <div class="signin-text space-2">
                	&nbsp; 
                    <div class="clearfix"></div>
                </div>
			</div>
			
		</div>		
	</div>
</body>
</html>

<script src="{$base_url}/captcha/js/jquery.min.js"></script>
<script> 
    var passsword_not_match = "{$lable.passsword_not_match}";
    
</script>
<script src="{$base_tlp_admin}/js/signup.js"></script>
