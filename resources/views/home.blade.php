<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#070910">

    <title>Sunil Ratoki | Full-Stack Developer</title>

    <meta name="description"
        content="Sunil Ratoki — Full-Stack Developer exploring modern web development, Laravel, JavaScript, and cybersecurity.">

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
            white-space: nowrap;
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

        .project-card {
            transition: transform .35s ease, border-color .35s ease;
        }

        .project-card:hover {
            transform: translateY(-8px);
            border-color: rgba(34, 211, 238, .4);
        }

        .tech-pill {
            transition: .3s ease;
        }

        .tech-pill:hover {
            border-color: rgba(34, 211, 238, .5);
            color: #67e8f9;
            transform: translateY(-3px);
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

    <!-- THREE.JS BACKGROUND -->
    <div id="three-background" aria-hidden="true"></div>

    <div class="content-layer">

        <!-- NAVBAR -->
        <header class="fixed top-0 left-0 right-0 z-50 px-4 md:px-12 py-5">

            <nav class="glass max-w-7xl mx-auto rounded-2xl px-5 md:px-7 py-4 flex items-center justify-between">

                <a href="{{ route('home') }}" class="text-2xl font-black tracking-tight">
                    SR<span class="text-cyan-400">.</span>
                </a>

                <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="nav-link active">Home</a>
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                    <a href="{{ route('skills') }}" class="nav-link">Skills</a>
                    <a href="{{ route('projects') }}" class="nav-link">Projects</a>
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                </div>

                <a href="{{ route('contact') }}"
                    class="rounded-full bg-cyan-400 text-slate-950 px-5 py-2.5 text-sm font-bold hover:bg-cyan-300 transition">
                    Let's Talk ↗
                </a>

            </nav>
        </header>


        <main>

            <!-- HERO -->
            <section class="min-h-screen flex items-center px-6 md:px-16 pt-36 pb-20">

                <div class="max-w-7xl mx-auto w-full">

                    <div class="grid lg:grid-cols-[1.2fr_.8fr] gap-12 items-center">

                        <!-- HERO TEXT -->
                        <div>

                            <div class="inline-flex items-center gap-3 glass rounded-full px-4 py-2 mb-9 reveal">

                                <span class="relative flex h-2.5 w-2.5">
                                    <span
                                        class="absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-50 animate-ping"></span>
                                    <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-cyan-400"></span>
                                </span>

                                <span class="text-xs sm:text-sm text-slate-300">
                                    BSc CSIT Student · Full-Stack Developer
                                </span>

                            </div>

                            <p class="text-cyan-400 tracking-[.35em] text-xs font-bold mb-6 reveal">
                                HELLO, I'M SUNIL RATOKI
                            </p>

                            <h1
                                class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-black tracking-tighter leading-[.88] reveal">
                                FULL-STACK<br>
                                <span class="gradient-text">DEVELOPER.</span>
                            </h1>

                            <h2 class="text-xl md:text-2xl font-semibold text-slate-200 mt-8 reveal">
                                Building ideas into meaningful digital experiences.
                            </h2>

                            <p class="text-slate-400 text-base md:text-lg leading-8 max-w-2xl mt-5 reveal">
                                I'm a Full-Stack Developer focused on creating modern,
                                responsive, and user-friendly web applications. I work
                                with Laravel, PHP, JavaScript, Tailwind CSS, and SQL
                                to turn ideas into functional digital solutions.
                                Alongside web development, I'm exploring Cybersecurity
                                and secure application design through hands-on projects.
                            </p>

                            <!-- HERO BUTTONS -->
                            <div class="flex flex-wrap gap-4 mt-9 reveal">

                                <a href="{{ route('contact') }}"
                                    class="rounded-full bg-cyan-400 text-slate-950 px-8 py-4 font-bold hover:bg-cyan-300 transition">
                                    Let's Work Together ↗
                                </a>

                                <a href="{{ route('projects') }}"
                                    class="rounded-full border border-white/15 bg-white/5 px-8 py-4 font-semibold text-white hover:border-cyan-400/50 hover:text-cyan-300 transition">
                                    View Projects →
                                </a>

                            </div>

                            <!-- QUICK DETAILS -->
                            <div class="flex flex-wrap gap-x-8 gap-y-4 mt-12 text-sm text-slate-400 reveal">

                                <div class="flex items-center gap-2">
                                    <span class="text-cyan-400">✦</span>
                                    Full-Stack Development
                                </div>

                                <div class="flex items-center gap-2">
                                    <span class="text-violet-400">✦</span>
                                    Cybersecurity
                                </div>

                                <div class="flex items-center gap-2">
                                    <span class="text-blue-400">✦</span>
                                    Continuous Learning
                                </div>

                            </div>

                        </div>


                        <!-- HERO VISUAL -->
                        <div class="relative hidden lg:flex items-center justify-center reveal">

                            <div class="absolute w-80 h-80 rounded-full bg-cyan-400/10 blur-[100px]"></div>

                            <div class="glass relative rounded-[2rem] p-8 w-full max-w-md">

                                <div class="flex items-center justify-between mb-8">

                                    <div class="flex gap-2">
                                        <span class="w-3 h-3 rounded-full bg-red-400/80"></span>
                                        <span class="w-3 h-3 rounded-full bg-yellow-400/80"></span>
                                        <span class="w-3 h-3 rounded-full bg-green-400/80"></span>
                                    </div>

                                    <span class="text-xs text-slate-500 font-mono">
                                        developer.js
                                    </span>

                                </div>

                                <div class="font-mono text-sm leading-8">

                                    <p class="text-slate-500">// A little about me</p>

                                    <p class="mt-3">
                                        <span class="text-violet-300">const</span>
                                        <span class="text-cyan-300"> developer</span>
                                        <span class="text-white"> = {</span>
                                    </p>

                                    <p class="pl-5">
                                        <span class="text-slate-300">name:</span>
                                        <span class="text-emerald-300"> "Sunil Ratoki"</span>,
                                    </p>

                                    <p class="pl-5">
                                        <span class="text-slate-300">role:</span>
                                        <span class="text-emerald-300"> "Full-Stack Developer"</span>,
                                    </p>

                                    <p class="pl-5">
                                        <span class="text-slate-300">stack:</span>
                                        <span class="text-emerald-300"> ["Laravel", "PHP", "JS"]</span>,
                                    </p>

                                    <p class="pl-5">
                                        <span class="text-slate-300">interests:</span>
                                        <span class="text-emerald-300"> ["Web", "Security"]</span>,
                                    </p>

                                    <p class="pl-5">
                                        <span class="text-slate-300">mindset:</span>
                                        <span class="text-emerald-300"> "Always learning"</span>
                                    </p>

                                    <p class="text-white">};</p>

                                </div>

                                <div class="section-line my-7"></div>

                                <div class="flex items-center justify-between">

                                    <div>
                                        <p class="text-xs text-slate-500">CURRENT FOCUS</p>
                                        <p class="text-sm font-semibold text-cyan-300 mt-2">
                                            Building better applications
                                        </p>
                                    </div>

                                    <div
                                        class="w-12 h-12 rounded-xl bg-cyan-400/10 border border-cyan-400/20 flex items-center justify-center text-cyan-300 text-xl">
                                        &lt;/&gt;
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            <!-- TECHNOLOGY STACK -->
            <section class="px-6 md:px-16 py-16">

                <div class="max-w-7xl mx-auto">

                    <div class="section-line mb-14"></div>

                    <div class="text-center reveal">

                        <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-5">
                            TECHNOLOGIES I WORK WITH
                        </p>

                        <h2 class="text-3xl md:text-5xl font-bold">
                            My development <span class="gradient-text">toolkit.</span>
                        </h2>

                        <p class="text-slate-400 max-w-2xl mx-auto mt-5 leading-7">
                            Technologies I'm learning and using to build practical
                            web development projects.
                        </p>

                    </div>

                    <div class="flex flex-wrap justify-center gap-3 mt-12 reveal">

                        <span class="tech-pill glass rounded-full px-6 py-3 text-sm text-slate-200">Laravel</span>
                        <span class="tech-pill glass rounded-full px-6 py-3 text-sm text-slate-200">PHP</span>
                        <span class="tech-pill glass rounded-full px-6 py-3 text-sm text-slate-200">JavaScript</span>
                        <span class="tech-pill glass rounded-full px-6 py-3 text-sm text-slate-200">Tailwind CSS</span>
                        <span class="tech-pill glass rounded-full px-6 py-3 text-sm text-slate-200">SQL</span>
                        <span class="tech-pill glass rounded-full px-6 py-3 text-sm text-slate-200">HTML & CSS</span>
                        <span class="tech-pill glass rounded-full px-6 py-3 text-sm text-slate-200">Git</span>
                        <span class="tech-pill glass rounded-full px-6 py-3 text-sm text-slate-200">GitHub</span>

                    </div>

                </div>

            </section>


            <!-- FEATURED PROJECTS -->
            <section class="px-6 md:px-16 py-24">

                <div class="max-w-7xl mx-auto">

                    <div class="section-line mb-16"></div>

                    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-8">

                        <div class="reveal">

                            <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-5">
                                SELECTED WORK
                            </p>

                            <h2 class="text-4xl md:text-6xl font-bold leading-tight">
                                Projects that<br>
                                <span class="gradient-text">reflect my journey.</span>
                            </h2>

                        </div>

                        <a href="{{ route('projects') }}"
                            class="text-cyan-300 font-semibold hover:text-white transition reveal">
                            View All Projects ↗
                        </a>

                    </div>


                    <div class="grid md:grid-cols-2 gap-6 mt-14">

                        <!-- PROJECT ONE -->
                        <div class="project-card glass rounded-3xl p-8 md:p-10 reveal">

                            <div class="flex items-center justify-between">

                                <span class="text-xs tracking-[.25em] font-bold text-cyan-300">
                                    PROJECT 01
                                </span>

                                <span class="text-slate-500 text-sm">
                                    Frontend Practice
                                </span>

                            </div>

                            <div
                                class="rounded-2xl bg-gradient-to-br from-red-500/10 via-orange-400/5 to-transparent border border-white/10 h-48 flex items-center justify-center mt-8">

                                <div class="text-center">
                                    <div class="text-5xl font-black tracking-tight">
                                        <span class="text-red-400">Z</span>
                                        <span class="text-white">omato</span>
                                    </div>

                                    <p class="text-xs text-slate-500 tracking-[.3em] mt-3">
                                        FOOD DISCOVERY
                                    </p>
                                </div>

                            </div>

                            <h3 class="text-2xl font-bold mt-8">
                                Zomato Clone
                            </h3>

                            <p class="text-slate-400 leading-7 mt-4">
                                A frontend practice project inspired by food
                                discovery platforms, focused on responsive
                                layouts and interactive user interfaces.
                            </p>

                            <div class="flex flex-wrap gap-2 mt-6">

                                <span
                                    class="rounded-full bg-white/5 border border-white/10 px-3 py-2 text-xs text-slate-300">HTML</span>
                                <span
                                    class="rounded-full bg-white/5 border border-white/10 px-3 py-2 text-xs text-slate-300">CSS</span>
                                <span
                                    class="rounded-full bg-white/5 border border-white/10 px-3 py-2 text-xs text-slate-300">JavaScript</span>

                            </div>

                            <a href="{{ route('projects') }}"
                                class="inline-block text-cyan-300 font-semibold mt-8 hover:text-white transition">
                                Explore Project →
                            </a>

                        </div>


                        <!-- PROJECT TWO -->
                        <div class="project-card glass rounded-3xl p-8 md:p-10 reveal">

                            <div class="flex items-center justify-between">

                                <span class="text-xs tracking-[.25em] font-bold text-violet-300">
                                    PROJECT 02
                                </span>

                                <span class="text-slate-500 text-sm">
                                    Full-Stack Practice
                                </span>

                            </div>

                            <div
                                class="rounded-2xl bg-gradient-to-br from-violet-500/10 via-blue-400/5 to-transparent border border-white/10 h-48 flex items-center justify-center mt-8">

                                <div class="text-center">

                                    <div class="text-5xl font-black tracking-tight">
                                        <span class="text-violet-300">Course</span>
                                        <span class="text-white">Hub</span>
                                    </div>

                                    <p class="text-xs text-slate-500 tracking-[.3em] mt-3">
                                        COURSE MANAGEMENT
                                    </p>

                                </div>

                            </div>

                            <h3 class="text-2xl font-bold mt-8">
                                Course Management System
                            </h3>

                            <p class="text-slate-400 leading-7 mt-4">
                                A Laravel-based application for managing course
                                records, with CRUD functionality and a clean
                                interface built using Tailwind CSS.
                            </p>

                            <div class="flex flex-wrap gap-2 mt-6">

                                <span
                                    class="rounded-full bg-white/5 border border-white/10 px-3 py-2 text-xs text-slate-300">Laravel</span>
                                <span
                                    class="rounded-full bg-white/5 border border-white/10 px-3 py-2 text-xs text-slate-300">PHP</span>
                                <span
                                    class="rounded-full bg-white/5 border border-white/10 px-3 py-2 text-xs text-slate-300">SQL</span>
                                <span
                                    class="rounded-full bg-white/5 border border-white/10 px-3 py-2 text-xs text-slate-300">Tailwind
                                    CSS</span>

                            </div>

                            <a href="{{ route('projects') }}"
                                class="inline-block text-violet-300 font-semibold mt-8 hover:text-white transition">
                                Explore Project →
                            </a>

                        </div>

                    </div>

                </div>

            </section>


            <!-- ABOUT PREVIEW -->
            <section class="px-6 md:px-16 py-24">

                <div class="max-w-7xl mx-auto">

                    <div class="section-line mb-16"></div>

                    <div class="grid lg:grid-cols-2 gap-12 items-center">

                        <div class="reveal">

                            <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-5">
                                A LITTLE ABOUT ME
                            </p>

                            <h2 class="text-4xl md:text-6xl font-bold leading-tight">
                                Curious by nature.<br>
                                <span class="gradient-text">Driven to build.</span>
                            </h2>

                        </div>

                        <div class="glass rounded-3xl p-8 md:p-10 reveal">

                            <p class="text-slate-300 leading-8">
                                I'm a BSc CSIT student at Maharishi College,
                                affiliated with Far Western University.
                                My interests include full-stack development,
                                modern web technologies, and cybersecurity.
                            </p>

                            <p class="text-slate-400 leading-8 mt-5">
                                I enjoy learning by building, understanding
                                how applications work behind the scenes,
                                and improving through practical experience.
                            </p>

                            <a href="{{ route('about') }}"
                                class="inline-block mt-8 text-cyan-300 font-semibold hover:text-white transition">
                                More About Me ↗
                            </a>

                        </div>

                    </div>

                </div>

            </section>


            <!-- FINAL CTA -->
            <section class="px-6 md:px-16 py-24">

                <div class="max-w-5xl mx-auto">

                    <div class="section-line mb-16"></div>

                    <div class="glass rounded-[2rem] p-9 md:p-16 text-center reveal">

                        <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-7">
                            HAVE AN IDEA?
                        </p>

                        <h2 class="text-4xl md:text-6xl font-black leading-tight">
                            LET'S BUILD<br>
                            <span class="gradient-text">SOMETHING GREAT.</span>
                        </h2>

                        <p class="text-slate-400 mt-7 leading-8 max-w-2xl mx-auto">
                            Have a project idea, want to collaborate, or simply
                            want to connect? I'd love to hear from you.
                        </p>

                        <div class="flex flex-wrap justify-center gap-4 mt-9">

                            <a href="{{ route('contact') }}"
                                class="rounded-full bg-cyan-400 text-slate-950 px-8 py-4 font-bold hover:bg-cyan-300 transition">
                                Get In Touch ↗
                            </a>

                            <a href="{{ route('projects') }}"
                                class="rounded-full border border-white/15 px-8 py-4 font-semibold text-white hover:border-cyan-400/50 hover:text-cyan-300 transition">
                                Explore Projects
                            </a>

                        </div>

                    </div>

                </div>

            </section>

        </main>


        <!-- FOOTER -->
        <footer class="px-6 md:px-16 pb-8">

            <div
                class="max-w-7xl mx-auto border-t border-white/10 pt-7 flex flex-col md:flex-row justify-between gap-4 text-sm text-slate-500">



            </div>
            @include('footer')

        </footer>

    </div>

</body>

</html>
