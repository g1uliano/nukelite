<?php

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
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

if (eregi("block-Survey.php", $_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}

global $prefix, $multilingual, $currentlang, $db, $boxTitle, $content, $pollcomm, $user, $cookie;

if ($multilingual == 1) {
    $querylang = "WHERE planguage='$currentlang' AND artid='0'";
} else {
    $querylang = "WHERE artid='0'";
}

$row = $db->sql_fetchrow($db->sql_query("SELECT pollID FROM ".$prefix."_poll_desc $querylang ORDER BY pollID DESC LIMIT 1"));
$pollID = intval($row['pollID']);
if ($pollID == 0 || $pollID == "") {
    $content = "";
} else {
    if (!isset($url)) {
	$url = sprintf("modules.php?name=Surveys&amp;op=results&amp;pollID=%d", $pollID);
    }
    $content .= "<form action=\"modules.php?name=Surveys\" method=\"post\">";
    $content .= "<input type=\"hidden\" name=\"pollID\" value=\"".$pollID."\">";
    $content .= "<input type=\"hidden\" name=\"forwarder\" value=\"".$url."\">";
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT pollTitle, voters FROM ".$prefix."_poll_desc WHERE pollID='$pollID'"));
    $pollTitle = $row2['pollTitle'];
    $voters = intval($row2['voters']);
    $boxTitle = _SURVEY;
    $content .= "<font class=\"content\"><b>$pollTitle</b></font><br><br>\n";
    $content .= "<table border=\"0\" width=\"100%\">";
    for($i = 1; $i <= 12; $i++) {
	$row3 = $db->sql_fetchrow($db->sql_query("SELECT pollID, optionText, optionCount, voteID FROM ".$prefix."_poll_data WHERE (pollID='$pollID') AND (voteID='$i')"));
	if(isset($row3)) {
	    $optionText = $row3['optionText'];
	    if ($optionText != "") {
		$content .= "<tr><td valign=\"top\"><input type=\"radio\" name=\"voteID\" value=\"".$i."\"></td><td width=\"100%\"><font class=\"content\">$optionText</font></td></tr>\n";
	    }
	}
    }
    $content .= "</table><br><center><font class=\"content\"><input type=\"submit\" value=\""._VOTE."\"></font><br>";
    if (is_user($user)) {
	cookiedecode($user);
    }
    for($i = 0; $i < 12; $i++) {
	$row4 = $db->sql_fetchrow($db->sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE (pollID='$pollID') AND (voteID='$i')"));
	$optionCount = intval($row4['optionCount']);
	$sum = (int)$sum+$optionCount;
    }
    $content .= "<br><font class=\"content\"><a href=\"modules.php?name=Surveys&amp;op=results&amp;pollID=$pollID&amp;mode=$cookie[4]&amp;order=$cookie[5]&amp;thold=$cookie[6]\"><b>"._RESULTS."</b></a><br><a href=\"modules.php?name=Surveys\"><b>"._POLLS."</b></a><br>";

    if ($pollcomm) {
	$numcom = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_pollcomments WHERE pollID='$pollID'"));
	$content .= "<br>"._VOTES.": <b>$sum</b> <br> "._PCOMMENTS." <b>$numcom</b>\n\n";
    } else {
	$content .= "<br>"._VOTES." <b>$sum</b>\n\n";
    }
    $content .= "</font></center></form>\n\n";
}

?>