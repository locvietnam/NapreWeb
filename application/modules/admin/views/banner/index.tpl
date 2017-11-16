            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.add_banner}</h4>
                    <div class="group-btn">
                        <a class="hoverJS" href="{$base_url_admin}/banner/add.html" title="{$lable.add_banner}">
                            <img src="{$base_tlp_admin}/img/icon/icon-add.png">
                        </a>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-custom text-center">
                        <tr class="text-purple text-bold f-16">
                            <th style="min-width: 100px; width: 100px;">{$lable.id}</th>
                            <th style="min-width: 150px; width: 150px;">{$lable.title}</th>
                            <th style="min-width: 150px; width: 150px;">{$lable.image}</th>
                            <th>{$lable.date_add}</th>
                            <th>&nbsp;</th>
                        </tr>
                        {foreach from=$list key=k item=v}
                        <tr>
                            <td >{$v->id}</td>
                            <td>
                            {$v->tille}
                            </td>
                            <td >
                            {if file_exists( $path_upload|cat:'/'|cat:$v->file_img ) eq 1 && $v->file_img neq '' }
                            <img src="{$base_url}/files/uploads/{$v->file_img}" alt="{$v->tille}" style="max-width:70px;" />
                            {/if}
                            </td>
                            <td>
                            {$v->date_add}
                            </td>
                            <td style="width:120px;">
                            <a class="hoverJS delete-banner" data-message="{$lable.confirm_del}" data-id="{$v->id}" data-filecurent="{$v->file_img}" href="javascript:void(0);" title="Delete">
                                <img src="{$base_tlp_admin}/img/icon/icon-delete.png">
                            </a>
                            <a class="btn btn-danger" href="{$base_url_admin}/banner/add.html?id={$v->id}" title="Edit" style="border-radius:50%; padding:4px 7px;">
                                <i class="fa fa-edit"></i>
                            </a>
                            </td>
                        </tr>
                        {/foreach}
                    </table>
                </div>
                <!-- /Table -->
                
            </section>
