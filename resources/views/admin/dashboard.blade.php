@extends('layouts.admin-app')

@section('content')
    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold">
        <h1 class="text-xl">Welcome Admin!</h1>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="font-raleway font-bold w-full bg-gray-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mt-2 logout-button-u"
                onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}
        </button>
    </form>
@endsection