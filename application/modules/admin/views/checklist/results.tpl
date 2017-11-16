            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.admin_sidebar_checklist_create}</h4>
                    <div class="group-btn">
                        <a href="{$base_url_admin}/checklist-create.html" title="Create">
                            <img src="{$base_tlp_admin}/img/icon/icon-add.png">
                        </a>                            
                    </div>
                </div>
                <!-- Table -->
                
                <div class="table-responsive">
                    <form method="post" action="" name="memberForm">

                        <table class="table list-items table-bordered">
                            <tbody>
                                <tr style="background:#fafafa">
                                    <th width="3%">
									 </th>
                                    <th width="35%"><b style="text-transform: uppercase;">{$lable.checklist}</b></td>
                                    <th width="20%"><b style="text-transform: uppercase;">{$lable.checklist_sub_categories}</b></td>
                                    <th width="20%"><b style="text-transform: uppercase;">{$lable.checklist_type}</b></td>
                                    <th width="20%"><b style="text-transform: uppercase;">{$lable.checklist_manager}</b></td>
                                    <th width="20%"><b style="text-transform: uppercase;">{$lable.department}</b></td>
                                    <th style="text-align: center;text-transform: uppercase;"><b>{$lable.action}</b>
                                    </td>
                                </tr>
                                {if $list}
                                {foreach from=$list item=item}
                                
                                    <tr>
                                        <td style="vertical-align: middle;">
										</td>
                                        <td style="vertical-align: middle;">
                                            <p style="font-family: sans-serif;"><strong>{$item.checklist_category}</strong></p>

                                        </td>
                                        <td style="vertical-align: middle;">
                                            {$item.count_checklist} description
                                        </td>
                                        <td style="vertical-align: middle;">
                                            {$item.checklist_type}
                                        </td>
                                        <td style="vertical-align: middle;">
                                            {$item.manager_name}
                                        </td>
                                        <td style="vertical-align: middle;">
                                            {$item.department_name}
                                        </td>
                                        <td style="text-align: center;vertical-align: middle; min-width:5%;">
                                            
                                            {if $user_data->role_id <= 3}
                                            <a class="delusermanagerdep" data-message="{$lable.confirm_del}" data-managerid = "{$item.manager_id}" data-departmentid="{$item.department_id}" title="Delete">
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