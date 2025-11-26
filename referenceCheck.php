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
    $refEmail = $payload['refEmail'];
    $refName = $payload['refName'];
    $refNumber = $payload['refNumber'];
    $candno = $payload['candno'];
    $candName = $payload['candName'];
    $refTitle = $payload['refTitle'];


    $refStartDate = $payload['refStartDate'];

    // Parse the date with the correct format
    $date = DateTime::createFromFormat('d/m/Y h:i:s A', $refStartDate);
    $formattedDateRefStartDate = $date ? $date->format('d/m/Y') : 'Invalid date';

    // Or if you want to handle errors more strictly
    if ($date === false) {
        throw new Exception("Invalid date format: " . $refStartDate);
    }
    $formattedDateRefStartDate = $date->format('Y-m-d');

    $refEndDate = $payload['refEndDate'];

    // Parse the date with the correct format
    $date = DateTime::createFromFormat('d/m/Y h:i:s A', $refEndDate);
    $formattedDateRefEndDate = $date ? $date->format('d/m/Y') : 'Invalid date';

    // Or if you want to handle errors more strictly
    if ($date === false) {
        throw new Exception("Invalid date format: " . $refEndDate);
    }
    $formattedDateRefEndDate = $date->format('Y-m-d');

    $refRole = $payload['refRole'];

    //echo "Token valid: $candname - $uniqueid - $candno";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'htmlhead.php'; ?>
        <title>Reference Check Form <?php echo $candno." - ".$candName ?></title>
    </head>

    <body>
        <?php include 'header.php'; ?>

        <div class="container my-4 fade-in slide-up">
            
            <div class="card p-4 mb-4 bg-white">
                <h2><center>REFERENCE CHECK</center></h2>

                <form id="refForm" novalidate>
                    <input type="hidden" name="candno" id="candno" value="<?php echo $candno; ?>">
                    
                    <!-- Candidate / Referee info (prefill from GET) -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Referee's Name</label>
                            <input name="referee_name" id="refName" class="form-control cand-control" value="<?php echo $refName; ?>" readonly> 
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Referee's Phone</label>
                            <input name="referee_phone" id="refNumber" class="form-control cand-control" value="<?php echo $refNumber; ?>" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's Email</label>
                            <input name="referee_email" id="refEmail" type="email" class="form-control cand-control" value="<?php echo $refEmail; ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Referee's Title</label>
                            <input name="referee_title" id="refTitle" class="form-control cand-control" value="<?php echo $refTitle; ?>" readonly>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Applicant's Name</label>
                            <input id="candidateName" id="candName" name="candidate_name" class="form-control cand-control" value="<?php echo $candName; ?>" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Employed Dates (from)</label>
                            <input name="employed_from" id="formattedDateRefStartDate" type="date" class="form-control cand-control" value="<?php echo $formattedDateRefStartDate; ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Employed Dates (to)</label>
                            <input name="employed_to" id="formattedDateRefEndDate" type="date" class="form-control cand-control" value="<?php echo $formattedDateRefEndDate; ?>" readonly>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Employed As</label>
                            <input name="employed_as" id="refRole" class="form-control cand-control" value="<?php echo $refRole; ?>" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Are the details above correct?</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="details_correct" id="yesCorrect" value="yes" required>
                                <label class="form-check-label" for="yesCorrect">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="details_correct" id="noCorrect" value="no" required>
                                <label class="form-check-label" for="noCorrect">No</label>
                            </div>
                        </div>

                        <div class="invalid-feedback">Please indicate if the details are correct.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">If the details are not correct, please let us know why</label>
                        <textarea name="details_wrong_explain" id="details_wrong_explain" class="form-control" rows="3" placeholder="Write here..."></textarea>
                    </div>

                    <hr>
                    <p class="small text-muted">Please rate each category on a scale of 1 to 10, where 1 indicates very poor performance and 10 indicates excellent performance.</p>

                    <!-- Ratings: use range input + numeric display -->
                    <div class="row g-3 rating-row">

                        <!-- FOLLOW INSTRUCTIONS -->
                        <div class="col-12 col-lg-12">
                            <label class="form-label">How well did the candidate follow instructions?</label>
                            <div class="range-value-display" id="val_follow">1</div>

                            <div class="range-wrapper">
                                <input type="range" min="1" max="10" value="1" class="colored-range"
                                    name="q_follow_instructions"
                                    oninput="syncRangeValue(this, 'val_follow'); updateSliderColor(this, 'val_follow');">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span style="color:red; font-weight:bold;">Poor (1)</span>
                                    <span style="color:green; font-weight:bold;">Excellent (10)</span>
                                </div>
                            </div>
                        </div>

                        <!-- WORK INDEPENDENTLY -->
                        <div class="col-12 col-lg-12">
                            <label class="form-label">How well did the candidate work independently?</label>
                            <div class="range-value-display" id="val_independent">1</div>

                            <div class="range-wrapper">
                                <input type="range" min="1" max="10" value="1" class="colored-range"
                                    name="q_work_independently"
                                    oninput="syncRangeValue(this, 'val_independent'); updateSliderColor(this, 'val_independent');">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span style="color:red; font-weight:bold;">Poor (1)</span>
                                    <span style="color:green; font-weight:bold;">Excellent (10)</span>
                                </div>
                            </div>
                        </div>

                        <!-- ACCURACY -->
                        <div class="col-12 col-lg-12">
                            <label class="form-label">How accurate was the candidate's work, and how often did mistakes occur?</label>
                            <div class="range-value-display" id="val_accuracy">1</div>

                            <div class="range-wrapper">
                                <input type="range" min="1" max="10" value="1" class="colored-range"
                                    name="q_accuracy"
                                    oninput="syncRangeValue(this, 'val_accuracy'); updateSliderColor(this, 'val_accuracy');">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span style="color:red; font-weight:bold;">Poor (1)</span>
                                    <span style="color:green; font-weight:bold;">Excellent (10)</span>
                                </div>
                            </div>
                        </div>

                        <!-- ATTITUDE -->
                        <div class="col-12 col-lg-12">
                            <label class="form-label">How was the candidate's attitude toward yourself and their coworkers?</label>
                            <div class="range-value-display" id="val_attitude">1</div>

                            <div class="range-wrapper">
                                <input type="range" min="1" max="10" value="1" class="colored-range"
                                    name="q_attitude"
                                    oninput="syncRangeValue(this, 'val_attitude'); updateSliderColor(this, 'val_attitude');">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span style="color:red; font-weight:bold;">Poor (1)</span>
                                    <span style="color:green; font-weight:bold;">Excellent (10)</span>
                                </div>
                            </div>
                        </div>

                        <!-- ATTENDANCE -->
                        <div class="col-12 col-lg-12">
                            <label class="form-label">How was the candidate's attendance record, punctuality, and overall timekeeping?</label>
                            <div class="range-value-display" id="val_attendance">1</div>

                            <div class="range-wrapper">
                                <input type="range" min="1" max="10" value="1" class="colored-range"
                                    name="q_attendance"
                                    oninput="syncRangeValue(this, 'val_attendance'); updateSliderColor(this, 'val_attendance');">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span style="color:red; font-weight:bold;">Poor (1)</span>
                                    <span style="color:green; font-weight:bold;">Excellent (10)</span>
                                </div>
                            </div>
                        </div>

                        <!-- SAFETY -->
                        <div class="col-12 col-lg-12">
                            <label class="form-label">Applicant's Safety Record?</label>
                            <div class="range-value-display" id="val_safety">1</div>

                            <div class="range-wrapper">
                                <input type="range" min="1" max="10" value="1" class="colored-range"
                                    name="q_safety"
                                    oninput="syncRangeValue(this, 'val_safety'); updateSliderColor(this, 'val_safety');">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span style="color:red; font-weight:bold;">Poor (1)</span>
                                    <span style="color:green; font-weight:bold;">Excellent (10)</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Considered for reemployment?</label>
                            <select name="consider_rehire" class="form-select" required>
                            <option value="">Choose...</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Reason for Leaving</label>
                            <input name="reason_leaving" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Any other comments?</label>
                            <textarea name="other_comments" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="button" class="btn btn-primary d-flex justify-content-center align-items-center gap-2" onclick="submitRefForm(event)"><i class="bi bi-send-fill"></i> Submit </button>
                    </div>

                    <p class="mt-4" style="font-size: 0.9rem; font-weight:bold;">By submitting this form, you confirm that all details provided are accurate and true to the best of your knowledge. You acknowledge that the information supplied will be used by Allied Recruitment to assess the candidate's suitability for employment.</p>
                    <p style="font-size: 0.9rem; font-weight:bold;">Allied Recruitment is committed to ensuring safety and integrity for both our candidates and clients. As part of this commitment, we may conduct additional verification checks to confirm that referees are genuinely associated with the companies they represent and are appropriate to provide a reference for the candidate.</p>

                </form>
            </div>
            <!-- Success Alert -->
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index:11">
            <div id="successAlert" class="alert alert-success alert-dismissible fade" role="alert">
                Reference submitted. Thank you.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/script.js"></script>
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>

            // basic client-side validation + success behaviour
            function submitRefForm(e) {
                e.preventDefault();

                const form = document.getElementById('refForm');

                // Basic validation
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }
                form.classList.add('was-validated');

                // Loading Animation
                Swal.fire({
                    title: "Submitting...",
                    text: "Please wait",
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                // Build final payload from all fields
                let formData = {
                    // ---------- Referee Information ----------
                    referee_name: $("#refName").val(),
                    referee_phone: $("#refNumber").val(),
                    referee_email: $("#refEmail").val(),
                    referee_title: $("#refTitle").val(),

                    // ---------- Candidate Information ----------
                    candno: $("#candno").val(),

                    // ---------- Verification ----------
                    details_correct: $("input[name='details_correct']:checked").val(),
                    details_wrong_explain: $("#details_wrong_explain").val(),

                    // ---------- Ratings ----------
                    q_follow_instructions: $("input[name='q_follow_instructions']").val(),
                    q_work_independently: $("input[name='q_work_independently']").val(),
                    q_accuracy: $("input[name='q_accuracy']").val(),
                    q_attitude: $("input[name='q_attitude']").val(),
                    q_attendance: $("input[name='q_attendance']").val(),
                    q_safety: $("input[name='q_safety']").val(),

                    // ---------- Additional ----------
                    consider_rehire: $("select[name='consider_rehire']").val(),
                    reason_leaving: $("input[name='reason_leaving']").val(),
                    other_comments: $("textarea[name='other_comments']").val()
                };

                // Send data to backend
                $.ajax({
                    url: "save_refereeCheck.php",
                    method: "POST",
                    data: { data: JSON.stringify(formData) },
                    success: function (response) {

                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Your referee information has been submitted.",
                            showConfirmButton: true
                        });
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
            }

            // populate candidate info from URL params
            (function populateFromUrl(){
                const params = new URLSearchParams(window.location.search);
                const name = params.get('num') || '';
                const uid = params.get('uniqueid') || '';
                if(name) document.getElementById('candidateName').value = decodeURIComponent(name);
                if(uid) document.getElementById('candidateId').value = decodeURIComponent(uid);

                // also add hidden inputs to form (if needed by backend)
                const form = document.getElementById('refForm');
                const h1 = document.createElement('input'); h1.type='hidden'; h1.name='candidate_name'; h1.value=decodeURIComponent(name);
                const h2 = document.createElement('input'); h2.type='hidden'; h2.name='candidate_uniqueid'; h2.value=decodeURIComponent(uid);
                form.appendChild(h1); form.appendChild(h2);
            })();

            // sync range output
            function syncRange(el){
                const out = el.nextElementSibling; if(out) out.textContent = el.value;
            }

            // Show/hide explanation box based on Yes/No choice
            document.addEventListener("DOMContentLoaded", () => {
                const yesRadio = document.getElementById("yesCorrect");
                const noRadio = document.getElementById("noCorrect");
                const explanationBox = document.querySelector("textarea[name='details_wrong_explain']");

                // hide by default
                explanationBox.closest(".mb-4").style.display = "none";
                explanationBox.removeAttribute("required");

                function updateVisibility() {
                    if (noRadio.checked) {
                        explanationBox.closest(".mb-4").style.display = "block";
                        explanationBox.setAttribute("required", "required");
                    } else {
                        explanationBox.closest(".mb-4").style.display = "none";
                        explanationBox.removeAttribute("required");
                        explanationBox.value = ""; // clear text if switching back
                    }
                }

                yesRadio.addEventListener("change", updateVisibility);
                noRadio.addEventListener("change", updateVisibility);
            });

            function syncRangeValue(range, outputId) {
                document.getElementById(outputId).innerText = range.value;
            }

            function updateSliderColor(slider, targetId) {
                const val = Number(slider.value);
                const bubble = document.getElementById(targetId);

                let color = "#e63946"; // merah

                if (val >= 4 && val <= 6) color = "#ffba08";   // kuning
                else if (val >= 7) color = "#4caf50";          // hijau

                // --- Update slider warna ---
                const percentage = ((val - 1) / 9) * 100;
                slider.style.background =
                    `linear-gradient(90deg, ${color} ${percentage}%, #d3d3d3 ${percentage}%)`;

                // --- Anti-error: cek bubble dulu ---
                if (bubble) {
                    bubble.style.background = color;
                    bubble.innerText = val;
                }
            }
        </script>
    </body>
</html>