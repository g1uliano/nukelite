<?php

# $Author: chatserv $
# $Date: 2004/12/09 23:01:06 $
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
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Downloads'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
        $auth_user = 1;	
    }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {

/*********************************************************/
/* Downloads Modified Web Downloads                      */
/*********************************************************/

function getparent($parentid,$title) {
    global $prefix, $db;
    $parentid = intval(trim($parentid));
    $row = $db->sql_fetchrow($db->sql_query("SELECT cid, title, parentid from " . $prefix . "_downloads_categories where cid='$parentid'"));
	$cid = intval($row['cid']);
	$ptitle = $row['title'];
	$pparentid = $row['parentid'];
    if ($ptitle=="$title") $title=$title; 
    elseif ($ptitle!="") $title=$ptitle."/".$title;
    if ($pparentid!=0) {
	$title=getparent($pparentid,$title);
    }
    return $title;
}

function downloads() {
    global $prefix, $db;
    include ("header.php");
    GraphicAdmin();
    OpenTable();
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/down-logo.gif")) {
	echo "<center><a href=\"modules.php?name=Downloads\"><img src=\"themes/$ThemeSel/images/down-logo.gif\" border=\"0\" alt=\"\"></a><br><br>";
    } else {
	echo "<center><a href=\"modules.php?name=Downloads\"><img src=\"modules/Downloads/images/down-logo.gif\" border=\"0\" alt=\"\"></a><br><br>";
    }
    $result = $db->sql_query("SELECT * from " . $prefix . "_downloads_downloads");
    $numrows = $db->sql_numrows($result);
    echo "<font class=\"content\">" . _THEREARE . " <b>$numrows</b> " . _DOWNLOADSINDB . "</font></center>";
    CloseTable();
    echo "<br>";
    
/* Temporarily 'homeless' downloads functions (to be revised in admin.php breakup) */
    $result2 = $db->sql_query("SELECT * from " . $prefix . "_downloads_modrequest where brokendownload='1'");
    $totalbrokendownloads = $db->sql_numrows($result2);
    $result3 = $db->sql_query("SELECT * from " . $prefix . "_downloads_modrequest where brokendownload='0'");
    $totalmodrequests = $db->sql_numrows($result3);

/* List Downloads waiting for validation */
    $result4 = $db->sql_query("SELECT lid, cid, sid, title, url, description, name, email, submitter, filesize, version, homepage from " . $prefix . "_downloads_newdownload order by lid");
    $numrows = $db->sql_numrows($result4);
    if ($numrows>0) {
	OpenTable();
	echo "<center><font class=\"content\"><b>" . _DOWNLOADSWAITINGVAL . "</b></font></center><br><br>";
	while($row4 = $db->sql_fetchrow($result4)) {
	    $lid = intval($row4['lid']);
	    $cid = intval($row4['cid']);
	    $sid = intval($row4['sid']);
	    $title = $row4['title'];
	    $url = $row4['url'];
	    $description = stripslashes($row4['description']);
	    $name = trim($row4['name']);
	    $email = $row4['email'];
	    $submitter = $row4['submitter'];
	    $filesize = $row4['filesize'];
	    $version = $row4['version'];
	    $homepage = $row4['homepage'];
	    if ($submitter == "") {
		$submitter = _NONE;
	    }
    	    $homepage = ereg_replace("http://","",$homepage);
	    echo "<form action=\"admin.php\" method=\"post\">"
		."<b>" . _DOWNLOADID . ": $lid</b><br><br>"
		."" . _SUBMITTER . ": <b>$submitter</b><br>"
		."" . _DOWNLOADNAME . ": <input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\"><br>"
		."" . _FILEURL . ": <input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\">&nbsp;[ <a target=\"_blank\" href=\"$url\">" . _CHECK . "</a> ]<br>"
		."" . _DESCRIPTION . ": <br><textarea name=\"description\" cols=\"60\" rows=\"10\">$description</textarea><br>"
		."" . _AUTHORNAME . ": <input type=\"text\" name=\"name\" size=\"20\" maxlength=\"100\" value=\"$name\">&nbsp;&nbsp;"
		."" . _AUTHOREMAIL . ": <input type=\"text\" name=\"email\" size=\"20\" maxlength=\"100\" value=\"$email\"><br>"
		."" . _FILESIZE . ": <input type=\"text\" name=\"filesize\" size=\"12\" maxlength=\"11\" value=\"$filesize\"><br>"
		."" . _VERSION . ": <input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\" value=\"$version\"><br>"
		."" . _HOMEPAGE . ": <input type=\"text\" name=\"homepage\" size=\"30\" maxlength=\"200\" value=\"http://$homepage\"> [ <a href=\"http://$homepage\">" . _VISIT . "</a> ]<br>";
	    echo "<input type=\"hidden\" name=\"new\" value=\"1\">";
	    echo "<input type=\"hidden\" name=\"hits\" value=\"0\">";
	    echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
	    echo "<input type=\"hidden\" name=\"submitter\" value=\"$submitter\">";
	    echo "" . _CATEGORY . ": <select name=\"cat\">";
    $result5 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_downloads_categories order by title");
    while ($row5 = $db->sql_fetchrow($result5)) {
	$cid2 = intval($row5['cid']);
	$ctitle2 = $row5['title'];
	$parentid2 = $row5['parentid'];
		if ($cid2==$cid) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
	    echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
	}

	    echo "<input type=\"hidden\" name=\"submitter\" value=\"$submitter\">";
	    echo "</select><input type=\"hidden\" name=\"op\" value=\"DownloadsAddDownload\"><input type=\"submit\" value=" . _ADD . "> [ <a href=\"admin.php?op=DownloadsDelNew&amp;lid=$lid\">" . _DELETE . "</a> ]</form><br><hr noshade><br>";
	}
	CloseTable();
	echo "<br>";
    } else {
    }

/* Add a New Main Category */

    OpenTable();
    echo "<center><font class=\"content\">[ <a href=\"admin.php?op=DownloadsCleanVotes\">" . _CLEANDOWNLOADSDB . "</a> | "
	."<a href=\"admin.php?op=DownloadsListBrokenDownloads\">" . _BROKENDOWNLOADSREP . " ($totalbrokendownloads)</a> | "
	."<a href=\"admin.php?op=DownloadsListModRequests\">" . _DOWNLOADMODREQUEST . " ($totalmodrequests)</a> | "
	."<a href=\"admin.php?op=DownloadsDownloadCheck\">" . _VALIDATEDOWNLOADS . "</a> ]</font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<form method=\"post\" action=\"admin.php\">"
	."<font class=\"content\"><b>" . _ADDMAINCATEGORY . "</b><br><br>"
	."" . _NAME . ": <input type=\"text\" name=\"title\" size=\"30\" maxlength=\"100\"><br>"
	."" . _DESCRIPTION . ":<br><textarea name=\"cdescription\" cols=\"60\" rows=\"10\"></textarea><br>"
	."<input type=\"hidden\" name=\"op\" value=\"DownloadsAddCat\">"
	."<input type=\"submit\" value=\"" . _ADD . "\"><br>"
	."</form>";
    CloseTable();
    echo "<br>";

// Add a New Sub-Category
    $result6 = $db->sql_query("SELECT * from " . $prefix . "_downloads_categories");
    $numrows = $db->sql_numrows($result6);
    if ($numrows>0) {
	OpenTable();
	echo "<form method=\"post\" action=\"admin.php\">"
	    ."<font class=\"content\"><b>" . _ADDSUBCATEGORY . "</b></font><br><br>"
	    ."" . _NAME . ": <input type=\"text\" name=\"title\" size=\"30\" maxlength=\"100\">&nbsp;" . _IN . "&nbsp;";
        $result7 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_downloads_categories order by parentid,title");
	echo "<select name=\"cid\">";
	while($row7 = $db->sql_fetchrow($result7)) {
	    $cid2 = intval($row7['cid']);
	    $ctitle2 = $row7['title'];
	    $parentid2 = intval($row7['parentid']);
		if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
	    echo "<option value=\"$cid2\">$ctitle2</option>";
	}
	echo "</select><br>"
	    ."" . _DESCRIPTION . ":<br><textarea name=\"cdescription\" cols=\"60\" rows=\"10\"></textarea><br>"
	    ."<input type=\"hidden\" name=\"op\" value=\"DownloadsAddSubCat\">"
	    ."<input type=\"submit\" value=\"" . _ADD . "\"><br>"
	    ."</form>";
	CloseTable();
	echo "<br>";
    } else {
    }

// Add a New Download to Database
    $result8 = $db->sql_query("SELECT cid, title from " . $prefix . "_downloads_categories");
    $numrows = $db->sql_numrows($result8);
    if ($numrows>0) {
	OpenTable();
	echo "<form method=\"post\" action=\"admin.php\">"
	    ."<font class=\"content\"><b>" . _ADDNEWDOWNLOAD . "</b><br><br>"
	    ."" . _DOWNLOADNAME . ": <input type=\"text\" name=\"title\" size=\"50\" maxlength=\"100\"><br>"
	    ."" . _FILEURL . ": <input type=\"text\" name=\"url\" size=\"50\" maxlength=\"100\" value=\"http://\"><br>";
        $result9 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_downloads_categories order by title");
	echo "" . _CATEGORY . ": <select name=\"cat\">";
	while($row9 = $db->sql_fetchrow($result9)) {
	    $cid2 = intval($row9['cid']);
	    $ctitle2 = $row9['title'];
	    $parentid2 = intval($row9['parentid']);
	    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
	    echo "<option value=\"$cid2\">$ctitle2</option>";
	}
	echo "</select><br><br><br>"
	    ."" . _DESCRIPTION255 . "<br><textarea name=\"description\" cols=\"60\" rows=\"5\"></textarea><br><br><br>"
	    ."" . _AUTHORNAME . ": <input type=\"text\" name=\"name\" size=\"30\" maxlength=\"60\"><br><br>"
	    ."" . _AUTHOREMAIL . ": <input type=\"text\" name=\"email\" size=\"30\" maxlength=\"60\"><br><br>"
	    ."" . _FILESIZE . ": <input type=\"text\" name=\"filesize\" size=\"12\" maxlength=\"11\"> (" . _INBYTES . ")<br><br>"
	    ."" . _VERSION . ": <input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\"><br><br>"
	    ."" . _HOMEPAGE . ": <input type=\"text\" name=\"homepage\" size=\"30\" maxlength=\"200\" value=\"http://\"><br><br>"
	    ."" . _HITS . ": <input type=\"text\" name=\"hits\" size=\"12\" maxlength=\"11\"><br><br>"
	    ."<input type=\"hidden\" name=\"op\" value=\"DownloadsAddDownload\">"
    	    ."<input type=\"hidden\" name=\"new\" value=\"0\">"
	    ."<input type=\"hidden\" name=\"lid\" value=\"0\">"
	    ."<center><input type=\"submit\" value=\"" . _ADDURL . "\"><br>"
	    ."</form>";
	CloseTable();
	echo "<br>";
    } else {
    }

// Modify Category
    $result10 = $db->sql_query("SELECT * from " . $prefix . "_downloads_categories");
    $numrows = $db->sql_numrows($result10);
    if ($numrows>0) {
	OpenTable();
	echo "<form method=\"post\" action=\"admin.php\">"
	    ."<font class=\"content\"><b>" . _MODCATEGORY . "</b></font><br><br>";
	$result11 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_downloads_categories order by title");
	echo "" . _CATEGORY . ": <select name=\"cat\">";
	while($row11 = $db->sql_fetchrow($result11)) {
	    $cid2 = intval($row11['cid']);
	    $ctitle2 = $row11['title'];
	    $parentid2 = intval($row11['parentid']);
	    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
	    echo "<option value=\"$cid2\">$ctitle2</option>";
	}
	echo "</select>"
	    ."<input type=\"hidden\" name=\"op\" value=\"DownloadsModCat\">"
	    ."<input type=\"submit\" value=\"" . _MODIFY . "\">"
	    ."</form>";
	CloseTable();
	echo "<br>";
    } else {
    }

// Modify Downloads
    $result12 = $db->sql_query("SELECT * from " . $prefix . "_downloads_downloads");
    $numrows = $db->sql_numrows($result12);
    if ($numrows>0) {
    OpenTable();
    echo "<form method=\"post\" action=\"admin.php\">"
	."<font class=\"content\"><b>" . _MODDOWNLOAD . "</b><br><br>"
	."" . _DOWNLOADID . ": <input type=\"text\" name=\"lid\" size=\"12\" maxlength=\"11\">&nbsp;&nbsp;"
	."<input type=\"hidden\" name=\"op\" value=\"DownloadsModDownload\">"
	."<input type=\"submit\" value=\"" . _MODIFY . "\">"
	."</form>";
    CloseTable();
    echo "<br>";
    } else {
    }

// Transfer Categories
    $result13 = $db->sql_query("SELECT * from " . $prefix . "_downloads_downloads");
    $numrows = $db->sql_numrows($result13);
    if ($numrows>0) {
    OpenTable();
	echo "<form method=\"post\" action=\"admin.php\">"
	    ."<font class=\"option\"><b>" . _EZTRANSFERDOWNLOADS . "</b></font><br><br>"
	    ."" . _CATEGORY . ": "
	    ."<select name=\"cidfrom\">";
	$result14 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_downloads_categories order by parentid,title");
	while($row14 = $db->sql_fetchrow($result14)) {
	    $cid2 = intval($row14['cid']);
	    $ctitle2 = $row14['title'];
	    $parentid2 = intval($row14['parentid']);
		if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
	    echo "<option value=\"$cid2\">$ctitle2</option>";
	}
	echo "</select><br>"
	    ."" . _IN . "&nbsp;" . _CATEGORY . ": ";
	$result15 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_downloads_categories order by parentid,title");
	echo "<select name=\"cidto\">";
	while($row15 = $db->sql_fetchrow($result15)) {
	    $cid2 = intval($row15['cid']);
	    $ctitle2 = $row15['title'];
	    $parentid2 = intval($row15['parentid']);
		if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
	    echo "<option value=\"$cid2\">$ctitle2</option>";
	}
	echo "</select><br>"
	    ."<input type=\"hidden\" name=\"op\" value=\"DownloadsTransfer\">"
	    ."<input type=\"submit\" value=\"" . _EZTRANSFER . "\"><br>"
	    ."</form>";
    CloseTable();
    echo "<br>";
    } else {
    }

    include ("footer.php");
}

