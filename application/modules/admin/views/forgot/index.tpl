{include file="login/header.tpl"}

<div class="container">


<!-- Main Container Fluid -->
<div class="container-fluid menu-hidden">
<!-- Content -->
<div id="content">

<div class="container">
<!-- row-app -->
<div class="row row-app">
<!-- col -->
<!-- col-separator.box -->
<div class="col-separator col-unscrollable box">
<!-- col-table -->
<div class="col-table">
	<h4 class="innerAll margin-none border-bottom text-center"><i class="fa fa-lock"></i> {$lable.forgot_password}</h4>
	<!-- col-table-row -->
	<div class="col-table-row">
                {if $alert neq ''} {include file="notes.tpl"} {/if}
		<!-- col-app -->
		<div class="col-app col-unscrollable">
			<!-- col-app -->
			<div class="col-app">
				<div class="login">
					<div class="placeholder text-center"><i class="fa fa-lock"></i>
					</div>
					
					<div class="panel panel-default col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4">
						<div class="panel-body">
						{if $error neq ''} {include file="error.tpl"} {/if}
							<form role="form" method="post" action="{$base_url_admin}/forgot/">
								<div class="form-group">
									<label for="exampleInputEmail1">{$lable.email}</label>
									<input type="text" name="email" id="email" class="form-control" placeholder="{$lable.enter_email}">
								</div>
								<button type="submit" class="btn btn-primary btn-block">{$lable.btn_forgot_password}</button>
								<div class="checkbox">
									<label>
                                                                            <a href="{$base_url_admin}/login/">{$lable.lable_login}</a>
									</label>
								</div>
							</form>
						</div>
					</div>
					
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- // END col-app -->
		</div>
		<!-- // END col-app.col-unscrollable -->
	</div>
	<!-- // END col-table-row -->
</div>
<!-- // END col-table -->
</div>
<!-- // END col-separator.box -->
</div>
<!-- // END row-app -->

{include file="login/footer.tpl"}
