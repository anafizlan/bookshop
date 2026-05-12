@extends('layouts.app')

@section('content')

<h2>Edit User</h2>

<form method="POST" action="/update/{{ $user->id }}">
    @csrf

    <input type="text" name="name" value="{{ $user->name }}"><br><br>
    <input type="email" name="email" value="{{ $user->email }}"><br><br>

    <input type="password" name="password" placeholder="New Password (optional)"><br><br>

    <button type="submit">Update</button>
</form>

@endsection