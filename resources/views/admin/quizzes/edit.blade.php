<x-app-layout>
    <x-slot name="header">
        Quizi yenilə
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
        <form action="{{route('admin.quizzes.update', ['quiz'=>$quiz->id])}}" method="POST">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid gap-6">
                <div class="col-span-3 sm:col-span-2">
                  <label for="title" class="block text-sm font-medium text-gray-700">
                    Başlıq
                  </label>
                  <div class="mt-1 flex rounded shadow-sm">
                    <input type="text" name="title" id="title" value="{{$quiz->title}}"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                  </div>
                </div>
              </div>

              <div class="grid gap-6">
                <div class="col-span-3 sm:col-span-2">
                  <label for="description" class="block text-sm font-medium text-gray-700">
                    Məzmun
                  </label>
                  <div class="mt-1 flex rounded shadow-sm">
                    <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">{{$quiz->description}}
                    </textarea>                  
                  </div>
                </div>
              </div>
              
              <div class="grid gap-6">
                <div class="col-span-3 sm:col-span-2">
                  <label for="finished_at" class="block text-sm font-medium text-gray-700">
                    Bitiş tarixi
                  </label>
                  <div class="mt-1 flex rounded shadow-sm">
                    <input type="datetime-local" name="finished_at" id="finished_at" value="{{$quiz->finished_at}}"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" placeholder="YYYY-MM-DD HH:mm">
                </div>
                </div>
              </div>
              
            </div>
            
            <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Quizi yenilə
              </button>
            </div>

            <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                <button onclick="event.preventDefault(); document.getElementById('delete-quiz-form').submit();"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                >
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Sil
                </button>
            </div>
            

          </div>
          @csrf
          @method('PUT')
        </form>

        <form id="delete-quiz-form" action="{{route('admin.quizzes.destroy', ['quiz'=>$quiz])}}" method="post">
            @method('DELETE')
            @csrf
        </form>
      </div>
    </div>
  </div>
  

</x-app-layout>
