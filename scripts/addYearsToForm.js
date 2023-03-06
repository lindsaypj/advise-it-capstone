
const schoolYearsPlan = document.getElementById("schoolYears");
const prevYearBtnPlan = document.getElementById("prevYearBtn");
const nextYearBtnPlan = document.getElementById("nextYearBtn");

// Hide buttons on load if limit is reached
window.onload = () => {


    // Handle next Year button click
    if(nextYearBtnPlan !== null && nextYearBtnPlan !== undefined){
        hideNextYear(schoolYearsPlan, nextYearBtnPlan);
        nextYearBtnPlan.onclick = () =>  nextYearClick(schoolYearsPlan, nextYearBtnPlan);

    }


    // Handle previous Year button click
    if(prevYearBtnPlan !== null && prevYearBtnPlan !== undefined){
        hidePrevYear(schoolYearsPlan, prevYearBtnPlan);
        prevYearBtnPlan.onclick = () => prevYearClick(schoolYearsPlan, prevYearBtnPlan);
    }

}





function nextYearClick (schoolYears, nextYearBtn) {
    const nextYear = parseInt(schoolYears.lastElementChild.id) + 1;

    // Prevent adding years beyond 2040
    if (nextYear <= 2040) {
        $(schoolYears).append(createNewYear(nextYear));
    }
    // Remove button when max years reached
    if (nextYear >= 2040) {
        nextYearBtn.classList.add("d-none");
    }
}



function prevYearClick(schoolYears, prevYearBtn){
    const previousYear = parseInt(schoolYears.firstElementChild.id) - 1;
    const currentYear = new Date().getFullYear()

    // Prevent adding years beyond 2 years back
    if (previousYear >= currentYear - 2) {
        $(schoolYears).prepend(createNewYear(previousYear));
    }
    // Remove button when max years reached
    if (previousYear <= currentYear -2) {
        prevYearBtn.classList.add("d-none");
    }
}


function createNewYear(schoolYear) {
    return `
    <div id="${schoolYear}" class="container p-0">
        <div class="row">
        
            <!-- Year Separator -->
            <div class="col-sm">
                <h3 class="text-end text-secondary mb-0">${schoolYear}</h3>
                <input
                    type="hidden"
                    value="${schoolYear}"
                    name="schoolYears[${schoolYear}][schoolYear]"
                >
            </div>
            <hr class="shadow-sm mt-0">
								
            <!-- Fall Quarter -->
            <div class="col-sm">
                <div>
                    <h4 class="d-inline">Fall Quarter</h4>
                    <h5>${schoolYear - 1}</h5>
                </div>

                <div class="input-group m-2">
                    <div class="input-group m-2 mb-0">
                        <!-- declaration for first field -->
                        <textarea
                            class="form-control w-50 inputlg shadow-sm"
                            rows="8"
                            name="schoolYears[${schoolYear}][fall][notes]"
                            placeholder="Enter classes"
                        ></textarea>
                    </div>
                </div>
            </div>
            <!-- Winter Quarter -->
            <div class="col-sm">
                <div>
                    <h4 class="d-inline">Winter Quarter</h4>
                    <h5>${schoolYear}</h5>
                </div>

                <div class="input-group m-2">
                    <div class="input-group m-2 mb-0">
                        <!-- declaration for first field -->
                        <textarea
                            class="form-control w-50 inputlg shadow-sm"
                            rows="8"
                            name="schoolYears[${schoolYear}][winter][notes]"
                            placeholder="Enter classes"
                        ></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <!-- Spring Quarter -->
            <div class="col-sm">
                <div>
                    <h4 class="d-inline">Spring Quarter</h4>
                    <h5>${schoolYear}</h5>
                </div>

                <div class="input-group m-2">
                    <div class="input-group m-2 mb-0">
                        <!-- declaration for first field -->
                        <textarea
                            class="form-control w-50 inputlg shadow-sm"
                            rows="8"
                            name="schoolYears[${schoolYear}][spring][notes]"
                            placeholder="Enter classes"
                        ></textarea>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div>
                    <h4 class="d-inline">Summer Quarter</h4>
                    <h5>${schoolYear}</h5>
                </div>

                <div class="input-group m-2 mb-4">
                    <div class="input-group m-2 mb-0">
                        <!-- declaration for first field -->
                        <textarea class="form-control w-50 inputlg shadow-sm"
                            rows="8"
                            name="schoolYears[${schoolYear}][summer][notes]"
                            placeholder="Enter classes"
                        ></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
}

function hideNextYear(schoolYears, nextYearBtn) {
    const nextYear = parseInt(schoolYears.lastElementChild.id) + 1;

    // Remove button when max years reached
    if (nextYear >= 2040) {
        nextYearBtn.classList.add("d-none");
    }
}

function hidePrevYear(schoolYears, prevYearBtn) {
    const previousYear = parseInt(schoolYears.firstElementChild.id) - 1;
    const currentYear = new Date().getFullYear()

    // Remove button when max years reached
    if (previousYear <= currentYear -2) {
        prevYearBtn.classList.add("d-none");
    }
}
