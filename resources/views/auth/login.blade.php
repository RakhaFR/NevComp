@extends('layouts.auth')
@section('title', 'Masuk')
@section('action', route('login.store'))
@section('heading', 'LOGIN AKUN')
@section('submit', 'Login')
@section('switch')Belum punya akun? <a href="{{ route('register') }}" class="text-link underline">Register</a>@endsection
@section('fields')
  <x-field upper label="Masukkan Email" name="email" type="email" placeholder="contoh@gmail.com" :value="old('email')" required autofocus />
  <x-field upper label="Masukkan Password" name="password" type="password" placeholder="Password123" required />
@endsection
