            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.add_staff_checklist}</h4>
                </div>
                <div class="widget-body innerAll inner-2x">
            
                    <form class="form-horizontal margin-none" name="frm_data" id="frm_data" method="post" action="" enctype="multipart/form-data">
                        
                         <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="red">* </span> {$lable.checklist_category}</label>
                            <div class="col-sm-6">
                                <select id="checklist_category_id" name="data[checklist_category_id]" class="form-control">
                                    <option value=""> --- {$lable.select_option} --- </option>
                                    {foreach from=$listCates item=vl}
                                        <option {if $vl->checklist_category_id == $data->checklist_category_id} selected {/if} value="{$vl->checklist_category_id}"> {$vl->checklist_category}</option>
                                    {/foreach}
                                </select>
                                <span class="error red">{form_error('data[checklist_category_id]')}</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span class="red">* </span> {$lable.staff}</label>
                            <div class="col-sm-6">
                                <select id="user_id" name="data[user_id][]" class="form-control" multiple  style="height:300px;">
                                    <option value=""> --- {$lable.select_option} --- </option>
                                    {foreach from=$listStaff item=vl}
                                        <option  
                                        {foreach from=$data->user_idArr item=user_id}
                                        {if $vl->user_id == $user_id} selected {/if} 
                                        {/foreach}
                                        value="{$vl->user_id}"> {$vl->user_fullname}</option>
                                    {/foreach}
                                </select>
                                <span class="error red">{form_error('data[user_id][]')}</span>
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