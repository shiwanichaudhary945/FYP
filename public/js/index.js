document.addEventListener("DOMContentLoaded", () => {
    const menus = document.querySelector("nav ul");
    const header = document.querySelector("header");
    const menuBtn = document.querySelector(".menu-btn");
    const closeBtn = document.querySelector(".close-btn");

    menuBtn.addEventListener("click", () => {
        menus.classList.add("display");
    });

    closeBtn.addEventListener("click", () => {
        menus.classList.remove("display");
    });

    window.addEventListener("scroll",()=>{
        if(document.documentElement.scrollTop > 20){
            header.classList.add("sticky");
        }else{
            header.classList.remove("sticky");
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const userIcon = document.querySelector('#user-icon'); // The user icon (clickable)
    const dropdownMenu = document.querySelector('.dropdown-menu'); // The dropdown menu

    // Toggle the visibility of the dropdown when the user icon is clicked
    userIcon.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent the click from affecting other elements
        console.log('Dropdown clicked'); // Check if the click event is firing
        dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
    });

    // Close the dropdown if the user clicks anywhere outside the menu
    document.addEventListener('click', function(event) {
        if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
            console.log('Closing dropdown'); // Check if click outside is detected
            dropdownMenu.style.display = 'none'; // Hide dropdown if clicked outside
        }
    });
});

