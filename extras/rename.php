<?php

require_once("config.php");

function main() {
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<LINK REL="StyleSheet" HREF="http://www.nukelite.xpk.com.br/themes/codersheaven/style/style.css" TYPE="text/css">
<title>Nuke Lite - Script para alterar o prefixo das tabelas do Banco de Dados</title>
</head>
<body topmargin="0" leftmargin="0">
<center>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td align="left" background="http://www.nukelite.xpk.com.br/themes/codersheaven/images/logo_bg.gif" height="50" valign="top"><br><br><font color="#ffffff"><h2>
<img src="http://www.nukelite.xpk.com.br/themes/codersheaven/images/llogo.gif" alt="Alteração dos Prefixos das Tabelas">&nbsp;Alteração dos Prefixos das Tabelas</font></h2>
</td></tr>
<tr>
<td height="8" nowrap colspan="3"></td>
</tr>
<tr><td><h3 align="center"><br>Este script foi escrito para alterar o<br>prefixo das tabelas em
<br>
Bancos de Dados do Nuke Lite.</h3></td>
<tr>
<td height="8" nowrap colspan="3">
</td>
</tr>
<tr>
<td align="center">Ele o ajudará a alterar o prefixo das tabelas de seu Banco de Dados, fornecendo uma maior 

proteção contra ataques de Injeção SQL e SL Flood.</td></tr>
<tr><td align="center"><br>Este script irá alterar <b>TODOS</b> os prefixos no Banco de Dados.<br><br>Há 

alguns raros Módulos que exigem que o prefixo seja <b>nuke</b>.<br><br>Ele irá reconhecê-lo e deixará os 

prefixos do jeito que ele deve ser. (Isso significa que o script faz as alterações apenas onde deverá fazer - 

O prefix´é escrito no arquivo config.php).</td></tr>
<tr><td align="center"><br><br><font color=red><b><b><u><big>ATENÇÃO:</u></big> FAÇA UM BACKUP DE SEU BANCO DE 

DADOS ANTES DE RODAR ESTE SCRIPT!</b></font><br><br><br></td></tr>
<center>
<form action="rename.php?go=reprefix" method="post">
      <table border="0" cellpadding="2" cellspacing="0" width="100%">
        <tr>
          <td align=right width="50%"><b>Por favor, digite o novo prefixo para as tabelas ($prefix):</b></td>
          <td width="45%"><input type="text" name="newprefix" size="30"></td>
          <td width="5%">&nbsp;</td>
        </tr>
        <tr>
          <td align=right width="50%"><b>Por favor, digite o novo prefixo para a tabelas dos usuários (

$user_prefix):</b></td>
          <td width="45%"><input type="text" name="newuserprefix" size="30"></td>
          <td width="5%">&nbsp;</td>
        </tr>
      </table><br>
<center><input type="submit" value="Alterar os prefixos!"></center>
</form>
</center>
</td>
  </tr>
</table><br>
<b>Adaptado e Corrigido por:</b>&nbsp;<a href="http://www.nukelite.xpk.com.br" target="blank">Giuliano Cardoso</a><br>
<b>Traduzido por:</b> <a href="http://phpnuke.org.br/modules.php?name=Forums&file=profile&mode=viewprofile&u=34" target="blank">aleagi</a> - <b>Implementações por:</b> <a href="http://phpnuke.org.br/modules.php?name=Forums&file=profile&mode=viewprofile&u=2583" target="blank">XPK_FENIX</a>.<br>Originalmente Desenvolvido por: RUS-Php-Nuke

<?
}


function reprefix() {
   
   	$newprefix = $_POST['newprefix'];
	$newuserprefix = $_POST['newuserprefix'];
    global $dbhost, $dbuname, $dbpass, $dbname, $prefix, $user_prefix;
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<LINK REL="StyleSheet" HREF="http://www.nukelite.xpk.com.br/themes/codersheaven/style/style.css" TYPE="text/css">
<title>Nuke Lite - Alteração de prefixo das tabelas do Nuke Lite</title>
</head>

<body topmargin="0" leftmargin="0">
<center>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td align="left" background="http://www.nukelite.xpk.com.br/themes/codersheaven/images/logo_bg.gif" height="50" 

valign="top"><br><br><font color="#ffffff"><h2>
<img src="http://www.nukelite.xpk.com.br/themes/codersheaven/images/llogo.gif" alt="Alteração dos Prefixos das Tabelas">&nbsp;Alteração dos Prefixos das Tabelas</font></h2></td></tr>
<tr>
<td height="8" nowrap colspan="3"></td>
</tr>
</table>
<center><h3>A alteração dos prefixos das tabelas do Banco de Dados ocorreu com <b>SUCESSO!</b></h3>
</center><br><br><br>
<b>Suas tabelas agora mudaram para:</b><br><br>
    
<?

    require_once("config.php");
    global $dbhost, $dbuname, $dbpass, $dbname, $prefix, $user_prefix;

    $cpr = strlen($prefix);
    $uscpr = strlen($user_prefix);
   
    if (!mysql_connect($dbhost, $dbuname, $dbpass)) {
        print 'Could not connect to mysql';
        exit;
    }

    $result = mysql_list_tables($dbname);
    
    if (!$result) {
        print "DB Error, could not list tables\n";
        print 'MySQL Error: ' . mysql_error();
        exit;
    }
    
    while ($row = mysql_fetch_row($result)) {
        $tabname = $row[0];

        $prlong = substr($tabname, 0, $cpr);
        $pruslong = substr($tabname, 0, $uscpr);

        if (($prefix == "$prlong") OR ($user_prefix == "$pruslong")) {
        
        if (($tabname == "".$user_prefix."_users") OR ($tabname == "".$user_prefix."_users_temp")) {
        $newtabname = substr($tabname, $uscpr);
        mysql_query("ALTER TABLE $tabname RENAME $newuserprefix$newtabname");
        echo "$newuserprefix$newtabname<br>";
        
        }
        else {
        $newtabname = substr($tabname, $cpr);
        mysql_query("ALTER TABLE $tabname RENAME $newprefix$newtabname");
        echo "$newprefix$newtabname<br>";
        
        }
        }
    }

    mysql_free_result($result);
?>
<br><font color=red><b><u><b>Nota!</b></u></font></b><br>Por favor, não se esqueça de atualizar o seu arquivo 

<b>config.php</b> com os novos valores:<br><b>
<br><br>$prefix = <? echo"$newprefix"; ?>;<br>
$user_prefix = <? echo"$newuserprefix"; ?>;<br></b><br>
E NÃO SE ESQUEÇA DE APAGAR ESTE ARQUIVO DE SEU SERVIDOR!!!
</p><br><br><br>
<center>
<b>Adaptado e Corrigido por:</b>&nbsp;<a href="http://www.nukelite.xpk.com.br" target="blank">Giuliano Cardoso</a><br>
<b>Traduzido por:</b> <a href="http://phpnuke.org.br/modules.php?name=Forums&file=profile&mode=viewprofile&u=34" target="blank">aleagi</a> - <b>Implementações por:</b> <a href="http://phpnuke.org.br/modules.php?name=Forums&file=profile&mode=viewprofile&u=2583" target="blank">XPK_FENIX</a>.<br>Originalmente Desenvolvido por: RUS-Php-Nuke
</td>
  </tr>
</table>
</center>
<?
}

$go = $_GET['go'];

switch($go) {

    case "reprefix":
    reprefix();
    break;

    
    default:
    main();
    break;
}

?>