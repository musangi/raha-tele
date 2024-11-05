<div class="container-fluid py-5 text-white">
    <div class="row align-items-center">
        <!-- Welcome Section -->
        <div class="col-md-5 text-center text-md-start px-5">
            <h1 class="display-4 fw-bold mb-3">
                Meet <u>singles</u> near you
            </h1>
            <h3>Start finding your match for <span class="text-warning">free</span> today!</h3>
            <p class="lead mt-4">Connect with like-minded individuals for dating, relationships, or more. Discover the
                possibilities around you!</p>
        </div>

        <!-- Search Section -->
        <div class="col-md-6 offset-md-1 mt-5 mt-md-0 p-4 bg-white rounded shadow-lg">
            <h4 class="text-center text-dark mb-4">Find Your Perfect Match</h4>
            <form>
                <!-- Specify Gender -->
                <div class="mb-4">
                    <label for="gender" class="form-label fw-semibold">I am</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-person-circle text-secondary"></i>
                        </span>
                        <select class="form-select" id="gender" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- Looking For -->
                <div class="mb-4">
                    <label for="lookingFor" class="form-label fw-semibold">Looking for</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-gender-ambiguous text-secondary"></i>
                        </span>
                        <select class="form-select" id="lookingFor" name="lookingFor">
                            <option value="male">A man</option>
                            <option value="female">A woman</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- Reason -->
                <div class="mb-4">
                    <label for="reason" class="form-label fw-semibold">Reason</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-heart text-danger"></i>
                        </span>
                        <select class="form-select" id="reason" name="reason">
                            <option value="dating">Dating</option>
                            <option value="marriage">Marriage</option>
                            <option value="partners">Partners</option>
                            <option value="fwb">FWBs</option>
                        </select>
                    </div>
                </div>

                <!-- Search Button -->
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    Find My Match <i class="bi bi-arrow-right-circle ms-2"></i>
                </button>
            </form>
        </div>
    </div>
</div>