function DownloadsTransfer($cidfrom,$cidto) {
    global $prefix, $db;
    $cidfrom = intval($cidfrom);
    $db->sql_query("update " . $prefix . "_downloads_downloads set cid='$cidto' where cid='$cidfrom'");
    Header("Location: admin.php?op=downloads");
}

function DownloadsModDownload($lid) {
    global $prefix, $db, $sitename;
    include ("header.php");
    GraphicAdmin();
    global $anonymous;
    $lid = intval($lid);
    $result = $db->sql_query("SELECT cid, sid, title, url, description, name, email, hits, filesize, version, homepage from " . $prefix . "_downloads_downloads where lid='$lid'");
    OpenTable();
    echo "<center><font class=\"title\"><b>" . _WEBDOWNLOADSADMIN . "</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<center><font class=\"content\"><b>" . _MODDOWNLOAD . "</b></font></center><br><br>";
	while($row = $db->sql_fetchrow($result)) {
	    $cid = intval($row['cid']);
	    $sid = intval($row['sid']);
	    $title = $row['title'];
	    $url = $row['url'];
	    $description = stripslashes($row['description']);
	    $name = $row['name'];
	    $email = $row['email'];
	    $hits = intval($row['hits']);
	    $filesize = $row['filesize'];
	    $version = $row['version'];
	    $homepage = $row['homepage'];
    	echo "<form action=admin.php method=post>"
	    ."" . _DOWNLOADID . ": <b>$lid</b><br>"
	    ."" . _PAGETITLE . ": <input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\"><br>"
	    ."" . _PAGEURL . ": <input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\">&nbsp;[ <a href=\"$url\">" . _CHECK . "</a> ]<br>"
	    ."" . _DESCRIPTION . ":<br><textarea name=\"description\" cols=\"60\" rows=\"10\">$description</textarea><br>"
	    ."" . _AUTHORNAME . ": <input type=\"text\" name=\"name\" size=\"50\" maxlength=\"100\" value=\"$name\"><br>"
	    ."" . _AUTHOREMAIL . ": <input type=\"text\" name=\"email\" size=\"50\" maxlength=\"100\" value=\"$email\"><br>"
	    ."" . _FILESIZE . ": <input type=\"text\" name=\"filesize\" size=\"12\" maxlength=\"11\" value=\"$filesize\"><br>"
	    ."" . _VERSION . ": <input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\" value=\"$version\"><br>"
	    ."" . _HOMEPAGE . ": <input type=\"text\" name=\"homepage\" size=\"50\" maxlength=\"200\" value=\"$homepage\">&nbsp;[ <a href=\"$homepage\">" . _VISIT . "</a> ]<br>"
	    ."" . _HITS . ": <input type=\"text\" name=\"hits\" value=\"$hits\" size=\"12\" maxlength=\"11\"><br>";
	$result2 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_downloads_categories order by title");
	echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">"
	    ."" . _CATEGORY . ": <select name=\"cat\">";
	while($row2 = $db->sql_fetchrow($result2)) {
	    $cid2 = intval($row2['cid']);
	    $ctitle2 = $row2['title'];
	    $parentid2 = intval($row2['parentid']);
		if ($cid2==$cid) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
	    echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
	}

    echo "</select>"
	."<input type=\"hidden\" name=\"op\" value=\"DownloadsModDownloadS\">"
	."<input type=\"submit\" value=\"" . _MODIFY . "\"> [ <a href=\"admin.php?op=DownloadsDelDownload&amp;lid=$lid\">" . _DELETE . "</a> ]</form><br>";
    CloseTable();
    echo "<br>";
    /* Modify or Add Editorial */
        $lid = intval($lid);
	$resulted2 = $db->sql_query("SELECT adminid, editorialtimestamp, editorialtext, editorialtitle from " . $prefix . "_downloads_editorials where downloadid='$lid'");
        $recordexist = $db->sql_numrows($resulted2);
	OpenTable();
    /* if returns 'bad query' status 0 (add editorial) */
    	if ($recordexist == 0) {
    	    echo "<center><font class=\"content\"><b>" . _ADDEDITORIAL . "</b></font></center><br><br>"
    		."<form action=\"admin.php\" method=\"post\">"
    		."<input type=\"hidden\" name=\"downloadid\" value=\"$lid\">"
    		."" . _EDITORIALTITLE . ":<br><input type=\"text\" name=\"editorialtitle\" value=\"$editorialtitle\" size=\"50\" maxlength=\"100\"><br>"
    		."" . _EDITORIALTEXT . ":<br><textarea name=\"editorialtext\" cols=\"60\" rows=\"10\">$editorialtext</textarea><br>"
        	."</select><input type=\"hidden\" name=\"op\" value=\"DownloadsAddEditorial\"><input type=\"submit\" value=\"Add\">";
        } else {
    /* if returns 'cool' then status 1 (modify editorial) */
    		while($row3 = $db->sql_fetchrow($resulted2)) {
    		$adminid = intval($row3['adminid']);
    		$editorialtimestamp = $row3['editorialtimestamp'];
    		$editorialtext = stripslashes($row3['editorialtext']);
    		$editorialtitle = stripslashes($row3['editorialtitle']);
    		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $editorialtimestamp, $editorialtime);
		$editorialtime = strftime("%F",mktime($editorialtime[4],$editorialtime[5],$editorialtime[6],$editorialtime[2],$editorialtime[3],$editorialtime[1]));
		$date_array = explode("-", $editorialtime); 
		$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]); 
       		$formatted_date = date("F j, Y", $timestamp);         	
        	echo "<center><font class=\"content\"><b>Modify Editorial</b></font></center><br><br>"
        	    ."<form action=\"admin.php\" method=\"post\">"
        	    ."" . _AUTHOR . ": $adminid<br>"
        	    ."" . _DATEWRITTEN . ": $formatted_date<br><br>"
        	    ."<input type=\"hidden\" name=\"downloadid\" value=\"$lid\">"
        	    ."" . _EDITORIALTITLE . ":<br><input type=\"text\" name=\"editorialtitle\" value=\"$editorialtitle\" size=\"50\" maxlength=\"100\"><br>"
        	    ."" . _EDITORIALTEXT . ":<br><textarea name=\"editorialtext\" cols=\"60\" rows=\"10\">$editorialtext</textarea><br>"
            	    ."</select><input type=\"hidden\" name=\"op\" value=\"DownloadsModEditorial\"><input type=\"submit\" value=\"" . _MODIFY . "\"> [ <a href=\"admin.php?op=DownloadsDelEditorial&amp;downloadid=$lid\">" . _DELETE . "</a> ]";
                }
    	} 
    CloseTable();
    echo "<br>";
    OpenTable();
    /* Show Comments */
    $result4 = $db->sql_query("SELECT ratingdbid, ratinguser, ratingcomments, ratingtimestamp FROM " . $prefix . "_downloads_votedata WHERE ratinglid='$lid' AND ratingcomments != '' ORDER BY ratingtimestamp DESC");
    $totalcomments = $db->sql_numrows($result4);
    echo "<table valign=top width=100%>";
    echo "<tr><td colspan=7><b>Download Comments (total comments: $totalcomments)</b><br><br></td></tr>";
    echo "<tr><td width=20 colspan=1><b>User  </b></td><td colspan=5><b>Comment  </b></td><td><b><center>Delete</center></b></td><br></tr>";
    if ($totalcomments == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Comments<br></font></center></td></tr>";
    $x=0;
    $colorswitch="dddddd";
    while($row4 = $db->sql_fetchrow($result4)) {
	$ratingdbid = intval($row4['ratingdbid']);
	$ratinguser = $row4['ratinguser'];
	$ratingcomments = stripslashes($row4['ratingcomments']);
	$ratingtimestamp = $row4['ratingtimestamp'];
        ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $ratingtimestamp, $ratingtime);
    	$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
    	$date_array = explode("-", $ratingtime); 
    	$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]); 
            $formatted_date = date("F j, Y", $timestamp);
            echo "<tr><td valign=top bgcolor=$colorswitch>$ratinguser</td><td valign=top colspan=5 bgcolor=$colorswitch>$ratingcomments</td><td bgcolor=$colorswitch><center><b><a href=admin.php?op=DownloadsDelComment&lid=$lid&rid=$ratingdbid>X</a></b></center></td><br></tr>";
    	$x++;
    	if ($colorswitch=="dddddd") $colorswitch="ffffff";
                    else $colorswitch="dddddd";
        }

    // Show Registered Users Votes
    $result5 = $db->sql_query("SELECT ratingdbid, ratinguser, rating, ratinghostname, ratingtimestamp FROM " . $prefix . "_downloads_votedata WHERE ratinglid='$lid' AND ratinguser != 'outside' AND ratinguser != '$anonymous' ORDER BY ratingtimestamp DESC");
    $totalvotes = $db->sql_numrows($result5);
    echo "<tr><td colspan=7><br><br><b>Registered User Votes (total votes: $totalvotes)</b><br><br></td></tr>";
    echo "<tr><td><b>User  </b></td><td><b>IP Address  </b></td><td><b>Rating  </b></td><td><b>User AVG Rating  </b></td><td><b>Total Ratings  </b></td><td><b>Date  </b></td></font></b><td><b><center>Delete</center></b></td><br></tr>";
    if ($totalvotes == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Registered User Votes<br></font></center></td></tr>";
    $x=0;
    $colorswitch="dddddd";
    while($row5 = $db->sql_fetchrow($result5)) {
	$ratingdbid = intval($row5['ratingdbid']);
	$ratinguser = $row5['ratinguser'];
	$rating = intval($row5['rating']);
	$ratinghostname = $row5['ratinghostname'];
	$ratingtimestamp = $row5['ratingtimestamp'];
        ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $ratingtimestamp, $ratingtime);
    	$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
            $date_array = explode("-", $ratingtime);
            $timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]);
            $formatted_date = date("F j, Y", $timestamp);

    	//Individual user information
    	$result6 = $db->sql_query("SELECT rating FROM " . $prefix . "_downloads_votedata WHERE ratinguser = '$ratinguser'");
            $usertotalcomments = $db->sql_numrows($result6);
            $useravgrating = 0;
            while($row6 = $db->sql_fetchrow($result6))	$useravgrating = $useravgrating + $rating2;
	    $rating2 = intval($row6['rating']);
            $useravgrating = $useravgrating / $usertotalcomments;
            $useravgrating = number_format($useravgrating, 1);
            echo "<tr><td bgcolor=$colorswitch>$ratinguser</td><td bgcolor=$colorswitch>$ratinghostname</td><td bgcolor=$colorswitch>$rating</td><td bgcolor=$colorswitch>$useravgrating</td><td bgcolor=$colorswitch>$usertotalcomments</td><td bgcolor=$colorswitch>$formatted_date  </font></b></td><td bgcolor=$colorswitch><center><b><a href=admin.php?op=DownloadsDelVote&lid=$lid&rid=$ratingdbid>X</a></b></center></td></tr><br>";
    	$x++;
    	if ($colorswitch=="dddddd") $colorswitch="ffffff";
                    else $colorswitch="dddddd";
        }

    // Show Unregistered Users Votes
    $lid = intval($lid);
    $result7 = $db->sql_query("SELECT ratingdbid, rating, ratinghostname, ratingtimestamp FROM " . $prefix . "_downloads_votedata WHERE ratinglid='$lid' AND ratinguser = '$anonymous' ORDER BY ratingtimestamp DESC");
    $totalvotes = $db->sql_numrows($result7);
    echo "<tr><td colspan=7><b><br><br>Unregistered User Votes (total votes: $totalvotes)</b><br><br></td></tr>";
    echo "<tr><td colspan=2><b>IP Address  </b></td><td colspan=3><b>Rating  </b></td><td><b>Date  </b></font></td><td><b><center>Delete</center></b></td><br></tr>";
    if ($totalvotes == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Unregistered User Votes<br></font></center></td></tr>";
    $x=0;
    $colorswitch="dddddd";
    while($row7 = $db->sql_fetchrow($result7)) {
	$ratingdbid = intval($row7['ratingdbid']);
	$rating = intval($row7['rating']);
	$ratinghostname = $row7['ratinghostname'];
	$ratingtimestamp = $row7['ratingtimestamp'];
        ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $ratingtimestamp, $ratingtime);
    	$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
    	$date_array = explode("-", $ratingtime); 
    	$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]); 
        $formatted_date = date("F j, Y", $timestamp);
        echo "<td colspan=2 bgcolor=$colorswitch>$ratinghostname</td><td colspan=3 bgcolor=$colorswitch>$rating</td><td bgcolor=$colorswitch>$formatted_date  </font></b></td><td bgcolor=$colorswitch><center><b><a href=admin.php?op=DownloadsDelVote&lid=$lid&rid=$ratingdbid>X</a></b></center></td></tr><br>";
    	$x++;
    	if ($colorswitch=="dddddd") $colorswitch="ffffff";
                    else $colorswitch="dddddd";
        }

    // Show Outside Users Votes
    $result8 = $db->sql_query("SELECT ratingdbid, rating, ratinghostname, ratingtimestamp FROM " . $prefix . "_downloads_votedata WHERE ratinglid='$lid' AND ratinguser = 'outside' ORDER BY ratingtimestamp DESC");
    $totalvotes = $db->sql_numrows($result8);
    echo "<tr><td colspan=7><b><br><br>Outside User Votes (total votes: $totalvotes)</b><br><br></td></tr>";
    echo "<tr><td colspan=2><b>IP Address  </b></td><td colspan=3><b>Rating  </b></td><td><b>Date  </b></td></font></b><td><b><center>Delete</center></b></td><br></tr>";
    if ($totalvotes == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Votes from Outside $sitename<br></font></center></td></tr>";
    $x=0;
    $colorswitch="dddddd";
    while($row8 = $db->sql_fetchrow($result8)) {
	$ratingdbid = intval($row8['ratingdbid']);
	$rating = intval($row8['rating']);
	$ratinghostname = $row8['ratinghostname'];
	$ratingtimestamp = $row8['ratingtimestamp'];
        ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $ratingtimestamp, $ratingtime);
    	$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
            $date_array = explode("-", $ratingtime);
            $timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]);
        $formatted_date = date("F j, Y", $timestamp);
        echo "<tr><td colspan=2 bgcolor=$colorswitch>$ratinghostname</td><td colspan=3 bgcolor=$colorswitch>$rating</td><td bgcolor=$colorswitch>$formatted_date  </font></b></td><td bgcolor=$colorswitch><center><b><a href=admin.php?op=DownloadsDelVote&lid=$lid&rid=$ratingdbid>X</a></b></center></td></tr><br>";
    	$x++;
    	if ($colorswitch=="dddddd") $colorswitch="ffffff";
    		else $colorswitch="dddddd";
        }

    echo "<tr><td colspan=6><br></td></tr>";
    echo "</table>";
    }
    echo "</form>";
    CloseTable();
    echo "<br>";
    include ("footer.php");
}

