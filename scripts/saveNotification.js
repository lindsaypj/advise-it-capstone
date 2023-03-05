
// Run this when the page loads
window.addEventListener("load", () => {
    const toastLiveExample = document.getElementById('saveNotification')
    const toast = new bootstrap.Toast(toastLiveExample)
    toast.show()
});