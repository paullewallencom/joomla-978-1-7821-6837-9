CREATE TABLE IF NOT EXISTS `#__folio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `catid` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL default '0',
  `image` varchar(255) NOT NULL,
  `company` varchar(250) NOT NULL DEFAULT '',
  `phone` varchar(12) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL,  
  `description` TEXT,
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;