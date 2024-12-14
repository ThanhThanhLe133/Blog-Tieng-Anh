// State variables
let data = {};
let error = {};
let isOpen = false;

gsap.fromTo(".prePopup", {
    x: 200, 
    opacity: 0 
}, {
    duration: 2, 
    x: 0,
    opacity: 1,  
    display: "block" 
});
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
    alert("Cảm ơn bạn đã để lại thông tin. Chúng tôi sẽ sớm liên lạc!")
    popUp();
}