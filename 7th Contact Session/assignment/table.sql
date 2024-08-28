--
-- Database: `bincom_training_guestbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `guestbook`
--
CREATE DATABASE bincom_training_guestbook;

USE bincom_training_guestbook;

CREATE TABLE guestbooks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  message TEXT NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

