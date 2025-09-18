<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(45deg, #4e73df, #1cc88a);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: #1cc88a;
            border: none;
        }

        .btn-primary:hover {
            background: #17a673;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">
                            <i class="fas fa-user-plus"></i> Formulir Pendaftaran
                            <br>
                            PT. Achivon Prestasi Abadi
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?= site_url('registration/submit'); ?>" method="POST">
                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                    <select class="form-select" id="position" name="position" required onchange="showOtherInput()">
                                        <option value="" disabled selected>Select the desired position</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Developer">Developer</option>
                                        <option value="Designer">Designer</option>
                                        <option value="HR">HR</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3" id="otherPositionInput" style="display: none;">
                                <label for="other_position" class="form-label">Please specify the position</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    <input type="text" class="form-control" id="other_position" name="other_position" placeholder="Enter the position" />
                                </div>
                            </div>
                            <!-- Full Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                                </div>
                            </div>
                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i> Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center bg-light">
                        <small>Already have an account? <a href="<?= site_url('login'); ?>" class="text-primary">Login here</a>.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>


<script>
    function showOtherInput() {
        var positionSelect = document.getElementById("position");
        var otherPositionInput = document.getElementById("otherPositionInput");
        var otherPositionField = document.getElementById("other_position");

        if (positionSelect.value === "Other") {
            otherPositionInput.style.display = "block"; // Show the input field for "Other"
            otherPositionField.setAttribute("required", "required"); // Make it required
        } else {
            otherPositionInput.style.display = "none"; // Hide the input field for "Other"
            otherPositionField.removeAttribute("required"); // Remove required attribute
            otherPositionField.value = ""; // Clear the input field
        }
    }

    function validateForm() {
        var positionSelect = document.getElementById("position");
        var otherPositionField = document.getElementById("other_position");

        if (positionSelect.value === "Other" && !otherPositionField.value.trim()) {
            alert("Please specify the position if 'Other' is selected.");
            otherPositionField.focus();
            return false;
        }
        return true; // Allow form submission if validation passes
    }
</script>

</html>