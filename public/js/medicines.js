/* Live date */
document.getElementById('todayDate').textContent =
    new Date().toLocaleDateString('en-GB', { weekday:'long', day:'numeric', month:'long', year:'numeric' });

/* Default dates to today */
const today = new Date().toISOString().split('T')[0];
document.getElementById('medDate').value = today;
document.getElementById('nutDate').value = today;

/* Toast helper */
function showToast(type) {
    const id = type === 'med' ? 'toastMed' : 'toastNut';
    const el = document.getElementById(id);
    el.style.display = 'block';
    setTimeout(() => { el.style.display = 'none'; }, 4000);
}