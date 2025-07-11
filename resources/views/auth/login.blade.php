<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-x..."
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    {{-- recaptcha CDN --}}
    {{--    <script src="https://www.google.com/recaptcha/api.js"></script>--}}

    {{--   recaptcha V3 --}}
    {!! htmlScriptTagJsApi() !!}
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
<div class="w-full max-w-md p-8 space-y-6 bg-gray-800 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-center">Login</h2>
    @session('error')
    <div class="text-white bg-red-500 text-lg p-2 rounded-sm my-2">
        {{ session('error') }}
    </div>
    @endsession
    @session('success')
    <div class="text-white bg-green-500 text-lg p-2 rounded-sm my-2">
        {{ session('success') }}
    </div>
    @endsession
    <form action="{{ route('handle-login') }}" method="POST" id="login-form" class="space-y-4">
        @csrf
        <div>
            <label for="identifier" class="block mb-2 text-sm font-medium">Email / Phone</label>
            <input type="text" id="identifier" name="identifier" autofocus
                   class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('identifier')
            <span class="text-red-500 text-sm mt-1">{{$message}}</span>
            @enderror
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium">Password</label>
            <input type="password" id="password" name="password"
                   class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password')
            <span class="text-red-500 text-sm mt-1">{{$message}}</span>
            @enderror
        </div>
        <p class="mt-4 text-sm">Forgot your passsword?
            <a href="{{ route('show-forget-password-form') }}" class="text-blue-400 hover:underline">
                Reset now
            </a>
        </p>

        <div class="flex items-center mb-4">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember" class="block text-gray-300 ml-1">Remember Me</label>
            @error('remember')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- recaptcha --}}
        <div class="">
            {!! htmlFormSnippet() !!}
            @error('g-recaptcha-response')
            <span class="text-red-500 text-sm mt-1">{{$message}}</span>
            @enderror
        </div>


        <button type="submit"
                class="w-full py-3 mt-4 bg-blue-600 rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Login
        </button>

        {{--        for V3 --}}
        {{--        <button class="g-recaptcha w-full py-3 mt-4 bg-blue-600 rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"--}}
        {{--                data-sitekey="{{ config('services.recaptchav3.site_key') }}"--}}
        {{--                data-callback='onSubmit'--}}
        {{--                data-action='submit'>Submit--}}
        {{--        </button>--}}
        <p class="mt-4 text-sm">Login without password?
            <a href="{{ route('show-password-less-form') }}" class="text-blue-400 hover:underline">
                Login now
            </a>
        </p>
        <!-- Google Login Link -->

        <!-- Social Login Buttons Row -->
        <div class="flex justify-between mt-4">
            <!-- Google Login Button -->
            <a href="{{ route('social-auth.redirect','google') }}"
               class="flex items-center justify-center w-1/3 py-3 bg-red-500 rounded-lg font-semibold text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 mr-2">
                <i class="fa-brands fa-google fa-lg mr-3"></i>
                Google
            </a>

            <!-- GitHub Login Button -->
            <a href="{{ route('social-auth.redirect','github') }}"
               class="flex items-center justify-center w-1/3 py-3 bg-gray-600 rounded-lg font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 mx-2">
                <i class="fa-brands fa-github fa-lg mr-3"></i>
                GitHub
            </a>

            <!-- Facebook Login Button -->
            <a href="{{ route('social-auth.redirect','facebook') }}"
               class="flex items-center justify-center w-1/3 py-3 bg-blue-600 rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 ml-2">
                <i class="fab fa-facebook-f fa-lg mr-2"></i>
                Facebook
            </a>
        </div>


        <p class="mt-4 text-sm text-center">Don’t have an account? <a href="{{route("register")}}" class="text-blue-400 hover:underline">Register</a>
        </p>
    </form>
</div>


{{--recaptcha v3--}}
{{--<script>--}}
{{--    function onSubmit(token) {--}}
{{--        document.getElementById("login-form").submit();--}}
{{--    }--}}
{{--</script>--}}
</body>
</html>