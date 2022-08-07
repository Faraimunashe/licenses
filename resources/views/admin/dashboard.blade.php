<x-app-layout>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
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
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Companies <span>count</span></h5>
                            <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="ps-3">
                                <h6>
                                    @php
                                        $companies = \App\Models\Company::where('status',1)->count();
                                        echo $companies;
                                    @endphp
                                </h6>
                            </div>
                            </div>
                        </div>

                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Registrations <span>count</span></h5>
                            <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-clipboard"></i>
                            </div>
                            <div class="ps-3">
                                <h6>
                                    @php
                                        $regs = \App\Models\Company::where('status', 0)->count();
                                        echo $regs;
                                    @endphp
                                </h6>
                            </div>
                            </div>
                        </div>

                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Transactions <span>count</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-coin"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            @php
                                                $trans = \App\Models\Transaction::count();
                                                echo $trans;
                                            @endphp
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right side column -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Recent Transactions
                            <span>| Today</span>
                        </h5>
                        <div class="activity">
                            @foreach ($transactions as $transaction)
                                <div class="activity-item d-flex">
                                    <div class="activite-label">
                                        {{ diff_in_time($transaction->created_at, now()) }}
                                    </div>
                                    @if ($transaction->status == "cancelled")
                                        <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                    @elseif ($transaction->status == "successful")
                                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    @else
                                        <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                    @endif

                                    <div class="activity-content">
                                        ${{ $transaction->amount }}<a href="#" class="fw-bold text-dark"> {{ $transaction->purpose }}</a> {{ $transaction->method }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
