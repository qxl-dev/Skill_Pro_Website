
-- Users (Admin, Instructors, Students)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role ENUM('admin','instructor','student') NOT NULL,
  full_name VARCHAR(120) NOT NULL,
  email VARCHAR(160) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Instructor Profiles
CREATE TABLE instructor_profiles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  expertise VARCHAR(255),
  bio TEXT,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Courses
CREATE TABLE courses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(160),
  category VARCHAR(100),
  description TEXT,
  fee DECIMAL(10,2) DEFAULT 0
);

-- Course Offerings (specific batch info)
CREATE TABLE course_offerings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  course_id INT,
  instructor_id INT,
  mode ENUM('Online','On-site'),
  location VARCHAR(120),
  start_date DATE,
  end_date DATE,
  FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
  FOREIGN KEY (instructor_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Registrations (student enrollments)
CREATE TABLE registrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  offering_id INT,
  student_id INT,
  registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uniq_student_offering (offering_id, student_id),
  FOREIGN KEY (offering_id) REFERENCES course_offerings(id) ON DELETE CASCADE,
  FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Notices
CREATE TABLE notices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200),
  content TEXT,
  publish_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inquiries
CREATE TABLE inquiries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120),
  email VARCHAR(160),
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------
-- sample data for the database
-- -----------------------------

-- Admin
INSERT INTO users (role, full_name, email, password_hash) VALUES
('admin','Chathura Perera','admin@skillpro.lk', SHA2('admin123',256));

-- Instructors
INSERT INTO users (role, full_name, email, password_hash) VALUES
('instructor','Sanduni Fernando','sanduni@skillpro.lk', SHA2('pass123',256)),
('instructor','Kusal Jayawardena','kusal@skillpro.lk', SHA2('pass123',256)),
('instructor','Dilani Abeysekera','dilani@skillpro.lk', SHA2('pass123',256)),
('instructor','Tharindu Weerasinghe','tharindu@skillpro.lk', SHA2('pass123',256));

-- Students
INSERT INTO users (role, full_name, email, password_hash) VALUES
('student','Nadeesha Silva','nadeesha@skillpro.lk', SHA2('123456',256)),
('student','Ruwan Peris','ruwan@skillpro.lk', SHA2('123456',256)),
('student','Ishara Bandara','ishara@skillpro.lk', SHA2('123456',256)),
('student','Malith Senanayake','malith@skillpro.lk', SHA2('123456',256)),
('student','Gayani Ratnayake','gayani@skillpro.lk', SHA2('123456',256)),
('student','Pasan Samarasinghe','pasan@skillpro.lk', SHA2('123456',256)),
('student','Hashini Wickramasinghe','hashini@skillpro.lk', SHA2('123456',256)),
('student','Chamika Gamage','chamika@skillpro.lk', SHA2('123456',256)),
('student','Rashmi Kulatunga','rashmi@skillpro.lk', SHA2('123456',256)),
('student','Sajith Mendis','sajith@skillpro.lk', SHA2('123456',256));

-- Instructor Profiles
INSERT INTO instructor_profiles (user_id, expertise, bio) VALUES
(2,'ICT','10+ years in IT training, software systems'),
(3,'Welding','Certified welding instructor with industry experience'),
(4,'Plumbing','Licensed plumbing instructor'),
(5,'Hospitality','Experienced hotel management lecturer');

-- Courses
INSERT INTO courses (title,category,description,fee) VALUES
('ICT Fundamentals','ICT','Intro to computers and networking',15000),
('Advanced Welding','Welding','Practical welding techniques',20000),
('Plumbing Basics','Plumbing','Residential plumbing training',12000),
('Hotel Management','Hospitality','Front office & housekeeping',18000),
('Software Development','ICT','Full-stack development',25000),
('Electrical Engineering Basics','Engineering','Circuits and wiring',22000);

-- Offerings
INSERT INTO course_offerings (course_id,instructor_id,mode,location,start_date,end_date) VALUES
(1,2,'On-site','Colombo','2025-10-01','2025-12-15'),
(2,3,'On-site','Kandy','2025-10-05','2026-01-15'),
(3,4,'Online','Online','2025-11-01','2026-01-30'),
(4,5,'On-site','Matara','2025-10-20','2026-01-10'),
(5,2,'Online','Online','2025-10-10','2026-02-20'),
(6,3,'On-site','Colombo','2025-11-15','2026-02-28');

-- Registrations (some sample enrollments)
INSERT INTO registrations (offering_id,student_id) VALUES
(1,6),(1,7),(2,8),(3,9),(4,10),(5,11),(6,12),(2,13),(3,14),(4,15);

-- Notices
INSERT INTO notices (title,content) VALUES
('New Batch Starts','ICT Fundamentals new batch begins on 1st October'),
('Holiday Notice','Institute will be closed on Poya Day'),
('Job Fair','SkillPro Job Fair on 15th November at Colombo branch'),
('Workshop','Special Welding Workshop in Kandy branch on 20th October');

-- Inquiries
INSERT INTO inquiries (name,email,message) VALUES
('Lakshan Perera','lakshan@mail.com','Need info about Plumbing Basics'),
('Shanika Rodrigo','shanika@mail.com','Do you provide certificates?');
