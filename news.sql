-- --------------------------------------------------------
-- Máy chủ:                      127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Phiên bản:           12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table ngulongbakery.news
DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `comments` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ngulongbakery.news: ~12 rows (approximately)
INSERT INTO `news` (`id`, `link`, `img`, `title`, `description`, `date`, `comments`) VALUES
	(1, 'abc', 'news-1.png', 'Khám Phá Các Loại Bánh Bông Lan Đặc Biệt Tại Ngũ Long Bakery', 'Khám Phá Các Loại Bánh Bông Lan Đặc Biệt Tại Ngũ Long Bakery Ngũ Long Bakery là địa chỉ quen thuộc của những người yêu', '2024-11-21 23:32:00', 0),
	(2, 'abc', 'news-2.png', 'Những Loại Rau Câu Độc Đáo Tại Ngũ Long Bakery', 'Rau câu từ lâu đã trở thành một món tráng miệng quen thuộc với người Việt Nam. Sự đa dạng về hương vị, màu sắc', '2024-11-21 23:42:30', 0),
	(3, 'xyz', 'news-3.png', 'Sự Phát Triển Của Nghề Làm Bánh Tại Việt Nam Hiện Nay', 'Cùng Ngũ Long Bakery khám phá lịch sử phát triển của nghề làm bánh. Nghề làm bánh tại Việt Nam đã trải qua nhiều giai', '2024-11-21 23:42:54', 0),
	(4, 'x', 'news-4.png', 'Tại Sao Bánh Ngọt Tự Làm Luôn Là Lựa Chọn Yêu Thích?', 'Trong cuộc sống hiện đại, việc tự tay làm bánh ngọt tại nhà đang trở thành xu hướng phổ biến. Không chỉ mang đến những', '2024-11-21 23:43:20', 0),
	(5, 'a', 'news-5.png', 'Bánh Tráng Nướng: Món Ăn Đường Phố Không Thể Bỏ Qua', 'Bánh tráng nướng là một món ăn đường phố nổi tiếng tại Việt Nam. Món ăn này đã trở thành biểu tượng của ẩm thực', '2024-11-21 23:43:27', 0),
	(6, 'a', 'news-6.png', 'Hướng Dẫn Cách Thưởng Thức Bánh Đúng Cách', 'Bánh ngọt luôn là món ăn mang lại niềm vui và sự thỏa mãn. Tuy nhiên, để tận hưởng trọn vẹn hương vị tuyệt vời,', '2024-11-21 23:44:11', 0),
	(7, 'b', 'news-7.png', 'Cách Chọn Bánh Trung Thu Phù Hợp Cho Mọi Dịp', 'Bánh trung thu không chỉ là món ăn truyền thống mà còn là món quà ý nghĩa. Việc lựa chọn bánh phù hợp với dịp', '2024-11-21 23:44:25', 0),
	(8, 'c', 'news-8.png', 'Bánh Trung Thu Handmade: Sự Kết Hợp Giữa Truyền Thống và Hiện Đại', '1.Giới thiệu về bánh trung thu handmade a. Bánh trung thu là món ăn truyền thống trong dịp Tết Trung Thu. Hiện nay, bánh trung', '2024-11-21 23:45:04', 0),
	(9, 'd', 'news-9.png', 'Cách Làm Bánh Da Lợn Tại Nhà: Mẹo Để Thành Công', 'Bánh da lợn, một món bánh truyền thống nổi tiếng của người Việt, thường xuất hiện trong các dịp lễ hội hoặc tụ họp gia', '2024-11-21 23:45:22', 0),
	(10, 'f', 'news-10.png', 'Bánh Mì Việt Nam: Những Loại Nhân Phổ Biến', 'Bánh mì là một trong những món ăn đường phố nổi tiếng nhất của ẩm thực Việt Nam. Không chỉ thu hút người dân trong', '2024-11-21 23:45:55', 0),
	(11, 'z', 'news-11.png', 'Cách Làm Bánh Mì Tại Nhà Đơn Giản – Bí Quyết Để Có Chiếc Bánh Mì Hoàn Hảo Tại Nhà', 'Làm bánh mì tại nhà đang trở thành xu hướng được rất nhiều người yêu thích, không chỉ vì sự an toàn, vệ sinh mà', '2024-11-21 23:45:58', 0),
	(12, 's', 'news-12.png', 'Cách làm rau câu dứa tại nhà', 'Giới thiệu Rau câu dứa là món ăn vặt thanh mát và đầy hương vị nhiệt đới, rất thích hợp cho những ngày hè oi', '2024-11-21 23:46:40', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
