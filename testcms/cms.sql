-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-04-14 12:30:31
-- 服务器版本： 5.7.10-log
-- PHP Version: 5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- 表的结构 `cms_adver`
--

CREATE TABLE `cms_adver` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(20) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `info` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_adver`
--

INSERT INTO `cms_adver` (`id`, `title`, `thumb`, `link`, `type`, `state`, `info`, `date`) VALUES
(1, '百度啊', '', 'http://www.baidu.com', 1, 1, '百度公司', '2016-04-12 19:17:39'),
(2, '腾讯网游', '/testcms/UPDIR20160412/20160412200919546.png', 'http://www.qq.com', 2, 1, '腾讯公司', '2016-04-12 19:20:54'),
(3, '新浪', '/testcms/UPDIR20160412/20160412192151241.png', 'http://www.sina.com.cn', 3, 1, '新浪公司', '2016-04-12 19:22:12'),
(4, '西南大学', '', 'http://www.swu.edu.cn', 1, 1, '西南大学官网', '2016-04-12 21:25:52'),
(5, '微博', '/testcms/UPDIR20160412/20160412213203856.png', 'http://www.weibo.com', 2, 1, '新浪微博', '2016-04-12 21:32:26'),
(6, '360', '/testcms/UPDIR20160412/20160412213553169.png', 'http://www.360.com', 3, 1, '360公司', '2016-04-12 21:36:36');

-- --------------------------------------------------------

--
-- 表的结构 `cms_commend`
--

CREATE TABLE `cms_commend` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `content` varchar(200) NOT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `manner` tinyint(1) NOT NULL,
  `cid` mediumint(8) UNSIGNED NOT NULL,
  `support` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `oppose` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_commend`
--

INSERT INTO `cms_commend` (`id`, `username`, `content`, `state`, `manner`, `cid`, `support`, `oppose`, `date`) VALUES
(2, '游客', 'ffdf', 0, 1, 25, 0, 0, '2016-04-09 15:30:27'),
(3, '游客', 'ffdf', 0, 1, 25, 0, 0, '2016-04-09 15:31:24'),
(4, '李家勇', '世界在前进，中国在前进，怎么样才能前进呢？正所习大大所说，先得学习，特别是新生事物，得靠人去学习掌握，这样才能有创新的资本，国家提倡创新，就是这个道理，然后脚踏实地做下去，中国梦才能实现。加油中国，加油习大大！', 0, 1, 27, 6, 1, '2016-04-09 15:48:30'),
(5, 'lijiayong', '相信在习书记的领导下中国定会走向辉煌，现今的中国不论是综合国力还是世界影响力，已经让其他国家刮目相看。作为中华儿女我们要不懈奋斗，实现伟大中国梦', 0, 0, 27, 1, 0, '2016-04-09 16:52:42'),
(6, 'lijiayong', '两学一做！是习主席对各级领导干部寄予的最大厚望！敬希我们的大小领导干部，认真地深刻领会习主席的教诲！深印心坎上、落实在实际行动上！认真做到习主席教导我们的，踏石留印！抓铁留痕！的标准。', 0, 0, 27, 2, 24, '2016-04-09 16:53:39'),
(7, '游客', 'ffdff', 0, 0, 27, 0, 0, '2016-04-09 17:20:04'),
(8, '游客', 'ffdff', 1, -1, 27, 1, 1, '2016-04-09 17:23:22'),
(9, '游客', 'fdfdfdf', 0, 1, 32, 1, 1, '2016-04-09 18:09:54'),
(10, '游客', 'fd', 0, 1, 0, 0, 0, '2016-04-09 18:20:46'),
(11, '游客', 'fdfdfdf', 1, 1, 32, 1, 1, '2016-04-09 18:46:47'),
(12, '游客', 'ffd', 1, 1, 32, 9, 6, '2016-04-09 18:54:45'),
(14, '游客', '呵呵', 1, 1, 32, 0, 0, '2016-04-09 21:45:57'),
(15, '游客', '刚刚看到一个超级超级帅的男孩，差点就想和他搞基了，他的帅让我久久不能平静，我和他对视着，就像一见钟情，仿佛时间都静止了，终于，我手麻了，放下了镜子。', 1, 1, 32, 0, 0, '2016-04-09 21:46:43');

-- --------------------------------------------------------

--
-- 表的结构 `cms_content`
--

