<?php
###############################################################
# Original Theme by John Grabenmeier                          #
# ThemeName: codersheaven                                     #
# Homepage: http://jooon.de                                   #
# Feedback: http://jooon.de/portal/modules.php?name=Feedback  #
# Copyright by jooon.de (John Grabenmeier)                    #
# Tema Modificado por; Giulino Cardoso                        #
###############################################################


$bgcolor1 = "#ffffff";
$bgcolor2 = "#D8DFEC";
$bgcolor3 = "#ffffff";
$bgcolor4 = "#eeeeee";
$textcolor1 = "#ffffff";
$textcolor2 = "#000000";

function OpenTable() {
    global $bgcolor1, $bgcolor2;
    echo "
	<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
	<tr><td valign=\"top\" width=\"10\"><img src=\"themes/codersheaven/images/ecke_oben_links.gif\" alt=\"Ecke\"></td>
	<td background=\"themes/codersheaven/images/oben.gif\"><img src=\"themes/codersheaven/images/pixel.gif\" width=\"100%\" height=\"10\" alt=\"\"></td>
	<td width=\"10\"><img src=\"themes/codersheaven/images/ecke_oben_rechts.gif\" alt=\"Ecke\"></td></tr>
	<tr><td background=\"themes/codersheaven/images/links.gif\"><img src=\"themes/codersheaven/images/pixel.gif\" alt=\"\"></td><td>";
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>\n";
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\"$bgcolor1\"><tr><td>\n";
}

function CloseTable() {
    echo "</td><td background=\"themes/codersheaven/images/rechts.gif\"><img src=\"themes/codersheaven/images/pixel.gif\" alt=\"\"></td></tr><tr>
	<td width=\"10\"><img src=\"themes/codersheaven/images/ecke_unten_links.gif\" alt=\"Ecke\"></td>
	<td background=\"themes/codersheaven/images/unten.gif\"><img src=\"themes/codersheaven/images/pixel.gif\" width=\"100%\" height=\"10\" alt=\"\"></td>
	<td width=\"10\"><img src=\"themes/codersheaven/images/ecke_unten_rechts.gif\" alt=\"Ecke\"></td></tr></table><br>\n";
}

function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}

function FormatStory($thetext, $notes, $aid, $informant) {
    global $anonymous;
    if ($notes != "") {
	$notes = "<b>"._NOTE."</b> <i>$notes</i>\n";
    } else {
	$notes = "";
    }
    if ("$aid" == "$informant") {
	echo "<font class=\"content\">$thetext<br>$notes</font>\n";
    } else {
	if($informant != "") {
	    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
	} else {
	    $boxstuff = "$anonymous ";
	}
	$boxstuff .= ""._WRITES." <i>\"$thetext\"</i> $notes\n";
	echo "<font class=\"content\">$boxstuff</font>\n";
    }
}

function themeheader() {
global $sitename, $Anonymus, $banners, $username, $user, $banners, $slogan, $cookie, $prefix, $sdata, $diasemana, $mesnome, $ano, $mes, $dia, $diasem;
    
	cookiedecode($user);
    $username = $cookie[1];
#Inicio da Adição Feita por: Giuliano Cardoso
#Função de Data
$diasemana[0] = "Domingo";
$diasemana[1] = "Segunda-feira";
$diasemana[2] = "Terça-feira";
$diasemana[3] = "Quarta-feira";
$diasemana[4] = "Quinta-feira";
$diasemana[5] = "Sexta-feira";
$diasemana[6] = "Sábado";

$mesnome[1] = "janeiro";
$mesnome[2] = "fevereiro";
$mesnome[3] = "março";
$mesnome[4] = "abril";
$mesnome[5] = "maio";
$mesnome[6] = "junho";
$mesnome[7] = "julho";
$mesnome[8] = "agosto";
$mesnome[9] = "setembro";
$mesnome[10] = "outubro";
$mesnome[11] = "novembro";
$mesnome[12] = "dezembro";

$ano = date('Y');
$mes = date('n');
$dia = date('d');
$diasem = date('w');

$sdata = $diasemana[$diasem].', '.$dia.' de '.$mesnome[$mes].' de '.$ano;
#Fim Da Alteração    
	if ($username == "") {
        $username = "Anonymous";
    }
    echo "<body bgcolor=\"ffffff\" topmargin=\"0\" leftmargin=\"0\" rightmargin=\"0\" bottommargin=\"0\">
    <table border=\"0 cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" align=\"center\"><tr><td bgcolor=\"ffffff\">"
        ."<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"ffffff\">
		<tr><td height=\"80\" background=\"themes/codersheaven/images/logo_bg.gif\" valign=\"bottom\" align=\"left\">
		<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td valign=\"bottom\" align=\"left\">"
        ."<img src=\"themes/codersheaven/images/pixel.gif\" height=\"10\" width=\"16\" alt=\"\"><img src=\"themes/codersheaven/images/llogo.gif\" alt=\"Bem Vindo ao $sitename\">&nbsp;<a href=\"index.php\" class=\"logo\" title=\"$slogan\">$sitename</a><br><img src=\"themes/codersheaven/images/pixel.gif\" height=\"10\" width=\"100%\" alt=\"\"></td><td valign=\"middle\">";
		if ($banners) {echo "<center>";
	include("banners.php"); echo"</center>";};
		echo"</td></tr></table></td><td bgcolor=\"#FFFFFF\"></td></tr></table></td></tr><tr><td valign=\"top\" width=\"100%\" bgcolor=\"ffffff\">
		<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>
		<td background=\"themes/codersheaven/images/menu_oben_bg.gif\" height=\"26\">";
		if ($username == "Anonymous") {
		echo "<img src=\"themes/codersheaven/images/pixel.gif\" height=\"10\" width=\"20\" alt=\"\">$sdata.";}//Menu
		else {echo"<img src=\"themes/codersheaven/images/pixel.gif\" height=\"10\" width=\"20\" alt=\"\">$sdata.";};
		echo"</td></tr></table></td></tr><tr><td>";
        echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"100%\"><tr><td valign=\"top\" width=\"160\" bgcolor=\"#F6F6F6\">";
    blocks(left);
    echo "<img src=\"images/pix.gif\" border=\"0\" width=\"150\" height=\"1\"></td><td><img src=\"themes/codersheaven/images/pixel.gif\" height=\"100%\" width=\"30\" alt=\"\"></td><td width=\"100%\" valign=\"top\">";
	$public_msg = public_message();
    echo "$public_msg<br>";
}

