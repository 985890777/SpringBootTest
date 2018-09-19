<?php
/**
 * The set reviewer view file of leave module of RanZhi.
 *
 * @copyright   Copyright 2009-2017 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     leave 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../../sys/common/view/chosen.html.php';?>
<?php if(!$module):?>
<div class='with-side'>
  <div class='side'>
    <nav class='menu leftmenu affix'>
      <ul class='nav nav-primary'>
        <?php foreach($lang->leave->settings as $setting):?>
        <?php list($label, $module, $method) = explode('|', $setting);?>
        <li <?php if($method == $this->methodName) echo "class='active'";?>><?php commonModel::printLink($module, $method, '', $label);?></li>
        <?php endforeach;?>
      </ul>
    </nav>
  </div>
  <div class='main'>
<?php endif;?>
<?php js::set('turnon', empty($multiReviewer) ? 0 : 1);?>
    <div class='panel'>
      <div class='panel-heading'>
        <strong><?php echo $lang->leave->setReviewer;?></strong>
        <?php if($modules):?>
        <div class='panel-actions pull-right'>
          <?php echo html::a('#copyReviewerModal', "<i class='icon icon-copy'> </i>" . $lang->leave->copyReviewer, "class='btn' data-toggle='modal'");?>
        </div>
        <?php endif;?>
      </div>
      <div class='panel-body'>
        <form id='ajaxForm' method='post'>
          <table class='table table-form table-condensed w-p40'>
            <tr>
              <th class='w-100px'><?php echo $lang->leave->multiReviewer;?></th>
              <td><?php echo html::radio('turnon', $lang->leave->multiReviewerStatusList, !empty($multiReviewer));?></td>
              <td></td>
            </tr>
            <?php $i = 1;?>
            <?php if($multiReviewer):?>
            <?php foreach($multiReviewer as $reviewer):?>
            <tr>
              <th><?php echo $i++;?></th>
              <td><?php echo html::select('multiReviewer[]', $users, $reviewer, "class='form-control chosen multiReviewer'")?></td>
              <td class='nopaddingleft'>
                <a class='btn btn-sm addItem'><i class='icon icon-plus'></i></a>
                <a class='btn btn-sm delItem'><i class='icon icon-remove'></i></a>
              </td>
            </tr>
            <?php endforeach;?>
            <?php else:?>
            <tr>
              <th><?php echo $i++;?></th>
              <td><?php echo html::select('multiReviewer[]', $users, '', "class='form-control chosen multiReviewer'")?></td>
              <td class='nopaddingleft'>
                <a class='btn btn-sm addItem'><i class='icon icon-plus'></i></a>
                <a class='btn btn-sm delItem'><i class='icon icon-remove'></i></a>
              </td>
            </tr>
            <?php endif;?>
            <tr>
              <th class='w-100px'><?php echo $lang->leave->reviewers;?></th>
              <td><?php echo html::select('reviewedBy', $users, $reviewedBy, "class='form-control chosen singleReviewer'")?></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td colspan='2'><?php echo html::submitButton();?></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
    <div class='modal fade' id='copyReviewerModal'>
      <div class='modal-dialog w-400px'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'><?php echo $lang->leave->copyReviewer;?></h4>
        </div>
        <div class='modal-body'>
          <div class='row'>
            <?php foreach($modules as $copyModule):?>
            <div class='col-md-4 col-sm-6'>
              <?php $this->app->loadLang($copyModule, 'oa');?>
              <?php echo html::a(inlink('setReviewer', "module=$module&copyModule=$copyModule"), $lang->$copyModule->common, "class='btn copyReviewer'");?>
            </div>
            <?php endforeach;?>
          </div>
        </div>
      </div>
    </div>
<?php if(!$module):?>
  </div>
</div>
<?php endif;?>
<?php js::set('index', $i);?>
<?php include '../../../common/view/footer.html.php';?>
