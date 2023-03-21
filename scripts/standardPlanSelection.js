// This script handles the logic for toggling the quarter that appears next to
// the starting year on the standard plan selection form
//
// Examples: Fall 2023, Winter 2027, Spring 2024

const fallRadio = document.getElementById("fallRadio");
const winterRadio = document.getElementById("winterRadio");
const springRadio = document.getElementById("springRadio");
const quarterInput = document.getElementById("standardQuarterLabel");

// assign functions to set the quarter label
window.addEventListener("load", () => {
    fallRadio.onchange = updateQuarterLabel;
    winterRadio.onchange = updateQuarterLabel;
    springRadio.onchange = updateQuarterLabel;
});

// Function to assign the clicked radio value to the quarter label
const updateQuarterLabel = function(event) {
    let label = "";
    switch(event.target.value) {
        case "AUTUMN":
            label = "Fall";
            break;
        case "WINTER":
            label = "Winter";
            break;
        case "SPRING":
            label = "Spring";
    }
    quarterInput.innerText = label;
}