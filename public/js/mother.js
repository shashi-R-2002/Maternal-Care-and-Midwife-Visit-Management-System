/* Live date */
document.getElementById('todayDate').textContent =
    new Date().toLocaleDateString('en-GB', { weekday:'long', day:'numeric', month:'long', year:'numeric' });

/* EDD colour coding */
function colorEDD() {
    const today = new Date(); today.setHours(0,0,0,0);
    document.querySelectorAll('.edd-cell[data-edd]').forEach(cell => {
        const edd = new Date(cell.dataset.edd);
        const diff = Math.round((edd - today) / (1000*60*60*24));
        cell.classList.remove('soon','near','ok','past');
        if (diff < 0)       cell.classList.add('past');
        else if (diff <= 14) cell.classList.add('soon');
        else if (diff <= 45) cell.classList.add('near');
        else                 cell.classList.add('ok');
    });
}
colorEDD();

/* Search & filter */
function filterTable() {
    const q      = document.getElementById('searchInput').value.toLowerCase();
    const status = document.getElementById('statusFilter').value;
    const rows   = document.querySelectorAll('#tableBody tr');
    let visible  = 0;

    rows.forEach(row => {
        const name   = row.dataset.name.toLowerCase();
        const reg    = row.dataset.reg.toLowerCase();
        const rowSt  = row.dataset.status;
        const matchQ = !q || name.includes(q) || reg.includes(q);
        const matchS = !status || rowSt === status;
        if (matchQ && matchS) { row.style.display = ''; visible++; }
        else                  { row.style.display = 'none'; }
    });

    document.getElementById('showCount').textContent  = visible;
    document.getElementById('footerCount').textContent = `Showing ${visible} of ${rows.length} mothers`;
    document.getElementById('emptyState').style.display = visible === 0 ? 'block' : 'none';
}