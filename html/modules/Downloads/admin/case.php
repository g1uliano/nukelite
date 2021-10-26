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
/************************************************************************/

if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}
if (!stristr($_SERVER['SCRIPT_NAME'], "admin.php")) { die ("Access Denied"); }
$module_name = "Downloads";
include_once("modules/$module_name/admin/language/lang-brazilian.php");


switch($op) {

    case "downloads":
    case "DownloadsDelNew":
    case "DownloadsAddCat":
    case "DownloadsAddSubCat":
    case "DownloadsAddDownload":
    case "DownloadsAddEditorial":
    case "DownloadsModEditorial":
    case "DownloadsDownloadCheck":
    case "DownloadsValidate":
    case "DownloadsDelEditorial":
    case "DownloadsCleanVotes":
    case "DownloadsListBrokenDownloads":
    case "DownloadsDelBrokenDownloads":
    case "DownloadsIgnoreBrokenDownloads":
    case "DownloadsListModRequests":
    case "DownloadsChangeModRequests":
    case "DownloadsChangeIgnoreRequests":
    case "DownloadsDelCat":
    case "DownloadsModCat":
    case "DownloadsModCatS":
    case "DownloadsModDownload":
    case "DownloadsModDownloadS":
    case "DownloadsDelDownload":
    case "DownloadsDelVote":
    case "DownloadsDelComment":
    case "DownloadsTransfer":
    include("modules/$module_name/admin/index.php");
    break;

}

# $Log: case.php,v $
# Revision 1.3  2004/12/09 23:01:06  chatserv
# http://www.nukefixes.com/ftopicp-3479.html#3479
#
# Revision 1.2  2004/11/24 23:17:09  chatserv
# Version 2.7 Release
#
# Revision 1.1  2004/10/05 18:04:48  chatserv
# Initial CVS Addition
#

?>
