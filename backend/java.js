const cursorCircle = document.getElementById("cursorCircle");

if (cursorCircle) {
    document.addEventListener("mousemove", function(event){
        cursorCircle.style.left = event.clientX + "px";
        cursorCircle.style.top = event.clientY + "px";
    });
}

const filterButtons = document.querySelectorAll(".filter-btn"); //random comments
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

if (eventSearch) {
    const eventCards = document.querySelectorAll(".event-card");

    eventSearch.addEventListener("keyup", function(){
        const searchValue = eventSearch.value.toLowerCase();

        eventCards.forEach(function(card){
            const text = card.innerText.toLowerCase();

            card.style.display = text.includes(searchValue)
                ? "block"
                : "none";
        });
    });
}

const eventCategory = document.getElementById("eventCategory");

if (eventCategory) {
    const eventCards = document.querySelectorAll(".event-card");

    eventCategory.addEventListener("change", function(){
        const selected = eventCategory.value;

        eventCards.forEach(function(card){
            const category = card.getAttribute("data-category");

            card.style.display =
                (selected === "all" || category === selected)
                ? "block"
                : "none";
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
