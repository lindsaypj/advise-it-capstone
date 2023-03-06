
////  ==========  Dynamic functionality for delete Footer links  ==========  ////

// On delete button press, replace button with Delete confirmation form

const deleteBtns = document.getElementsByClassName("delete-btn");

// Add functions to load delete form on delete button press
window.addEventListener('load', () => {
    for (let i = 0; i < deleteBtns.length; i++) {
        deleteBtns.item(i).addEventListener('click', renderDeleteForm);
    }
});

function renderDeleteForm(event) {
    const clickedBtn = event.target;
    const linkIndex = clickedBtn.id.substr(7);
    const deleteLinkRow = document.getElementById("row-"+linkIndex);
    const adjacentEditBtn = document.getElementById("edit-"+linkIndex);

    // Create confirmation form
    clickedBtn.insertAdjacentHTML('afterend',
    `<form method="post">
        <button
            type="submit"
            class="btn btn-danger py-0 shadow"
            id="delete-${linkIndex}-confirm"
        >DELETE</button>
        <input type="hidden" name="delete-link" value="${deleteLinkRow.firstElementChild.innerHTML}">
    </form>`);

    // Create Cancel button
    adjacentEditBtn.insertAdjacentHTML('afterend',
    `<button 
            type="button"
            class="btn btn-secondary py-0 shadow"
            id="cancel-${linkIndex}"
        >Cancel</button>`);

    // Hide original buttons
    adjacentEditBtn.classList.add("d-none");
    clickedBtn.classList.add("d-none");

    // Add function to handle cancel
    const cancelBtn = document.getElementById("cancel-"+linkIndex);
    const deleteForm = clickedBtn.nextElementSibling;
    cancelBtn.addEventListener('click', () => {
        // Remove delete form buttons
        deleteForm.remove();
        cancelBtn.remove();
        // Restore original buttons
        adjacentEditBtn.classList.remove("d-none");
        clickedBtn.classList.remove("d-none");
    });
}

