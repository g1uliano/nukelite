<?php

# $Author: chatserv $
# $Date: 2004/12/07 22:20:10 $
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}
if (!stristr($_SERVER['SCRIPT_NAME'], "admin.php")) { die ("Access Denied"); }
global $prefix, $db;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {

/*********************************************************/
/* Configuration Functions to Setup all the Variables    */
/*********************************************************/

function Configure() {
    global $prefix, $db;
    include ("header.php");
    GraphicAdmin();
$row = $db->sql_fetchrow($db->sql_query("SELECT sitename, nukeurl, site_logo, slogan, startdate, adminmail, anonpost, Default_Theme, foot1, foot2, foot3, commentlimit, anonymous, minpass, pollcomm, articlecomm, broadcast_msg, my_headlines, top, storyhome, user_news, oldnum, ultramode, banners, backend_title, backend_language, language, locale, multilingual, useflags, notify, notify_email, notify_subject, notify_message, notify_from, moderate, admingraphic, httpref, httprefmax, CensorMode, CensorReplace from ".$prefix."_config"));
$sitename = $row['sitename'];
$nukeurl = $row['nukeurl'];
$site_logo = $row['site_logo'];
$slogan = $row['slogan'];
$startdate = $row['startdate'];
$adminmail = stripslashes($row['adminmail']);
$anonpost = $row['anonpost'];
$Default_Theme = $row['Default_Theme'];
$foot1 = $row['foot1'];
$foot2 = $row['foot2'];
$foot3 = $row['foot3'];
$commentlimit = intval($row['commentlimit']);
$anonymous = $row['anonymous'];
$minpass = intval($row['minpass']);
$pollcomm = intval($row['pollcomm']);
$articlecomm = intval($row['articlecomm']);
$broadcast_msg = intval($row['broadcast_msg']);
$my_headlines = intval($row['my_headlines']);
$top = intval($row['top']);
$storyhome = intval($row['storyhome']);
$user_news = intval($row['user_news']);
$oldnum = intval($row['oldnum']);
$ultramode = intval($row['ultramode']);
$banners = intval($row['banners']);
$backend_title = $row['backend_title'];
$backend_language = $row['backend_language'];
$language = $row['language'];
$locale = $row['locale'];
$multilingual = intval($row['multilingual']);
$useflags = intval($row['useflags']);
$notify = intval($row['notify']);
$notify_email = $row['notify_email'];
$notify_subject = $row['notify_subject'];
$notify_message = $row['notify_message'];
$notify_from = $row['notify_from'];
$moderate = intval($row['moderate']);
$admingraphic = intval($row['admingraphic']);
$httpref = intval($row['httpref']);
$httprefmax = intval($row['httprefmax']);
$CensorMode = intval($row['CensorMode']);
$CensorReplace = $row['CensorReplace'];
    OpenTable();
    echo "<center><font class='title'><b>" . _SITECONFIG . "</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<center><font class='option'><b>" . _GENSITEINFO . "</b></font></center>"
	."<form action='admin.php' method='post'>"
	."<table border='0'><tr><td>"
	."" . _SITENAME . ":</td><td><input type='text' name='xsitename' value='$sitename' size='40' maxlength='255'>"
	."</td></tr><tr><td>"
	."" . _SITEURL . ":</td><td><input type='text' name='xnukeurl' value='$nukeurl' size='40' maxlength='255'>"
	."</td></tr><tr><td>"
	."" . _SITELOGO . ":</td><td><input type='text' name='xsite_logo' value='$site_logo' size='20' maxlength='255'> <font class='tiny'>[ " . _MUSTBEINIMG . " ]</font>"
	."</td></tr><tr><td>"
	."" . _SITESLOGAN . ":</td><td><input type='text' name='xslogan' value='$slogan' size='40' maxlength='255'>"
	."</td></tr><tr><td>"
	."" . _STARTDATE . ":</td><td><input type='text' name='xstartdate' value='$startdate' size='20' maxlength='50'>"
	."</td></tr><tr><td>"
	."" . _ADMINEMAIL . ":</td><td><input type='text' name='xadminmail' value='$adminmail' size='30' maxlength='255'>"
	."</td></tr><tr><td>"
	."" . _ITEMSTOP . ":</td><td><select name='xtop'>"
	."<option name='xtop'>$top</option>"
	."<option name='xtop'>5</option>"
	."<option name='xtop'>10</option>"
        ."<option name='xtop'>15</option>"
        ."<option name='xtop'>20</option>"
        ."<option name='xtop'>25</option>"
        ."<option name='xtop'>30</option>"
        ."</select>"
        ."</td></tr><tr><td>"
        ."" . _STORIESHOME . ":</td><td><select name='xstoryhome'>"
        ."<option name='xstoryhome'>$storyhome</option>"
        ."<option name='xstoryhome'>5</option>"
        ."<option name='xstoryhome'>10</option>"
        ."<option name='xstoryhome'>15</option>"
        ."<option name='xstoryhome'>20</option>"
        ."<option name='xstoryhome'>25</option>"
        ."<option name='xstoryhome'>30</option>"
        ."</select>"
        ."</td></tr><tr><td>"
        ."" . _OLDSTORIES . ":</td><td><select name='xoldnum'>"
        ."<option name='xoldnum'>$oldnum</option>"
        ."<option name='xoldnum'>10</option>"
        ."<option name='xoldnum'>20</option>"
        ."<option name='xoldnum'>30</option>"
        ."<option name='xoldnum'>40</option>"
        ."<option name='xoldnum'>50</option>"
        ."</select>"
        ."</td></tr><tr><td>"
        ."" . _ACTULTRAMODE . "</td><td>";
    if ($ultramode==1) {
	echo "<input type='radio' name='xultramode' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xultramode' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xultramode' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xultramode' value='0' checked>" . _NO . "";
    }
    echo "</td></tr><tr><td>
    " . _ALLOWANONPOST . " </td><td>";
    if ($anonpost==1) {
	echo "<input type='radio' name='xanonpost' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xanonpost' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xanonpost' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xanonpost' value='0' checked>" . _NO . "";
    }
    echo "</td></tr><tr><td>"
	."" . _DEFAULTTHEME . ":</td><td><select name='xDefault_Theme'>";
    $handle=opendir('themes');
    while ($file = readdir($handle)) {
	if ( (!ereg("[.]",$file)) ) {
		$themelist .= "$file ";
	}
    }
    closedir($handle);
    $themelist = explode(" ", $themelist);
    sort($themelist);
    for ($i=0; $i < sizeof($themelist); $i++) {
	if($themelist[$i]!="") {
	    echo "<option name='xDefault_Theme' value='$themelist[$i]' ";
		if($themelist[$i]==$Default_Theme) echo "selected";
		echo ">$themelist[$i]\n";
	}
    }
    echo "</select>"
	."</td></tr><tr><td>"
	."" . _LOCALEFORMAT . ":</td><td><input type='text' name='xlocale' value='$locale' size='20' maxlength='40'>"
	."</td></tr></table>";
    CloseTable();
    echo "<br>";
    echo "<br><a name='banners'>";
    OpenTable();
    echo "<center><font class='option'><b>" . _BANNERSOPT . "</b></font></center>"
	."<table border='0'><tr><td>"
	."" . _ACTBANNERS . "</td><td>";
    if ($banners==1) {
	echo "<input type='radio' name='xbanners' value='1' checked>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xbanners' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xbanners' value='1'>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xbanners' value='0' checked>" . _NO . "";
    }
    echo "</td></tr></table>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<center><font class='option'><b>" . _FOOTERMSG . "</b></font></center>"
	."<table border='0'><tr><td>"
	."" . _FOOTERLINE1 . ":</td><td><textarea name='xfoot1' cols='50' rows='5'>" . stripslashes($foot1) . "</textarea>"
	."</td></tr><tr><td>"
	."" . _FOOTERLINE2 . ":</td><td><textarea name='xfoot2' cols='50' rows='5'>" . stripslashes($foot2) . "</textarea>"
	."</td></tr><tr><td>"
	."" . _FOOTERLINE3 . ":</td><td><textarea name='xfoot3' cols='50' rows='5'>" . stripslashes($foot3) . "</textarea>"
	."</td></tr></table>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<center><font class='option'><b>" . _GRAPHICOPT . "</b></font></center>"
	."<table border='0'><tr><td>"
	."" . _ADMINGRAPHIC . "</td><td>";
    if ($admingraphic==1) {
	echo "<input type='radio' name='xadmingraphic' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xadmingraphic' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xadmingraphic' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xadmingraphic' value='0' checked>" . _NO . "";
    }
    echo "</td></tr></table>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<input type='hidden' name='op' value='ConfigSave'>"
	."<center><input type='submit' value='" . _SAVECHANGES . "'></center>"
	."</form>";
    CloseTable();
    include ("footer.php");
}
//Variaveis Padrões - Bug Corrigido Dia 22/01/2005 por: Giuliano Cardoso.
$xbackend_language = "brazilian";
$xlanguage = "brazilian";
switch($op) {

    case "Configure":
    Configure();
    break;

    case "ConfigSave":
    global $prefix, $db;
    $xsitename = htmlentities($xsitename, ENT_QUOTES);
    $xslogan = htmlentities($xslogan, ENT_QUOTES);
    $xbackend_title = htmlentities($xbackend_title, ENT_QUOTES);
    $xnotify_subject = htmlentities($xnotify_subject, ENT_QUOTES);
    $xsingleaccountname = htmlentities($xsingleaccountname, ENT_QUOTES);
    $db->sql_query("UPDATE ".$prefix."_config SET sitename='$xsitename', nukeurl='$xnukeurl', site_logo='$xsite_logo', slogan='$xslogan', startdate='$xstartdate', adminmail='$xadminmail', anonpost='$xanonpost', Default_Theme='$xDefault_Theme', foot1='$xfoot1', foot2='$xfoot2', foot3='$xfoot3', commentlimit='$xcommentlimit', anonymous='$xanonymous', minpass='$xminpass', pollcomm='$xpollcomm', articlecomm='$xarticlecomm', broadcast_msg='$xbroadcast_msg', my_headlines='$xmy_headlines', top='$xtop', storyhome='$xstoryhome', user_news='$xuser_news', oldnum='$xoldnum', ultramode='$xultramode', banners='$xbanners', backend_title='$xbackend_title', backend_language='$xbackend_language', language='$xlanguage', locale='$xlocale', multilingual='$xmultilingual', useflags='$xuseflags', notify='$xnotify', notify_email='$xnotify_email', notify_subject='$xnotify_subject', notify_message='$xnotify_message', notify_from='$xnotify_from', moderate='$xmoderate', admingraphic='$xadmingraphic', httpref='$xhttpref', httprefmax='$xhttprefmax', CensorMode='$xCensorMode', CensorReplace='$xCensorReplace'");
    Header("Location: admin.php?op=Configure");
    break;

}

} else {
    echo "Access Denied";
}
# $Log: settings.php,v $
# Revision 1.3  2004/12/07 22:20:10  chatserv
# http://www.nukefixes.com/ftopicp-3479.html#3479
#
# Revision 1.2  2004/11/24 22:40:13  chatserv
# Version 2.7 Release
#
# Revision 1.1  2004/10/04 23:27:53  chatserv
# Initial CVS Addition
#

?>