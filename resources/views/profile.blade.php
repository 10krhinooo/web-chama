@extends('layouts.app')

@section('content')
<div class="profile-details">
    <h2>Your Profile</h2>
    <p><strong>Name:</strong> {{ $user->Name }}</p>
    <p><strong>ID Number:</strong> {{ $user->id_number }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Profile Photo:</strong></p>
    @if($user->image_path)
        <img src="{{ asset('storage/' . $user->image_path) }}" alt="Profile Photo" width="150" class="profile-photo">
    @else
        <p>No profile photo uploaded.</p>
    @endif
</div>

<div class="profile-actions">
    <h2>Edit Profile</h2>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profile-form">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $user->Name }}" required>

        <label for="id_number">ID Number:</label>
        <input type="text" id="id_number" name="id_number" value="{{ $user->id_number }}" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>

        <label for="profile_photo">Profile Photo:</label>
        <input type="file" id="profile_photo" name="profile_photo">

        <button type="submit">Update Profile</button>
    </form><br><br>

    <div class="profile-details">
    <h2>Change Password</h2>
    <form action="{{ route('forgot.password.form') }}" method="POST">
        @csrf

        <label for="current_password">Current Password:</label><br><br>
        <input type="password" id="current_password" name="current_password" required><br><br>

        <label for="new_password">New Password:</label><br><br>
        <input type="password" id="new_password" name="new_password" required><br>

        <label for="new_password_confirmation">Confirm New Password:</label><br><br>
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required><br><br>

        <button type="submit">Change Password</button><br><br>
    </form>
    </div>

    <h2>Delete Account</h2>
    <form action="{{ route('profile.destroy') }}" method="POST">
        @csrf
        <button type="submit">Delete Account</button>
    </form>


    <h2>Logout</h2>
    <form action="{{ route('logout.confirm') }}" method="GET">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <h2>LockScreen</h2>
    <form action="{{ route('lock-screen') }}" method="GET">
        @csrf
        <button type="submit">LockScreen</button>
    </form>


    {{-- <h2>ChamaPages</h2>
    <form action="{{ route('chama') }}" method="GET">
        @csrf
        <button type="submit">ChamaPages</button>
    </form> --}}

</div>
</script>

<style>
    .profile-photo {
        border-radius: 50%;
    }

    #cropper-container {
    margin-top: 10px;
}
    </style>
@endsection


@section('scripts')
<script src="{{ asset('js/cropper.min.js') }}"></script>
<script src="{{ asset('js/compressor.min.js') }}"></script>
<script>
document.getElementById('profile_photo').addEventListener('change', function(event) {
    const cropperContainer = document.getElementById('cropper-container');
    const cropperImage = document.getElementById('cropper-image');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        cropperImage.src = e.target.result;
        cropperContainer.style.display = 'block';

        const cropper = new Cropper(cropperImage, {
            aspectRatio: 1,
            viewMode: 3
        });

        document.getElementById('crop-button').addEventListener('click', function() {
            const canvas = cropper.getCroppedCanvas();
            canvas.toBlob((blob) => {
                new Compressor(blob, {
                    quality: 0.8,
                    success(compressedBlob) {
                        const formData = new FormData();
                        formData.append('profile_photo', compressedBlob, file.name);
                        // Update the form with the compressed blob
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'profile_photo';
                        input.value = URL.createObjectURL(compressedBlob);
                        document.getElementById('profile-form').appendChild(input);
                    },
                });
            });
        });
    };

    reader.readAsDataURL(file);
});
</script>

<style>
    .profile-photo {
        border-radius: 50%; /* Makes the image round */
        width: 120px; /* Adjust the size as needed */
        height: 120px; /* Ensures the image stays square and round */
        object-fit: cover; /* Ensures the image covers the box without distortion */
        border: 2px solid #ddd; /* Optional: Adds a subtle border around the image */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Adds a slight shadow for better visibility */
    }

    .cropper-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .cropper-image {
        max-width: 100%; /* Ensures the image fits within the container */
    }

    .crop-button {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .crop-button:hover {
        background-color: #0056b3;
    }
</style>

@endsection
