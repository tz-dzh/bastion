-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 22 2015 г., 19:29
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `tz_bstn`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_application`
--

CREATE TABLE IF NOT EXISTS `tbl_application` (
`id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `rate` int(1) DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
`id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `content`, `status`, `create_time`, `author`, `email`, `url`, `post_id`) VALUES
(2, 'Hihi! Seems working, I''ll use this blog as base for my site.', 2, 1422560643, 'tz', 'mail@example.com', '', 1),
(3, 'This is comment from logged in user ''demo'', where name and email are filled automatically', 2, 1422718657, 'demo', 'webmaster@example.com', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_event`
--

CREATE TABLE IF NOT EXISTS `tbl_event` (
`id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `event_time` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tbl_event`
--

INSERT INTO `tbl_event` (`id`, `title`, `description`, `event_time`, `create_time`, `update_time`, `details`, `author_id`) VALUES
(1, 'test event', 'test description of event\r\nLorem Ipsum.', 148800666, 1426967144, 1426969714, 'a:2:{s:10:"longtitude";s:2:"14";s:8:"latitude";s:2:"88";}', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_lookup`
--

CREATE TABLE IF NOT EXISTS `tbl_lookup` (
`id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tbl_lookup`
--

INSERT INTO `tbl_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Draft', 1, 'PostStatus', 1),
(2, 'Published', 2, 'PostStatus', 2),
(3, 'Archived', 3, 'PostStatus', 3),
(4, 'Pending Approval', 1, 'CommentStatus', 1),
(5, 'Approved', 2, 'CommentStatus', 2),
(6, 'Admin', 1, 'UserRole', 1),
(7, 'Member', 2, 'UserRole', 2),
(8, 'User', 3, 'UserRole', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_post`
--

CREATE TABLE IF NOT EXISTS `tbl_post` (
`id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `title`, `content`, `tags`, `status`, `create_time`, `update_time`, `author_id`) VALUES
(1, 'Welcome!', 'This blog system is developed using Yii. It is meant to demonstrate how to use Yii to build a complete real-world application. Complete source code may be found in the Yii releases.\r\n\r\nFeel free to try this system by writing new posts and posting comments.', 'yii, blog', 2, 1230952187, 1230952187, 1),
(2, 'A Test Post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'test', 2, 1230952187, 1230952187, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_tag`
--

CREATE TABLE IF NOT EXISTS `tbl_tag` (
`id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tbl_tag`
--

INSERT INTO `tbl_tag` (`id`, `name`, `frequency`) VALUES
(1, 'yii', 1),
(2, 'blog', 1),
(3, 'test', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`id` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci,
  `role` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `profile`, `role`) VALUES
(1, 'demo', '$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC', 'webmaster@example.com', NULL, 'user'),
(2, 'tz', '$2a$13$LdPnoUinidepXC8EuPicNeMJncBxJslyOyZRBx6WAQaGatepTkbOi', 'tz_onyx@mail.ru', NULL, 'admin'),
(14, 'test', '$2a$13$8CbUy6cVA4LPYkdiw7dcyOvOZggXRlJC2zKS/K1lQQE7wY4POUzna', 'test@example.com', NULL, 'member');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tbl_application`
--
ALTER TABLE `tbl_application`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_comment`
--
ALTER TABLE `tbl_comment`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_comment_post` (`post_id`);

--
-- Индексы таблицы `tbl_event`
--
ALTER TABLE `tbl_event`
 ADD PRIMARY KEY (`id`), ADD KEY `author_id` (`author_id`);

--
-- Индексы таблицы `tbl_lookup`
--
ALTER TABLE `tbl_lookup`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_post`
--
ALTER TABLE `tbl_post`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_post_author` (`author_id`);

--
-- Индексы таблицы `tbl_tag`
--
ALTER TABLE `tbl_tag`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tbl_application`
--
ALTER TABLE `tbl_application`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tbl_comment`
--
ALTER TABLE `tbl_comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `tbl_event`
--
ALTER TABLE `tbl_event`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `tbl_lookup`
--
ALTER TABLE `tbl_lookup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `tbl_post`
--
ALTER TABLE `tbl_post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `tbl_tag`
--
ALTER TABLE `tbl_tag`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbl_comment`
--
ALTER TABLE `tbl_comment`
ADD CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tbl_post`
--
ALTER TABLE `tbl_post`
ADD CONSTRAINT `FK_post_author` FOREIGN KEY (`author_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
