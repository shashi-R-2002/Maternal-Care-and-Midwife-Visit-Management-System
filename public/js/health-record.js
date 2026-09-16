/* ── Date & Visit default ── */
document.getElementById('todayDate').textContent =
  new Date().toLocaleDateString('en-GB', { weekday:'long', day:'numeric', month:'long', year:'numeric' });
document.getElementById('visitDate').value = new Date().toISOString().split('T')[0];
document.getElementById('wt-date').value   = new Date().toISOString().split('T')[0];

/* ── Tab switching ── */
function switchTab(id, btn) {
  document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('tab-' + id).classList.add('active');
  btn.classList.add('active');
}

/* ── Radio helpers ── */
function toggleRadio(el, groupId) {
  document.querySelectorAll('#' + groupId + ' .radio-option').forEach(o => o.classList.remove('checked'));
  el.classList.add('checked');
}

/* ── Toast ── */
function showToast() {
  const t = document.getElementById('successToast');
  t.style.display = 'block';
  setTimeout(() => { t.style.display = 'none'; }, 4500);
}

/* ══════════════════════════════════════
   WEIGHT CHART MODULE
══════════════════════════════════════ */
// Pre-loaded entries from clinic cards (images)
let weightEntries = [
  { date:'2025-01-10', poa:16, weight:66.0, sfh:null,  preWeight:null },
  { date:'2025-03-10', poa:20, weight:69.0, sfh:20,    preWeight:null },
  { date:'2025-05-10', poa:24, weight:74.0, sfh:24,    preWeight:null },
  { date:'2025-07-10', poa:28, weight:77.5, sfh:27,    preWeight:null },
  { date:'2025-09-10', poa:32, weight:77.0, sfh:null,  preWeight:null },
  { date:'2025-11-10', poa:36, weight:79.0, sfh:36,    preWeight:null },
];

/* Chart instances */
let weightChartInst = null;
let sfhChartInst    = null;

/* Shared chart colours */
const CHART_BLUE  = 'rgba(37,99,235,1)';
const CHART_BLUE_FILL = 'rgba(37,99,235,0.10)';
const CHART_GREEN = 'rgba(5,150,105,1)';
const CHART_GREEN_FILL = 'rgba(5,150,105,0.10)';

function getSorted() {
  return [...weightEntries].sort((a,b) => a.poa - b.poa);
}

function getBmiCat(gain) {
  if (gain === null || gain === undefined) return '—';
  if (gain < 7)  return '<span style="color:#dc2626;font-weight:600;">Low</span>';
  if (gain < 12) return '<span style="color:#16a34a;font-weight:600;">Normal</span>';
  if (gain < 18) return '<span style="color:#d97706;font-weight:600;">High</span>';
  return '<span style="color:#dc2626;font-weight:600;">Very High</span>';
}

function renderWeightChart(sorted) {
  const labels  = sorted.map(e => 'POA ' + e.poa + 'w');
  const weights = sorted.map(e => e.weight);

  if (weightChartInst) weightChartInst.destroy();
  weightChartInst = new Chart(document.getElementById('weightChart'), {
    type: 'line',
    data: {
      labels,
      datasets: [{
        label: 'Weight (kg)',
        data: weights,
        borderColor: CHART_BLUE,
        backgroundColor: CHART_BLUE_FILL,
        borderWidth: 2.5,
        pointBackgroundColor: CHART_BLUE,
        pointRadius: 5,
        pointHoverRadius: 7,
        fill: true,
        tension: 0.35,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: ctx => ' ' + ctx.parsed.y + ' kg'
          }
        }
      },
      scales: {
        x: { grid: { color: '#f1f5f9' }, ticks: { font: { family:'Poppins', size:11 }, color:'#64748b' } },
        y: {
          grid: { color: '#f1f5f9' },
          ticks: { font: { family:'Poppins', size:11 }, color:'#64748b', callback: v => v + ' kg' },
          suggestedMin: Math.max(0, Math.min(...weights) - 5),
          suggestedMax: Math.max(...weights) + 5
        }
      }
    }
  });
}

