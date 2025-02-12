@extends("layouts.app")

@section("content")
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #6c757d; color: #fff;">
                    <h3 class="mb-0">Edit Room</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('frontend.rooms.update', $rooms->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="room_type" class="form-label">Room Type</label>
                            <select class="form-control" id="room_type" name="room_type" required>
                                <option value="">Select room type</option>
                                <option value="Single Room" {{ $rooms->room_type === 'Single Room' ? 'selected' : '' }}>Single Room</option>
                                <option value="Double Room" {{ $rooms->room_type === 'Double Room' ? 'selected' : '' }}>Double Room</option>
                                <option value="Duplex Room" {{ $rooms->room_type === 'Duplex Room' ? 'selected' : '' }}>Duplex Room</option>
                                <option value="Furnished Room" {{ $rooms->room_type === 'Furnished Room' ? 'selected' : '' }}>Furnished Room</option>
                                <option value="Luxury Room" {{ $rooms->room_type === 'Luxury Room' ? 'selected' : '' }}>Luxury Room</option>
                                <option value="Shared Room" {{ $rooms->room_type === 'Shared Room' ? 'selected' : '' }}>Shared Room</option>
                            </select>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required value="{{ $rooms->location }}">
                        </div> --}}

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <select class="form-control" id="location" name="location" required>
                                <option value="">Select location</option>
                                <option value="Kathmandu" {{ $rooms->location === 'Kathmandu' ? 'selected' : '' }}>Kathmandu</option>
                                <option value="Bhaktapur" {{ $rooms->location === 'Bhaktapur' ? 'selected' : '' }}>Bhaktapur</option>
                                <option value="Lalitpur" {{ $rooms->location === 'Lalitpur' ? 'selected' : '' }}>Lalitpur</option>
                                <option value="Chitwan" {{ $rooms->location === 'Chitwan' ? 'selected' : '' }}>Chitwan</option>
                                <option value="Pokhara" {{ $rooms->location === 'Pokhara' ? 'selected' : '' }}>Pokhara</option>
                                <option value="Biratnagar" {{ $rooms->location === 'Biratnagar' ? 'selected' : '' }}>Biratnagar</option>
                                <option value="Itahari" {{ $rooms->location === 'Itahari' ? 'selected' : '' }}>Itahari</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Amenities</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="checkbox" name="amenities[]" value="WiFi" @if(in_array('WiFi', json_decode($rooms->amenities, true) ?? [])) checked @endif> WiFi <br>
                                    <input type="checkbox" name="amenities[]" value="Parking" @if(in_array('Parking', json_decode($rooms->amenities, true) ?? [])) checked @endif> Parking <br>
                                    <input type="checkbox" name="amenities[]" value="Air Conditioning" @if(in_array('Air Conditioning', json_decode($rooms->amenities, true) ?? [])) checked @endif> Air Conditioning <br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="amenities[]" value="TV" @if(in_array('TV', json_decode($rooms->amenities, true) ?? [])) checked @endif> TV <br>
                                    <input type="checkbox" name="amenities[]" value="Heating" @if(in_array('Heating', json_decode($rooms->amenities, true) ?? [])) checked @endif> Heating <br>
                                    <input type="checkbox" name="amenities[]" value="Swimming Pool" @if(in_array('Swimming Pool', json_decode($rooms->amenities, true) ?? [])) checked @endif> Swimming Pool <br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="amenities[]" value="Kitchen" @if(in_array('Kitchen', json_decode($rooms->amenities, true) ?? [])) checked @endif> Kitchen <br>
                                    <input type="checkbox" name="amenities[]" value="Gym" @if(in_array('Gym', json_decode($rooms->amenities, true) ?? [])) checked @endif> Gym <br>
                                    <input type="checkbox" name="amenities[]" value="Pet Friendly" @if(in_array('Pet Friendly', json_decode($rooms->amenities, true) ?? [])) checked @endif> Pet Friendly <br>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="bedrooms" class="form-label">Bedrooms</label>
                            <input type="number" class="form-control" id="bedrooms" name="bedrooms" placeholder="Enter number of bedrooms" value="{{ old('bedrooms', $rooms->bedrooms) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="bathrooms" class="form-label">Bathrooms</label>
                            <input type="number" class="form-control" id="bathrooms" name="bathrooms" placeholder="Enter number of bathrooms" value="{{ old('bathrooms', $rooms->bathrooms) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="parking" class="form-label">Parking</label>
                            <select class="form-control" id="parking" name="parking" required>
                                <option value="">Select an option</option>
                                <option value="Yes" {{ old('parking', $rooms->parking) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('parking', $rooms->parking) == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="furnished" class="form-label">Furnished</label>
                            <select class="form-control" id="furnished" name="furnished" required>
                                <option value="">Select an option</option>
                                <option value="Yes" {{ old('furnished', $rooms->furnished) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('furnished', $rooms->furnished) == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="area" class="form-label">Room Size (sqft)</label>
                            <input type="number" class="form-control" id="area" name="area" placeholder="Enter room size in sqft" value="{{ old('area', $rooms->area) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required value="{{ $rooms->price }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Enter description" rows="3" required>{{ $rooms->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="roomImage" class="form-label">Room Image</label>
                            @if($rooms->image)
                            <div>
                                <img src="{{ asset($rooms->image) }}?{{ time() }}" alt="Room Image" class="img-thumbnail" width="150">
                            </div>
                        @endif


                            <input type="file" class="form-control" id="roomImage" name="roomImage">
                            <small class="text-muted">Upload a new image to replace the current one.</small>
                        </div>


                        <div class="mb-3">
                            <label for="additional_images" class="form-label">Additional Images</label>

                            <!-- Display existing images -->
                            @foreach ($rooms->images as $image)
                                <div class="mb-2">
                                    <img src="{{ asset($image->image_path) }}" alt="Additional Image" class="img-thumbnail" width="150">
                                    <a href="{{ route('frontend.rooms.removeImage', ['roomId' => $rooms->id, 'imageId' => $image->id]) }}" class="btn btn-danger btn-sm">Remove</a>
                                </div>
                            @endforeach

                            <!-- Upload new images -->
                            <input type="file" class="form-control" name="additional_images[]" id="additional_images" multiple>
                            <small class="text-muted">You can upload multiple images (jpg, png, jpeg).</small>
                        </div>


                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-secondary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
