<x-app-layout>
    <div class="pagetitle">
        <h1>Register A Company</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Company</li>
            <li class="breadcrumb-item active">Register</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Register Company</h5>
                    <x-auth-validation-errors class="alert alert-danger" :errors="$errors" />
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                <!-- Horizontal Form -->
                <form action="{{ route('company-register') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Company Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="inputText" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Company Address</label>
                        <div class="col-sm-10">
                            <input type="text" name="address" class="form-control" id="inputText" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Company Objectives</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="objectives" style="height: 200px" required></textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
                <!-- End Horizontal Form -->
              </div>
            </div>
          </div>
        </div>
    </section>
</x-app-layout>
