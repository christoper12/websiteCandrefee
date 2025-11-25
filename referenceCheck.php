<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'htmlhead.php'; ?>
        <title>Reference Check Form</title>
    </head>

    <body>
        <?php include 'header.php'; ?>

        <div class="container my-4 fade-in slide-up">
            
            <div class="card p-4 mb-4 bg-white">
                <h2><center>REFERENCE CHECK</center></h2>

                <form id="refForm" novalidate>
                    <!-- Candidate / Referee info (prefill from GET) -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Referee's Name</label>
                            <input name="referee_name" class="form-control cand-control" value="" readonly> 
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Referee's Phone</label>
                            <input name="referee_phone" class="form-control cand-control" value="" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Referee's Email</label>
                            <input name="referee_email" type="email" class="form-control cand-control" value="" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Referee's Title</label>
                            <input name="referee_title" class="form-control cand-control" value="" readonly>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Applicant's Name</label>
                            <input id="candidateName" name="candidate_name" class="form-control cand-control" value="" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Employed Dates (from)</label>
                            <input name="employed_from" type="date" class="form-control cand-control" value="" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Employed Dates (to)</label>
                            <input name="employed_to" type="date" class="form-control cand-control" value="" readonly>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Employed As</label>
                            <input name="employed_as" class="form-control cand-control" value="" readonly>
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
                        <textarea name="details_wrong_explain" class="form-control" rows="3" placeholder="Write here..."></textarea>
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
                                <input type="range" min="1" max="10" value="1"
                                    name="q_follow_instructions"
                                    oninput="syncRangeValue(this, 'val_follow')">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span>Poor (1)</span>
                                    <span>(10) Excellent</span>
                                </div>
                            </div>
                        </div>

                        <!-- WORK INDEPENDENTLY -->
                        <div class="col-12 col-lg-12">
                            <label class="form-label">How well did the candidate work independently?</label>
                            <div class="range-value-display" id="val_independent">1</div>

                            <div class="range-wrapper">
                                <input type="range" min="1" max="10" value="1"
                                    name="q_work_independently"
                                    oninput="syncRangeValue(this, 'val_independent')">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span>Poor (1)</span>
                                    <span>(10) Excellent</span>
                                </div>
                            </div>
                        </div>

                        <!-- ACCURACY -->
                        <div class="col-12 col-lg-12">
                            <label class="form-label">How accurate was the candidate's work, and how often did mistakes occur?</label>
                            <div class="range-value-display" id="val_accuracy">1</div>

                            <div class="range-wrapper">
                                <input type="range" min="1" max="10" value="1"
                                    name="q_accuracy"
                                    oninput="syncRangeValue(this, 'val_accuracy')">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span>Poor (1)</span>
                                    <span>(10) Excellent</span>
                                </div>
                            </div>
                        </div>

                        <!-- ATTITUDE -->
                        <div class="col-12 col-lg-12">
                            <label class="form-label">How was the candidate's attitude toward yourself and their coworkers?</label>
                            <div class="range-value-display" id="val_attitude">1</div>

                            <div class="range-wrapper">
                                <input type="range" min="1" max="10" value="1"
                                    name="q_attitude"
                                    oninput="syncRangeValue(this, 'val_attitude')">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span>Poor (1)</span>
                                    <span>(10) Excellent</span>
                                </div>
                            </div>
                        </div>

                        <!-- ATTENDANCE -->
                        <div class="col-12 col-lg-12">
                            <label class="form-label">How was the candidate's attendance record, punctuality, and overall timekeeping?</label>
                            <div class="range-value-display" id="val_attendance">1</div>

                            <div class="range-wrapper">
                                <input type="range" min="1" max="10" value="1"
                                    name="q_attendance"
                                    oninput="syncRangeValue(this, 'val_attendance')">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span>Poor (1)</span>
                                    <span>(10) Excellent</span>
                                </div>
                            </div>
                        </div>

                        <!-- SAFETY RECORD -->
                        <div class="col-12 col-lg-12">
                            <label class="form-label">Applicant's Safety Record?</label>
                            <div class="range-value-display" id="val_safety">1</div>

                            <div class="range-wrapper">
                                <input type="range" min="1" max="10" value="1"
                                    name="q_safety"
                                    oninput="syncRangeValue(this, 'val_safety')">

                                <div class="range-ticks">
                                    <span></span><span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>

                                <div class="range-labels light">
                                    <span>Poor (1)</span>
                                    <span>(10) Excellent</span>
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
                        <button type="button" class="btn btn-primary d-flex justify-content-center align-items-center gap-2" onclick="submitRefForm(event)"><i class="bi bi-send-fill"></i> Submit Reference</button>
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

        <script>
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

            // basic client-side validation + success behaviour
            function submitRefForm(e){
                const form = document.getElementById('refForm');
                // use browser constraint validation
                if(!form.checkValidity()){
                    form.classList.add('was-validated');
                    return;
            }

            // simulate sending: show alert
            const alertEl = document.getElementById('successAlert');
            alertEl.classList.add('show');
            setTimeout(()=>alertEl.classList.remove('show'),3000);

            // optionally: prepare payload and send to API here via fetch
            // const payload = new FormData(form);
            // fetch('https://your-api.example/api/referees', {method:'POST', body: payload})

            form.reset();
            // keep candidate fields after reset
            populateFromUrl();
            }

            // expose populateFromUrl for re-use after reset
            function populateFromUrl(){
                const params = new URLSearchParams(window.location.search);
                const name = params.get('num') || '';
                const uid = params.get('uniqueid') || '';
                if(name) document.getElementById('candidateName').value = decodeURIComponent(name);
                if(uid) document.getElementById('candidateId').value = decodeURIComponent(uid);
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

        </script>
    </body>
</html>