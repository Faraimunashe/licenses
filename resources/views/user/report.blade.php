<x-app-layout>
    <div class="pagetitle">
        <h1>Company</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">License</li>
            <li class="breadcrumb-item active">Report</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Transaction Report</h5>
                        {!! $chart->container() !!}
                  </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
</x-app-layout>
