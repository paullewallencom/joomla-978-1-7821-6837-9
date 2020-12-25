ALTER TABLE `#__folio` ADD `checked_out` int(11) NOT NULL DEFAULT '0';
ALTER TABLE `#__folio` ADD `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `#__folio` ADD `access` int(11) NOT NULL DEFAULT '1';
ALTER TABLE `#__folio` ADD `language` char(7) NOT NULL DEFAULT '';
ALTER TABLE `#__folio` ADD `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `#__folio` ADD `created_by` int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE `#__folio` ADD `created_by_alias` varchar(255) NOT NULL DEFAULT '';
ALTER TABLE `#__folio` ADD `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `#__folio` ADD `modified_by` int(10) unsigned NOT NULL DEFAULT '0';

