<?php //netteCache[01]000391a:2:{s:4:"time";s:21:"0.32873100 1382117444";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:69:"C:\xampp\htdocs\ZURO\app\FrontModule\templates\Homepage\default.latte";i:2;i:1382117442;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\xampp\htdocs\ZURO\app\FrontModule\templates\Homepage\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'fullxdrj9b')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbeee7e029b1_content')) { function _lbeee7e029b1_content($_l, $_args) { extract($_args)
?>	<div class="container well">
		<div class="row">
			
			<div class="col-md-4">
				<h2>First Post</h2>
				<small>Added by: NiNu - 15/10/2013-13:00</small>
				<p>Bushwick mumblecore twee 8-bit, tote bag tattooed mlkshk Pitchfork. Shabby chic polaroid before they sold out hashtag trust fund Cosby sweater, XOXO High Life ugh put a bird on it biodiesel bicycle rights gastropub readymade mlkshk. Bitters gastropub Wes Anderson fanny pack banjo. Helvetica 8-bit single-origin coffee Banksy, fingerstache DIY freegan street art paleo pickled ethical Shoreditch. Selfies bitters beard, sriracha letterpress disrupt freegan church-key farm-to-table keffiyeh kitsch yr. Cred four loko VHS mlkshk, authentic vinyl post-ironic tote bag wayfarers bespoke. Leggings beard cornhole Austin, irony kogi dreamcatcher tattooed trust fund post-ironic pork belly.</p>
				<a href="#" class="btn btn-primary">Read More</a>
			</div>

			<div class="col-md-4">
				<h2>Second Post</h2>
				<small>Added by: NiNu - 15/10/2013-13:29</small>
				<p>Bushwick mumblecore twee 8-bit, tote bag tattooed mlkshk Pitchfork. Shabby chic polaroid before they sold out hashtag trust fund Cosby sweater, XOXO High Life ugh put a bird on it biodiesel bicycle rights gastropub readymade mlkshk. Bitters gastropub Wes Anderson fanny pack banjo. Helvetica 8-bit single-origin coffee Banksy, fingerstache DIY freegan street art paleo pickled ethical Shoreditch. Selfies bitters beard, sriracha letterpress disrupt freegan church-key farm-to-table keffiyeh kitsch yr. Cred four loko VHS mlkshk, authentic vinyl post-ironic tote bag wayfarers bespoke. Leggings beard cornhole Austin, irony kogi dreamcatcher tattooed trust fund post-ironic pork belly.</p>
				<a href="#" class="btn btn-primary">Read More</a>
			</div>

			<div class="col-md-4">
				<h2>Third Post</h2>
				<small>Added by: NiNu - 15/10/2013-14:00</small>
				<p>Bushwick mumblecore twee 8-bit, tote bag tattooed mlkshk Pitchfork. Shabby chic polaroid before they sold out hashtag trust fund Cosby sweater, XOXO High Life ugh put a bird on it biodiesel bicycle rights gastropub readymade mlkshk. Bitters gastropub Wes Anderson fanny pack banjo. Helvetica 8-bit single-origin coffee Banksy, fingerstache DIY freegan street art paleo pickled ethical Shoreditch. Selfies bitters beard, sriracha letterpress disrupt freegan church-key farm-to-table keffiyeh kitsch yr. Cred four loko VHS mlkshk, authentic vinyl post-ironic tote bag wayfarers bespoke. Leggings beard cornhole Austin, irony kogi dreamcatcher tattooed trust fund post-ironic pork belly.</p>
				<a href="#" class="btn btn-primary">Read More</a>
			</div>

		</div>	
	</div>

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
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>
<!-- ============End Content================== -->