function DownloadsDelComment($lid, $rid) {
    global $prefix, $db;
    $lid = intval($lid);
    $rid = intval($rid);
    $db->sql_query("UPDATE " . $prefix . "_downloads_votedata SET ratingcomments='' WHERE ratingdbid='$rid'");
    $db->sql_query("UPDATE " . $prefix . "_downloads_downloads SET totalcomments = (totalcomments - 1) WHERE lid='$lid'");
    Header("Location: admin.php?op=DownloadsModDownload&lid=$lid");
    
}

function DownloadsDelVote($lid, $rid) {
    global $prefix, $db;
    $lid = intval($lid);
    $rid = intval($rid);
    $db->sql_query("delete from " . $prefix . "_downloads_votedata where ratingdbid='$rid'");
    $voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM " . $prefix . "_downloads_votedata WHERE ratinglid='$lid'");
    $totalvotesDB = $db->sql_numrows($voteresult);
    include ("voteinclude.php");
    $db->sql_query("UPDATE " . $prefix . "_downloads_downloads SET downloadratingsummary='$finalrating',totalvotes='$totalvotesDB',totalcomments='$truecomments' WHERE lid='$lid'");
    Header("Location: admin.php?op=DownloadsModDownload&lid=$lid");
}

function DownloadsListBrokenDownloads() {
    global $bgcolor1, $bgcolor2, $prefix, $db, $user_prefix;
    include ("header.php");
    GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>" . _WEBDOWNLOADSADMIN . "</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    $result = $db->sql_query("SELECT requestid, lid, modifysubmitter from " . $prefix . "_downloads_modrequest where brokendownload='1' order by requestid");
    $totalbrokendownloads = $db->sql_numrows($result);
    echo "<center><font class=\"content\"><b>" . _DUSERREPBROKEN . " ($totalbrokendownloads)</b></font></center><br><br><center>"
	."" . _DIGNOREINFO . "<br>"
	."" . _DDELETEINFO . "</center><br><br><br>"
	."<table align=\"center\" width=\"450\">";
    if ($totalbrokendownloads==0) {
	echo "<center><font class=\"content\">" . _DNOREPORTEDBROKEN . "</font></center><br><br><br>";
    } else {
        $colorswitch = $bgcolor2;
        echo "<tr>"
            ."<td><b>" . _DOWNLOAD . "</b></td>"
            ."<td><b>" . _SUBMITTER . "</b></td>"
            ."<td><b>" . _DOWNLOADOWNER . "</b></td>"
            ."<td><b>" . _IGNORE . "</b></td>"
            ."<td><b>" . _DELETE . "</b></td>"
            ."<td><b>" . _EDIT . "</b></td>"
    	    ."</tr>";
	while($row = $db->sql_fetchrow($result)) {
	    $requestid = intval($row['requestid']);
	    $lid = intval($row['lid']);
	    $modifysubmitter = $row['modifysubmitter'];
	    $result2 = $db->sql_query("SELECT title, url, submitter from " . $prefix . "_downloads_downloads where lid='$lid'");
	    if ($modifysubmitter != '$anonymous') {
		$row3 = $db->sql_fetchrow($db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$modifysubmitter'"));
		$email = stripslashes($row3['user_email']);
	    }
	$row2 = $db->sql_fetchrow($result2);
            $title = stripslashes($row2['title']);
            $url = $row2['url'];
            $owner = $row2['submitter'];
    	    $row4 = $db->sql_fetchrow($db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$owner'"));
            $owneremail = stripslashes($row4['user_email']);
    	    echo "<tr>"
    		."<td bgcolor=\"$colorswitch\"><a href=\"$url\">$title</a>"
    		."</td>";
    	    if ($email=='') {
		echo "<td bgcolor=\"$colorswitch\">$modifysubmitter";
	    } else {
		echo "<td bgcolor=\"$colorswitch\"><a href=\"mailto:$email\">$modifysubmitter</a>";
	    }
    	    echo "</td>";
    	    if ($owneremail=='') {
		echo "<td bgcolor=\"$colorswitch\">$owner";
	    } else {
		echo "<td bgcolor=\"$colorswitch\"><a href=\"mailto:$owneremail\">$owner</a>";
	    }
    	    echo "</td>"
    		."<td bgcolor=\"$colorswitch\"><center><a href=\"admin.php?op=DownloadsIgnoreBrokenDownloads&amp;lid=$lid\">X</a></center>"
    		."</td>"
    		."<td bgcolor=\"$colorswitch\"><center><a href=\"admin.php?op=DownloadsDelBrokenDownloads&amp;lid=$lid\">X</a></center>"
    		."</td>"
    		."<td bgcolor=\"$colorswitch\"><center><a href=\"admin.php?op=DownloadsModDownload&amp;lid=$lid\">X</a></center>"
    		."</td>"
		."</tr>";
    	    if ($colorswitch == $bgcolor2) {
		$colorswitch = $bgcolor1;
       	    } else {
		$colorswitch = $bgcolor2;
	    }
    	}
    }
    echo "</table>";
    CloseTable();
    include ("footer.php");
}

function DownloadsDelBrokenDownloads($lid) {
    global $prefix, $db;
    $lid = intval($lid);
    $db->sql_query("delete from " . $prefix . "_downloads_modrequest where lid='$lid'");
    $db->sql_query("delete from " . $prefix . "_downloads_downloads where lid='$lid'");
    Header("Location: admin.php?op=DownloadsListBrokenDownloads");
}

function DownloadsIgnoreBrokenDownloads($lid) {
    global $prefix, $db;
    $lid = intval($lid);
    $db->sql_query("delete from " . $prefix . "_downloads_modrequest where lid='$lid' and brokendownload='1'");
    Header("Location: admin.php?op=DownloadsListBrokenDownloads");
}

function DownloadsListModRequests() {
    global $bgcolor2, $prefix, $db, $user_prefix;
    $lid = intval($lid);
    include ("header.php");
    GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>" . _WEBDOWNLOADSADMIN . "</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    $result = $db->sql_query("SELECT requestid, lid, cid, sid, title, url, description, modifysubmitter, name, email, filesize, version, homepage from " . $prefix . "_downloads_modrequest where brokendownload='0' order by requestid");
    $totalmodrequests = $db->sql_numrows($result);
    echo "<center><font class=\"content\"><b>" . _DUSERMODREQUEST . " ($totalmodrequests)</b></font></center><br><br><br>";
    echo "<table width=\"95%\"><tr><td>";
    while($row = $db->sql_fetchrow($result)) {
        $requestid = intval($row['requestid']);
        $lid = intval($row['lid']);
        $cid = intval($row['cid']);
        $sid = intval($row['sid']);
        $title = stripslashes($row['title']);
        $url = $row['url'];
        $description = stripslashes($row['description']);
        $modifysubmitter = $row['modifysubmitter'];
        $name = $row['name'];
        $email = stripslashes($row['email']);
        $filesize = $row['filesize'];
        $version = $row['version'];
        $homepage = $row['homepage'];
	$row2 = $db->sql_fetchrow($db->sql_query("SELECT cid, sid, title, url, description, name, email, submitter, filesize, version, homepage from " . $prefix . "_downloads_downloads where lid='$lid'"));
        $origcid = intval($row2['cid']);
        $origsid = intval($row2['sid']);
        $origtitle = stripslashes($row2['title']);
        $origurl = $row2['url'];
        $origdescription = stripslashes($row2['description']);
        $origname = $row2['name'];
        $origemail = stripslashes($row2['email']);
        $owner = $row2['submitter'];
        $origfilesize = $row2['filesize'];
        $origversion = $row2['version'];
        $orighomepage = $row2['homepage'];
	$result3 = $db->sql_query("SELECT title from " . $prefix . "_downloads_categories where cid='$cid'");
	$result5 = $db->sql_query("SELECT title from " . $prefix . "_downloads_categories where cid='$origcid'");
	$result7 = $db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$modifysubmitter'");
	$result8 = $db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$owner'");
	$row3 = $db->sql_fetchrow($result3);
	    $cidtitle = stripslashes($row3['title']);
	$row5 = $db->sql_fetchrow($result5);
	    $origcidtitle = stripslashes($row5['title']);
	$row7 = $db->sql_fetchrow($result7);
	    $modifysubmitteremail = stripslashes($row7['user_email']);
	$row8 = $db->sql_fetchrow($result8);
	    $owneremail = stripslashes($row8['user_email']);
    	if ($owner=="") {
	    $owner="administration";
	}
    	if ($origsidtitle=="") {
	    $origsidtitle= "-----";
	}
    	if ($sidtitle=="") {
	    $sidtitle= "-----";
	}
    	echo "<table border=\"1\" bordercolor=\"black\" cellpadding=\"5\" cellspacing=\"0\" align=\"center\" width=\"450\">"
    	    ."<tr>"
    	    ."<td>"
    	    ."<table width=\"100%\" bgcolor=\"$bgcolor2\">"
    	    ."<tr>"
    	    ."<td valign=\"top\" width=\"45%\"><b>" . _ORIGINAL . "</b></td>"
    	    ."<td rowspan=\"10\" valign=\"top\" align=\"left\"><font class=\"tiny\"><br>" . _DESCRIPTION . ":<br>$origdescription</font></td>"
    	    ."</tr>"
    	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _TITLE . ": $origtitle</td></tr>"
    	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _URL . ": <a href=\"$origurl\">$origurl</a></td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _CATEGORY . ": $origcidtitle</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _SUBCATEGORY . ": $origsidtitle</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _AUTHORNAME . ": $origname</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _AUTHOREMAIL . ": $origemail</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _FILESIZE . ": $origfilesize</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _VERSION . ": $origversion</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _HOMEPAGE . ": <a href=\"$orighomepage\" target=\"new\">$orighomepage</a></td></tr>"
    	    ."</table>"
    	    ."</td>"
    	    ."</tr>"
    	    ."<tr>"
    	    ."<td>"
    	    ."<table width=\"100%\">"
    	    ."<tr>"
    	    ."<td valign=\"top\" width=\"45%\"><b>" . _PROPOSED . "</b></td>"
    	    ."<td rowspan=\"10\" valign=\"top\" align=\"left\"><font class=\"tiny\"><br>" . _DESCRIPTION . ":<br>$description</font></td>"
    	    ."</tr>"
    	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _TITLE . ": $title</td></tr>"
    	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _URL . ": <a href=\"$url\">$url</a></td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _CATEGORY . ": $cidtitle</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _SUBCATEGORY . ": $sidtitle</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _AUTHORNAME . ": $name</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _AUTHOREMAIL . ": $email</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _FILESIZE . ": $filesize</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _VERSION . ": $version</td></tr>"
	    ."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _HOMEPAGE . ": <a href=\"$homepage\" target=\"new\">$homepage</a></td></tr>"
    	    ."</table>"
    	    ."</td>"
    	    ."</tr>"
    	    ."</table>"
    	    ."<table align=\"center\" width=\"450\">"
    	    ."<tr>";
    	if ($modifysubmitteremail=="") {
	    echo "<td align=\"left\"><font class=\"tiny\">" . _SUBMITTER . ":  $modifysubmitter</font></td>";
	} else {
	    echo "<td align=\"left\"><font class=\"tiny\">" . _SUBMITTER . ":  <a href=\"mailto:$modifysubmitteremail\">$modifysubmitter</a></font></td>";
	}
    	if ($owneremail=="") {
	    echo "<td align=\"center\"><font class=\"tiny\">" . _OWNER . ":  $owner</font></td>";
	} else {
	    echo "<td align=\"center\"><font class=\"tiny\">" . _OWNER . ": <a href=\"mailto:$owneremail\">$owner</a></font></td>";
	}
    	echo "<td align=\"right\"><font class=\"tiny\">( <a href=\"admin.php?op=DownloadsChangeModRequests&amp;requestid=$requestid\">" . _ACCEPT . "</a> / <a href=\"admin.php?op=DownloadsChangeIgnoreRequests&amp;requestid=$requestid\">" . _IGNORE . "</a> )</font></td></tr></table><br><br>";
    }
    if ($totalmodrequests == 0) {
	echo "<center>" . _NOMODREQUESTS . "<br><br>"
	    ."" . _GOBACK . "<br><br></center>";
    }
    echo "</td></tr></table>";
    CloseTable();
    include ("footer.php");
}

function DownloadsChangeModRequests($requestid) {
    global $prefix, $db;
    $requestid = intval($requestid);
    $result = $db->sql_query("SELECT requestid, lid, cid, sid, title, url, description, name, email, filesize, version, homepage from " . $prefix . "_downloads_modrequest where requestid='$requestid'");
    while ($row = $db->sql_fetchrow($result)) {
        $requestid = intval($row['requestid']);
        $lid = intval($row['lid']);
        $cid = intval($row['cid']);
        $sid = intval($row['sid']);
        $title = stripslashes($row['title']);
        $url = $row['url'];
        $description = stripslashes($row['description']);
        $name = $row['name'];
        $email = stripslashes($row['email']);
        $filesize = $row['filesize'];
        $version = $row['version'];
        $homepage = $row['homepage'];
    	$db->sql_query("UPDATE " . $prefix . "_downloads_downloads SET cid='$cid', sid='$sid', title='$title', url='$url', description='$description', name='$name', email='$email', filesize='$filesize', version='$version', homepage='$homepage' WHERE lid='$lid'");
	$db->sql_query("delete from " . $prefix . "_downloads_modrequest where requestid='$requestid'");
    }
    Header("Location: admin.php?op=DownloadsListModRequests");
}

function DownloadsChangeIgnoreRequests($requestid) {
    global $prefix, $db;
    $requestid = intval($requestid);
    $db->sql_query("delete from " . $prefix . "_downloads_modrequest where requestid='$requestid'");
    Header("Location: admin.php?op=DownloadsListModRequests");
}

function DownloadsCleanVotes() {
    global $prefix, $db;
    $lid = intval($lid);
    $result = $db->sql_query("SELECT distinct ratinglid FROM " . $prefix . "_downloads_votedata");
    while ($row = $db->sql_fetchrow($result)) {
	$lid = intval($row['ratinglid']);
    $voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM " . $prefix . "_downloads_votedata WHERE ratinglid='$lid'");
    $totalvotesDB = $db->sql_numrows($voteresult);
	include ("voteinclude.php");
        $db->sql_query("UPDATE " . $prefix . "_downloads_downloads SET downloadratingsummary='$finalrating',totalvotes='$totalvotesDB',totalcomments='$truecomments' WHERE lid='$lid'");
    }
    Header("Location: admin.php?op=downloads");
}

function DownloadsModDownloadS($lid, $title, $url, $description, $name, $email, $hits, $cat, $filesize, $version, $homepage) {
    global $prefix, $db;
    $cat = explode("-", $cat);
    if ($cat[1]=="") {
        $cat[1] = 0;
    }
    $title = stripslashes(FixQuotes($title));
    $url = stripslashes(FixQuotes($url));
    $description = stripslashes(FixQuotes($description));
    $name = stripslashes(FixQuotes($name));
    $email = stripslashes(FixQuotes($email));
    $lid = intval($lid);
    $db->sql_query("update " . $prefix . "_downloads_downloads set cid='$cat[0]', sid='$cat[1]', title='$title', url='$url', description='$description', name='$name', email='$email', hits='$hits', filesize='$filesize', version='$version', homepage='$homepage' where lid='$lid'");
    $sql = "SELECT * FROM " . $prefix . "_downloads_modrequest where lid='$lid'";
    $result = $db->sql_query($sql);
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
    $db->sql_query("delete from " . $prefix . "_downloads_modrequest where lid='$lid'");
    }
    Header("Location: admin.php?op=downloads");
}

function DownloadsDelDownload($lid) {
    global $prefix, $db;
    $lid = intval($lid);
    $db->sql_query("delete from " . $prefix . "_downloads_downloads where lid='$lid'");
    $sql = "SELECT * FROM " . $prefix . "_downloads_modrequest where lid='$lid'";
    $result = $db->sql_query($sql);
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
    $db->sql_query("delete from " . $prefix . "_downloads_modrequest where lid='$lid'");
    }
    Header("Location: admin.php?op=downloads");
}

