<x-app-layout>

    <div class="filters flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6">
        {{-- category filter --}}
        <div class="w-full md:w-1/3">
            <select name="category" id="category" class="w-full border-none rounded-xl px-4 py-2">
                <option value="C1"> Category 1</option>
                <option value="C2"> Category 2</option>
                <option value="C3"> Category 3</option>
                <option value="C4"> Category 4</option>

            </select>
        </div>
        {{-- another filter --}}
        <div class="w-full md:w-1/3">
            <select name="other_filters" id="other_filters" class="w-full border-none rounded-xl px-4 py-2">
                <option value="F1"> Filter 1</option>
                <option value="F2"> Filter 2</option>
                <option value="F3"> Filter 3</option>
                <option value="F4"> Filter 4</option>

            </select>
        </div>

        {{-- search bar --}}
        <div class="w-full md:w-2/3 relative">

            <input type="search" placeholder="Find an Idea" class="rounded-xl bg-white px-4 py-2 pl-8 border-none placeholder-gray-900">

            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                  </svg>
            </div>
        </div>

    </div>
    {{-- end filter --}}

    <div class="ideas-container space-y-6 my-6">
        {{-- idea card --}}
        @foreach ( $ideas as $idea )

            <div class="idea container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">

                <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                    <div class="text-center">
                        <div class="font-semibold text-2xl">12</div>
                        <div class="text-sm text-gray-500">Votes</div>
                    </div>

                    <div class="mt-8">
                        <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">
                            Vote
                        </button>

                        {{-- <button class="w-20 bg-blue text-white border border-gray-200 hover:border-gray-400 font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">
                            Voted
                        </button> --}}
                    </div>

                </div>

                <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
                    <div class="flex-none mx-2 md:mx-4">
                        <a href="{{ route('idea.show',$idea) }}">
                            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                        </a>
                    </div>


                    <div class="flex flex-col justify-between w-full mx-2 md:mx-4">
                        <h4 class="text-xl font-semibold mt-2 md:mt-0">
                            <a href="" class="hover:underline"> {{ $idea->title }}</a>
                        </h4>

                        <div class="text-gray-600 mt-3 line-clamp-3">
                            {{ $idea->description }}
                        </div>

                        <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                            <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                                <div>{{ $idea->created_at->diffForHumans() }}</div>
                                <div>&bull;</div>
                                <div>Category 1</div>
                                <div>&bull;</div>
                                <div class="text-gray-900">5 Comments</div>

                            </div>

                            <div x-data="{isOpen: false}"
                            class="mt-4 md:mt-0 flex items-center space-x-2"
                            >
                            <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 px-4 py-2">
                                Open
                            </div>

                            <button @click="isOpen= !isOpen"
                            class="relative bg gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                                    <ul x-cloak
                                    x-transition.origin.top.left.duration.500ms
                                        x-show="isOpen"
                                        @keydown.escape.window="isOpen = false"
                                        @click.away="isOpen=false"
                                        class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0">
                                        <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Mark as Spam</a></li>
                                        <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete Post</a></li>
                                    </ul>
                                </button>
                            </div>

                            <div class="flex items-center mt-4 md:mt-0 md:hidden">
                                <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                                    <div class="text-sm font-bold leading-none">12</div>
                                    <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                                </div>
                                <button class="w-20 -mx-5 bg-gray-200 border border-gray-200 hover:border-gray-400 font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">
                                    Vote
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- end idea container --}}
        @endforeach
    </div>
    {{-- end ideas container --}}
    <div class="my-8">
        {{ $ideas->links() }}
    </div>

</x-app-layout>