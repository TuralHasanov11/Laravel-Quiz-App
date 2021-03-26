<x-app-layout>
    <x-slot name="header">
        Quizlər
    </x-slot>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-3">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-indigo-900">
                    <a href="{{route('admin.quizzes.create')}}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        Quiz əlavə et
                    </a>
            </h3>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="" method="GET">
              <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                  <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                      <div class="mt-1 flex rounded shadow-sm">
                        <input type="text" name="title" id="title" value="{{request()->get('title')}}" placeholder="Sual"
                          class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                      </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                        <select id="status" onchange="this.form.submit();" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Bütün</option>
                            <option @if (request()->get('status') === 'active')
                                selected
                            @endif value="active">Aktiv</option>
                            <option @if (request()->get('status') === 'draft')
                                selected
                            @endif value="draft">Gözləmədə</option>
                            <option @if (request()->get('status') === 'passive')
                                selected
                            @endif value="passive">Passiv</option>
                        </select>
                    </div>

                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <div class="px-4 py-1 text-left sm:px-6">
                            <button type="button" id="resetSearch" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Sıfırla
                            </button>
                        </div>
                    </div>
                </div>
                  
                </div>
                
               
              </div>
            </form>
          </div>
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                
        <div class="py-3 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg px-1">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quiz
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Sual sayı
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Bitiş tarixi
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Əməliyyatlar
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                
                    @foreach ($quizzes as $quiz)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{$quiz->id}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{$quiz->title}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{$quiz->questions_count}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if ($quiz->status==='draft')
                                bg-yellow-100 text-yellow-800
                            @endif 
                            @if ($quiz->status==='active')
                                bg-green-100 text-green-800
                            @endif
                            @if ($quiz->status==='passive')
                            bg-red-100 text-red-800
                            @endif">
                                @switch($quiz->status)
                                    @case('active')
                                        @if ($quiz->finished_at!==null && $quiz->finished_at < now())
                                        Vaxtı bitib
                                        @else
                                        Aktiv
                                        @endif
                                        @break
                                    @case('passive')
                                        Passiv
                                        @break
                                    @case('draft')
                                        Gözləmədə
                                        @break
                                    @default
                                        
                                @endswitch
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span title="{{$quiz->finished_at?$quiz->finished_at:null}}">{{$quiz->finished_at?$quiz->finished_at->diffForHumans():'Yoxdur'}}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex flex-wrap justify-around ">
                            <a href="{{route('admin.quizzes.edit', ['quiz'=>$quiz->id])}}" class="inline-flex items-center text-blue-600 hover:text-blue-900">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                </svg>
                                Edit
                            </a>

                            <a href="{{route('admin.quizzes.questions.index', ['quiz'=>$quiz])}}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                                Suallar
                            </a>

                            <a href="{{route('admin.quizzes.show', ['quiz'=>$quiz])}}" class="inline-flex items-center text-yellow-600 hover:text-yellow-900">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2h-1.528A6 6 0 004 9.528V4z" />
                                    <path fill-rule="evenodd" d="M8 10a4 4 0 00-3.446 6.032l-1.261 1.26a1 1 0 101.414 1.415l1.261-1.261A4 4 0 108 10zm-2 4a2 2 0 114 0 2 2 0 01-4 0z" clip-rule="evenodd" />
                                  </svg>
                              
                                Məlumatlar
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>      
            </div>
            <div class="py-3 px-1">
                {{$quizzes->withQueryString()->links()}}
            </div>
        </div>
        </div>
    </div>
  
  
</x-app-layout>
