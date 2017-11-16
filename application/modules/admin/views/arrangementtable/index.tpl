			<section class="content p-t-30">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-custom text-center">
                        <tr class="text-purple text-bold f-16">
                            <th style="min-width: 100px; width: 100px;">{$lable.department}</th>
                            <th style="min-width: 150px; width: 150px;">{$lable.manager}</th>
                            <th colspan="{$maxstaff}">{$lable.staff}</th>
                        </tr>
                        {if $listmanager}
                        	{foreach from=$listmanager item=item}
                        <tr>
                            <td class="text-danger f-mont text-bold f-16">{$item.department_name}</td>
                            <td class="text-purple hover-purple text-bold f-16">{$item.user_fullname}</td>
                            {for $foo=0 to $maxstaff-1}
                            <td class="hover-danger {if isset($item.staff.$foo)}cursor arrangement-table-open-popopu{/if}" data-avail="{if isset($item.staff.$foo)}{$item.staff.$foo.avail}{/if}" data-id="{if isset($item.staff.$foo)}{$item.staff.$foo.id}{/if}" data-departmentid="{$item.department_id}" data-departmentname="{$item.department_name}" data-managername="{$item.user_fullname}" data-managerid="{$item.manager_id}" data-toggle="modal" {if isset($item.staff.$foo)}data-target="#modalForward"{/if}>{if isset($item.staff.$foo)}{$item.staff.$foo.user_fullname}{/if}</td>
                            {/for}
                            {/foreach}
                        </tr>
                        {/if}
                    </table>
                </div>
                <!-- /Table -->

                <!-- modal-forward -->
                <div class="modal modal-purple fade" id="modalForward">
                    <div class="modal-dialog modal-purple">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-center manager-name">前田</h4>
                                <button type="button" class="close">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </button>
                            </div>
                            <form method="post" id="savechangedepartment" name="savechangedepartment" action="" accept-charset="utf-8" class="farrangement-table">
                            	<input id="id" type="hidden" name="id" value="">
                            <div class="modal-body">
                                <div class="modal-body-content">
                                    
                                        <ul class="list-unstyled list-forward">
                                            <li>
                                                <h5 class="text-purple">{$lable.arrangementtable_current_location}</h5>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <p class="col-xs-6">{$lable.department}</p>
                                                    <p class="col-xs-6 text-right text-danger f-mont department-name-from">3A</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <p class="col-xs-6">{$lable.title}</p>
                                                    <p class="col-xs-6 text-right text-purple manager-name">マネージャー</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="list-unstyled list-forward">
                                            <li>
                                                <h5 class="text-purple">{$lable.arrangementtable_forward_to_department}</h5>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <p class="col-xs-6">{$lable.department}</p>
                                                    <div class="col-xs-6 text-right text-danger f-mont f-16 department-name-to">4B</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <p class="col-xs-6">{$lable.title}</p>
                                                    <p class="col-xs-6 text-right">
                                                        <a id="toggleModalActive" href="javascript:;" class="text-purple"><span class="staff-name"></span>
                                                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                                        </a>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="checkbox" style="display:none;">
                                            <input type="checkbox" id="avail" name="avail" value="1" >
                                            <label class="icon-check" for="avail">
                                                <span>{$lable.it_will_not_work}</span>
                                            </label>
                                        </div>
                                        <hr class="row clearfix m-lr-25"></hr>
                                        <div class="row">
                                            <!--<div class="col-xs-6">
                                                <button type="button" class="btn btn-default btn-custom btn-block">{$lable.cancellation}</button>
                                            </div>-->
                                            <div class="col-xs-12">
                                                <button type="submit" class="btn bg-danger btn-custom btn-block">{$lable.btn_save}</button>
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="modal-body-content checklist p-l-0">
                                    <ul class="list-unstyled arrangement-table-icon-check">
                                    	{if $listdept}
                                    	{foreach from=$listdept item=item}
                                        <li class="hvr-underline-from-left id-dept-{$item->department_id}">
                                            <input type="radio" name="position" id="cb{$item->department_id}" value="{$item->department_id}" />
                                            <label class="icon-check" for="cb{$item->department_id}">
                                                <span class="text-danger f-mont f-18">{$item->department_name}</span>
                                            </label>
                                        </li>
                                        {/foreach}
                                        {/if}
                                    </ul>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Modal-forward -->

            </section>