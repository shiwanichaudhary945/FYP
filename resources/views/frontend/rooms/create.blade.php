@extends("layouts.app")

@section("content")
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #6c757d; color: #fff;">
                    <h3 class="mb-0">Add New Room</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('frontend.rooms.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="room_type" class="form-label">Room Type</label>
                            <select class="form-control" id="room_type" name="room_type" required>
                                <option value="">Select room type</option>
                                <option value="Single Room">Single Room</option>
                                <option value="Double Room">Double Room</option>
                                <option value="Shared Room">Shared Room</option>
                                <option value="Furnished Room">Furnished Room</option>
                                <option value="Duplex Room">Duplex Room</option>
                                <option value="Luxury Room">Luxury Room</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <select class="form-control" id="location" name="location" required>
                                <option value="">Select Location</option>
                                <option value="Kathmandu">Kathmandu</option>
                                <option value="Lalitpur">Lalitpur</option>
                                <option value="Bhaktapur">Bhaktapur</option>
                                <option value="Pokhara">Pokhara</option>
                                <option value="Chitwan">Chitwan</option>
                                <option value="Biratnagar">Biratnagar</option>
                                <option value="Itahari">Itahari</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Auto-filled latitude" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Auto-filled longitude" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="bedrooms" class="form-label">Bedrooms</label>
                            <input type="number" class="form-control" id="bedrooms" name="bedrooms" placeholder="Enter number of bedrooms" required>
                        </div>

                        <div class="mb-3">
                            <label for="bathrooms" class="form-label">Bathrooms</label>
                            <input type="number" class="form-control" id="bathrooms" name="bathrooms" placeholder="Enter number of bathrooms" required>
                        </div>

                        <div class="mb-3">
                            <label for="parking" class="form-label">Parking</label>
                            <select class="form-control" id="parking" name="parking" required>
                                <option value="">Select an option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="furnished" class="form-label">Furnished</label>
                            <select class="form-control" id="furnished" name="furnished" required>
                                <option value="">Select an option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="area" class="form-label">Room Size (sqft)</label>
                            <input type="number" class="form-control" id="area" name="area" placeholder="Enter room size in sqft" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Enter description" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Amenities</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="checkbox" name="amenities[]" value="WiFi"> WiFi <br>
                                    <input type="checkbox" name="amenities[]" value="Parking"> Parking <br>
                                    <input type="checkbox" name="amenities[]" value="Air Conditioning"> Air Conditioning <br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="amenities[]" value="TV"> TV <br>
                                    <input type="checkbox" name="amenities[]" value="Heating"> Heating <br>
                                    <input type="checkbox" name="amenities[]" value="Swimming Pool"> Swimming Pool <br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="amenities[]" value="Kitchen"> Kitchen <br>
                                    <input type="checkbox" name="amenities[]" value="Gym"> Gym <br>
                                    <input type="checkbox" name="amenities[]" value="Pet Friendly"> Pet Friendly <br>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="roomImage" class="form-label">Room Image</label>
                            <input type="file" class="form-control" id="roomImage" name="roomImage" required>
                        </div>

                        <div class="mb-3">
                            <label for="additional_images" class="form-label">Additional Images</label>
                            <input type="file" class="form-control" name="additional_images[]" id="additional_images" multiple>
                            <small class="text-muted">You can upload multiple images (jpg, png, jpeg).</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('location').addEventListener('change', function () {
        var location = this.value;
        var apiKey = '67cb5ecf47ca47a494e7acd40dfc0e82';  // Your OpenCage API Key
        var url = `https://api.opencagedata.com/geocode/v1/json?q=${location}&key=${apiKey}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.results.length > 0) {
                    var lat = data.results[0].geometry.lat;
                    var lng = data.results[0].geometry.lng;

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                } else {
                    alert("Location not found. Please try again.");
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>
@endsection
