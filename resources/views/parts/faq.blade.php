<div class="bg-white">
<div class="mx-auto py-12 px-4 max-w-7xl sm:px-6 lg:px-8 lg:py-24">
  <div class="grid grid-cols-1 gap-12 lg:grid-cols-3 lg:gap-8">
      <div class="space-y-5 sm:space-y-4">
        <h2 class="text-3xl font-extrabold text-gray-900">@lang('text.Frequently asked questions')</h2>
        <p class="mt-4 text-lg text-gray-500">@lang('text.Can\'t find the answer you\'re looking for? Reach out to our') <a href="/contact" class="font-medium text-indigo-600 hover:text-indigo-500">@lang('text.customer support')</a> @lang('text.contact-end-text')</p>
      </div>
      <div class="mt-12 lg:mt-0 lg:col-span-2">
        <dl class="space-y-12">
          @foreach ($faqs as $faq)
          <div>
            <dt class="text-lg leading-6 font-medium text-gray-900">@lang('text.' . $faq->question)</dt>
            <dd class="mt-2 text-base text-gray-500">@lang('text.' . $faq->answer)</dd>
          </div>
          @endforeach
        </dl>
      </div>
    </div>
  </div>
</div>
