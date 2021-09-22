CREATE TABLE comments(
    userID int(20),
	commentID int(30) AUTO_INCREMENT PRIMARY KEY,
    content varchar(400),
    dateCreated int(80),
    commentedPost int(30),
    commentedComment int(30),
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (commentedPost) REFERENCES posts(postID) ON DELETE CASCADE,
    FOREIGN KEY (commentedComment) REFERENCES comments(commentID) ON DELETE CASCADE
)