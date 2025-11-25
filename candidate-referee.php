<?php
    $secretKey = 'alliedrec';

    if (!isset($_GET['token'])) {
        die("Token required");
    }

    $token = str_replace(array('-', '_'), array('+', '/'), $_GET['token']);
    $token = urldecode($_GET['token']);
    list($payloadB64, $signature) = explode('.', $token);

    // Decode payload
    $payloadJson = base64_decode($payloadB64);
    //echo "Payload JSON: " . $payloadJson . "\n";
    //echo "Signature from token: " . $signature . "\n";
    $payload = json_decode($payloadJson, true);

    
    // Verify signature
    // signature harus dihitung dari JSON payload asli
    $signature = strtr($signature, '-_', '+/');
    $pad = strlen($signature) % 4;
    if ($pad) {
        $signature .= str_repeat('=', 4 - $pad); // tambahkan padding
    }

    $expectedSignature = base64_encode(hash_hmac('sha256', $payloadJson, $secretKey, true));
    //echo "Expected signature: " . $expectedSignature . "\n";
    if (!hash_equals($expectedSignature, $signature)) {
        die("Invalid token");
    }

    // Optional: check expiry
    if (isset($payload['exp']) && time() > $payload['exp']) {
        die("Token expired");
    }

    // Token valid
    $candno = $payload['candno'];
    $candname = $payload['candname'];
    $uniqueid = $payload['uniqueid'];

    //echo "Token valid: $candname - $uniqueid - $candno";
