<?php
/**
 * The workflow rule detail view file of workflow module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     workflow 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
?>
<?php include '../../../sys/common/view/header.modal.html.php';?>
<?php if(!helper::isAjaxRequest()):?>
<div class='modal' id='ajaxModal' ref="<?php echo $this->app->getURI();?>">
  <div class='modal-dialog' style='width: 750px'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span><span class='sr-only'>X</span></button>
        <h4 class='modal-title'><?php echo $lang->workflow->viewRule;?></h4>
      </div>
      <div class='modal-body'>
<?php endif;?>
<div class='panel'>
  <div class='panel-body'>
    <table class='table table-info'>
      <tr>
        <th class='w-80px'><?php echo $lang->workflowrule->type;?></th>
        <td><?php echo zget($lang->workflowrule->typeList, $rule->type, '');?></td>
      </tr>
      <tr>
        <th class='w-80px'><?php echo $lang->workflowrule->name;?></th>
        <td><?php echo $rule->name;?></td>
      </tr>
      <tr>
        <th><?php echo $lang->workflowrule->rule;?></th>
        <td><?php echo $rule->rule;?></td>
      </tr>
    </table>
  </div>
</div>
<?php echo $this->fetch('action', 'history', "objectType=workflowrule&objectID={$rule->id}");?>
<?php if(!helper::isAjaxRequest()):?>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function()
{
    $('.clearfix').find('.panel').remove();
    $('#ajaxModal').modal('show', 'fit');
})
</script>
<?php endif;?>
<?php include '../../../sys/common/view/footer.modal.html.php';?>
