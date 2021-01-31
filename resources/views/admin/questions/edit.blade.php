<x-app-layout>
    <x-slot name="header">
        {{$question->title}} sualını yenilə
    </x-slot>

  
<div>
    <div class="md:grid md:gap-6">
        <div class="px-4 py-3 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-indigo-900">
                <a href="{{url()->previous()}}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M6.707 4.879A3 3 0 018.828 4H15a3 3 0 013 3v6a3 3 0 01-3 3H8.828a3 3 0 01-2.12-.879l-4.415-4.414a1 1 0 010-1.414l4.414-4.414zm4 2.414a1 1 0 00-1.414 1.414L10.586 10l-1.293 1.293a1 1 0 101.414 1.414L12 11.414l1.293 1.293a1 1 0 001.414-1.414L13.414 10l1.293-1.293a1 1 0 00-1.414-1.414L12 8.586l-1.293-1.293z" clip-rule="evenodd" />
                    </svg>
                    Geriyə
                </a>
            </h3>
        </div>

      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="{{route('admin.quizzes.questions.update', ['quiz'=>$quiz, 'question'=>$question])}}" method="POST" enctype="multipart/form-data">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid gap-6">
                <div class="col-span-3 sm:col-span-2">
                  <label for="question" class="block text-sm font-medium text-gray-700">
                    Sual
                  </label>
                  <div class="mt-1 flex rounded shadow-sm">
                    <input type="text" name="question" id="question" value="{{$question->question}}"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                  </div>
                </div>
              </div>

              <div class="grid gap-6">
                <label class="block text-sm font-medium text-gray-700">
                    Şəkil
                </label>
                <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                    @if ($question->image)
                        <img src="{{asset('storage/'.$question->image)}}" class="h-24 w-28 mx-auto" alt="{{$question->question}}">
                    @endif
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    
                    <div class="flex text-sm text-gray-600">
                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                        <span>Şəkil əlavə et</span>
                        <input id="image" name="image" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">yaxud drag & drop</p>
                    </div>
                    <p class="text-xs text-gray-500">
                        PNG, JPG, GIF 2MB-a qədər
                    </p>
                    </div>
                </div>
              </div>

                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="answer1" class="block text-sm font-medium text-gray-700">1. Cavab</label>
                        <input type="text" name="answers[1]" id="answer1" value="{{$question->answers[0]->answer}}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
    
                    <div class="col-span-6 sm:col-span-3">
                        <label for="answer2" class="block text-sm font-medium text-gray-700">2. Cavab</label>
                        <input type="text" name="answers[2]" id="answer2" value="{{$question->answers[1]->answer}}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
    
                    <div class="col-span-6 sm:col-span-3">
                        <label for="answer3" class="block text-sm font-medium text-gray-700">3. Cavab</label>
                        <input type="text" name="answers[3]" id="answer3" value="{{$question->answers[2]->answer}}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="answer4" class="block text-sm font-medium text-gray-700">4. Cavab</label>
                        <input type="text" name="answers[4]" id="answer4" value="{{$question->answers[3]->answer}}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="correct_answer" class="block text-sm font-medium text-gray-700">Doğru cavab</label>
                        <select id="correct_answer" name="correct_answer" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option>Doğru cavabı seçin</option>
                            <option value="1" @if ($question->answers[0]->type==='correct')
                                    selected
                                @endif>1. Cavab
                            </option>
                            <option value="2" @if ($question->answers[1]->type==='correct')
                                    selected
                                @endif>2. Cavab
                            </option>
                            <option value="3" @if ($question->answers[2]->type==='correct')
                                    selected
                                @endif>3. Cavab
                            </option>
                            <option value="4" @if ($question->answers[3]->type==='correct') 
                                    selected 
                                @endif>4. Cavab
                            </option>
                        </select>
                    </div>
                </div>
              
            </div>
            
            

            <div class="px-4 py-3 bg-gray-50 sm:px-6">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Yenilə
              </button>
            </div>
          </div>
          @csrf
          @method('PUT')
        </form>
      </div>
    </div>
  </div>
  

</x-app-layout>
