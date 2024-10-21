@extends('admin.layouts.auth')
@section("title")
{{__("messages.login")}}
@endsection
@section("css")
<style>
  input::placeholder{
    color: white !important;
  }
  </style>
@endsection
@section('content')
<form class="max-w-xl m-4 p-10 bg-[#ffffff33] rounded shadow-xl" action="{{route("dashboard.login-post")}}" method="POST">
    @csrf
    <p class="text-gray-800 font-medium text-center text-lg font-bold">Login</p>
    <div class="">
      <label class="block text-sm text-gray-00" for="email">Email</label>
      <input type="email"  id="email"
                                value="{{old("email")}}"
                                name="email" class="w-full px-5 py-1 text-white bg-[#00000099] rounded" required="" placeholder="Email" aria-label="email">
    </div>
    <div class="mt-2">
      <label class="block text-sm text-gray-600" for="password">Password</label>
      <input type="password" name="password" class="w-full px-5  py-1 text-white bg-[#00000099] rounded" id="password" required="" placeholder="*******" aria-label="password">
    </div>
    <div class="mt-4 text-center items-center justify-between">
      <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Login</button>
    </div>
    <div class="mt-2 flex items-center justify-between">
      <a class="inline-block right-0 align-baseline  font-bold text-sm text-[#2f5ac8] hover:text-blue-800" href="#">
        Forgot Password?
      </a>
      <a class="inline-block right-0 align-baseline font-bold text-sm text-[#2f5ac8] hover:text-blue-800" href="#">
        Not registered ?
      </a>
    </div>
  </form>
@endsection
