INSERT INTO `categories` (id, name, parent_id, created_at, updated_at) VALUES
(1, 'Thể thao', NULL, NULL, NULL),
(2, 'Giải trí', NULL, NULL, NULL),
(3, 'Kinh tế', NULL, NULL, NULL),
(4, 'Công nghệ', NULL, NULL, NULL),
(5, 'Văn hóa', NULL, NULL, NULL),
(6, 'Bóng đá', 1, NULL, NULL),
(7, 'Cầu lông', 1, NULL, '2019-01-03 00:42:13'),
(8, 'Bất động sản', 3, NULL, '2019-01-03 00:42:05'),
(9, 'Ca nhạc', 2, NULL, '2018-11-15 01:11:57'),
(12, 'BlockChain', 4, '2019-01-03 23:50:29', '2019-01-03 23:50:29'),
(13, 'Laravel', 4, '2019-01-06 18:59:12', '2019-01-06 18:59:12'),
(14, 'Giáo dục', NULL, '2019-01-09 06:08:27', '2019-01-09 06:08:27'),
(15, 'Đội tuyển Việt Nam', 6, '2019-01-09 06:09:45', '2019-01-09 06:09:45'),
(16, 'Ngoại hạng anh', 6, '2019-01-09 06:31:08', '2019-01-09 06:31:08'),
(17, 'Tây Ban Nha', 6, '2019-01-09 06:31:23', '2019-01-09 06:31:23'),
(18, 'Arsenal', 16, '2019-01-09 06:31:34', '2019-01-09 06:31:34'),
(19, 'Barca', 17, '2019-01-09 06:31:48', '2019-01-09 06:31:48'),
(20, 'Điện ảnh', 2, '2019-01-09 06:47:12', '2019-01-09 06:47:12')