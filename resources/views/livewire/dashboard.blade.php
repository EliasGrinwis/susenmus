<div>
    {{-- Title --}}
    <h1 class="text-3xl font-bold mb-6">Welkom bij het Admin Dashboard!</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-blue-500 rounded-lg p-6 shadow-md transition duration-500 opacity-0 transform hover:scale-105">
            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-800 text-white mb-4">
                <i class="fas fa-users text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-2 text-white">Totaal Gebruikers</h3>
            <div class="flex items-center justify-center">
                <span class="text-4xl font-bold text-white">{{ $totalUsers }}</span>
            </div>
        </div>
        <div class="bg-gray-500 rounded-lg p-6 shadow-md transition duration-500 opacity-0 transform hover:scale-105">
            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-gray-800 text-white mb-4">
                <i class="fas fa-shopping-cart text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-2 text-white">Totaal Bestellingen</h3>
            <div class="flex items-center justify-center">
                <span class="text-4xl font-bold text-white">{{ $totalOrders }}</span>
            </div>
        </div>
        <div class="bg-green-500 rounded-lg p-6 shadow-md transition duration-500 opacity-0 transform hover:scale-105">
            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-green-800 text-white mb-4">
                <i class="fas fa-dollar-sign text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-2 text-white">Omzet</h3>
            <div class="flex items-center justify-center">
                <span class="text-4xl font-bold text-white">In ontwikkeling</span>
            </div>
        </div>
        <div class="col-span-2 transition opacity-0 transform">
            <div class="bg-white rounded-lg p-6 shadow-md ">
                <div class="flex items-center justify-center h-96 bg-gray-200 rounded-lg mb-4">
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-chart-line text-6xl text-gray-400"></i>
                    </div>
                    <div class="w-full h-full flex items-center justify-center absolute inset-0">
                        <span class="text-2xl font-bold text-gray-600">In ontwikkeling</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const mainElement = document.querySelector('main');
        mainElement.classList.add('opacity-100');

        const contentElements = document.querySelectorAll('.grid > div');
        contentElements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.add('opacity-100', 'translate-y-0');
            }, index * 200);
        });
    });
</script>
