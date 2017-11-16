            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple category-name">{$lable.add_user_manager_dept}</h4>
                </div>
                <div class="widget-body innerAll inner-2x">
                    <form class="form-horizontal margin-none" name="fprofile" id="fprofile" method="post" action="" enctype="multipart/form-data">
                      
                     	<div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.username}</label>
                            <div class="col-sm-4">
                                <input type="text" readonly name="data[user_name]" id="user_name" value="{$user_data->user_name}" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.full_name}</label>
                            <div class="col-sm-4">
                                <input type="text" name="data[user_fullname]" id="user_fullname" value="{$user_data->user_fullname}" class="form-control" />
                                <span class="error red">{form_error('data[user_fullname]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{$lable.email}</label>
                            <div class="col-sm-4">
                                <input type="text" name="data[user_email]" id="user_email" value="{$user_data->user_email}" class="form-control" />
                                <span class="error red">{form_error('data[user_email_exist]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{$lable.phone}</label>
                            <div class="col-sm-4">
                                <input type="text" name="data[user_phone]" id="user_phone" value="{$user_data->user_phone}" class="form-control" />
                                <span class="error red">{form_error('data[user_phone_exist]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span>{$lable.banner_file_img}</label>
                            <div class="col-sm-4">
                                <input type="file" id="file_img" name="file_img" class="form-control" />
                                {if file_exists( $path_upload|cat:'/'|cat:$user_data->user_avatar ) eq 1 && $user_data->user_avatar neq '' }
                               	<br />
                                <input type="hidden" name="data[fileCurent]" value="{$user_data->user_avatar}" />
                                <img src="{$base_url}/files/uploads/{$user_data->user_avatar}" alt="{$user_data->user_fullname}" style="max-width:70px;" />
                                <label><input type="checkbox" name="data[delete]" />{$lable.user_avatar_delete}</label>
                                {/if}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-2"> &nbsp; </div>
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary"> {$lable.btn_save} </button>
                            </div>
                        </div>
                    </form>
    
                </div><!-- /.widget-body -->
            </section>