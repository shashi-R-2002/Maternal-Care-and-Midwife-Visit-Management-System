document.getElementById('todayDate').textContent =
    new Date().toLocaleDateString('en-GB',{weekday:'long',day:'numeric',month:'long',year:'numeric'});

function viewProfile(name) {
    alert('Viewing full profile for: ' + name + '\n(Connect this to your midwife detail page once backend is ready)');
}

/* Search filter */
document.getElementById('searchInput').addEventListener('input', function() {
    const q = this.value.toLowerCase().trim();
    const rows = document.querySelectorAll('#tableBody tr');
    let visible = 0;
    rows.forEach(row => {
        const match = !q || row.getAttribute('data-name').includes(q) || row.getAttribute('data-nic').includes(q);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('visibleCount').textContent = visible;
    document.getElementById('emptyState').style.display = visible === 0 ? 'block' : 'none';
});

/*
 * ── BACKEND NOTE ─────────────────────────────────────────────
 * Populate this table from:
 *   SELECT * FROM users WHERE role = 'midwife' AND status = 'approved'
 *
 * The "Revoke" button should call the same approve/reject endpoint
 * used on admin-approvals.html, setting status back to 'rejected'.
 * ─────────────────────────────────────────────────────────────
 */