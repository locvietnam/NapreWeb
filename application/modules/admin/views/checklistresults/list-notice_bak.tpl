			<section class="content-header">
                <ul class="list-inline">
                    <li class="text-success"><span class="icon-calendar"></span> {date('Y/m/d')}</li>
                </ul>
            </section>

            <section class="content">
            {if $list}
            	{foreach from=$list item=item}
                <div class="box box-solid">
                    <div class="box-header">
                        <h4 class="box-title">{$item.checklist_category}</h4>
                    </div>
                    <div class="box-body checklist">
                        <ul class="list-unstyled">
                        	{foreach from=$item.checklist item=itemSub}
                            <li>
                            	{if $itemSub->checklist_checked eq 1 }
                                <input type="checkbox" id="cb{$itemSub->checklist_id}" name="submit_checklist_id[]" value="{$itemSub->checklist_id}" checked />
                                <label class="icon-check" for="cb{$itemSub->checklist_id}">
                                    <span>{$itemSub->title}</span>
                                </label>
                                {else}
                                <input type="checkbox" id="cb{$itemSub->checklist_id}" name="submit_checklist_id[]" value="{$itemSub->checklist_id}" />
                                <label class="icon-check" for="cb{$itemSub->checklist_id}">
                                    <span>{$itemSub->title}</span>
                                </label>
                                {/if}
                            </li>
                            {/foreach}                            
                        </ul>
                    </div>
                </div>
				{/foreach}
                {/if}
            </section>