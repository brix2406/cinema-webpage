
document.getElementById("signup-form").addEventListener("submit", function(event) {

    // Get input values
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("signup-email").value.trim();
    const password = document.getElementById("signup-password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    //Validate name
    if(!/^[A-Za-z]+(?: [A-Za-z]+)+$/.test(name)) {
        alert("First and lastname must contain alphabetic characters and spaces only.");
        event.preventDefault();
        return;
    }
    // Validate email
    if (!/^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,3}$/.test(email)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return;
    }

    // Validate password length
    if (password.length < 8) {
        alert("Password must contain at least 8 characters.");
        event.preventDefault();
        return;
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        alert("Passwords do not match. Please try again.");
        event.preventDefault();
        return;
    }


});
