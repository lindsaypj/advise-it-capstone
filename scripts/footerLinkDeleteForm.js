
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

    // Create confirmation form
    deleteLinkRow.lastElementChild.innerHTML =
    `<form method="post">
        <button 
            type="button"
            class="btn btn-secondary py-0"
            id="cancel-${linkIndex}"
        >Cancel</button>
        <button
            type="submit"
            class="btn btn-danger py-0"
            id="delete-${linkIndex}"
        >DELETE</button>
        <input type="hidden" name="delete-link" value="${deleteLinkRow.firstElementChild.innerHTML}">
    </form>`;

    // Add function to handle cancel
    const cancelBtn = document.getElementById("cancel-"+linkIndex);
    cancelBtn.addEventListener('click', () => {
        // Restore original delete button
        deleteLinkRow.lastElementChild.innerHTML = clickedBtn.outerHTML;
        deleteLinkRow.lastElementChild.firstElementChild.addEventListener('click', renderDeleteForm);
    });
}

