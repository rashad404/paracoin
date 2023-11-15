<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white">
  <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
    <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
      <div>
        <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">@lang('text.Companies & Websites that accept :coinName', ['coinName' => config('coin.name')])</h2>
        <p class="mt-3 max-w-3xl text-lg text-gray-500">@lang('text.Despite being a new startup, the number of stores accepting :coinName is increasing daily.', ['coinName' => config('coin.name')])</p>
        <div class="mt-8 sm:flex">
          <div class="rounded-md shadow">
            <a href="/api" class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"> Developer API </a>
          </div>
          <div class="sm:mt-0 sm:ml-3">
            <a href="/contact" class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200"> Contact Us </a>
          </div>
        </div>
      </div>
      <div class="mt-8 grid grid-cols-2 gap-0.5 md:grid-cols-3 lg:mt-0 lg:grid-cols-2">

        @foreach ($partnerStores as $partnerStore)
          <div class="col-span-1 flex justify-center py-8 px-8 bg-gray-50">
            <img class="max-h-12 object-contain" src="{{ url('storage/' . $partnerStore->logo) }}" alt="{{$partnerStore->name}}">
          </div>     
        @endforeach
      </div>
    </div>
  </div>
</div>
