<div>
    <style>
        /*     @media screen and (min-width: 1400px) {
                 .categories,
                 .menu-categories {
                     flex-direction: row;
                     gap: 0.625em;
                     !* margin-bottom: 3rem; *!
                 }
                 .category {
                     min-width: 13.7rem;
                     margin-bottom: 0;
                 }

                 .menu-categories .category:last-child {
                     margin-bottom: 0rem;
                 }
             }*/

        /*@media screen and (min-width: 1023px) {
            .categories,
            .menu-categories {
                max-width: 1110px;
            }
            .categories {
                margin-bottom: 9.5rem;
            }
            .menu-categories {
                margin-bottom: 6.5rem;
            }
            .category {
                width: 21.875rem;
            }
        }*/

        .article-test {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .founder-img {
            max-width: 400px;
            position: relative;
            left: 45px;
            top: -150px;
            place-self: flex-start;
        }

        .article-test-content {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 30px;
            max-width: 600px;
            background: #191919;
            color: white;
            padding: 60px;
            right: 45px;
        }

        /*    .article-test-content::after {
                position: absolute;
                content: url("assets/images/bg-pattern-3.svg");
                bottom: -70px;
                right: 50px;
            }*/

        @media (max-width: 1300px) {
            .article-test-content {
                max-width: 600px;
                padding: 48px;
            }

            .article-test-content h2 {
                font-size: 3rem;
            }

            .article-test-content p {
                font-size: 1rem;
                font-weight: 400;
            }

            .founder-img {
                max-width: 280px;
                right: 40px;
                top: -120px;
            }
        }

        @media (max-width: 600px) {
            .article-bg {
                padding-top: 50px;
            }

            .article-test {
                display: flex;
                flex-direction: column;
            }

            .founder-img {
                max-width: 100%;
                left: 0px;
                top: 80px;
            }

            .article-test {
                padding: 16px;
            }

            .article-test-content {
                place-self: flex-start;
                padding: 30px;
                right: 0;
            }

            .article-test-content::after {
                display: none;
            }

            .article-test-content h2 {
                text-align: center;
            }

            .article-test-content p {
                text-align: center;
            }

            .article-test-content a {
                justify-self: center;
            }
        }




    </style>
    <div class="">
        <div class="py-56 collection container mx-auto px-6">
            <h2 class="collection__heading font-fraunces font-bold">onze collectie</h2>
            <div class="flex flex-col justify-between items-center lg:flex-row lg:gap-5">
                <article
                    class="category rounded-md text-center mb-24 lg:mb-0 hover:text-orange-500 transition ease-lineair duration-100 cursor-pointer"
                    style="width: 350px; height: 165px; background-color: #f1f1f1">
                    <img
                        src="juweel2.png"
                        alt="Juwelen"
                        class="h-40 mx-auto" style="margin-top: -4rem"
                    />
                    <div class="text-center mb-6" style="margin-top: 1rem; z-index: 1">
                        <h3 class="mb-4 text-lg text-black uppercase font-bold tracking-wide">JUWELEN</h3>
                        <button class="border-none bg-transparent">
                            <a href="#" class="text-md uppercase opacity-50 mr-3.5">shop</a>
                          <img
                                class="inline-flex"
                                src="icon-arrow-right.svg"
                                alt="decoration"
                            />
                        </button>
                    </div>
                </article>

                <article
                    class="category rounded-md text-center mb-24 lg:mb-0 hover:text-orange-500 transition ease-lineair duration-100 cursor-pointer"
                    style="width: 350px; height: 165px; background-color: #f1f1f1">
                    <img
                        src="handtas.png"
                        alt="Juwelen"
                        class="h-40 mx-auto" style="margin-top: -4rem"
                    />
                    <div class="text-center mb-6" style="margin-top: 1rem; z-index: 1">
                        <h3 class="mb-4 text-lg text-black uppercase font-bold tracking-wide">HANDTASSEN</h3>
                        <button class="border-none bg-transparent">
                            <a href="#" class="text-md uppercase opacity-50 mr-3.5">shop</a>
                            <img
                                class="inline-flex"
                                src="icon-arrow-right.svg"
                                alt="decoration"
                            />
                        </button>
                    </div>
                </article>

                <article
                    class="category rounded-md text-center mb-24 lg:mb-0 hover:text-orange-500 transition ease-lineair duration-100 cursor-pointer"
                    style="width: 350px; height: 165px; background-color: #f1f1f1">
                    <img
                        src="sjaal.png"
                        alt="Juwelen"
                        class="h-40 mx-auto" style="margin-top: -4rem"
                    />
                    <div class="text-center mb-6" style="margin-top: 1rem; z-index: 1">
                        <h3 class="mb-4 text-lg text-black uppercase font-bold tracking-wide">SJAALS</h3>
                        <button class="border-none bg-transparent">
                            <a href="#" class="text-md uppercase opacity-50 mr-3.5">shop</a>
                            <img
                                class="inline-flex"
                                src="icon-arrow-right.svg"
                                alt="decoration"
                            />
                        </button>
                    </div>
                </article>

                <article
                    class="category rounded-md text-center mb-24 lg:mb-0 hover:text-orange-500 transition ease-lineair duration-100 cursor-pointer"
                    style="width: 350px; height: 165px; background-color: #f1f1f1">
                    <img
                        src="accesoires.png"
                        alt="Juwelen"
                        class="h-40 mx-auto" style="margin-top: -4rem"
                    />
                    <div class="text-center mb-6" style="margin-top: 1rem; z-index: 1">
                        <h3 class="mb-4 text-lg text-black uppercase font-bold tracking-wide">ACCESSOIRES</h3>
                        <button class="border-none bg-transparent">
                            <a href="#" class="text-md uppercase opacity-50 mr-3.5">shop</a>
                            <img
                                class="inline-flex"
                                src="icon-arrow-right.svg"
                                alt="decoration"
                            />
                        </button>
                    </div>
                </article>
            </div>
        </div>

        <div class="article-bg py-56 bg-gradient-to-r from-gray-200 to-gray-100 px-6" style="background-color: #f1f1f1">
            <article class="container mx-auto article-test rounded-2xl" style="background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <img
                    class="founder-img rounded-full grayscale"
                    src="evi.jpg"
                    alt="Founder"
                />
                <div class="article-test-content">
                    <h2 class="text-2xl uppercase" style="color: #d87d4a">OVER MIJ</h2>
                    <p class="body-font">
                        Hey, Ik ben Evi, een gepassioneerde ondernemer.
                        Negen jaar geleden begon ik met het maken van oorbellen voor mezelf en vriendinnen.
                        Nu heb ik mijn eigen winkeltje in Nijlen, waar ik handgemaakte juwelen, handtassen, sjaals en
                        accessoires aanbied.
                    </p>
                    <a href="{{ route('contact') }}">
                        <button class="uppercase inline-flex items-center py-2 px-3 border border-transparent max-w-fit font-medium rounded-md text-white button">Contacteer
                        me</button>
                    </a>

                </div>
            </article>
        </div>

        <div class="py-56 px-6">
            <div class="container mx-auto">
                <h2 class="text-6xl text-center font-bold uppercase tracking-wide mb-10" style="color: #191919">Wat
                    <span class="text-6xl font-bold uppercase tracking-wide" style="color: #d87d4a">klanten</span> over
                    ons zeggen!</h2>
                <script defer async src='https://cdn.trustindex.io/loader.js?da012b31728755457876c43ef5d'></script>
            </div>
        </div>

        {{--   <div class="py-56" style="background-color: #191919">
               <div class="flex">
                   <div>
                       <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10008.555710653318!2d4.6525878!3d51.1612281!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3fdfa62901f37%3A0xbabecdf719622913!2sSus%20%26%20Mus!5e0!3m2!1snl!2sbe!4v1689852783266!5m2!1snl!2sbe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                   </div>
                   <div>
                       <h2>Onze locatie</h2>
                       <p>Openingsuren</p>
                       <p>woe 10-17 u

                           do 18-20 u

                           vrij 13-17u

                           zat 10-17 u </p>
                   </div>
               </div>
           </div>--}}

        <footer class="py-12 text-white" style="background-color: #191919">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Onze locatie</h2>
                        <p>Koningsbaan 57</p>
                        <p>2560 Nijlen</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Openingsuren</h2>
                        <div class="flex justify-between mb-2">
                            <p>woe</p>
                            <p>10u00 - 17u00</p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p>do</p>
                            <p>18u00 - 20u00</p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p>vrij</p>
                            <p>13u00 - 17u00</p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p>zat</p>
                            <p>10u00 - 17u00</p>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Contact</h2>
                        <p class="mb-2">Email: info@susenmus.be</p>
                        <p>Telefoon: 0496/12 38 97</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Volg ons</h2>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/handgemaaktejuwelen/?locale=nl_BE"
                               class=" text-white hover:text-gray-400">
                                <i class="text-3xl fab fa-facebook"></i>
                            </a>
                            <a href="https://www.instagram.com/susenmus/" class="text-white hover:text-gray-400">
                                <i class="text-3xl fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
