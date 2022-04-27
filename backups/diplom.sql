-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 27 2022 г., 09:09
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diplom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `coursework`
--

CREATE TABLE `coursework` (
  `id` int NOT NULL,
  `name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(2400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` int NOT NULL,
  `semester` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `coursework`
--

INSERT INTO `coursework` (`id`, `name`, `description`, `course`, `semester`) VALUES
(1, 'Тепловая схема', 'Небольшое описание', 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `coursework_2`
--

CREATE TABLE `coursework_2` (
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220418045837', '2022-04-18 08:05:24', 117),
('DoctrineMigrations\\Version20220421123033', '2022-04-21 15:30:47', 165),
('DoctrineMigrations\\Version20220426061241', '2022-04-26 09:12:57', 145),
('DoctrineMigrations\\Version20220426074045', '2022-04-26 10:40:52', 94);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fio` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gruppa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `fio`, `gruppa`) VALUES
(1, 'user@example.com', '[\"ROLE_ADMIN\"]', '$2y$13$1qqIXnU3uX6M2gmjmgmlK.H1tEF8rx3dnRi2GT3Yv86Yw62fdcapq', 'Иванов Иван Иванович', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `сoursework_1`
--

CREATE TABLE `сoursework_1` (
  `COL 1` varchar(33) DEFAULT NULL,
  `COL 2` varchar(6) DEFAULT NULL,
  `COL 3` varchar(3) DEFAULT NULL,
  `COL 4` varchar(16) DEFAULT NULL,
  `COL 5` varchar(6) DEFAULT NULL,
  `COL 6` varchar(13) DEFAULT NULL,
  `COL 7` varchar(29) DEFAULT NULL,
  `COL 8` varchar(37) DEFAULT NULL,
  `COL 9` varchar(39) DEFAULT NULL,
  `COL 10` varchar(40) DEFAULT NULL,
  `COL 11` varchar(43) DEFAULT NULL,
  `COL 12` varchar(28) DEFAULT NULL,
  `COL 13` varchar(40) DEFAULT NULL,
  `COL 14` varchar(37) DEFAULT NULL,
  `COL 15` varchar(27) DEFAULT NULL,
  `COL 16` varchar(44) DEFAULT NULL,
  `COL 17` varchar(33) DEFAULT NULL,
  `COL 18` varchar(41) DEFAULT NULL,
  `COL 19` varchar(29) DEFAULT NULL,
  `COL 20` varchar(41) DEFAULT NULL,
  `COL 21` varchar(30) DEFAULT NULL,
  `COL 22` varchar(38) DEFAULT NULL,
  `COL 23` varchar(47) DEFAULT NULL,
  `COL 24` varchar(27) DEFAULT NULL,
  `COL 25` varchar(34) DEFAULT NULL,
  `COL 26` varchar(34) DEFAULT NULL,
  `COL 27` varchar(40) DEFAULT NULL,
  `COL 28` varchar(46) DEFAULT NULL,
  `COL 29` varchar(49) DEFAULT NULL,
  `COL 30` varchar(48) DEFAULT NULL,
  `COL 31` varchar(29) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `сoursework_1`
--

INSERT INTO `сoursework_1` (`COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`, `COL 9`, `COL 10`, `COL 11`, `COL 12`, `COL 13`, `COL 14`, `COL 15`, `COL 16`, `COL 17`, `COL 18`, `COL 19`, `COL 20`, `COL 21`, `COL 22`, `COL 23`, `COL 24`, `COL 25`, `COL 26`, `COL 27`, `COL 28`, `COL 29`, `COL 30`, `COL 31`) VALUES
('ФИО студента', 'Группа', 'Пол', 'ФИО руководителя', 'Оценка', 'Тип судна [1]', 'Мощность гл. турбины, МВт [1]', 'Давление пара перед турбиной, МПа [1]', 'Температура пара перед турбиной, гр [1]', 'Давление в главном конденсаторе, КПа [1]', 'Число регенеративных ступеней подогрева [1]', 'Механический КПД турбины [2]', 'Давление пара перед сепаратором, МПа [2]', 'Давление пара за сепаратором, МПа [2]', 'Внутр. КПД баз. Турбины [2]', 'Внутр. теплоперепад баз. турбины, кДж/кг [2]', 'Расход пара без отборов, кг/с [2]', 'Конеч.влажность пара на выходе из ТВД [2]', 'Относ. внутр. кпд турбины [2]', 'Влажность пара на входе в конденсатор [2]', 'Давление в деаэраторе, МПа [2]', 'Энтальпия питательной воды, кДж/кг [2]', 'Процент пара и тепла на доп. потребителя, % [3]', 'Экономия от регенерации [3]', 'Расход пара на установку, кг/с [3]', 'Расход тепла на установку, кВт [3]', 'Видимый расход пара на турбину, кг/с [3]', 'Колво влаги, отделенное в сепараторе, кг/с [3]', 'Колво пара, отбираемого всеми ступенями, кг/с [3]', 'Колво пара поступающего в конденса тор, кг/с [3]', 'Термический КПД установки [3]'),
('Борисов М.С.', '16ЯР', 'м', 'Дунцев А.В.', '4', 'Танкер', '24', '2,2', '280', '6', '2', '0,956', '0,189', '0,179', '0,828', '881,405', '28,482', '0,043', '0,805', '0,106', '0,125', '444,354', '17', '0,0593', '42,353', '106444,199', '36,304', '1,502', '4,289', '30,513', '0,225'),
('Егарева О. О.', '16ЯР', 'ж', 'Дунцев А.В.', '5', 'Сухогруз', '25', '2,4', '285', '6', '3', '0,9558', '0,206', '0,196', '0,831', '891,922', '29,326', '0,023', '0,713', '0,111', '0,137', '', '16,9', '0,102', '48,266', '108683,842', '40,529', '1,337', '11,198', '39,142', '0,235'),
('Кот А.В.', '16ЯР', 'м', 'Дунцев А.В.', '5', 'Танкер', '36', '3,4', '320', '6', '3', '0,957', '0,2924', '0,2763', '0,825', '917,929', '40,981', '0,0302', '0,811', '0,122', '0,1934', '443,953', '16,16', '0,0956', '60,565', '140622,685', '52,2568', '1,395', '11,5853', '39,2765', '0,256'),
('Лебедев В.В.', '16ЯР', 'м', 'Дунцев А.В.', '5', 'Ледокол', '34', '3,2', '320', '4', '1', '0,957', '0,275', '0,2599', '0,827', '953,14', '37,274', '0,0312', '0,813', '0,128', '0,1819', '492,08', '16', '0,0503', '52,8659', '135097,7858', '45,7023', '1,338', '13,5516', '37,9763', '0,2565'),
('Миронченков С.Р.', '16ЯР', 'м', 'Дунцев А.В.', '4', 'Сухогруз', '42', '3,8', '320', '6', '2', '0,957', '0,327', '0,309', '0,836', '940,038', '46,687', '0,0459', '0,832', '0,126', '0,1365', '565,72', '16,2', '0,069', '65,547', '163185,696', '56,68', '2,49', '7,27', '46,92', '0,2577'),
('Обидина К.А.', '16ЯР', 'ж', 'Дунцев А.В.', '5', 'Танкер', '44', '4', '320', '6', '3', '0,958', '0,344', '0,325', '0,823', '929,693', '49,402', '0,044', '0,817', '0,125', '0,228', '750,1', '12,83', '0,093', '72,435', '166111,892', '63,711', '2,332', '16,363', '46,915', '0,269'),
('Тряков Д.И.', '16ЯР', 'м', 'Дунцев А.В.', '4', 'Сухогруз', '20', '3', '320', '7', '2', '0,954', '0,258', '0,244', '0,822', '889,13', '26,787', '0,026', '0,732', '0,1122', '0,1708', '516,13', '16', '0,0678', '32,95', '88855,44', '28,01', '0,645', '4,94', '24,162', '0,225'),
('Андреева Т.С.', '16ЯР', 'ж', 'Дунцев А.В.', '5', 'Ледокол', '29,5', '3,2', '300', '6', '2', '0,956', '0,275', '0,26', '0,8274', '915,109', '33,72', '0,053', '0,816', '0,12', '0,182', '526,9096', '15,86', '0,0678', '49,007', '120938,559', '41,72', '2,128', '7,044', '34,016', '0,244'),
('Тарасов Д.В.', '16ЯР', 'м', 'Дунцев А.В.', '4', 'Ледокол', '33', '3,8', '330', '4', '2', '0,957', '0,327', '0,309', '0,791', '968,688', '39,694', '0,0348', '0,819', '0,133', '0,216', '536,443', '13', '0,0743', '49,788', '125150,432', '42,65', '1,403', '8', '35,602', '0,264'),
('Шушарин М.А.', '16ЯР', 'м', 'Дунцев А.В.', '4', 'Ледокол', '17', '3,2', '325', '5', '3', '0,9525', '0,275', '0,26', '0,819', '923,44', '19,327', '0,025', '0,802', '0,121', '0,182', '701,296', '16,25', '0,095', '28,326', '66832,501', '24,584', '0,499', '6,274', '18,83', '0,2595'),
('Березин А.А.', '15ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '26', '3,2', '300', '5', '3', '0,955', '0,275', '0,26', '0,824', '929,55', '29,29', '0,048', '0,805', '0,123', '0,182', '492,12', '18', '0,049', '43,147', '107965,705', '35,558', '', '4,896', '30,206', '0,241'),
('Дегина А.С.', '15ЯР', 'ж', 'Дунцев А.В.', '', 'Сухогруз', '22', '3', '290', '7', '3', '0,955', '0,258', '0,244', '0,824', '890,776', '25,861', '0,051', '0,81', '0,112', '0,1707', '486,028', '16,4', '0,085', '39,694', '91532,044', '34,161', '1,579', '12,44', '25,675', '0,2404'),
('Запевалов Д.А.', '15ЯР', 'м', 'Дунцев А.В.', '', 'Танкер', '25', '2,8', '295', '7', '2', '0,955', '0,241', '0,228', '0,824', '885,216', '29,573', '0,044', '0,807', '0,109', '0,1593', '474,806', '16,2', '0,0595', '42,617', '107456,221', '36,429', '1,359', '10,279', '30,98', '0,233'),
('Исаева Е.Д', '15ЯР', 'ж', 'Дунцев А.В.', '', 'Танкер', '32', '2,8', '300', '4', '3', '0,957', '0,2408', '0,2276', '0,827', '933,203', '35,83', '0,0372', '0,811', '0,1195', '0,1575', '718,062', '15,8', '', '53,71', '133764', '46,761', '1,43', '10,797', '34,534', '0,241'),
('Курлакова В.А.', '15ЯР', 'ж', 'Дунцев А.В.', '', 'Танкер', '28', '2,5', '300', '7', '2', '0,957', '0,215', '0,203', '0,827', '876,923', '33,364', '0,043', '0,828', '0,108', '0,1421', '460,288', '0,15', '0,0574', '45,902', '117364,526', '39,552', '1,408', '11,243', '33,251', '0,239'),
('Новиков Д.И.', '15ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '25,5', '2,4', '300', '6', '1', '0,957', '0,206', '0,195', '0,827', '888,243', '29,998', '0,033', '0,817', '0,11', '0,1365', '455,2', '17,5', '0,0455', '43,166', '110855,969', '36,8462', '1,0051', '10,74383', '31,418', '0,2297'),
('Сорокина О.Е.', '15ЯР', 'ж', 'Дунцев А.В.', '', 'Танкер', '25', '3,3', '290', '6', '3', '0,955', '0,2838', '0,268', '0,825', '915,82', '28,584', '0,061', '0,833', '0,123', '0,1742', '486,4', '14,87', '0,091', '41,78', '95532,332', '36,3', '0,742', '14,0103', '27,028', '0,262'),
('Суминов О.Д.', '15ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '35', '3,7', '400', '6', '1', '0,9575', '0,3182', '0,3007', '0,825', '925,657', '27,626', '0,059', '0,823', '0,122', '0,21', '511,3', '17,1', '0,0498', '58,454', '144587,494', '50,418', '2,503', '14,548', '41,403', '0,244'),
('Терентьева А.Н.', '15ЯР', 'ж', 'Дунцев А.В.', '', 'Сухогруз', '35', '3,5', '300', '6', '2', '0,955', '0,301', '0,284', '0,824', '927,766', '39,503', '0,056', '0,807', '0,109', '0,199', '504,03', '16', '0,065', '56,762', '142817,839', '48,289', '2,272', '14,694', '39,796', '0,245'),
('Фролов М.В.', '15ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '25', '3,1', '300', '4', '1', '0,956', '0,2666', '0,2519', '0,8235', '946,607', '27,626', '0,0454', '0,811', '0,125', '0,1763', '487,972', '17,23', '0,04977', '40,82', '102546,693', '34,63', '1,506', '10,505', '28,819', '0,244'),
('Хвойнов О.В.', '15ЯР', 'м', 'Дунцев А.В.', '', 'Сухогруз', '25', '2,9', '400', '6', '2', '0,9556', '0,249', '0,268', '0,824', '904,835', '28,913', '0,0404', '0,803', '0,113', '0,165', '479,31', '16', '0,061', '41,778', '105559,86', '36,045', '1,274', '9,884', '29,978', '0,237'),
('Шурыгин Р.Е.', '15ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '35', '2,7', '300', '5', '1', '0,975', '0,232', '0,219', '0,812', '901,418', '39,823', '0,027', '0,78', '0,115', '0,153', '469,15', '15,3', '0,0506', '58,106', '147810,14', '50,295', '1,097', '14,087', '42,78', '0,24'),
('Бухалов И.А.', '14ЯР', 'м', 'Дунцев А.В.', '', 'Сухогруз', '28', '2,6', '285', '4', '2', '0,957', '0,224', '0,211', '0,824', '931,434', '31,412', '0,044', '0,805', '0,121', '0,148', '465,423', '15', '0,059', '45,404', '114721,418', '39,024', '1,653', '3,789', '33,582', '0,244'),
('Горбатов С.А.', '14ЯР', 'м', 'Дунцев А.В.', '', 'Танкер', '36', '3,4', '320', '6', '3', '0,958', '0,2924', '0,276', '0,826', '919,519', '38,597', '0,0509', '0,844', '0,1191', '0,1891', '497,22', '15', '0,1001', '58,032', '133990,078', '50,634', '2,161', '11,639', '36,834', '0,259'),
('Игонин М.А.', '14ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '30', '2,8', '300', '4', '1', '', '0,241', '0,228', '0,827', '941,68', '33,289', '0,0692', '0,973', '0,136', '0,159', '474,6', '13', '0,0523', '50,038', '125600,971', '44,544', '2,998', '13,257', '33,783', '0,249'),
('Игнатьев В.Н.', '14ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '34', '3,2', '320', '4', '1', '0,9575', '0,2752', '0,26', '0,804', '926,54', '38,324', '0,033', '0,773', '0,136', '0,182', '120,16', '14,8', '0,05258', '54,866', '139826,46', '47,13', '0,98973', '6,652', '39,4887', '0,243'),
('Кулемин Д.А.', '14ЯР', 'м', 'Дунцев А.В.', '', 'Сухогруз', '42', '3,8', '320', '6', '2', '0,958', '0,328', '0,31', '0,824', '926,659', '47,311', '0,0384', '0,82', '0,123', '0,217', '551,553', '16', '0,0716', '41,8583', '107497,197', '56,523', '1,783', '7,7538', '46,9743', '0,233'),
('Репина Е.А.', '14ЯР', 'ж', 'Дунцев А.В.', '', 'Ледокол', '47', '4,2', '320', '4', '2', '0,9', '0,3612', '0,3413', '', '', '', '', '0,8178', '0,133', '0,2389', '528,998', '15,17', '0,0534', '72,1938', '179625,122', '63,19893', '2,5', '10,1765', '50,522', '0,2618'),
('Самойлов А.М.', '17ЯР', 'м', 'Дунцев А.В.', '5', 'Ледокол ', '28', '2,9', '285', '6', '1', '0,957', '0,249', '0,236', '0,824', '902,85', '32,406', '0,054', '0,811', '0,114', '0,165', '479,544', '16', '0,047', '48,326', '120178', '41,347', '2,273', '4,708', '34,366', '0,233'),
('Кабина М.С.', '17ЯР', 'ж', 'Дунцев А.В.', '4', 'Сухогруз', '35', '3,7', '280', '6', '3', '0,9575', '0,318', '0,3', '0,825', '925,33', '39,5', '0,0784', '0,757', '0,1213', '0,21', '746,018', '16,5', '0,1059', '62,788', '136814,9', '53,483', '3,434', '12,863', '37,626', '0,255'),
('Громов А.Д.', '17ЯР', 'м', 'Дунцев А.В.', '4', 'танкер', '25,5', '2,4', '300', '6', '2', '0,957', '0,2064', '0,195', '0,8276', '889,122', '29,97', '0,0414', '0,8058', '0,108', '0,1365', '484,64', '16', '0,0627', '43,1743', '109455,34', '37,0148', '1,462', '5,5738', '31,0436', '0,233'),
('Ермоленко Е.Д.', '17ЯР', 'ж', 'Дунцев А.В.', '5', 'сухогруз ', '35', '2,2', '300', '4', '3', '0,958', '0,1892', '0,1788', '0,8201', '911,4804', '40,0825', '0,0213', '0,7912', '0,1163', '0,1252', '633,1588', '14,13', '0,098', '52,8071', '122270,057', '53,078', '4,3737', '13,7257', '39,3845', '0,25'),
('Овчинникова В.В.', '17ЯР', 'ж', 'Дунцев А.В.', '4', 'танкер', '25', '3,1', '280', '4', '2', '0,956', '0,267', '0,252', '0,8236', '948,2626', '27,577', '0,0634', '0,8169', '0,1247', '0,1764', '520,8436', '16', '0,06746', '41,197', '100395,86', '25,2483', '1,875', '4,7657', '28,608', '0,249'),
('Капранов Н.С.', '17ЯР', 'м', 'Дунцев А.В.', '4', 'Танкер', '35', '3,5', '300', '6', '2', '0,9576', '0,301', '0,2844', '0,823', '918,6715', '39,7854', '0,05', '0,814', '0,122', '0,1995', '523,3901', '16', '0,067', '57,5334', '141751,6496', '49,0378', '2,38569', '6,113', '40,5158', '0,2478'),
('Багрова А.А.', '17ЯР', 'ж', 'Дунцев А.В.', '4', 'Сухогруз', '22', '3', '300', '7', '2', '0,955', '0,258', '0,244', '0,8238', '890,973', '25,856', '0,04', '0,807', '0,114', '0,159', '474,571', '17,4', '0,059', '37,321', '94390,743', '31,632', '1,2', '5,469', '26,929', '0,238'),
('Арсентьев С.И.', '17ЯР', 'м', 'Дунцев А.В.', '4', 'Танкер', '26', '3,2', '300', '5', '3', '0,956', '0,275', '0,26', '0,823', '927,67', '29,32', '0,0475', '0,812', '0,1207', '0,182', '709,051', '15,2', '0,0981', '44,13', '101067,686', '32,36', '1,543', '8,4115', '28,31', '0,257'),
('Зайцева С. Г.', '17ЯР', 'ж', 'Дунцев А.В.', '4', 'Ледокол', '25', '3,3', '280', '6', '1', '0,955', '', '', '0,8176', '907,6814', '28,8405', '0,0409', '0,7555', '0,1171', '0,1877', '496,2568', '17,3', '0,0451', '39,8893', '97101,2398', '39,8433', '1,3551', '5,04', '33,4482', '0,2189'),
('Сметанин Т.Р.  (Кабина)', '14ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '33', '3,8', '325', '4', '2', '0,9575', '0,3268', '0,3088', '0,822', '961,6', '35,841', '0,036', '0,81', '0,13', '0,2156', '551,016', '15,47', '0,07428', '50,385', '125654,22', '43,356', '1,38', '5,9875', '35,989', '0,2622'),
('Соколов Р. А.', '', 'м', 'Дунцев А.В.', '', '', '28', '2,6', '285', '4', '2', '0,958', '', '', '0,826', '933,056', '31,325', '0,075', '0,859', '0,124', '0,159', '502,12', '16', '0,066', '44,019', '109296,982', '37,654', '2,737', '4,572', '30,345', '0,256'),
('Кейков А.С. (Ермоленко)', '17ЯР', 'м', 'Дунцев А.В.', '', 'Сухогруз', '28', '3,3', '300', '4', '2', '0,957', '0,284', '0,268', '0,824', '952,286', '30,724', '0,05', '0,815', '0,127', '0,188', '496,445', '15,73', '0,066', '38,154', '94025,433', '37,901', '1,695', '13,229', '30,928', '0,254'),
('Кайнова А.В.  (Кабина)', '13ЯР', 'ж', 'Дунцев А.В.', '', 'Ледокол', '25,5', '2,4', '300', '6', '1', '0,9552', '0,206', '0,195', '0,8304', '892,301', '29,918', '0,036', '0,813', '0,108', '0,127', '446,241', '16,6', '0,045', '43,052', '110867,1002', '36,685', '1,247', '3,55', '31,888', '0,23'),
('Пшечук А. В. (Овчинникова)', '17ЯР', 'ж', 'Дунцев А.В.', '', 'танкер', '25', '2,9', '300', '6', '2', '0,956', '0,249', '0,236', '0,824', '903,247', '28,952', '0,051', '0,9426', '0,1142', '0,1652', '511,378', '19', '0,0671', '41,682', '103979,226', '34,908', '1,714', '4,363', '28,831', '0,2405'),
('Колычихина о.А. (Герман)', '13ЯР', 'ж', 'Дунцев А.В.', '', '', '25', '3,3', '310', '6', '3', '0,95', '', '', '0,811', '899,79', '40,945', '0,046', '0,796', '0,112', '0,189', '497,85', '15,12', '0,103', '52,662', '101803,792', '45,998', '1,797', '8,166', '34,183', '0,274'),
('Ермолаев А.А. (Самойлов)', '13ЯР', 'м', 'Дунцев А.В.', '', 'Танкер', '28', '2,5', '310', '7', '2', '0,9577', '0,215', '0,203', '0,797', '843,14', '34,67', '0,017', '0,707', '0,098', '0,132', '451,38', '15,6', '0,057', '49,024', '126780', '41,667', '0,624', '3,621', '37,35', '0,221'),
('Гордеева Д.М.', '17ЯР', 'ж', 'Дунцев А.В.', '', '', '30', '2,8', '295', '6', '2', '0,957', '0,2236', '0,2113', '0,8257', '894,7158', '41,2804', '0,0374', '0,8049', '0,1126', '0,1479', '465,3465', '15,04', '0,0589', '50,0423', '12697', '42,6955', '', '11,7234', '36,7821', '0,2362'),
('Гурьева Е.A  (Кабина)', '14ЯР', 'ж', 'Дунцев А.В.', '', 'Сухогруз', '32', '3', '310', '4', '3', '0,958', '0,258', '0,244', '0,828', '951,5189', '35,105', '0,0358', '0,728', '0,123', '0,161', '639,925', '15', '0,08998', '52,45', '133998,654', '45,2386', '1,4', '9,54983', '34,288', '0,236'),
('Помысухина А.Е. (Багрова)', '13ЯР', 'ж', 'Дунцев А.В.', '', 'Танкер', '28', '2,9', '320', '6', '3', '0,957', '0,2494', '0,236', '0,824', '902,884', '32,405', '0,0303', '0,814', '0,1143', '0,1652', '477,318', '15', '0,0903325', '46,6754', '110697,774', '40,5725', '1,0304', '8,3258', '31,2164', '0,253'),
('Филимонов А.Ф. (Багрова)', '13ЯР', 'м', 'Дунцев А.В.', '', 'Танкер', '45', '2,5', '300', '4', '3', '0,961', '0,215', '0,2032', '0,828', '932,632', '50,209', '0,0387', '0,821', '0,1213', '0,1422', '433,279', '12,68', '0,0922', '72,649', '170374,2904', '64,586', '2,125', '13,5529', '48,908', '0,264'),
('Бочкарева Т.В. (Арсентьев)', '13ЯР', 'ж', 'Дунцев А.В.', '', '', '26', '3,2', '325', '5', '1', '0,956', '0,275', '0,26', '0,823', '928,092', '29,3', '0,048', '0,794', '0,12', '0,182', '492,13', '13,5', '0,05', '42,6638', '109263,257', '36,6796', '0,7042', '6,1932', '29,7822', '0,237'),
('Гриценко С.В. (Овчинникова)', '13ЯР', 'м', 'Дунцев А.В.', '', '', '33', '3', '310', '4', '3', '0,958', '0,258', '0,244', '0,827', '947,483', '35,273', '0,037', '0,734', '0,124', '0,171', '690,638', '11,4', '0,0945', '50,181', '106273,928', '44,916', '1,418', '9,492', '29,721', '0,2718'),
('Свешников А.А. (Овчинникова)', '14ЯР', 'м', 'Дунцев А.В.', '', '', '38', '4', '320', '4', '3', '0,957', '0,344', '0,325', '0,821', '964,753', '41,158', '0,046', '0,88', '0,126', '0,2269', '779,882', '16', '0,127', '62,6', '138010,111', '53,61', '2,094', '11,3981', '40,72', '0,27'),
('Субарев М.А. (Арсентьев)', '13ЯР', 'м', 'Дунцев А.В.', '', '', '38', '4,1', '330', '5', '2', '0,958', '0,353', '0,333', '0,787', '946,319', '41,916', '0,038', '0,747', '0,13', '0,233', '525,47', '15,67', '0,074', '62,587', '157974,178', '53,281', '1,908', '15,897', '44,7826', '0,241'),
('Минеев  И.В. (Самойлов)', '13ЯР', 'м', 'Дунцев А.В.', '', 'Танкер', '28', '3,3', '325', '4', '3', '0,957', '0,284', '0,268', '0,824', '952,303', '35,52', '0,029', '0,799', '0,117', '0,199', '701,803', '15,8', '0,098', '46,28', '108689', '39,945', '0,97', '8,998', '29,978', '0,258'),
('Харчева  Ю.В. (Герман)', '13ЯР', 'ж', 'Дунцев А.В.', '', '', '35', '3,9', '325', '4', '1', '0,9575', '0,3354', '0,316', '0,82', '961,227', '38,027', '0,0447', '0,82', '0,12', '0,2212', '517,63', '16,1', '0,0532', '53,4474', '135155,3147', '45,9283', '1,9611', '6,3187', '37,6485', '0,258'),
('Паранин Д.В.  (Громов)', '13ЯР', 'м', 'Дунцев А.В.', '', '', '25', '2,9', '320', '6', '2', '0,956', '0,2494', '0,2357', '0,826', '904,621', '29,268', '0,0215', '0,792', '0,1146', '0,1649', '479,376', '16,2', '0,0615', '41,09', '105577,199', '34,758', '1,05', '3,591', '30,117', '0,237'),
('Рамаев А.Д. (Громов)', '', 'м', 'Дунцев А.В.', '', '', '35', '2,7', '310', '5', '1', '0,959', '0,336', '0,318', '0,823', '970', '50,523', '0,046', '0,809', '0,132', '0,206', '508,7', '14,3', '0,051', '56,254', '144883,211', '62,78', '2,8', '8,584', '51,82', '0,24'),
('Шарафетдинова К.В. (Соколов Р.А.)', '14ЯР', 'ж', 'Дунцев А.В.', '', '', '37', '3,2', '325', '5', '3', '0,958', '0,275', '0,26', '0,83', '935,82', '41,27', '0,018', '0,79', '0,12', '0,182', '684,545', '17,9', '0,101', '68,7551', '178801,3', '58,7588', '0,952', '12,1368', '45,67', '0,205'),
('Лобанов  Д.М. (Соколов Р.А.)', '14ЯР', 'м', 'Дунцев А.В.', '', '', '44', '4', '320', '6', '3', '0,958', '0,334', '0,325', '0,823', '924,865', '49,66', '0,044', '0,812', '0,1234', '0,2322', '753,723', '15', '0,103', '73,1446', '165866,689', '64,21', '2,365', '15,668', '46,177', '0,265'),
('Бородин Д.И. (Зайцева)', '14ЯР', 'м', 'Дунцев А.В.', '', '', '25', '2,4', '285', '6', '1', '0,9545', '0,206', '0,195', '0,826', '883,13', '29,657', '0,05822', '0,8059', '0,104', '0,1365', '465,81', '15', '0,04947', '42,272', '106521,893', '37,084', '1,83', '10,2263', '30,216', '0,23581'),
('Барцев А.Ю. (Зайцева)', '14ЯР', 'м', 'Дунцев А.В.', '', '', '29,5', '3,2', '300', '6', '2', '0,9575', '0,275', '0,259', '0,826', '914,207', '33,701', '0,0427', '0,788393004', '0,121', '0,182', '874,172', '15,7', '0,0662', '48,7324', '120489,253', '41,9013', '1,607', '12,7875', '34,3379', '0,244'),
('Васильева Т.В. (Капранов)', '13ЯР', 'ж', 'Дунцев А.В.', '', '', '25', '2,8', '320', '7', '2', '0,956', '0,241', '0,228', '0,824', '886,768', '29,49', '0,0261', '0,791', '0,1043', '0,1411', '489,0395', '16', '0,0623', '41,8582', '107497,197', '35,484', '0,859', '3,801', '30,824', '0,233'),
('Галстян К.Г.  (Капранов)', '13ЯР', '', 'Дунцев А.В.', '', '', '30', '2,6', '300', '', '1', '0,958', '0,2236', '0,2113', '0,827', '895,802', '34,958', '0,0495', '0,7999', '0,1127', '0,148', '472,549', '20', '0,0517', '50,983', '128792,1', '42,25', '2,011', '5,90113', '34,327', '0,234'),
('Логинова С.С.  (Шишов)', '13ЯР', 'ж', 'Дунцев А.В.', '', '', '35', '3,5', '325', '6', '2', '0,958', '0,301', '0,284', '0,825', '920,91', '39,67', '0,0321', '0,81', '0,12', '0,1988', '349,57', '15', '0,0706', '47,067', '128796,097', '47,06', '1,42', '5,79', '39,851', '0,253'),
('Мулин М.М. (Шишов)', '13ЯР', 'м', 'Дунцев А.В.', '', '', '25', '3,1', '330', '4', '1', '', '0,267', '0,252', '', '', '31,508', '', '0,787', '0,1214', '0,176', '487,708', '19,1', '0,051', '31,508', '92616,062', '34,311', '0,512', '5,1', '34,336', '0,239'),
('Кузьма М.М. (Филатова Е.А,)', '13ЯР', '', 'Дунцев А.В.', '', '', '35', '3,7', '330', '6', '1', '0,9575', '0,32', '0,304', '0,823', '924,183', '35,597', '0,0325', '0,815', '0,122', '0,224', '520,125', '18,279', '0,0538', '56,83', '143768,43', '48,1527', '1,4706', '7,322', '39,3602', '0,2434'),
('Тимофеев Ю.А (Филатова Е.А.)', '', 'м', 'Дунцев А.В.', '', '', '28', '3,6', '400', '5', '2', '0,9', '0,31', '0,293', '0,82', '844,516', '35,104', '0,032', '0,804', '0,123', '0,203', '543,091', '15,83', '0,07', '37,885', '101497,395', '37,885', '1,119', '5,491', '31,392', '0,26'),
('Герман Н.В.', '17ЯР', 'м', 'Дунцев А.В.', '5', 'Сухогруз', '25', '2,8', '300', '7', '2', '0,956', '0,241', '0,228', '0,823', '883,641', '29,594', '0,0398', '0,805', '0,1086', '0,1596', '475,014', '16,2', '0,0597', '42,342', '107304,364', '36,176', '1,371', '5,909', '30,783', '0,233'),
('Сатаев А.А. (Ермоленко)', '12ЯР', 'м', 'Дунцев А.В.', '', 'Танкер', '44', '4', '320', '6', '3', '0,9585', '0,344', '0,32508', '0,824', '930,879', '49,314', '0,048', '0,8211', '0,124', '0,2276', '522,236', '13,83', '0,0916', '71,456', '164630,3998', '62,51038', '2,5208', '15,843', '46,23778', '0,26695'),
('Ярахтин М.С. (Ермоленко)', '12ЯР', 'м', 'Дунцев А.В.', '', 'Сухогруз', '20', '3', '320', '7', '2', '0,954', '0,258', '0,244', '0,847', '918,91', '22,81', '0,028', '0,823', '0,121', '0,171', '483,8', '9,65', '0,0597', '30,06', '77348,15', '27,33', '0,71', '3,85', '23,41', '0,2564'),
('Красавин Н.А. 12ЯР (Герман)', '12ЯР', 'м', 'Дунцев А.В.', '', 'Сухогруз', '42', '3,8', '320', '6', '2', '0,959', '0,327', '0,309', '0,824', '926,176', '47,296', '0,045', '0,818', '0,122', '0,2163', '515,107', '14,16', '0,067', '64,913', '163262,863', '56,681', '2,414', '7,727', '46,556', '0,2573'),
('Арбузова С.М. (Багрова)', '12ЯР', 'ж', 'Дунцев А.В.', '', 'Ледокол', '29,5', '3,2', '300', '6', '2', '0,956', '0,275', '0,26', '0,8274', '915,109', '39,602', '0,053', '0,814', '0,12', '0,182', '492,13', '15', '0,0678', '49,0219', '120873,673', '41,8718', '2,1355', '3,5575', '33,1788', '0,2697'),
('Голяшкова И.Н (Кабина)', '12ЯР', 'ж', 'Дунцев А.В.', '', 'Сухогруз', '32', '3', '310', '4', '3', '0,958', '0,258', '0,244', '0,824', '947,483', '35,273', '0,037', '0,734', '0,124', '0,171', '690,638', '11,4', '0,0945', '50,181', '106273,928', '44,916', '1,418', '9,492', '29,721', '0,2718'),
('Токарев М.С. (Ермоленко)', '12ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '22', '3,4', '325', '5', '1', '0,955', '0,292', '0,276', '0,823', '933,16', '24,687', '0,0315', '0,81', '0,123', '0,19', '497,83', '17,75', '0,0505', '35,2906', '90247,09', '29,8931', '0,8848', '3,9287', '25,8931', '0,2442'),
('Смирнов Д.Н.   (Овчинникова)', '12ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '47', '4,2', '320', '4', '1', '0,959', '0,336', '0,318', '0,822', '970', '57,79', '0,046', '0,809', '0,132', '0,206', '508,7', '14,3', '0,051', '71,93', '180510', '62,78', '2,8', '8,584', '51,82', '0,26'),
('Бирин Д.С. (Громов)', '12ЯР', 'м', 'Дунцев А.В.', '', 'Сухогруз', '25', '2,4', '285', '6', '3', '0,9557', '0,2088', '0,19608', '0,825', '997,42', '26,19', '0,00958', '0,811', '0,14', '0,1393', '715,409', '14,8', '0,088', '47,16', '106422,92', '40,83', '1,39', '8,632', '30,808', '0,243'),
('Галанин В.В. (Самойлов)', '12ЯР', 'м', 'Дунцев А.В.', '', 'Танкер', '36', '3,6', '320', '6', '3', '0,9525', '0,31', '0,293', '0,804', '903,18', '47,3', '0,048', '0,853', '0,1', '0,291', '725', '14', '0,096', '61,26', '140782', '52,562', '2,19', '11,586', '38,686', '0,262'),
('Тихонов А.В. (Соколов)', '12ЯР', 'м', 'Дунцев А.В.', '', 'Сухогруз', '28', '3,6', '330', '5', '2', '0,31', '0,293', '0,956', '0,847', '965,6', '30,33', '0,031', '0,842', '0,132', '0,205', '508', '14,1', '0,0661', '40,939', '104603,1', '34,521', '1,215', '5,231', '28,075', '0,2677'),
('Конькова М.Н. (Арсентьев)', '10ЯР1', 'ж', 'Дунцев А.В.', '', 'Ледокол', '38', '3,9', '300', '7', '1', '0,958', '0,335', '0,317', '0,822', '911,66', '43,51', '0,067', '0,788', '0,12', '0,202', '554,862', '15', '0,055', '66,556', '159038,11', '56,51', '3,673', '7,9565', '44,8851', '0,24'),
('Мухряков Ю.А. (Борисов)', '11ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '35', '3,7', '330', '6', '1', '0,958', '0,318', '0,301', '0,827', '927,615', '39,38', '0,0342', '0,818', '0,1', '0,223', '519,47', '17', '0,054', '55,57', '141365,932', '47,906', '1,547', '15,741', '38,282', '0,247'),
('Квашенников А. С. (Кот)', '11ЯР', 'м', 'Дунцев А.В.', '', 'Сухогруз', '35', '3,5', '325', '6', '2', '0,958', '0,301', '0,284', '0,812', '918,495', '33,43', '0,0273', '0,809', '0,119', '', '', '14,8', '', '54,993', '138193,7', '47,523', '', '', '39,465', '0,253'),
('Власов Д.А. (Тряков Д.И.)', '11ЯР', 'м', 'Дунцев А.В.', '', 'Сухогруз', '22', '3', '320', '7', '3', '0,955', '0,258', '0,24', '0,823', '903,82', '25,488', '0,031', '0,813', '0,11', '0,17', '680,258', '16,85', '0,0879', '37,95', '90090,574', '32,598', '0,829', '5,479', '25,197', '0,2457'),
('Лотырев Д.А. (Тряков Д.И.)', '11ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '25,5', '2,4', '300', '6', '1', '0,957', '0,206', '0,195', '0,827', '888,602', '29,986', '0,03', '0,799', '0,105', '0,1365', '453,8', '15,2', '0,0453', '43,2076', '110991,821', '37,535', '1,051', '8,958', '33,199', '0,23'),
('Куликов Е.И. (Егарева О.О.)', '11ЯР', 'м', 'Дунцев А.В.', '', 'Сухогруз', '33', '2,6', '290', '6', '3', '', '0,224', '0,212', '', '895,885', '38,49', '0,041', '0,791', '0,113', '0,2175', '', '16,3', '0,1381', '58,145', '129272,515', '50,109', '', '8,1557', '39,123', '0,255'),
('Соколов А.В. (Шишов А.Р.)', '12ЯР', 'м', 'Дунцев А.В.', '', 'Танкер', '38', '4', '320', '4', '3', '0,95', '0,344', '0,325', '0,811', '952,162', '42,01', '0,048', '0,794', '0,126', '0,224', '520,095', '13', '0,0879', '54,985', '121139,1876', '62,133', '2,272', '16,834', '38,139', '0,276'),
('Калатинская А.С. (Капранов Н.С.)', '12ЯР', 'ж', 'Дунцев А.В.', '', 'Ледокол', '30', '2,8', '300', '4', '1', '0,958', '0,2408', '0,228', '0,826', '940,126', '38,823', '0,031', '0,847', '0,122', '0,158', '473,3', '12,3', '', '47,72', '121005,49', '41,5239', '1,661', '6,1961', '35,0923', '0,2518'),
('Волгин И.Б. (Обидина К.А.)', '11ЯР', 'м', 'Дунцев А.В.', '', 'Танкер', '25', '2,8', '320', '7', '2', '0,954', '0,241', '0,228', '0,82', '880,47', '29,76', '0,019', '0,79', '0,11', '0,168', '496,41', '9,76', '0,0632', '39,529', '101239,89', '34,845', '29,712', '9,2254', '29,712', '0,25'),
('Кузнецов В.И.(Лебедев В.В.)', '11ЯР', 'м', 'Дунцев А.В.', '', 'Ледокол', '30', '2,6', '300', '6', '1', '', '0,224', '0,211', '', '', '', '', '0,794', '0,114', '0,21', '511,288', '15', '0,0457', '50,009', '127583,46', '43,489', '38,134', '', '', '0,235'),
('Измайлова Д.Р. (Лебедев В.В.)', '11ЯР', 'ж', 'Дунцев А.В.', '', 'Танкер', '28', '2,5', '310', '7', '2', '0,956', '0,215', '0,203', '0,826', '875,973', '38,6', '0,0273', '0,72', '0,105', '0,202', '506,041', '12,9', '', '45,738', '126200', '39,12', '33,7', '', '', '0,247'),
('Шишов А. Р.', '17ЯР', 'м', 'Дунцев А.В.', '5', 'Сухогруз', '35', '2,7', '285', '5', '3', '0,958', '0,2322', '0,2194', '0,82', '909,608', '40,165', '0,0456', '0,8', '0,1164', '0,15358', '679,1', '15', '0,0949', '63,17', '144506,3', '53,687', '2,427', '13,397', '39,713', '0,242'),
('Орлик Е.А. (Миронченков С.Р.)', '11ЯР', 'ж', 'Дунцев А.В.', '', 'Танкер', '28', '3,3', '325', '4', '3', '0,957', '0,284', '0,264', '0,823', '951,4', '30,75', '0,0283', '0,8', '0,1267', '0,189', '545,17', '15', '0,0953', '44,139', '105654,776', '38,313', '0,873', '14,538', '28,72', '0,265'),
('Моисеев Т.И. (Миронченков С.Р)', '11ЯР', 'м', 'Дунцев А.В.', '', 'Танкер', '25', '3,3', '310', '6', '3', '0,956', '0,2838', '0,2682', '0,821', '911,025', '28,705', '0,0406', '0,808', '0,1174', '0,188', '496,755', '15,5', '0,0963', '42,477', '98028,696', '36,914', '1,247', '11,106', '2,613', '0,254'),
('', '', '', '3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('', '', '', '1', '10ЯР1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('', '', '', '10', '11ЯР', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('', '', '', '12', '12ЯР', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('', '', '', '16', '13ЯР', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('', '', '', '13', '14ЯР', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_880E0D76E7927C74` (`email`);

--
-- Индексы таблицы `coursework`
--
ALTER TABLE `coursework`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6BA9F7485E237E06` (`name`);

--
-- Индексы таблицы `coursework_2`
--
ALTER TABLE `coursework_2`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `coursework`
--
ALTER TABLE `coursework`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
