<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <div class="md:grid md:gap-6">
        <div class="px-4 py-3 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-indigo-900">
                <a href="{{route('admin.quizzes.index')}}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M6.707 4.879A3 3 0 018.828 4H15a3 3 0 013 3v6a3 3 0 01-3 3H8.828a3 3 0 01-2.12-.879l-4.415-4.414a1 1 0 010-1.414l4.414-4.414zm4 2.414a1 1 0 00-1.414 1.414L10.586 10l-1.293 1.293a1 1 0 101.414 1.414L12 11.414l1.293 1.293a1 1 0 001.414-1.414L13.414 10l1.293-1.293a1 1 0 00-1.414-1.414L12 8.586l-1.293-1.293z" clip-rule="evenodd" />
                    </svg>
                    Geriyə
                </a>
            </h3>
        </div>

    <div class="flex flex-wrap justify-between">
        <div class="w-full md:w-1/2 lg:w-1/3 mb-4 bg-white">
            
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

        <div class="w-full md:w-1/2 lg:w-2/3 mb-4 bg-white p-4">
            <div class="text-center">
                <p class="my-2 text-gray-500 text-justify">
                  {{$quiz->description}}
                </p>
                <p>
                  <a href="{{route('admin.quizzes.questions.index', ['quiz'=>$quiz])}}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    Suallar
                  </a>
                 
                </p>
                <div class="mt-6">
                      
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                
                        <div class="py-3 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg px-1">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        İstifadəçi adı
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nəticə
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Doğru/Yanlış
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Əməliyyatlar
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                
                                   @if (count($quiz->users))
                                    @foreach ($quiz->users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{$user->id}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{$user->name}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{$user->pivot->score}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{$user->pivot->correct_answers_count}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{$user->pivot->wrong_answers_count}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex flex-wrap justify-around ">
                                            {{-- <a href="{{route('admin.quizzes.edit', ['quiz'=>$quiz->id])}}" class="inline-flex items-center text-blue-600 hover:text-blue-900">
                                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                </svg>
                                                Edit
                                            </a> --}}
                
                                    
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="text-gray-500 border-gray-200 rounded-lg h-20">
                                      <td colspan="5" class="text-center">İstifadəçi yoxdur</td>
                                    </tr>
                                   @endif
                
                                </tbody>
                            </table>      
                            </div>
                            
                        </div>
                        </div>


                </div>
              </div>
          </div>
        
    </div>
   
</x-app-layout>
