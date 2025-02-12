// document.addEventListener("DOMContentLoaded", function () {
//     const wishlistButtons = document.querySelectorAll(".wishlist-btn");

//     wishlistButtons.forEach(button => {
//         button.addEventListener("click", function () {
//             const roomId = this.getAttribute("data-room-id");

//             fetch('/wishlist/add', {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/json",
//                     "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
//                 },
//                 body: JSON.stringify({ room_id: roomId })
//             })
//             .then(response => response.json())
//             .then(data => alert(data.message))
//             .catch(error => console.error("Error:", error));
//         });
//     });
// });
