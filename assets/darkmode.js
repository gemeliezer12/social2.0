lightMode = localStorage.getItem("lightMode");
console.log(lightMode);
if(lightMode === "enabled"){
    localStorage.setItem("lightMode", "enabled");
    $("html").addClass("light-mode");
}
console.log($("#chk"));
$(document).ready(function(){
    if(lightMode === "enabled"){
        $("#chk").prop('checked', true);
    }
    console.log($("#chk"));
    
    function enableLightMode(){
        localStorage.setItem("lightMode", "enabled");
        $("html").addClass("light-mode");
    }
    function disableLightMode() {
        localStorage.setItem("lightMode", null);
        $("html").removeClass("light-mode");1
    }
    
    $("#settings").click(function(){
        $("#settings-con").toggleClass("hidden");
        console.log();
    })
    $("#chk").click(function (){
        lightMode = localStorage.getItem("lightMode");
        if(this.checked){
            enableLightMode();
        }
        else{
            disableLightMode();
        }
    })
})
    // enableLightMode();