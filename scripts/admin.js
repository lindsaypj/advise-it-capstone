const schoolYearsWinter = document.getElementById("schoolYearsWinter");
const schoolYearsSpring = document.getElementById("schoolYearsSpring");
const schoolYearsFall = document.getElementById("schoolYearsFall");
const prevYearWinterBtn = document.getElementById("prevYearWinterBtn");
const nextYearWinterBtn = document.getElementById("nextYearWinterBtn");
const prevYearSpringBtn = document.getElementById("prevYearSpringBtn");
const nextYearSpringBtn = document.getElementById("nextYearSpringBtn");
const prevYearFallBtn = document.getElementById("prevYearFallBtn");
const nextYearFallBtn = document.getElementById("nextYearFallBtn");


window.onload = () =>{
    //Handle Prev Winter Year
    if(prevYearWinterBtn !== null && prevYearWinterBtn !== undefined){
        hidePrevYear(schoolYearsWinter, prevYearWinterBtn);
        prevYearWinterBtn.onclick = () => prevYearClick(schoolYearsWinter, prevYearWinterBtn);
    }

    //Handle Next Winter Year
    if(nextYearWinterBtn !== null && nextYearWinterBtn !== undefined){
        hideNextYear(schoolYearsWinter, nextYearWinterBtn);
        nextYearWinterBtn.onclick = () => nextYearClick(schoolYearsWinter, nextYearWinterBtn);
    }

    //Handle Prev Spring Year
    if(prevYearSpringBtn !== null && prevYearSpringBtn !== undefined){
        hidePrevYear(schoolYearsSpring, prevYearSpringBtn);
        prevYearSpringBtn.onclick = () => prevYearClick(schoolYearsSpring, prevYearSpringBtn);
    }

    //Handle Next Spring Year
    if(nextYearSpringBtn !== null && nextYearSpringBtn !== undefined){
        hideNextYear(schoolYearsSpring, nextYearSpringBtn);
        nextYearSpringBtn.onclick = () => nextYearClick(schoolYearsSpring, nextYearSpringBtn);
    }

    //Handle Prev Fall Year
    if(prevYearFallBtn !== null && prevYearFallBtn !== undefined){
        hidePrevYear(schoolYearsFall, prevYearFallBtn);
        prevYearFallBtn.onclick = () => prevYearClick(schoolYearsFall, prevYearFallBtn);
    }

    //Handle Next Fall Year
    if(nextYearFallBtn !== null && nextYearFallBtn !== undefined){
        hideNextYear(schoolYearsFall, nextYearFallBtn);
        nextYearFallBtn.onclick = () => nextYearClick(schoolYearsFall, nextYearFallBtn);
    }
}
