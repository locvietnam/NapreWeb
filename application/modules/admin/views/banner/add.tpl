            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple category-name">{$lable.add_banner}</h4>
                </div>
                <div class="widget-body innerAll inner-2x">
                	<div class="error red text-center" style="margin-bottom:15px;">{$error}</div>
                    <form class="form-horizontal margin-none" name="fdata" id="fdata" method="post" action="" enctype="multipart/form-data">
                      	<input type="hidden" name="data[id]" id="id" value="{$data->id}" />
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.banner_title}</label>
                            <div class="col-sm-4">
                                <input type="text" value="{$data->tille}" id="tille" name="data[tille]" class="form-control" >
                                <span class="error red">{form_error('data[tille]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{$lable.banner_short_description}</label>
                            <div class="col-sm-4">
                                <textarea id="short_description" name="data[short_description]" class="form-control" >{$data->short_description}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span>{$lable.banner_file_img}</label>
                            <div class="col-sm-4">
                                <input type="file" id="file_img" name="file_img" class="form-control" />
                                {if !isset($smarty.get.id) || $smarty.get.id > 0 }
                                	{if file_exists( $path_upload|cat:'/'|cat:$data->file_img ) eq 1 && $data->file_img neq '' }
                               	<br />
                                <input type="hidden" name="data[fileCurent]" value="{$data->file_img}" />
                                <img src="{$base_url}/files/uploads/{$data->file_img}" alt="{$data->tille}" style="max-width:70px;" />
                                <label><input type="checkbox" name="data[delete]" />{$lable.banner_question_delete}</label>
                                	{/if}
                                {/if}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2"> &nbsp; </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary"> {$lable.btn_save} </button>
                                <a href="{$base_url_admin}/banner.html" class="btn btn-default"> {$lable.btn_cancel} </a>
                            </div>
                        </div>
                    </form>
    
                </div><!-- /.widget-body -->
            </section>