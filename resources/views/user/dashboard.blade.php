<x-app-layout>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-lg-12">
                <!-- Validation Errors -->
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
            </div>
          <div class="col-xl-4">
            @if ($company->status == 0)
                @if (is_null($registration))
                <div class="card" style="background-color: #db7f07">
                @else
                <div class="card" style="background-color: #2536c9">
                @endif
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <h2 style="color: white">Registration</h2>
                        <div class="social-links mt-2">
                            <a href="#" style="color: white" class="twitter">
                                <i class="bi bi-exclamation-diamond"></i>
                                pending
                            </a>
                        </div>
                        @if (is_null($registration))
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#payRegistration">
                                Pay Fee
                            </button>
                        @endif
                    </div>
                </div>

            @endif


            @if (is_null($license))
                <div class="card" style="background-color: rgb(17, 17, 17)">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <h2 style="color: white">Business License</h2>
                        <h3 style="color: white">Expiry</h3>
                        <div class="social-links mt-2">
                            <a href="#" style="color: whitesmoke" class="twitter">
                                <i class="bi bi-clock"></i>
                                N/A
                            </a>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#payLicense">
                                Pay Fee
                            </button>
                        </div>
                    </div>
                </div>
            @else
                @if (diff_minutes($license->expiry) > 0)
                    @if ($license->status == 0)
                        <div class="card" style="background-color: red">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <h2 style="color: white">Business License</h2>
                                <h3 style="color: white">Nullified</h3>
                                <div class="social-links mt-2">
                                    <a href="#" style="color: whitesmoke" class="twitter">
                                        <i class="bi bi-clock"></i>
                                        {{ $license->expiry }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card" style="background-color: rgb(4, 46, 4)">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <h2 style="color: white">Business License</h2>
                                <h3 style="color: white">Valid</h3>
                                <div class="social-links mt-2">
                                    <a href="#" style="color: whitesmoke" class="twitter">
                                        <i class="bi bi-clock"></i>
                                        {{ $license->expiry }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="card" style="background-color: red">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <h2 style="color: white">Business License</h2>
                            <h3 style="color: white">Expired</h3>
                            <div class="social-links mt-2">
                                <a href="#" style="color: whitesmoke" class="twitter">
                                    <i class="bi bi-clock"></i>
                                    {{ $license->expiry }}
                                </a>
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#payLicense">
                                    Pay Fee
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

          </div>

          <div class="col-xl-8">

            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Directors</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">

                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Business Details</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Name</div>
                      <div class="col-lg-9 col-md-8">{{ $company->name }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Address</div>
                      <div class="col-lg-9 col-md-8">{{ $company->address }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Objectives</div>
                      <div class="col-lg-9 col-md-8">{{ $company->objectives }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Started</div>
                      <div class="col-lg-9 col-md-8">{{ $company->created_at }}</div>
                    </div>
                  </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                        @foreach ($directors as $director)
                            <div>
                                <h4>{{ $director->firstname }} {{ $director->lastname }}</h4>
                                <h6>{{ $director->natid }}</h6>
                                <h6>{{ $director->address }}</h6>
                            </div>
                            <hr class="dropdown-divider">
                        @endforeach
                    </div>
                </div><!-- End Bordered Tabs -->

              </div>
            </div>

          </div>
        </div>
    </section>
    <!-- Large Modal -->
    <div class="modal fade" id="payRegistration" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('company-pay-registration') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Pay Registration Fee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Amount:</label>
                            <div class="col-sm-10">
                                <input type="text" name="amount" value="{{ $regfee->amount }}" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Mobile:</label>
                            <div class="col-sm-10">
                                <input type="tel" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Make payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Large Modal-->

    <!-- pay license Modal -->
    <div class="modal fade" id="payLicense" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('company-pay-license') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Pay License Fee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Amount:</label>
                            <div class="col-sm-10">
                                <input type="text" name="amount" value="{{ $licensefee->amount }}" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Mobile:</label>
                            <div class="col-sm-10">
                                <input type="tel" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Make payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End pay license Modal-->
</x-app-layout>
