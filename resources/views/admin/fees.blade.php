<x-app-layout>
    <div class="pagetitle">
        <h1>Fees</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Fees</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
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
            <div class="col-lg-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Companies <span> all</span></h5>
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table table-borderless datatable dataTable-table">
                                    <thead>
                                        <tr>
                                            <th scope="col" data-sortable="" >
                                                <a href="#" class="dataTable-sorter">#</a>
                                            </th>
                                            <th scope="col" data-sortable="" >
                                                <a href="#" class="dataTable-sorter">Name</a>
                                            </th>
                                            <th scope="col" data-sortable="" >
                                                <a href="#" class="dataTable-sorter">Amount</a>
                                            </th>
                                            <th scope="col" data-sortable="" >
                                                <a href="#" class="dataTable-sorter">Duration</a>
                                            </th>
                                            <th scope="col" data-sortable="">
                                                <a href="#" class="dataTable-sorter">Action</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">
                                                        1
                                                    </a>
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary">Registration Fees</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-primary">{{ $registration->amount }}</a>
                                                </td>
                                                <td>Indefinite</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">
                                                        <i class="bi bi-arrow-repeat"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">
                                                        2
                                                    </a>
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary">Licensing Fees</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-primary">{{ $license->amount }}</a>
                                                </td>
                                                <td>30 days</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">
                                                        <i class="bi bi-arrow-repeat"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="dataTable-bottom">
                                <div class="dataTable-info">

                                </div>
                                <nav class="dataTable-pagination">
                                    <ul class="dataTable-pagination-list"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-app-layout>
