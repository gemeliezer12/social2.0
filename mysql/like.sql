CREATE TABLE likes(
    userID int(20),
    dateCreated int(80),
    likedUser int(20),
    likedPost int(30),
    likedComment int(30),
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (likedUser) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (likedPost) REFERENCES posts(postID) ON DELETE CASCADE,
    FOREIGN KEY (likedComment) REFERENCES comments(commentID) ON DELETE CASCADE,
    PRIMARY KEY (userID, likedPost) ,
    PRIMARY KEY (userID, likedComment) 
)