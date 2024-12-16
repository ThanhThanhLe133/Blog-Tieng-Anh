-- --------------------------------------------------------
-- Table structure for table `guest`
--
CREATE TABLE guest (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,          -- Mã khách
    firstName VARCHAR(255) NOT NULL,                 -- Tên
    lastName VARCHAR(255) NOT NULL,                  -- Họ
    phone VARCHAR(15) NOT NULL,                      -- Số điện thoại
    email VARCHAR(255) NOT NULL,                     -- Email
    studySchool VARCHAR(255),                        -- Trường học
    birthYear INT(4),                                -- Năm sinh
    currentDate DATE DEFAULT CURRENT_DATE            -- Ngày hiện tại, mặc định là ngày hôm nay
);


-- --------------------------------------------------------
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT, -- Tự động tăng giá trị ID
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `admin`
INSERT INTO `admin` (`first_name`, `last_name`, `email`, `username`, `password`) VALUES
('Ngan', 'Phuong','tthanh6b@gmail.com', 'admin', '123');

-- --------------------------------------------------------
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` INT(11) NOT NULL AUTO_INCREMENT,           -- Mã người dùng
  `f_name` VARCHAR(255) NOT NULL,                      -- Tên
  `l_name` VARCHAR(255) NOT NULL,                      -- Họ
  `username` VARCHAR(255) NOT NULL,   
  `password` VARCHAR(255) NOT NULL,                    -- Mật khẩu
  `phone_number` VARCHAR(15) NOT NULL,                 -- Số điện thoại
  `email` VARCHAR(255) NOT NULL,                       -- Email
  `birth_year` INT(4) NOT NULL,         
  `approval_status` TINYINT(1) DEFAULT 0 NOT NULL,                 -- Trạng thái phê duyệt
  `branch_name` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,    -- Thời gian tạo
  PRIMARY KEY (`users_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone_number` (`phone_number`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`f_name`, `l_name`, `username`, `password`, `phone_number`, `email`, `birth_year`, `branch_name`) VALUES
('Ngọc', 'Nguyễn', 'ngoc.nguyen1234', 'password123', '+84 123456789', 'ngoc@example.com', 2016, 'Kid&Us Nguyen Thi Thap'),
('Linh', 'Trần', 'linh_tran567', 'password456', '+84 987654321', 'linh@example.com', 2017, 'Kid&Us City Land Park Hills'),
('Hà', 'Phạm', 'ha_pham_hai09234', 'password789', '+84 112233445', 'ha@example.com', 2018, 'Kid&Us Cao Đức Lân'),
('Minh', 'Lê', 'minh18374957', 'password101', '+84 556677889', 'minh@example.com', 2019, 'Kid&Us Sư Vạn Hạnh'),
('Anh', 'Vũ', 'anhvuvn839', 'password102', '+84 998877665', 'anh@example.com', 2020, 'Kid&Us Lê Văn Việt'),
('Hùng', 'Ngô', 'hunghungngo8298', 'password103', '+84 334455667', 'hung@example.com', 2021, 'Kid&Us Tên Lửa');


-- --------------------------------------------------------
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` INT(11) NOT NULL AUTO_INCREMENT,  
  `category_name` VARCHAR(255) NOT NULL,         
  `description` VARCHAR(255) NOT NULL,                -- Mô tả
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `categories`
INSERT INTO `categories` (  `category_id`,`category_name`, `description`) VALUES
(1,'Tiếng anh trẻ em', 'Chia sẻ kiến thức và phương pháp học Tiếng Anh cho trẻ em.'),
(2,'Tin tức - Sự kiện', 'Cập nhật các tin tức và sự kiện mới nhất.'),
(3, 'Nuôi dạy con', 'Chia sẻ kinh nghiệm về việc nuôi dạy con cái.');

-- --------------------------------------------------------
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` INT(11) NOT NULL AUTO_INCREMENT,   -- Unique identifier for each blog
  `category_id` INT(11) NOT NULL,              -- Category ID (Foreign Key from `categories`)
  `title` VARCHAR(255) NOT NULL,               -- Title of the blog post
  `content` TEXT,            
  `author_id` int(11) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Creation timestamp
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Last update timestamp
  PRIMARY KEY (`blog_id`),
  FOREIGN KEY (`category_id`) REFERENCES categories(category_id),
  FOREIGN KEY (`author_id`) REFERENCES admin(admin_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `blogs`
MODIFY COLUMN `author_id` INT(11) NULL;

-- Dumping data for table `blogs`
INSERT INTO `blogs` (`category_id`, `title`, `content`) VALUES
(1, 'Blog 1 về Tiếng Anh cho trẻ em', 'Đây là nội dung của blog Tiếng Anh cho trẻ em.'),
(2, 'Tin tức về sự kiện A', 'Nội dung tin tức về sự kiện A.'),
(3, 'Blog về Nuôi dạy con', 'Đây là nội dung về nuôi dạy con.');

-- --------------------------------------------------------
-- Table structure for images in `blogs`
--
CREATE TABLE `blog_images` (
  `image_id` INT(11) NOT NULL AUTO_INCREMENT,    -- Unique identifier for each image
  `blog_id` INT(11) NOT NULL,                     -- Blog ID (Foreign Key from `blogs`)
  `image` LONGBLOB NOT NULL,                      -- The image data (binary)
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Creation timestamp
  PRIMARY KEY (`image_id`),
  FOREIGN KEY (`blog_id`) REFERENCES `blogs`(`blog_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `blog_images_title` (
  `image_title_id` INT(11) NOT NULL AUTO_INCREMENT,    -- Unique identifier for each image
  `blog_id` INT(11) NOT NULL,                     -- Blog ID (Foreign Key from `blogs`)
  `image` LONGBLOB NOT NULL,                      -- The image data (binary)
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Creation timestamp
  PRIMARY KEY (`image_title_id`),
  FOREIGN KEY (`blog_id`) REFERENCES `blogs`(`blog_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for table `comments`
--
CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`comment_id`),
  FOREIGN KEY (`blog_id`) REFERENCES `blogs`(`blog_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
