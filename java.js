const cursorCircle = document.getElementById("cursorCircle");
document.addEventListener("mousemove", function(event){
    cursorCircle.style.left=event.clientX + "px";
    cursorCircle.style.top=event.clientY + "px";
});

const joinForm = document.getElementById("joinForm");
if(joinForm){
    joinForm.addEventListener("submit", function(event){
        event.preventDefault();
        const firstName = document.getElementById("firstName");
        const lastName = document.getElementById("lastName");
        const email = document.getElementById("email");
        const studentId = document.getElementById("studentId");
        const course = document.getElementById("course");
        const formMessage = document.getElementById("forMessage");

    if( firstName.value === "" || lastName.value === "" || email.value === "" || studentId.value === "" || course.value === "" ){
      formMessage.style.color = "red";
      formMessage.innerHTML = "Please complete all required fields."; }
    else{
      formMessage.style.color = "green";
      formMessage.innerHTML = "Registration submitted successfully.";
      joinForm.reset();
    }
  });
}

const filterButtons = document.querySelectorAll(".filter-btn");
const announcementCards = document.querySelectorAll(".announcement-card");

filterButtons.forEach(function(button){
    button.addEventListener("click", function(){
        filterButtons.forEach(function(btn){
            btn.classList.remove("active");
        });
        button.classList.add("active");

        const filter = button.getAttribute("data-filter");
        announcementCards.forEach(function(card){
            if(filter === "all" || card.getAttribute("data-category") === filter){
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
});

const eventSearch = document.getElementById("eventSearch");
const eventCards = document.querySelectorAll(".event-card");

if(eventSearch){
    eventSearch.addEventListener("keyup", function(){
        const searchValue = event.Search.value.toLowerCase();
        eventCards.forEach(function(card){
            const text = card.innerText.toLowerCase();
            if(text.includes(searchValue)){
                card.style.display="block";
            }
            else {card.style.display="none";
            }
        });
    });
}

const eventCategory = document.getElementById("eventCategory");
if (eventCategory){
    eventCategory.addEventListener("change", function(){
        const selected = eventCategory.value;
        eventCards.forEach(function(card){
            const category = card.getAttribute("data-category");
            if(selected === "all" || category === selected){
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
}

const registerButtons = document.querySelectorAll(".register-btn");
registerButtons.forEach(function(button){
  button.addEventListener("click", function(){
    button.innerHTML = "Registered ✓";
    button.style.background = "#2d6a4f";

  });

});
