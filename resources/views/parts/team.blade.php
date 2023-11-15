<div class="bg-white">
    <div class="mx-auto py-12 px-4 max-w-7xl sm:px-6 lg:px-8 lg:py-24">
      <div class="grid grid-cols-1 gap-12 lg:grid-cols-3 lg:gap-8">
        <div class="space-y-5 sm:space-y-4">
          <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl">@lang('text.Meet our team')</h2>
          <p class="text-xl text-gray-500">@lang('text.All the talent in the world won\'t take you anywhere without your teammates')</p>
        </div>
        <div class="lg:col-span-2">
          <ul role="list" class="space-y-12 sm:grid sm:grid-cols-2 sm:gap-12 sm:space-y-0 lg:gap-x-8">
  
            @foreach ($teams as $team)
              <li>
                <div class="flex items-center space-x-4 lg:space-x-6">
                  <img class="w-16 h-16 rounded-full lg:w-20 lg:h-20" src="{{ url('storage/' . $team->photo) }}" alt="{{$team->name}}">
                  <div class="font-medium text-lg leading-6 space-y-1">
                    <h3>{{$team->name}}</h3>
                    <p class="text-indigo-600">@lang('text.' . $team->title)</p>
                  </div>
                </div>
              </li>       
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>