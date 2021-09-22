CREATE TABLE postsinteraction(
    postedID int(20),
    posterID int(20),
	postID int(30),
    liked boolean DEFAULT false,
    reposted boolean DEFAULT false,
    dateCreated int(80),
    dateReposted int(80),
    PRIMARY KEY (postedID, posterID, postID),
    FOREIGN KEY (postedID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (posterID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (postID) REFERENCES posts(postID) ON DELETE CASCADE
)

CREATE TABLE commentinteraction(
    postedID int(20),
    posterID int(20),
	commentID int(30),
    liked boolean DEFAULT false,
    reposted boolean DEFAULT false,
    dateCreated int(80),
    dateReposted int(80),
    PRIMARY KEY (postedID, posterID, commentID),
    FOREIGN KEY (postedID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (posterID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (commentID) REFERENCES comments(commentID) ON DELETE CASCADE
)