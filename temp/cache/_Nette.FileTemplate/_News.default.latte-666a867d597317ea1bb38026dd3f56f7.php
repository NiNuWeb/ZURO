<?php //netteCache[01]000387a:2:{s:4:"time";s:21:"0.98474400 1384454275";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:65:"C:\xampp\htdocs\ZURO\app\AdminModule\templates\News\default.latte";i:2;i:1384454270;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\AdminModule\templates\News\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'f2h7bplraf')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb26aee098db_content')) { function _lb26aee098db_content($_l, $_args) { extract($_args)
?><h2>Manage News</h2>
<br />
<div class="table-responsive col-md-9">
<div id="<?php echo $_control->getSnippetId('tableNews') ?>"><?php call_user_func(reset($_l->blocks['_tableNews']), $_l, $template->getParameters()) ?>
</div>	<a class="btn btn-danger" href="<?php echo htmlSpecialChars($_control->link("News:AddNews")) ?>
"><i class="glyphicon glyphicon-plus-sign">&nbsp;</i><b>Add News</b></a>
</div><?php
}}

//
// block _tableNews
//
if (!function_exists($_l->blocks['_tableNews'][] = '_lbcd5aa31181__tableNews')) { function _lbcd5aa31181__tableNews($_l, $_args) { extract($_args); $_control->validateControl('tableNews')
?>	<table class="table table-hover news">
		<thead>
			<tr>
				<th>News Title</th>
				<th>Body</th>
				<th>Creation Time</th>
				<th>Created By</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($allNews as $news): ?>
			<tr>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($news->title, ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($template->truncate($news->body, 30), ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($template->date($news->date, 'j.n.Y H:i:s'), ENT_NOQUOTES) ?></td>
				<td><?php echo Nette\Templating\Helpers::escapeHtml($news->users->username, ENT_NOQUOTES) ?></td>
				<td><a href="<?php echo htmlSpecialChars($_control->link("News:editNews", array($news->id))) ?>
"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</a> | <a class="ajax" href="<?php echo htmlSpecialChars($_control->link("deleteNews!", array($news->id))) ?>
"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</a></td>
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
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 