function themefooter() {
    global $index;
    if ($index == 1) {
	echo "</td><td><img src=\"themes/codersheaven/images/pixel.gif\" height=\"100%\" width=\"30\" alt=\"\"></td><td valign=\"top\" bgcolor=\"#F6F6F6\">";
	blocks(right);
	echo "</td>";
    } else {echo"</td><td><img src=\"themes/codersheaven/images/pixel.gif\" height=\"100%\" width=\"30\" alt=\"\"></td>";};
    echo "</td></tr></table></td></tr></table>
	<table border=\"0\" cellpadding=\"5\" cellspacing=\"0\" width=\"100%\">
	<tr><td bgcolor=\"#D8DFEC\" align=\"center\"><font class=\"footer\"><a href=\"http://hellnet.xpk.com.br\" target=\"_blank\">Themes/Layouts by HellNeT</a></font></td></tr></table><br><center>";
    footmsg();
	echo"</center>";
}

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous;
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=\"#cccccc\" width=\"100%\"><tr><td>"
        ."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" width=\"100%\"><tr><td bgcolor=\"#FFFFFF\">"
        ."<font class=\"newstitle\">$title</font></td></tr><tr><td bgcolor=\"#ffffff\">"
        ."<font class=\"tiny\">"
        .""._POSTEDBY." <b>";
    formatAidHeader($aid);
    echo "</b> "._ON." $time $timezone ($counter "._READS.")<br>"
	."<b>"._TOPIC."</b> <a href=\"modules.php?name=News&amp;new_topic=$topic\">$topictext</a><br>"
	."</font></td></tr><tr><td bgcolor=\"ffffff\"><font class=\"content\">";
    FormatStory($thetext, $notes, $aid, $informant);
    echo "<br>"
        ."</font></td></tr><tr><td bgcolor=\"ffffff\" align=\"right\">"
        ."<font class=\"content\">$morelink</font>"
        ."</td></tr></table></td></tr></table>"
	."<br>";
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $sid;
	OpenTable();
    if ("$aid" == "$informant") {
	echo"
	<table border=0 cellpadding=0 cellspacing=0 align=center bgcolor=ffffff width=100%><tr><td>
	<table border=0 cellpadding=3 cellspacing=0 width=100%><tr><td bgcolor=FFFFFF>
	<font class=\"newstitle\">$title</font><br><br><font class=tiny>Posted on $datetime";
	if ($admin) {
	    echo "&nbsp;&nbsp; $font2 [ <a href=admin.php?op=EditStory&sid=$sid>Edit</a> | <a href=admin.php?op=RemoveStory&sid=$sid>Delete</a> ]";
	}
	echo "
	<br>Topic: <a href=modules.php?name=News&amp;new_topic=$topic>$topictext</a>
	</td></tr><tr><td bgcolor=ffffff>
	$thetext
	</td></tr></table></td></tr></table><br>";
    } else {
	if($informant != "") $informant = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&username=$informant\">$informant</a> ";
	else $boxstuff = "$anonymous ";
	$boxstuff .= "writes <i>\"$thetext\"</i> $notes";
	echo "
	<table border=0 cellpadding=0 cellspacing=0 align=center bgcolor=000000 width=100%><tr><td>
	<table border=0 cellpadding=3 cellspacing=1 width=100%><tr><td bgcolor=FFFFFF>
	<b>$title</b><br><font class=content>Contributed by $informant on $datetime</font>";
	if ($admin) {
	    echo "&nbsp;&nbsp; $font2 [ <a href=admin.php?op=EditStory&sid=$sid>Edit</a> | <a href=admin.php?op=RemoveStory&sid=$sid>Delete</a> ]";
	}
	echo "
	<br>Topic: <a href=modules.php?name=News&amp;new_topic=$topic>$topictext</a>
	</td></tr><tr><td bgcolor=ffffff>
	$thetext
	</td></tr></table></td></tr></table><br>";
    }
	CloseTable();
}

function themesidebox($title, $content) {
    echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"160\" bgcolor=\"#F6F6F6\"><tr><td>"
        ."<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\"><tr><td bgcolor=\"#D8DFEC\" height=\"20\">"
        ."<font class=\"boxtitle\">$title</font></td></tr><tr><td bgcolor=\"#F6F6F6\"><font class=\"content\">"
        ."$content"
	."</font></td></tr></table></td></tr></table><img src=\"themes/codersheaven/images/pixel.gif\" height=\"30\" width=\"100%\" alt=\"\">";
}

?>