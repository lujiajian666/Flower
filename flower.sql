-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-06-11 07:11:33
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flower`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `authority` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`username`, `password`, `authority`) VALUES
('admin', 'admin', '1');

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `email` char(30) DEFAULT NULL,
  `flowerID` char(15) NOT NULL,
  `num` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cart`
--

INSERT INTO `cart` (`cartID`, `email`, `flowerID`, `num`) VALUES
(1494733198, 'lujiajian@163.com', '8010034', 1),
(1494660277, '', '8010036', 1),
(1494643234, 'lujiajian@163.com', '8010034', 1),
(1495167714, 'lujiajian@163.com', '8010034', 1),
(1495167714, 'lujiajian@163.com', '8010036', 1),
(1497164363, 'lujiajian@163.com', '8010034', 1),
(1497164363, 'lujiajian@163.com', '8010036', 1);

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `flowerID` int(11) NOT NULL,
  `txt` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `class` tinyint(4) NOT NULL COMMENT '1,2,3 优良中'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `flowerID`, `txt`, `username`, `class`) VALUES
(1, 8010036, '一般般', 'lujiajian@163.com', 1),
(2, 8010034, '很好', 'lujiajian@163.com', 2),
(3, 8010036, '垃圾', 'lujiajian@163.com', 3),
(4, 8010034, '真心垃圾', 'lujiajian@163.com', 3),
(12, 8010036, '只能说一分钱一分货吧，毕竟店主也是有妈妈生的，我也不能太过分。', 'lujiajian@163.com', 3),
(11, 8010034, '良，真的不能再多了', 'lujiajian@163.com', 2);

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE `customer` (
  `custID` int(11) NOT NULL,
  `email` char(30) DEFAULT NULL,
  `sname` char(10) DEFAULT NULL,
  `sex` char(2) DEFAULT NULL,
  `mobile` char(11) DEFAULT NULL,
  `address` char(200) DEFAULT NULL,
  `zip` char(6) DEFAULT NULL,
  `cdefault` char(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `customer`
--

INSERT INTO `customer` (`custID`, `email`, `sname`, `sex`, `mobile`, `address`, `zip`, `cdefault`) VALUES
(1, 'lujiajian@163.com', '李筱雯', '女', '18012889889', '佛山市南海区狮山大学城', '528225', '1'),
(3, 'lujiajian@163.com', '陈小花', '女', '18912123212', '佛山市南海区狮山大学城', '528225', '0'),
(4, 'a@163.com', '王红霞', '女', '13522132124', '广州市新港东路144号', '510009', '1'),
(5, 'a@163.com', '李梅', '女', '18921214244', '广州市华南师范大学', '510023', '0'),
(6, 'a@163.com', '李丽', '女', '18927712112', '广东省佛山市南海区狮山大学城', '528225', '0'),
(7, 'a@163.com', '李明', '男', '18923212321', '佛山南海狮山大学城', '528225', '0'),
(8, 'a@163.com', '张德海', '男', '13399899898', '广州市天河区天河路89号', '528228', '0'),
(9, 'a@163.com', '李白', '男', '13323232321', '佛山南海狮山华南师范大学南海学院', '121121', '0'),
(10, 'a@163.com', '陈浩', '男', '18923221212', '佛山南海狮山大学城', '523222', '0'),
(11, 'a@163.com', '方迪', '女', '18923121321', '佛山南海狮山大学城', '528225', '0'),
(12, 'a@163.com', '张民奚', '男', '18923232321', '华南师范大学南海校区', '121211', '0'),
(13, 'aa@163.com', '许烁娜', '女', '1122121', '华南师范大学南海学院', '212121', '0'),
(14, 'aa@163.com', '方定威', '男', '18923234343', '佛山南海狮山大学城', '528225', '1');

-- --------------------------------------------------------

--
-- 表的结构 `flower`
--

CREATE TABLE `flower` (
  `flowerID` char(15) NOT NULL,
  `fname` varchar(120) DEFAULT NULL,
  `myclass` char(20) DEFAULT NULL,
  `fclass` char(20) DEFAULT NULL,
  `fclass1` char(20) DEFAULT NULL,
  `cailiao` varchar(200) DEFAULT NULL,
  `baozhuang` varchar(200) DEFAULT NULL,
  `huayu` varchar(400) DEFAULT NULL,
  `shuoming` varchar(200) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `yourprice` int(11) DEFAULT NULL,
  `pictures` varchar(30) DEFAULT NULL,
  `picturem` varchar(30) DEFAULT NULL,
  `pictureb` varchar(30) DEFAULT NULL,
  `pictured` varchar(30) DEFAULT NULL,
  `cailiaopicture` varchar(30) DEFAULT NULL,
  `bzpicture` varchar(30) DEFAULT NULL,
  `tejia` char(2) DEFAULT NULL,
  `SelledNum` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `flower`
--

INSERT INTO `flower` (`flowerID`, `fname`, `myclass`, `fclass`, `fclass1`, `cailiao`, `baozhuang`, `huayu`, `shuoming`, `price`, `yourprice`, `pictures`, `picturem`, `pictureb`, `pictured`, `cailiaopicture`, `bzpicture`, `tejia`, `SelledNum`) VALUES
('8010034', '开业大吉双花篮', '鲜花', '开业乔迁', '开业乔迁', '粉剑兰,小鸟,红太阳花,黄菊花，粉色百合,红掌加配叶,', '高架花篮2只,高:1.80M（花篮样式因地域不同有所差异）', '业大吉，开业庆典首选，烘托出喜庆、祥和的气氛', '提前两天订购 ', 1876, 1688, '', '8010034_m.jpg', '8010034_b.jpg', '200681710524129284.jpg', '', '', '否', 0),
('8010036', '红红火火', '鲜花', '开业乔迁', '开业乔迁', '26枝红掌，散尾叶、绿叶间插', '1.5米三角架', '插满红掌的开业花篮，寓意红红红火，大吉大利', '', 768, 690, '', '8010036_m.jpg', '8010036_b.jpg', '200681711375281023.jpg', '', '', '否', 0),
('8010058', '日进斗金', '鲜花', '开业乔迁', '开业乔迁', '红玫瑰50枝，黄色太阳花(即扶郎)30枝，白色香水百合2 ', '两层高档花篮 ', '适合开业、乔迁、庆典、商务', '', 628, 508, '', '8010058_m.jpg', '8010058_b.jpg', '201071615531283028.jpg', 'bizflowerwish.jpg', '', '否', 0),
('9010032', '真诚的歉意', '鲜花', '道歉鲜花', '道歉鲜花', '36枝黄玫瑰,芒叶适量', '内衬浅黄色皱纹纸，蝴蝶结束扎，外层浅色网纱单面包装', '有的人说时间是一把刀，任何东西都会被它斩断，包括情', '需要提前一天订购或订购前咨询 ', 388, 350, '', '9010032_m.jpg', '9010032_b.jpg', '9010032_d.jpg', '', '', '否', 1),
('9010033', '宝贝，我错了', '鲜花', '道歉鲜花', '道歉鲜花', '11朵黄玫瑰，满天星+绿叶', '黄色皱纹纸圆形包装', '有的人说时间是一把刀，任何东西都会被它斩断，包括情', '黄玫瑰请订前咨询客服或提前一天订购 ', 160, 149, '', '9010033_m.jpg', '9010033_b.jpg', '9010033_d.jpg', '', '', '是', 0),
('9010041', '青春', '鲜花', '家居鲜花', '家居鲜花', '红黄双色太阳花（扶郎）16枝，排草、情人草、绿叶搭配', '绿色皱纹纸圆形包装，橙色丝带束扎', '舞动你的青春，生活充满希望。祝一切快乐如意、美好！', '', 146, 133, '9010041_s.jpg', '9010041_m.jpg', '9010041_b.jpg', '9010041_d.jpg', '', '', '否', 0),
('9010042', '家有喜事', '鲜花', '生子祝贺', '生子祝贺', '剑兰8枝，多头火百合3枝，红玫瑰6枝，粉太阳花9枝，黄', '藤编花蓝', '', '', 316, 284, '', '9010042_m.jpg', '9010042_b.jpg', '9010042_d.jpg', '', '', '否', 0),
('9010050', '顺心如意', '鲜花', '友情鲜花', '友情鲜花', '6枝粉色香水百合', ' 玻璃花瓶', '', '', 278, 220, '9010050_s.jpg', '9010050_m.jpg', '9010050_b.jpg', '9010050_d.jpg', '', '', '是', 0),
('9010066', '爱无止境--66枝紫玫瑰、小熊一只', '鲜花', '爱情鲜花', '爱情鲜花', '66枝紫玫瑰紧凑包装、绿叶点缀,送精致小熊（小熊样式代参考，以当地出货为准）一只。', '乳白色皱纹纸圆型包装，紫色丝带束扎', '所有的季节都走过，心的恋曲也就开始向远方延伸，梦想的翅膀也便拍打着坚硬的身躯， 向蓝蓝的天穹，向浩瀚的大海飞翔。', '大城市提前一天订购、中小城市订购前咨询客服', 683, 558, '9010066_s.jpg', '9010066_m.jpg', '9010066_b.jpg', '9010066_d.jpg', '', '', '是', 0),
('9010094', '爱慕', '鲜花', '爱情鲜花', '爱情鲜花', '白色马蹄莲12枝，叶上黄金搭配', '网纱内衬，淡棕色棉纸扇形包装，绿色蝴蝶结束扎', '马蹄莲只提供12月至次年5月订购，并请提前三天订购。', '月特价优惠！马蹄莲只提供12月至次年5月订购(其他月份请订前咨询是否有货)，限送全国大中城市,并请提前一天订购。', 166, 149, '9010094_s.jpg', '9010094_m.jpg', '9010094_b.jpg', '9010094_d.jpg', '', '', '否', 21),
('9010105', '爱的纪念日', '鲜花', '爱情鲜花', '爱情鲜花', '红玫瑰11枝，勿忘我、黄莺丰满。', '单面花束：浅香槟色棉纸内衬，粉色手揉纸多层包装，咖啡色蝴蝶结束扎。', '一次偶然的凝眸, 就注定了一生的痴情依托. 这如梦的邂逅, 美丽的相逢…… 枝数11，蕴含一心一意的美好寓意。', '优惠促销鲜花 ', 151, 126, '9010105_s.jpg', '9010105_m.jpg', '9010105_b.jpg', '9010105_d.jpg', '', '', '否', 0),
('9010200', '郁来郁爱', '鲜花', '爱情鲜花', '爱情鲜花', '双色郁金香20枝（粉/桔/黄/红，挑选2种颜色搭配，依实 际进货确定）', '内层：浅黄色皱纹纸，外层：乳白色皱纹纸，红、金双色丝带束扎', '郁（遇）见了你，让我生活变得更美丽；而我对你的爱， 也郁（愈）来郁（愈）深！', '因郁金香花期的原因，只在12月20日～4月10日期间提供此款鲜花的配送，并请尽量提前三天订购或订购前咨询。', 376, 338, '9010200_s.jpg', '9010200_m.jpg', '9010200_b.jpg', '9010200_d.jpg', '', '', '是', 21),
('9010201', '紫色情迷', '鲜花', '爱情鲜花', '爱情鲜花', '紫色郁金香10枝，配桔梗、绿叶', '内层透明玻璃纸，外层浅兰色棉纸，浅紫色网纱包裹，扇形包装', '高雅的紫色郁金香，一见就让人迷恋，爱不释手，就象 我当初遇见了你！', '因郁金香花期的原因，只在12月20日～4月10日期间提供此款鲜花的配送，并请尽量提前三天订购或订购前咨询。', 229, 206, '9010201_s.jpg', '9010201_m.jpg', '9010201_b.jpg', '9010201_d.jpg', '', '', '是', 25),
('9010609', '想你的365天', '鲜花', '道歉鲜花', '道歉鲜花', '365朵玫瑰（红、粉、白颜色可选）。', '内层高档网纱多层围绕，外层粉色皱纹纸（或手揉纸）围裹', '365朵玫瑰，朵朵玫瑰代表著我的爱意，一年365天我会天', '', 3680, 2688, '', '9010609_m.jpg', '9010609_b.jpg', '9010609_d.jpg', '', '', '否', 2),
('9010620', '嫁给我吧', '鲜花', '婚庆鲜花', '婚庆鲜花', '108枝粉（或红）玫瑰（长柄），配满天星。', '精致纱网圆形包装，粉色蝴蝶结', '108朵玫瑰，每一朵都在细诉无尽的爱，每一朵都是我在对你说：“嫁给我吧！”', '特价促销鲜花 ', 776, 568, '', '9010620_m.jpg', '9010620_b.jpg', '9010620_d.jpg', '', '', '否', 1),
('9010642', '挚爱', '鲜花', '爱情鲜花', '爱情鲜花', '向日葵10枝,配紫色勿忘我、叶上花', '内：浅黄色皱纸，外：墨绿色皱纸2张圆形围裹，浅黄色丝带束扎', ' ', '父亲节特别花艺设计，请提前3天订购或事先咨询客服 ', 218, 196, '', '9010642_m.jpg', '9010642_b.jpg', '9010642_d.jpg', '', '', '否', 0),
('9010648', '蓝色爱情海', '鲜花', '爱情鲜花', '爱情鲜花', '19枝蓝色妖姬(昆明产)，每支玫瑰分别精包装，点缀洁白 的满天星和绿叶', ' 白色的纱网和蓝色手揉纸包装，配同色系丝带花', '相守是一种承诺，人世论回中，怎样才能拥有一份温 柔的情意！ 相遇是一种宿命，心灵的交汇让我们有诉不 尽的浪漫情怀...你是我最深的爱恋，希望永远铭记我们 这段美丽的爱情故事！ 蓝色妖姬这个名字最早来自荷兰是一种加工花卉．它 是用一种对人体无害的染色剂和助染剂调合成着色剂，而 后衍变为蓝玫瑰的称谓，“蓝色妖姬”是近两年玫瑰中的 新贵,其花语代表“清纯的爱和敦厚善良”。', '请提前1天订购或订购前咨询客服', 468, 385, '9010648_s.jpg', '9010648_m.jpg', '9010648_b.jpg', '9010648_d.jpg', '', '', '是', 42),
('9010650', '天天天蓝 ', '鲜花', '爱情鲜花', '爱情鲜花', '枝蓝色妖姬（昆明产），配叶', '内衬白色棉纸，外层蓝色(或紫色)皱纹纸扇形包装，同色花结', '“蓝色妖姬”相知是一种宿命，心灵的交汇让我们有诉不尽的浪漫情怀；相守是一种承诺，人世轮回中，永远 铭记我们这段美丽的爱情故事！', '请提前1天订购或订购前咨询客服', 303, 208, '9010650_s.jpg', '9010650_m.jpg', '9010650_b.jpg', '9010650_d.jpg', '', '', '是', 31),
('9010668', 'LOVE 99', '鲜花', '爱情鲜花', '爱情鲜花', '99枝超级红玫瑰，满天星和黄莺围绕。', '里层：网纱多层围绕，外层：粉红色手揉纸包装，深红色丝带束扎', '99朵靓丽的红玫瑰，献给你的至爱！', '特价促销，原购买价586元，直降100元。年度销售排行TOP10', 752, 498, '9010668_s.jpg', '9010668_m.jpg', '9010668_b.jpg', '9010668_d.jpg', '', '', '否', 0);

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

CREATE TABLE `member` (
  `email` char(30) NOT NULL,
  `password` char(50) DEFAULT NULL,
  `mname` char(10) DEFAULT NULL,
  `sex` char(2) DEFAULT NULL,
  `mobile` char(11) DEFAULT NULL,
  `address` char(200) DEFAULT NULL,
  `jifen` int(11) DEFAULT NULL,
  `ye` decimal(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`email`, `password`, `mname`, `sex`, `mobile`, `address`, `jifen`, `ye`) VALUES
('a@163.com', '0cc175b9c0f1b6a831c399e269772661', '李美', '女', '13922312132', '佛山南海狮山大学城华南师范大学南海校区', 0, '0.00'),
('b@163.com', '92eb5ffee6ae2fec3ad71c777531578f', '徐雅', '女', '13022312888', '佛山南海狮山大学城华南师范大学南海校区', 0, '0.00'),
('lujiajian@163.com', 'af0eac62aedcabb04a7ee903b294a65d', '陆家键', 'b', '13794649942', '中国', 0, '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `myorder`
--

CREATE TABLE `myorder` (
  `orderID` int(11) NOT NULL,
  `email` char(30) DEFAULT NULL,
  `custID` int(11) DEFAULT NULL,
  `shifu` decimal(10,2) DEFAULT NULL,
  `inputtime` int(11) DEFAULT NULL,
  `peisongday` varchar(50) DEFAULT NULL,
  `peisongtime` varchar(100) DEFAULT NULL,
  `peisong` int(11) DEFAULT NULL,
  `psyq` varchar(100) DEFAULT NULL,
  `liuyan` varchar(200) DEFAULT NULL,
  `shuming` varchar(8) DEFAULT NULL,
  `fkfs` varchar(50) DEFAULT NULL,
  `fp` varchar(50) DEFAULT NULL,
  `fpaddress` varchar(200) DEFAULT NULL,
  `zip` varchar(6) DEFAULT NULL,
  `fpsname` varchar(8) DEFAULT NULL,
  `ddzt` varchar(20) DEFAULT NULL,
  `cltime` datetime DEFAULT NULL,
  `beizhu` varchar(100) DEFAULT NULL,
  `comment` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0,1 没评价 已经评价'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `myorder`
--

INSERT INTO `myorder` (`orderID`, `email`, `custID`, `shifu`, `inputtime`, `peisongday`, `peisongtime`, `peisong`, `psyq`, `liuyan`, `shuming`, `fkfs`, `fp`, `fpaddress`, `zip`, `fpsname`, `ddzt`, `cltime`, `beizhu`, `comment`) VALUES
(37, 'lujiajian@163.com', 1, NULL, 1495169921, '', '', 10, NULL, '', '', '', NULL, '', '', '', '2', NULL, NULL, 1),
(38, 'lujiajian@163.com', 1, NULL, 1497164376, '', '', 10, NULL, '', '', '', NULL, '', '', '', '2', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `shoplist`
--

CREATE TABLE `shoplist` (
  `SLID` int(11) NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  `flowerID` char(30) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `star` smallint(6) DEFAULT NULL,
  `evaluate` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shoplist`
--

INSERT INTO `shoplist` (`SLID`, `orderID`, `flowerID`, `num`, `title`, `star`, `evaluate`) VALUES
(10, 37, '8010036', 1, NULL, NULL, NULL),
(9, 37, '8010034', 1, NULL, NULL, NULL),
(11, 38, '8010034', 1, NULL, NULL, NULL),
(12, 38, '8010036', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tbddzt`
--

CREATE TABLE `tbddzt` (
  `ztid` int(11) NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  `ddzt` char(10) DEFAULT NULL,
  `cltime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`,`flowerID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `flower`
--
ALTER TABLE `flower`
  ADD PRIMARY KEY (`flowerID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `myorder`
--
ALTER TABLE `myorder`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `shoplist`
--
ALTER TABLE `shoplist`
  ADD PRIMARY KEY (`SLID`);

--
-- Indexes for table `tbddzt`
--
ALTER TABLE `tbddzt`
  ADD PRIMARY KEY (`ztid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `customer`
--
ALTER TABLE `customer`
  MODIFY `custID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- 使用表AUTO_INCREMENT `myorder`
--
ALTER TABLE `myorder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- 使用表AUTO_INCREMENT `shoplist`
--
ALTER TABLE `shoplist`
  MODIFY `SLID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `tbddzt`
--
ALTER TABLE `tbddzt`
  MODIFY `ztid` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
