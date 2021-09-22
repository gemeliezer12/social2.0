CREATE TABLE profiles(
    userID int(20) PRIMARY KEY,
	name varchar(60),
    bio varchar(200),
    profilePicture varchar(100),
    cover varchar(100),
    birthdate int(80),
    website varchar(100),
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
)