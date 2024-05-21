@extends('layouts.app')

@section('content')
<div class="logout-confirm-container">
    <h2>Confirm Logout</h2>
    <p>Are you sure you want to log out?</p>
    <div class="logout-confirm-buttons">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Yes</button>
        </form>
        <a href="{{ route('profile') }}"><button>No</button></a>
    </div>
</div>
@endsection
