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
            <section class="content p-t-30">
                <!-- Table -->                
                <div class="table-responsive">
                    <form method="post" action="" name="memberForm">

                        <table class="table list-items table-bordered">
                            <tbody>
                                <tr style="background:#fafafa">
                                     <th width="10%"><b style="text-transform: uppercase;">{$lable.department}</b></td>
                                    <th width="35%"><b style="text-transform: uppercase;">{$lable.checklist}</b></td>
                                    <th width="20%"><b style="text-transform: uppercase;">{$lable.checklist_manager}</b></td>
                                    <th width="20%"><b style="text-transform: uppercase;">{$lable.staff}</b></td>
                                    <th width="15%" style="text-align: center;text-transform: uppercase;"><b>{$lable.action}</b>
                                    </td>
                                </tr>
                                {if $list}
                                {foreach from=$list item=item}
                                
                                    <tr>
                                        <td style="vertical-align: middle;">
                                        	{$item->department_name}
										</td>
                                        <td style="vertical-align: middle;">
                                            <p style="font-family: sans-serif;">
                                            <strong>{$item->checklist_category}</strong>                                            
                                            </p>

                                        </td>
                                        <td style="vertical-align: middle;">
                                            {$item->manager_name}
                                        </td>
                                        <td style="vertical-align: middle;">
                                        	{foreach from=$item->staff item=staffItem}
                                            {$staffItem->user_fullname}<br />
                                            {/foreach}
                                           <!-- <br />
                                            <a href="{$base_url_admin}/add-checklist-user.html">
                                            	&gt;&gt;{$lable.add_staff_checklist}
                                            </a>-->
                                        </td>
                                        <td style="text-align: center;vertical-align: middle; min-width:5%;">
                                            
                                            {if $user_data->role_id <= 5}
                                            <a class="btn btn-danger lang_values" href="{$base_url_admin}/add-checklist-user.html?id={$item->checklist_category_id}" title="{$lable.edit}" style="border-radius:50%; padding:4px 7px;">
                                                    <i class="fa fa-edit"></i>
                                           	</a>
                                            	{if $item->count_staff > 0 }
                                                    <a style="cursor:pointer;" data-message="{$lable.confirm_del}?" class="delete-checklist-of-staff" data-id="{$item->checklist_category_id}">
                                                        <img src="{$base_tlp_admin}/img/icon/icon-delete.png">
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