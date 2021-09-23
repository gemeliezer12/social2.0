const profileBtn = document.getElementById("profile-btn");
const profileOption = document.getElementById("profile-option");

profileBtn.addEventListener("click", ()=>{
    profileOption.classList.toggle("hide");
})