// Get standardized plans
const winter = document.getElementById("winter-plan");
const spring = document.getElementById("spring-plan");
const fall = document.getElementById("fall-plan");
const winterPlanBtn = document.getElementById("winterPlanBtn");
const springPlanBtn = document.getElementById("springPlanBtn");
const fallPlanBtn = document.getElementById("fallPlanBtn");

// Add class "active"

window.addEventListener("load", () => {
    winterPlanBtn.addEventListener("click", () => {
        loadPlanOnClick(winterPlanBtn, [springPlanBtn, fallPlanBtn], winter, [spring, fall]);
    });

    springPlanBtn.addEventListener("click", () => {
        loadPlanOnClick(springPlanBtn,[winterPlanBtn, fallPlanBtn], spring, [winter, fall]);
    });

    fallPlanBtn.addEventListener("click", () => {
        loadPlanOnClick(fallPlanBtn, [winterPlanBtn, springPlanBtn], fall, [spring, winter]);
    });
});

function loadPlanOnClick(button, hideButtons, showPlan, hidePlans) {
    // Set plan visibility
    showPlan.classList.remove("d-none");

    for (let i = 0; i < hidePlans.length; i++) {
        hidePlans[i].classList.add('d-none');
    }

    // Set active button
    button.classList.add('active');

    for (let i = 0; i < hideButtons.length; i++) {
        hideButtons[i].classList.remove('active');
    }
}