CREATE TABLE `cms_content` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `nav` mediumint(8) UNSIGNED NOT NULL,
  `attr` varchar(20) NOT NULL,
  `tag` varchar(30) NOT NULL,
  `keyword` varchar(30) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `source` varchar(20) NOT NULL,
  `author` varchar(10) NOT NULL,
  `info` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `commend` mediumint(8) NOT NULL DEFAULT '1',
  `count` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `gold` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `sort` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `readlimit` mediumint(8) NOT NULL DEFAULT '0',
  `color` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_content`
--

INSERT INTO `cms_content` (`id`, `title`, `nav`, `attr`, `tag`, `keyword`, `thumb`, `source`, `author`, `info`, `content`, `commend`, `count`, `gold`, `sort`, `readlimit`, `color`, `date`) VALUES
(25, '中国海警最大巡逻舰船最新消息', 12, '推荐,跳转,头条', '海警，巡逻舰', '海警，巡逻舰', '/testcms/UPDIR20160407/20160407192008288.jpg', '互联网', 'aa', '参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的“尖阁专队体制”已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。', '<p>参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的&ldquo;尖阁专队体制&rdquo;已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。</p>\n\n<p>　　据台湾东森ETtoday新闻云4月7日报道，共同社引述海上安保厅消息称，日本新建的10艘巡逻船总吨数约1500吨，可高速巡航，并配有 20毫米口径机关炮、可远端操控的水枪和停船命令显示装置等。加上2艘可搭载直升机的巡逻船在改装后调配至11管区，总计12艘巡逻船的&ldquo;尖阁专队体制&rdquo; 由此建成。</p>\n\n<p>　　2012年9月日本将钓鱼台&ldquo;国有化&rdquo;后，大陆公务船驶入周边海域的情况骤增，每月累计超过20艘，但最近一直稳定在10艘以下。</p>\n\n<p><img alt="" src="/testcms/UPDIR20160407/20160407103812105.jpg" style="height:90px; width:134px" /></p>\n', 1, 175, 12, 0, 0, 'red', '2016-04-07 19:20:18'),
(27, '中国海警最大巡逻舰船最新消息', 12, '推荐,跳转,头条', '海警，巡逻舰', '海警，巡逻舰', '/testcms/UPDIR20160407/20160407192008288.jpg', '互联网', 'aa', '参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的“尖阁专队体制”已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。', '<p>参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的&ldquo;尖阁专队体制&rdquo;已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。</p>\r\n\r\n<p>　　据台湾东森ETtoday新闻云4月7日报道，共同社引述海上安保厅消息称，日本新建的10艘巡逻船总吨数约1500吨，可高速巡航，并配有 20毫米口径机关炮、可远端操控的水枪和停船命令显示装置等。加上2艘可搭载直升机的巡逻船在改装后调配至11管区，总计12艘巡逻船的&ldquo;尖阁专队体制&rdquo; 由此建成。</p>\r\n\r\n<p>　　2012年9月日本将钓鱼台&ldquo;国有化&rdquo;后，大陆公务船驶入周边海域的情况骤增，每月累计超过20艘，但最近一直稳定在10艘以下。</p>\r\n\r\n<p><img alt="" src="/testcms/UPDIR20160407/20160407103812105.jpg" style="height:90px; width:134px" /></p>\r\n', 1, 202, 12, 0, 0, 'red', '2016-04-07 19:20:18'),
(26, '中国海警最大巡逻舰船最新消息', 12, '推荐,跳转,头条', '海警，巡逻舰', '海警，巡逻舰', '/testcms/UPDIR20160407/20160407192008288.jpg', '互联网', 'aa', '参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的“尖阁专队体制”已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。', '<p>参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的&ldquo;尖阁专队体制&rdquo;已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。</p>\r\n\r\n<p>　　据台湾东森ETtoday新闻云4月7日报道，共同社引述海上安保厅消息称，日本新建的10艘巡逻船总吨数约1500吨，可高速巡航，并配有 20毫米口径机关炮、可远端操控的水枪和停船命令显示装置等。加上2艘可搭载直升机的巡逻船在改装后调配至11管区，总计12艘巡逻船的&ldquo;尖阁专队体制&rdquo; 由此建成。</p>\r\n\r\n<p>　　2012年9月日本将钓鱼台&ldquo;国有化&rdquo;后，大陆公务船驶入周边海域的情况骤增，每月累计超过20艘，但最近一直稳定在10艘以下。</p>\r\n\r\n<p><img alt="" src="/testcms/UPDIR20160407/20160407103812105.jpg" style="height:90px; width:134px" /></p>\r\n', 1, 196, 12, 0, 0, 'red', '2016-04-07 19:20:18'),
(28, '中国海警最大巡逻舰船最新消息', 12, '推荐,跳转', '海警，巡逻舰', '海警，巡逻舰', '/testcms/UPDIR20160407/20160407192008288.jpg', '互联网', 'aa', '参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的“尖阁专队体制”已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。', '<p>参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的&ldquo;尖阁专队体制&rdquo;已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。</p>\r\n\r\n<p>　　据台湾东森ETtoday新闻云4月7日报道，共同社引述海上安保厅消息称，日本新建的10艘巡逻船总吨数约1500吨，可高速巡航，并配有 20毫米口径机关炮、可远端操控的水枪和停船命令显示装置等。加上2艘可搭载直升机的巡逻船在改装后调配至11管区，总计12艘巡逻船的&ldquo;尖阁专队体制&rdquo; 由此建成。</p>\r\n\r\n<p>　　2012年9月日本将钓鱼台&ldquo;国有化&rdquo;后，大陆公务船驶入周边海域的情况骤增，每月累计超过20艘，但最近一直稳定在10艘以下。</p>\r\n\r\n<p><img alt="" src="/testcms/UPDIR20160407/20160407103812105.jpg" style="height:90px; width:134px" /></p>\r\n', 1, 122, 12, 0, 0, 'red', '2016-04-07 19:20:18'),
(29, '中国海警最大巡逻舰船最新消息', 12, '推荐,跳转', '海警，巡逻舰', '海警，巡逻舰', '/testcms/UPDIR20160407/20160407192008288.jpg', '互联网', 'aa', '参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的“尖阁专队体制”已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。', '<p>参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的&ldquo;尖阁专队体制&rdquo;已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。</p>\r\n\r\n<p>　　据台湾东森ETtoday新闻云4月7日报道，共同社引述海上安保厅消息称，日本新建的10艘巡逻船总吨数约1500吨，可高速巡航，并配有 20毫米口径机关炮、可远端操控的水枪和停船命令显示装置等。加上2艘可搭载直升机的巡逻船在改装后调配至11管区，总计12艘巡逻船的&ldquo;尖阁专队体制&rdquo; 由此建成。</p>\r\n\r\n<p>　　2012年9月日本将钓鱼台&ldquo;国有化&rdquo;后，大陆公务船驶入周边海域的情况骤增，每月累计超过20艘，但最近一直稳定在10艘以下。</p>\r\n\r\n<p><img alt="" src="/testcms/UPDIR20160407/20160407103812105.jpg" style="height:90px; width:134px" /></p>\r\n', 1, 103, 12, 0, 0, 'red', '2016-04-07 19:20:18'),
(30, '董卿直播中发飙 春晚多次当“托”真相曝光', 17, '推荐,头条,加粗,跳转', '春晚，董卿', '春晚，董卿', '/testcms/UPDIR20160407/20160407192324113.jpeg', '互联网', 'aa', '参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的“尖阁专队体制”已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。', '<p>参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的&ldquo;尖阁专队体制&rdquo;已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。</p>\r\n\r\n<p>　　据台湾东森ETtoday新闻云4月7日报道，共同社引述海上安保厅消息称，日本新建的10艘巡逻船总吨数约1500吨，可高速巡航，并配有 20毫米口径机关炮、可远端操控的水枪和停船命令显示装置等。加上2艘可搭载直升机的巡逻船在改装后调配至11管区，总计12艘巡逻船的&ldquo;尖阁专队体制&rdquo; 由此建成。</p>\r\n\r\n<p>　　2012年9月日本将钓鱼台&ldquo;国有化&rdquo;后，大陆公务船驶入周边海域的情况骤增，每月累计超过20艘，但最近一直稳定在10艘以下。</p>\r\n\r\n<p><img alt="" src="/testcms/UPDIR20160407/20160407103812105.jpg" style="height:90px; width:134px" /></p>\r\n', 1, 108, 24, 1, 4, 'orange', '2016-04-07 19:33:46'),
(32, '中国海警最大巡逻舰船最新消息', 12, '推荐,跳转', '海警，巡逻舰', '海警，巡逻舰', '', '互联网', 'aa', '参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的“尖阁专队体制”已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。', '<p>参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的&ldquo;尖阁专队体制&rdquo;已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。</p>\r\n\r\n<p>　　据台湾东森ETtoday新闻云4月7日报道，共同社引述海上安保厅消息称，日本新建的10艘巡逻船总吨数约1500吨，可高速巡航，并配有 20毫米口径机关炮、可远端操控的水枪和停船命令显示装置等。加上2艘可搭载直升机的巡逻船在改装后调配至11管区，总计12艘巡逻船的&ldquo;尖阁专队体制&rdquo; 由此建成。</p>\r\n\r\n<p>　　2012年9月日本将钓鱼台&ldquo;国有化&rdquo;后，大陆公务船驶入周边海域的情况骤增，每月累计超过20艘，但最近一直稳定在10艘以下。</p>\r\n\r\n<p><img alt="" src="/testcms/UPDIR20160407/20160407103812105.jpg" style="height:90px; width:134px" /></p>\r\n', 1, 155, 12, 0, 0, 'red', '2016-04-07 19:20:18'),
(35, '中国海警最大巡逻舰船最新消息', 12, '跳转', '海警，巡逻舰', '海警，巡逻舰', '/testcms/UPDIR20160407/20160407192008288.jpg', '互联网', 'aa', '参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的“尖阁专队体制”已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。', '<p>参考消息网4月7日报道 台媒称，日本海上保安厅日前曾表示，专用于尖阁诸岛（即我钓鱼岛及附属岛屿--本网注）的&ldquo;尖阁专队体制&rdquo;已在4月正式启动，共计增派12艘巡逻船针对大 陆公务船多次驶入钓鱼台周边加强警备。对此，大陆似乎没有多加理会，国家海洋局网站6日称，海警2307、2101以及31241舰船编队在钓鱼台领海内 巡航。</p>\r\n\r\n<p>　　据台湾东森ETtoday新闻云4月7日报道，共同社引述海上安保厅消息称，日本新建的10艘巡逻船总吨数约1500吨，可高速巡航，并配有 20毫米口径机关炮、可远端操控的水枪和停船命令显示装置等。加上2艘可搭载直升机的巡逻船在改装后调配至11管区，总计12艘巡逻船的&ldquo;尖阁专队体制&rdquo; 由此建成。</p>\r\n\r\n<p>　　2012年9月日本将钓鱼台&ldquo;国有化&rdquo;后，大陆公务船驶入周边海域的情况骤增，每月累计超过20艘，但最近一直稳定在10艘以下。</p>\r\n\r\n<p><img alt="" src="/testcms/UPDIR20160407/20160407103812105.jpg" style="height:90px; width:134px" /></p>\r\n', 1, 101, 12, 0, 0, 'red', '2016-04-07 19:20:18'),
(39, '测试444', 12, '加粗,头条', '测试', '测试', '', '', 'aa', '发的发发发发发发发发发发', '<p>分地方地方的方法反反复复</p>\r\n', 1, 223, 0, 0, 0, '默认颜色', '2016-05-07 20:37:21');

-- --------------------------------------------------------

--
-- 表的结构 `cms_friendlink`
--

CREATE TABLE `cms_friendlink` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `webname` varchar(20) NOT NULL,
  `weburl` varchar(100) NOT NULL,
  `logourl` varchar(100) NOT NULL,
  `user` varchar(20) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_friendlink`
