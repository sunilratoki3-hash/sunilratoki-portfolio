<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Footer</title>
    <style>
        .social-link {
            display: inline-flex;
            padding: 10px 16px;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 999px;
            color: #cbd5e1;
            font-size: 13px;
            transition: .3s ease;
        }

        .social-link:hover {
            color: #22d3ee;
            border-color: rgba(34, 211, 238, .5);
            transform: translateY(-3px);
        }
    </style>
</head>

<body>

    <footer class="px-6 md:px-16 pt-16 pb-8">
        <div class="max-w-7xl mx-auto">

            <div class="glass rounded-3xl p-8 md:p-12">

                <div class="grid md:grid-cols-2 gap-10">

                    <!-- BRAND -->
                    <div>


                        <p class="text-slate-400 leading-7 mt-5 max-w-md">
                            Building ideas into meaningful digital experiences.
                            Exploring full-stack development and cybersecurity.
                        </p>
                    </div>

                    <!-- SOCIAL LINKS -->
                    <div>
                        <h3 class="text-lg font-bold mb-5">
                            Connect With Me
                        </h3>

                        <div class="flex flex-wrap gap-3">

                            <a href="https://www.instagram.com/sunilchhetrii3/" target="_blank"
                                rel="noopener noreferrer" class="social-link">Instagram ↗</a>

                            <a href="https://www.facebook.com/profile.php?id=61578550240858" target="_blank"
                                rel="noopener noreferrer" class="social-link">Facebook ↗</a>

                            <a href="https://www.tiktok.com/@sunil.chhetri122?lang=en" target="_blank"
                                rel="noopener noreferrer" class="social-link">TikTok ↗</a>

                            <a href="https://github.com/sunilratoki3-hash" target="_blank" rel="noopener noreferrer"
                                class="social-link">GitHub ↗</a>

                            <a href="https://www.linkedin.com/in/sunil-ratoki-669823344/" target="_blank"
                                rel="noopener noreferrer" class="social-link">LinkedIn ↗</a>

                        </div>

                        <!-- CONTACT BUTTONS -->
                        <div class="flex flex-wrap gap-3 mt-6">

                            <a href="https://wa.me/9705027656?text=Hello%20Sunil%2C%20I%20visited%20your%20portfolio."
                                target="_blank" rel="noopener noreferrer"
                                class="rounded-full bg-green-500 text-white px-5 py-3 text-sm font-bold hover:bg-green-400 transition">
                                WhatsApp Me ↗
                            </a>
                            <a href="mailto:sunilratoki3@gmail.com?subject=Portfolio%20Inquiry&body=Hello%20Sunil,"
                                class="rounded-full bg-violet-500 text-white px-5 py-3 text-sm font-bold hover:bg-violet-400 transition">
                                Mail Me ↗
                            </a>
                            <a href="tel:+9779705027656"
                                class="rounded-full bg-cyan-400 text-slate-950 px-5 py-3 text-sm font-bold hover:bg-cyan-300 transition">
                                Call Me ↗
                            </a>

                        </div>
                    </div>

                </div>

                <div class="section-line my-9"></div>

                <div class="flex flex-col md:flex-row justify-center gap-4 text-sm text-slate-500">
                    <p>© {{ date('Y') }} Sunil Ratoki. All rights reserved.</p>
                </div>

            </div>
        </div>
    </footer>

</body>

</html>
