<x-app-layout>

    <div class="max-w-5xl mx-auto py-10">

        <h1 class="text-3xl font-bold mb-6">Users</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @foreach ($users as $user)
                <div class="bg-white shadow rounded-xl p-5">

                    <div class="flex items-center gap-4">

                        <img src="{{ asset('storage/' . $user->profile_picture) }}" class="w-20 h-20 rounded-full object-cover">

                        <div>
                            <h2 class="text-xl font-bold">
                                {{ $user->name }}
                            </h2>

                            <p class="text-gray-500">
                                {{ $user->email }}
                            </p>
                        </div>

                    </div>

                    <p class="mt-4 text-gray-700">
                        {{ $user->bio }}
                    </p>

                    <form action="{{ url('/add-friend/' . $user->id) }}" method="POST">
                        @csrf

                        <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                            Add Friend
                        </button>
                    </form>

                </div>
            @endforeach

        </div>

    </div>



</x-app-layout>