function DownloadsModCat($cat) {
    global $prefix, $db;
    include ("header.php");
    GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>" . _WEBDOWNLOADSADMIN . "</b></font></center>";
    CloseTable();
    echo "<br>";
    $cat = explode("-", $cat);
    if ($cat[1]=="") {
        $cat[1] = 0;
    }
    OpenTable();
    echo "<center><font class=\"content\"><b>" . _MODCATEGORY . "</b></font></center><br><br>";
    if ($cat[1]==0) {
    $row = $db->sql_fetchrow($db->sql_query("SELECT title, cdescription from " . $prefix . "_downloads_categories where cid='$cat[0]'"));
	$title = stripslashes($row['title']);
	$cdescription = stripslashes($row['cdescription']);
	echo "<form action=\"admin.php\" method=\"get\">"
	    ."" . _NAME . ": <input type=\"text\" name=\"title\" value=\"$title\" size=\"51\" maxlength=\"50\"><br>"
	    ."" . _DESCRIPTION . ":<br><textarea name=\"cdescription\" cols=\"60\" rows=\"10\">$cdescription</textarea><br>"
	    ."<input type=\"hidden\" name=\"sub\" value=\"0\">"
	    ."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\">"
	    ."<input type=\"hidden\" name=\"op\" value=\"DownloadsModCatS\">"
	    ."<table border=\"0\"><tr><td>"
	    ."<input type=\"submit\" value=\"" . _SAVECHANGES . "\"></form></td><td>"
	    ."<form action=\"admin.php\" method=\"get\">"
	    ."<input type=\"hidden\" name=\"sub\" value=\"0\">"
	    ."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\">"
	    ."<input type=\"hidden\" name=\"op\" value=\"DownloadsDelCat\">"
	    ."<input type=\"submit\" value=\"" . _DELETE . "\"></form></td></tr></table>";
    } else {
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT title from " . $prefix . "_downloads_categories where cid='$cat[0]'"));
	$ctitle = stripslashes($row2['title']);
    $row3 = $db->sql_fetchrow($db->sql_query("SELECT title from " . $prefix . "_downloads_subcategories where sid='$cat[1]'"));
	$stitle = stripslashes($row3['title']);
	echo "<form action=\"admin.php\" method=\"get\">"
	    ."" . _CATEGORY . ": $ctitle<br>"
	    ."" . _SUBCATEGORY . ": <input type=\"text\" name=\"title\" value=\"$stitle\" size=\"51\" maxlength=\"50\"><br>"
	    ."<input type=\"hidden\" name=\"sub\" value=\"1\">"
	    ."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\">"
	    ."<input type=\"hidden\" name=\"sid\" value=\"$cat[1]\">"
	    ."<input type=\"hidden\" name=\"op\" value=\"DownloadsModCatS\">"
	    ."<table border=\"0\"><tr><td>"
	    ."<input type=\"submit\" value=\"" . _SAVECHANGES . "\"></form></td><td>"
	    ."<form action=\"admin.php\" method=\"get\">"
	    ."<input type=\"hidden\" name=\"sub\" value=\"1\">"
	    ."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\">"
	    ."<input type=\"hidden\" name=\"sid\" value=\"$cat[1]\">"
	    ."<input type=\"hidden\" name=\"op\" value=\"DownloadsDelCat\">"
	    ."<input type=\"submit\" value=\"" . _DELETE . "\"></form></td></tr></table>";
    }
    CloseTable();
    include("footer.php");
}

