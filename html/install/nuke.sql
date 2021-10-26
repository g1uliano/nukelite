    
CREATE TABLE `nuke_authors` (
  `aid` varchar(25) NOT NULL default '',
  `name` varchar(50) default NULL,
  `url` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `pwd` varchar(40) default NULL,
  `counter` int(11) NOT NULL default '0',
  `radminsuper` tinyint(1) NOT NULL default '1',
  `admlanguage` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`aid`),
  KEY `aid` (`aid`)
) TYPE=MyISAM;


CREATE TABLE `nuke_autonews` (
  `anid` int(11) NOT NULL auto_increment,
  `catid` int(11) NOT NULL default '0',
  `aid` varchar(30) NOT NULL default '',
  `title` varchar(80) NOT NULL default '',
  `time` varchar(19) NOT NULL default '',
  `hometext` text NOT NULL,
  `bodytext` text NOT NULL,
  `topic` int(3) NOT NULL default '1',
  `informant` varchar(20) NOT NULL default '',
  `notes` text NOT NULL,
  `ihome` int(1) NOT NULL default '0',
  `alanguage` varchar(30) NOT NULL default '',
  `acomm` int(1) NOT NULL default '0',
  `associated` text NOT NULL,
  PRIMARY KEY  (`anid`),
  KEY `anid` (`anid`)
) TYPE=MyISAM;


CREATE TABLE `nuke_banned_ip` (
  `id` int(11) NOT NULL auto_increment,
  `ip_address` varchar(15) NOT NULL default '',
  `reason` varchar(255) NOT NULL default '',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) TYPE=MyISAM;


