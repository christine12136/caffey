const cart = {};
const taxRate = 0.01; //

function addToCart(productName, price, quantity) {
    quantity = parseInt(quantity); // Convert quantity to integer
    if (cart[productName]) {
        cart[productName].quantity += quantity;
    } else {
        cart[productName] = { price: price, quantity: quantity };
    }
    updateCartDisplay();
}

function updateCartDisplay() {
    const cartDiv = document.getElementById('cart');
    cartDiv.innerHTML = ''; // Clear previous cart contents

    if (isCartEmpty()) {
        cartDiv.innerHTML = '<p>Your cart is empty.</p>';
    } else {
        const cartTable = createCartTable();
        cartDiv.appendChild(cartTable);
        
        const subtotal = calculateSubtotal();
        const totalWithTax = calculateTotal();
        
        cartDiv.innerHTML += `<p><strong>Subtotal: ${subtotal.toFixed(2)}</strong></p>`;
        cartDiv.innerHTML += `<p><strong>Total (including tax): ${totalWithTax.toFixed(2)}</strong></p>`;
    }
}

function isCartEmpty() {
    return Object.keys(cart).length === 0;
}

function createCartTable() {
    const table = document.createElement('table');
    table.className = 'cart-table';
    
    // Create table header
    const thead = document.createElement('thead');
    thead.innerHTML = `
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>`;
    table.appendChild(thead);
    
    // Create table body
    const tbody = document.createElement('tbody');
    for (const product in cart) {
        const item = cart[product];
        const itemTotal = item.price * item.quantity;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${product}</td>
            <td>${item.price.toFixed(2)}</td>
            <td>${item.quantity}</td>
            <td>${itemTotal.toFixed(2)}</td>`;
        
        tbody.appendChild(row);
    }
    table.appendChild(tbody);
    
    return table;
}

function calculateSubtotal() {
    let subtotal = 0;
    for (const product in cart) {
        subtotal += cart[product].price * cart[product].quantity;
    }
    return subtotal;
}

function calculateTotal() {
    const subtotal = calculateSubtotal();
    const tax = subtotal * taxRate;
    return subtotal + tax;
}

function checkout() {
    const receiptDiv = document.getElementById('receipt');
    const receiptDetails = document.getElementById('receipt-details');
    receiptDetails.innerHTML = '';

    if (isCartEmpty()) {
        receiptDetails.innerHTML = '<p>No items in the cart to checkout.</p>';
    } else {
        const subtotal = calculateSubtotal();
        const tax = subtotal * taxRate;
        const totalWithTax = subtotal + tax;
        // Get current date and time
        const now = new Date();
        const formattedDate = now.toLocaleString(); // Format date and time
        const receiptNumber = Math.floor(Math.random() * 100000); // Generate a random receipt number
        const receiptNumberOrder = Math.floor(Math.random() * 1000); // Generate a random order number

        receiptDetails.innerHTML += `${formattedDate}`;
        receiptDetails.innerHTML += `<p>Receipt #: ${receiptNumber}</p>`;
        receiptDetails.innerHTML += `<p>Order #: <strong>${receiptNumberOrder}</strong></p>`;
        receiptDetails.innerHTML += `<p>-------------------------------------------------------------------------------------------------------------------</p>`

        for (const product in cart) {
            const item = cart[product];
            const itemTotal = item.price * item.quantity;

            receiptDetails.innerHTML += `
                <div class="receipt-item">
                    <span>${product}</span>
                    <span>${item.price.toFixed(2)} x ${item.quantity} = ${itemTotal.toFixed(2)}</span>
                </div>`;
        }
        receiptDetails.innerHTML += `<p>--------------------------------------------------------------------------------------------------------------------</p>`;
        receiptDetails.innerHTML += `<p>Subtotal: ${subtotal.toFixed(2)}</p>`;
        receiptDetails.innerHTML += `<p>Tax: ${tax.toFixed(2)}</p>`;
        receiptDetails.innerHTML += `<p><strong>Total: ${totalWithTax.toFixed(2)}</strong></p>`;
        receiptDetails.innerHTML += `<p>------------------------------------------------------------------------------------------------------------------</p>`;
    }

    receiptDiv.style.display = 'block';
}

function clearCart() {
    for (const product in cart) {
        delete cart[product];
    }
    updateCartDisplay();
    document.getElementById('receipt').style.display = 'none';
    document.querySelector('.cart').style.display = 'block';
}
