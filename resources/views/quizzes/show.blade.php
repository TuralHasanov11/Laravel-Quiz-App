<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <div class="md:container md:mx-auto">
        
        <form action="{{route('quizzes.result', ['quiz'=>$quiz])}}" method="post">

            @foreach ($quiz->questions as $key => $question)
            <div class="max-w rounded overflow-hidden shadow-lg bg-white my-5">
                
                <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{$key+1}}. {{$question->question}}</div>
                    @if ($question->image)
                        <img class="md:w-1/2 w-full max-h-48 md:max-h-60 lg:max-h-80 xl:max-h-96" src="{{asset('storage/'.$question->image)}}" alt="Sunset in the mountains">
                    @endif
                </div>
                <div class="px-6 py-4">
                
                <fieldset>
                    @foreach ($question->answers as $answer)
                        <div class="flex items-center text-base leading-9">
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
                Təsdiqlə
                </button>
            </div>
            @csrf
        </form>
    </div>
   
</x-app-layout>
