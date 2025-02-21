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

{{-- <script src="https://khalti.com/static/khalti-checkout.js"></script>
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

 --}}


 {{-- <button id="payment-button" class="btn btn-primary">Pay with Khalti</button>

 <script src="https://khalti.com/static/khalti-checkout.js"></script>
 <script>
     var config = {
         publicKey: "{{ env('bc709dd66c9a4c129d43cbeef11ba2ef') }}",
         productIdentity: "1234567890",
         productName: "Test Product",
         productUrl: "http://yourwebsite.com/product/123",
         paymentPreference: ["KHALTI"],
         eventHandler: {
             onSuccess(payload) {
                 fetch('/khalti/payment', {
                     method: "POST",
                     headers: {
                         "Content-Type": "application/json",
                         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                     },
                     body: JSON.stringify({
                         token: payload.token,
                         amount: payload.amount
                     })
                 })
                 .then(res => res.json())
                 .then(data => {
                     if (data.state.name === "Completed") {
                         alert("Payment Successful!");
                         window.location.href = "/success";
                     } else {
                         alert("Payment Failed!");
                     }
                 });
             },
             onError(error) {
                 console.log(error);
                 alert("Payment Error!");
             },
             onClose() {
                 console.log("Payment widget closed");
             }
         }
     };
 
     var checkout = new KhaltiCheckout(config);
     document.getElementById("payment-button").onclick = function () {
         checkout.show({ amount: 1000 }); // Amount in paisa (Rs. 10)
     };
 </script>
  --}}

  {{-- <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Room Payment</title>
      <script src="https://khalti.com/static/khalti-checkout.js"></script>
  </head>
  <body>
      <h2>Pay for Room: {{ $room->name }}</h2>
      <p>Price: Rs. {{ $room->price }}</p>
  
      <button id="payment-button">Pay with Khalti</button>
  
      <script>
          var config = {
              publicKey: "{{ env('KHALTI_PUBLIC_KEY') }}",
              productIdentity: "{{ $room->id }}",
              productName: "{{ $room->name }}",
              productUrl: "{{ url('/room/' . $room->id) }}",
              paymentPreference: ["KHALTI"],
              eventHandler: {
                  onSuccess(payload) {
                      fetch('/khalti/payment', {
                          method: "POST",
                          headers: {
                              "Content-Type": "application/json",
                              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                          },
                          body: JSON.stringify({
                              token: payload.token,
                              amount: payload.amount
                          })
                      })
                      .then(res => res.json())
                      .then(data => {
                          if (data.state.name === "Completed") {
                              alert("Payment Successful!");
                              window.location.href = "/success";
                          } else {
                              alert("Payment Failed!");
                          }
                      });
                  },
                  onError(error) {
                      console.log(error);
                      alert("Payment Error!");
                  },
                  onClose() {
                      console.log("Payment widget closed");
                  }
              }
          };
  
          var checkout = new KhaltiCheckout(config);
          document.getElementById("payment-button").onclick = function () {
              checkout.show({ amount: {{ $room->price * 100 }} }); // Convert to paisa
          };
      </script>
  </body>
  </html>
   --}}