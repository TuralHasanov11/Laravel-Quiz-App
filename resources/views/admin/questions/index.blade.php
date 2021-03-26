<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}} quizinin sualları
    </x-slot>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-indigo-900">
                <a href="{{route('admin.quizzes.questions.create', ['quiz'=>$quiz])}}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    Sual əlavə et
                </a>
            </h3>
        </div>
    </div>

    <div class="container">
        <div class="px-4 py-3 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-indigo-900">
                <a href="{{route('admin.quizzes.show', ['quiz'=>$quiz])}}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M6.707 4.879A3 3 0 018.828 4H15a3 3 0 013 3v6a3 3 0 01-3 3H8.828a3 3 0 01-2.12-.879l-4.415-4.414a1 1 0 010-1.414l4.414-4.414zm4 2.414a1 1 0 00-1.414 1.414L10.586 10l-1.293 1.293a1 1 0 101.414 1.414L12 11.414l1.293 1.293a1 1 0 001.414-1.414L13.414 10l1.293-1.293a1 1 0 00-1.414-1.414L12 8.586l-1.293-1.293z" clip-rule="evenodd" />
                    </svg>
                    Geriyə
                </a>
            </h3>
        </div>
    </div>

    <div class="flex flex-col">
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
                        Sual
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Şəkil
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        1. Cavab 
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        2. Cavab 
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        3. Cavab 
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        4. Cavab 
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Əməliyyatlar
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                
                    @foreach ($quiz->questions as $question)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{$question->id}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{$question->question}} {{$question->type}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ">
                                @if ($question->image)
                                    <a href="{{asset('storage/'.$question->image)}}" class="text-green-600 hover:text-green-900">
                                        Görüntülə
                                    </a>
                                    @else
                                    Yoxdur
                                @endif
                                
                            </span>
                        </td>
                        
                        @foreach ($question->answers as $answer)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full @if ($answer->type === 'correct')
                                    text-green-700
                                @endif">
                                    {{$answer->answer}}
                                </span>
                            </td>
                        @endforeach
                       
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex flex-wrap justify-around">
                            <a href="{{route('admin.quizzes.questions.edit', ['quiz'=>$quiz, 'question'=>$question])}}" class="inline-flex items-center text-blue-600 hover:text-blue-900">
                                <svg class="mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                </svg>
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>      
            </div>
            
        </div>
        </div>
    </div>
  
  
</x-app-layout>
