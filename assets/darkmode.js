lightMode = localStorage.getItem("lightMode");
if(lightMode === "enabled"){
    localStorage.setItem("lightMode", "enabled");
    $("html").addClass("light-mode");
}
$(document).ready(function(){
    if(lightMode === "enabled"){
        $("#chk").prop('checked', true);
    }
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