function DownloadsModCatS($cid, $sid, $sub, $title, $cdescription) {
    global $prefix, $db;
    $cid = intval($cid);
    $sid = intval($sid);
    if ($sub==0) {
	$db->sql_query("update " . $prefix . "_downloads_categories set title='$title', cdescription='$cdescription' where cid='$cid'");
    } else {
	$db->sql_query("update " . $prefix . "_downloads_subcategories set title='$title' where sid='$sid'");
    }
    Header("Location: admin.php?op=downloads");
}

function DownloadsDelCat($cid, $sid, $sub, $ok=0) {
    global $prefix, $db;
    include("header.php");
    $cid = intval($cid);
    if($ok==1) {
	if ($sub>0) {
    	$db->sql_query("delete from " . $prefix . "_downloads_categories where cid='$cid'");
	    $db->sql_query("delete from " . $prefix . "_downloads_downloads where cid='$cid'");
	} else {
	    $db->sql_query("delete from " . $prefix . "_downloads_downloads where cid='$cid'");
		// suppression des liens de catégories filles
	$result2 = $db->sql_query("SELECT cid from " . $prefix . "_downloads_categories where parentid='$cid'");
	while ($row2 = $db->sql_fetchrow($result2)) {
	$cid2 = intval($row2['cid']);
			$db->sql_query("delete from " . $prefix . "_downloads_downloads where cid='$cid2'");
		}
	    $db->sql_query("delete from " . $prefix . "_downloads_categories where parentid='$cid'");
	    $db->sql_query("delete from " . $prefix . "_downloads_categories where cid='$cid'");
	}
        Header("Location: admin.php?op=downloads");
    } else {
	$result = $db->sql_query("SELECT * from " . $prefix . "_downloads_categories where parentid='$cid'");
	$nbsubcat = $db->sql_numrows($result);
	$result3 = $db->sql_query("SELECT cid from " . $prefix . "_downloads_categories where parentid='$cid'");
	while ($row3 = $db->sql_fetchrow($result3)) {
	$cid2 = intval($row3['cid']);
		$result4 = $db->sql_query("SELECT * from " . $prefix . "_downloads_downloads where cid='$cid2'");
		$nblink = $db->sql_numrows($result4);
	}
	GraphicAdmin();
	OpenTable();
	echo "<br><center><font class=\"option\">";
	echo "<b>" . _EZTHEREIS . " $nbsubcat " . _EZSUBCAT . " " . _EZATTACHEDTOCAT . "</b><br>";
	echo "<b>" . _EZTHEREIS . " $nblink " . _downloads . " " . _EZATTACHEDTOCAT . "</b><br>";
	echo "<b>" . _DELEZDOWNLOADSCATWARNING . "</b><br><br>";
    }
	echo "[ <a href=\"admin.php?op=DownloadsDelCat&amp;cid=$cid&amp;sid=$sid&amp;sub=$sub&amp;ok=1\">" . _YES . "</a> | <a href=\"admin.php?op=Links\">" . _NO . "</a> ]<br><br>";
	CloseTable();
        include("footer.php");
}

