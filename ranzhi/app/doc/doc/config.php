<?php
/**
 * The config file of doc module of RanZhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     doc 
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
$config->doc = new stdclass();
$config->doc->require = new stdclass();
$config->doc->require->createLib = 'name';
$config->doc->require->editLib   = 'name';
$config->doc->require->create    = 'title';
$config->doc->require->edit      = 'title';

$config->doc->editor = new stdclass();
$config->doc->editor->create = array('id' => 'content', 'tools' => 'simple');
$config->doc->editor->edit   = array('id' => 'content,comment', 'tools' => 'simple');
$config->doc->editor->view   = array('id' => 'lastComment', 'tools' => 'simple');

$config->doc->markdown = new stdclass();
$config->doc->markdown->create = array('id' => 'contentMarkdown', 'tools' => 'withchange');

global $lang;
$config->doc->search['module']                   = 'doc';
$config->doc->search['fields']['title']          = $lang->doc->title;
$config->doc->search['fields']['id']             = $lang->doc->id;
$config->doc->search['fields']['project']        = $lang->doc->project;
$config->doc->search['fields']['keywords']       = $lang->doc->keywords;
$config->doc->search['fields']['type']           = $lang->doc->type;
$config->doc->search['fields']['module']         = $lang->doc->category;
$config->doc->search['fields']['lib']            = $lang->doc->lib;
$config->doc->search['fields']['createdBy']      = $lang->doc->createdBy;
$config->doc->search['fields']['createdDate']    = $lang->doc->createdDate;
$config->doc->search['fields']['editedBy']       = $lang->doc->editedBy;
$config->doc->search['fields']['editedDate']     = $lang->doc->editedDate;

$config->doc->search['params']['title']         = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->doc->search['params']['id']            = array('operator' => '=',       'control' => 'input',  'values' => '');
$config->doc->search['params']['project']       = array('operator' => '=',       'control' => 'select', 'values' => 'set in control');
$config->doc->search['params']['keywords']      = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->doc->search['params']['type']          = array('operator' => '=',       'control' => 'select', 'values' => $lang->doc->types);
$config->doc->search['params']['module']        = array('operator' => 'belong',  'control' => 'select', 'values' => 'set in control');
$config->doc->search['params']['lib']           = array('operator' => '=',       'control' => 'select', 'values' => 'set in control');
$config->doc->search['params']['createdBy']     = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->doc->search['params']['createdDate']   = array('operator' => '>=',      'control' => 'input',  'values' => '', 'class' => 'date');
$config->doc->search['params']['editedBy']      = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->doc->search['params']['editedDate']    = array('operator' => '>=',      'control' => 'input',  'values' => '', 'class' => 'date');
