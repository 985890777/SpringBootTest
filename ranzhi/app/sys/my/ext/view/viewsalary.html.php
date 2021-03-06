<?php
/**
 * The detail view file of salary module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     salary 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
?>
<?php include $app->getModuleRoot() . 'my/view/header.html.php';?>
<h3 class='text-center'>
  <?php echo sprintf($lang->salary->title, zget($users, $salary->account), substr($salary->month, 0, 4), (int)substr($salary->month, 4, 2));?>
</h3>
<table class='table table-condensed table-bordered'>
  <thead>
    <tr class='text-center'>
      <th rowspan='2' class='text-middle'><?php echo $lang->salary->basic;?></th>
      <th rowspan='2' class='text-middle'><?php echo $lang->salary->benefit;?></th>
      <?php
      if($salary->bonusList)
      {
          $count = count($salary->bonusList);
          echo "<th colspan='{$count}'>{$lang->salary->bonus}</th>";
      }
      if($salary->allowanceList)
      {
          $count = count($salary->allowanceList);
          echo "<th colspan='{$count}'>{$lang->salary->allowance}</th>";
      }
      if($salary->deductionList)
      {
          $count = count($salary->deductionList);
          echo "<th colspan='{$count}'>{$lang->salary->deduction}</th>";
      }
      ?>
      <th rowspan='2' class='text-middle'><?php echo $lang->salary->deserved;?></th>
      <th rowspan='2' class='text-middle'><?php echo $lang->salary->actual;?></th>
      <th rowspan='2' class='text-middle'><?php echo $lang->salary->companySSF;?></th>
      <th rowspan='2' class='text-middle'><?php echo $lang->salary->companyHPF;?></th>
    </tr>
    <tr class='text-center'>
    <?php 
      $hasCommission = false;
      foreach($salary->bonusList as $bonus)         
      {
          if($bonus->type == $lang->salary->bonusList['commission']) $hasCommission = true;
          echo "<th>{$bonus->type}</th>";
      }
      foreach($salary->allowanceList as $allowance) echo "<th>{$allowance->type}</th>";
      foreach($salary->deductionList as $deduction) echo "<th>{$deduction->type}</th>";
    ?>
    </tr>
  </thead>
  <tr class='text-center'>
    <td><?php echo formatMoney($salary->basic);?></td>
    <td><?php echo formatMoney($salary->benefit);?></td>
    <?php 
    foreach($salary->bonusList as $bonus)         echo '<td>' . formatMoney($bonus->amount)     . '</td>';
    foreach($salary->allowanceList as $allowance) echo '<td>' . formatMoney($allowance->amount) . '</td>';
    foreach($salary->deductionList as $deduction) echo '<td>' . formatMoney($deduction->amount) . '</td>';
    ?>
    <td><?php echo formatMoney($salary->deserved);?></td>
    <td><?php echo formatMoney($salary->actual);?></td>
    <td><?php echo formatMoney($salary->companySSF);?></td>
    <td><?php echo formatMoney($salary->companyHPF);?></td>
  </tr>
</table>
<?php $lineCommissionList = isset($commissions['lineCommissionList']) ? $commissions['lineCommissionList'] : array();?>
<?php $saleCommissionList = isset($commissions['saleCommissionList']) ? $commissions['saleCommissionList'] : array();?>
<?php $saleRule           = isset($commissions['saleRule']) ? $commissions['saleRule'] : array();?>

<?php if(($lineCommissionList || $saleCommissionList) && (!empty($lineRule) || !empty($saleRule))):?>
<div id='commissionDIV' class='panel'>
  <div class='panel-heading'>
    <strong><?php echo $lang->salary->viewCommissions;?></strong>
  </div>
  <div class='panel-body'>
  <?php if($lineCommissionList):?>
    <div class='panel'>
      <table class='table table-condensed table-bordered table-striped table-hover text-center text-middle'>
        <thead>
          <tr class='text-center'>
            <th class='w-100px'><?php echo $lang->commission->type;?></th>
            <th class='w-180px'><?php echo $lang->salary->lineList;?></th>
            <th><?php echo $lang->salary->amount;?></th>
            <th><?php echo $lang->commission->base;?></th>
            <th><?php echo $lang->salary->rate;?></th>
            <th><?php echo $lang->salary->commission;?></th>
          </tr>
        </thead>
        <?php $i = 0;?>
        <?php $totalMoney = $totalCommission = $totalAmount = 0;?>
        <?php foreach($lineCommissionList as $commission):?>
        <tr>
          <?php if($i == 0):?>
          <th class='text-center text-middle not-table-hover' rowspan='<?php echo count($lineCommissionList);?>'><?php echo $lang->commission->typeList['line'];?></th>
          <?php endif;?>
          <td><?php echo $commission->line;?></td>
          <td><?php echo formatMoney($commission->money);?></td>
          <td><?php echo formatMoney($commission->commission);?></td>
          <td><?php echo $commission->rate . $lang->percent;?></td>
          <td><?php echo formatMoney($commission->amount);?></td>
        </tr>
        <?php $totalMoney      += $commission->money;?>
        <?php $totalCommission += $commission->commission;?>
        <?php $totalAmount     += $commission->amount;?>
        <?php $i++;?>
        <?php endforeach;?>
        <tfoot>
          <tr class='footer'>
            <th class='text-center'><?php echo $lang->salary->total;?></th>
            <td></td>
            <td><?php echo formatMoney($totalMoney);?></td>
            <td><?php echo formatMoney($totalCommission);?></td>
            <td></td>
            <td><?php echo formatMoney($totalAmount);?></td>
          </tr>
        </tfoot>
      </table>
    </div>
  <?php endif;?>
  <?php if($saleCommissionList):?>
    <div class='panel'>
      <table class='table table-condensed table-bordered table-striped table-hover table-fixed tablesorter table-fixedHeader'>
        <thead>
          <tr class='text-center'>
            <th class='w-100px'><?php echo $lang->commission->type;?></th>
            <th><?php echo $lang->trade->trader;?></th>
            <th><?php echo $lang->trade->product;?></th>
            <th class='w-160px'><?php echo $lang->trade->money;?></th>
            <th class='w-160px'><?php echo $lang->commission->base;?></th>
            <?php if($saleRule->rule == 'multistep'):?>
            <th class='w-160px'><?php echo $lang->commission->contribution;?></th>
            <?php else:?>
            <th class='w-160px'><?php echo $lang->commission->rate;?></th>
            <?php endif;?>
            <th class='w-200px'><?php echo $lang->commission->rule;?></th>
            <th class='w-160px'><?php echo $lang->salary->commission;?></th>
          </tr>
        </thead>
        <?php $i = 0;?>
        <?php $totalMoney = $totalCommission = $totalAmount = 0;?>
        <?php foreach($saleCommissionList as $commission):?>
        <tr>
          <?php if($i == 0):?>
          <th class='text-center text-middle not-table-hover' rowspan='<?php echo count($saleCommissionList);?>'><?php echo $lang->commission->typeList['sale'];?></th>
          <?php endif;?>
          <td><?php echo zget($customerList, $commission->trader, ' ');?></td>
          <td><?php echo zget($productList, $commission->product, ' ');?></td>
          <td><?php echo formatMoney($commission->money);?></td>
          <td><?php echo formatMoney($commission->commission);?></td>
          <?php if(isset($saleRule->rule) && $saleRule->rule == 'multistep'):?>
          <td><?php echo $commission->contribution . $lang->percent;?></td>
          <?php else:?>
          <td><?php echo $commission->rate . $lang->percent;?></td>
          <?php endif;?>
          <?php if($i == 0):?>
          <td class='not-table-hover' rowspan='<?php echo count($saleCommissionList);?>'>
          <?php if(!empty($saleRule->rule)) echo $lang->commission->saleCommission->ruleList[$saleRule->rule];?>
          </td>
          <?php endif;?>
          <td><?php echo formatMoney($commission->amount);?></td>
        </tr>
        <?php
          $totalMoney      += $commission->money;
          $totalCommission += $commission->commission;
          $totalAmount     += $commission->amount;
          $i++;
          endforeach;
        ?>
        <tfoot>
          <tr class='footer'>
            <td><?php echo $lang->salary->total;?>
            <td colspan='2'></td>
            <td><?php echo formatMoney($totalMoney);?></td>
            <td><?php echo formatMoney($totalCommission);?></td>
            <td colspan='2'></td>
            <td><?php echo formatMoney($totalAmount);?></td>
          </tr>
        </tfoot>
      </table>
    </div>
  <?php endif;?>
  </div>
</div>
<?php endif;?>
<div class='page-actions'><?php echo html::backButton();?></div>
<?php include $app->getModuleRoot() . 'common/view/footer.html.php';?>
