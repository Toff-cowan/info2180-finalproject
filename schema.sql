-- INFO2180 Project 2 - Dolphin CRM
-- Database + Tables: users, contacts, notes

DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;
USE dolphin_crm;

-- -------------------------
-- USERS TABLE
-- -------------------------
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(50) NOT NULL,
  lastname  VARCHAR(50) NOT NULL,
  password  VARCHAR(255) NOT NULL,
  email     VARCHAR(100) NOT NULL UNIQUE,
  role      VARCHAR(20) NOT NULL DEFAULT 'Member',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -------------------------
-- CONTACTS TABLE
-- -------------------------
DROP TABLE IF EXISTS contacts;
CREATE TABLE contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title     VARCHAR(10) NOT NULL,
  firstname VARCHAR(50) NOT NULL,
  lastname  VARCHAR(50) NOT NULL,
  email     VARCHAR(100) NOT NULL,
  telephone VARCHAR(30),
  company   VARCHAR(100),
  type      VARCHAR(20) NOT NULL,          -- "Sales Lead" or "Support"
  assigned_to INT NOT NULL,                -- user id
  created_by  INT NOT NULL,                -- user id
  created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT fk_contacts_assigned_to
    FOREIGN KEY (assigned_to) REFERENCES users(id)
    ON UPDATE CASCADE ON DELETE RESTRICT,

  CONSTRAINT fk_contacts_created_by
    FOREIGN KEY (created_by) REFERENCES users(id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- -------------------------
-- NOTES TABLE
-- -------------------------
DROP TABLE IF EXISTS notes;
CREATE TABLE notes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  contact_id INT NOT NULL,
  comment TEXT NOT NULL,
  created_by INT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT fk_notes_contact
    FOREIGN KEY (contact_id) REFERENCES contacts(id)
    ON UPDATE CASCADE ON DELETE CASCADE,

  CONSTRAINT fk_notes_created_by
    FOREIGN KEY (created_by) REFERENCES users(id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- -------------------------
-- REQUIRED ADMIN USER
-- Email: admin@project2.com
-- Password: password123 
-- -------------------------
INSERT INTO users (firstname, lastname, password, email, role)
VALUES ('Admin', 'User', '$2y$10$nIzGJK/jTzKi.ZcHH9QMJOyyNy.96krcY/BtdWBvEHPNuNhHejg2e', 'admin@project2.com', 'Admin');