--

INSERT INTO `cms_friendlink` (`id`, `webname`, `weburl`, `logourl`, `user`, `type`, `state`, `date`) VALUES
(1, '网易新闻', 'http://news.163.com/', '', '丁磊', 1, 1, '2016-04-13 16:54:30'),
(2, '百度搜索', 'http://www.baidu.com', 'images/baidu.png', '李彦宏', 2, 1, '2016-04-13 16:55:33'),
(3, '优酷', 'http://www.youku.com', 'images/youku.png', '古永锵', 2, 1, '2016-04-13 16:57:06'),
(4, '优酷视频', 'http://www.youku.com', '', '古永锵', 1, 1, '2016-04-13 17:20:44'),
(5, '网易', 'http://news.163.com', 'images/163.png', '丁磊', 2, 1, '2016-04-13 17:23:12');

-- --------------------------------------------------------

--
-- 表的结构 `cms_level`
--

CREATE TABLE `cms_level` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `level` smallint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '//等级',
  `level_name` varchar(20) NOT NULL COMMENT '//等级名称',
  `level_info` varchar(200) NOT NULL COMMENT '//等级信息',
  `premission` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_level`
--

INSERT INTO `cms_level` (`id`, `level`, `level_name`, `level_info`, `premission`) VALUES
(1, 5, '普通管理员', '除了不能操作其他管理员，其他任何操作都可以', '1,2,4,5,6,7,8,9,10,11,12,13,14'),
(2, 6, '超级管理员', '我有最大权限', '1,2,3,4,5,6,7,8,9,10,11,12,13,14'),
(3, 3, '发帖专员', '只有管理发帖的权限', '1,7'),
(4, 4, '评论专员', '只有管理评论的权限', '1,8'),
(5, 2, '会员专员', '只有管理会员的权限', '1,13'),
(16, 1, '后台游客', '只有登录后台的权限', '1');

-- --------------------------------------------------------

--
-- 表的结构 `cms_manage`
--

CREATE TABLE `cms_manage` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '//id',
  `admin_user` varchar(20) NOT NULL COMMENT '//管理员姓名',
  `admin_pass` char(40) NOT NULL COMMENT '//密码',
  `level` smallint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '//等级',
  `login_count` mediumint(8) UNSIGNED NOT NULL COMMENT '//登录次数',
  `last_ip` varchar(20) NOT NULL COMMENT '//最后登录ip',
  `last_time` datetime NOT NULL COMMENT '//最后登录时间',
  `reg_time` datetime NOT NULL COMMENT '//注册时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_manage`
