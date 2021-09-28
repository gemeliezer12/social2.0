CREATE TABLE reposts(
    userID int(20),
	repostID int(30) AUTO_INCREMENT PRIMARY KEY,
    content varchar(400),
    dateCreated int(80),
    repostedUser in (20),
    repostedPost int(30),
    repostedComment int(30),
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (repostedUser) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (repostedPost) REFERENCES posts(postID) ON DELETE CASCADE,
    FOREIGN KEY (repostedComment) REFERENCES comments(commentID) ON DELETE CASCADE
)