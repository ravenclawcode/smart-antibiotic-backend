<div class="sidebar text-white">

    <div class="p-4">

        <h4 class="fw-bold mb-0">
            Smart Antibiotik
        </h4>

        <small class="text-white-50">
            Admin Dashboard
        </small>

    </div>

    <ul class="nav flex-column">

        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        <hr class="text-white">

        {{-- OBAT --}}
        <li class="px-3 text-white-50 small mb-2">
            OBAT
        </li>

        <li>

            <a href="{{ route('admin.medicine-catalog.index') }}"
                class="nav-link {{ request()->routeIs('admin.medicine-catalog.*') ? 'active' : '' }}">
                <i class="bi bi-capsule-pill me-2"></i>
                Katalog Antibiotik

            </a>

        </li>

        <hr class="text-white">

        {{-- EDUKASI --}}
        <li class="px-3 text-white-50 small mb-2">
            EDUKASI
        </li>

        <a href="{{ route('admin.categories.index') }}"
            class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="bi bi-grid me-2"></i>
            Kategori Antibiotik
        </a>

        <li>
            <a href="{{ route('admin.antibiotics.index') }}"
                class="nav-link {{ request()->routeIs('admin.antibiotics.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-medical me-2"></i>
                Detail Antibiotik
            </a>
        </li>

        <li>
            <a
                href="{{ route('admin.quizzes.index') }}"
                class="nav-link {{ request()->routeIs('admin.quizzes.*') || request()->routeIs('admin.quiz-questions.*') ? 'active' : '' }}">
                <i class="bi bi-patch-question me-2"></i>
                Kuis
            </a>
        </li>

        </li>

        <hr class="text-white">

        {{-- MONITORING --}}
        <li class="px-3 text-white-50 small mb-2">
            MONITORING
        </li>

        <li>
            <a
                href="{{ route('admin.users.index') }}"
                class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>
                Pengguna

            </a>
        </li>

        <li>
            <a
                href="{{ route('admin.medicines.index') }}"
                class="nav-link {{ request()->routeIs('admin.medicines.*') ? 'active' : '' }}">
                <i class="bi bi-clock-history me-2"></i>
                Riwayat Obat

            </a>
        </li>

        <li>
            <a href="#"
                class="nav-link">
                <i class="bi bi-chat-left-text me-2"></i>
                Komentar & Masukan
            </a>
        </li>

        <hr class="text-white">

        {{-- AI --}}
        <li class="px-3 text-white-50 small mb-2">
            AI
        </li>

        <li>
            <a href="#"
                class="nav-link">
                <i class="bi bi-robot me-2"></i>
                Chatbot Log
            </a>
        </li>

    </ul>

</div>