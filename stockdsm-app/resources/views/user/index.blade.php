@extends('layout.layout')
@section('title', 'User')
@section('content')

<div class="title">User</div>
<br>
<div class="input">
    <form action="{{ route('user.store')}}" method="post" style="padding-bottom: 30px;">
        @csrf
        <table class="tabel-form">
            <tr>
                <td>
                <label for="">Nama User</label>
                </td>
                <td>
                <input type="text" name="name" required autocomplete="off">
                </td>
            </tr>
            <tr>
                <td>
                <label for="">Email</label>
                </td>
                <td>
                <input type="email" name="email" required autocomplete="off">
                </td>
            </tr>
            <tr>
                <td>
                <label for="">Password</label>
                </td>
                <td>
                <input type="password" name="password" required autocomplete="off">
                </td>
            </tr>
        </table>
        <br>
        <button type="submit">Tambah</button>
    </form>
</div>
<table id="isiTabel">
    <thead>
        <tr>
            <th>No</th>
            <th>ID User</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user as $value)
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->id_user}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->email}}</td>
            <td><a href="{{route('user.edit', ['id' => $value->id])}}">
                <div class="edit">
                    Edit
                </div>
            </a></td>
            <td>
                <div class="hapus" onclick="modal_delete('user',{{$value->id}}, '{{route('user.destroy', ['id'=> $value->id])}}')" style="cursor:pointer">
                    Hapus
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection