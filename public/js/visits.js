/* Live date */
document.getElementById('todayDate').textContent =
    new Date().toLocaleDateString('en-GB', { weekday:'long', day:'numeric', month:'long', year:'numeric' });

/* Default visit date to today */
document.getElementById('visitDate').value = new Date().toISOString().split('T')[0];

/* Save visit toast */
function saveVisit() {
    const t = document.getElementById('successToast');
    t.style.display = 'block';
    setTimeout(() => { t.style.display = 'none'; }, 4000);
}