CREATE TABLE relationships(
    followingID int(20),
    followerID int(20),
    notif boolean DEFAULT false,
    dateFollowed int(80),
    dateFollowed int(80),
    PRIMARY KEY(followingID, followerID),
    FOREIGN KEY (followingID) REFERENCES users(userID),
    FOREIGN KEY (followerID) REFERENCES users(userID)
)