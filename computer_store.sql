-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2026 at 02:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `computer_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(7, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `specs` text DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `stock`, `image`, `specs`, `description`) VALUES
(1, 'AMD Ryzen 5 5600', 'CPU', 6999.00, NULL, 'ryzen5600.jpg', NULL, 'The AMD Ryzen 5 5600 is a powerful 6-core, 12-thread processor designed for modern gaming and everyday productivity. It delivers excellent performance in popular games while maintaining efficient power consumption. This processor is an ideal choice for budget and mid-range PC builds.'),
(2, 'AMD Ryzen 7 5700X', 'CPU', 10999.00, NULL, 'ryzen5700x.jpg', NULL, 'The AMD Ryzen 7 5700X features 8 cores and 16 threads, making it suitable for gaming, streaming, and multitasking. It provides excellent processing power for demanding applications and creative workloads. Its efficient design ensures smooth performance without excessive power usage.'),
(3, 'AMD Ryzen 9 7900X', 'CPU', 25999.00, NULL, 'ryzen7900x.jpg', NULL, 'The AMD Ryzen 9 7900X is a high-end processor built for enthusiasts, content creators, and gamers. With 12 cores and 24 threads, it easily handles heavy multitasking and demanding workloads. It offers exceptional speed and responsiveness for modern computing needs.'),
(4, 'Intel Core i3-12100F', 'CPU', 6499.00, NULL, 'i312100f.jpg', NULL, 'The Intel Core i3-12100F is an affordable processor that delivers reliable performance for everyday tasks and entry-level gaming. Its strong single-core performance makes it excellent for many modern applications. It is a great option for budget-conscious PC builders.'),
(5, 'Intel Core i5-12400F', 'CPU', 9999.00, NULL, 'i512400f.jpg', NULL, 'The Intel Core i5-12400F offers an excellent balance between performance and value. It performs exceptionally well in modern games and productivity applications. This processor is a popular choice for mid-range gaming systems.'),
(11, 'NVIDIA RTX 3050', 'GPU', 14999.00, NULL, 'rtx3050.jpg', NULL, 'The NVIDIA RTX 3050 is an entry-level graphics card designed for smooth 1080p gaming. It supports ray tracing and DLSS technologies for enhanced visuals and performance. It is ideal for gamers looking for an affordable upgrade.'),
(12, 'NVIDIA RTX 3060', 'GPU', 18999.00, NULL, 'rtx3060.jpg', NULL, 'The NVIDIA RTX 3060 delivers impressive 1080p and 1440p gaming performance. Its generous VRAM allows modern games and creative applications to run smoothly. This graphics card remains a popular choice among gamers.'),
(13, 'NVIDIA RTX 4060', 'GPU', 21999.00, NULL, 'rtx4060.jpg', NULL, 'The NVIDIA RTX 4060 features modern Ada Lovelace architecture and DLSS 3 technology. It offers excellent gaming performance and power efficiency. This card is ideal for modern gaming systems targeting high settings.'),
(14, 'NVIDIA RTX 4070 Super', 'GPU', 38999.00, NULL, 'rtx4070super.jpg', NULL, 'The NVIDIA RTX 4070 Super is built for demanding gamers and content creators. It delivers exceptional frame rates at 1440p resolutions while supporting advanced graphical features. It offers outstanding performance for modern workloads.'),
(15, 'NVIDIA RTX 4080 Super', 'GPU', 64999.00, NULL, 'rtx4080super.jpg', NULL, 'The NVIDIA RTX 4080 Super provides premium gaming and workstation performance. It excels at high-refresh-rate gaming and complex rendering tasks. This card is an excellent choice for enthusiasts seeking top-tier graphics power.'),
(21, 'Corsair Vengeance LPX 16GB DDR4', 'RAM', 3499.00, NULL, 'corsair16.jpg', NULL, 'The Corsair Vengeance LPX 16GB DDR4 memory kit offers dependable performance for gaming and productivity. It features high-quality components for system stability and reliability. This memory kit is suitable for most modern desktop computers.'),
(22, 'Corsair Vengeance RGB Pro 32GB', 'RAM', 6999.00, NULL, 'corsair32rgb.jpg', NULL, 'The Corsair Vengeance RGB Pro 32GB combines exceptional performance with customizable RGB lighting. It is ideal for gaming, streaming, and multitasking workloads. The premium design enhances the appearance of any gaming setup.'),
(23, 'G.Skill Trident Z RGB 16GB', 'RAM', 4199.00, NULL, 'trident16.jpg', NULL, 'The G.Skill Trident Z RGB memory kit provides reliable performance and vibrant RGB effects. It is designed for gamers and enthusiasts seeking both speed and style. Its premium build quality ensures long-term reliability.'),
(24, 'G.Skill Ripjaws V 32GB', 'RAM', 6599.00, NULL, 'ripjaws32.jpg', NULL, 'The G.Skill Ripjaws V 32GB memory kit is engineered for performance and stability. It offers ample capacity for gaming, content creation, and professional applications. The modules are designed for compatibility with modern systems.'),
(25, 'Kingston Fury Beast 16GB DDR5', 'RAM', 4299.00, NULL, 'fury16.jpg', NULL, 'The Kingston Fury Beast DDR5 memory provides enhanced speed and efficiency for modern computers. It improves system responsiveness and multitasking performance. This memory is ideal for gamers and professionals alike.'),
(31, 'ASUS Prime B550M-A', 'Motherboard', 6999.00, NULL, 'b550m.jpg', NULL, 'The ASUS Prime B550M-A motherboard delivers dependable performance for AMD Ryzen systems. It includes essential connectivity options and reliable components. This board is ideal for budget and mid-range PC builds.'),
(32, 'ASUS ROG Strix B650E-F', 'Motherboard', 15999.00, NULL, 'b650ef.jpg', NULL, 'The ASUS ROG Strix B650E-F is a premium AM5 motherboard designed for gaming and enthusiast systems. It supports the latest technologies and provides excellent connectivity. Its robust power design ensures long-term stability.'),
(33, 'MSI B550 Tomahawk', 'Motherboard', 8999.00, NULL, 'tomahawk.jpg', NULL, 'The MSI B550 Tomahawk is a popular motherboard known for reliability and strong thermal performance. It provides excellent compatibility with Ryzen processors. It is a solid foundation for gaming PCs.'),
(34, 'MSI MAG B760 Tomahawk WiFi', 'Motherboard', 11999.00, NULL, 'b760.jpg', NULL, 'The MSI MAG B760 Tomahawk WiFi offers excellent performance and modern connectivity features. Built for Intel processors, it includes integrated wireless networking and quality components. It is suitable for gaming and productivity systems.'),
(35, 'Gigabyte B550 AORUS Elite', 'Motherboard', 8999.00, NULL, 'aorusb550.jpg', NULL, 'The Gigabyte B550 AORUS Elite combines performance, durability, and expansion options. Its gaming-focused design makes it perfect for AMD Ryzen builds. The board delivers dependable performance for everyday use.'),
(41, 'Samsung 970 EVO Plus 1TB', 'Storage', 4999.00, NULL, '970evo.jpg', NULL, 'The Samsung 970 EVO Plus 1TB SSD delivers fast system boot times and quick application loading. It offers reliable storage performance for gaming and productivity workloads. This SSD is a trusted choice among PC builders.'),
(42, 'Samsung 990 Pro 2TB', 'Storage', 9999.00, NULL, '990pro.jpg', NULL, 'The Samsung 990 Pro 2TB SSD offers premium PCIe 4.0 performance for demanding users. It provides exceptional read and write speeds for gaming and professional applications. The drive is built for maximum reliability and responsiveness.'),
(43, 'WD Black SN850X 1TB', 'Storage', 6799.00, NULL, 'sn850x.jpg', NULL, 'The WD Black SN850X SSD is engineered for high-performance gaming systems. Its fast speeds help reduce loading times and improve overall responsiveness. This drive is ideal for enthusiasts seeking top-tier storage performance.'),
(44, 'Crucial P3 Plus 1TB', 'Storage', 4299.00, NULL, 'p3plus.jpg', NULL, 'The Crucial P3 Plus 1TB SSD provides excellent value and reliable everyday performance. It delivers faster speeds than traditional SATA storage solutions. This drive is ideal for budget-conscious upgrades.'),
(45, 'Kingston NV2 1TB', 'Storage', 3299.00, NULL, 'nv2.jpg', NULL, 'The Kingston NV2 1TB SSD offers affordable and efficient storage performance. It helps improve system responsiveness while providing ample capacity. It is a practical storage solution for modern PCs.'),
(51, 'Corsair RM650e', 'PSU', 5999.00, NULL, 'rm650e.jpg', NULL, 'The Corsair RM650e power supply delivers stable and efficient power for modern gaming systems. Its high-quality components ensure dependable operation. The unit is designed to support long-term system reliability.'),
(52, 'Corsair RM750x', 'PSU', 7499.00, NULL, 'rm750x.jpg', NULL, 'The Corsair RM750x is a premium fully modular power supply with excellent efficiency. It provides reliable power delivery for high-performance systems. The modular design helps improve cable management.'),
(53, 'Seasonic Focus GX750', 'PSU', 6899.00, NULL, 'gx750.jpg', NULL, 'The Seasonic Focus GX750 is renowned for its reliability and efficiency. Built with high-quality components, it delivers consistent power under demanding loads. It is an excellent choice for gaming and professional systems.'),
(54, 'Cooler Master MWE Gold 650', 'PSU', 4999.00, NULL, 'mwe650.jpg', NULL, 'The Cooler Master MWE Gold 650 offers dependable power delivery and efficient operation. It is designed for modern gaming PCs and workstation builds. The unit provides excellent value for its features.'),
(55, 'MSI MAG A650GL', 'PSU', 5399.00, NULL, 'a650gl.jpg', NULL, 'The MSI MAG A650GL power supply is built for dependable performance and efficiency. It provides the stable power required for modern computer systems. The unit is suitable for gaming and productivity builds.'),
(61, 'LG UltraGear 24GN600-B', 'Monitor', 8999.00, NULL, 'lg24.jpg', NULL, 'The LG UltraGear 24GN600-B is a gaming monitor designed for smooth and responsive gameplay. It features excellent image quality and fast refresh rates. This display is ideal for competitive and casual gamers.'),
(62, 'ASUS TUF VG249Q1A', 'Monitor', 9999.00, NULL, 'vg249.jpg', NULL, 'The ASUS TUF VG249Q1A is a high-performance gaming monitor with smooth visuals and reliable performance. It provides an immersive gaming experience with excellent clarity. The monitor is built for everyday gaming enjoyment.'),
(63, 'Acer Nitro VG240Y', 'Monitor', 8499.00, NULL, 'vg240y.jpg', NULL, 'The Acer Nitro VG240Y offers vibrant colors and responsive performance at an affordable price. It is suitable for gaming, entertainment, and productivity tasks. The monitor provides excellent value for users seeking a quality display.'),
(64, 'MSI G274QPF-QD', 'Monitor', 16999.00, NULL, 'g274.jpg', NULL, 'The MSI G274QPF-QD is a premium gaming monitor featuring sharp QHD visuals and fast refresh rates. It delivers detailed images and smooth gameplay. This monitor is designed for gamers who demand high performance.'),
(65, 'Samsung Odyssey G5', 'Monitor', 15999.00, NULL, 'g5.jpg', NULL, 'The Samsung Odyssey G5 features a curved display that enhances immersion and viewing comfort. It provides excellent gaming performance and image quality. The monitor is designed for modern gaming experiences.'),
(71, 'Logitech G102', 'Mouse', 999.00, NULL, 'g102.jpg', NULL, 'The Logitech G102 is a reliable gaming mouse featuring accurate tracking and responsive controls. Its lightweight design and comfortable shape make it ideal for long gaming sessions. This mouse is perfect for both casual and competitive gamers.'),
(72, 'Logitech G Pro X Superlight 2', 'Mouse', 8499.00, NULL, 'superlight2.jpg', NULL, 'The Logitech G Pro X Superlight 2 is an ultra-lightweight wireless gaming mouse designed for esports performance. It delivers precise tracking and fast responsiveness for competitive gaming. Its premium construction ensures comfort and durability.'),
(73, 'Razer DeathAdder V3', 'Mouse', 3999.00, NULL, 'deathadderv3.jpg', NULL, 'The Razer DeathAdder V3 is an ergonomic gaming mouse trusted by gamers worldwide. It features advanced sensors for exceptional accuracy and smooth movement. The comfortable design makes it suitable for extended gaming sessions.'),
(74, 'Razer Viper V3 Pro', 'Mouse', 8999.00, NULL, 'viperv3.jpg', NULL, 'The Razer Viper V3 Pro is a professional-grade wireless gaming mouse optimized for speed and precision. It offers excellent responsiveness and lightweight construction for competitive gaming. This mouse is built to meet the demands of esports professionals.'),
(75, 'SteelSeries Rival 3', 'Mouse', 1799.00, NULL, 'rival3.jpg', NULL, 'The SteelSeries Rival 3 delivers reliable tracking performance and long-lasting durability. Its lightweight design and comfortable grip make it suitable for a variety of gaming styles. This mouse offers excellent value for gamers.'),
(81, 'Logitech G213', 'Keyboard', 2499.00, NULL, 'g213.jpg', NULL, 'The Logitech G213 is a gaming keyboard featuring responsive keys and vibrant RGB lighting. It provides a comfortable typing and gaming experience with a durable design. This keyboard is ideal for everyday gaming setups.'),
(82, 'Logitech G Pro X TKL', 'Keyboard', 8999.00, NULL, 'gproxtkl.jpg', NULL, 'The Logitech G Pro X TKL is a compact tournament-grade keyboard designed for competitive players. It delivers fast and accurate keystrokes with a space-saving design. This keyboard is perfect for esports and professional gaming.'),
(83, 'Razer BlackWidow V4', 'Keyboard', 7499.00, NULL, 'blackwidow.jpg', NULL, 'The Razer BlackWidow V4 is a premium mechanical gaming keyboard with responsive switches and customizable RGB lighting. It offers excellent durability and typing comfort for both gaming and productivity. The keyboard is built for demanding users.'),
(84, 'Razer Huntsman Mini', 'Keyboard', 5499.00, NULL, 'huntsman.jpg', NULL, 'The Razer Huntsman Mini is a compact mechanical keyboard designed to maximize desk space. Its fast optical switches provide responsive and reliable performance. The compact design makes it a favorite among competitive gamers.'),
(85, 'Corsair K70 RGB Pro', 'Keyboard', 7999.00, NULL, 'k70.jpg', NULL, 'The Corsair K70 RGB Pro is a high-performance mechanical keyboard built for serious gamers. It features premium construction, RGB lighting, and responsive keys. This keyboard delivers an outstanding gaming experience.'),
(91, 'HyperX Cloud II', 'Headset', 3499.00, NULL, 'cloud2.jpg', NULL, 'The HyperX Cloud II is a legendary gaming headset known for comfort and excellent audio quality. It delivers immersive sound and clear communication during gaming sessions. The durable build ensures long-term reliability.'),
(92, 'HyperX Cloud III', 'Headset', 5999.00, NULL, 'cloud3.jpg', NULL, 'The HyperX Cloud III builds upon the success of its predecessor with enhanced sound and improved comfort. It provides immersive audio and crystal-clear voice communication. This headset is perfect for gaming, streaming, and entertainment.'),
(93, 'Logitech G Pro X', 'Headset', 6999.00, NULL, 'gprox.jpg', NULL, 'The Logitech G Pro X is a professional gaming headset designed with esports players in mind. It delivers exceptional sound quality and advanced microphone performance. This headset provides a premium gaming experience.'),
(94, 'Logitech G435', 'Headset', 3499.00, NULL, 'g435.jpg', NULL, 'The Logitech G435 is a lightweight wireless gaming headset designed for comfort and convenience. It offers high-quality sound for gaming, music, and communication. The wireless connectivity provides greater freedom of movement.'),
(95, 'Razer BlackShark V2', 'Headset', 4999.00, NULL, 'blackshark.jpg', NULL, 'The Razer BlackShark V2 is a gaming headset engineered for immersive audio and competitive gaming. It delivers detailed sound and clear voice communication. Its comfortable design makes it suitable for extended gaming sessions.'),
(101, 'MSI MAG Infinite S3', 'PC', 74999.00, NULL, 'msi_infinite.jpg', 'CPU: Intel Core i5-14400F\r\nGPU: NVIDIA RTX 4060 8GB\r\nRAM: 16GB DDR5 5600MHz\r\nStorage: 1TB NVMe SSD\r\nMotherboard: Intel B760\r\nPSU: 650W 80+ Bronze', 'The MSI MAG Infinite S3 is a powerful gaming desktop built for smooth 1080p and 1440p gaming experiences. It combines modern hardware with efficient cooling to deliver consistent performance during gaming, streaming, and productivity tasks. This system is ideal for users who want a reliable and upgradeable gaming PC.'),
(102, 'ASUS ROG G16CH', 'PC', 114999.00, NULL, 'rog_g16ch.jpg', 'CPU: Intel Core i7-14700F\r\nGPU: NVIDIA RTX 4070 Super 12GB\r\nRAM: 32GB DDR5\r\nStorage: 2TB NVMe SSD\r\nMotherboard: Intel B760 Gaming\r\nPSU: 750W 80+ Gold', 'The ASUS ROG G16CH is a premium gaming desktop designed for enthusiasts and content creators. It provides exceptional gaming performance, fast multitasking, and smooth responsiveness in demanding applications. Its premium components ensure long-term reliability and excellent upgrade potential.'),
(103, 'HP OMEN 40L', 'PC', 139999.00, NULL, 'omen40l.jpg', 'CPU: AMD Ryzen 7 7800X3D\r\nGPU: NVIDIA RTX 4070 Ti Super\r\nRAM: 32GB DDR5\r\nStorage: 2TB NVMe SSD\r\nMotherboard: AMD B650\r\nPSU: 850W 80+ Gold', 'The HP OMEN 40L is a high-performance gaming desktop engineered for gamers who demand exceptional speed and reliability. Its advanced hardware handles modern games, streaming, and creative workloads with ease. The spacious chassis also allows future upgrades and excellent cooling performance.'),
(104, 'Lenovo Legion Tower 5', 'PC', 109999.00, NULL, 'legion5.jpg', 'CPU: AMD Ryzen 7 7700\r\nGPU: NVIDIA RTX 4070\r\nRAM: 16GB DDR5\r\nStorage: 1TB NVMe SSD\r\nMotherboard: AMD B650\r\nPSU: 750W 80+ Bronze', 'The Lenovo Legion Tower 5 delivers a balanced combination of gaming performance and everyday productivity. It is designed to run modern games smoothly while maintaining efficient cooling and stability. This desktop is an excellent choice for gamers and power users alike.'),
(105, 'Acer Predator Orion 3000', 'PC', 119999.00, NULL, 'orion3000.jpg', 'CPU: Intel Core i7-14700F\r\nGPU: NVIDIA RTX 4070\r\nRAM: 16GB DDR5\r\nStorage: 1TB NVMe SSD\r\nMotherboard: Intel B760\r\nPSU: 750W 80+ Bronze', 'The Acer Predator Orion 3000 is a gaming desktop built to handle modern AAA titles and competitive esports games. It combines powerful hardware with a sleek design to deliver a responsive gaming experience. The system is also capable of handling content creation and multitasking workloads.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `role` enum('admin','buyer') DEFAULT 'buyer',
  `is_verified` tinyint(1) DEFAULT 0,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `contact`, `role`, `is_verified`, `verification_token`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$V./OU1htTGGmZNKVe/JY2O3.2Y/YNGXqsibuyDDVpkpsfg/lSNJcm', NULL, NULL, 'admin', 1, NULL),
(2, 'Test Test Test', 'admin@gmail.com', '$2y$10$aWGIiDA/il1gL34aWoZEreLvxPDlQMJVpf50TiSQ7zqdS4u24Rg9a', 'Pasay', '09123456789', 'buyer', 0, NULL),
(3, 'Test Test Test', 'Test@gmail.com', '$2y$10$w1UV6gpOKOCvWKbioctWpe3Yg4jxMmqMFQF/30HBNgF05SnMmE8Uy', 'Pasay', '09123456789', 'buyer', 0, NULL),
(4, 'Dave Blinz', 'Blinz@gmail.com', '$2y$10$Ic4okUutgn9G1nwXTzJG7O51aYj/.B1XDrEdkloZE5duNLSSNvxk6', NULL, NULL, 'admin', 1, NULL),
(5, 'Lorenz Figuerra', 'Figuerra@gmail.com', '$2y$10$YdB2hBai9eum1zkQyOFx8OACYvCWk1ahXS6H1wgSFKNyXBZB3F2ru', NULL, NULL, 'admin', 1, NULL),
(6, 'Test Test Test', 'figuerrarenz12@gmail.com', '$2y$10$TXEjglIu8Yh/kG/7kUFr8O4vd7dwk2RVvXVMWVfEh5LfYVd4aJClK', 'PASAY', '09123456789', 'buyer', 0, NULL),
(7, 'Test Test Test', 'nazume1211@gmail.com', '$2y$10$.saTv9AETJ9FqHuJOXKnXOMzkuC069Bf9G38AQa1TqmMjdhRfyMRO', 'Pasay', '09123456789', 'buyer', 0, '7749e79319978c18131bf3486d1b7070a76b0cf3670bb1a4c63c4814422c687f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
