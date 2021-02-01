<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <div class="flex flex-wrap justify-between">
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 mb-4 bg-white">
              <dl>
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
                <div class="bg-gray-100 px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500 sm:col-span-4">
                    Qatılanların sayı
                  </dt>
                  <dd class="mt-1 text-right text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                      10
                    </span>
                    
                  </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500 sm:col-span-4">
                    Ortalama nəticə
                  </dt>
                  <dd class="mt-1 text-right text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                      80
                    </span>
                    
                  </dd>
                </div>
               
              </dl>
          </div>

        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-3/4 mb-4 bg-white p-2">
            <div class="text-center">
                <p class="my-2 text-gray-500 text-justify">
                  {{$quiz->description}}
                </p>
                <div class="mt-6 text-center text-sm text-gray-500">
                    <a href="{{route('quizzes.show', ['slug'=>$quiz->slug])}}" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      Quizə qatıl
                  </a>
                </div>
              </div>
          </div>
        
    </div>
   
</x-app-layout>
