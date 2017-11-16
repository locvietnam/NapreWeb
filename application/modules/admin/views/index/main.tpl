        <section class="content-header text-success">
            <ul class="list-inline">
                <li class="text-success"><span class="icon-calendar"></span> {date('Y/m/d')}</li>
            </ul>
        </section>
        
        <section class="content">
            {if $list}
                {foreach from=$list item=item }
            <!-- box -->
            <div class="box box-solid">
                <div class="box-header">
                    <h4 class="box-title text-purple f-mont">{if $item.message_type eq 'U' }Top manager{else}A-LINE{/if}</h4>
                </div>
                <div class="box-body">
                    <p class="time text-success">{$item.ftime}
                    {if $item.user_id_received eq $user_data->user_id}
                    	<a style="cursor:pointer; float:right;" onclick="deleteMessage(this, '{$item.id}','{$lable.confirm_del}?');" >
                        <img src="{$base_tlp_admin}/img/icon/icon-delete.png">
                        </a>
                    {/if}</p>
                    <p>{$item.contents}</p>
                </div>
            </div>
            <!-- /box -->
                {/foreach}
            {/if}
        </section>
