const MOTHERS = [
  {
    name: 'Nimali Silva', reg: 'MOM001', age: 32, poa: 28, edd: '2026-10-20',
    visits: [
      { date: '2026-06-10', poaWeek: 24, weight: 74.0, bp: '120/80', hb: 11.8, sugar: 95, fhs: 'Normal', notes: 'All measurements within normal range.' },
      { date: '2026-07-08', poaWeek: 28, weight: 77.5, bp: '120/80', hb: 11.8, sugar: 124, fhs: 'Normal', notes: 'Slightly higher blood sugar — advised to reduce sugary drinks.' },
    ],
    nextVisitDate: '2026-08-05'
  },
  {
    name: 'Sanduni Perera', reg: 'MOM014', age: 27, poa: 30, edd: '2026-09-14',
    visits: [
      { date: '2026-06-15', poaWeek: 26, weight: 68.0, bp: '128/86', hb: 10.9, sugar: 92, fhs: 'Normal', notes: 'Blood pressure slightly raised — monitor closely.' },
      { date: '2026-07-06', poaWeek: 30, weight: 70.2, bp: '132/90', hb: 10.6, sugar: 96, fhs: 'Normal', notes: 'Blood pressure still raised. Referred for review.' },
    ],
    nextVisitDate: '2026-07-20'
  },
  {
    name: 'Ruwani Jayasuriya', reg: 'MOM031', age: 24, poa: 18, edd: '2026-12-02',
    visits: [
      { date: '2026-06-20', poaWeek: 16, weight: 58.5, bp: '110/70', hb: 12.4, sugar: 88, fhs: 'Normal', notes: 'Healthy first check-up.' },
      { date: '2026-07-07', poaWeek: 18, weight: 59.8, bp: '112/72', hb: 12.2, sugar: 90, fhs: 'Normal', notes: 'Everything progressing well.' },
    ],
    nextVisitDate: '2026-08-04'
  }
];

let selectedPeriod = 'weekly';
let weightMiniChartInst = null;
let bpMiniChartInst = null;

function renderWeightChart(visits) {
  const labels = visits.map(v => 'Wk ' + v.poaWeek);
  const data = visits.map(v => v.weight);

  if (weightMiniChartInst) weightMiniChartInst.destroy();
  weightMiniChartInst = new Chart(document.getElementById('weightMiniChart'), {
    type: 'line',
    data: {
      labels,
      datasets: [{
        label: 'Weight (kg)',
        data,
        borderColor: '#2563eb',
        backgroundColor: 'rgba(37,99,235,0.10)',
        borderWidth: 3,
        pointBackgroundColor: '#2563eb',
        pointRadius: 5,
        pointHoverRadius: 6,
        fill: true,
        tension: 0.35,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: { callbacks: { label: ctx => ' ' + ctx.parsed.y + ' kg' } }
      },
      scales: {
        x: { grid: { display: false }, ticks: { font: { family: 'Poppins', size: 11 }, color: '#64748b' } },
        y: {
          grid: { color: '#e2e8f0' },
          ticks: { font: { family: 'Poppins', size: 11 }, color: '#64748b', callback: v => v + ' kg' },
          suggestedMin: Math.max(0, Math.min(...data) - 4),
          suggestedMax: Math.max(...data) + 4
        }
      }
    }
  });
}

function renderBpChart(visits) {
  const labels = visits.map(v => 'Wk ' + v.poaWeek);
  const systolic = visits.map(v => parseInt(v.bp.split('/')[0]));
  const diastolic = visits.map(v => parseInt(v.bp.split('/')[1]));

  if (bpMiniChartInst) bpMiniChartInst.destroy();
  bpMiniChartInst = new Chart(document.getElementById('bpMiniChart'), {
    type: 'line',
    data: {
      labels,
      datasets: [
        {
          label: 'Upper number (Systolic)',
          data: systolic,
          borderColor: '#dc2626',
          backgroundColor: 'rgba(220,38,38,0.06)',
          borderWidth: 3,
          pointBackgroundColor: '#dc2626',
          pointRadius: 5,
          pointHoverRadius: 6,
          tension: 0.35,
        },
        {
          label: 'Lower number (Diastolic)',
          data: diastolic,
          borderColor: '#0d9488',
          backgroundColor: 'rgba(13,148,136,0.06)',
          borderWidth: 3,
          pointBackgroundColor: '#0d9488',
          pointRadius: 5,
          pointHoverRadius: 6,
          tension: 0.35,
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: true, position: 'bottom', labels: { font: { family: 'Poppins', size: 10.5 }, boxWidth: 10, padding: 10 } },
        tooltip: { callbacks: { label: ctx => ' ' + ctx.dataset.label + ': ' + ctx.parsed.y } }
      },
      scales: {
        x: { grid: { display: false }, ticks: { font: { family: 'Poppins', size: 11 }, color: '#64748b' } },
        y: {
          grid: { color: '#e2e8f0' },
          ticks: { font: { family: 'Poppins', size: 11 }, color: '#64748b' },
          suggestedMin: 50, suggestedMax: 150
        }
      }
    }
  });
}

function selectPeriod(el) {
  document.querySelectorAll('.period-option').forEach(o => o.classList.remove('checked'));
  el.classList.add('checked');
  selectedPeriod = el.getAttribute('data-period');
}

function periodLabel(p) {
  return { weekly: 'This Week', monthly: 'This Month', all: 'Since First Visit' }[p];
}

/* Simple plain-language health checks (example thresholds only) */
function bpStatus(bp) {
  const [sys, dia] = bp.split('/').map(Number);
  if (sys >= 140 || dia >= 90) return { level: 'alert', text: 'A bit high', note: 'Please attend your next visit soon.' };
  if (sys >= 130 || dia >= 85) return { level: 'watch', text: 'Slightly high', note: 'Keep an eye on this — rest well.' };
  return { level: 'ok', text: 'Normal', note: 'Good — keep it up!' };
}
function hbStatus(hb) {
  if (hb < 10) return { level: 'alert', text: 'Low', note: 'Eat more iron-rich foods (greens, meat, lentils).' };
  if (hb < 11) return { level: 'watch', text: 'A little low', note: 'Try to include more iron-rich foods.' };
  return { level: 'ok', text: 'Normal', note: 'Good — your iron levels look healthy.' };
}
function sugarStatus(sugar) {
  if (sugar >= 140) return { level: 'alert', text: 'High', note: 'Please reduce sugary foods and drinks.' };
  if (sugar >= 110) return { level: 'watch', text: 'Slightly high', note: 'Try to cut down on sweet snacks.' };
  return { level: 'ok', text: 'Normal', note: 'Good — keep a balanced diet.' };
}
function fhsStatus(fhs) {
  if (fhs === 'Normal') return { level: 'ok', text: 'Normal — heartbeat heard clearly', note: "Baby's heartbeat sounds healthy." };
  return { level: 'alert', text: fhs, note: 'Please contact your midwife.' };
}
function weightStatus(gain) {
  if (gain === null) return { level: 'ok', text: '—', note: 'Not enough data yet.' };
  if (gain < 0) return { level: 'watch', text: 'Weight went down', note: 'Please mention this at your next visit.' };
  if (gain > 3) return { level: 'watch', text: `+${gain.toFixed(1)} kg — a bigger jump`, note: 'Slightly more than usual — your midwife will check this.' };
  return { level: 'ok', text: `+${gain.toFixed(1)} kg`, note: 'A healthy, steady weight gain.' };
}

function filterVisitsByPeriod(visits, period) {
  if (period === 'all') return visits;
  const days = period === 'weekly' ? 10 : 35; // small buffer so mock dates still show
  const cutoff = new Date();
  cutoff.setDate(cutoff.getDate() - days);
  const filtered = visits.filter(v => new Date(v.date) >= cutoff);
  return filtered.length ? filtered : visits.slice(-1); // always show at least the latest visit
}

function iconFor(level) {
  return level === 'ok' ? 'bi-check-circle-fill' : level === 'watch' ? 'bi-exclamation-circle-fill' : 'bi-exclamation-triangle-fill';
}

function buildCheckItem(label, status, valueOverride) {
  return `
    <div class="check-item ${status.level}">
      <div class="check-icon"><i class="bi ${iconFor(status.level)}"></i></div>
      <div class="check-text">
        <div class="ct-label">${label}</div>
        <div class="ct-value">${valueOverride || status.text}</div>
        <div class="ct-note">${status.note}</div>
      </div>
    </div>`;
}

function generateReport() {
  const idx = parseInt(document.getElementById('motherSelect').value);
  const mother = MOTHERS[idx];
  const periodVisits = filterVisitsByPeriod(mother.visits, selectedPeriod);
  const latest = periodVisits[periodVisits.length - 1];
  const prev = periodVisits.length > 1 ? periodVisits[periodVisits.length - 2] : null;
  const weightGain = prev ? (latest.weight - prev.weight) : null;

  document.getElementById('repMotherName').textContent = mother.name;
  document.getElementById('repMotherMeta').textContent = `Reg. No ${mother.reg} · ${mother.poa} weeks pregnant · Expected delivery: ${mother.edd}`;
  document.getElementById('repPeriod').innerHTML = `<i class="bi bi-calendar-range"></i> ${periodLabel(selectedPeriod)}`;

  document.getElementById('repGreeting').innerHTML =
    `Hello <strong>${mother.name.split(' ')[0]}</strong>, here is a simple summary of your recent check-up`
    + (periodVisits.length > 1 ? 's' : '') + `. If anything below is marked <strong>orange</strong> or <strong>red</strong>, please don't worry — just follow the note and speak to your midwife at your next visit.`;

  const bp = bpStatus(latest.bp);
  const hb = hbStatus(latest.hb);
  const sugar = sugarStatus(latest.sugar);
  const fhs = fhsStatus(latest.fhs);
  const wt = weightStatus(weightGain);

  document.getElementById('checkGrid').innerHTML =
    buildCheckItem('Blood Pressure', bp, latest.bp) +
    buildCheckItem('Weight Change', wt) +
    buildCheckItem('Iron Level (Haemoglobin)', hb, latest.hb + ' g/dL — ' + hb.text) +
    buildCheckItem('Blood Sugar', sugar, latest.sugar + ' mg/dL — ' + sugar.text) +
    buildCheckItem("Baby's Heartbeat", fhs) +
    buildCheckItem('Current Weight', { level: 'ok', text: latest.weight + ' kg', note: 'Recorded at your last visit.' });

  document.getElementById('visitList').innerHTML = periodVisits.map(v => {
    const d = new Date(v.date);
    const day = d.getDate();
    const month = d.toLocaleDateString('en-GB', { month: 'short' });
    return `
      <div class="visit-row">
        <div class="visit-date"><div class="vd-day">${day}</div><div class="vd-month">${month}</div></div>
        <div class="visit-info">
          <strong>Week ${v.poaWeek}</strong> — Weight ${v.weight} kg, BP ${v.bp}, Baby's heartbeat: ${v.fhs}.<br>
          ${v.notes}
        </div>
      </div>`;
  }).join('');

  document.getElementById('midwifeAdvice').value = latest.notes;

  const nvd = new Date(mother.nextVisitDate);
  document.getElementById('nvSub').textContent =
    nvd.toLocaleDateString('en-GB', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }) + ' — please try not to miss this visit.';

  document.getElementById('repMidwifeName').textContent = 'Priya Fernando (Midwife)';
  document.getElementById('repGenDate').textContent = new Date().toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });

  document.getElementById('reportWrap').style.display = 'block';
  document.getElementById('reportWrap').scrollIntoView({ behavior: 'smooth', block: 'start' });

  // Charts must render after the container becomes visible, otherwise the
  // canvas has zero width and Chart.js draws nothing. Uses the mother's full
  // visit history so the trend line is meaningful even for a short period.
  renderWeightChart(mother.visits);
  renderBpChart(mother.visits);
}

