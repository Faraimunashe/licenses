<x-app-layout>
    <div class="pagetitle">
        <h1>Transactions</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Transaction</li>
            <li class="breadcrumb-item active">History</li>
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
                        <h5 class="card-title">Transactions <span> all</span></h5>
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table table-borderless datatable dataTable-table">
                                    <thead>
                                        <tr>
                                            <th scope="col" data-sortable="" style="width: 7.404%;">
                                                <a href="#" class="dataTable-sorter">#</a>
                                            </th>
                                            <th scope="col" data-sortable="" style="width: 15.404%;">
                                                <a href="#" class="dataTable-sorter">reference</a>
                                            </th>
                                            <th scope="col" data-sortable="" style="width: 15.4747%;">
                                                <a href="#" class="dataTable-sorter">Purpose</a>
                                            </th>
                                            <th scope="col" data-sortable="" style="width: 15.0202%;">
                                                <a href="#" class="dataTable-sorter">Method</a>
                                            </th>
                                            <th scope="col" data-sortable="" style="width: 13.8889%;">
                                                <a href="#" class="dataTable-sorter">Amount</a>
                                            </th>
                                            <th scope="col" data-sortable="">
                                                <a href="#" class="dataTable-sorter">Status</a>
                                            </th>
                                            <th scope="col" data-sortable="">
                                                <a href="#" class="dataTable-sorter">Date</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($transactions as $item)
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">
                                                        @php
                                                            $count++;
                                                            echo $count;
                                                        @endphp
                                                    </a>
                                                </th>
                                                <td>{{ $item->reference }}</td>
                                                <td>
                                                    <a href="#" class="text-primary">{{ $item->purpose }}</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-primary">{{ $item->method }}</a>
                                                </td>
                                                <td>${{ $item->amount }}</td>
                                                <td>
                                                    @if ($item->status == "successful" )
                                                        <span class="badge bg-success">{{ $item->status }}</span>
                                                    @elseif ($item->status == "cancelled" )
                                                        <span class="badge bg-danger">{{ $item->status }}</span>
                                                    @else
                                                        <span class="badge bg-warning">{{ $item->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="text-primary">{{ $item->created_at }}</a>
                                                </td>
                                            </tr>
                                        @endforeach
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