function renderSFHChart(sorted) {
  const withSFH  = sorted.filter(e => e.sfh !== null && e.sfh !== undefined && e.sfh !== '');
  const labels   = withSFH.map(e => 'POA ' + e.poa + 'w');
  const sfhVals  = withSFH.map(e => parseFloat(e.sfh));

  if (sfhChartInst) sfhChartInst.destroy();
  sfhChartInst = new Chart(document.getElementById('sfhChart'), {
    type: 'line',
    data: {
      labels,
      datasets: [{
        label: 'Fundal Height (cm)',
        data: sfhVals,
        borderColor: CHART_GREEN,
        backgroundColor: CHART_GREEN_FILL,
        borderWidth: 2.5,
        pointBackgroundColor: CHART_GREEN,
        pointRadius: 5,
        pointHoverRadius: 7,
        fill: true,
        tension: 0.35,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: { callbacks: { label: ctx => ' ' + ctx.parsed.y + ' cm' } }
      },
      scales: {
        x: { grid: { color: '#f1f5f9' }, ticks: { font: { family:'Poppins', size:11 }, color:'#64748b' } },
        y: {
          grid: { color: '#f1f5f9' },
          ticks: { font: { family:'Poppins', size:11 }, color:'#64748b', callback: v => v + ' cm' },
          suggestedMin: 0, suggestedMax: 45
        }
      }
    }
  });
}

function renderTable(sorted) {
  const tbody = document.getElementById('wt-tbody');
  const emptyRow = document.getElementById('wt-empty-row');

  if (sorted.length === 0) {
    tbody.innerHTML = '';
    tbody.appendChild(emptyRow);
    emptyRow.style.display = '';
    document.getElementById('wt-table-footer').textContent = '0 entries recorded';
    return;
  }

  // Find first entry with pre-pregnancy weight for gain calculation
  let preWt = null;
  for (const e of sorted) { if (e.preWeight) { preWt = parseFloat(e.preWeight); break; } }

  tbody.innerHTML = '';
  sorted.forEach((e, i) => {
    const gain = (preWt !== null) ? (e.weight - preWt).toFixed(1) : null;
    const gainDisplay = gain !== null
      ? (gain >= 0 ? '+' + gain : gain) + ' kg'
      : '<span style="color:#94a3b8;">—</span>';
    const sfhDisplay = (e.sfh !== null && e.sfh !== undefined && e.sfh !== '')
      ? e.sfh + ' cm'
      : '<span style="color:#94a3b8;">—</span>';
    const bmiCat = gain !== null ? getBmiCat(parseFloat(gain)) : '—';

    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td style="color:#94a3b8;font-size:12px;">${i+1}</td>
      <td><i class="bi bi-calendar3" style="color:#94a3b8;font-size:11px;margin-right:3px;"></i>${e.date || '—'}</td>
      <td><span class="poa-badge">${e.poa} wks</span></td>
      <td style="font-weight:600;color:#1e293b;">${e.weight} kg</td>
      <td>${gainDisplay}</td>
      <td>${sfhDisplay}</td>
      <td>${bmiCat}</td>
      <td>
        <button class="btn-tbl del" onclick="deleteEntry(${i})">
          <i class="bi bi-trash-fill"></i> Remove
        </button>
      </td>`;
    tbody.appendChild(tr);
  });

  document.getElementById('wt-table-footer').textContent = sorted.length + ' entr' + (sorted.length === 1 ? 'y' : 'ies') + ' recorded';
}

function updateStats(sorted) {
  if (sorted.length === 0) {
    document.getElementById('stat-gain').textContent = '—';
    document.getElementById('stat-latest-wt').textContent = '—';
    document.getElementById('stat-latest-sfh').textContent = '—';
    document.getElementById('stat-entries').textContent = '0';
    return;
  }
  const last = sorted[sorted.length - 1];
  let preWt = null;
  for (const e of sorted) { if (e.preWeight) { preWt = parseFloat(e.preWeight); break; } }
  const gain = preWt !== null ? (last.weight - preWt).toFixed(1) : '—';

  document.getElementById('stat-gain').textContent = gain !== '—' ? (gain >= 0 ? '+' + gain : gain) + ' kg' : '—';
  document.getElementById('stat-latest-wt').textContent = last.weight + ' kg';
  const sfhVals = sorted.filter(e => e.sfh).map(e => e.sfh);
  document.getElementById('stat-latest-sfh').textContent = sfhVals.length ? sfhVals[sfhVals.length-1] + ' cm' : '—';
  document.getElementById('stat-entries').textContent = sorted.length;
}

function refreshAll() {
  const sorted = getSorted();
  renderWeightChart(sorted);
  renderSFHChart(sorted);
  renderTable(sorted);
  updateStats(sorted);
}

function showWtError(msg) {
  document.getElementById('wt-error-msg').textContent = msg;
  document.getElementById('wt-error').style.display = 'block';
  setTimeout(() => { document.getElementById('wt-error').style.display = 'none'; }, 4000);
}

function addWeightEntry() {
  const date   = document.getElementById('wt-date').value;
  const poa    = parseInt(document.getElementById('wt-poa').value);
  const weight = parseFloat(document.getElementById('wt-weight').value);
  const sfh    = document.getElementById('wt-sfh').value.trim();
  const pre    = document.getElementById('wt-pre').value.trim();

  if (!poa || isNaN(poa) || poa < 4 || poa > 45) {
    showWtError('Please enter a valid POA between 4 and 45 weeks.'); return;
  }
  if (!weight || isNaN(weight) || weight < 30 || weight > 200) {
    showWtError('Please enter a valid weight between 30 and 200 kg.'); return;
  }
  if (weightEntries.some(e => e.poa === poa)) {
    showWtError('An entry for POA ' + poa + ' weeks already exists. Delete it first to update.'); return;
  }

  weightEntries.push({
    date,
    poa,
    weight,
    sfh: sfh !== '' ? parseFloat(sfh) : null,
    preWeight: pre !== '' ? parseFloat(pre) : null,
  });

  // Clear inputs (keep date)
  document.getElementById('wt-poa').value    = '';
  document.getElementById('wt-weight').value = '';
  document.getElementById('wt-sfh').value    = '';
  document.getElementById('wt-pre').value    = '';
  document.getElementById('wt-error').style.display = 'none';

  refreshAll();

  // Brief flash toast
  const t = document.getElementById('successToast');
  t.querySelector('.toast-title').textContent = 'Weight Entry Added!';
  t.querySelector('.toast-sub').textContent = 'POA ' + poa + ' wks — ' + weight + ' kg';
  t.style.display = 'block';
  setTimeout(() => { t.style.display = 'none'; }, 3500);
}

function deleteEntry(sortedIndex) {
  const sorted = getSorted();
  const entry  = sorted[sortedIndex];
  // Remove by matching poa+weight
  const idx = weightEntries.findIndex(e => e.poa === entry.poa && e.weight === entry.weight);
  if (idx !== -1) weightEntries.splice(idx, 1);
  refreshAll();
}

function clearAllEntries() {
  if (!confirm('Remove all weight entries? This cannot be undone.')) return;
  weightEntries = [];
  refreshAll();
}

/* Init charts once DOM is ready */
window.addEventListener('load', () => {
  refreshAll();
});