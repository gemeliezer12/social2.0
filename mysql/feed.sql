SELECT "repost" as type, p.userID, postID, p.content, r.dateCreated FROM posts p JOIN reposts r ON p.postID=r.repostedPost 
UNION SELECT "post" as type, p.userID, postID, p.content, p.dateCreated FROM posts p;

SELECT "repostComment" as type, p.userID, postID as articleID, p.content, r.dateCreated FROM posts p JOIN reposts r ON p.postID=r.repostedPost 
UNION 
SELECT "repostPost" as type, c.userID, commentID as articleID, c.content, r.dateCreated FROM comments c JOIN reposts r ON c.commentID=r.repostedPost

SELECT "repostComment" as type, p.userID, postID as articleID, p.content, r.dateCreated, r.userID FROM posts p JOIN reposts r ON p.postID=r.repostedPost
UNION 
SELECT "repostPost" as type, c.userID, commentID as articleID, c.content, r.dateCreated, r.userID FROM comments c JOIN reposts r ON c.commentID=r.repostedComment
UNION
SELECT "post" as type, p.userID, postID, p.content, p.dateCreated, null as userID FROM posts p;

SELECT "repostComment" as type, p.userID, postID as articleID, p.content, r.dateCreated FROM posts p JOIN reposts r ON p.postID=r.repostedPost WHERE r.userID in (1)
UNION 
SELECT "repostPost" as type, c.userID, commentID as articleID, c.content, r.dateCreated FROM comments c JOIN reposts r ON c.commentID=r.repostedComment WHERE r.userID in (1)
UNION
SELECT "post" as type, p.userID, postID, p.content, p.dateCreated FROM posts p WHERE p.userID IN (1)