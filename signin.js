document.getElementById('signupForm').addEventListener('submit', function(event) {

    event.preventDefault();



    const name = document.getElementById('name').value;

    const email = document.getElementById('email').value;

    const phone = document.getElementById('phone').value;

    const address = document.getElementById('address').value;



    // Here you can add code to send the data to a server



    document.getElementById('message').innerText = 'Sign up successful!';



    // Clear the form

    this.reset();

});