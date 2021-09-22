CREATE TABLE posts(
    userID int(20),
	postID int(30) AUTO_INCREMENT PRIMARY KEY,
    content varchar(400),
    dateCreated int(80),
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
)