{{--
    resources/views/components/dark-mode-switcher.blade.php

    Komponen tombol toggle dark/light mode.
    Bekerja dengan AJAX POST ke route('theme.toggle') sehingga
    tidak perlu redirect ke URL berbeda seperti versi HTML aslinya.
--}}
@php
    $isDark = session('theme', request()->cookie('theme', 'light')) === 'dark';
@endphp

<div
    id="dark-mode-switcher"
    class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10"
    data-url="javascript:;"
>
    <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
    <div id="dm-toggle" class="dark-mode-switcher__toggle {{ $isDark ? 'dark-mode-switcher__toggle--active' : '' }} border"></div>
</div>

@once
    @push('scripts')
    <script>
        function toggleDarkMode() {
            fetch('{{ route('theme.toggle') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                const html     = document.documentElement;
                const toggle   = document.querySelector('.dark-mode-switcher__toggle');
                const isDark   = data.theme === 'dark';

                // Swap class di <html>
                html.classList.toggle('dark', isDark);
                html.classList.toggle('light', !isDark);

                // Update visual toggle
                toggle.classList.toggle('dark-mode-switcher__toggle--active', isDark);

                // Simpan ke cookie client-side juga (backup)
                document.cookie = `theme=${data.theme};path=/;max-age=${60*60*24*365}`;
            });
        }
    </script>
    @endpush
@endonce
