-- SQL Database Schema untuk Sistem Voting Ketua Senat Fakultas

-- Table: users
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'mahasiswa') NOT NULL DEFAULT 'mahasiswa',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(255) NOT NULL,
    jurusan VARCHAR(255) NOT NULL,
    angkatan VARCHAR(4) NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id)
);

-- Table: kandidat
CREATE TABLE IF NOT EXISTS kandidat (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nama_kandidat VARCHAR(255) NOT NULL,
    visi LONGTEXT NOT NULL,
    misi LONGTEXT NOT NULL,
    foto VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: voting
CREATE TABLE IF NOT EXISTS voting (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    mahasiswa_id BIGINT UNSIGNED NOT NULL,
    kandidat_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_mahasiswa_voting (mahasiswa_id),
    FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa (id) ON DELETE CASCADE,
    FOREIGN KEY (kandidat_id) REFERENCES kandidat (id) ON DELETE CASCADE,
    INDEX idx_mahasiswa_id (mahasiswa_id),
    INDEX idx_kandidat_id (kandidat_id)
);

-- Create indexes for better performance
CREATE INDEX idx_email ON users (email);

CREATE INDEX idx_nim ON mahasiswa (nim);

CREATE INDEX idx_nama_kandidat ON kandidat (nama_kandidat);