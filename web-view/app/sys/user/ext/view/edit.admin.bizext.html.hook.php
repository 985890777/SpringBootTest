<?php
include '../../common/view/chosen.html.php';
$userList = array('' => '') + $this->dao->select('account, realname')->from(TABLE_USER)->where('deleted')->eq('0')->andWhere('parent')->eq('')->fetchPairs();
unset($userList[$user->account]);
$userList = html::select('parent', $userList, $user->parent, "class='form-control'");
$checked  = $user->unofficial ? "checked='checked'" : '';
$html = <<<EOT
<tr>
  <th>{$lang->user->parent}</th>
  <td>
    <div class='input-group'>
      {$userList}
      <span class='input-group-addon'>
        <label class='checkbox-inline'>
          <input type='checkbox' name='unofficial' id='unofficial' value='1' {$checked} /> {$lang->user->unofficial}
        </label>
      </span>
    </div>
  </td>
</tr>
EOT;
?>
<script>
$('fieldset.fieldset-primary table tbody').append(<?php echo helper::jsonEncode($html);?>);
$('#parent').chosen(window.chosenDefaultOptions);
</script>
