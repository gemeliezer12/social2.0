
// $(document).ready(function(){
    $(".repost-parent").click(function(){
        
        var articleID = $(this).parent().children(".article").val();
        var type = $(this).parent().children(".article").attr("id");
        var submit = $(this).attr("name");
        $(".repost-loader").load("inc/repost.php",{
            articleID: articleID,
            type: type,
            submit: submit
        })
    })
    $(".like-parent").click(function(){
        var articleID = $(this).parent().children(".article").val();
        var type = $(this).parent().children(".article").attr("id");
        var submit = $(this).attr("name");
        $(".like-loader").load("inc/like.php",{
            articleID: articleID,
            type: type,
            submit: submit
        })
    })
    $(".article-link").click(function(e){
        var id = $(this).attr("id");
        var idSplit = id.split("-");
        var type = idSplit[0];
        var id = idSplit[1];
        console.log(id);
        if(!$(e.target).hasClass("dont-link")){
            window.location.href = "article.php?"+type+"="+id;
        }
    })
// })