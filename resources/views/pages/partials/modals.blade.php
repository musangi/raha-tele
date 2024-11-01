<!-- LOGIN MODAL -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="loginForm" action="{{ route('login') }}" method="post">
                <div class="modal-body pb-0">
                    <h1 class="text-center m-0">Welcome</h1>
                    <p class="text-center m-0">Login to start your session</p>

                    @csrf

                    <div id="loginError" class="alert alert-danger d-none"></div>

                    <div class="form-group mb-2">
                        <label for="login-email">Email</label>
                        <input type="email" name="email" id="login-email" placeholder="Email"
                            class="form-control form-control-lg" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="login-password">Password</label>
                        <input type="password" name="password" id="login-password" placeholder="Password"
                            class="form-control form-control-lg" required>
                    </div>

                    <h6 class="text-center m-0">Don't have an account? <a href="#" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Join the Team</a></h6>

                </div>
                <div class="modal-footer border-0 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Exit Login</button>
                    <button type="submit" class="btn btn-warning">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- REGISTER MODAL -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="registerForm" action="{{ route('register') }}" method="post">
                <div class="modal-body pb-0">
                    <h1 class="text-center m-0">Account Creation</h1>
                    <p class="text-center m-0">Join millions of escort team</p>

                    @csrf

                    <div id="registerError" class="alert alert-danger d-none"></div>
                    <div id="registerSuccess" class="alert alert-success d-none"></div>

                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="Name" class="form-control form-control-lg"
                            required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email"
                            class="form-control form-control-lg" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="form-control form-control-lg" required autocomplete="new-password">
                    </div>
                    <div class="form-group mb-2">
                        <label for="password_confirmation">Password Confirmation</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Password Confirmation" class="form-control form-control-lg" required
                            autocomplete="new-password">
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Exit Registration</button>
                    <button type="submit" class="btn btn-warning">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle login form submission via AJAX
        $('#loginForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            let actionUrl = $(this).attr('action'); // Get the form action URL
            let formData = new FormData(this); // Create a new FormData object, passing the form element

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Prevent jQuery from setting the content-type header
                success: function(response) {
                    window.location.href = "/dashboard"
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Handle validation errors
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += '<p class="m-0">' + value[0] + '</p>';
                        });
                        $('#loginError').removeClass('d-none').html(errorHtml);
                    } else {
                        $('#loginError').removeClass('d-none').html(xhr.responseJSON.error ||
                            xhr.responseJSON.message ||
                            'There was an error processing the request.');
                    }
                }
            });
        });

        // Handle register form submission via AJAX
        $('#registerForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            let actionUrl = $(this).attr('action'); // Get the form action URL
            let formData = new FormData(this); // Create a new FormData object, passing the form element

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Prevent jQuery from setting the content-type header
                success: function(response) {
                    $('#registerSuccess').removeClass('d-none').text(response.message);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Handle validation errors
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += '<p class="m-0">' + value[0] + '</p>';
                        });
                        $('#registerError').removeClass('d-none').html(errorHtml);
                    } else {
                        $('#registerError').removeClass('d-none').html(xhr.responseJSON.error ||
                            xhr.responseJSON.message ||
                            'There was an error processing the request.');
                    }
                }
            });
        });
    });
</script>
@endpush