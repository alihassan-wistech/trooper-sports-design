    <!-- 12. Footer -->
    <footer class="bg-black text-gray-300 pt-20 pb-10">
        <div class="px-6 lg:px-12 max-w-[1440px] mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-16">
                <!-- Company Blurb -->
                <div class="lg:col-span-2">
                    <a href="{{ route('home') }}" class="flex items-center mb-6">
                        <img src="{{ asset('images/logo.png') }}" alt="Troopers Sports logo" class="h-10 w-auto invert">
                    </a>
                    <p class="text-gray-400 leading-relaxed max-w-md">
                        <strong>Troopers Sports – Sialkot, Pakistan</strong><br><br>
                        Direct manufacturer & exporter of premium custom sportswear, team wear, fitness apparel and American football gear since 2018. 25,000 units/month capacity. 2-week turnaround.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold text-[18px] mb-6">Quick Links</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="{{ route('home') }}#what-we-build" class="hover:text-white transition-colors">Shop Sportswear</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="{{ route('home') }}#our-process" class="hover:text-white transition-colors">Capabilities</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Block -->
                <div>
                    <h4 class="text-white font-bold text-[18px] mb-6">Contact Us</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex gap-3">
                            <span class="font-bold text-white">WhatsApp:</span>
                            <a href="https://wa.me/923418649479" class="hover:text-white transition-colors">0341 8649479</a>
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-white">Email:</span>
                            <a href="mailto:sales@trooperssports.com" class="hover:text-white transition-colors">sales@trooperssports.com</a>
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-white">Address:</span>
                            <span>Rahim pur Khichian, Sialkot, Punjab 51310, Pakistan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 pt-8">
            <div class="px-6 lg:px-12 max-w-[1440px] mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">
                <p>&copy; 2026 Troopers Sports. All Rights Reserved.</p>
                <div class="flex gap-6">
                    <a href="{{ route('contact') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="{{ route('contact') }}" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
