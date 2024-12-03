document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;

    // Here you can add your logic to handle the form data (e.g., send to a server)
    // For demonstration, we'll just show a message
    document.getElementById('formResponse').innerText = `Thank you, ${name}! Your message has been received.`;
    
    // Clear the form
    this.reset();
});