<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">

    <h1 class="text-xl font-bold text-gray-700">
        Dashboard
    </h1>

    <div class="flex items-center gap-4">

        <span class="text-gray-600">
            {{ Auth::user()->name }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Logout
            </button>

        </form>

    </div>

</nav>