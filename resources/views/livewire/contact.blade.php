<div>
    <div class="container px-5 py-10 lg:py-24 mx-auto flex sm:flex-nowrap flex-wrap">
        <div class="lg:w-2/3 md:w-1/2 bg-gray-300 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
            <iframe width="100%" height="100%" title="map" class="absolute inset-0 filter grayscale contrast-100 opacity-50" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2502.1389287709258!2d4.650399115757266!3d51.16122807957973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3fdfa62901f37%3A0xbabecdf719622913!2sSus%20%26%20Mus!5e0!3m2!1snl!2sbe!4v1690392277780!5m2!1snl!2sbe" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md">
                <div class="lg:w-1/2 px-6">
                    <label class="block title-font font-semibold text-gray-900 tracking-widest text-xs">ADRES</label>
                    <p class="mt-1">Koningsbaan 57, 2560 Nijlen</p>
                </div>
                <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                    <label class="block title-font font-semibold text-gray-900 tracking-widest text-xs">EMAIL</label>

                    <p class="text-orange-500 leading-relaxed"><a href="mailto:info@susenmus.be">info@susenmus.be</a></p>
                    <label class="block title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">TELEFOON</label>
                    <p class="text-orange-500 leading-relaxed"><a href="">0496/12 38 97</a></p>

                </div>
            </div>
        </div>

        <div class="lg:w-1/3 md:w-1/2 bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 sm:mt-0 relative z-10 shadow-md">
            <h2 class="text-gray-900 mb-1 text-2xl font-bold">Contacteer ons</h2>
            <p class="leading-relaxed mb-5 text-gray-600">Wil je graag extra informatie, aarzel niet om ons te
                contacteren!</p>
            <div class="relative mb-4">
                <label class="block font-medium text-sm text-gray-700 leading-7 text-sm text-gray-600" for="name">
                    Naam
                </label>
                <input required="" class="border-gray-300 focus:border-orange-300 focus:ring-orange-500 focus:ring-opacity-50 rounded-md shadow-sm disabled:opacity-50 disabled:bg-gray-100 w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" type="text" id="name" name="name" wire:model.lazy="name">
            </div>
            <div class="relative mb-4">
                <label class="block font-medium text-sm text-gray-700 leading-7 text-sm text-gray-600" for="email">
                    Email
                </label>
                <input required="" class="border-gray-300 focus:border-orange-300 focus:ring-orange-500 focus:ring-opacity-50 rounded-md shadow-sm disabled:opacity-50 disabled:bg-gray-100 w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" type="email" id="email" name="email" wire:model.lazy="email">
            </div>
            <div class="relative mb-4">
                <label class="block font-medium text-sm text-gray-700 leading-7 text-sm text-gray-600" for="message">
                    Bericht
                </label>
                <textarea required="" class="border-gray-300 focus:border-orange-300 focus:ring-orange-500 focus:ring-opacity-50 rounded-md shadow-sm disabled:opacity-50 disabled:bg-gray-100 w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" id="message" name="message" wire:model.lazy="message"></textarea>
            </div>
            <div class="">

                <button type="submit" class="bg-gray-800 hover:bg-gray-700 active:bg-gray-900 outline-gray-900 cursor-not-allowed inline-flex items-center border border-transparent px-4 py-2 rounded-md font-semibold text-xs text-white uppercase tracking-widest disabled:opacity-25 transition focus-visible:outline focus-visible:outline-offset-2 text-xl py-2 px-6 justify-center" wire:click="contactMail" disabled="">
                    Versturen
                </button>
                <svg wire:loading="1" wire:target="contactMail" class="animate-spin w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M236,128A108,108,0,1,1,83,29.8,12,12,0,0,1,93,51.6a84,84,0,1,0,70,0,12,12,0,0,1,10-21.8A108.3,108.3,0,0,1,236,128Z"></path></svg>                </div>

            <p class="text-xs text-gray-500 mt-3">Als het bericht goed is aangekomen ontvang je zelf ook een
                kopie</p>
        </div>

    </div>
</div>
