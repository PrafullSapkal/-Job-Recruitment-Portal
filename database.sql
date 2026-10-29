CREATE DATABASE IF NOT EXISTS recruitment_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE recruitment_portal;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('user','admin') NOT NULL DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS vacancies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  company VARCHAR(150) NOT NULL,
  location VARCHAR(120) NOT NULL,
  category VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  vacancy_id INT NOT NULL,
  cover_note TEXT,
  status ENUM('Submitted','Under Review','Shortlisted','Rejected','Selected') NOT NULL DEFAULT 'Submitted',
  applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_user_vacancy (user_id, vacancy_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (vacancy_id) REFERENCES vacancies(id) ON DELETE CASCADE
);

INSERT INTO vacancies (title, company, location, category, description)
SELECT 'Junior Web Developer', 'Example Technologies', 'Pune', 'IT', 'Assist with HTML, CSS, JavaScript, and website maintenance.'
WHERE NOT EXISTS (SELECT 1 FROM vacancies WHERE title='Junior Web Developer' AND company='Example Technologies');

INSERT INTO vacancies (title, company, location, category, description)
SELECT 'Technical Support Trainee', 'Example Services', 'Pune', 'Support', 'Help users troubleshoot basic software and application issues.'
WHERE NOT EXISTS (SELECT 1 FROM vacancies WHERE title='Technical Support Trainee' AND company='Example Services');
