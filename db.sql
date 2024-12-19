CREATE TABLE players (
    player_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique ID for each player
    username VARCHAR(50) NOT NULL UNIQUE,      -- Unique username for the player
    email VARCHAR(100) NOT NULL UNIQUE,        -- Email address (must be unique)
    password VARCHAR(255) NOT NULL,            -- Encrypted password
    status ENUM('Active', 'Inactive') DEFAULT 'Active', -- Player's status
    date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Registration date
);

CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    price_per_hour DECIMAL(10, 2) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(50) NOT NULL,
    age_bracket VARCHAR(20) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE game_records (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each record
    player_name VARCHAR(100) NOT NULL, -- Name of the player
    game_name VARCHAR(100) NOT NULL, -- Name of the game played
    hours_played INT NOT NULL, -- Number of hours the game was played
    date_played DATE NOT NULL, -- Date the game was played
    amount_paid DECIMAL(10, 2) NOT NULL, -- Amount paid for playing the game
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Automatically records the time of entry
);
