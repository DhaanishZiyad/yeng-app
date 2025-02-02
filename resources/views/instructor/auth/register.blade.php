<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700&0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen flex flex-col justify-center items-center bg-gray-100">
    <div class="flex flex-row w-screen justify-center items-center mt-72">
        <img src="/images/yeng_logo.svg" alt="">
    </div>
    <div class="flex flex-row w-screen justify-center items-center mt-4">
        <img src="/images/yeng_text.svg" alt="">
    </div>

    <div class="flex flex-row w-screen justify-center items-center mt-4">
        <form method="POST" action="{{ route('instructor.register') }}" class="flex flex-col gap-4 my-8 w-80">
            @csrf

            <!-- Name -->
            <div>
                <x-text-input id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Name') }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Date of Birth -->
            <div class="mt-1">
                <x-text-input 
                    id="dob" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" 
                    type="date" 
                    name="dob" 
                    :value="old('dob')" 
                    max="{{ date('Y-m-d') }}" 
                    required 
                />
                <x-input-error :messages="$errors->get('dob')" class="mt-2" />
            </div>

            <!-- Gender -->
            <div class="mt-1">
                <select id="gender" name="gender" required class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black">
                    <option value="" disabled selected>{{ __('Gender') }}</option>
                    <option value="male">{{ __('Male') }}</option>
                    <option value="female">{{ __('Female') }}</option>
                    <option value="other">{{ __('Other') }}</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="mt-1">
                <x-text-input id="address" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" type="text" name="address" :value="old('address')" required autocomplete="address" placeholder="{{ __('Address') }}" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- City -->
            <div class="mt-1">
                <select id="city" name="city" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" required>
                    <option value="" disabled selected>{{ __('City') }}</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Mount Lavinia">Mount Lavinia</option>
                    <option value="Kesbewa">Kesbewa</option>
                    <option value="Maharagama">Maharagama</option>
                    <option value="Moratuwa">Moratuwa</option>
                    <option value="Ratnapura">Ratnapura</option>
                    <option value="Negombo">Negombo</option>
                    <option value="Kandy">Kandy</option>
                    <option value="Sri Jayewardenepura Kotte">Sri Jayewardenepura Kotte</option>
                    <option value="Kalmunai">Kalmunai</option>
                    <option value="Trincomalee">Trincomalee</option>
                    <option value="Galle">Galle</option>
                    <option value="Jaffna">Jaffna</option>
                    <option value="Athurugiriya">Athurugiriya</option>
                    <option value="Weligama">Weligama</option>
                    <option value="Matara">Matara</option>
                    <option value="Kolonnawa">Kolonnawa</option>
                    <option value="Gampaha">Gampaha</option>
                    <option value="Puttalam">Puttalam</option>
                    <option value="Badulla">Badulla</option>
                    <option value="Kalutara">Kalutara</option>
                    <option value="Bentota">Bentota</option>
                    <option value="Mannar">Mannar</option>
                    <option value="Kurunegala">Kurunegala</option>
                </select>
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-1">
                <x-text-input id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="{{ __('Email') }}" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-1">
                <x-text-input id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-1">
                <x-text-input id="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Availability -->
            <div>
                <label for="availability" class="block font-medium text-sm text-gray-700">Availability</label>
                <div id="availability-wrapper" class="mt-2">
                    <div class="availability-item flex gap-2 mb-2">
                        <select name="availability[0][day_of_week]" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" required>
                            <option value="" disabled selected>Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                        <input type="time" name="availability[0][start_time]" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" required />
                        <input type="time" name="availability[0][end_time]" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" required />
                    </div>
                </div>
                <button type="button" id="add-availability" class="flex justify-center items-center mt-4 px-4 py-2 w-full bg-yeng-pink-300 text-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yeng-pink-400 focus:ring-offset-2">
                    <img src="/images/Plus.svg" alt="" class="h-6 w-6">
                </button>
            </div>

            <div class="flex items-center justify-end mt-1">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <button type="submit" class="font-raleway font-bold w-full bg-yeng-pink-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mt-2">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-availability').addEventListener('click', function () {
            const wrapper = document.getElementById('availability-wrapper');
            const index = wrapper.children.length;
            const item = document.createElement('div');
            item.classList.add('availability-item', 'flex', 'gap-2', 'mb-2');
            item.innerHTML = `
                <select name="availability[${index}][day_of_week]" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" required>
                    <option value="" disabled selected>Day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
                <input type="time" name="availability[${index}][start_time]" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" required />
                <input type="time" name="availability[${index}][end_time]" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" required />
            `;
            wrapper.appendChild(item);
        });
    </script>
</body>
</html>