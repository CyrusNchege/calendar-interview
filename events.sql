CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    label VARCHAR(255),
    description TEXT,
    event_date DATE NOT NULL,
    start_time TIME,
    end_time TIME,
    all_day TINYINT(1) DEFAULT 0,
    url VARCHAR(255),
    guests TEXT,
    location VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
