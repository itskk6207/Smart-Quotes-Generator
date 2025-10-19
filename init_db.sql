CREATE DATABASE IF NOT EXISTS quote_api_db;
USE quote_api_db;

-- Admin table
CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- Default admin
INSERT IGNORE INTO admin(username, password) VALUES ('admin', SHA1('1234'));

-- Quotes table
CREATE TABLE IF NOT EXISTS quotes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  quote_text TEXT NOT NULL,
  author VARCHAR(100),
  category VARCHAR(50)
);

-- Sample quotes
INSERT INTO quotes (quote_text, author, category) VALUES
('The best way to get started is to quit talking and begin doing.', 'Walt Disney', 'motivational'),
('Life is what happens when you''re busy making other plans.', 'John Lennon', 'life'),
('Get busy living or get busy dying.', 'Stephen King', 'life'),
('Your time is limited, so don’t waste it living someone else’s life.', 'Steve Jobs', 'motivational'),
('Whether you think you can or you think you can’t, you’re right.', 'Henry Ford', 'motivational'),
('I have learned over the years that when one’s mind is made up, this diminishes fear.', 'Rosa Parks', 'inspirational'),
('The only impossible journey is the one you never begin.', 'Tony Robbins', 'inspirational'),
('In the middle of every difficulty lies opportunity.', 'Albert Einstein', 'life'),
('Do what you can with all you have, wherever you are.', 'Theodore Roosevelt', 'motivational'),
('Believe you can and you’re halfway there.', 'Theodore Roosevelt', 'motivational');
