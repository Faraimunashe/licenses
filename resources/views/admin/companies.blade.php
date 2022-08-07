<x-app-layout>
    <div class="pagetitle">
        <h1>Companies</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Companies</li>
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
                                                <a href="#" class="dataTable-sorter">Address</a>
                                            </th>
                                            <th scope="col" data-sortable="" >
                                                <a href="#" class="dataTable-sorter">License</a>
                                            </th>
                                            <th scope="col" data-sortable="" >
                                                <a href="#" class="dataTable-sorter">Expiry</a>
                                            </th>
                                            <th scope="col" data-sortable="">
                                                <a href="#" class="dataTable-sorter">Action</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($companies as $item)
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">
                                                        @php
                                                            $count++;
                                                            echo $count;
                                                        @endphp
                                                    </a>
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary">{{ $item->name }}</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-primary">{{ $item->address }}</a>
                                                </td>
                                                <td>
                                                    @php
                                                        $license = \App\Models\License::where('company_id', $item->id)->first();
                                                        if(is_null($license)){
                                                            echo "not licensed";
                                                        }else{
                                                            if($license->status == 0){
                                                                echo "not licensed";
                                                            }else{
                                                                echo "licensed";
                                                            }
                                                        }

                                                    @endphp
                                                </td>
                                                <td>
                                                    @if (is_null($license))
                                                        <span class="badge bg-warning">N/A</span>
                                                    @else
                                                        @if (diff_minutes($license->expiry, now()) > 0)
                                                            <span class="badge bg-success">{{ $license->expiry }}</span>
                                                        @else
                                                            <span class="badge bg-danger">{{ $license->expiry }}</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
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
