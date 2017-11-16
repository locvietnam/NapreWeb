            <section class="content-header">
                <form class="form-horizontal margin-none" name="ffinddept" id="ffinddept" method="get" action="" enctype="multipart/form-data">
                      
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
                        <div class="col-xs-2"> &nbsp; </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary"> {$lable.btn_search} </button>
                        </div>
                    </div>
                </form>
            </section>
            <hr class="clearfix">
            <section class="content-header">
                <!-- list-team -->
                <ul class="list-inline list-team">
                	{foreach from=$listDep item=item}
                    <li class="{if isset($smarty.get.dept) && $smarty.get.dept eq $item->department_id || $dept eq $item->department_id}active{/if}">
                    <a class="find-dept" data-iddept="{$item->department_id}" href="{$base_url_admin}/checklist.html?dept={$item->department_id}&hospital_id={if isset($smarty.get.hospital_id)}{$smarty.get.hospital_id}{/if}">{$item->department_name}</a></li>
                    {/foreach}
                </ul>
                <!-- /list-team -->
            </section>
            <!-- /content-header -->            
            <hr class="clearfix">
            <section class="content create-checklist">
            	{if $list}
                {foreach from=$list item=itemPa }
                    <!-- Box {$itemPa.checklist_category_id} -->
                <div id="create{$itemPa.checklist_category_id}" class="panel-collapse collapse panel-collapse-create" aria-expanded="false">
                    <div class="create-form">
                        <form class="save-to-checklist-category" method="post" id="fadd{$itemPa.checklist_category_id}" name="fadd{$itemPa.checklist_category_id}">
                            <div class="col-lg-5 col-md-7 col-xs-7">
                                <input type="text" class="checklist-category" name="checklist_category" placeholder="{$lable.checklist_title_required}">
                                <input type="hidden" class="department-id" name="department_id" value="{if isset($smarty.get.dept)}{$smarty.get.dept}{else}{$dept}{/if}">
                                <input type="hidden" class="manager_id" name="manager_id" value="{$itemPa.manager_id}">
                            </div>
                            <div class="col-lg-2 col-md-3 col-xs-5">
                                <button data-id="{$itemPa.checklist_category_id}" type="submit" class="btn btn-primary btn-flat btn-block checklist-category-add-quick">{$lable.btn_save}</button>
                            </div>
                    	</form>
                    </div>
                </div>
                <div class="box box-solid box-category">
                    <div class="box-header p-l-0 p-r-0">
                        <h4 class="box-title text-purple category-name" data-notempty="{$lable.checklist_category_notempty}">{$itemPa.checklist_category}</h4>
                        <div class="group-btn">
                        	{if $user_data->role_id <= 2 || $user_data->role_id eq 4 }<!--Chi co Admin CEO, Top manager duoc vào-->
                            <a class="hoverJS edit" href="javascript:;" data-id="{$itemPa.checklist_category_id}" title="{$lable.checklist_view_subcategory}">
                                <img src="{$base_tlp_admin}/img/icon/icon-status.png">
                            </a>
                            <a class="hoverJS collapsed" href="#create{$itemPa.checklist_category_id}" data-toggle="collapse" aria-expanded="false" title="Create">
                                <img src="{$base_tlp_admin}/img/icon/icon-add.png">
                            </a>
                            <a class="delete-category" style="display:none;" href="javaScript:;" title="{$lable.checklist_edit}">{$lable.checklist_edit}</a>
                       		{/if}
                            
                            {if $user_data->role_id <= 5}
                                <a style="cursor:pointer; float:right;" data-message="{$lable.confirm_del}?" class="delete-checklist-of-manager" data-id="{$itemPa.checklist_category_id}">
                                    <img src="{$base_tlp_admin}/img/icon/icon-delete.png">
                                </a>
                            {/if}
                        </div>
                        
                    </div>
                    <div style="clear:both;" /></div>
                   </div>
                	{if !empty($itemPa.subcate) }
					{foreach from=$itemPa.subcate item=item }
                <!-- Box {$item.checklist_category_id} -->
                <div id="create{$item.checklist_category_id}" class="panel-collapse collapse panel-collapse-create col-md-11 pull-right" aria-expanded="false" style="overflow:hidden;">
                    <div class="create-form">
                        <form class="save-to-checklist-category" method="post" id="fadd{$item.checklist_category_id}" name="fadd{$item.checklist_category_id}">
                            <div class="col-lg-5 col-md-7 col-xs-7">
                                <input type="text" class="checklist-category" name="checklist_category" placeholder="{$lable.checklist_title_required}">
                                <input type="hidden" class="department-id" name="department_id" value="{if isset($smarty.get.dept)}{$smarty.get.dept}{else}{$dept}{/if}">
                                <input type="hidden" class="parent_category_id" name="parent_category_id" value="{$itemPa.checklist_category_id}">
                                <input type="hidden" class="manager_id" name="manager_id" value="{$itemPa.manager_id}">
                            </div>
                            <div class="col-lg-2 col-md-3 col-xs-5">
                                <button data-id="{$item.checklist_category_id}" type="submit" class="btn btn-primary btn-flat btn-block checklist-category-add-quick">{$lable.btn_save}</button>
                            </div>
                    	</form>
                    </div>
                </div>
                <div class="box box-solid box-category" style="position:relative;">
                    <div class="box-header p-l-0 p-r-0 col-md-11 pull-right">
                        <h4 class="box-title text-purple category-name" data-notempty="{$lable.checklist_category_notempty}">{$item.checklist_category}</h4>
                        <div class="group-btn">
                        	{if $user_data->role_id <= 2 || $user_data->role_id eq 4 }<!--Chi co Admin CEO, Top manager duoc vào-->
                            <a class="hoverJS edit" href="javascript:;" data-id="{$item.checklist_category_id}" title="{$lable.checklist_view_subcategory}">
                                <img src="{$base_tlp_admin}/img/icon/icon-status.png">
                            </a>
                            <a class="hoverJS collapsed" href="#create{$item.checklist_category_id}" data-toggle="collapse" aria-expanded="false" title="Create">
                                <img src="{$base_tlp_admin}/img/icon/icon-add.png">
                            </a>
                            <a class="delete-category" href="javaScript:;" title="{$lable.checklist_edit}">{$lable.checklist_edit}</a>
                       		{/if}
                            
                            {if $user_data->role_id <= 5}
                                <a style="cursor:pointer; float:right;" data-message="{$lable.confirm_del}?" class="delete-checklist-of-manager" data-id="{$item.checklist_category_id}">
                                    <img src="{$base_tlp_admin}/img/icon/icon-delete.png">
                                </a>
                            {/if}
                        </div>
                    </div>
                    <div class="box-body checklist p-r-30 col-md-11 pull-right">
                        <ul class="list-unstyled list-unstyled{$item.checklist_category_id}">
                        	{foreach from=$item.checklist item = vl }
                            <li class="load-auto">
                                <i class="icon-delete" onclick="deletes(this, '{$vl->checklist_id}');"></i>
                                <label>{$vl->title}</label>
                            </li>
                            {/foreach}
                            {if $user_data->role_id <= 2 || $user_data->role_id eq 4 }<!--Chi co Admin CEO, Top manager duoc vào-->
                            <li>
                                <label style="padding:30px 0px;"></label>
                                <a href="#add{$item.checklist_category_id}" data-toggle="collapse" aria-expanded="false" class="collapsed">
                                    <span class="icon-add right"></span>
                                </a>
                            </li>
                            {/if}
                        </ul>
                        <div id="add{$item.checklist_category_id}" class="panel-collapse collapse" aria-expanded="false">
                            <div class="create-form">
                                <input onkeyup="insert(this, event);" class="insert" data-parent_category_id="{$item.parent_category_id}" data-category_id="{$item.checklist_category_id}" type="text" name="title{$item.checklist_category_id}" placeholder="{$lable.checklist_sub_categories_required}" />
                            </div>
                        </div>
                    </div>
                    <div style="clear:both;" /></div>
                </div>
                <!-- /Box {$item.checklist_category_id} -->
                {/foreach}
                {/if}
                
                <!-- /Box {$itemPa.checklist_category_id} -->
                
               {/foreach}
             {/if}
            