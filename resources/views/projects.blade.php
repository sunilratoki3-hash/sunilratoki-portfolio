<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects | Sunil Ratoki</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #030712;
            color: #f8fafc;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        #three-background {
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;
        }

        .glass {
            background: rgba(255, 255, 255, 0.045);
            border: 1px solid rgba(255, 255, 255, 0.10);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .gradient-text {
            background: linear-gradient(100deg, #fff 15%, #67e8f9 55%, #818cf8 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .nav-link {
            color: #94a3b8;
            white-space: nowrap;
            transition: .3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #67e8f9;
        }

        .project-card {
            transition: transform .35s ease, border-color .35s ease, background .35s ease;
            min-width: 0;
        }

        .project-card:hover {
            transform: translateY(-6px);
            border-color: rgba(103, 232, 249, .4);
            background: rgba(255, 255, 255, .07);
        }

        .project-preview {
            background:
                radial-gradient(circle at 20% 20%, rgba(34, 211, 238, .18), transparent 35%),
                radial-gradient(circle at 80% 80%, rgba(99, 102, 241, .20), transparent 40%),
                #0b1222;
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
        }

        .tech-tag {
            background: rgba(103, 232, 249, .08);
            border: 1px solid rgba(103, 232, 249, .15);
            color: #a5f3fc;
        }

        @media (max-width: 640px) {
            .nav-links {
                gap: 12px;
                font-size: 11px;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body class="min-h-screen">

    <div id="three-background"></div>

    <!-- Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 px-4 md:px-12 py-5">

        <nav class="glass max-w-7xl mx-auto rounded-2xl px-5 md:px-7 py-4 flex items-center justify-between">

            <a href="{{ route('home') }}" class="text-2xl font-black tracking-tight">
                SR<span class="text-cyan-400">.</span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('about') }}" class="nav-link">About</a>
                <a href="{{ route('skills') }}" class="nav-link">Skills</a>
                <a href="{{ route('projects') }}" class="nav-link active">Projects</a>
                <a href="{{ route('contact') }}" class="nav-link">Contact</a>
            </div>

            <a href="{{ route('contact') }}"
                class="rounded-full bg-cyan-400 text-slate-950 px-5 py-2.5 text-sm font-bold hover:bg-cyan-300 transition">
                Let's Talk ↗
            </a>

        </nav>
    </header>

    <main class="mx-auto max-w-6xl px-6">

        <!-- Hero -->
        <section class="reveal flex min-h-[65vh] flex-col justify-center pt-32">

            <p class="mb-5 text-sm font-semibold tracking-[.35em] text-cyan-400">
                WHAT I'VE BEEN BUILDING
            </p>

            <h1 class="text-5xl font-black leading-tight md:text-7xl">
                MY <span class="gradient-text">PROJECTS.</span>
            </h1>

            <p class="mt-6 max-w-2xl text-base leading-8 text-slate-400 md:text-lg">
                A collection of projects I've built while learning web development.
                Each project helps me understand new technologies and improve my
                problem-solving skills.
            </p>

            <div class="mt-8 flex items-center gap-3 text-sm text-slate-500">
                <span class="h-2 w-2 rounded-full bg-cyan-400"></span>
                Learning by building, improving with every project.
            </div>

        </section>

        <!-- Projects -->
        <section class="pb-28">

            <div class="reveal mb-10">
                <p class="text-sm tracking-[.25em] text-cyan-400">
                    SELECTED WORK
                </p>

                <h2 class="mt-3 text-3xl font-bold md:text-4xl">
                    Things I've <span class="gradient-text">Created.</span>
                </h2>
            </div>

            <!-- Single Project Grid -->
            <div class="grid grid-cols-1 gap-7 md:grid-cols-2">

                @forelse ($projects as $index => $project)

                    <article class="project-card glass reveal overflow-hidden rounded-3xl flex flex-col">

                        <!-- Project Preview -->
                        <div
                            class="project-preview relative flex h-48 shrink-0 items-center justify-center overflow-hidden">

                            @if ($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                    class="h-full w-full object-cover">
                            @else
                                <div class="text-center px-6">
                                    <p class="text-3xl font-black gradient-text">
                                        {{ $project->title }}
                                    </p>

                                    <p class="mt-2 text-sm text-slate-400">
                                        Project Preview
                                    </p>
                                </div>
                            @endif

                            <span
                                class="absolute right-4 top-4 rounded-full border border-white/10 bg-black/60 px-3 py-1 text-xs text-slate-300">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>

                        </div>

                        <!-- Project Details -->
                        <div class="flex flex-1 flex-col p-5">

                            <div class="mb-3 flex flex-wrap items-center justify-between gap-2">

                                <span class="text-xs font-semibold tracking-widest text-cyan-400">
                                    {{ $project->is_featured ? 'FEATURED WORK' : 'PROJECT' }}
                                </span>

                                <span class="text-xs text-slate-500">
                                    {{ $project->is_featured ? 'Featured Project' : 'Personal Project' }}
                                </span>

                            </div>

                            <h3 class="text-xl font-bold md:text-2xl">
                                {{ $project->title }}
                            </h3>

                            <p class="mt-3 text-sm leading-6 text-slate-400">
                                {{ $project->description }}
                            </p>

                            <!-- Technologies -->
                            @if (!empty($project->technologies))
                                <div class="mt-4 flex flex-wrap gap-2">

                                    @foreach ($project->technologies as $technology)
                                        <span class="tech-tag rounded-full px-3 py-1 text-xs">
                                            {{ $technology }}
                                        </span>
                                    @endforeach

                                </div>
                            @endif

                            <!-- Links -->
                            <div class="mt-auto flex flex-wrap gap-5 border-t border-white/10 pt-4 mt-5">

                                @if ($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                                        class="text-sm font-medium text-cyan-400 hover:text-cyan-300 transition">
                                        GitHub ↗
                                    </a>
                                @endif

                                @if ($project->live_url)
                                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer"
                                        class="text-sm font-medium text-cyan-400 hover:text-cyan-300 transition">
                                        Live Demo ↗
                                    </a>
                                @endif

                                @if (!$project->github_url && !$project->live_url)
                                    <span class="text-sm text-slate-500">
                                        Links coming soon.
                                    </span>
                                @endif

                            </div>

                        </div>

                    </article>

                @empty

                    <div class="col-span-full glass rounded-3xl px-8 py-16 text-center">

                        <h3 class="text-2xl font-bold">
                            Projects Coming Soon.
                        </h3>

                        <p class="mt-4 text-slate-400">
                            I'm currently working on new projects. Check back soon!
                        </p>

                    </div>

                @endforelse

            </div>

        </section>

        <!-- CTA -->
        <section
            class="reveal mb-24 rounded-3xl border border-cyan-400/15 bg-cyan-400/5 px-7 py-12 text-center md:px-16">

            <p class="text-sm tracking-[.25em] text-cyan-400">
                WHAT'S NEXT?
            </p>

            <h2 class="mt-4 text-3xl font-bold md:text-4xl">
                More ideas. More <span class="gradient-text">building.</span>
            </h2>

            <p class="mx-auto mt-4 max-w-xl leading-7 text-slate-400">
                I'm continuously learning and working on new projects.
                Let's connect and build something meaningful.
            </p>

            <a href="{{ route('contact') }}"
                class="mt-8 inline-flex rounded-xl bg-cyan-400 px-7 py-3 font-semibold text-slate-950 transition hover:bg-cyan-300">
                Contact Me →
            </a>

        </section>

    </main>

    <!-- Footer -->
    @include('footer')

</body>

</html>

