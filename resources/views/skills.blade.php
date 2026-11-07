<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#070910">

    <title>Skills | Sunil Ratoki</title>

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
            background: rgba(255, 255, 255, .075);
            transform: translateY(-5px);
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

        .reveal {
            opacity: 0;
            transform: translateY(30px);
        }

        .tech-icon {
            transition: transform .4s ease;
        }

        .glass:hover .tech-icon {
            transform: scale(1.12) rotate(-5deg);
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

    <!-- EXISTING THREE.JS UNIVERSE BACKGROUND -->
    <div id="three-background" aria-hidden="true"></div>

    <div class="content-layer">

        <!-- NAVBAR -->
        <header class="fixed top-0 left-0 right-0 z-50 px-4 md:px-12 py-5">

            <nav class="glass max-w-7xl mx-auto rounded-2xl px-5 md:px-7 py-4 flex items-center justify-between">

                <a href="{{ route('home') }}" class="text-2xl font-black tracking-tight">
                    SR<span class="text-cyan-400">.</span>
                </a>

                <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                    <a href="{{ route('skills') }}" class="nav-link active">Skills</a>
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
            <section class="min-h-[75vh] flex items-center px-6 md:px-16 pt-40 pb-20">

                <div class="max-w-7xl mx-auto w-full">

                    <p class="text-cyan-400 tracking-[.4em] text-xs font-bold mb-7">
                        01 / MY TOOLKIT
                    </p>

                    <h1
                        class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-black tracking-tighter leading-[.9] reveal">
                        MY<br>
                        <span class="gradient-text">SKILLS.</span>
                    </h1>

                    <p class="text-slate-400 text-lg md:text-xl leading-8 max-w-2xl mt-9 reveal">
                        Technologies I'm exploring, tools I'm learning,
                        and the foundations I'm building to become a
                        better developer.
                    </p>

                </div>

            </section>


            <!-- DEVELOPMENT -->
            <section class="px-6 md:px-16 py-20">

                <div class="max-w-7xl mx-auto">

                    <div class="section-line mb-16"></div>

                    <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-5">
                        02 / DEVELOPMENT
                    </p>

                    <h2 class="text-4xl md:text-6xl font-bold mb-12 reveal">
                        My development <span class="gradient-text">stack.</span>
                    </h2>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-5">

                        @foreach ([['JavaScript', 'JS', 'text-yellow-300', 'Programming language'], ['PHP', 'PHP', 'text-indigo-300', 'Backend development'], ['Laravel', 'LV', 'text-red-400', 'PHP framework'], ['Tailwind CSS', 'TW', 'text-cyan-300', 'CSS framework'], ['SQL', 'DB', 'text-blue-300', 'Database language'], ['HTML & CSS', '</>', 'text-orange-300', 'Web fundamentals']] as $tech)
                            <div class="glass rounded-3xl p-6 md:p-8 reveal">

                                <div class="tech-icon text-4xl md:text-5xl font-black {{ $tech[2] }}">
                                    {{ $tech[1] }}
                                </div>

                                <h3 class="text-lg md:text-xl font-bold mt-7">
                                    {{ $tech[0] }}
                                </h3>

                                <p class="text-xs md:text-sm text-slate-500 mt-2">
                                    {{ $tech[3] }}
                                </p>

                            </div>
                        @endforeach

                    </div>

                </div>

            </section>


            <!-- TOOLS -->
            <section class="px-6 md:px-16 py-24">

                <div class="max-w-7xl mx-auto">

                    <div class="section-line mb-16"></div>

                    <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-5">
                        03 / DEVELOPER TOOLS
                    </p>

                    <h2 class="text-4xl md:text-6xl font-bold mb-12 reveal">
                        Tools behind the <span class="gradient-text">workflow.</span>
                    </h2>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div class="glass rounded-3xl p-8 reveal">

                            <div class="text-4xl text-orange-300 font-black">
                                Git
                            </div>

                            <h3 class="text-2xl font-bold mt-6">
                                Git & GitHub
                            </h3>

                            <p class="text-slate-400 leading-8 mt-4">
                                Exploring version control, repositories,
                                commits, branches, and collaborative
                                development workflows.
                            </p>

                        </div>


                        <div class="glass rounded-3xl p-8 reveal">

                            <div class="text-4xl text-cyan-300 font-black">
                                CLI
                            </div>

                            <h3 class="text-2xl font-bold mt-6">
                                Development Environment
                            </h3>

                            <p class="text-slate-400 leading-8 mt-4">
                                Working with VS Code, terminal commands,
                                Laravel development tools, and local
                                development environments.
                            </p>

                        </div>

                    </div>

                </div>

            </section>


            <!-- CYBERSECURITY -->
            <section class="px-6 md:px-16 py-24">

                <div class="max-w-7xl mx-auto">

                    <div class="section-line mb-16"></div>

                    <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-5">
                        04 / EXPLORING
                    </p>

                    <h2 class="text-4xl md:text-6xl font-bold mb-12 reveal">
                        Beyond <span class="gradient-text">development.</span>
                    </h2>

                    <div class="glass rounded-[2rem] p-8 md:p-12 reveal">

                        <div class="grid md:grid-cols-2 gap-10 items-center">

                            <div>

                                <div
                                    class="w-16 h-16 rounded-2xl bg-violet-400/10 border border-violet-400/20 flex items-center justify-center text-3xl text-violet-300">
                                    ◈
                                </div>

                                <h3 class="text-3xl font-bold mt-7">
                                    Cybersecurity
                                </h3>

                                <p class="text-slate-400 leading-8 mt-5">
                                    I'm interested in understanding how
                                    systems, networks, and web applications
                                    work securely.
                                </p>

                                <p class="text-slate-400 leading-8 mt-4">
                                    This is an area I'm actively exploring
                                    through foundational learning and
                                    authorized lab environments.
                                </p>

                            </div>

                            <div class="grid grid-cols-2 gap-4">

                                @foreach ([['Linux', '01'], ['Networking', '02'], ['Web Security', '03'], ['Ethical Learning', '04']] as $item)
                                    <div class="glass rounded-2xl p-5">

                                        <span class="text-xs text-cyan-400 tracking-widest">
                                            {{ $item[1] }}
                                        </span>

                                        <h4 class="font-semibold mt-4">
                                            {{ $item[0] }}
                                        </h4>

                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            <!-- LEARNING MINDSET -->
            <section class="px-6 md:px-16 py-24">

                <div class="max-w-5xl mx-auto">

                    <div class="section-line mb-16"></div>

                    <div class="glass rounded-[2rem] p-9 md:p-14 text-center reveal">

                        <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-7">
                            05 / ALWAYS LEARNING
                        </p>

                        <h2 class="text-3xl md:text-5xl font-bold leading-tight">
                            Skills aren't just
                            <span class="gradient-text">collected.</span>
                            They're built.
                        </h2>

                        <p class="text-slate-400 max-w-2xl mx-auto leading-8 mt-7">
                            My focus is on understanding concepts,
                            practising consistently, and turning
                            what I learn into real projects.
                        </p>

                    </div>

                </div>

            </section>


            <!-- PROJECTS CTA -->
            <section class="px-6 md:px-16 py-24">

                <div class="max-w-7xl mx-auto text-center">

                    <div class="section-line mb-16"></div>

                    <p class="text-cyan-400 text-xs tracking-[.35em] font-bold mb-6">
                        06 / PUTTING SKILLS INTO PRACTICE
                    </p>

                    <h2 class="text-4xl md:text-6xl font-black reveal">
                        SEE WHAT I'VE
                        <span class="gradient-text">BUILT.</span>
                    </h2>

                    <a href="{{ route('projects') }}"
                        class="inline-block mt-9 rounded-full bg-cyan-400 text-slate-950 px-9 py-4 font-bold hover:bg-cyan-300 transition">
                        Explore Projects ↗
                    </a>

                </div>

            </section>

        </main>


        <!-- FOOTER -->
        <footer class="px-6 md:px-16 pb-8">

            <div
                class="max-w-7xl mx-auto border-t border-white/10 pt-7 flex flex-col md:flex-row justify-between gap-4 text-sm text-slate-500">

              

            </div>

        </footer>

    </div>
    @include('footer')
</body>

</html>
