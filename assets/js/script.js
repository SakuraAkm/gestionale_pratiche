const profileIcon = document.getElementById("profilo")
const profileForm = document.getElementById("profilo-form")

profileIcon.addEventListener("click", () => {
    profileForm.classList.toggle("visually-hidden")
    profileForm.classList.toggle("opacity-0")
})