function DownloadsDelNew($lid) {
    global $prefix, $db;
    $lid = intval($lid);
    $db->sql_query("delete from " . $prefix . "_downloads_newdownload where lid='$lid'");
    Header("Location: admin.php?op=downloads");
}

function DownloadsAddCat($title, $cdescription) {
    global $prefix, $db;
    $result = $db->sql_query("SELECT cid from " . $prefix . "_downloads_categories where title='$title'");
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
	include("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<br><center><font class=\"content\">"
	    ."<b>" . _ERRORTHECATEGORY . " $title " . _ALREADYEXIST . "</b><br><br>"
	    ."" . _GOBACK . "<br><br>";
	CloseTable();
	include("footer.php");
    } else {
	$db->sql_query("insert into " . $prefix . "_downloads_categories values (NULL, '$title', '$cdescription', '$parentid')");
	Header("Location: admin.php?op=downloads");
    }
}

function DownloadsAddSubCat($cid, $title, $cdescription) {
    global $prefix, $db;
    $cid = intval($cid);
    $result = $db->sql_query("SELECT cid from " . $prefix . "_downloads_categories where title='$title' AND cid='$cid'");
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
	include("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<br><center>";
	echo "<font class=\"content\">"
	    ."<b>" . _ERRORTHESUBCATEGORY . " $title " . _ALREADYEXIST . "</b><br><br>"
	    ."" . _GOBACK . "<br><br>";
	include("footer.php");
    } else {
	$db->sql_query("insert into " . $prefix . "_downloads_categories values (NULL, '$title', '$cdescription', '$cid')");
	Header("Location: admin.php?op=downloads");
    }
}

function DownloadsAddEditorial($downloadid, $editorialtitle, $editorialtext) {
    global $aid, $prefix, $db;
    $editorialtext = stripslashes(FixQuotes($editorialtext));
    $db->sql_query("insert into " . $prefix . "_downloads_editorials values ('$downloadid', '$aid', now(), '$editorialtext', '$editorialtitle')");
    include("header.php");
    GraphicAdmin();
    OpenTable();
    echo "<center><br>"
	."<font class=option>"
	."" . _EDITORIALADDED . "<br><br>"
	."[ <a href=\"admin.php?op=downloads\">" . _WEBDOWNLOADSADMIN . "</a> ]<br><br>";
    echo "$downloadid  $adminid, $editorialtitle, $editorialtext";
    CloseTable();
    include("footer.php");
}

function DownloadsModEditorial($downloadid, $editorialtitle, $editorialtext) {
    global $prefix, $db;
    $editorialtext = stripslashes(FixQuotes($editorialtext));
    $db->sql_query("update " . $prefix . "_downloads_editorials set editorialtext='$editorialtext', editorialtitle='$editorialtitle' where downloadid='$downloadid'");
    include("header.php");
    GraphicAdmin();
    OpenTable();
    echo "<br><center>"
	."<font class=\"content\">"
	."" . _EDITORIALMODIFIED . "<br><br>"
	."[ <a href=\"admin.php?op=downloads\">" . _WEBDOWNLOADSADMIN . "</a> ]<br><br>";
    CloseTable();
    include("footer.php");
}

function DownloadsDelEditorial($downloadid) {
    global $prefix, $db;
    $downloadid = intval($downloadid);
    $db->sql_query("delete from " . $prefix . "_downloads_editorials where downloadid='$downloadid'");
    include("header.php");
    GraphicAdmin();
    OpenTable();
    echo "<br><center>"
	."<font class=\"content\">"
	."" . _EDITORIALREMOVED . "<br><br>"
	."[ <a href=\"admin.php?op=downloads\">" . _WEBDOWNLOADSADMIN . "</a> ]<br><br>";
    CloseTable();
    include("footer.php");
}

function DownloadsDownloadCheck() {
    global $prefix, $db;
    $cid = intval($cid);
    include ("header.php");
    GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>" . _WEBDOWNLOADSADMIN . "</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<center><font class=\"content\"><b>" . _DOWNLOADVALIDATION . "</b></font></center><br>"
	."<table width=\"100%\" align=\"center\"><tr><td colspan=\"2\" align=\"center\">"
	."<a href=\"admin.php?op=DownloadsValidate&amp;cid=0&amp;sid=0\">" . _CHECKALLDOWNLOADS . "</a><br><br></td></tr>"
	."<tr><td valign=\"top\"><center><b>" . _CHECKCATEGORIES . "</b><br>" . _INCLUDESUBCATEGORIES . "<br><br><font class=\"tiny\">";
    $result = $db->sql_query("SELECT cid, title from " . $prefix . "_downloads_categories order by title");
    while ($row = $db->sql_fetchrow($result)) {
	$cid = intval($row['cid']);
	$title = $row['title'];
        $transfertitle = str_replace (" ", "_", $title);
    	echo "<a href=\"admin.php?op=DownloadsValidate&amp;cid=$cid&amp;sid=0&amp;ttitle=$transfertitle\">$title</a><br>";
    }
    echo "</font></center></td></tr></table>";
    CloseTable();
    include ("footer.php");
}

function DownloadsValidate($cid, $sid, $ttitle) {
    global $bgcolor2, $prefix, $db;
    include ("header.php");
    GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>" . _WEBDOWNLOADSADMIN . "</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    $transfertitle = str_replace ("_", "", $ttitle);
    /* Check ALL Downloads */
    $cid = intval($cid);
    $sid = intval($sid);
    echo "<table width=100% border=0>";
    if ($cid==0 && $sid==0) {
	echo "<tr><td colspan=\"3\"><center><b>" . _CHECKALLDOWNLOADS . "</b><br>" . _BEPATIENT . "</center><br><br></td></tr>";
	$result = $db->sql_query("SELECT lid, title, url, name, email, submitter from " . $prefix . "_downloads_downloads order by title");
    }
    /* Check Categories & Subcategories */
    if ($cid!=0 && $sid==0) {
	echo "<tr><td colspan=\"3\"><center><b>" . _VALIDATINGCAT . ": $transfertitle</b><br>" . _BEPATIENT . "</center><br><br></td></tr>";
	$result2 = $db->sql_query("SELECT lid, title, url, name, email, submitter from " . $prefix . "_downloads_downloads where cid='$cid' order by title");
    }
    /* Check Only Subcategory */
    if ($cid==0 && $sid!=0) {
   	echo "<tr><td colspan=\"3\"><center><b>" . _VALIDATINGSUBCAT . ": $transfertitle</b><br>" . _BEPATIENT . "</center><br><br></td></tr>";
   	$result3 = $db->sql_query("SELECT lid, title, url, name, email, submitter from " . $prefix . "_downloads_downloads where sid='$sid' order by title");
    }
    echo "<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _STATUS . "</b></td><td bgcolor=\"$bgcolor2\" width=\"100%\"><b>" . _DOWNLOADTITLE . "</b></td><td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _FUNCTIONS . "</b></td></tr>";
    while($row3 = $db->sql_fetchrow($result3)) {
	$lid = intval($row3['lid']);
	$title = stripslashes($row3['title']);
	$vurl = parse_url($row3['url']);
	$name = $row3['name'];
	$email = stripslashes($row3['email']);
	$submitter = $row3['submitter'];
	$fp = fsockopen($vurl['host'], 80, $errno, $errstr, 15);
        if (!$fp){
	    echo "<tr><td align=\"center\"><b>&nbsp;&nbsp;" . _FAILED . "&nbsp;&nbsp;</b></td>"
		."<td>&nbsp;&nbsp;<a href=\"$url\" target=\"new\">$title</a>&nbsp;&nbsp;</td>"
		."<td align=\"center\"><font class=\"content\">&nbsp;&nbsp;[ <a href=\"admin.php?op=DownloadsModDownload&amp;lid=$lid\">" . _EDIT . "</a> | <a href=\"admin.php?op=DownloadsDelDownload&amp;lid=$lid\">" . _DELETE . "</a> ]&nbsp;&nbsp;</font>"
		."</td></tr>";
        }
        if ($fp){
	    echo "<tr><td align=\"center\">&nbsp;&nbsp;" . _OK . "&nbsp;&nbsp;</td>"
		."<td>&nbsp;&nbsp;<a href=\"$url\" target=\"new\">$title</a>&nbsp;&nbsp;</td>"
		."<td align=\"center\"><font class=\"content\">&nbsp;&nbsp;" . _NONE . "&nbsp;&nbsp;</font>"
		."</td></tr>";
        }
    }
    echo "</table>";
    CloseTable();
    include ("footer.php");
}

function DownloadsAddDownload($new, $lid, $title, $url, $cat, $description, $name, $email, $submitter, $filesize, $version, $homepage, $hits) {
    global $prefix, $db;
    $result = $db->sql_query("SELECT url from " . $prefix . "_downloads_downloads where url='$url'");
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
	include("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<center><font class=\"title\"><b>" . _WEBDOWNLOADSADMIN . "</b></font></center>";
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<br><center>"
	    ."<font class=\"content\">"
	    ."<b>" . _ERRORURLEXIST . "</b><br><br>"
	    ."" . _GOBACK . "<br><br>";
	CloseTable();
	include("footer.php");
    } else {
/* Check if Title exist */
    if ($title=="") {
	include("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<center><font class=\"title\"><b>" . _WEBDOWNLOADSADMIN . "</b></font></center>";
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<br><center>"
	    ."<font class=\"content\">"
	    ."<b>" . _ERRORNOTITLE . "</b><br><br>"
	    ."" . _GOBACK . "<br><br>";
	CloseTable();
	include("footer.php");
    }
/* Check if URL exist */
    if ($url=="") {
	include("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<center><font class=\"title\"><b>" . _WEBDOWNLOADSADMIN . "</b></font></center>";
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<br><center>"
	    ."<font class=\"content\">"
	    ."<b>" . _ERRORNOURL . "</b><br><br>"
	    ."" . _GOBACK . "<br><br>";
	CloseTable();
	include("footer.php");
    }
// Check if Description exist
    if ($description=="") {
	include("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<center><font class=\"title\"><b>" . _WEBDOWNLOADSADMIN . "</b></font></center>";
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<br><center>"
	    ."<font class=\"content\">"
	    ."<b>" . _ERRORNODESCRIPTION . "</b><br><br>"
	    ."" . _GOBACK . "<br><br>";
	CloseTable();
	include("footer.php");
    }
    $cat = explode("-", $cat);
    if ($cat[1]=="") {
	$cat[1] = 0;
    }
    $title = stripslashes(FixQuotes($title));
    $url = stripslashes(FixQuotes($url));
    $description = stripslashes(FixQuotes($description));
    $name = stripslashes(FixQuotes($name));
    $email = stripslashes(FixQuotes($email));
    $db->sql_query("insert into " . $prefix . "_downloads_downloads values (NULL, '$cat[0]', '$cat[1]', '$title', '$url', '$description', now(), '$name', '$email', '$hits','$submitter',0,0,0, '$filesize', '$version', '$homepage')");
    global $nukeurl, $sitename;
    include("header.php");
    GraphicAdmin();
    OpenTable();
    echo "<br><center>";
    echo "<font class=\"content\">";
    echo "" . _NEWDOWNLOADADDED . "<br><br>";
    echo "[ <a href=\"admin.php?op=downloads\">" . _WEBDOWNLOADSADMIN . "</a> ]</center><br><br>";
    CloseTable();
    if ($new==1) {
	$db->sql_query("delete from " . $prefix . "_downloads_newdownload where lid='$lid'");
    }
    include("footer.php");
    }
}

switch ($op) {

    case "downloads":
    downloads();
    break;

    case "DownloadsDelNew":
    DownloadsDelNew($lid);
    break;

    case "DownloadsAddCat":
    DownloadsAddCat($title, $cdescription);
    break;

    case "DownloadsAddSubCat":
    DownloadsAddSubCat($cid, $title, $cdescription);
    break;

    case "DownloadsAddDownload":
    DownloadsAddDownload($new, $lid, $title, $url, $cat, $description, $name, $email, $submitter, $filesize, $version, $homepage, $hits);
    break;

    case "DownloadsAddEditorial":
    DownloadsAddEditorial($downloadid, $editorialtitle, $editorialtext);
    break;

    case "DownloadsModEditorial":
    DownloadsModEditorial($downloadid, $editorialtitle, $editorialtext);
    break;

    case "DownloadsDownloadCheck":
    DownloadsDownloadCheck();
    break;

    case "DownloadsValidate":
    DownloadsValidate($cid, $sid, $ttitle);
    break;

    case "DownloadsDelEditorial":
    DownloadsDelEditorial($downloadid);
    break;

    case "DownloadsCleanVotes":
    DownloadsCleanVotes();
    break;

    case "DownloadsListBrokenDownloads":
    DownloadsListBrokenDownloads();
    break;

    case "DownloadsDelBrokenDownloads":
    DownloadsDelBrokenDownloads($lid);
    break;

    case "DownloadsIgnoreBrokenDownloads":
    DownloadsIgnoreBrokenDownloads($lid);
    break;

    case "DownloadsListModRequests":
    DownloadsListModRequests();
    break;

    case "DownloadsChangeModRequests":
    DownloadsChangeModRequests($requestid);
    break;

    case "DownloadsChangeIgnoreRequests":
    DownloadsChangeIgnoreRequests($requestid);
    break;

    case "DownloadsDelCat":
    DownloadsDelCat($cid, $sid, $sub, $ok);
    break;

    case "DownloadsModCat":
    DownloadsModCat($cat);
    break;

    case "DownloadsModCatS":
    DownloadsModCatS($cid, $sid, $sub, $title, $cdescription);
    break;

    case "DownloadsModDownload":
    DownloadsModDownload($lid);
    break;

    case "DownloadsModDownloadS":
    DownloadsModDownloadS($lid, $title, $url, $description, $name, $email, $hits, $cat, $filesize, $version, $homepage);
    break;

    case "DownloadsDelDownload":
    DownloadsDelDownload($lid);
    break;

    case "DownloadsDelVote":
    DownloadsDelVote($lid, $rid);
    break;

    case "DownloadsDelComment":
    DownloadsDelComment($lid, $rid);
    break;

    case "DownloadsTransfer":
    DownloadsTransfer($cidfrom,$cidto);
    break;

}

} else {
	include("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<center><b>"._ERROR."</b><br><br>You do not have administration permission for module \"$module_name\"</center>";
	CloseTable();
	include("footer.php");
}
# $Log: index.php,v $
# Revision 1.4  2004/12/09 23:01:06  chatserv
# http://www.nukefixes.com/ftopicp-3479.html#3479
#
# Revision 1.3  2004/11/24 23:17:09  chatserv
# Version 2.7 Release
#
# Revision 1.2  2004/10/20 17:00:19  chatserv
# http://www.nukefixes.com/ftopicp-3142.html#3142
#
# Revision 1.1  2004/10/05 18:04:48  chatserv
# Initial CVS Addition
#

?>