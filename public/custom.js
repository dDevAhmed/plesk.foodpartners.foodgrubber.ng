// products page - add product modal
const measurementDropdown = document.querySelector('#measurementDropdown');

measurementDropdown.addEventListener('click', (event) => {
    if (event.target.tagName === 'A') { // Ensure clicking on an option
        const selectedValue = event.target.textContent;
        console.log('Selected value:', selectedValue);

        // Use the selected value as needed, e.g., display it or send it to a server
    }
});