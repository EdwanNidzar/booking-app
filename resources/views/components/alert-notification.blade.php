@if (session('success'))
  <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
    <div class="flex justify-center items-center w-12 bg-green-500">
      <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM18.3334 28.3333V25H21.6667V28.3333H18.3334ZM18.3334 21.6666V11.6666H21.6667V21.6666H18.3334Z">
        </path>
      </svg>
    </div>

    <div class="px-4 py-2 -mx-3">
      <div class="mx-3">
        <span class="font-semibold text-green-500">Success</span>
        <p class="text-sm text-gray-600">{{ session('success') }}</p>
      </div>
    </div>
  </div>
@endif

<script>
  setTimeout(() => {
    document.querySelector("div.inline-flex").remove();
  }, 3000); // 3 detik
</script>
