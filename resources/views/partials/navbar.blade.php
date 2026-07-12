<nav class="navbar top-navbar shadow-sm px-4">

    <div class="container-fluid">

        <h5 class="mb-0">

            <!-- @yield('title') -->

        </h5>

        <div class="d-flex align-items-center">

            <span class="me-3">

                Halo,

                <strong>{{ auth()->user()->name }}</strong>

            </span>

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button class="btn btn-outline-danger btn-sm">

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>