--

INSERT INTO `cms_manage` (`id`, `admin_user`, `admin_pass`, `level`, `login_count`, `last_ip`, `last_time`, `reg_time`) VALUES
(4, '李家勇', '1111cd49130a0641f5455568cccfa19f12a797c3', 6, 6, '127.0.0.1', '2016-04-14 17:03:38', '2016-03-30 16:14:20'),
(5, 'lijiayong', '1111cd49130a0641f5455568cccfa19f12a797c3', 6, 11, '127.0.0.1', '2016-04-14 20:18:39', '2016-03-30 16:14:20'),
(6, 'aa', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 5, 12, '127.0.0.1', '2016-04-14 17:05:32', '2016-03-30 16:15:51'),
(7, 'bb', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 2, 0, '', '2016-03-30 16:15:51', '2016-03-30 16:15:51'),
(8, 'cc', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 3, 0, '', '2016-03-30 16:16:17', '2016-03-30 16:16:17'),
(9, 'dd', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 3, 0, '', '0000-00-00 00:00:00', '2016-03-30 18:16:04'),
(10, 'ee', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 4, 0, '', '0000-00-00 00:00:00', '2016-03-30 18:25:12'),
(11, 'ff', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 2, 0, '', '0000-00-00 00:00:00', '2016-03-30 18:28:17'),
(12, 'gg', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 2, 0, '', '0000-00-00 00:00:00', '2016-03-30 18:28:30'),
(13, 'll', '3', 3, 0, '', '0000-00-00 00:00:00', '2016-03-30 18:34:36'),
(24, '123', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1, 3, '127.0.0.1', '2016-04-14 20:16:53', '2016-04-01 13:53:30'),
(27, 'li1', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1, 0, '', '0000-00-00 00:00:00', '2016-04-03 13:40:55'),
(32, 'li"', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1, 0, '', '0000-00-00 00:00:00', '2016-04-03 14:12:05'),
(35, 'li\\', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1, 0, '', '0000-00-00 00:00:00', '2016-04-03 14:23:24');

