<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'htmlhead.php'; ?>
        <title>Candidate Reference Form</title>
    </head>

    <body>
        <?php include 'header.php'; ?>

        <div class="container my-4 fade-in slide-up">
            <div class="card p-4">
                <p>
                    <h6>Cand. Number : </h6>
                    <h6>Cand. Name : </h6>
                </p>
                <p>Thank you for your interest in joining the Allied Recruitment team.</p>
                <p>To support your application for work, please provide contact details for a minimum of <span class="red">two referees</span> who have supervised you at work in the last two years.</p>
                <p>If you have had more than one job in the last two years, please list referees from your most recent jobs, going back in order until your past two years of work history are covered.</p>
                <p>We only accept work references from direct supervisor or managers who have overseen your work. Please do not nominate a friend, co-worker, or family member.</p>

                <form id="mainForm" novalidate>
                    <!-- Referee One -->
                    <h3 class="mt-4">Referee One <span class="red">*</span></h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Associate company</label>
                            <input required class="form-control" type="text" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Your role</label>
                            <input required class="form-control" type="text" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Start date</label>
                            <input required class="form-control" type="date" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">End date</label>
                            <input required class="form-control" type="date" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's full name</label>
                            <input required class="form-control" type="text" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's job title</label>
                            <input required class="form-control" type="text" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's email</label>
                            <input required class="form-control" type="email" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's number</label>
                            <input required class="form-control" type="text" />
                        </div>

                        <div class="col-12">
                            <label class="form-label">Referee's relationship to candidate (e.g., Direct manager)</label>
                            <input required class="form-control" type="text" />
                        </div>
                    </div>

                    <!-- Referee Two -->
                    <h3 class="mt-5">Referee Two <span class="red">*</span></h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Associate company</label>
                            <input required class="form-control" type="text" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Your role</label>
                            <input required class="form-control" type="text" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Start date</label>
                            <input required class="form-control" type="date" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">End date</label>
                            <input required class="form-control" type="date" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's full name</label>
                            <input required class="form-control" type="text" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's job title</label>
                            <input required class="form-control" type="text" />
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Referee's email</label>
                            <input required class="form-control" type="email" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's number</label>
                            <input required class="form-control" type="text" />
                        </div>

                        <div class="col-12">
                            <label class="form-label">Referee's relationship to candidate (e.g., Direct manager)</label>
                            <input required class="form-control" type="text" />
                        </div>
                    </div>

                    <!-- Referee Three -->
                    <h3 class="mt-5">Referee Three</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Associate company</label>
                            <input class="form-control" type="text" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Your role</label>
                            <input class="form-control" type="text" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Start date</label>
                            <input class="form-control" type="date" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">End date</label>
                            <input class="form-control" type="date" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's full name</label>
                            <input class="form-control" type="text" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's job title</label>
                            <input class="form-control" type="text" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's email</label>
                            <input class="form-control" type="email" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's number</label>
                            <input class="form-control" type="text" />
                        </div>

                        <div class="col-12">
                            <label class="form-label">Referee's relationship to candidate (e.g., Direct manager)</label>
                            <input class="form-control" type="text" />
                        </div>
                    </div>

                    <button class="btn btn-primary mt-4 d-flex justify-content-center align-items-center gap-2 w-100" mt-4 d-flex align-items-center gap-2" onclick="submitForm(event)"> <i class="bi bi-send-fill"></i> Submit</button>

                    <p class="mt-4" style="font-size: 0.9rem; font-weight:bold;">
                        <span class="red">*</span> By submitting this form, you confirm that all details provided are accurate and that you have obtained permission from your nominated referees to be contacted by Allied Recruitment.
                    </p>
                    <p>Allied Recruitment is committed to ensuring safety and integrity for both our candidates and clients. As part of this commitment, we may conduct additional reference, and verification checks to confirm that the referees provided are associated with their respective companies and are the most suitable individuals to provide a reference for you.</p>
                </form>
            </div>
        </div>

        <?php include 'footer.php'; ?>

        <!-- Success Alert -->
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="successAlert" class="alert alert-success alert-dismissible fade" role="alert">
            Form submitted successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/script.js"></script>
        
        <script>
            // Form validation and success alert
            function submitForm(e) {
            e.preventDefault();
            const form = document.getElementById('mainForm');
            if (form.checkValidity()) {
                const alertBox = document.getElementById('successAlert');
                alertBox.classList.add('show');
                setTimeout(() => alertBox.classList.remove('show'), 3000);
            }
            form.classList.add('was-validated');
            }
        </script>
    </body>
</html>
