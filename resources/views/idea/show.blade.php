<x-app-layout>
    <div>
        <a href="/" class="flex items-center font-semibold hover:underline">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
              </svg>
            <span class="ml-2"> All Ideas</span>
        </a>
    </div>

    {{-- idea card --}}
    <div class="idea container bg-white rounded-xl flex  mt-4">
        <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
            <div class="flex-none mx-2 md:mx-4">
                <a  href="">
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="w-full mx-2 md:mx-4">
                <h4 class="text-xl font-semibold">
                    <a href="" class="hover:underline"> {{ $idea->title }}</a>
                </h4>
                <div class="text-gray-600 mt-3">
                    {{ $idea->description }}
                </div>
                <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                    <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                        <div class="hidden md:block font-bold text-gray-900">{{ $idea->user->name }}</div>
                        <div class="hidden md:block">&bull;</div>
                        <div>{{ $idea->created_at->diffForHumans() }}</div>
                        <div>&bull;</div>
                        <div>Category 1</div>
                        <div>&bull;</div>
                        <div class="text-gray-900">5 Comments</div>
                    </div>
                    <div x-data="{isOpen:false}"
                         class="flex items-center space-x-2 mt-4 md:mt-0">
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
                                class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0 z-10">
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

    <div class="buttons-container flex items-center justify-between mt-6">
        <div class="flex flex-col md:flex-row items-center space-x-4 md:ml-6">
            <div
                x-data="{isOpen:false}"
                class="relative">
                <button @click="isOpen= !isOpen"
                        type="button" class="flex text-white items-center justify-center w-32 h-11 text-sm font-semibold rounded-xl bg-blue border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 space-x-3">
                    <span class="ml-1">
                        Reply
                    </span>
                </button>

                <div x-cloak
                     x-transition.origin.top.left.duration.500ms
                     x-show="isOpen"
                     @keydown.escape.window="isOpen = false"
                     @click.away="isOpen=false"
                     class=" absolute z-10 w-64 md:w-104 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">

                     <form class="space-y-4 px-4 py-6" action="">
                        <div>
                            <textarea name="post_comment" id="post_commet" cols="30" rows="4" class="w-full text-sm bg-gray-100 placeholder-gray-900 rounded-xl border-none px-4 py-2" placeholder="Go ahead and dont be shy. Share your thoughts...."></textarea>
                        </div>

                        <div class="flex flex-col md:flex-row items-center md:space-x-3">

                            <button type="submit" class="flex text-white items-center justify-center w-full md:w-1/2 h-11 text-sm font-semibold rounded-xl bg-blue border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">

                                Post Comment
                            </button>
                            <button type="button" class="flex items-center justify-center w-full md:w-32 h-11 text-sm font-semibold rounded-xl bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-2 md:mt-0">

                                <svg  class="text-gray-500 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>

                                <span class="ml-1">
                                    Attach
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div x-data="{isOpen:false}"
                 class="relative">

                 <button @click="isOpen= !isOpen"
                        type="button"
                        class="flex items-center justify-center h-11 text-sm font-semibold rounded-xl bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 space-x-3 mt-2 md:mt-0">

                        <span>
                            Set Status
                        </span>

                        <svg class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                <div
                    x-cloak
                    x-transition.origin.top.left.duration.500ms
                    x-show="isOpen"
                    @keydown.escape.window="isOpen = false"
                    @click.away="isOpen=false"
                    class=" absolute z-20 2-64 md:w-76 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
                    <form class="space-y-4 px-4 py-6" action="">
                        <div class="space-y-2">
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" class="bg-slate-200 text-black border-none" name="radio-direct" value="1">
                                    <span class="ml-2">Open</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" class="bg-slate-200 text-purple border-none" name="radio-direct" value="2">
                                    <span class="ml-2">Considering</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" class="bg-slate-200 text-yellow border-none" name="radio-direct" value="3">
                                    <span class="ml-2">In Progress</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" class="bg-slate-200 text-green border-none" name="radio-direct" value="4">
                                    <span class="ml-2">Implemented</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" class="bg-slate-200 text-red border-none" name="radio-direct" value="5">
                                    <span class="ml-2">Closed</span>
                                </label>
                            </div>
                            <div>
                                <textarea name="update_comment" id="update_comment" cols="30" rows="3" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4  py-2" placeholder="Add an update comment (optional)"></textarea>
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
                                        update
                                    </span>
                                </button>
                            </div>

                            <div>
                                <label class="font-normal inline-flex items-center"></label>
                                <input class="rounded bg-gray-200" type="checkbox" name="notify_voters" checked="">
                                <span class="ml-2"> Notify all voters</span>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="hidden md:flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-3">
                <div class="text-xl leading-snug">12</div>
                <div class="text-gray-400 text-xs leading-none">Votes</div>
            </div>
            <button type="button" class="w-32 items-center justify-center uppercase h-11 text-xs font-semibold rounded-xl bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 space-x-3">
                <span>
                    Vote
                </span>
            </button>
        </div>
    </div>
    {{-- end button container --}}

    <div class="comments-container relative space-y-6 md:ml-22 md:my-8 pt-4 mt-1">
      {{-- comment card --}}
        <div class="comment-container relative bg-white rounded-xl flex  mt-4">
            <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
                <div class="flex-none">
                    <a  href="">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>

                <div class="w-full md:mx-4">
                    {{-- <h4 class="text-xl font-semibold">
                        <a href="" class="hover:underline"> Title comment</a>
                    </h4> --}}
                    <div class="text-gray-600 mt-3">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa, quod ducimus, itaque eos aspernatur, magnam voluptatibus obcaecati laborum esse numquam non totam suscipit unde eligendi cumque iste vero recusandae ratione voluptas nulla enim quam neque incidunt. Earum tempora esse quasi suscipit voluptatem vel id culpa error vitae fugiat omnis sapiente nisi deleniti excepturi repellendus beatae maiores doloribus quos, a nobis modi obcaecati? Ullam voluptatibus possimus iste aliquam labore fuga, ratione, odio sed quasi repudiandae quae nostrum mollitia. Cumque, incidunt. Hic aliquam reprehenderit exercitationem facere consequatur ipsam repellendus ratione sint molestias, asperiores quidem sit at provident numquam pariatur minima saepe quam.
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div x-data="{isOpen:false}"
                             class="flex items-center space-x-2">
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
                                    class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0 z-10">
                                    <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Mark as Spam</a></li>
                                    <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end comment container --}}

        {{-- comment card --}}
        <div class="is-admin comment-container relative bg-white rounded-xl flex  mt-4">
          <div class="flex flex-1 px-4 py-6">
              <div class="flex-none">
                  <a  href="">
                      <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                  </a>
                  <div class="text-center uppercase text-blue text-xxs font-bold mt-2">Admin</div>
              </div>
              <div class="w-full mx-4">
                  <h4 class="text-xl font-semibold">
                      <a href="" class="hover:underline"> Title comment</a>
                  </h4>
                  <div class="text-gray-600 mt-3">
                      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa, quod ducimus, itaque eos aspernatur, magnam voluptatibus obcaecati laborum esse numquam non totam suscipit unde eligendi cumque iste vero recusandae ratione voluptas nulla enim quam neque incidunt. Earum tempora esse quasi suscipit voluptatem vel id culpa error vitae fugiat omnis sapiente nisi deleniti excepturi repellendus beatae maiores doloribus quos, a nobis modi obcaecati? Ullam voluptatibus possimus iste aliquam labore fuga, ratione, odio sed quasi repudiandae quae nostrum mollitia. Cumque, incidunt. Hic aliquam reprehenderit exercitationem facere consequatur ipsam repellendus ratione sint molestias, asperiores quidem sit at provident numquam pariatur minima saepe quam.
                  </div>
                  <div class="flex items-center justify-between mt-6">
                      <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                          <div class="font-bold text-blue">Skadi</div>
                          <div>&bull;</div>
                          <div>10 hours ago</div>
                      </div>
                      <div class="flex items-center space-x-2">
                          <button class="relative bg gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in px-3">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                  <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                              </svg>
                              <ul class="hidden absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3">
                                  <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Mark as Spam</a></li>
                                  <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete Post</a></li>
                              </ul>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        {{-- end comment container --}}
          {{-- comment card --}}
        <div class="comment-container relative bg-white rounded-xl flex  mt-4">
            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a  href="">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>

                <div class="w-full mx-4">
                    {{-- <h4 class="text-xl font-semibold">
                        <a href="" class="hover:underline"> Title comment</a>
                    </h4> --}}
                    <div class="text-gray-600 mt-3">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa, quod ducimus, itaque eos aspernatur, magnam voluptatibus obcaecati laborum esse numquam non totam suscipit unde eligendi cumque iste vero recusandae ratione voluptas nulla enim quam neque incidunt. Earum tempora esse quasi suscipit voluptatem vel id culpa error vitae fugiat omnis sapiente nisi deleniti excepturi repellendus beatae maiores doloribus quos, a nobis modi obcaecati? Ullam voluptatibus possimus iste aliquam labore fuga, ratione, odio sed quasi repudiandae quae nostrum mollitia. Cumque, incidunt. Hic aliquam reprehenderit exercitationem facere consequatur ipsam repellendus ratione sint molestias, asperiores quidem sit at provident numquam pariatur minima saepe quam.
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="relative bg gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                                <ul class="hidden absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3">
                                    <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Mark as Spam</a></li>
                                    <li><a href="" class="hover:bg-gray-100 px-5 py-3 transition duration-150 ease-in block">Delete Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end comment container --}}
    </div>
    {{-- end comments container --}}
</x-app-layout>