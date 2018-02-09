-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018 年 2 月 08 日 14:41
-- サーバのバージョン： 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `work_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `book_table`
--

CREATE TABLE `book_table` (
  `no` int(12) NOT NULL,
  `userId` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bookId` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `regiDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `book_table`
--

INSERT INTO `book_table` (`no`, `userId`, `bookId`, `title`, `url`, `comment`, `regiDate`) VALUES
(3, '2', 'fRJ7jx7Nnc4C', 'グイン・サーガ128 謎の聖都', 'http://books.google.com/books/content?id=fRJ7jx7Nnc4C&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE72gsgCmaKWcTPMYC9ha-l90qlXNOrc3iVsWMy43O3zBF6xP_HoERFyEX2WEzrBcXO9dYlhNv6MNg_Era-ckZ5jIHcOPiFwYgLqfTcZGhN_82KI8dlsp6rY_AJZJTo9e9psxpuS2&source=gbs_api', '世界最強の国家として知られるケイロニアの首都サイロンが、<wbr>黒死病の脅威にさらされ、壊滅の危機にあり、<wbr>グインの安否も不明だという驚くべき知らせに、<wbr>ヴァレリウスは苦悩を深める。一方、<wbr>聖地ヤガに潜入したヨナとスカールは、『ミロクの兄弟の家』<wbr>の虜囚とされてしまう。さらに、<wbr>フロリーたちの行方を捜しながらヤガの様子を探る彼らは、<wbr>ミロク教がなにやら不可解な変貌を遂げつつあることに疑念と不安<wbr>を抱くのだった。', '2018-02-06 11:58:24'),
(4, '2', 'XU5hHAAACAAJ', '管仲', 'http://books.google.com/books/content?id=XU5hHAAACAAJ&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE72WT0CfSm7NOmv1oYytBgHl_jtklxth1xc-SubtH9AAH2M-HuJZ9tvL9_h2gPoukeS9jfaLJwlM2T51dRk9q_LRUxjgCtjfqtfvvCn02tR-pItRfZko1xIrR7w4SLbm0HUU1pQw&source=gbs_api', '「管鮑の交わり」で知られる春秋時代の宰相・管仲と鮑叔。二人は若き日に周の都で出会い、互いの異なる性格を認め、共に商いや各国遊学の旅をしつつ絆を深めていく。やがて鮑叔は生国の斉に戻り、不運が続き恋人とも裂かれた管仲を斉に招く―。理想の宰相として名高い管仲の無名時代と周囲の人々を生き生きと描く。', '2018-02-06 12:00:29'),
(6, '2', 'dT6vBQAAQBAJ', 'すべてがＦになる　THE PERFECT INSIDER', 'http://books.google.com/books/content?id=dT6vBQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE72tBo2ExK3ZnP8l6WIg1EI8enR5WaEuWNfrsZOTRWhitat-rIO-hwHw5EJwN91Ohfkn7JMwntR3GdrtWwo4D1AEpCQAQq0gsMCnHTI1YCEX-DEVUkDvwUjEIfafg7bTACuwNn7b&source=gbs_api', '孤島のハイテク研究所で、<wbr>少女時代から完全に隔離された生活を送る天才工学博士・<wbr>真賀田四季。彼女の部屋からウエディング・<wbr>ドレスをまとい両手両足を切断された死体が現れた。偶然、<wbr>島を訪れていたＮ大助教授・犀川創平と女子学生・西之園萌絵が、<wbr>この不可思議な密室殺人に挑む。新しい形の本格ミステリィ登場。', '2018-02-06 12:02:27'),
(7, '1', 'Jb3GNmCzcIoC', 'こころ', 'http://books.google.com/books/content?id=Jb3GNmCzcIoC&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE72-VsKu04xCPycsJc5Ap2rg_wL0n_OCdYK5cARbbfcsigKaoWQR3RRHT9UGlaAyd5-puV_XNY9rEkWktwn2KjXbBvxfFGvGaRUWEqBYMCDsbr2svsK9iVYuU_gGCcwRMP479iNq&source=gbs_api', '夏目漱石 -- 慶応3年1月5日(新暦2月9日)江戸牛込馬場下横町に生まれる。本名は夏目金之助。帝国大学文科大学(東京大学文学部)を卒業後、東京高等師範学校、松山中学、第五高等学校などの教師生活を経て、1900年イギリスに留学する。帰国後、第一高等学校で教鞭をとりながら、1905年処女作「吾輩は猫である」を発表。1906年「坊っちゃん」「草枕」を発表。1907年教職を辞し、朝日新聞社に入社。そして「虞美人草」「三四郎」などを発表するが、胃病に苦しむようになる。1916年12月9日、「明暗」の連載途中に胃潰瘍で永眠。享年50歳であった。(青空文庫図書カードより)', '2018-02-06 12:17:22');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `loginId` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `loginPw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `regiDate` datetime NOT NULL,
  `manage_flag` int(1) NOT NULL,
  `life_flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `loginId`, `loginPw`, `regiDate`, `manage_flag`, `life_flag`) VALUES
(1, '管理者', 'admin', 'admin', '0000-00-00 00:00:00', 1, 0),
(2, '一般', 'user', 'user', '0000-00-00 00:00:00', 0, 0),
(3, '退会者', 'leaving', 'leaving', '0000-00-00 00:00:00', 0, 1),
(4, 'tonarinototoro', 'tonarino', 'totoro', '0000-00-00 00:00:00', 0, 0),
(5, '孫悟空', 'son', 'goku', '0000-00-00 00:00:00', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_table`
--
ALTER TABLE `book_table`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_table`
--
ALTER TABLE `book_table`
  MODIFY `no` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
