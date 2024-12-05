// State variables
let data = {};
let error = {};
let isOpen = false;

window.onload = function() {
    setTimeout(function() {
        const prePopup = document.querySelector('.prePopup');
        
        prePopup.style.display = 'block'; 
        setTimeout(function() {
            prePopup.style.opacity = 1;
        }, 10);
    }, 2000);
};

function closePrePopUp(){
    const popup = document.getElementById('prePopup');
    popup.style.display = 'none';
}

// Toggle popup visibility
function popUp() {
    isOpen = !isOpen;
    const popup = document.getElementById('popup');
    popup.style.display = isOpen ? 'block' : 'none';
}

// Update form data
function updateData(event) {
    const { name, value } = event.target;
    data[name] = value;
    error[name] = false;
}

// Handle form input blur event
function handleBlur(event) {
    const { name, value } = event.target;
    if (!value.trim()) {
        error[name] = true;
        document.getElementById(`${name}-error`).style.display = 'inline';
    } else {
        document.getElementById(`${name}-error`).style.display = 'none';
    }
}

// Handle form submission
function submitForm(event) {
    event.preventDefault();
    console.log(data);
    popUp();
}