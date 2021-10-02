lightMode = localStorage.getItem("lightMode");
if(lightMode === "enabled"){
    enableLightMode();
    $("#chk").prop("checked", true);
}
function enableLightMode(){
    localStorage.setItem("lightMode", "enabled");
    $("body").addClass("light-mode");
}
function disableLightMode() {
    localStorage.setItem("lightMode", null);
    $("body").removeClass("light-mode");1
}

$("#settings").click(function(){
    $("#settings-con").toggleClass("hidden");
    console.log();
})


console.log($("#chk"));
$("#chk").click(function (){
    lightMode = localStorage.getItem("lightMode");
    if(this.checked){
        enableLightMode();
    }
    else{
        disableLightMode();
    }
})