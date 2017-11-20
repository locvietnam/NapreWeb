<?php /* Smarty version 3.1.28-dev/21, created on 2017-11-20 02:28:46
         compiled from "C:\xampp\htdocs\customer\aline\application\modules\admin\views\comment\main-footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:265325a122fce4bd2f0_86869695%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03aab0e8813eafe785bcc6a73cfc0400436caaf8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\customer\\aline\\application\\modules\\admin\\views\\comment\\main-footer.tpl',
      1 => 1511139950,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '265325a122fce4bd2f0_86869695',
  'variables' => 
  array (
    'current_method' => 0,
    'user_data' => 0,
    'links' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/21',
  'unifunc' => 'content_5a122fce4cac73_08338122',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a122fce4cac73_08338122')) {
function content_5a122fce4cac73_08338122 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '265325a122fce4bd2f0_86869695';
?>
		<?php if ($_smarty_tpl->tpl_vars['current_method']->value != 'listcm') {?>
            <?php if ($_smarty_tpl->tpl_vars['user_data']->value->role_id == 5) {?>
            <div class="main-footer">
                <div class="content-footer">            	
                        <input type="hidden" name="submitid" value="<?php if (isset($_GET['submitid'])) {
echo $_GET['submitid'];
}?>" />
                    <div class="row">
                        <div class="col-xs-12">
                            <textarea class="form-custom" name="textcomment" placeholder="コメント" rows="3"></textarea>
                            <span class="error red"><?php echo form_error('textcomment');?>
</span>
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="col-lg-3 col-md-4 col-xs-6 col-lg-offset-3 col-md-offset-2">
                            <a href="#" class="btn btn-default btn-block btn-custom">次へ</a>
                        </div>-->
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <button type="submit" class="btn btn-danger btn-block btn-custom">次へ</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <?php }?>
        <?php } else { ?>
        <?php echo $_smarty_tpl->tpl_vars['links']->value;?>

        <?php }
}
}
?>