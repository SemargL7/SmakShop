function initCounters() {
    const products = document.getElementsByTagName('table');
    for (const product of products) { // Use "of" instead of "in" to iterate over elements
        product.querySelector('#increment').addEventListener('click', () => increment(product.id));
        product.querySelector('#increment').addEventListener('click', countTotal);
        product.querySelector('#decrement').addEventListener('click', () => decrement(product.id));
        product.querySelector('#decrement').addEventListener('click', countTotal);
    }
}

function increment(product_id) {
    var value = parseInt(document.getElementById(product_id).querySelector('#counter').value); // Parse value to an integer
    if (value < 10) {
        document.getElementById(product_id).querySelector('#counter').value = value + 1;
    }
}

function decrement(product_id) {
    var value = parseInt(document.getElementById(product_id).querySelector('#counter').value); // Parse value to an integer
    if (value > 1) {
        document.getElementById(product_id).querySelector('#counter').value = value - 1;
    }
}

initCounters();


const counterInputs = document.getElementsByClassName('counter');
for (const counterInput of counterInputs) {
    counterInput.addEventListener('change', countTotal);
}

// Function to calculate the total price
function countTotal() {
    let totalPrice = 0;
    const productsContainers = document.getElementById('products').getElementsByTagName('tbody');

    for (let i = 0; i < productsContainers.length; i++) {
        const product = productsContainers[i];
        const counterValue = parseFloat(product.querySelector('#counter').value);
        const price = parseFloat(product.querySelector('.td-price').innerText);
        totalPrice += counterValue * price;
    }

    document.getElementById('totalPrice').innerText = totalPrice.toFixed(2); // Assuming 2 decimal places for the total price
}

// Call countTotal initially to set the initial total price
countTotal();



// JavaScript code to handle form submission
document.getElementById('submitOrderBtn').addEventListener('click', function() {
    // Get form data
    const formData = {
        phone: document.getElementById('cart_input_phone').value,
        name: document.getElementById('fio').value,
        email: document.getElementById('checkout[email]').value,
        items: []
    };

    // Get item IDs and counters
    const itemElements = document.querySelectorAll('.table.basket');
    itemElements.forEach(itemElement => {
        const itemId = itemElement.getAttribute('data-content');
        const itemCount = parseInt(itemElement.querySelector('input[name="counter"]').value);

        formData.items.push({ id: itemId, count: itemCount });
    });

    // Set the collected data as a JSON string in the hidden input field
    const formDataInput = document.getElementById('formData');
    formDataInput.value = JSON.stringify(formData);
    document.getElementById('submitButton').click();
    // The form will be submitted to the server with the collected data when the button is clicked
    // No need for AJAX as the form will handle the submission.
});
