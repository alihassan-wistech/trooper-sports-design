<?php include 'cta.php'; ?>
    <!-- 12. Footer -->
    <footer class="bg-black text-gray-300 pt-20 pb-10">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-16">
                <!-- Company Blurb -->
                <div class="lg:col-span-2">
                    <a href="/" class="flex items-center mb-6">
                        <img src="images/logo.png" alt="Troopers Sports logo" class="h-10 w-auto invert">
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
                        <li><a href="#" class="hover:text-white transition-colors">Shop Sportswear</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Capabilities</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
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

            <!-- Copyright -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">
                <p>&copy; 2026 Troopers Sports. All Rights Reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".hero-swiper", {
            loop: true,
            effect: "fade",
            fadeEffect: { crossFade: true },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            pagination: {
                el: ".hero-pagination",
                clickable: true
            }
        });

        new Swiper(".testimonial-swiper", {
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false
            },
            pagination: {
                el: ".testimonial-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".testimonial-next",
                prevEl: ".testimonial-prev"
            }
        });

        const mobileMenuToggle = document.getElementById("mobileMenuToggle");
        const mobileMenuPanel = document.getElementById("mobileMenuPanel");

        if (mobileMenuToggle && mobileMenuPanel) {
            mobileMenuToggle.addEventListener("click", () => {
                const isOpen = !mobileMenuPanel.classList.contains("hidden");
                mobileMenuPanel.classList.toggle("hidden", isOpen);
                mobileMenuToggle.setAttribute("aria-expanded", String(!isOpen));
            });

            mobileMenuPanel.querySelectorAll("a").forEach((link) => {
                link.addEventListener("click", () => {
                    mobileMenuPanel.classList.add("hidden");
                    mobileMenuToggle.setAttribute("aria-expanded", "false");
                });
            });
        }
    </script>
</body>
</html>