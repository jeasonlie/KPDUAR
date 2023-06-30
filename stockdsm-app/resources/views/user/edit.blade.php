@extends('layout.layout')
@section('title', 'Edit User')
@section('content')

<div class="title">Edit User</div>
<br>
<div class="input">
    <form action="{{ route('user.update', ['id' => $user->id]) }}" method="post">
        @csrf
        @method('patch')
        <div class="namauser">
            <label for="">Nama user</label>
            <input type="text" name="name" value="{{$user->name}}">
        </div>
        <div class="email">
            <label for="">Email</label>
            <input type="email" name="email" value="{{$user->email}}">
        </div>
        <div class="password">
            <label for="">Password</label>
            <input type="password" name="password" required autocomplete="off">
        </div>
        <br>
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection