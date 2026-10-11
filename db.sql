CREATE DATABASE IF NOT EXISTS course_portal;
USE course_portal;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    role VARCHAR(20) DEFAULT 'student'
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    description TEXT
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    username VARCHAR(50),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password, email, role) VALUES
('admin', 'admin123', 'admin@portal.com', 'admin'),
('alice', 'alice123', 'alice@portal.com', 'student'),
('bob', 'bob123', 'bob@portal.com', 'student');

INSERT INTO courses (title, description) VALUES
('Information Security', 'Learn security basics'),
('Web Development', 'Full stack development'),
('Data Science', 'Python and ML');
