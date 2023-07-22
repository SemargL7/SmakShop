
    function appendParamsToUrl(url, params) {
    var paramStr = Object.entries(params)
    .map(function([key, value]) {
    return encodeURIComponent(key) + '=' + encodeURIComponent(value);
})
    .join('&');

    var baseUrl = url.split('?')[0];

    var existingParams = url.split('?')[1] || '';
    var existingParamsObj = {};

    existingParams.split('&').forEach(function(param) {
    var [paramKey, paramValue] = param.split('=');
    if (paramValue !== 'undefined') {
    existingParamsObj[paramKey] = paramValue;
}
});

    Object.keys(params).forEach(function(key) {
    if (params[key] !== 'undefined') {
    existingParamsObj[key] = encodeURIComponent(params[key]);
}
});

    var updatedParams = Object.entries(existingParamsObj)
    .map(function([key, value]) {
    return key + '=' + value;
})
    .join('&');

    return baseUrl + (updatedParams ? '?' + updatedParams : '');
}

    var forms = document.querySelectorAll('form.filter-search');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            var url = window.location.href;

            var params = {};
            var inputs = form.querySelectorAll('input');
            inputs.forEach(function(input) {
                if (input.name) {
                    params[input.name] = input.value;
                }
            });

            url = appendParamsToUrl(url, params);

            window.location.href = url;
        });
    });



    // Function to get URL parameters as an object
    function getUrlParams() {
        var searchParams = new URLSearchParams(window.location.search);
        var params = {};

        for (var pair of searchParams.entries()) {
            params[pair[0]] = pair[1];
        }

        return params;
    }

    // Function to generate a block element
    function generateBlock(paramName, paramValue) {
        var block = document.createElement('div');
        block.className = 'param-block';

        var paramText = '';

        switch (paramName) {
            case 'price_from':
                paramText = 'Ціна від: ' + paramValue + 'грн';
                break;
            case 'price_to':
                paramText = 'Ціна до: ' + paramValue + 'грн';
                break;
            case 'filter':
                paramText = 'По словах: ' + paramValue;
                break;
            case 'category':
                paramText = 'Категорія: ' + paramValue;
                break;
            // Add more cases for other filter parameters as needed
            default:
                paramText = paramName + ': ' + paramValue;
        }

        var removeButton = document.createElement('button');
        removeButton.innerHTML = paramText + '<span>&bigotimes;<span>';
        removeButton.addEventListener('click', function() {
            removeParameter(paramName);
            block.remove();
            location.reload(); // Refresh the page
        });

        block.appendChild(removeButton);

        return block;
    }

    // Function to remove a parameter from the URL
    function removeParameter(paramName) {
        var searchParams = new URLSearchParams(window.location.search);
        searchParams.delete(paramName);

        var newUrl = window.location.pathname + '?' + searchParams.toString();
        window.history.replaceState({}, document.title, newUrl);
    }

    // Get the URL parameters
    var urlParams = getUrlParams();

    // Get the blocks container element
    var blocksContainer = document.getElementById('blocks-container');

    // Generate blocks for each parameter in the URL
    for (var param in urlParams) {
        if (urlParams.hasOwnProperty(param)) {
            var block = generateBlock(param, urlParams[param]);
            blocksContainer.appendChild(block);
        }
    }





    // get filtered items
    function getItems() {
        // Retrieve the filter values from the URL
        var urlParams = new URLSearchParams(window.location.search);
        var category = urlParams.get('category');
        var priceFrom = urlParams.get('price_from');
        var priceTo = urlParams.get('price_to');
        var filter = urlParams.get('filter');

        // Construct the API URL with the filter parameters
        var apiUrl = '/api/search?';

        if (category) {
            apiUrl += 'category=' + encodeURIComponent(category) + '&';
        }

        if (priceFrom) {
            apiUrl += 'price_from=' + encodeURIComponent(priceFrom) + '&';
        }

        if (priceTo) {
            apiUrl += 'price_to=' + encodeURIComponent(priceTo) + '&';
        }

        if (filter) {
            apiUrl += 'filter=' + encodeURIComponent(filter) + '&';
        }

        // Send the GET request to the API endpoint
        fetch(apiUrl)
            .then(function(response) {
                // Check if the response was successful
                if (response.ok) {
                    // Parse the response JSON
                    return response.json();
                } else {
                    throw new Error('Error: ' + response.status);
                }
            })
            .then(function(items) {
                // Handle the retrieved items
                console.log(items);
                // Create item blocks based on the retrieved items
                createItemBlocks(items);
            })
            .catch(function(error) {
                // Handle any errors
                console.error(error);
                // Display an error message on the UI
                // ...
            });
    }

    function createItemBlocks(items) {
        var itemsContainer = document.getElementById('itemsContainer');

        // Clear previous item blocks
        itemsContainer.innerHTML = '';

        // Create item blocks based on the retrieved items
        items.forEach(function(item) {
            var itemBlock = document.createElement('div');
            itemBlock.className = 'col';

            var itemPreview = document.createElement('div');
            itemPreview.className = 'item-preview row';
            itemBlock.appendChild(itemPreview);

            var itemImageContainer = document.createElement('div');
            itemImageContainer.className = 'col-md-12';
            itemPreview.appendChild(itemImageContainer);

            if(item.image){
                var itemImage = document.createElement('img');
                itemImage.src = item.image.path; // Update to use item.image.path
                itemImage.alt = 'Image of ' + item.name;
                itemImageContainer.appendChild(itemImage);
            }

            var itemDetailsContainer = document.createElement('div');
            itemDetailsContainer.className = 'col-md-12 row text-center mx-auto';
            itemPreview.appendChild(itemDetailsContainer);

            var itemNameContainer = document.createElement('div');
            itemNameContainer.className = 'col-md-12';
            itemDetailsContainer.appendChild(itemNameContainer);

            var itemName = document.createElement('b');
            itemName.textContent = item.name;
            itemNameContainer.appendChild(itemName);

            var itemPriceContainer = document.createElement('div');
            itemPriceContainer.className = 'col-md-12';
            itemDetailsContainer.appendChild(itemPriceContainer);

            var itemPriceLabel = document.createElement('b');
            itemPriceLabel.textContent = 'Price: ';
            itemPriceContainer.appendChild(itemPriceLabel);

            var itemPrice = document.createElement('span');
            itemPrice.textContent = item.price.toFixed(2);
            itemPriceContainer.appendChild(itemPrice);

            var itemStarRating = document.createElement('div');
            itemStarRating.className = 'col-md-12';
            itemStarRating.classList.add('star-rating')
            itemStarRating.textContent = item.average_stars;
            itemDetailsContainer.appendChild(itemStarRating);

            var itemBuyButtonContainer = document.createElement('div');
            itemBuyButtonContainer.className = 'col-md-12';
            itemDetailsContainer.appendChild(itemBuyButtonContainer);

            var itemBuyButton = document.createElement('a');
            itemBuyButton.className = 'btn btn-dark w-100 rounded-0';
            itemBuyButton.textContent = 'Buy';
            itemBuyButtonContainer.appendChild(itemBuyButton);

            // Append the item block to the items container
            itemsContainer.appendChild(itemBlock);
        });
    }

    // Call the function to retrieve items and create item blocks
    getItems();
