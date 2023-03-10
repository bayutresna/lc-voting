
<div>
    @auth
        <form wire:submit.prevent="createIdea" class="space-y-4 px-4 py-6" action="" method="POST">
            <div>
                <input wire:model.defer='title' type="text" class="text-sm border-none w-full bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 " placeholder="Your Idea" required>
                @error('title')
                <p class="text-red text-xs mt-1">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <select wire:model.defer='category' name="category_add" id="category_add" class="bg-gray-100 w-full border-none rounded-xl px-4 py-2 text-sm" required>
                @foreach ($categories as $category )
                <option value="{{ $category->id }}"> {{ $category->name }}</option>
                @endforeach
                @error('category')
                <p class="text-red text-xs mt-1">
                    {{ $message }}
                </p>
                @enderror
            </select>
            <div>
                <textarea wire:model.defer='description' name="idea" id="idea" cols="30" rows="4" class="w-full border-none bg-gray-100 rounded-xl placeholder-gray-900 text-sm px-4 py-2" placeholder="describe your idea" required></textarea>
                @error('description')
                <p class="text-red text-xs mt-1">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="flex items-center justify-between space-x-3">
                <button type="button" class="flex items-center justify-center w-1/2 h-11 text-xs font-semibold rounded-xl bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 space-x-3">

                    <svg  class="text-gray-500 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                    
                    <span class="ml-1">
                        Attach
                    </span>
                </button>

                <button type="submit" class="flex text-white items-center justify-center w-1/2 h-11 text-xs font-semibold rounded-xl bg-blue border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 space-x-3">
                    
                    <span class="ml-1">
                        Submit
                    </span>
                </button>
            </div>
        </form>
    @else
        <div class="my-6 text-center">
            <a wire:click.prevent="redirectToLogin" href="{{ route('login') }}" type="submit" class="inline-block text-white  justify-center w-1/2 h-11 text-xs font-semibold rounded-xl bg-blue border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 space-x-3">

                Login
            
            </a>

            <a wire:click.prevent="redirectToRegister" href="{{ route('register') }}" type="button" class="inline-block justify-center mt-4 w-1/2 h-11 text-xs font-semibold rounded-xl bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 space-x-3">

                Sign Up
            </a>
        </div>
    @endauth
</div>