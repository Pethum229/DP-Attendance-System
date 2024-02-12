// Menu Toggle
let toggle = document.querySelector('.toggle');
let navigation = document.querySelector('.navigation');
let main = document.querySelector('.main');

toggle.onclick = function() {
    navigation.classList.toggle('active');
    main.classList.toggle('active');
}

// Function to handle setting active link
function setActiveLink() {
    // Remove 'hovered' class from all list items
    document.querySelectorAll('.navigation li').forEach(item => {
        item.classList.remove('hovered');
    });
    
    // Add 'hovered' class to the clicked list item
    this.classList.add('hovered');
}

// Add event listener to each list item
document.querySelectorAll('.navigation li').forEach(item => {
    item.addEventListener('click', setActiveLink);
});
