DROP DATABASE if EXISTS rj_lab5db;
CREATE DATABASE rj_lab5db;

USE rj_lab4db; CREATE TABLE users (
	userId BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	firstName TINYTEXT NOT NULL,
	lastName TINYTEXT NOT NULL,
	userName VARCHAR(20) UNIQUE NOT NULL, 
	userPassword VARCHAR(128) NOT NULL,
	userPasswordSalt VARCHAR(128) NOT NULL,
	email VARCHAR(254) UNIQUE NOT NULL, 
	gender ENUM('male', 'female'), 
	creationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); CREATE TABLE IF NOT EXISTS `articles` (
  `articleID` bigint(20) unsigned NOT NULL,
  `editorID` bigint(20) unsigned DEFAULT NULL,
  `articleTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `submissionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `retailers` mediumblob,
  `videos` mediumblob,
  `articles` mediumblob,
  `others` mediumblob
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; CREATE TABLE revisions (
	revisionID BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
	editorID BIGINT UNSIGNED,
	articleTitle VARCHAR(255) NOT NULL,
	submissionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
	pageText BLOB
);