CREATE TABLE `nuke_banner` (
  `bid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `imptotal` int(11) NOT NULL default '0',
  `impmade` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  `imageurl` varchar(100) NOT NULL default '',
  `clickurl` varchar(200) NOT NULL default '',
  `alttext` varchar(255) NOT NULL default '',
  `date` datetime default NULL,
  `dateend` datetime default NULL,
  `type` tinyint(1) NOT NULL default '0',
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`bid`),
  KEY `bid` (`bid`),
  KEY `cid` (`cid`)
) TYPE=MyISAM;


CREATE TABLE `nuke_bannerclient` (
  `cid` int(11) NOT NULL auto_increment,
  `name` varchar(60) NOT NULL default '',
  `contact` varchar(60) NOT NULL default '',
  `email` varchar(60) NOT NULL default '',
  `login` varchar(10) NOT NULL default '',
  `passwd` varchar(10) NOT NULL default '',
  `extrainfo` text NOT NULL,
  PRIMARY KEY  (`cid`),
  KEY `cid` (`cid`)
) TYPE=MyISAM;


CREATE TABLE `nuke_blocks` (
  `bid` int(10) NOT NULL auto_increment,
  `bkey` varchar(15) NOT NULL default '',
  `title` varchar(60) NOT NULL default '',
  `content` text NOT NULL,
  `url` varchar(200) NOT NULL default '',
  `bposition` char(1) NOT NULL default '',
  `weight` int(10) NOT NULL default '1',
  `active` int(1) NOT NULL default '1',
  `refresh` int(10) NOT NULL default '0',
  `time` varchar(14) NOT NULL default '0',
  `blanguage` varchar(30) NOT NULL default '',
  `blockfile` varchar(255) NOT NULL default '',
  `view` int(1) NOT NULL default '0',
  `expire` varchar(14) NOT NULL default '0',
  `action` char(1) NOT NULL default '',
  `subscription` int(1) NOT NULL default '0',
  PRIMARY KEY  (`bid`),
  KEY `bid` (`bid`),
  KEY `title` (`title`)
) TYPE=MyISAM;

INSERT INTO `nuke_blocks` VALUES (1, '', 'Menu Principal', '', '', 'l', 1, 1, 0, '', '', 'block-Modules.php', 0, '0', 'd', 0);
INSERT INTO `nuke_blocks` VALUES (16, '', 'Administração', '<strong><big>.</big></strong> <a href="admin.php">Administração</a><br>\r\n<strong><big>.</big></strong> <a href="admin.php?op=BlocksAdmin">Admin Blocos</a><br>\r\n<strong><big>.</big></strong> <a href="admin.php?op=modules">Admin Módulos</a><br>\r\n<strong><big>.</big></strong> <a href="admin.php?op=adminStory">Nova Notícia</a><br>\r\n<strong><big>.</big></strong> <a href="admin.php?op=create">Mudar Pesquisa</a><br>\r\n<strong><big>.</big></strong> <a href="admin.php?op=logout">Sair</a>', '', 'l', 2, 1, 0, '', '', '', 2, '0', 'd', 0);
INSERT INTO `nuke_blocks` VALUES (4, '', 'Busca', '', '', 'l', 3, 1, 3600, '', '', 'block-Search.php', 0, '0', 'd', 0);
INSERT INTO `nuke_blocks` VALUES (6, '', 'Notícias Aleatórias', '', '', 'l', 4, 0, 0, '', '', 'block-Random_Headlines.php', 0, '0', 'd', 0);
INSERT INTO `nuke_blocks` VALUES (9, '', 'Menu de Categorias', '', '', 'r', 1, 0, 0, '', '', 'block-Categories.php', 0, '0', 'd', 0);
INSERT INTO `nuke_blocks` VALUES (10, '', 'Enquete', '', '', 'r', 2, 1, 3600, '', '', 'block-Survey.php', 0, '0', 'd', 0);
INSERT INTO `nuke_blocks` VALUES (12, '', 'Notícia de Hoje', '', '', 'r', 3, 1, 0, '', '', 'block-Big_Story_of_Today.php', 0, '0', 'd', 0);
INSERT INTO `nuke_blocks` VALUES (13, '', 'Top 10 Downloads', '', '', 'r', 4, 0, 0, '', '', 'block-Top10_Downloads.php', 0, '0', 'd', 0);


CREATE TABLE `nuke_config` (
  `sitename` varchar(255) NOT NULL default '',
  `nukeurl` varchar(255) NOT NULL default '',
  `site_logo` varchar(255) NOT NULL default '',
  `slogan` varchar(255) NOT NULL default '',
  `startdate` varchar(50) NOT NULL default '',
  `adminmail` varchar(255) NOT NULL default '',
  `anonpost` tinyint(1) NOT NULL default '0',
  `Default_Theme` varchar(255) NOT NULL default '',
  `foot1` text NOT NULL,
  `foot2` text NOT NULL,
  `foot3` text NOT NULL,
  `commentlimit` int(9) NOT NULL default '4096',
  `anonymous` varchar(255) NOT NULL default '',
  `minpass` tinyint(1) NOT NULL default '5',
  `pollcomm` tinyint(1) NOT NULL default '1',
  `articlecomm` tinyint(1) NOT NULL default '1',
  `broadcast_msg` tinyint(1) NOT NULL default '1',
  `my_headlines` tinyint(1) NOT NULL default '1',
  `top` int(3) NOT NULL default '10',
  `storyhome` int(2) NOT NULL default '10',
  `user_news` tinyint(1) NOT NULL default '1',
  `oldnum` int(2) NOT NULL default '30',
  `ultramode` tinyint(1) NOT NULL default '0',
  `banners` tinyint(1) NOT NULL default '1',
  `backend_title` varchar(255) NOT NULL default '',
  `backend_language` varchar(10) NOT NULL default '',
  `language` varchar(100) NOT NULL default '',
  `locale` varchar(10) NOT NULL default '',
  `multilingual` tinyint(1) NOT NULL default '1',
  `useflags` tinyint(1) NOT NULL default '1',
  `notify` tinyint(1) NOT NULL default '0',
  `notify_email` varchar(255) NOT NULL default '',
  `notify_subject` varchar(255) NOT NULL default '',
  `notify_message` varchar(255) NOT NULL default '',
  `notify_from` varchar(255) NOT NULL default '',
  `moderate` tinyint(1) NOT NULL default '0',
  `admingraphic` tinyint(1) NOT NULL default '1',
  `httpref` tinyint(1) NOT NULL default '0',
  `httprefmax` int(5) NOT NULL default '1000',
  `CensorMode` tinyint(1) NOT NULL default '3',
  `CensorReplace` varchar(10) NOT NULL default '',
  `copyright` text NOT NULL,
  `Version_Num` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`sitename`)
) TYPE=MyISAM;

INSERT INTO `nuke_config` VALUES ('Nuke Lite 1.1', 'http://seusite.com', 'logo.gif', 'The Future of The Web', 'Setembro de 2004', 'webmaster@seusite.com', 0, 'codersheaven', '<b>Os logotipos e marcas deste site são propriedades de seus respectivos donos.</b>', 'Publique nossas noticias em seu site usando este link <a href="backend.php"><font class="footmsg_l">backend.php</font></a>.', '', 0, '', 0, 0, 0, 0, 0, 10, 10, 0, 30, 0, 1, '98', 'brazilian', 'brazilian', 'pt_BR', 0, 0, 0, '', '', '', '', 0, 1, 0, 0, 0, '', 'Copyright &copy; 2003 by <a href="http://phpnuke.org"><font class="footmsg_l">PHP-Nuke</font></a>. PHP-Nuke ? FREE distribuido soblicen?a <a href="http://www.gnu.org"><font class="footmsg_l">GNU/GPL</font></a>.', '7.5');

CREATE TABLE `nuke_confirm` (
  `confirm_id` char(32) NOT NULL default '',
  `session_id` char(32) NOT NULL default '',
  `code` char(6) NOT NULL default '',
  PRIMARY KEY  (`session_id`,`confirm_id`)
) TYPE=MyISAM;

CREATE TABLE `nuke_counter` (
  `type` varchar(80) NOT NULL default '',
  `var` varchar(80) NOT NULL default '',
  `count` int(10) unsigned NOT NULL default '0'
) TYPE=MyISAM;

INSERT INTO `nuke_counter` VALUES ('total', 'hits', 279);
INSERT INTO `nuke_counter` VALUES ('browser', 'WebTV', 0);
INSERT INTO `nuke_counter` VALUES ('browser', 'Lynx', 0);
INSERT INTO `nuke_counter` VALUES ('browser', 'MSIE', 1);
INSERT INTO `nuke_counter` VALUES ('browser', 'Opera', 0);
INSERT INTO `nuke_counter` VALUES ('browser', 'Konqueror', 8);
INSERT INTO `nuke_counter` VALUES ('browser', 'Netscape', 271);
INSERT INTO `nuke_counter` VALUES ('browser', 'Bot', 0);
INSERT INTO `nuke_counter` VALUES ('browser', 'Other', 0);
INSERT INTO `nuke_counter` VALUES ('os', 'Windows', 1);
INSERT INTO `nuke_counter` VALUES ('os', 'Linux', 279);
INSERT INTO `nuke_counter` VALUES ('os', 'Mac', 0);
INSERT INTO `nuke_counter` VALUES ('os', 'FreeBSD', 0);
INSERT INTO `nuke_counter` VALUES ('os', 'SunOS', 0);
INSERT INTO `nuke_counter` VALUES ('os', 'IRIX', 0);
INSERT INTO `nuke_counter` VALUES ('os', 'BeOS', 0);
INSERT INTO `nuke_counter` VALUES ('os', 'OS/2', 0);
INSERT INTO `nuke_counter` VALUES ('os', 'AIX', 0);
INSERT INTO `nuke_counter` VALUES ('os', 'Other', 0);

CREATE TABLE `nuke_downloads_categories` (
  `cid` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL default '',
  `cdescription` text NOT NULL,
  `parentid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`cid`),
  KEY `cid` (`cid`),
  KEY `title` (`title`)
) TYPE=MyISAM;

CREATE TABLE `nuke_downloads_downloads` (
  `lid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `sid` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `url` varchar(100) NOT NULL default '',
  `description` text NOT NULL,
  `date` datetime default NULL,
  `name` varchar(100) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `hits` int(11) NOT NULL default '0',
  `submitter` varchar(60) NOT NULL default '',
  `downloadratingsummary` double(6,4) NOT NULL default '0.0000',
  `totalvotes` int(11) NOT NULL default '0',
  `totalcomments` int(11) NOT NULL default '0',
  `filesize` int(11) NOT NULL default '0',
  `version` varchar(10) NOT NULL default '',
  `homepage` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`lid`),
  KEY `lid` (`lid`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`),
  KEY `title` (`title`)
) TYPE=MyISAM;

CREATE TABLE `nuke_downloads_editorials` (
  `downloadid` int(11) NOT NULL default '0',
  `adminid` varchar(60) NOT NULL default '',
  `editorialtimestamp` datetime NOT NULL default '0000-00-00 00:00:00',
  `editorialtext` text NOT NULL,
  `editorialtitle` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`downloadid`),
  KEY `downloadid` (`downloadid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_downloads_modrequest` (
  `requestid` int(11) NOT NULL auto_increment,
  `lid` int(11) NOT NULL default '0',
  `cid` int(11) NOT NULL default '0',
  `sid` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `url` varchar(100) NOT NULL default '',
  `description` text NOT NULL,
  `modifysubmitter` varchar(60) NOT NULL default '',
  `brokendownload` int(3) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `filesize` int(11) NOT NULL default '0',
  `version` varchar(10) NOT NULL default '',
  `homepage` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`requestid`),
  UNIQUE KEY `requestid` (`requestid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_downloads_newdownload` (
  `lid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `sid` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `url` varchar(100) NOT NULL default '',
  `description` text NOT NULL,
  `name` varchar(100) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `submitter` varchar(60) NOT NULL default '',
  `filesize` int(11) NOT NULL default '0',
  `version` varchar(10) NOT NULL default '',
  `homepage` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`lid`),
  KEY `lid` (`lid`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`),
  KEY `title` (`title`)
) TYPE=MyISAM;


CREATE TABLE `nuke_downloads_votedata` (
  `ratingdbid` int(11) NOT NULL auto_increment,
  `ratinglid` int(11) NOT NULL default '0',
  `ratinguser` varchar(60) NOT NULL default '',
  `rating` int(11) NOT NULL default '0',
  `ratinghostname` varchar(60) NOT NULL default '',
  `ratingcomments` text NOT NULL,
  `ratingtimestamp` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ratingdbid`),
  KEY `ratingdbid` (`ratingdbid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_headlines` (
  `hid` int(11) NOT NULL auto_increment,
  `sitename` varchar(30) NOT NULL default '',
  `headlinesurl` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`hid`),
  KEY `hid` (`hid`)
) TYPE=MyISAM;

INSERT INTO `nuke_headlines` VALUES (1, '100graus PHP-Nuke', 'http://100graus.com/backend.php');
INSERT INTO `nuke_headlines` VALUES (2, 'BSDToday', 'http://www.bsdtoday.com/backend/bt.rdf');
INSERT INTO `nuke_headlines` VALUES (3, 'BrunchingShuttlecocks', 'http://www.brunching.com/brunching.rdf');
INSERT INTO `nuke_headlines` VALUES (4, 'DailyDaemonNews', 'http://daily.daemonnews.org/ddn.rdf.php3');
INSERT INTO `nuke_headlines` VALUES (5, 'DigitalTheatre', 'http://www.dtheatre.com/backend.php3?xml=yes');
INSERT INTO `nuke_headlines` VALUES (6, 'DotKDE', 'http://dot.kde.org/rdf');
INSERT INTO `nuke_headlines` VALUES (7, 'FreeDOS', 'http://www.freedos.org/channels/rss.cgi');
INSERT INTO `nuke_headlines` VALUES (8, 'Freshmeat', 'http://freshmeat.net/backend/fm.rdf');
INSERT INTO `nuke_headlines` VALUES (9, 'Gnome Desktop', 'http://www.gnomedesktop.org/backend.php');
INSERT INTO `nuke_headlines` VALUES (10, 'HappyPenguin', 'http://happypenguin.org/html/news.rdf');
INSERT INTO `nuke_headlines` VALUES (11, 'HollywoodBitchslap', 'http://hollywoodbitchslap.com/hbs.rdf');
INSERT INTO `nuke_headlines` VALUES (12, 'Learning Linux', 'http://www.learninglinux.com/backend.php');
INSERT INTO `nuke_headlines` VALUES (13, 'LinuxCentral', 'http://linuxcentral.com/backend/lcnew.rdf');
INSERT INTO `nuke_headlines` VALUES (14, 'LinuxJournal', 'http://www.linuxjournal.com/news.rss');
INSERT INTO `nuke_headlines` VALUES (15, 'LinuxWeelyNews', 'http://lwn.net/headlines/rss');
INSERT INTO `nuke_headlines` VALUES (16, 'Listology', 'http://listology.com/recent.rdf');
INSERT INTO `nuke_headlines` VALUES (17, 'MozillaNewsBot', 'http://www.mozilla.org/newsbot/newsbot.rdf');
INSERT INTO `nuke_headlines` VALUES (18, 'NewsForge', 'http://www.newsforge.com/newsforge.rdf');
INSERT INTO `nuke_headlines` VALUES (19, 'NukeResources', 'http://www.nukeresources.com/backend.php');
INSERT INTO `nuke_headlines` VALUES (20, 'NukeScripts', 'http://www.nukescripts.net/backend.php');
INSERT INTO `nuke_headlines` VALUES (21, 'PDABuzz', 'http://www.pdabuzz.com/netscape.txt');
INSERT INTO `nuke_headlines` VALUES (22, 'PHP-Nuke', 'http://phpnuke.org/backend.php');
INSERT INTO `nuke_headlines` VALUES (23, 'PHP.net', 'http://www.php.net/news.rss');
INSERT INTO `nuke_headlines` VALUES (24, 'PHPBuilder', 'http://phpbuilder.com/rss_feed.php');
INSERT INTO `nuke_headlines` VALUES (25, 'PerlMonks', 'http://www.perlmonks.org/headlines.rdf');
INSERT INTO `nuke_headlines` VALUES (26, 'TheNextLevel', 'http://www.the-nextlevel.com/rdf/tnl.rdf');
INSERT INTO `nuke_headlines` VALUES (27, 'WebReference', 'http://webreference.com/webreference.rdf');

CREATE TABLE `nuke_links_categories` (
  `cid` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL default '',
  `cdescription` text NOT NULL,
  `parentid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`cid`),
  KEY `cid` (`cid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_links_editorials` (
  `linkid` int(11) NOT NULL default '0',
  `adminid` varchar(60) NOT NULL default '',
  `editorialtimestamp` datetime NOT NULL default '0000-00-00 00:00:00',
  `editorialtext` text NOT NULL,
  `editorialtitle` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`linkid`),
  KEY `linkid` (`linkid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_links_links` (
  `lid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `sid` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `url` varchar(100) NOT NULL default '',
  `description` text NOT NULL,
  `date` datetime default NULL,
  `name` varchar(100) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `hits` int(11) NOT NULL default '0',
  `submitter` varchar(60) NOT NULL default '',
  `linkratingsummary` double(6,4) NOT NULL default '0.0000',
  `totalvotes` int(11) NOT NULL default '0',
  `totalcomments` int(11) NOT NULL default '0',
  PRIMARY KEY  (`lid`),
  KEY `lid` (`lid`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_links_modrequest` (
  `requestid` int(11) NOT NULL auto_increment,
  `lid` int(11) NOT NULL default '0',
  `cid` int(11) NOT NULL default '0',
  `sid` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `url` varchar(100) NOT NULL default '',
  `description` text NOT NULL,
  `modifysubmitter` varchar(60) NOT NULL default '',
  `brokenlink` int(3) NOT NULL default '0',
  PRIMARY KEY  (`requestid`),
  UNIQUE KEY `requestid` (`requestid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_links_newlink` (
  `lid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `sid` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `url` varchar(100) NOT NULL default '',
  `description` text NOT NULL,
  `name` varchar(100) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `submitter` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`lid`),
  KEY `lid` (`lid`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_links_votedata` (
  `ratingdbid` int(11) NOT NULL auto_increment,
  `ratinglid` int(11) NOT NULL default '0',
  `ratinguser` varchar(60) NOT NULL default '',
  `rating` int(11) NOT NULL default '0',
  `ratinghostname` varchar(60) NOT NULL default '',
  `ratingcomments` text NOT NULL,
  `ratingtimestamp` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ratingdbid`),
  KEY `ratingdbid` (`ratingdbid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_main` (
  `main_module` varchar(255) NOT NULL default ''
) TYPE=MyISAM;

INSERT INTO `nuke_main` VALUES ('News');

CREATE TABLE `nuke_message` (
  `mid` int(11) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `content` text NOT NULL,
  `date` varchar(14) NOT NULL default '',
  `expire` int(7) NOT NULL default '0',
  `active` int(1) NOT NULL default '1',
  `view` int(1) NOT NULL default '1',
  `mlanguage` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`mid`),
  UNIQUE KEY `mid` (`mid`)
) TYPE=MyISAM;


INSERT INTO `nuke_message` VALUES (1, 'Bem Vindo ao Nuke Lite 1.1', '<p align="justify">A HellNeT desenvolveu esta versão clean do Php-Nuke com o intuito de ajudar no desenvolvimento de sites que não necessitam de sistemas de usuário ou fórum, porém querem ter suporte a alguns módulos do Php-Nuke ao mesmo tempo, com esta versão é possivel, já que ela é compativel com a maioria dos módulos de Php-Nuke 7.5 e acima.<br><br>\r\nA versão original do Php-Nuke já vem com suporte nativo a usuários e por esse motivo, mesmo que você desative alguns módulos como o Your Account, haverão algumas incompatibilidades e limitações e você é obrigado a usar um sistema de usuários no seu site, então o Nuke Lite torna-se assim uma alternativa para quem não quer ter um sistemas de usuários em seu site e quer usar o Php-Nuke.<br><br>\r\nA Administração também ficou mais limpa e com menas "frescuras", foram retirados alguns módulos desnecessários, porém acredito que a partir da próxima versão ela virá com alguns módulos nacionais como o CNB Conteudo.<br><br>Para criar um super usuário clique <a href="admin.php">aqui</a>.', '993373194', 0, 1, 1, '');

CREATE TABLE `nuke_modules` (
  `mid` int(10) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `custom_title` varchar(255) NOT NULL default '',
  `active` int(1) NOT NULL default '0',
  `view` int(1) NOT NULL default '0',
  `inmenu` tinyint(1) NOT NULL default '1',
  `mod_group` int(10) default '0',
  `admins` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`mid`),
  KEY `mid` (`mid`),
  KEY `title` (`title`),
  KEY `custom_title` (`custom_title`)
) TYPE=MyISAM;

INSERT INTO `nuke_modules` VALUES (1, 'AvantGo', 'AvantGo', 0, 0, 1, 0, '');
INSERT INTO `nuke_modules` VALUES (3, 'Downloads', 'Downloads', 1, 0, 1, 0, '');
INSERT INTO `nuke_modules` VALUES (6, 'Feedback', 'Comentários', 1, 0, 1, 0, '');
INSERT INTO `nuke_modules` VALUES (10, 'News', 'Notícias', 1, 0, 1, 0, '');
INSERT INTO `nuke_modules` VALUES (12, 'Recommend_Us', 'Recomende-nos', 1, 0, 1, 0, '');
INSERT INTO `nuke_modules` VALUES (14, 'Search', 'Busca', 1, 0, 1, 0, '');
INSERT INTO `nuke_modules` VALUES (15, 'Statistics', 'Estatísticas', 1, 0, 1, 0, '');
INSERT INTO `nuke_modules` VALUES (16, 'Stories_Archive', 'Arquivo de Notícias', 1, 0, 1, 0, '');
INSERT INTO `nuke_modules` VALUES (18, 'Surveys', 'Enquetes', 1, 0, 1, 0, '');
INSERT INTO `nuke_modules` VALUES (19, 'Top', 'Top 10', 1, 0, 1, 0, '');
INSERT INTO `nuke_modules` VALUES (20, 'Topics', 'Tópicos', 1, 0, 1, 0, '');
INSERT INTO `nuke_modules` VALUES (21, 'Web_Links', 'Web Links', 1, 0, 1, 0, '');

CREATE TABLE `nuke_optimize_gain` (
  `gain` decimal(10,3) default NULL
) TYPE=MyISAM;

INSERT INTO `nuke_optimize_gain` VALUES (0.000);

CREATE TABLE `nuke_pages` (
  `pid` int(10) NOT NULL auto_increment,
  `cid` int(10) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `subtitle` varchar(255) NOT NULL default '',
  `active` int(1) NOT NULL default '0',
  `page_header` text NOT NULL,
  `text` text NOT NULL,
  `page_footer` text NOT NULL,
  `signature` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `counter` int(10) NOT NULL default '0',
  `clanguage` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`pid`),
  KEY `pid` (`pid`),
  KEY `cid` (`cid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_pages_categories` (
  `cid` int(10) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  PRIMARY KEY  (`cid`),
  KEY `cid` (`cid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_poll_check` (
  `ip` varchar(20) NOT NULL default '',
  `time` varchar(14) NOT NULL default '',
  `pollID` int(10) NOT NULL default '0'
) TYPE=MyISAM;

CREATE TABLE `nuke_poll_data` (
  `pollID` int(11) NOT NULL default '0',
  `optionText` char(50) NOT NULL default '',
  `optionCount` int(11) NOT NULL default '0',
  `voteID` int(11) NOT NULL default '0'
) TYPE=MyISAM;

INSERT INTO `nuke_poll_data` VALUES (1, 'Ummm, nada mau', 0, 1);
INSERT INTO `nuke_poll_data` VALUES (1, 'Bom', 0, 2);
INSERT INTO `nuke_poll_data` VALUES (1, 'Muito bom', 0, 3);
INSERT INTO `nuke_poll_data` VALUES (1, 'O melhor!', 0, 4);
INSERT INTO `nuke_poll_data` VALUES (1, 'Quem fez isso?!!', 0, 5);
INSERT INTO `nuke_poll_data` VALUES (1, '', 0, 6);
INSERT INTO `nuke_poll_data` VALUES (1, '', 0, 7);
INSERT INTO `nuke_poll_data` VALUES (1, '', 0, 8);
INSERT INTO `nuke_poll_data` VALUES (1, '', 0, 9);
INSERT INTO `nuke_poll_data` VALUES (1, '', 0, 10);
INSERT INTO `nuke_poll_data` VALUES (1, '', 0, 11);
INSERT INTO `nuke_poll_data` VALUES (1, '', 0, 12);

CREATE TABLE `nuke_poll_desc` (
  `pollID` int(11) NOT NULL auto_increment,
  `pollTitle` varchar(100) NOT NULL default '',
  `timeStamp` int(11) NOT NULL default '0',
  `voters` mediumint(9) NOT NULL default '0',
  `planguage` varchar(30) NOT NULL default '',
  `artid` int(10) NOT NULL default '0',
  PRIMARY KEY  (`pollID`),
  KEY `pollID` (`pollID`)
) TYPE=MyISAM;

INSERT INTO `nuke_poll_desc` VALUES (1, 'O que acha desse site?', 961405160, 0, 'brazilian', 0);

CREATE TABLE `nuke_pollcomments` (
  `tid` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `pollID` int(11) NOT NULL default '0',
  `date` datetime default NULL,
  `name` varchar(60) NOT NULL default '',
  `email` varchar(60) default NULL,
  `url` varchar(60) default NULL,
  `host_name` varchar(60) default NULL,
  `subject` varchar(60) NOT NULL default '',
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL default '0',
  `reason` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`tid`),
  KEY `tid` (`tid`),
  KEY `pid` (`pid`),
  KEY `pollID` (`pollID`)
) TYPE=MyISAM;

CREATE TABLE `nuke_public_messages` (
  `mid` int(10) NOT NULL auto_increment,
  `content` varchar(255) NOT NULL default '',
  `date` varchar(14) default NULL,
  `who` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`mid`),
  KEY `mid` (`mid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_queue` (
  `qid` smallint(5) unsigned NOT NULL auto_increment,
  `uid` mediumint(9) NOT NULL default '0',
  `uname` varchar(40) NOT NULL default '',
  `subject` varchar(100) NOT NULL default '',
  `story` text,
  `storyext` text NOT NULL,
  `timestamp` datetime NOT NULL default '0000-00-00 00:00:00',
  `topic` varchar(20) NOT NULL default '',
  `alanguage` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`qid`),
  KEY `qid` (`qid`),
  KEY `uid` (`uid`),
  KEY `uname` (`uname`)
) TYPE=MyISAM;

CREATE TABLE `nuke_quotes` (
  `qid` int(10) unsigned NOT NULL auto_increment,
  `quote` text,
  PRIMARY KEY  (`qid`),
  KEY `qid` (`qid`)
) TYPE=MyISAM;

INSERT INTO `nuke_quotes` VALUES (1, 'Nos morituri te salutamus - CBHS');

CREATE TABLE `nuke_referer` (
  `rid` int(11) NOT NULL auto_increment,
  `url` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`rid`),
  KEY `rid` (`rid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_related` (
  `rid` int(11) NOT NULL auto_increment,
  `tid` int(11) NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `url` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`rid`),
  KEY `rid` (`rid`),
  KEY `tid` (`tid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_session` (
  `uname` varchar(25) NOT NULL default '',
  `time` varchar(14) NOT NULL default '',
  `host_addr` varchar(48) NOT NULL default '',
  `guest` int(1) NOT NULL default '0',
  KEY `time` (`time`),
  KEY `guest` (`guest`)
) TYPE=MyISAM;

INSERT INTO `nuke_session` VALUES ('127.0.0.1', '1105801661', '127.0.0.1', 1);

CREATE TABLE `nuke_stats_date` (
  `year` smallint(6) NOT NULL default '0',
  `month` tinyint(4) NOT NULL default '0',
  `date` tinyint(4) NOT NULL default '0',
  `hits` bigint(20) NOT NULL default '0'
) TYPE=MyISAM;

INSERT INTO `nuke_stats_date` VALUES (2004, 1, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 1, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 2, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 3, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 4, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 5, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 6, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 7, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 8, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 9, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 5, 4);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 10, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 11, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2004, 12, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 12, 55);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 13, 172);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 14, 4);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 15, 48);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 1, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 2, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 3, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 4, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 5, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 6, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 7, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 8, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 9, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 10, 31, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 11, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 1, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 2, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 3, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 4, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 5, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 6, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 7, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 8, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 9, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 10, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 11, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 12, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 13, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 14, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 15, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 16, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 17, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 18, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 19, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 20, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 21, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 22, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 23, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 24, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 25, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 26, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 27, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 28, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 29, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 30, 0);
INSERT INTO `nuke_stats_date` VALUES (2005, 12, 31, 0);

CREATE TABLE `nuke_stats_hour` (
  `year` smallint(6) NOT NULL default '0',
  `month` tinyint(4) NOT NULL default '0',
  `date` tinyint(4) NOT NULL default '0',
  `hour` tinyint(4) NOT NULL default '0',
  `hits` int(11) NOT NULL default '0'
) TYPE=MyISAM;

INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 0, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 1, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 2, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 3, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 4, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 5, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 6, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 7, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 8, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 9, 3);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 10, 1);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 11, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 12, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 13, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 14, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 15, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 16, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 17, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 18, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 19, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 20, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 21, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 22, 0);
INSERT INTO `nuke_stats_hour` VALUES (2004, 10, 5, 23, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 0, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 1, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 2, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 3, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 4, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 5, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 6, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 7, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 8, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 9, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 10, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 11, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 12, 25);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 13, 10);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 14, 19);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 15, 1);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 16, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 17, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 18, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 19, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 20, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 21, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 22, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 12, 23, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 0, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 1, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 2, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 3, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 4, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 5, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 6, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 7, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 8, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 9, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 10, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 11, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 12, 69);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 13, 47);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 14, 56);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 15, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 16, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 17, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 18, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 19, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 20, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 21, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 22, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 13, 23, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 0, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 1, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 2, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 3, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 4, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 5, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 6, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 7, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 8, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 9, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 10, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 11, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 12, 4);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 13, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 14, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 15, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 16, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 17, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 18, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 19, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 20, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 21, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 22, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 14, 23, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 0, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 1, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 2, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 3, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 4, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 5, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 6, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 7, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 8, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 9, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 10, 7);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 11, 32);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 12, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 13, 9);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 14, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 15, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 16, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 17, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 18, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 19, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 20, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 21, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 22, 0);
INSERT INTO `nuke_stats_hour` VALUES (2005, 1, 15, 23, 0);

CREATE TABLE `nuke_stats_month` (
  `year` smallint(6) NOT NULL default '0',
  `month` tinyint(4) NOT NULL default '0',
  `hits` bigint(20) NOT NULL default '0'
) TYPE=MyISAM;

INSERT INTO `nuke_stats_month` VALUES (2004, 1, 0);
INSERT INTO `nuke_stats_month` VALUES (2004, 2, 0);
INSERT INTO `nuke_stats_month` VALUES (2004, 3, 0);
INSERT INTO `nuke_stats_month` VALUES (2004, 4, 0);
INSERT INTO `nuke_stats_month` VALUES (2004, 5, 0);
INSERT INTO `nuke_stats_month` VALUES (2004, 6, 0);
INSERT INTO `nuke_stats_month` VALUES (2004, 7, 0);
INSERT INTO `nuke_stats_month` VALUES (2004, 8, 0);
INSERT INTO `nuke_stats_month` VALUES (2004, 9, 0);
INSERT INTO `nuke_stats_month` VALUES (2004, 10, 4);
INSERT INTO `nuke_stats_month` VALUES (2004, 11, 0);
INSERT INTO `nuke_stats_month` VALUES (2004, 12, 0);
INSERT INTO `nuke_stats_month` VALUES (2005, 1, 279);
INSERT INTO `nuke_stats_month` VALUES (2005, 2, 0);
INSERT INTO `nuke_stats_month` VALUES (2005, 3, 0);
INSERT INTO `nuke_stats_month` VALUES (2005, 4, 0);
INSERT INTO `nuke_stats_month` VALUES (2005, 5, 0);
INSERT INTO `nuke_stats_month` VALUES (2005, 6, 0);
INSERT INTO `nuke_stats_month` VALUES (2005, 7, 0);
INSERT INTO `nuke_stats_month` VALUES (2005, 8, 0);
INSERT INTO `nuke_stats_month` VALUES (2005, 9, 0);
INSERT INTO `nuke_stats_month` VALUES (2005, 10, 0);
INSERT INTO `nuke_stats_month` VALUES (2005, 11, 0);
INSERT INTO `nuke_stats_month` VALUES (2005, 12, 0);

CREATE TABLE `nuke_stats_year` (
  `year` smallint(6) NOT NULL default '0',
  `hits` bigint(20) NOT NULL default '0'
) TYPE=MyISAM;

INSERT INTO `nuke_stats_year` VALUES (2004, 4);
INSERT INTO `nuke_stats_year` VALUES (2005, 279);

CREATE TABLE `nuke_stories` (
  `sid` int(11) NOT NULL auto_increment,
  `catid` int(11) NOT NULL default '0',
  `aid` varchar(30) NOT NULL default '',
  `title` varchar(80) default NULL,
  `time` datetime default NULL,
  `hometext` text,
  `bodytext` text NOT NULL,
  `comments` int(11) default '0',
  `counter` mediumint(8) unsigned default NULL,
  `topic` int(3) NOT NULL default '1',
  `informant` varchar(20) NOT NULL default '',
  `notes` text NOT NULL,
  `ihome` int(1) NOT NULL default '0',
  `alanguage` varchar(30) NOT NULL default '',
  `acomm` int(1) NOT NULL default '0',
  `haspoll` int(1) NOT NULL default '0',
  `pollID` int(10) NOT NULL default '0',
  `score` int(10) NOT NULL default '0',
  `ratings` int(10) NOT NULL default '0',
  `associated` text NOT NULL,
  PRIMARY KEY  (`sid`),
  KEY `sid` (`sid`),
  KEY `catid` (`catid`),
  KEY `counter` (`counter`),
  KEY `topic` (`topic`)
) TYPE=MyISAM;

CREATE TABLE `nuke_stories_cat` (
  `catid` int(11) NOT NULL auto_increment,
  `title` varchar(20) NOT NULL default '',
  `counter` int(11) NOT NULL default '0',
  PRIMARY KEY  (`catid`),
  KEY `catid` (`catid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_subscriptions` (
  `id` int(10) NOT NULL auto_increment,
  `userid` int(10) default '0',
  `subscription_expire` varchar(50) NOT NULL default '',
  KEY `id` (`id`,`userid`)
) TYPE=MyISAM;

CREATE TABLE `nuke_topics` (
  `topicid` int(3) NOT NULL auto_increment,
  `topicname` varchar(20) default NULL,
  `topicimage` varchar(20) default NULL,
  `topictext` varchar(40) default NULL,
  `counter` int(11) NOT NULL default '0',
  PRIMARY KEY  (`topicid`),
  KEY `topicid` (`topicid`)
) TYPE=MyISAM;

INSERT INTO `nuke_topics` VALUES (2, 'teste', 'phpnuke.gif', 'Testando', 0);

CREATE TABLE `nuke_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `name` varchar(60) NOT NULL default '',
  `username` varchar(25) NOT NULL default '',
  `user_email` varchar(255) NOT NULL default '',
  `femail` varchar(255) NOT NULL default '',
  `user_website` varchar(255) NOT NULL default '',
  `user_avatar` varchar(255) NOT NULL default '',
  `user_regdate` varchar(20) NOT NULL default '',
  `user_icq` varchar(15) default NULL,
  `user_occ` varchar(100) default NULL,
  `user_from` varchar(100) default NULL,
  `user_interests` varchar(150) NOT NULL default '',
  `user_sig` varchar(255) default NULL,
  `user_viewemail` tinyint(2) default NULL,
  `user_theme` int(3) default NULL,
  `user_aim` varchar(18) default NULL,
  `user_yim` varchar(25) default NULL,
  `user_msnm` varchar(25) default NULL,
  `user_password` varchar(40) NOT NULL default '',
  `storynum` tinyint(4) NOT NULL default '10',
  `umode` varchar(10) NOT NULL default '',
  `uorder` tinyint(1) NOT NULL default '0',
  `thold` tinyint(1) NOT NULL default '0',
  `noscore` tinyint(1) NOT NULL default '0',
  `bio` tinytext NOT NULL,
  `ublockon` tinyint(1) NOT NULL default '0',
  `ublock` tinytext NOT NULL,
  `theme` varchar(255) NOT NULL default '',
  `commentmax` int(11) NOT NULL default '4096',
  `counter` int(11) NOT NULL default '0',
  `newsletter` int(1) NOT NULL default '1',
  `user_posts` int(10) NOT NULL default '0',
  `user_attachsig` int(2) NOT NULL default '0',
  `user_rank` int(10) NOT NULL default '0',
  `user_level` int(10) NOT NULL default '1',
  `broadcast` tinyint(1) NOT NULL default '1',
  `popmeson` tinyint(1) NOT NULL default '0',
  `user_active` tinyint(1) default '1',
  `user_session_time` int(11) NOT NULL default '0',
  `user_session_page` smallint(5) NOT NULL default '0',
  `user_lastvisit` int(11) NOT NULL default '0',
  `user_timezone` tinyint(4) NOT NULL default '-3',
  `user_style` tinyint(4) default NULL,
  `user_lang` varchar(255) NOT NULL default 'brazilian',
  `user_dateformat` varchar(14) NOT NULL default 'D, d M Y g:i a',
  `user_new_privmsg` smallint(5) unsigned NOT NULL default '0',
  `user_unread_privmsg` smallint(5) unsigned NOT NULL default '0',
  `user_last_privmsg` int(11) NOT NULL default '0',
  `user_emailtime` int(11) default NULL,
  `user_allowhtml` tinyint(1) default '1',
  `user_allowbbcode` tinyint(1) default '1',
  `user_allowsmile` tinyint(1) default '1',
  `user_allowavatar` tinyint(1) NOT NULL default '1',
  `user_allow_pm` tinyint(1) NOT NULL default '1',
  `user_allow_viewonline` tinyint(1) NOT NULL default '1',
  `user_notify` tinyint(1) NOT NULL default '0',
  `user_notify_pm` tinyint(1) NOT NULL default '0',
  `user_popup_pm` tinyint(1) NOT NULL default '1',
  `user_avatar_type` tinyint(4) NOT NULL default '3',
  `user_sig_bbcode_uid` varchar(10) default NULL,
  `user_actkey` varchar(32) default NULL,
  `user_newpasswd` varchar(32) default NULL,
  `points` int(10) default '0',
  `last_ip` varchar(15) NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  KEY `uid` (`user_id`),
  KEY `uname` (`username`),
  KEY `user_session_time` (`user_session_time`)
) TYPE=MyISAM;

INSERT INTO `nuke_users` VALUES (1, '', 'Visitante', '', '', '', 'blank.gif', 'Nov 10, 2000', '', '', '', '', '', 0, 0, '', '', '', '', 10, '', 0, 0, 0, '', 0, '', '', 4096, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 10, NULL, 'brazilian', 'D, d M Y g:i a', 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 0, 3, NULL, NULL, NULL, 0, '0');

CREATE TABLE `nuke_users_temp` (
  `user_id` int(10) NOT NULL auto_increment,
  `username` varchar(25) NOT NULL default '',
  `user_email` varchar(255) NOT NULL default '',
  `user_password` varchar(40) NOT NULL default '',
  `user_regdate` varchar(20) NOT NULL default '',
  `check_num` varchar(50) NOT NULL default '',
  `time` varchar(14) NOT NULL default '',
  PRIMARY KEY  (`user_id`)
) TYPE=MyISAM;
        