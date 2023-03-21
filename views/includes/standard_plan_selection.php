<?php

if (!isset($token)) {
    $token = "";
}

// Get current school for default selected year
$standardSchoolYear = DataLayer::getCurrentSchoolYear();

$formSubmitLink = $GLOBALS['PROJECT_DIR']."/plan/".$token;
if (substr( $formSubmitLink, -1) === "/") {
    $formSubmitLink = $GLOBALS['PROJECT_DIR']."/plan";
}

?>

<div>
    <!-- Standard Plan Selection Modal -->
    <div class="modal fade" id="standardPlanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="loginModalLabel">Standard Plan Selection</h5>
                </div>

                <form action="<?php echo $formSubmitLink; ?>" method="get" class="m-0 px-3 text-shadow-none w-100">
                    <div class="modal-body text-start">

                        <!-- Starting Quarter -->
                        <span>Starting Quarter</span>
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="standardQuarter"
                                value="AUTUMN"
                                id="fallRadio"
                                checked
                            >
                            <label class="form-check-label" for="fallRadio">
                                Fall
                            </label>
                        </div>
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="standardQuarter"
                                value="WINTER"
                                id="winterRadio"
                            >
                            <label class="form-check-label" for="winterRadio">
                                Winter
                            </label>
                        </div>
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="standardQuarter"
                                value="SPRING"
                                id="springRadio"
                            >
                            <label class="form-check-label" for="springRadio">
                                Spring
                            </label>
                        </div>

                        <!-- Start Year -->
                        <div class="form-group mt-3">
                            <label for="standardYear">Calendar Year</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="standardQuarterLabel">Fall</span>
                                <input
                                    type="number"
                                    min="<?php echo $standardSchoolYear ?>"
                                    max="2040"
                                    class="form-control"
                                    id="standardYear"
                                    name="standardYear"
                                    value="<?php echo $standardSchoolYear; ?>"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn bg-grcgreen text-white">Load Plan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
