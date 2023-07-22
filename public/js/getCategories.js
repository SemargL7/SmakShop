// Function to create a dropdown for a parent category and append its child categories
function createDropdown(category) {

    const dropdown = document.createElement('div');

    dropdown.id = 'category-' + category.id;
    dropdown.innerHTML = `<a href="/search?category=${category.id}">${category.name}</a>`;
    let parentBlock = document.getElementById('categoriesBlock');
    if(category.parent_id){
        parentBlock = document.getElementById('category-'+category.parent_id);
        dropdown.classList.add('category-child');
    }
    parentBlock.classList.add('category-drop');

    parentBlock.appendChild(dropdown);
}

// Make the GET request to fetch categories
fetch('/api/categories')
    .then(response => response.json())
    .then(categories => {
        // Create an object to hold child categories for each parent
        const childCategoriesByParentId = {};

        // Sort categories into their respective parents
        categories.forEach(category => {
            createDropdown(category);
        });

    })
    .catch(error => {
        console.error('Error fetching categories:', error);
    });
