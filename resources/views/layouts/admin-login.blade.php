<div class="page-wrapper d-flex justify-content-center" style="margin: auto">

    <div class="row d-flex justify-content-center">

        <div class="col-md-6 grid-margin stretch-card" style="max-width: 508px;">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Log-in Here</h4>
                    <form class="forms-sample" method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="email" class="form-label"> Email Address/Username</label>
                                <input type="email" class="form-control" name="email" id="email" autocomplete="off"
                                    placeholder="">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="password" class="form-label"> Password</label>
                                <input type="password" class="form-control" name="password" id="password" autocomplete="off"
                                    placeholder="">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">
                                    Log-In
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
