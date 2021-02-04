<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <div class="flex flex-wrap justify-between">
        <div class="w-full md:w-1/2 lg:w-1/3 mb-4 bg-white">
              <dl>
                @if ($quiz->current_user)
                <div class="bg-gray-100 px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500 sm:col-span-4">
                    Əldə etdiyiniz nəticə
                  </dt>
                  <dd class="mt-1 text-right text-sm text-green-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      {{$quiz->current_user->pivot->score}}
                    </span>
                  </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500 sm:col-span-4">
                    Sıralamada yeriniz
                  </dt>
                  <dd class="mt-1 text-right text-sm text-green-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      {{$quiz->current_user->rank}}
                    </span>
                  </dd>
                </div>
                <div class="bg-gray-100 px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500 sm:col-span-3">
                    Doğru / Yanlış cavab sayı
                  </dt>
                  <dd class="mt-1 text-right text-sm text-gray-900 sm:mt-0 sm:col-span-3">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-900">
                      {{$quiz->current_user->pivot->correct_answers_count}} Doğru
                    </span>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-900">
                      {{$quiz->current_user->pivot->wrong_answers_count}} Yanlış
                    </span>
                  </dd>
                </div>
                @endif
                @if ($quiz->finished_at)
                <div class="bg-gray-100 px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500 sm:col-span-4">
                    Son qatılım tarixi 
                  </dt>
                  <dd class="mt-1 text-right text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span title="{{$quiz->getQuizDate()}}" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                      {{$quiz->finished_at->diffForHumans()}}
                    </span>
                  </dd>
                </div>
                @endif
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500 sm:col-span-4">
                    Sual sayı 
                  </dt>
                  <dd class="mt-1 text-right text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                      {{$quiz->questions_count}}
                    </span>
                    
                  </dd>
                </div>
                @if ($quiz->users_details['users_count'] > 0)
                <div class="bg-gray-100 px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500 sm:col-span-4">
                    Qatılanların sayı
                  </dt>
                  <dd class="mt-1 text-right text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                      {{$quiz->users_details['users_count']}}
                    </span>
                    
                  </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500 sm:col-span-4">
                    Ortalama nəticə
                  </dt>
                  <dd class="mt-1 text-right text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                      {{$quiz->users_details['average_score']}}
                    </span>
                    
                  </dd>
                </div>
                @endif
               
              </dl>
              
              <hr>

              @if (count($quiz->topTenUsers)>0)
              <dl>
                <div class="bg-white-100 px-4 py-5 sm:px-6">
                  <dt class="text-base md:text-lg xl:text-xl font-medium text-gray-500">
                    Top 10 yarışmaçı
                  </dt>
                </div>
                
                @foreach ($quiz->topTenUsers as $key => $user)
                <div class="@if (($key+1)%2==0)
                  bg-white-100
                @else
                  bg-gray-100  
                @endif px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium sm:col-span-5">
                    {{$key+1}}.
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                          <img class="inline-block h-6 w-6 mb-0.5 mx-0.5 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                    @else
                        <div class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            {{ $user->name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    @endif
                    <span class="@if ($user->id===auth()->id())
                          text-green-500
                      @else
                        text-gray-500
                      @endif"
                    >{{$user->name}}</span>
                     
                  </dt>
                  <dd class="mt-1 text-right text-sm text-blue-900 sm:mt-0 sm:col-span-1">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                      {{$user->pivot->score}}
                    </span>
                  </dd>
                </div>
                @endforeach
              </dl>
              @endif
          </div>

        <div class="w-full md:w-1/2 lg:w-2/3 mb-4 bg-white p-2">
            <div class="text-center">
                <p class="my-2 text-gray-500 text-justify">
                  {{$quiz->description}}
                </p>
                <div class="mt-6 text-center text-sm text-gray-500">
                    <a href="{{route('quizzes.show', ['slug'=>$quiz->slug])}}" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                      @if ($quiz->current_user)
                        Quizi görüntülə
                        @else
                        Quizə qatıl
                      @endif
                  </a>
                </div>
              </div>
          </div>
        
    </div>
   
</x-app-layout>
