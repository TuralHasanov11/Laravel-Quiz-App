<x-app-layout>
    <x-slot name="header">
        Əsas Səhifə
    </x-slot>

    <div class="grid grid-cols-12 bg-gray-100 gap-2">
        <div class="col-span-12 md:col-span-9 ">
            
          <div class="w-full grid grid-cols-12 md:grid-cols-6 gap-2">
            @foreach ($quizzes as $quiz)
            <a href="{{route('quizzes.details', ['slug'=>$quiz->slug])}}" class="bg-white quiz col-span-12 md:col-span-3 rounded">
                <div class="max-w h-full shadow-lg">
                    <div class="px-6 py-4">
                      <div class="font-bold text-xl mb-2">{{$quiz->title}}</div>
                      <p class="text-gray-700 text-base">
                        {{Str::limit($quiz->description,100)}}
                      </p>
                    </div>
                    <div class="px-6 py-4">
                        <div class="text-sm mb-2">
                            <p class="text-yellow-700">{{$quiz->finished_at?$quiz->finished_at->diffForHumans()." sonra bitir":null}}</p>
                        </div>
                      <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{$quiz->getQuizDate()}}</span>
                    </div>
                </div>
            </a>
            @endforeach
          </div>
    
            
           <div class="container">
                {{$quizzes->links()}}
            </div>
        </div>

        
        <div class="col-span-12 md:col-span-3">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                  <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Son 10 quiz nəticələriniz
                  </h3>
                </div>
                <div class="border-t border-gray-200">
                  <dl>
                    
                   @foreach ($user->quizzes as $key => $quiz)
                    <a href="{{route('quizzes.details', ['slug'=>$quiz->slug])}}" class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
                      <dt class="text-sm font-medium text-blue-400 sm:col-span-5">
                        {{$quiz->title}}
                      </dt>
                      <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                        {{$quiz->pivot->score}}
                      </dd>
                    </a>
                   @endforeach
                    
                  </dl>
                </div>
              </div>
        </div>
    </div>
</x-app-layout>
