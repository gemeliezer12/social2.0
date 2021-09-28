
SELECT * FROM posts p JOIN 
reposts r ON p.postID=r.repostedPost UNION
SELECT userID, postID, content, dateCreated, null as userID,
null as repostID, null as content, null as dateCreated, null as repostedPost, null as repostedComment, null as repostedUser FROM posts p

SELECT * FROM posts p JOIN 
reposts r ON 
p.postID=r.repostedPost UNION ALL 
SELECT userID, postID, content, dateCreated,
null as reposterID, null as repostID, null as repostContent, null as dateReposted, null as repostedPost, null as repostedComment, null as repostedUser 
FROM posts p 
WHERE userID in (1, 2, 3);

SELECT *
       FROM (SELECT p1.postID,
                    p1.userID,
                    p1.content,
                    p1.dateCreated
                    FROM posts p1
                    WHERE p1.userID in (1, 2, 3)
             UNION ALL
             SELECT r1.postID,
                    r1.userID,
                    p2.content,
                    r1.dateCreated
                    FROM reposts r1
                         INNER JOIN posts p2
                                    ON p2.postID = r1.postID
                    WHERE r1.userid in (1, 2, 3)) x
       ORDER BY x.dateCreated DESC;