-- --------------------------------------------------------

--
-- 表的结构 `cms_nav`
--

CREATE TABLE `cms_nav` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `nav_name` varchar(20) NOT NULL COMMENT '//导航名',
  `nav_info` varchar(200) NOT NULL COMMENT '//导航说明',
  `pid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '//主、子导航',
  `sort` mediumint(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_nav`
--

INSERT INTO `cms_nav` (`id`, `nav_name`, `nav_info`, `pid`, `sort`) VALUES
(10, '时尚女人', '关于女性的新闻', 0, 3),
(9, '八卦娱乐', '关于娱乐的新闻', 0, 2),
(8, '军事动态', '关于军事的新闻', 0, 1),
(12, '中国军事', '中国的军事新闻', 8, 1),
(14, '日本军事', '日本的军事新闻', 8, 2),
(19, '科技频道', '有关科技的新闻', 0, 5),
(20, '智能手机', '有关手机方面的新闻', 0, 4),
(17, '明星娱乐', '有关明星的新闻啊', 9, 17),
(21, '美容护肤', '有关美容方面的新闻', 0, 21),
(22, '热门汽车', '有关汽车方面的新闻', 0, 22),
(23, '房产家居', '有关家居方面的新闻', 0, 23),
(24, '读书教育', '有关教育方面的新闻', 0, 24),
(25, '股票基金', '有关股票方面的新闻', 0, 25),
(26, '韩国军事', '有关韩国方面的新闻', 8, 3);

