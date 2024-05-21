@extends('layouts.app')

@section('content')
    <div class="delete-account">
        <h1>Delete Account</h1>
        <p>Are you sure you want to delete your account?</p>
        <form action="{{ route('profile.delete') }}" method="post">
            @csrf
            <button type="submit">Delete</button>
        </form>
    </div>
@endsection
