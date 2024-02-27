const profileIcon = document.getElementById("profilo")
const Xicon = document.getElementById("X")
const profileForm = document.getElementById("profilo-form")
let eventInProgress = false
let count = 0

function openCloseMenu(){
    
    if(count % 2 == 1 && !eventInProgress){
        eventInProgress = true
        profileForm.classList.toggle("opacity-0")

        setTimeout(() => {
            profileForm.classList.toggle("visually-hidden")
            eventInProgress = false;
        }, 200);

        count++
        eventInProgress = false
    } else {
        profileForm.classList.toggle("visually-hidden")
        profileForm.classList.toggle("opacity-0")
        count++
    }
}

profileIcon.addEventListener("click", openCloseMenu)
Xicon.addEventListener("click", openCloseMenu)