?>
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'htmlhead.php'; ?>
        <title>Candidate Reference Form <?php echo $candno." - ".$candname ?></title>
    </head>

    <body>
        <?php include 'header.php'; ?>

        <div class="container my-4 fade-in slide-up">
            <div class="card p-4">
                <p>
                    <h6>Cand. Number : <?php echo $candno ?></h6>
                    <h6>Cand. Name : <?php echo $candname ?></h6>
                </p>
                <p>Thank you for your interest in joining the Allied Recruitment team.</p>
                <p>To support your application for work, please provide contact details for a minimum of <span class="red">two referees</span> who have supervised you at work in the last two years.</p>
                <p>If you have had more than one job in the last two years, please list referees from your most recent jobs, going back in order until your past two years of work history are covered.</p>
                <p>We only accept work references from direct supervisor or managers who have overseen your work. Please do not nominate a friend, co-worker, or family member.</p>

                <form id="refereeFormCand" novalidate>
                    <input type="hidden" name="candno" id="candno" value="<?php echo $candno; ?>">
                    <input type="hidden" name="candname" id="candname" value="<?php echo $candname; ?>">
                    <input type="hidden" name="unique_id" id="unique_id" value="<?php echo $uniqueId; ?>">

                    <!-- Referee One -->
                    <h3 class="mt-4">Referee One <span class="red">*</span></h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Associate company</label>
                            <input required class="form-control" type="text" id="r1_company"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Your role</label>
                            <input required class="form-control" type="text" id="r1_role"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Start date</label>
                            <input required class="form-control" type="date" id="r1_start"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">End date</label>
                            <input required class="form-control" type="date" id="r1_end"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's full name</label>
                            <input required class="form-control" type="text" id="r1_name"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's job title</label>
                            <input required class="form-control" type="text" id="r1_job"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's email</label>
                            <input required class="form-control" type="email" id="r1_email"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's number</label>
                            <input required class="form-control" type="text" id="r1_phone"/>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Referee's relationship to candidate (e.g., Direct manager)</label>
                            <input required class="form-control" type="text" id="r1_relation"/>
                        </div>
                    </div>

                    <!-- Referee Two -->
                    <h3 class="mt-5">Referee Two <span class="red">*</span></h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Associate company</label>
                            <input required class="form-control" type="text" id="r2_company"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Your role</label>
                            <input required class="form-control" type="text" id="r2_role"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Start date</label>
                            <input required class="form-control" type="date" id="r2_start"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">End date</label>
                            <input required class="form-control" type="date" id="r2_end"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's full name</label>
                            <input required class="form-control" type="text" id="r2_name"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's job title</label>
                            <input required class="form-control" type="text" id="r2_job"/>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Referee's email</label>
                            <input required class="form-control" type="email" id="r2_email"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's number</label>
                            <input required class="form-control" type="text" id="r2_phone"/>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Referee's relationship to candidate (e.g., Direct manager)</label>
                            <input required class="form-control" type="text" id="r2_relation"/>
                        </div>
                    </div>

                    <!-- Referee Three -->
                    <h3 class="mt-5">Referee Three</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Associate company</label>
                            <input class="form-control" type="text" id="r3_company"/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Your role</label>
                            <input class="form-control" type="text" id="r3_role"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Start date</label>
                            <input class="form-control" type="date" id="r3_start"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">End date</label>
                            <input class="form-control" type="date" id="r3_end"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's full name</label>
                            <input class="form-control" type="text" id="r3_name"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's job title</label>
                            <input class="form-control" type="text" id="r3_job"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's email</label>
                            <input class="form-control" type="email" id="r3_email"/>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's number</label>
                            <input class="form-control" type="text" id="r3_phone"/>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Referee's relationship to candidate (e.g., Direct manager)</label>
                            <input class="form-control" type="text" id="r3_relation"/>
                        </div>
                    </div>

                    <button class="btn btn-primary mt-4 d-flex justify-content-center align-items-center gap-2 w-100" mt-4 d-flex align-items-center gap-2" onclick="submitForm(event)"> <i class="bi bi-send-fill" id="submitBtn"></i> Submit</button>
                    <!-- <button class="btn btn-primary mt-4 d-flex justify-content-center align-items-center gap-2 w-100" mt-4 d-flex align-items-center gap-2"> <i class="bi bi-send-fill" id="submitBtn"></i> Submit</button> -->
                </form>

                <p class="mt-4" style="font-size: 0.9rem; font-weight:bold;">
                    <span class="red">*</span> By submitting this form, you confirm that all details provided are accurate and that you have obtained permission from your nominated referees to be contacted by Allied Recruitment.
                </p>
                <p>Allied Recruitment is committed to ensuring safety and integrity for both our candidates and clients. As part of this commitment, we may conduct additional reference, and verification checks to confirm that the referees provided are associated with their respective companies and are the most suitable individuals to provide a reference for you.</p>
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
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            function submitForm(e) {
                e.preventDefault();

                const form = document.getElementById('refereeFormCand');
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return; // ❗ STOP, jangan lanjut AJAX
                }
                form.classList.add('was-validated');
                

                // Loading (SweetAlert2)
                Swal.fire({
                    title: "Submitting...",
                    text: "Please wait",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let formData = {
                    candno: $("#candno").val(),
                    referee1: {
                        company: $("#r1_company").val(),
                        role: $("#r1_role").val(),
                        start: $("#r1_start").val(),
                        end: $("#r1_end").val(),
                        name: $("#r1_name").val(),
                        job: $("#r1_job").val(),
                        email: $("#r1_email").val(),
                        phone: $("#r1_phone").val(),
                        relation: $("#r1_relation").val()
                    },
                    referee2: {
                        company: $("#r2_company").val(),
                        role: $("#r2_role").val(),
                        start: $("#r2_start").val(),
                        end: $("#r2_end").val(),
                        name: $("#r2_name").val(),
                        job: $("#r2_job").val(),
                        email: $("#r2_email").val(),
                        phone: $("#r2_phone").val(),
                        relation: $("#r2_relation").val()
                    },
                    referee3: {
                        company: $("#r3_company").val(),
                        role: $("#r3_role").val(),
                        start: $("#r3_start").val(),
                        end: $("#r3_end").val(),
                        name: $("#r3_name").val(),
                        job: $("#r3_job").val(),
                        email: $("#r3_email").val(),
                        phone: $("#r3_phone").val(),
                        relation: $("#r3_relation").val()
                    }
                };

                $.ajax({
                    url: "save_referee.php",
                    method: "POST",
                    data: { data: JSON.stringify(formData) },
                    success: function (response) {

                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Your referee information has been submitted.",
                            showConfirmButton: true
                        });

                        // $("#refereeFormCand")[0].reset();
                    },
                    error: function (xhr, status, error) {
                        console.log("XHR:", xhr.responseText);
                        console.log("STATUS:", status);
                        console.log("ERROR:", error);

                        Swal.fire({
                            icon: "error",
                            title: "Submission failed",
                            text: xhr.responseText,
                            showConfirmButton: true
                        });

                    }
                });
            };
            // Form validation and success alert
            // function submitForm(e) {
            // e.preventDefault();
            // const form = document.getElementById('refereeFormCand');
            // if (form.checkValidity()) {
            //     const alertBox = document.getElementById('successAlert');
            //     alertBox.classList.add('show');
            //     setTimeout(() => alertBox.classList.remove('show'), 3000);
            // }
            // form.classList.add('was-validated');
            // }
        </script>
    </body>
</html>