			<section class="content-header">
                <div class="row">
                    <div class="col-xs-8 col-12 col-mt-15">
                        <i class="icon-search"></i>
                        <input class="search" type="text" name="search" placeholder="{$lable.search}">
                    </div>
                    <div class="col-xs-4 col-12">
                        <a class="checkAll" href="javascript:;">{$lable.check_all}</a>
                    </div>
                </div>
            </section>

            <hr class="clearfix">
            {if $send_message neq ''}
            <meta http-equiv="refresh"
   content="3; url={$base_url_admin}/message.html">
            <section class="content" style="min-height:50px; padding-top:0px; padding-bottom:0px;">
            <div class="alert {$alert_class}">
              {$send_message}
            </div>
            </section>
            {/if}
            <form action="" method="post" accept-charset="utf-8" id="fsendmessage" >
            	<input type="hidden" name="user_id" id = "user_id" />
                <section class="content">
                    <!-- list-users -->
                    <div class="box box-solid list-users">
                        <div class="row">
                        	{if $list}
                                {foreach from=$list item=item}
                            <div class="item-user col-lg-2 col-md-3 col-xs-4 col-6" id="{$item->user_fullname}">
                                <div class="image">
                                    <input type="checkbox" id="cb{$item->user_id}" value="{$item->user_id}" />
                                    <label for="cb{$item->user_id}" class="hvr-glow icon-check">
                                        <img src="{$base_tlp_admin}/img/icon/icon-user.png" class="img-circle" alt="User{$item->user_id}">
                                        <i class="icon-checked"></i>
                                    </label>
                                </div>
                                <p style="width:100%;display:block; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="{$item->user_fullname}">{$item->user_fullname}</p>
                            </div>
                            	{/foreach}
                           {/if}
                        </div>
                    </div>
                    <!-- /list-users -->
                </section>
            