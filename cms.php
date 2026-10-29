<?php
variables([
	VARLinkToSectionHome => true,
	//VARLinkToNodeHome => true,
	VARLinkToSubnodeHome => true,
	VARDontOverwriteLogo => true,

	VAREmail => 'moonwalk@amadeusweb.in',
	VARAddress => 'Trichy, India',
	VARAddressUrl => '#maps',
	VARPhone => $ph = '++916380427526',
	VARWhatsapp => whatsapp_clean($ph),

	socialBuilder::variableName => socialBuilder::create()
		->addInstagram($handle = 'moonwalk-in', $handle)
		->addYoutube($handle, $handle)
		->addLinkedIn('company/' . $handle . '/', $handle)
		->getItems(),
	replacer::siteReplaces => [
		'CommonLongTail' => site::$current->siteName . ', tuitions, 12th exams, board exams, student preparation',
	],

	VARUPI => [
		'site' => ['id' => 'advaithbhuvana@okhdfc', 'name' => 'Bhuvana Seshan'],
	],
]);

if (nodeIs(SITEHOME))
	setHtmlVariable(VARWelcomeMessage, getSnippet('welcome'));

function site_before_render() {
	autosetPageMenu();
}

function enrichThemeVars($vars, $what, themePart | null $part) {
	if ($what == 'header') {
		$part->setValue(themePart::aboveContent, renderSET::create()->echo()->noParas()
			->render(SITEPATH . '/data/snippets/side-panel.html'));
	}

	return $part ? $part->settings : $vars;
}
function before_network_menu() {
	echo '	<li class="menu-item sub-menu">
		<div id="side-panel-trigger" class="side-panel-trigger"><a href="#" class="bg-info dark p-1"><i class="bi-three-dots"></i></a></div>
	</li>';
}
