CREATE DATABASE IF NOT EXISTS berat_bozkurt_login_db;

CREATE TABLE IF NOT EXISTS `users` (
			`user_id` int(8) NOT NULL AUTO_INCREMENT,
			`username` varchar(100) NOT NULL ,
			`password` varchar(100) NOT NULL,
			`email` varchar(250) NOT NULL,
			`phone` varchar(11) NOT NULL,
			PRIMARY KEY (`user_id`)
		);
        
        
SELECT username FROM users WHERE username=?;


SELECT email FROM users WHERE email=?;


SELECT phone FROM users WHERE phone=?;


INSERT INTO users (username,password,email,phone) VALUES ( ? , ? , ? , ? );


SELECT username FROM users WHERE username =? AND password=?;


SELECT * FROM users;
