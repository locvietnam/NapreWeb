            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.add_user_manager}</h4>
                    <div class="group-btn">
                        <a href="{$base_url_admin}/department/add-user-manager-dep.html" title="{$lable.create}">
                            <img src="{$base_tlp_admin}/img/icon/icon-add.png">
                        </a>
                    </div>
                </div>
                <!-- Table -->
                <div class="box-header p-l-0 p-r-0">
                    <form method="get" action="{$base_url_admin}/department/user-manager-dep.html" name="box_search">
                        <div class="col-md-4 pad-left-0 p-r-0">
                            <input class="form-control" id="appendedInputButtons" type="text" name="keyword" value="{$keyword}" placeholder="{$lable.search} ..." />
                        </div>
                        <div class="col-md-2 pad-left-0">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><strong>{$lable.search}</strong></button>
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
                                     <th style="min-width: 150px;">{$lable.hospital}</th>
                                    <th width="35%"><b style="text-transform: uppercase;">{$lable.users}</b></td>
                                    <th width="20%"><b style="text-transform: uppercase;">{$lable.infomation}</b></td>
                                    <th style="text-align: center;text-transform: uppercase;"><b>{$lable.action}</b>
                                    </td>
                                </tr>
                                {if $list}
                                {foreach from=$list item=item}
                                
                                    <tr>
                                        <td style="vertical-align: middle;">
										</td>
                                        <td>{$item.hospital_name}</td>
                                        <td style="vertical-align: middle;">
                                            <p style="font-family: sans-serif;"><strong>{$item.user_fullname}</strong></p>

                                        </td>
                                        <td style="vertical-align: middle;">
                                            {if $item.user_name}<div><u>{$lable.user_name} : </u><strong>{$item.user_name}</strong></div>{/if}
                                            <div><u>{$lable.admin_role}</u> : {$item.role_name}</div>
                                            <div><u>{$lable.department}</u> : {$item.department_name}</div>
                                        </td>
                                        <td style="text-align: center;vertical-align: middle; min-width:5%;">
                                            
                                            {if $user_data->role_id <= 3}
                                            <a class="delusermanagerdep cursor" data-managerid = "{$item.manager_id}" data-departmentid="{$item.department_id}" title="{$lable.delete}">
                                                <img src="{$base_tlp_admin}/img/icon/icon-delete.png">
                                            </a>
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