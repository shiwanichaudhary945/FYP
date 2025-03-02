document.getElementById("khalti-payment-btn").addEventListener("click", function() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var checkinDate = document.getElementById("checkin_date").value;
    var occupants = document.getElementById("occupants").value;

    // Assuming the room price is dynamic, you can use a JavaScript variable for the price
    var price = {{ $room->price }}; // Room price from your Laravel backend

    var checkout = new KhaltiCheckout({
        token: function (token) {
            // Send the token to your backend to process the payment
            fetch("{{ route('payment.khalti') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({
                    token: token,
                    name: name,
                    email: email,
                    phone: phone,
                    checkin_date: checkinDate,
                    occupants: occupants,
                    price: price,
                    room_id: {{ $room->id }}
                })
            }).then(response => {
                return response.json();
            }).then(data => {
                if (data.success) {
                    alert('Booking successful!');
                    window.location.href = data.redirect_url;  // Redirect to a success page if necessary
                } else {
                    alert('Payment failed. Please try again.');
                }
            });
        },
        amount: price * 100  // Price in paisa
    });

    checkout.open();
});
