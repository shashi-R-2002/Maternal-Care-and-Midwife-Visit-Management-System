document.getElementById('todayDate').textContent =
    new Date().toLocaleDateString('en-GB',{weekday:'long',day:'numeric',month:'long',year:'numeric'});

const viewModalEl    = document.getElementById('viewModal');
const confirmModalEl = document.getElementById('confirmModal');
const viewModal    = new bootstrap.Modal(viewModalEl);
const confirmModal = new bootstrap.Modal(confirmModalEl);

let pendingAction = null;
let pendingRow    = null;

function openView(btn) {
    const row    = btn.closest('tr');
    const status = row.getAttribute('data-status');
    const d = {
        id: row.getAttribute('data-id'),
        fullname: row.getAttribute('data-fullname'),
        email: row.getAttribute('data-email'),
        nic: row.getAttribute('data-nic').toUpperCase(),
        phone: row.getAttribute('data-phone'),
        address: row.getAttribute('data-address'),
        qualification: row.getAttribute('data-qualification'),
        regdate: row.getAttribute('data-regdate'),
        avatarColor: row.getAttribute('data-avatar-color'),
        initials: row.getAttribute('data-initials'),
        rejectReason: row.getAttribute('data-reject-reason') || '',
    };

    const av = document.getElementById('vm-avatar');
    av.textContent = d.initials;
    av.style.background = d.avatarColor;

    document.getElementById('vm-name').textContent        = d.fullname;
    document.getElementById('vm-email').textContent       = d.email;
    document.getElementById('vm-id').textContent          = d.id;
    document.getElementById('vm-nic').textContent         = d.nic;
    document.getElementById('vm-phone').textContent       = d.phone;
    document.getElementById('vm-regdate').textContent     = d.regdate;
    document.getElementById('vm-address').textContent     = d.address;
    document.getElementById('vm-qualification').textContent = d.qualification;

    const ab     = document.getElementById('vm-access-block');
    const aiEl   = document.getElementById('vm-access-icon');
    const atEl   = document.getElementById('vm-access-title');
    const asEl   = document.getElementById('vm-access-sub');
    const credB  = document.getElementById('vm-cred-block');
    const rejectB= document.getElementById('vm-reject-box');

    ab.className     = 'access-block ' + status;
    credB.style.display  = 'none';
    rejectB.style.display = 'none';

    if (status === 'pending') {
        aiEl.innerHTML = '<i class="bi bi-hourglass-split"></i>';
        atEl.textContent = 'Awaiting Admin Approval';
        asEl.textContent = 'This midwife registered but cannot log in yet. Approve to grant access.';
    } else if (status === 'approved') {
        aiEl.innerHTML = '<i class="bi bi-unlock-fill"></i>';
        atEl.textContent = 'Access Granted — Can Log In';
        asEl.textContent = 'Login credentials: email address + chosen password.';
        credB.style.display = 'block';
        document.getElementById('vm-cred-user').textContent = d.email;
    } else {
        aiEl.innerHTML = '<i class="bi bi-lock-fill"></i>';
        atEl.textContent = 'Access Denied — Cannot Log In';
        asEl.textContent = 'This midwife was rejected and cannot access the system.';
        if (d.rejectReason) {
            rejectB.style.display = 'block';
            document.getElementById('vm-reject-reason').textContent = d.rejectReason;
        }
    }

    const footer = document.getElementById('vm-footer');
    let extraBtns = '';
    if (status === 'pending') {
        extraBtns = `
            <button class="btn-modal view-reject"  onclick="fromView('reject',  '${d.fullname}')"><i class="bi bi-x-lg"></i> Reject</button>
            <button class="btn-modal view-approve" onclick="fromView('approve', '${d.fullname}')"><i class="bi bi-check-lg"></i> Approve</button>`;
    } else if (status === 'approved') {
        extraBtns = `<button class="btn-modal view-reject" onclick="fromView('reject', '${d.fullname}')"><i class="bi bi-x-lg"></i> Revoke Access</button>`;
    } else {
        extraBtns = `<button class="btn-modal view-approve" onclick="fromView('approve', '${d.fullname}')"><i class="bi bi-check-lg"></i> Re-approve</button>`;
    }
    footer.innerHTML = `<button class="btn-modal cancel" data-bs-dismiss="modal">Close</button>${extraBtns}`;

    viewModalEl.setAttribute('data-row-name', d.fullname);
    viewModal.show();
}

function fromView(type, name) {
    const rows = document.querySelectorAll('#tableBody tr');
    let targetRow = null;
    rows.forEach(r => { if (r.getAttribute('data-fullname') === name) targetRow = r; });
    viewModal.hide();
    setTimeout(() => openConfirmForRow(type, targetRow), 350);
}

function openConfirm(type, btn) {
    openConfirmForRow(type, btn.closest('tr'));
}

function openConfirmForRow(type, row) {
    pendingAction = type;
    pendingRow    = row;
    const name      = row.getAttribute('data-fullname');
    const isApprove = type === 'approve';

    document.getElementById('c-header').className     = 'modal-header ' + (isApprove ? 'approve-header' : 'reject-header');
    document.getElementById('c-icon-wrap').className  = 'modal-icon-wrap ' + (isApprove ? 'green' : 'red');
    document.getElementById('c-icon').className       = 'bi ' + (isApprove ? 'bi-person-check-fill' : 'bi-person-x-fill');
    document.getElementById('c-heading').textContent  = isApprove ? 'Approve Midwife' : 'Reject Midwife';

    document.getElementById('c-body').innerHTML = isApprove
        ? `Are you sure you want to <strong>approve</strong> <span class="target-name">${name}</span>? They will be granted login access to the Midwife portal.`
        : `Are you sure you want to <strong>reject</strong> <span class="target-name">${name}</span>? They will <strong>not</strong> be able to log in until re-approved.`;

    const reasonWrap = document.getElementById('c-reason-wrap');
    const reasonTA   = document.getElementById('c-reason');
    reasonWrap.style.display = isApprove ? 'none' : 'block';
    reasonTA.value = '';

    const btn = document.getElementById('c-btn');
    btn.textContent = isApprove ? '✓  Approve' : '✕  Reject';
    btn.className   = 'btn-modal ' + (isApprove ? 'confirm-approve' : 'confirm-reject');

    confirmModal.show();
}

