CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`fname` varchar(100) NOT NULL,
	`lname` varchar(100) NOT NULL,
	`email` varchar(50) NOT NULL UNIQUE,
	`password` varchar(50) NOT NULL,
	`phone` varchar(15),
	`is_admin` BOOLEAN,
	`company_info` varchar(500),
	`company_name` varchar(100),
	`company_site` varchar(100),
	`company_description` varchar(1000),
	PRIMARY KEY (`id`)
);

CREATE TABLE `jobs` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`title` varchar(100) NOT NULL,
	`image` varchar(255),
	`salary` INT(10) NOT NULL,
	`date` TIMESTAMP NOT NULL,
	`is_approved` BOOLEAN NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `category` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(50) UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `submissions` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`jobs_id` INT NOT NULL,
	`message` varchar(255) NOT NULL,
	`cv` varchar(255),
	PRIMARY KEY (`id`)
);

CREATE TABLE `jobs_category` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`jobs_id` INT NOT NULL,
	`category_id` INT NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `jobs` ADD CONSTRAINT `jobs_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);

ALTER TABLE `submissions` ADD CONSTRAINT `submissions_fk0` FOREIGN KEY (`jobs_id`) REFERENCES `jobs`(`id`);

ALTER TABLE `jobs_category` ADD CONSTRAINT `jobs_category_fk0` FOREIGN KEY (`jobs_id`) REFERENCES `jobs`(`id`);

ALTER TABLE `jobs_category` ADD CONSTRAINT `jobs_category_fk1` FOREIGN KEY (`category_id`) REFERENCES `category`(`id`);






