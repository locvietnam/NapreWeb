            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.add_user_assign_dept}</h4>
                    <div class="group-btn">
                        <a href="{$base_url_admin}/department/add-user-assign-dept.html" title="{$lable.create}">
                            <img src="{$base_tlp_admin}/img/icon/icon-add.png">
                        </a>
                        {if isset($smarty.get.avail) }
                        <a href="{$base_url_admin}/department/user-assign-dept.html" title="{$lable.list}">
                            <i class="fa fa-arrow-left" style="font-size:36px;"></i>
                        </a>
                        {else}
                        <a href="{$base_url_admin}/department/user-assign-dept.html?avail=trash" title="{$lable.trash}">
                            {if $trash }
                            	<i class="fa fa-trash"></i>
                            {else}
                            	<i class="fa fa-trash-o"></i>
                            {/if}
                        </a>
                        {/if}
                    </div>
                </div>
                <!-- Table -->
                <div class="box-header p-l-0 p-r-0">
                    <form method="get" action="{$base_url_admin}/department/user-assign-dept.html{if !isset($smarty.get.avail) || $smarty.get.avail eq 'trash' }?avail=trash{/if}" name="box_search">
                        <div class="col-md-4 pad-left-0 p-r-0">
                            <input class="form-control" id="appendedInputButtons" type="text" name="keyword" value="{$keyword}" placeholder="{$lable.search} ..." />
                        </div>
                        <div class="col-md-2 pad-left-0">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><strong>{$lable.btn_search}</strong></button>
							</div>
						</div>
                    </form>
                    <div class="separator"></div>
                </div>
                <div class="table-responsive">
                    <form method="post" action="" name="memberForm">

                        <table class="table list-items table-bordered">
                            <tbody>
                                <tr style="background:#fafafa">
                                    <th width="3%">
									 </th>
                                    <th width="35%"><b style="text-transform: uppercase;">{$lable.user_fullname}</b></td>
                                    <th width="20%"><b style="text-transform: uppercase;">{$lable.user_manager_dept}</b></td>
                                    <th width="20%"><b style="text-transform: uppercase;">{$lable.infomation}</b></td>
                                    <th style="text-align: center;text-transform: uppercase;"><b>{$lable.action}</b>
                                    </td>
                                </tr>
                                {if $list}
                                {foreach from=$list item=item}
                                
                                    <tr>
                                        <td style="vertical-align: middle;">
										</td>
                                        <td style="vertical-align: middle;">
                                            <p style="font-family: sans-serif;"><strong>{$item.user_fullname}</strong></p>

                                        </td>
                                        <td style="vertical-align: middle;">
                                            <p style="font-family: sans-serif;"><strong>{$item.manager_fullname}</strong></p>

                                        </td>
                                        <td style="vertical-align: middle;">
                                            {if $item.user_name}<div><u>{$lable.user_name} : </u><strong>{$item.user_name}</strong></div>{/if}
                                            <div><u>{$lable.admin_role}</u> : {$item.role_name}</div>
                                            <div><u>{$lable.department}</u> : {$item.department_name}</div>
                                        </td>
                                        <td style="text-align: center;vertical-align: middle; min-width:7%;">
                                            {if $user_data->role_id <= 3}
                                            	{if $item.avail eq 0 }
                                                <a class="btn deluserassigndept cursor" data-message="{$lable.confirm_del}" data-id = "{$item.id}" title="{$lable.delete}">
                                                	<img src="{$base_tlp_admin}/img/icon/icon-delete.png">                                                
                                                </a>
                                                <!--<a class="btn reset-user-assign" href="{$base_url_admin}/department/reset-user-assign.html?id={$item.id}" title="Reseter">
                                                <i class="fa fa-reply"></i>
                                                </a>-->
                                                {else}
                                                <a class="btn deluserassigndept cursor" data-message="{$lable.confirm_del}" data-id = "{$item.id}" title="{$lable.trash}">
                                                <i class="fa fa-trash"></i>
                                                </a>                                                
                                                {/if}
                                            {/if}
                                        </td>
                                    </tr>
                                {/foreach}
                                {/if}
                            </tbody>
                        </table>
                    </form>
                    {$links}
                </div>
            </section>