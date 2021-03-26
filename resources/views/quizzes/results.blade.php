<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}} Nəticəsi
    </x-slot>

    <div class="md:container md:mx-auto">
        <div class="bg-blue-100 border-blue-300 text-gray-500 px-4 py-3" role="alert">
            <div class="flex items-center">
                <svg class="mr-2 h-5 w-5 text-green-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                 Doğru cavablanan sual
            </div>
            <div class="flex items-center">
                <svg class="mr-2 h-5 w-5 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                 Yanlış cavablanan sual
            </div>
            <div class="flex items-center">
                <svg class="mr-2 h-5 w-5 text-yellow-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                 Sizin cavabınız
            </div>
        </div>
        @foreach ($quiz->questions as $key => $question)
        <div class="max-w rounded overflow-hidden shadow-lg bg-white my-5">
            
            <div class="px-6 py-4">
                
            <div class="flex items-center font-bold text-xl mb-2">
                
                @if ($question->correct_answer->id === $question->current_user->pivot->answer )
                    <svg class="mr-2 -ml-0.5 h-5 w-5 text-green-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                @else
                    <svg class="mr-2 -ml-0.5 h-5 w-5 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                   
                @endif {{$key+1}}. {{$question->question}}
            </div>
            <p class="ml-4 text-sm text-blue-500 block font-bold">İstifadəçilərin {{$question->correct_percentage}}%-i bu suala doğru cavab verib</p>
                @if ($question->image)
                    <img class="md:w-1/2 w-full max-h-48 md:max-h-60 lg:max-h-80 xl:max-h-96" src="{{asset($question->image)}}" alt="{{$question->question}}">
                @endif
            </div>
            <div class="px-6 py-4">
            
            <fieldset>
                @foreach ($question->answers as $answer)
                    <div class="flex items-center text-lg text-base leading-9 bg-gray-100 hover:bg-gray-200 my-2 pl-2 py-2">
                        @if ($answer->id === $question->correct_answer->id)
                        <svg class="ml-2 -mr-0.5 h-4 w-4 text-green-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        @elseif($answer->id === $question->current_user->pivot->answer)
                        <svg class="ml-2 -mr-0.5 h-4 w-4 text-yellow-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        @else
                        <span class="ml-2 -mr-0.5 h-4 w-4 text-green-700"></span>   
                        @endif
                        <label for="question{{$question->id}}Answer{{$answer->id}}" class="ml-3 block font-medium text-gray-700">
                            {{$answer->answer}}
                        </label>
                    </div>
                @endforeach
                
            </fieldset>
            </div>
        </div>
        @endforeach
    </div>
   
</x-app-layout>