-- --------------------------------------------------------

--
-- 表的结构 `cms_premission`
--

CREATE TABLE `cms_premission` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `info` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_premission`
--

INSERT INTO `cms_premission` (`id`, `name`, `info`) VALUES
(3, '管理员管理', '管理员管理'),
(4, '等级管理', '等级管理'),
(5, '权限管理', '权限管理'),
(6, '导航管理', '导航管理'),
(7, '文档管理', '文档管理'),
(8, '评论审核', '评论审核'),
(9, '轮播器管理', '轮播器管理'),
(10, '广告管理', '广告管理'),
(11, '投票管理', '投票管理'),
(12, '友情链接管理', '友情链接管理'),
(13, '会员管理', '会员管理'),
(14, '系统配置管理', '系统配置管理'),
(1, '后台登录', '后台登录'),
(2, '清理缓存', '清理缓存');

-- --------------------------------------------------------

--
-- 表的结构 `cms_rotation`
--

CREATE TABLE `cms_rotation` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `title` varchar(20) NOT NULL,
  `info` varchar(200) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `link` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_rotation`
--

INSERT INTO `cms_rotation` (`id`, `thumb`, `title`, `info`, `state`, `link`, `date`) VALUES
(1, '/testcms/UPDIR20160412/20160412123455957.jpg', '百度', '百度公司地方都说的 ', 1, 'http://www.baidu.com', '2016-04-12 12:35:19'),
(3, '/testcms/UPDIR20160412/20160412140335854.jpg', '新浪', '新浪网', 1, 'http://www.sina.com.cn', '2016-04-12 14:04:38'),
(4, '/testcms/UPDIR20160412/20160412140452257.jpg', '西南大学', '西南大学官网', 1, 'http://www.swu.edu.cn', '2016-04-12 14:05:20');

-- --------------------------------------------------------

--
-- 表的结构 `cms_system`
--

CREATE TABLE `cms_system` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `webname` varchar(100) NOT NULL COMMENT '//网站名',
  `page_size` tinyint(2) NOT NULL COMMENT '//普通分页条数',
  `article_size` tinyint(2) NOT NULL COMMENT '//文章分页条数',
  `nav_size` tinyint(2) NOT NULL COMMENT '//前台导航个数',
  `ro_time` tinyint(2) NOT NULL COMMENT '//轮播图速度',
  `ro_num` tinyint(2) NOT NULL COMMENT '//轮播图个数',
  `updir` varchar(100) NOT NULL COMMENT '//上传图片文件夹',
  `adver_text_num` tinyint(2) NOT NULL COMMENT '//循环的文字广告个数',
  `adver_pic_num` tinyint(2) NOT NULL COMMENT '//循环的图片广告个数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_system`
--

INSERT INTO `cms_system` (`id`, `webname`, `page_size`, `article_size`, `nav_size`, `ro_time`, `ro_num`, `updir`, `adver_text_num`, `adver_pic_num`) VALUES
(1, '李家勇的网站', 10, 5, 10, 3, 3, '/uploads/', 5, 3);

-- --------------------------------------------------------

--
-- 表的结构 `cms_tag`
--

CREATE TABLE `cms_tag` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `tagname` varchar(20) NOT NULL,
  `count` mediumint(8) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_tag`
--

INSERT INTO `cms_tag` (`id`, `tagname`, `count`) VALUES
(1, '海警', 3),
(3, '巡逻舰', 1),
(4, '测试', 2);

-- --------------------------------------------------------

--
-- 表的结构 `cms_user`
--

CREATE TABLE `cms_user` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `face` varchar(20) NOT NULL,
  `question` varchar(20) NOT NULL,
  `answer` varchar(20) NOT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `time` char(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_user`
