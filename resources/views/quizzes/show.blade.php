<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <!-- This example requires Tailwind CSS v2.0+ -->
<div class="lg:flex lg:items-center lg:justify-between shadow-lg bg-white mb-6 py-6 pl-2">
    <div class="flex-1 min-w-0">
      <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
        <div class="mt-2 flex items-center text-sm text-gray-500">
          <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
          </svg>
          {{$quiz->getCreatedAt()}}

        </div>
        <div class="mt-2 flex items-center text-sm text-gray-500">
            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
              </svg>
            Sual say: {{count($quiz->questions)}}
        </div>
        @if ($quiz->finished_at)
            <div class="mt-2 flex items-center text-sm text-gray-500" title="{{$quiz->getFinishedAt()}}">
                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                  </svg>
                {{$quiz->finished_at->diffForHumans()}}
            </div>
        @endif
      </div>
    </div>
  </div>
  

    <div class="md:container md:mx-auto">
        
        <form action="{{route('quizzes.result', ['quiz'=>$quiz])}}" method="post">

            @foreach ($quiz->questions as $key => $question)
            <div class="max-w rounded overflow-hidden shadow-lg bg-white my-5">
                
                <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{$key+1}}. {{$question->question}}</div>
                    @if ($question->image)
                        <img class="md:w-1/2 w-full max-h-48 md:max-h-60 lg:max-h-80 xl:max-h-96" src="{{asset($question->image)}}" alt="Sunset in the mountains">
                    @endif
                </div>
                <div class="px-6 py-4">
                
                <fieldset>
                    @foreach ($question->answers as $answer)
                        <div class="flex items-center text-lg text-base leading-9 bg-gray-100 hover:bg-gray-200 my-2 pl-2 py-2 focus-within:bg-gray-300">
                            <input id="question{{$question->id}}Answer{{$answer->id}}" name="{{$question->id}}" value="{{$answer->id}}" type="radio" required class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="question{{$question->id}}Answer{{$answer->id}}" class="ml-3 block font-medium text-gray-700">
                            {{$answer->answer}}
                            </label>
                        </div>
                    @endforeach
                    
                </fieldset>
                </div>
            </div>
            @endforeach

            <div class="px-4 py-3 text-left sm:px-6">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                 Quizi bitir
                </button>
            </div>
            @csrf
        </form>
    </div>
   
</x-app-layout>
