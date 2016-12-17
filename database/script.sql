CREATE DATABASE DATAMAHASISWA;
USE DATAMAHASISWA;

CREATE TABLE MAHASISWA(
	NIS INT NOT NULL,
	NAMA VARCHAR (45),
	TGL_LAHIR DATE,
	JENIS_KELAMIN ENUM('Laki-laki', 'Perempuan'),
	ALAMAT VARCHAR(30),
	JURUSAN VARCHAR(25),
	PRIMARY KEY(NIS)
);

INSERT INTO 
	MAHASISWA 
VALUES
	(1404056, 'Reza Pahlevi Bahruddin', '1996-07-27', 'Laki-laki', 'Jombang','Teknik Informatika'),
	(1404075, 'Sri Bulan Megawati', '1996-04-19', 'Perempuan', 'Nganjuk','Teknik Informatika');