--

INSERT INTO `cms_user` (`id`, `username`, `password`, `email`, `face`, `question`, `answer`, `state`, `time`, `date`) VALUES
(1, '李家勇', '1111cd49130a0641f5455568cccfa19f12a797c3', '1530556939@qq.com', '24.gif', '', '', 5, '1460187968', '2016-04-08 15:24:03'),
(2, 'lijiayong', '1111cd49130a0641f5455568cccfa19f12a797c3', '1530556939@lijiayong.com', '15.gif', '您母亲的职业？', '你猜', 5, '1460191908', '2016-04-08 15:25:05'),
(4, 'bb', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '1530556939@wy.com', '19.gif', '您父亲的姓名？', 'hhhh', 0, '', '2016-04-08 20:06:24'),
(5, 'dd', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '1530556939@dd.com', '05.gif', '您父亲的姓名？', 'nicai', 2, '', '2016-04-09 13:11:52'),
(6, 'cc', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '1530556939@cc.com', '10.gif', '您配偶的性别？', 'nicai', 1, '1460178777', '2016-04-09 13:12:57'),
(7, 'ee', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '1530556939@ee.com', '06.gif', '您父亲的姓名？', 'ff', 2, '', '2016-04-09 13:43:43'),
(8, 'ff', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '1530556939@ff.com', '16.gif', '', '', 2, '', '2016-04-09 13:45:28'),
(9, 'gg', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '1530556939@gg.com', '19.gif', '您父亲的姓名？', 'ccc', 2, '', '2016-04-09 13:47:03');

-- --------------------------------------------------------

--
-- 表的结构 `cms_vote`
--

CREATE TABLE `cms_vote` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(20) NOT NULL,
  `info` varchar(200) NOT NULL,
  `vid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `count` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_vote`
--

INSERT INTO `cms_vote` (`id`, `title`, `info`, `vid`, `count`, `state`, `date`) VALUES
(2, '您最喜欢去的地方是哪里啊？', '您最喜欢去的地方是哪里啊？', 0, 0, 1, '2016-04-13 08:57:58'),
(3, '四川宜宾', '四川宜宾', 2, 501, 0, '2016-04-13 09:18:23'),
(4, '您最喜欢吃的美食是什么？', '您最喜欢吃的美食是什么？', 0, 0, 0, '2016-04-13 09:28:16'),
(5, '重庆', '重庆', 2, 45, 0, '2016-04-13 09:42:55'),
(6, '四川成都', '四川成都啊', 2, 60, 0, '2016-04-13 09:44:22'),
(11, '北京', '北京', 2, 60, 0, '2016-04-13 12:15:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_adver`
--
ALTER TABLE `cms_adver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_commend`
--
ALTER TABLE `cms_commend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_content`
--
ALTER TABLE `cms_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_friendlink`
--
ALTER TABLE `cms_friendlink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_level`
--
ALTER TABLE `cms_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_manage`
--
ALTER TABLE `cms_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_nav`
--
ALTER TABLE `cms_nav`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_premission`
--
ALTER TABLE `cms_premission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_rotation`
--
ALTER TABLE `cms_rotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_system`
--
ALTER TABLE `cms_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_tag`
--
ALTER TABLE `cms_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_user`
--
ALTER TABLE `cms_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_vote`
--
ALTER TABLE `cms_vote`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cms_adver`
--
ALTER TABLE `cms_adver`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `cms_commend`
--
ALTER TABLE `cms_commend`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `cms_content`
--
ALTER TABLE `cms_content`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- 使用表AUTO_INCREMENT `cms_friendlink`
--
ALTER TABLE `cms_friendlink`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `cms_level`
--
ALTER TABLE `cms_level`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `cms_manage`
--
ALTER TABLE `cms_manage`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '//id', AUTO_INCREMENT=37;
--
-- 使用表AUTO_INCREMENT `cms_nav`
--
ALTER TABLE `cms_nav`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- 使用表AUTO_INCREMENT `cms_premission`
--
ALTER TABLE `cms_premission`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `cms_rotation`
--
ALTER TABLE `cms_rotation`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `cms_system`
--
ALTER TABLE `cms_system`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cms_tag`
--
ALTER TABLE `cms_tag`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `cms_user`
--
ALTER TABLE `cms_user`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `cms_vote`
--
ALTER TABLE `cms_vote`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
