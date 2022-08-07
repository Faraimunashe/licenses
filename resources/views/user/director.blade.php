<x-app-layout>
    <div class="pagetitle">
        <h1>Create A Company Director</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Company</li>
            <li class="breadcrumb-item active">Director</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Add Director</h5>
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
                <form action="{{ route('post-director') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="firstname" class="form-control" id="inputText" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="lastname" class="form-control" id="inputText" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">National ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="natid" class="form-control" id="inputText" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Director's Address</label>
                        <div class="col-sm-10">
                            <input type="text" name="address" class="form-control" id="inputText" required>
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Is Shareholders?</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shareholder" id="gridRadios1" value="1" required checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shareholder" id="gridRadios2" value="0" required>
                                <label class="form-check-label" for="gridRadios2">
                                    No
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End Horizontal Form -->
              </div>
            </div>
          </div>
        </div>
    </section>
</x-app-layout>
