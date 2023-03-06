////  ==========  Dynamic functionality for EDIT Footer links  ==========  ////

// On edit button press, replace name and link with inputs (to be edited)

const editBtns = document.getElementsByClassName("edit-btn");

// Add functions to load delete form on delete button press
window.addEventListener('load', () => {
    for (let i = 0; i < editBtns.length; i++) {
        editBtns.item(i).addEventListener('click', renderEditForm);
    }
});

function renderEditForm(event) {
    const clickedBtn = event.target;
    const linkIndex = clickedBtn.id.substr(5);
    const editLinkRow = document.getElementById("row-"+linkIndex);
    const adjacentDeleteBtn = document.getElementById("delete-"+linkIndex);

    const originalName = editLinkRow.firstElementChild.innerHTML;
    const originalLink = editLinkRow.children.item(1).firstElementChild;

    // Create confirmation form
    adjacentDeleteBtn.insertAdjacentHTML('afterend',
        `<form method="post" id="edit-${linkIndex}-form">
        <button
            type="submit"
            class="btn btn-primary py-0 shadow"
            id="edit-${linkIndex}-confirm"
        >Save</button>
        <input type="hidden" name="edit-link" value="${originalName}">
    </form>`);

    // Add input for Name
    editLinkRow.firstElementChild.innerHTML =
        `<input
            form="edit-${linkIndex}-form"
            type="text"
            class="form-control py-0"
            name="new-name"
            id="new-name-${linkIndex}"
            value="${originalName}"
         >`

    // Add input for Link
    editLinkRow.children.item(1).innerHTML =
        `<input
            form="edit-${linkIndex}-form"
            type="text"
            class="form-control py-0"
            name="new-link"
            id="new-link-${linkIndex}"
            value="${originalLink.innerText}"
         >`

    // Create Cancel button
    clickedBtn.insertAdjacentHTML('afterend',
        `<button
            type="button"
            class="btn btn-secondary py-0 shadow"
            id="cancel-${linkIndex}"
        >Cancel</button>`);

    // Hide original Elements
    adjacentDeleteBtn.classList.add("d-none");
    clickedBtn.classList.add("d-none");

    // Add function to handle cancel
    const cancelBtn = document.getElementById("cancel-"+linkIndex);
    const editForm = adjacentDeleteBtn.nextElementSibling;
    cancelBtn.addEventListener('click', () => {
        // Remove edit form buttons
        editForm.remove();
        cancelBtn.remove();

        // Restore original name/link
        editLinkRow.firstElementChild.innerHTML = originalName;
        editLinkRow.children.item(1).innerHTML = originalLink.outerHTML;

        // Restore original buttons
        adjacentDeleteBtn.classList.remove("d-none");
        clickedBtn.classList.remove("d-none");
    });

    // Add edit form validation
    editForm.addEventListener('submit', (event) => {
        clearErrors();

        const nameInput = document.getElementById("new-name-"+linkIndex);
        const linkInput = document.getElementById("new-link-"+linkIndex);

        // Validate Name (FROM: footerLinkValidation.js)
        if (!validateName(nameInput.value)) {
            event.preventDefault();
            const error = createErrorMsg("Name must be 3 characters long");
            nameInput.parentElement.appendChild(error);
        }
        // Validate Link (FROM: footerLinkValidation.js)
        if (!validateLink(linkInput.value)) {
            event.preventDefault();
            const error = createErrorMsg("Invalid URL");
            linkInput.parentElement.appendChild(error);
        }
    });
}

