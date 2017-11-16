            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.add_hospital}</h4>
                    <div class="group-btn">
                        <a class="btn" href="{$base_url_admin}/hospital/add.html" title="{$lable.create}">
                            <img src="{$base_tlp_admin}/img/icon/icon-add.png">
                        </a>
                        {if isset($smarty.get.avail) }
                        <a class="btn" href="{$base_url_admin}/hospital.html" title="{$lable.list}">
                            <i class="fa fa-arrow-left" style="font-size:36px;"></i>
                        </a>
                        {else}
                        <a class="btn" href="{$base_url_admin}/hospital.html?avail=trash" title="{$lable.trash}">
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
                    <form method="get" action="{$action_url}" name="box_search">
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
                    <form method="post" action="{$action_url_delete_multi}" name="memberForm">

                        <table class="table list-items table-bordered">
                            <tbody>
                                <tr style="background:#fafafa">
                                    <th width="3%">
                                    ID
									 </th>
                                    <th width="35%"><b style="text-transform: uppercase;">{$lable.hospital}</b></td>
                                    <th width="15%" style="text-align: center;text-transform: uppercase;"><b>{$lable.action}</b>
                                    </td>
                                </tr>
                                {if $list}
                                {foreach from=$list key=k item=item}
                                
                                    <tr>
                                        <td style="vertical-align: middle;">
                                        {$item.hospital_id}
										</td>
                                        <td style="vertical-align: middle;">
                                            <p style="font-family: sans-serif;"><strong>{$item.hospital_name}</strong></p>

                                        </td>
                                        
                                        <td style="text-align: center;vertical-align: middle; min-width:5%;">
                                            {if $user_data->role_id <= 3}
                                            
                                                {if $item.avail eq 0 }
                                                <a class="btn delhospital cursor" data-message="{$lable.confirm_del}?" data-id = "{$item.hospital_id}" title="Delete">
                                                    <img src="{$base_tlp_admin}/img/icon/icon-delete.png">                                                
                                                </a>
                                                <a class="btn reset-user-assign" href="{$base_url_admin}/hospital/reset-hospital.html?id={$item.hospital_id}" title="Reseter">
                                                <i class="fa fa-reply"></i>
                                                </a>
                                                {else if $item.avail eq 1}
                                                <a class="btn btn-danger lang_values" href="{$base_url_admin}/hospital/add.html?id={$item.hospital_id}" title="Edit" style="border-radius:50%; padding:4px 7px;">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn delhospital cursor" data-message="{$lable.confirm_del}?" data-id = "{$item.hospital_id}" title="Delete">
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