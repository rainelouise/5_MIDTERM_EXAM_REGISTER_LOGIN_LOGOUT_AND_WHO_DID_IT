CREATE TABLE crocheters (
    crocheter_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255), 
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    date_of_birth DATE,
    phone_number VARCHAR(20),
    email_address VARCHAR(100),
    expertise TEXT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(50),
    type_of_crochet TEXT,
    crocheter_id INT,
    created_by INT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (created_by) REFERENCES crocheters(crocheter_id) ON DELETE CASCADE,
    FOREIGN KEY (crocheter_id) REFERENCES crocheters(crocheter_id) ON DELETE CASCADE
);
