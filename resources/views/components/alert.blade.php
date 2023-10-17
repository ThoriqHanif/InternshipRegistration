<div class="px-0 pt-0">
    @if ($message = session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="text-white mb-0">{{ session()->get('success') }}</p>
        </div>
    @endif
    @if ($message = session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="text-white mb-0">{{ session()->get('error') }}</p>
        </div>
    @endif
</div>
