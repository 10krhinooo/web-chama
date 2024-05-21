@extends('layouts.app')

@section('content')
    <div class="edit-profile">
        <h1>Edit Profile</h1>
        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            <label for="id_number">ID Number:</label>
            <input type="text" id="id_number" name="id_number" value="{{ $user->id_number }}" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password">
            <label for="password_confirmation">Confirm New Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
