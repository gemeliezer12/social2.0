CREATE TABLE users(
	userID int(20) AUTO_INCREMENT PRIMARY KEY,
    username varchar(60),
    email varchar(60),
    password varchar(80),
    dateCreated int(80)
)