
// Run this when the page loads
window.onload = () => {
    const toastLiveExample = document.getElementById('saveNotification')
    const toast = new bootstrap.Toast(toastLiveExample)
    toast.show()

    console.log(toast)
}