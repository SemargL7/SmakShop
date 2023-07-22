function generateStarRating() {
    var starRatingContainer = document.getElementById('feedback_star_rating');
    var averageStars = parseInt(starRatingContainer.innerHTML);
    fillStars(averageStars);
}

function selectStar(num) {
    var starRatingContainer = document.getElementById('feedback_star_rating');
    var stars = starRatingContainer.getElementsByClassName('star');
    for (var starElement of stars) {
        starElement.classList.remove('selected')
    }
    stars[num - 1].classList.add('selected');
    fillStars(num);

    // Your additional logic here if needed
}

function fillStars(value){
    var starRatingContainer = document.getElementById('feedback_star_rating');
    var feedback_stars = document.getElementById('feedback_stars');
    feedback_stars.value = value;
    starRatingContainer.innerHTML = '';

    for (var j = 1; j <= 5; j++) {
        var starIcon = document.createElement('span');

        // Use a closure to capture the value of j for each onclick handler
        starIcon.onclick = (function (starNumber) {
            return function () {
                selectStar(starNumber);
            };
        })(j);
        starIcon.className = 'star';

        if (j <= value) {
            starIcon.innerHTML = '&starf;'; // Add a class to represent filled stars
        } else {
            starIcon.innerHTML = '&star;'; // Add a class to represent empty stars
        }

        starRatingContainer.appendChild(starIcon);
    }
}

// Call generateStarRating once the page is loaded
document.addEventListener('DOMContentLoaded', generateStarRating);
