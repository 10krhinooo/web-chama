@extends('layouts.app')

@section('content')
<h1>Join Chama</h1>
<form action="{{ route('chamas.join') }}" method="POST">
    @csrf
    <input type="text" name="special_code" placeholder="Special Code" required>
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <button type="submit">Join</button>
</form>
@endsection
