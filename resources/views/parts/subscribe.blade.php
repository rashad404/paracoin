<div class="bg-white">
  <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
    <h2 class="inline text-3xl font-extrabold tracking-tight text-gray-900 sm:block sm:text-4xl">@lang('text.Want product news and updates?')</h2>
    <p class="inline text-3xl font-extrabold tracking-tight text-indigo-600 sm:block sm:text-4xl">@lang('text.Sign up for our newsletter.')</p>
    <form class="mt-8 sm:flex">
      <label for="email-address" class="sr-only">Email address</label>
      <input 
        id="email-address" 
        name="email" 
        type="email" 
        autocomplete="email" 
        required 
        class="w-full px-5 py-3 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs border-gray-300 rounded-md"
        placeholder="@lang('text.Enter your email')"
      >
      <div class="rounded-md shadow sm:mt-0 sm:ml-3 sm:flex-shrink-0">
        <button type="submit" class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">@lang('text.Notify me')</button>
      </div>
    </form>
  </div>
</div>
