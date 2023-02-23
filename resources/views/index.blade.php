<x-app-layout>

    <div class="filters flex space-x-6">
        <div class="w-1/3">
            <select name="category" id="category" class="w-full border-none rounded-xl px-4 py-2">
                <option value="C1"> Category 1</option>
                <option value="C2"> Category 2</option>
                <option value="C3"> Category 3</option>
                <option value="C4"> Category 4</option>

            </select>
        </div>

        <div class="w-1/3">
            <select name="other_filters" id="other_filters" class="w-full border-none rounded-xl px-4 py-2">
                <option value="F1"> Filter 1</option>
                <option value="F2"> Filter 2</option>
                <option value="F3"> Filter 3</option>
                <option value="F4"> Filter 4</option>

            </select>
        </div>

        {{-- search bar --}}
        <div class="w-2/3 relative">

            <input type="search" placeholder="Find an Idea" class="rounded-xl bg-white px-4 py-2 pl-8 border-none placeholder-gray-900">

            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                  </svg>
            </div>
        </div>

    </div>
    {{-- end filter --}}


</x-app-layout>