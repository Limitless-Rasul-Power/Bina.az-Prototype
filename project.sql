-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2022 at 12:22 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE `apartment` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`id`, `name`) VALUES
(1, '--yeni tikili'),
(2, '--köhnə tikili');

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `roomCount` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `floor` int(11) NOT NULL,
  `maxFloor` int(11) NOT NULL,
  `desc` text NOT NULL,
  `price` int(11) NOT NULL,
  `regionId` int(11) NOT NULL,
  `pictures` varchar(500) NOT NULL,
  `documentStatus` int(11) NOT NULL,
  `mortgageStatus` int(11) NOT NULL,
  `rentOption` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`id`, `userId`, `status`, `categoryId`, `roomCount`, `area`, `address`, `floor`, `maxFloor`, `desc`, `price`, `regionId`, `pictures`, `documentStatus`, `mortgageStatus`, `rentOption`) VALUES
(2, 5, 'sell', 1, 4, 180, 'Cəfər Cabbarlı Abidəsi', 9, 16, 'ə bə qarduaaş', 240000, 22, 'first.jpg,fourth.jpg,second.jpg,third.jpg', 1, 0, ''),
(3, 6, 'rent', 2, 3, 120, 'Gülarə Qədirbəyova 63, mənzil 54', 6, 20, 'Bina Heydər Əliyev Mərkəzi ilə üzbəüz yerləşir.\r\nBinanın yerləşməsi idealdır: binanın qarşısında bağça və məktəb mövcuddur, arxasında avtobus dayanacağı, yanında supermarket (Grandmart) yerləşir. 2 otaqdan 3 otağa peredelka olub.\r\n\r\n- Mərkəzi İstilik Sistemi var\r\n- Binada lift yeni dəyişib (işləkdir)\r\n- Künc ev deyil (orta blok)\r\n- Blok Qapısı Domofondur\r\n- Pəncərələr Heydər Əliyev Mərkəzinə baxır\r\n\r\n450 AZN qiymət sondur !', 450, 14, 'fourth.jpg,first.jpg,second.jpg,third.jpg', 0, 0, 'ayda'),
(4, 19, 'sell', 1, 3, 180, 'Semed Vurghun Parki', 5, 50, 'Bir ay ərzində eyni nömrədən 3 pulsuz (təkrar olmayan) elan yerləşdirmək olar. Elanı başqa bir elanla əvəz etmək qadağandır. Saytda artıq mövcud olan daşınmaz əmlakın təkrarən yerləşdirilməsi yalnız ödənişli əsaslarla mümkündür. Bununla belə, bir istifadəçi eyni daşınmaz əmlak obyektini yalnız bir dəfə yerləşdirə bilər.\r\nƏgər siz 1 ay ərzində 4 və daha artıq elan yerləşdirmək istəsəniz, hər növbəti elanın qiyməti - 5 AZN olacaq.\r\nElanlar vaxtından əvvəl silinsə də, nömrə üçün nəzərdə tutulmuş ödənişsiz yer, elan dərc ediləndən 30 gün sonra bərpa edilir.\r\nbina.az saytında istifadə etdiyiniz ödənişli xidmətlər üçün nəzərdə tutulan məbləğ geri qaytarılmır.\r\nZəhmət olmasa elanı yerl', 180000, 16, 'first.jpg,fourth.jpg,second.jpg,third.jpg', 0, 1, ''),
(5, 20, 'sell', 1, 5, 200, 'Milyonerlər məhəlləsi', 6, 20, 'elave melumatlarin hamisi sekillerin icindedi. Nece deyerler 1000 soz 1 sekile beraberdir.', 300000, 14, 'beauty.jfif,bedroom.jfif,front.jfif,inside.jfif,keys.jfif,side.jfif,stairs.jfif,tables.jfif', 1, 1, ''),
(6, 21, 'rent', 1, 3, 120, 'Tərlan Şadlıq Sarayının yanı', 5, 9, 'Bina Heydər Əliyev Mərkəzi ilə üzbəüz yerləşir.\r\nBinanın yerləşməsi idealdır: binanın qarşısında bağça və məktəb mövcuddur, arxasında avtobus dayanacağı, yanında supermarket (Grandmart) yerləşir. 2 otaqdan 3 otağa peredelka olub.\r\n\r\n- Mərkəzi İstilik Sistemi var\r\n- Binada lift yeni dəyişib (işləkdir)\r\n- Künc ev deyil (orta blok)\r\n- Blok Qapısı Domofondur\r\n- Pəncərələr Heydər Əliyev Mərkəzinə baxır\r\n\r\n450 AZN qiymət sondur !', 1000, 15, '1.jfif,2.jfif,3.jfif,4.jfif,5.jfif,6.jfif,7.jfif,8.jfif', 0, 0, 'ayda'),
(10, 26, 'sell', 1, 3, 120, 'Meyvəlinin yanı', 5, 9, 'ır.\r\nZəhmət olmasa elanı yerləşdirən zaman əlaqə vasitələrini (telefon nömrəsi, e-mail ünvanını) düzgün qeyd edin. Telefon nömrəsi ilə bağlı heç bir dəyişiklik həyata keçirilmir.\r\nElanınızla bağlı bütün məlumatlar sizin e-mail ünvanınıza göndərilir.\r\nƏmlakın təsvirində məlumatları böyük hərflərlə yazmaq, həmçinin telefon nömrəsi, e-mail ünvanı və şirkət haqqında xidmətləri yazmaq qadağandır.\r\nƏmlakın fasad (günorta vaxtı çəkilmiş) və otaq şəkilləri mütləq olmalıdır.\r\nÜzərində bina.az saytı da daxil olmaqla digər saytların loqotipləri olan şəkillər qəbul edilməyəcək.\r\nQiymət tam qeyd edilməlidir. (Qiyməti ilkin ödəniş və ya 1 sot, 1 m² üçün yazmaq olmaz)\r\nÜnvanı xəritədə dəqiq göstərməyiniz vacibdir.', 90000, 15, '1.jfif,2.jfif,3.jfif,4.jfif,5.jfif,6.jfif,7.jfif,8.jfif,9.jfif,10.jfif,11.jfif,12.jfif,13.jfif,14.jfif,15.jfif,16.jfif', 1, 1, ''),
(11, 29, 'sell', 1, 3, 80, 'Semed Vurghun Parki', 3, 8, 'Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 Lorem 10 ', 100000, 15, '9.jfif,10.jfif,11.jfif,12.jfif', 0, 0, ''),
(12, 30, 'sell', 2, 2, 80, 'Dernegul', 1, 9, '.\r\nElanlar vaxtından əvvəl silinsə də, nömrə üçün nəzərdə tutulmuş ödənişsiz yer, elan dərc ediləndən 30 gün sonra bərpa edilir.\r\nbina.az saytında istifadə etdiyiniz ödənişli xidmətlər üçün nəzərdə tutulan məbləğ geri qaytarılmır.\r\nZəhmət olmasa elanı yerləşdirən zaman əlaqə vasitələrini (telefon nömrəsi, e-mail ünvanını) düzgün qeyd edin. Telefon nömrəsi ilə bağlı heç bir dəyişiklik həyata keçirilmir.\r\nElanınızla bağlı bütün məlumatlar sizin e-mail ünvanınıza göndərilir.\r\nƏmlakın təsvirində məlumatları böyük hərflərlə yazmaq, həmçinin telefon nömrəsi, e-mail ünvanı və şirkət haqqında xidmətləri yazmaq qadağandır.\r\nƏmlakın fasad (günorta vaxtı çəkilmiş) və otaq şəkilləri mütləq olmalıdır.\r\nÜzərində bina.az saytı da daxil olmaqla digər saytların loqotipləri olan şəkillər qəbul edilməyəcək.', 70000, 10, '39.jfif,40.jfif,41.jfif,42.jfif', 1, 0, ''),
(13, 31, 'sell', 1, 3, 90, 'Kemale ve Nermin', 9, 20, 'atları böyük hərflərlə yazmaq, həmçinin telefon nömrəsi, e-mail ünvanı və şirkət haqqında xidmətləri yazmaq qadağandır.\r\nƏmlakın fasad (günorta vaxtı çəkilmiş) və otaq şəkilləri mütləq olmalıdır.\r\nÜzərində bina.az saytı da daxil olmaqla digər saytların loqotipləri olan şəkillər qəbul edilməyəcək.\r\nQiymət tam qeyd edilməlidir. (Qiyməti ilkin ödəniş və ya 1 sot, 1 m² üçün yazmaq olmaz)\r\nÜnvanı xəritədə dəqiq göstərməyiniz vacibdir.\r\nFərqli vasitəçi və şirkətlər eyni elanı ödənişli yerləşdirə bilərlər.', 100000, 3, '17.jfif,18.jfif,19.jfif,20.jfif', 1, 1, ''),
(14, 33, 'rent', 2, 3, 90, 'Safa Store', 2, 9, 'ən zaman əlaqə vasitələrini (telefon nömrəsi, e-mail ünvanını) düzgün qeyd edin. Telefon nömrəsi ilə bağlı heç bir dəyişiklik həyata keçirilmir.\nElanınızla bağlı bütün məlumatlar sizin e-mail ünvanınıza göndərilir.\nƏmlakın təsvirində məlumatları böyük hərflərlə yazmaq, həmçinin telefon nömrəsi, e-mail ünvanı və şirkət haqqında xidmətləri yazmaq qadağandır.\nƏmlakın fasad (günorta vaxtı çəkilmiş) və oən zaman əlaqə vasitələrini (telefon nömrəsi, e-mail ünvanını) düzgün qeyd edin. Telefon nömrəsi ilə bağlı heç bir dəyişiklik həyata keçirilmir.\nElanınızla bağlı bütün məlumatlar sizin e-mail ünvanınıza göndərilir.\nƏmlakın təsvirində məlumatları böyük hərflərlə yazmaq, həmçinin telefon nömrəsi, e-mail ünvanı və şirkət haqqında xidmətləri yazmaq qadağandır.\nƏmlakın fasad (günorta vaxtı çəkilmiş) və oən zaman əlaqə vasitələrini (telefon nömrəsi, e-mail ünvanını) düzgün qeyd edin. Telefon nömrəsi ilə bağlı heç bir dəyişiklik həyata keçirilmir.\nElanınızla bağlı bütün məlumatlar sizin e-mail ünvanınıza göndərilir.\nƏmlakın təsvirində məlumatları böyük hərflərlə yazmaq, həmçinin telefon nömrəsi, e-mail ünvanı və şirkət haqqında xidmətləri yazmaq qadağandır.\nƏmlakın fasad (günorta vaxtı çəkilmiş) və oən zaman əlaqə vasitələrini (telefon nömrəsi, e-mail ünvanını) düzgün qeyd edin. Telefon nömrəsi ilə bağlı heç bir dəyişiklik həyata keçirilmir.\nElanınızla bağlı bütün məlumatlar sizin e-mail ünvanınıza göndərilir.\nƏmlakın təsvirində məlumatları böyük hərflərlə yazmaq, həmçinin telefon nömrəsi, e-mail ünvanı və şirkət haqqında xidmətləri yazmaq qadağandır.\nƏmlakın fasad (günorta vaxtı çəkilmiş) və oən zaman əlaqə vasitələrini (telefon nömrəsi, e-mail ünvanını) düzgün qeyd edin. Telefon nömrəsi ilə bağlı heç bir dəyişiklik həyata keçirilmir.\nElanınızla bağlı bütün məlumatlar sizin e-mail ünvanınıza göndərilir.\nƏmlakın təsvirində məlumatları böyük hərflərlə yazmaq, həmçinin telefon nömrəsi, e-mail ünvanı və şirkət haqqında xidmətləri yazmaq qadağandır.\nƏmlakın fasad (günorta vaxtı çəkilmiş) və o', 25, 10, '33.jfif,34.jfif,37.jfif,38.jfif', 0, 0, 'gündə'),
(15, 34, 'sell', 1, 3, 120, 'Mir Cəlal kücəsi 7', 18, 20, 'Bir ay ərzində eyni nömrədən 3 pulsuz (təkrar olmayan) elan yerləşdirmək olar. Elanı başqa bir elanla əvəz etmək qadağandır. Saytda artıq mövcud olan daşınmaz əmlakın təkrarən yerləşdirilməsi yalnız ödənişli əsaslarla mümkündür. Bununla belə, bir istifadəçi eyni daşınmaz əmlak obyektini yalnız bir dəfə yerləşdirə bilər.\r\nƏgər siz 1 ay ərzində 4 və daha artıq elan yerləşdirmək istəsəniz, hər növbəti elanın qiyməti - 5 AZN olacaq.\r\nElanlar vaxtından əvvəl silinsə də, nömrə üçün nəzərdə tutulmuş ödənişsiz yer, elan dərc ediləndən 30 gün sonra bərpa edilir.\r\nbina.az saytında istifadə etdiyiniz ödənişli xidmətlər üçün nəzərdə tutulan məbləğ geri qaytarılmır.\r\nZəhmət olmasa elanı yerləşdirən zaman əlaqə vasitələrini (telefon nömrəsi, e-mail ünvanını) düzgün qeyd edin. Telefon nömrəsi ilə bağlı heç bir dəyişiklik həyata keçirilmir.\r\nElanınızla bağlı bütün məlumatlar sizin e-mail ünvanınıza göndərilir.\r\nƏmlakın təsvirində məlumatları böyük hərflərlə yazmaq, həmçinin telefon nömrəsi, e-mail ünvanı və şirkət haqqında xidmətləri yazmaq qadağandır.', 200000, 28, '21.jfif,22.jfif,25.jfif,26.jfif,29.jfif,30.jfif', 1, 1, ''),
(16, 35, 'sell', 1, 2, 60, '8 noyabr pr. 15', 9, 9, 'TƏCİLİ !!!\r\n\r\nSərfəli qiymət!\r\n\r\nXətai rayonu, 8 Noyabr ( Nobel) prospektində, \"Nargilə kafesi\" kimi tanınan ərazinin yaxınlığında yerləşən köhnə tikili binada iki otaqlı yaxşı təmirli mənzil satılır.\r\n\r\nÇIXARIŞ var.\r\nQAZ var.\r\n\r\nİki açıq eyvan və dənizə açlıan əla panorama\r\nÇılçıraqlar.\r\nMərkəzi istilik sistemi\r\nKondisioner\r\nMətbəx mebeli və avadanlıqları\r\nAyrı-ayrı otaqlar\r\nAyrı sanitar qovşağı\r\n\r\nİnkişaf etmiş infrastruktur:\r\nƏyləncə, istirahət və sağlamlıq mərkəzləri.\r\nBöyük supermarketlər,\r\n\r\nUşaq üçün oyun meydançası.\r\nGeniş həyət.\r\nYerüstü parking.\r\n\r\nDİQQƏT !!!\r\n\r\nAlıcının reallığından aslı olaraq müəyyən endirim nəzərdə tutulub.', 77000, 26, '28.jfif,32.jfif,36.jfif,40.jfif', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Astara'),
(2, 'Bakı'),
(3, 'Naxçıvan');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `ownership` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(80) NOT NULL,
  `postDate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `fullName`, `ownership`, `phone`, `email`, `postDate`) VALUES
(5, 'Leanne Graham 111', 'owner', '123-321-00-00', 'Nathan@yesenia.net 1', '12/29/2021 00:03'),
(6, 'Qasımov Aftandil', 'agent', '050-555-55-55', 'john@example.com', '12/31/2021 14:38'),
(19, 'Məzahir İsmayılov', 'agent', '050-555-55-55', 'mezi@iska.ru', '01/02/2022 20:28'),
(20, 'Abbasquliyev Elgün', 'agent', '055-920-90-45', 'elgunabba@gmail.com', '01/02/2022 20:38'),
(21, 'Abbasquliyev Elgün', 'agent', '055-920-90-45', 'elgunabba@gmail.com', '01/03/2022 14:40'),
(26, 'Abbasquliyev Elgün', 'owner', '055-920-90-45', 'elgunabba@gmail.com', '01/03/2022 15:43'),
(29, 'Daniel Defo', 'agent', '050-555-55-55', 'john@example.com', '01/03/2022 15:49'),
(30, 'Daniel Defo', 'agent', '123-321-00-00', 'john@example.com', '01/04/2022 14:44'),
(31, 'Daniel Defo', 'owner', '123-321-00-00', 'john@example.com', '01/04/2022 14:47'),
(33, 'Daniel Defo', 'owner', '050-777-99-88', 'john@example.com', '01/04/2022 15:47'),
(34, 'Ümüdov Elməddin', 'agent', '050-230-00-30', 'elmeumud@gmail.com', '01/05/2022 10:27'),
(35, 'Ümüdov Elməddin', 'agent', '050-230-00-30', 'elmeumud@gmail.com', '01/05/2022 10:44');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `cityId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `name`, `cityId`) VALUES
(1, 'Astara', 1),
(2, 'Kəngərli', 1),
(3, 'Köhnə Günəşli', 1),
(9, 'Abşeron', 2),
(10, 'Binəqədi', 2),
(11, 'Xətai', 2),
(12, 'Xəzər', 2),
(13, 'Qaradağ', 2),
(14, 'Nərimanov', 2),
(15, 'Nəsimi', 2),
(16, 'Nizami', 2),
(17, 'Pirallahı', 2),
(18, 'Sabunçu', 2),
(19, 'Səbail', 2),
(20, 'Suraxanı', 2),
(21, 'Yasamal', 2),
(22, 'Babək', 3),
(23, 'Culfa', 3),
(24, 'Qıvraq', 3),
(25, 'Naxçıvan', 3),
(26, 'Ordubad', 3),
(27, 'Sədərək', 3),
(28, 'Şahbuz', 3),
(29, 'Şərur', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `regionId` (`regionId`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cityId` (`cityId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartment`
--
ALTER TABLE `apartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `building`
--
ALTER TABLE `building`
  ADD CONSTRAINT `building_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `publisher` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `building_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `apartment` (`id`),
  ADD CONSTRAINT `building_ibfk_3` FOREIGN KEY (`regionId`) REFERENCES `region` (`id`);

--
-- Constraints for table `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `region_ibfk_1` FOREIGN KEY (`cityId`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
