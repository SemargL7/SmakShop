function generateStarRating() {
    var starRatingContainers = document.querySelectorAll('.star-rating');

    for (var i = 0; i < starRatingContainers.length; i++) {
        var starRatingContainer = starRatingContainers[i];
        var averageStars = parseInt(starRatingContainer.innerHTML);
        starRatingContainer.innerHTML = '';

        for (var j = 1; j <= 5; j++) {
            var starIcon = document.createElement('span');
            starIcon.className = 'star';

            if (j <= averageStars) {
                starIcon.innerHTML = '&starf;'; // Add a class to represent filled stars
            }else {
                starIcon.innerHTML = '&star;'; // Add a class to represent empty stars
            }

            starIcon.classList.add('star'); // Add a specific class to the star icons

            starRatingContainer.appendChild(starIcon);
        }
    }
}

generateStarRating();