function downloadPDF() {
  const btn = document.getElementById('pdfBtn');
  const original = btn.innerHTML;
  btn.disabled = true;
  btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Preparing…';

  /*
   * html2canvas (used by html2pdf) frequently fails to snapshot *live*
   * <canvas> elements — especially high-DPI ones Chart.js creates — which
   * is why chart areas were coming out blank. The fix: swap each chart
   * canvas for a plain <img> of the same chart right before capturing,
   * then swap the live canvas back afterwards.
   */
  const chartSwaps = [
    { canvasId: 'weightMiniChart', chart: weightMiniChartInst },
    { canvasId: 'bpMiniChart',     chart: bpMiniChartInst }
  ];
  const restoreFns = [];

  chartSwaps.forEach(({ canvasId, chart }) => {
    if (!chart) return;
    const canvas = document.getElementById(canvasId);
    const img = new Image();
    img.src = chart.toBase64Image('image/png', 1);
    img.style.width = canvas.style.width || getComputedStyle(canvas).width;
    img.style.height = getComputedStyle(canvas).height;
    img.style.display = 'block';
    canvas.parentNode.insertBefore(img, canvas);
    canvas.style.display = 'none';
    restoreFns.push(() => { img.remove(); canvas.style.display = ''; });
  });

  const motherName = document.getElementById('repMotherName').textContent.replace(/\s+/g, '-');
  const reportEl = document.getElementById('reportCard');
  const opt = {
    margin: 0.4,
    filename: `Health-Report-${motherName}-${new Date().toISOString().split('T')[0]}.pdf`,
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: {
      scale: 2,
      useCORS: true,
      allowTaint: true,
      logging: false,
      // html2canvas captures based on the page's current scroll position.
      // Without pinning these, a scrolled page captures the wrong vertical
      // slice — which is what was producing near-blank pages.
      scrollX: 0,
      scrollY: 0,
      windowWidth: document.documentElement.scrollWidth,
      windowHeight: document.documentElement.scrollHeight
    },
    jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' },
    pagebreak: { mode: ['css', 'legacy'] }
  };

  // Scroll to the very top first, then wait a moment for layout/scroll and
  // the swapped-in chart <img> elements to settle before capturing.
  window.scrollTo(0, 0);
  setTimeout(() => {
    html2pdf().set(opt).from(reportEl).save()
      .then(() => {
        restoreFns.forEach(fn => fn());
        btn.disabled = false; btn.innerHTML = original;
      })
      .catch(() => {
        restoreFns.forEach(fn => fn());
        btn.disabled = false; btn.innerHTML = original;
        alert('Could not generate PDF. Please try again.');
      });
  }, 250);
}