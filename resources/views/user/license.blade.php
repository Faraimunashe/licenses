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
          <div class="col-lg-9">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">License Report</h5>

                <!-- General Form Elements -->
                <form>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Company:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $company->name }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Address:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $company->address }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Registered On:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $company->created_at }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Registration Status:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ reg_status($registration->status) }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">License Status:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ license_status($license->status) }}" readonly>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->

              </div>
            </div>

          </div>
          <div class="col-lg-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Report Action</h5>
                <a href="{{ route('company-download-license') }}" class="btn btn-primary btn-block" type="button">
                    <i class="bi bi-download"></i>
                    Download License
                </a>
              </div>
            </div>

          </div>
        </div>
    </section>
</x-app-layout>
