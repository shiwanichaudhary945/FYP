{{-- <button id="payment-button">Pay with Khalti</button>

<script src="https://khalti.com/static/khalti-checkout.js"></script>
<script>
    var config = {
        "publicKey": "{{ env('KHALTI_PUBLIC_KEY') }}",
        "productIdentity": "1234567890",
        "productName": "Room Booking",
        // "productUrl": "http://your-website.com/room/123",
        "productUrl": "{{ url('/rooms/' . $room->id) }}",
        "paymentPreference": ["KHALTI"],
        "eventHandler": {
            onSuccess(payload) {
                fetch("{{ route('khalti.verify') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        token: payload.token,
                        amount: payload.amount
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Payment Successful!");
                        window.location.href = "/thank-you";
                    } else {
                        alert("Payment Failed!");
                    }
                });
            },
            onError(error) {
                console.log(error);
                alert("Something went wrong!");
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    document.getElementById("payment-button").onclick = function () {
        checkout.show({ amount: 1000 * 100 });
    };
</script>
 --}}

<script src="https://khalti.com/static/khalti-checkout.js"></script>
<script>
    document.getElementById("payment_method").addEventListener("change", function() {
        let paymentMethod = this.value;
        if (paymentMethod === "khalti") {
            document.getElementById("khalti-payment-btn").style.display = "block";
            document.getElementById("submit-booking-btn").style.display = "none";
        } else {
            document.getElementById("khalti-payment-btn").style.display = "none";
            document.getElementById("submit-booking-btn").style.display = "block";
        }
    });

    var config = {
        publicKey: "test_public_key_XXXXXX", // Replace with your actual Khalti public key
        productIdentity: document.getElementById("room_id").value,
        productName: "Room Booking",
        productUrl: `http://127.0.0.1:8000/rooms/${document.getElementById("room_id").value}`,
        amount: 1000 * 100, // Amount in paisa (e.g., 1000 = Rs. 10)
        eventHandler: {
            onSuccess(payload) {
                fetch("{{ route('khalti.verify') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        token: payload.token,
                        amount: payload.amount,
                        room_id: document.getElementById("room_id").value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Payment successful! Booking confirmed.");
                        window.location.reload();
                    } else {
                        alert("Payment verification failed.");
                    }
                })
                .catch(error => console.error("Error:", error));
            },
            onError(error) {
                alert("Payment failed!");
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    document.getElementById("khalti-payment-btn").addEventListener("click", function() {
        checkout.show({ amount: 1000 * 100 });
    });
</script>


