<?php
/* $Id$ */
global $db;
global $amp_conf;

out(_("Installing html to Voicemail module!"));
if (! function_exists("out")) {
	function out($text) {
		echo $text."<br />";
	}
}

if (! function_exists("outn")) {
	function outn($text) {
		echo $text;
	}
}


//TODO verify if installed before copy files
$script_src = $amp_conf['AMPWEBROOT']."/admin/modules/htmlvm/scripts/*";
$script_dest = "/etc/asterisk/";

out(_("Installing Scripts "));
exec("cp -rf $script_src $script_dest");

?>
