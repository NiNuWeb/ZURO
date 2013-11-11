<?php //netteCache[01]000375a:2:{s:4:"time";s:21:"0.64398100 1384017058";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:53:"C:\xampp\htdocs\ZURO\app\components\ListControl.latte";i:2;i:1384017056;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\components\ListControl.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '4szuw6jahz')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block _
//
if (!function_exists($_l->blocks['_'][] = '_lb639db160fd__')) { function _lb639db160fd__($_l, $_args) { extract($_args); $_control->validateControl(false)
?>	<table class="lists table table-striped">
		<thead class="todo">
			<tr>
				<th>Title</th>
				<th class="action">Action</th>
			</tr>	
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($lists as $list): ?>
			<tr>
				<td class="title"><?php echo Nette\Templating\Helpers::escapeHtml($list->title, ENT_NOQUOTES) ?></td>	
				<td class="action"><a href="<?php echo htmlSpecialChars($_control->link("default:")) ?>
"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</a> | <a href="#"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</a></td>
			</tr>
<?php $iterations++; endforeach ?>
		</tbody>
	</table>
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); } ?>
<div id="<?php echo $_control->getSnippetId('') ?>"><?php call_user_func(reset($_l->blocks['_']), $_l, $template->getParameters()) ?>
</div>