function executeAction() {
    confirmModal.hide();

    const isApprove = pendingAction === 'approve';
    const row       = pendingRow;
    const name      = row.getAttribute('data-fullname');
    const reason    = document.getElementById('c-reason').value.trim();

    const newStatus = isApprove ? 'approved' : 'rejected';
    row.setAttribute('data-status', newStatus);
    if (!isApprove && reason) row.setAttribute('data-reject-reason', reason);

    const badge = row.querySelector('.status-badge');
    if (isApprove) {
        badge.className = 'status-badge approved';
        badge.innerHTML = '<span class="dot"></span>Approved';
    } else {
        badge.className = 'status-badge rejected';
        badge.innerHTML = '<span class="dot"></span>Rejected';
    }

    const cells = row.querySelectorAll('td');
    if (isApprove) {
        cells[5].innerHTML = `<span style="display:inline-flex;align-items:center;gap:5px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:3px 9px;font-size:11px;font-weight:600;color:#166534;"><i class="bi bi-unlock-fill"></i>Access granted</span>`;
    } else {
        cells[5].innerHTML = `<span style="display:inline-flex;align-items:center;gap:5px;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:3px 9px;font-size:11px;font-weight:600;color:#991b1b;"><i class="bi bi-lock-fill"></i>Access denied</span>`;
    }

    const ag = row.querySelector('.action-group');
    if (isApprove) {
        ag.innerHTML = `
            <button class="btn-action view"   onclick="openView(this)"><i class="bi bi-eye-fill"></i></button>
            <button class="btn-action reject" onclick="openConfirm('reject', this)"><i class="bi bi-x-lg"></i> Revoke</button>`;
    } else {
        ag.innerHTML = `
            <button class="btn-action view"    onclick="openView(this)"><i class="bi bi-eye-fill"></i></button>
            <button class="btn-action approve" onclick="openConfirm('approve', this)"><i class="bi bi-check-lg"></i> Re-approve</button>`;
    }

    recount();
    showToast(isApprove, name);

    /*
     * BACKEND HOOK:
     * fetch('/admin/midwife/' + row.getAttribute('data-id') + '/status', {
     *     method: 'POST',
     *     headers: { 'Content-Type': 'application/json' },
     *     body: JSON.stringify({ status: newStatus, reason: reason })
     * }).then(r => r.json()).then(data => { ... });
     *
     * midwife-list.html reads WHERE role='midwife' AND status='approved'
     * so once backend is connected, approving here automatically
     * makes the midwife show up there.
     */
}

function recount() {
    const all  = document.querySelectorAll('#tableBody tr');
    let pending = 0, approved = 0, rejected = 0;
    all.forEach(r => {
        const s = r.getAttribute('data-status');
        if (s === 'pending')  pending++;
        if (s === 'approved') approved++;
        if (s === 'rejected') rejected++;
    });
    document.getElementById('countPending').textContent  = pending;
    document.getElementById('countApproved').textContent = approved;
    document.getElementById('countRejected').textContent = rejected;
    document.getElementById('countTotal').textContent    = all.length;
    document.getElementById('pill-pending').textContent  = pending;
    document.getElementById('pill-approved').textContent = approved;
    document.getElementById('pill-rejected').textContent = rejected;
    document.getElementById('pill-all').textContent      = all.length;
    document.getElementById('totalCount').textContent    = all.length;
}

function showToast(isApprove, name) {
    document.getElementById('toastIcon').className   = 'toast-icon ' + (isApprove ? 'green' : 'red');
    document.getElementById('toastIcon').innerHTML   = isApprove ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-x-circle-fill"></i>';
    document.getElementById('toastTitle').textContent = isApprove ? 'Midwife Approved!' : 'Midwife Rejected';
    document.getElementById('toastSub').textContent   = name + (isApprove ? ' can now log in.' : ' has been denied access.');
    const w = document.getElementById('toastWrap');
    w.style.display = 'block';
    setTimeout(() => { w.style.display = 'none'; }, 4500);
}

document.querySelectorAll('.filter-pill').forEach(pill => {
    pill.addEventListener('click', function() {
        document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        filterTable(this.getAttribute('data-filter'), document.getElementById('searchInput').value);
    });
});

document.getElementById('searchInput').addEventListener('input', function() {
    const activeFilter = document.querySelector('.filter-pill.active').getAttribute('data-filter');
    filterTable(activeFilter, this.value);
});

function filterTable(filter, search) {
    const rows = document.querySelectorAll('#tableBody tr');
    const q = search.toLowerCase().trim();
    let visible = 0;
    rows.forEach(row => {
        const statusMatch = filter === 'all' || row.getAttribute('data-status') === filter;
        const searchMatch = !q || row.getAttribute('data-name').includes(q) || row.getAttribute('data-nic').includes(q) || (row.getAttribute('data-fullname') || '').toLowerCase().includes(q);
        const show = statusMatch && searchMatch;
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });
    document.getElementById('visibleCount').textContent = visible;
}
