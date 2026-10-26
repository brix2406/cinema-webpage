
document.getElementById("signup-form").addEventListener("submit", function(event) {

    // Get input values
    const email = document.getElementById("signup-email").value.trim();
    const password = document.getElementById("signup-password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

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
