const cards = document.querySelectorAll(".coming-soon-slider .game-card");

let current = 0;

function showNextCard() {

    cards[current].classList.remove("active");

    current++;

    if (current >= cards.length) {
        current = 0;
    }

    cards[current].classList.add("active");
}

setInterval(showNextCard, 3000);