 /* Live date */
    const d = new Date();
    document.getElementById('todayDate').textContent =
        d.toLocaleDateString('en-GB', { weekday:'long', day:'numeric', month:'long', year:'numeric' });

    /* EDD countdown — updated to match health-record.html EDD 2026-10-20 */
    const edd = new Date('2026-10-20');
    const today = new Date();
    today.setHours(0,0,0,0);
    const diff = Math.ceil((edd - today) / (1000 * 60 * 60 * 24));
    const countdownEl = document.getElementById('eddCountdown');
    if (diff > 0) {
        countdownEl.textContent = diff + ' days to go';
    } else if (diff === 0) {
        countdownEl.textContent = 'Today!';
        countdownEl.style.background = '#16a34a';
    } else {
        countdownEl.textContent = 'Delivered';
        countdownEl.style.background = '#64748b';
    }

    /* Smooth scroll for sidebar links */
    function smoothTo(id) {
        event.preventDefault();
        const el = document.getElementById(id);
        if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }