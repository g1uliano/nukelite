<?php

# $Author: chatserv $
# $Date: 2004/10/04 19:24:21 $
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/

require_once("mainfile.php");
$module = 1;

    $name = trim($name);
if (isset($name)) {
if (eregi("http\:\/\/", $name)) {
	die("Hi&nbsp;and&nbsp;Bye");
    }
    $modstring = strtolower($_SERVER['QUERY_STRING']);
if (stripos_clone($modstring,"&user=") AND ($name=="Private_Messages" || $name=="Forums" || $name=="Members_List")) header("Location: index.php");
    global $nukeuser, $db, $prefix;
    $nukeuser = base64_decode($user);
    $nukeuser = addslashes($nukeuser);
    $result = $db->sql_query("SELECT active, view FROM ".$prefix."_modules WHERE title='$name'");
    $row = $db->sql_fetchrow($result);
    $mod_active = intval($row['active']);
    $view = intval($row['view']);
    if (($mod_active == 1) OR ($mod_active == 0 AND is_admin($admin))) {
		if (!isset($mop)) { $mop="modload"; }
		if (!isset($file)) { $file="index"; }
		if (ereg("\.\.",$name) || ereg("\.\.",$file) || ereg("\.\.",$mop)) {
		    echo "You are so cool...";
		} else {
		    $ThemeSel = get_theme();
	    if (file_exists("themes/$ThemeSel/modules/$name/".$file.".php")) {
				$modpath = "themes/$ThemeSel/";
		    } else {
				$modpath = "";
		    }
		    if ($view == 0) {
		$modpath .= "modules/$name/".$file.".php";
	    		if (file_exists($modpath)) {
			    	include($modpath);
	    		} else {
			    	die ("Sorry, such file doesn't exist...");
		    }
            } else if ($view == 1 AND (is_user($user) OR is_group($user, $name)) OR is_admin($admin)) { 
		$modpath .= "modules/$name/".$file.".php";
	    		if (file_exists($modpath)) {
			    	include($modpath);
	    		} else {
			    	die ("Sorry, such file doesn't exist...");
				}
		    } elseif ($view == 1 AND !is_user($user) AND !is_admin($admin)) {
				$pagetitle = "- "._ACCESSDENIED."";
				include("header.php");
				title("$sitename: "._ACCESSDENIED."");
				OpenTable();
				echo "<center><b>"._RESTRICTEDAREA."</b><br><br>"
				    .""._MODULEUSERS."";
		$result2 = $db->sql_query("SELECT mod_group FROM ".$prefix."_modules WHERE title='$name'"); 
		$row2 = $db->sql_fetchrow($result2); 
	    if ($row2[mod_group] != 0) { 
		$result3 = $db->sql_query("SELECT name FROM ".$prefix."_groups WHERE id='$row2[mod_group]'"); 
		$row3 = $db->sql_fetchrow($result3); 
		echo ""._ADDITIONALYGRP.": <b>$row3[name]</b><br><br>";
				}
				echo ""._GOBACK."";
				CloseTable();
				include("footer.php");
				die();
            } else if ($view == 2 AND is_admin($admin)) { 
		$modpath .= "modules/$name/".$file.".php";
	    		if (file_exists($modpath)) {
			    	include($modpath);
	    		} else {
			    	die ("Sorry, such file doesn't exist...");
				}
		    } elseif ($view == 2 AND !is_admin($admin)) {
				$pagetitle = "- "._ACCESSDENIED."";
				include("header.php");
				title("$sitename: "._ACCESSDENIED."");
				OpenTable();
				echo "<center><b>"._RESTRICTEDAREA."</b><br><br>"
				    .""._MODULESADMINS.""
				    .""._GOBACK."";
				CloseTable();
				include("footer.php");
				die();
            } else if ($view == 3 AND paid()) { 
				$modpath .= "modules/$name/$file.php";
	    		if (file_exists($modpath)) {
			    	include($modpath);
	    		} else {
			    	die ("Sorry, such file doesn't exist...");
				}
		    } else {
				$pagetitle = "- "._ACCESSDENIED."";
				include("header.php");
				title("$sitename: "._ACCESSDENIED."");
				OpenTable();
				echo "<center><b>"._RESTRICTEDAREA."</b><br><br>"
				    .""._MODULESSUBSCRIBER."";
				if ($subscription_url != "") {
					echo "<br>"._SUBHERE."";
				}
				echo "<br><br>"._GOBACK."";
				CloseTable();
				include("footer.php");
				die();
		    }
		}
    } else {
		include("header.php");
		OpenTable();
		echo "<center>"._MODULENOTACTIVE."<br><br>"
		    .""._GOBACK."</center>";
		CloseTable();
		include("footer.php");
    }
} else {
    die ("Sorry, you can't access this file directly...");
}
# $Log: modules.php,v $
# Revision 1.1  2004/10/04 19:24:21  chatserv
# Initial CVS Addition
#

?>