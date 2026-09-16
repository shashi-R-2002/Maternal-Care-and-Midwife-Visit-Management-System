// Live date in topbar
const todayDate = document.getElementById('todayDate');

if (todayDate) {
    const d = new Date();

    todayDate.textContent = d.toLocaleDateString('en-GB', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
}