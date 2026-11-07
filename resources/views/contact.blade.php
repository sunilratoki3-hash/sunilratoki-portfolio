<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#070910">

    <title>Contact | Sunil Ratoki</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: #070910;
            color: #f8fafc;
            font-family: Inter, ui-sans-serif, system-ui, sans-serif;
            overflow-x: hidden;
        }

        #three-background {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        #three-background canvas {
            display: block;
            width: 100%;
            height: 100%;
        }

        .content-layer {
            position: relative;
            z-index: 2;
        }

        .glass {
            background: rgba(255, 255, 255, .045);
            border: 1px solid rgba(255, 255, 255, .12);
            backdrop-filter: blur(24px) saturate(150%);
            -webkit-backdrop-filter: blur(24px) saturate(150%);
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, .08),
                0 20px 60px rgba(0, 0, 0, .2);
            transition: .35s ease;
        }

        .glass:hover {
            border-color: rgba(34, 211, 238, .4);
            background: rgba(255, 255, 255, .07);
        }

        .gradient-text {
            background: linear-gradient(100deg, #fff, #22d3ee, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .nav-link {
            color: #a1a1aa;
            transition: .3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #22d3ee;
        }

        .section-line {
            height: 1px;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(34, 211, 238, .45),
                    transparent);
        }

        .form-field {
            width: 100%;
            background: rgba(255, 255, 255, .04);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 14px;
            padding: 15px 17px;
            color: white;
            outline: none;
            transition: .3s ease;
        }

        .form-field:focus {
            border-color: rgba(34, 211, 238, .7);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, .08);
        }

        .form-field::placeholder {
            color: #64748b;
        }

        .form-field option {
            background: #070910;
            color: white;
        }

        .contact-card {
            transition: .35s ease;
        }

        .contact-card:hover {
            transform: translateY(-6px);
            border-color: rgba(34, 211, 238, .4);
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
        }

        @media (max-width: 767px) {
            .desktop-nav {
                display: none;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body>

    <div id="three-background" aria-hidden="true"></div>

    <div class="content-layer">

        <!-- NAVBAR -->
        <header class="fixed top-0 left-0 right-0 z-50 px-4 md:px-12 py-5">
            <nav class="glass max-w-7xl mx-auto rounded-2xl px-5 md:px-7 py-4 flex items-center justify-between">

                <!-- LOGO -->
                <a href="{{ route('home') }}" class="text-2xl font-black tracking-tight">
                    SR<span class="text-cyan-400">.</span>
                </a>

                <!-- NAVIGATION LINKS -->
                <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                    <a href="{{ route('skills') }}" class="nav-link">Skills</a>
                    <a href="{{ route('projects') }}" class="nav-link">Projects</a>
                    <a href="{{ route('contact') }}" class="nav-link active">Contact</a>
                </div>

                <!-- CTA BUTTON -->
                <a href="{{ route('contact') }}"
                    class="rounded-full bg-cyan-400 text-slate-950 px-5 py-2.5 text-sm font-bold hover:bg-cyan-300 transition">
                    Let's Talk ↗
                </a>

            </nav>
        </header>

        <main>

            <!-- HERO -->
            <section class="min-h-[65vh] flex items-center px-6 md:px-16 pt-40 pb-16">

                <div class="max-w-7xl mx-auto w-full">

                    <p class="text-cyan-400 tracking-[.4em] text-xs font-bold mb-7">
                        05 / GET IN TOUCH
                    </p>

                    <h1
                        class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-black tracking-tighter leading-[.9] reveal">
                        LET'S<br>
                        <span class="gradient-text">CONNECT.</span>
                    </h1>

                    <p class="text-slate-400 text-lg md:text-xl leading-8 max-w-2xl mt-9 reveal">
                        Have a project idea, a question, or just want to connect?
                        Feel free to reach out. I'd be glad to hear from you.
                    </p>

                </div>

            </section>


            <!-- CONTACT CONTENT -->
            <section class="px-6 md:px-16 py-16">

                <div class="max-w-7xl mx-auto">

                    <div class="section-line mb-16"></div>

                    <div class="grid lg:grid-cols-2 gap-10">

                        <!-- LEFT SIDE -->
                        <div class="reveal">

                            <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-5">
                                LET'S START A CONVERSATION
                            </p>

                            <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                                Got something<br>
                                <span class="gradient-text">in mind?</span>
                            </h2>

                            <p class="text-slate-400 leading-8 mt-7 max-w-lg">
                                I'm currently learning and building projects in
                                full-stack web development while exploring
                                cybersecurity. I'm interested in connecting
                                with people who enjoy technology and learning.
                            </p>

                            <div class="grid sm:grid-cols-2 gap-5 mt-10">

                                <div class="glass contact-card rounded-2xl p-6">
                                    <div class="text-2xl text-cyan-300">✉</div>
                                    <h3 class="font-bold mt-4">Email</h3>
                                    <p class="text-slate-500 text-sm mt-2">
                                        For general inquiries
                                    </p>
                                    <p class="text-cyan-300 text-sm mt-3">
                                        Add your email below
                                    </p>
                                </div>

                                <div class="glass contact-card rounded-2xl p-6">
                                    <div class="text-2xl text-violet-300">⌘</div>
                                    <h3 class="font-bold mt-4">Projects</h3>
                                    <p class="text-slate-500 text-sm mt-2">
                                        Web development and learning
                                    </p>
                                    <a href="{{ route('projects') }}" class="text-violet-300 text-sm mt-3 inline-block">
                                        View my projects ↗
                                    </a>
                                </div>

                            </div>

                            <div class="glass rounded-2xl p-6 mt-5">
                                <p class="text-slate-400 text-sm">
                                    CURRENTLY INTERESTED IN
                                </p>

                                <div class="flex flex-wrap gap-2 mt-4">
                                    <span
                                        class="rounded-full bg-cyan-400/10 border border-cyan-400/20 px-4 py-2 text-xs text-cyan-200">
                                        Full-Stack Development
                                    </span>

                                    <span
                                        class="rounded-full bg-violet-400/10 border border-violet-400/20 px-4 py-2 text-xs text-violet-200">
                                        Cybersecurity
                                    </span>

                                    <span
                                        class="rounded-full bg-blue-400/10 border border-blue-400/20 px-4 py-2 text-xs text-blue-200">
                                        Collaboration
                                    </span>
                                </div>
                            </div>

                        </div>



                        <!-- RIGHT SIDE FORM -->
                        <div id="contact-form" class="glass rounded-3xl p-7 md:p-10 reveal">

                            @if (session('success'))
                                <div
                                    class="mb-6 rounded-xl border border-green-400/30 bg-green-400/10 p-4 text-green-300">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="mb-6 rounded-xl border border-red-400/30 bg-red-400/10 p-4 text-red-300">
                                    <p class="font-bold mb-2">Please fix the following errors:</p>
                                    <ul class="list-disc pl-5 text-sm space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-4">
                                SEND A MESSAGE
                            </p>

                            <h2 class="text-3xl font-bold mb-8">
                                Let's talk.
                            </h2>

                            <form id="message-form" action="{{ route('contact.store') }}" method="POST"
                                class="space-y-6">
                                @csrf

                                <div>
                                    <label for="name" class="block text-sm text-slate-300 mb-2">Your Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        class="form-field" placeholder="Enter your name" required>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm text-slate-300 mb-2">Your Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="form-field" placeholder="Enter your email" required>
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm text-slate-300 mb-2">Contact Number
                                        (Optional)</label>

                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                        class="form-field" placeholder="Enter your contact number">
                                </div>

                                <div>
                                    <label for="address" class="block text-sm text-slate-300 mb-2">Permanent Address
                                        (Optional)</label>
                                    <input type="text" id="address" name="address" value="{{ old('address') }}"
                                        class="form-field" placeholder="Enter your permanent address">
                                </div>

                                <div>
                                    <label for="subject" class="block text-sm text-slate-300 mb-2">Subject</label>
                                    <input type="text" id="subject" name="subject"
                                        value="{{ old('subject') }}" class="form-field"
                                        placeholder="What would you like to discuss?" required>
                                </div>

                                <div>
                                    <label for="message" class="block text-sm text-slate-300 mb-2">Your
                                        Message</label>
                                    <textarea id="message" name="message" rows="5" class="form-field resize-none"
                                        placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                                </div>

                                <button type="submit"
                                    class="w-full rounded-full bg-cyan-400 text-slate-950 px-8 py-4 font-bold hover:bg-cyan-300 transition">
                                    Send Message ↗
                                </button>
                            </form>
                        </div>


                    </div>

            </section>


            <!-- CLOSING SECTION -->
            <section class="px-6 md:px-16 py-24">

                <div class="max-w-5xl mx-auto">

                    <div class="section-line mb-16"></div>

                    <div class="glass rounded-[4xl] p-9 md:p-14 text-center reveal">

                        <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-6">
                            THANK YOU FOR VISITING
                        </p>

                        <h2 class="text-4xl md:text-6xl font-black leading-tight">
                            KEEP LEARNING.
                            <span class="gradient-text">KEEP BUILDING.</span>
                        </h2>

                        <p class="text-slate-400 mt-7 leading-8">
                            Every connection starts with a conversation.
                        </p>

                        <a href="{{ route('home') }}"
                            class="inline-block mt-9 rounded-full border border-cyan-400/40 px-8 py-3 text-cyan-300 font-semibold hover:bg-cyan-400 hover:text-slate-950 transition">
                            Back to Home ↑
                        </a>

                    </div>

                </div>

            </section>

        </main>


        <!-- FOOTER -->
        <footer class="px-6 md:px-16 pb-8">

            <div
                class="max-w-7xl mx-auto border-t border-white/10 pt-7 flex flex-col md:flex-row justify-center gap-4 text-sm text-slate-500">

                <p>
                    © {{ date('Y') }} Sunil Ratoki. All rights reserved.
                </p>

            </div>

        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Message Sent!',
                text: @json(session('success')),
                confirmButtonText: 'OK',
                confirmButtonColor: '#22d3ee',
                background: '#0f172a',
                color: '#ffffff'
            });
        </script>
    @endif
</body>

</html>
