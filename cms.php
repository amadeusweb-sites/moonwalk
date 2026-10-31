<?php
variables([
	VARLinkToSectionHome => true,
	//VARLinkToNodeHome => true,
	VARLinkToSubnodeHome => true,
	VARDontOverwriteLogo => true,

	VAREmail => 'moonwalk@amadeusweb.in',
	VARAddress => 'Trichy, India',
	VARAddressUrl => '#maps',
	VARPhone => $ph = '+916380427526',
	VARWhatsapp => whatsapp_clean($ph),

	socialBuilder::variableName => socialBuilder::create()
		->addInstagram($handle = 'MoonWalkSM', $handle)
		->addFacebook($handle, $handle)
		->addHR()
		->addYoutube('@' . $handle, $handle)
		->addLinkedIn('company/' . $handle . '/', $handle)
		->getItems(),

	replacer::siteReplaces => [
		'book-button' => linkBuilder::factory('Book a Voice Audit', 'book', $popup = 'lightbox', false, 'button mw-btn'),
		'CommonLongTail' => site::$current->siteName . ', Communication Coach, Trainer, Public Speaking, Gain Confidence, '
			. 'Communication coaching for mid to senior professionals and aspiring public speakers',
	],

	VARUPI => [
		'site' => ['id' => 'advaithbhuvana@okhdfc', 'name' => 'Bhuvana Seshan'],
	],
]);

fileResolver::$echoRawHtml = startsWith(nodeValue(), '_');

DEFINE('SHOWAI', true);
DEFINE('USEAI', getQueryParameter('ai') != 'no');

if (nodeIs(SITEHOME) && USEAI) {
	variable(VARQueryPrefix . VARQueryContent, 1);
	setSubTheme('content-only-sans-wrapper');
	addStyle('moonwalk');
}

function site_before_render() {
	autosetPageMenu();
}

function enrichThemeVars($vars, $what, themePart | null $part) {
	if ($what == 'header') {
		$part->setValue(themePart::aboveContent, renderSET::create()->echo()->noParas()
			->render(SITEPATH . '/data/snippets/side-panel.html'));

		$part->append(themePart::headIncludes, getSnippet('always', BOOLNo, JSONFILE), JSONFILE);

		if ($json = relatedJsonFile(fileResolver::rootOrFile()))
			$part->append(themePart::headIncludes, $json, JSONFILE);

		$part->append(themePart::headIncludes, getSnippet('head'));

		if (nodeIs(SITEHOME))
			setHtmlVariable(VARWelcomeMessage, getSnippet('welcome')); //call after using always.json
	}

	return $part ? $part->settings : $vars;
}

function before_network_menu() {
	$start = '<li class="menu-item sub-menu"><a class="menu-link" href="'. getHtmlVariable('url');
	$end = '</div></a></li>';
	echo (SHOWAI ? $start .'_canvasai/?embed=1"><div>AI1' . $end . NEWLINE .
		$start .'?ai=1"><div>AI2' . $end . NEWLINE : '') .
		'	<li class="menu-item sub-menu">
		<div id="side-panel-trigger" class="side-panel-trigger"><a href="#" class="bg-info dark p-1"><i class="bi-three-dots"></i></a></div>
	</li>';
}
