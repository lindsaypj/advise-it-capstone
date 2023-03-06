
////  ==========  Validation for add/edit/delete Footer links  ==========  ////

const NAME_MIN_LENGTH = 3;
const LINK_MIN_LENGTH = 12;


// Forms
const addFooterForm = document.getElementById("new-link-form");

window.addEventListener('load', () => {
    addFooterForm.onsubmit = validateNewFooter;
});

function validateNewFooter(event) {
    const addNameInput = document.getElementById("add-name");
    const addLinkInput = document.getElementById("add-link");

    // Clear error messages
    clearErrors();

    // Validate name
    const newName = addNameInput.value;
    if (!validateName(newName)) {
        event.preventDefault();

        // Render error message (inside label)
        const errorMsg = createErrorMsg("must be 3 characters long");
        addNameInput.previousElementSibling.append(errorMsg);
    }

    // Validate link
    const newLink = addLinkInput.value;
    if (!validateLink(newLink)) {
        event.preventDefault();

        // Render Error message (inside label)
        const errorMsg = createErrorMsg("Invalid URL");
        addLinkInput.previousElementSibling.append(errorMsg);
    }
}

function validateName(name) {
    return name.length >= NAME_MIN_LENGTH;
}

function validateLink(link) {
    const validHttp = link.startsWith("http://") || link.startsWith("https://");
    const validLength = link.length >= LINK_MIN_LENGTH;

    return validHttp && validLength;
}

function createErrorMsg(message) {
    const error = document.createElement("span");
    error.innerHTML = message;
    error.classList.add("text-danger");
    error.classList.add("ps-1");
    return error;
}

function clearErrors() {
    const errors = document.getElementsByClassName("text-danger");
    const errorCount = errors.length;

    for (let i = 0; i < errorCount; i++) {
        errors.item(0).remove();
    }
}