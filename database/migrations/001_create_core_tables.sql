-- =========================================
-- DATABASE: support_network
-- CORE USER & SECURITY TABLES
-- =========================================

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,

    role ENUM('user','verified','moderator','admin') DEFAULT 'user',
    
    trust_score INT DEFAULT 0,
    is_verified TINYINT(1) DEFAULT 0,

    status ENUM('active','suspended','banned') DEFAULT 'active',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =========================================

CREATE TABLE user_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,

    photo VARCHAR(255) DEFAULT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    country VARCHAR(50) DEFAULT NULL,

    last_login_ip VARCHAR(45) DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_user_profile
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
);

-- =========================================

CREATE TABLE login_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,

    ip_address VARCHAR(45),
    device VARCHAR(100),
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_login_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
);
