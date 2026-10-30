<?php
if (!USEAI) {
	sectionId('special-md', 'container');
	renderSET::create()
		->setValue(VARUseContentBox, true)
		->heading(title(FORHEADING))
		->setValue(renderSET::notice, site::$current->description)
		->render(__DIR__ . '/recent.md');
	sectionEnd();
	return;
}

$body = explode('<!--body-separator-->', disk_file_get_contents(__DIR__ . '/_canvasai.html'))[1];
echo replacer::replace($body) . NEWLINES2 .
	'</div>' . NEWLINE .
	'		</section>' . NEWLINE
	;
