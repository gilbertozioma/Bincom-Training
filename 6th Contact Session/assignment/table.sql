--
-- Database: `bincom_training_student_attendance_register`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--
CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_name VARCHAR(100) NOT NULL,
  student_roll_no VARCHAR(50) NOT NULL
);


--
-- Table structure for table `attendance`
--
CREATE TABLE attendance (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT,
  attendance_date DATE,
  status ENUM('Present', 'Absent') NOT NULL,
  FOREIGN KEY (student_id) REFERENCES students(id)
);


--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
ADD CONSTRAINT `attendance_fk` FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE;
