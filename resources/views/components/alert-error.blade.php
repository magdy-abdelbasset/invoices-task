    @if(session()->has('error'))

    <div role="alert" class="mb-2">
      <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
          Danger
      </div>
      <div class="border border-t-0 border-red-300 rounded-b bg-red-300 px-4 py-3 text-red-800">
          <p>{{ session()->get('error') }}</p>
      </div>
  </div>
  @endif