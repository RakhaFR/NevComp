@extends('layouts.auth')
@section('title', 'Registrasi')
@section('action', route('register.store'))
@section('heading', 'DAFTAR AKUN')
@section('submit', 'Registrasi')
@section('switch')Sudah punya akun? <a href="{{ route('login') }}" class="text-link underline">Login</a>@endsection
@section('fields')
  <x-field upper label="Masukkan Email" name="email" type="email" placeholder="contoh@gmail.com" :value="old('email')" required autofocus />
  <x-field upper label="Masukkan Password" name="password" type="password" placeholder="Password123" required />
  <x-field upper label="Konfirmasi Password" name="password_confirmation" type="password" placeholder="Password123" required />
@endsection
