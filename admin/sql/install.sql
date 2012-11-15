CREATE TABLE IF NOT EXISTS `#__akquickicons_icons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `images` text NOT NULL,
  `icon_class` varchar(255) NOT NULL,
  `version` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) unsigned NOT NULL,
  `language` char(7) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_alias` (`alias`),
  KEY `idx_createdby` (`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_checkout` (`checked_out`),
  KEY `cat_index` (`published`,`access`,`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- Category
INSERT INTO `#__categories` (`parent_id`, `lft`, `rgt`, `level`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `modified_user_id`, `modified_time`, `hits`, `language`) VALUES
(1, 135, 136, 1, 'core-icons', 'com_akquickicons', 'Core Icons', 'core-icons', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 908, '2012-08-12 04:03:49', 908, '2012-08-12 04:05:29', 0, '*');

-- Icons
INSERT INTO `#__akquickicons_icons` (`catid`, `title`, `alias`, `link`, `introtext`, `fulltext`, `images`, `icon_class`, `version`, `created`, `created_by`, `modified`, `modified_by`, `ordering`, `published`, `publish_up`, `publish_down`, `checked_out`, `checked_out_time`, `access`, `language`, `params`) VALUES
(80, 'New Article', 'new-article', 'index.php?option=com_content&task=article.add', '', '', 'images/quickicons/Primo-Icons/blog_add_48.png', 'akicon-file', 0, '2012-08-12 04:03:16', 908, '0000-00-00 00:00:00', 0, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, '*', ''),
(80, 'Article Manager', 'article-manager', 'index.php?option=com_content', '', '', 'images/quickicons/Primo-Icons/blog_compose_48.png', 'akicon-folder-open', 0, '2012-08-12 04:09:56', 908, '0000-00-00 00:00:00', 0, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, '*', ''),
(80, 'Category Manager', 'category-manager', 'index.php?option=com_categories&extension=com_content', '', '', 'images/quickicons/Primo-Icons/bookmark_48.png', '', 0, '2012-08-12 04:14:42', 908, '0000-00-00 00:00:00', 0, 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, '*', '');