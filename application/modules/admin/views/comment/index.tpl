			<form action="" method="post">
            <section class="content-header">
                <ul class="list-inline">
                    <li class="text-success"><span class="icon-calendar"></span> {$datecomment}                    
                     <!--<input type="text" name="datecomment" value="{$datecomment}" />-->
                     </li>
                    <li class="text-danger"><span class="icon-building"></span> {$dept->department_name}</li>
                </ul>
            </section>
			
            <section class="content">
            
            	{foreach from=$list item=item}
                	{if $item.parent_id eq 0 }
                    <input type="hidden" name="id" value="{$item.id}" />
                <!-- box -->
                <div class="box box-solid">
                    <div class="box-header">
                        <h4 class="box-title">{$item.user_fullname}</h4>
                    </div>
                    <div class="box-body">
                        <p class="time text-success">{$item.ftime}</p>
                        <p>{$item.comments}</p>
                    </div>
                </div>
                <!-- /box -->
				{else if $item.parent_id >  0}
                <!-- box -->
                <div class="box box-solid w90 pull-right">
                    <div class="box-header">
                        <h4 class="box-title text-danger">{$item.manager_fullname}</h4>
                    </div>
                    <div class="box-body">
                        <p class="time text-success">{$item.ftime}</p>
                        <p>{$item.comments}</p>
                    </div>
                </div>
                <!-- /box -->
                {/if}
				{/foreach}
            </section>