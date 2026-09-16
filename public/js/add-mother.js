/* ===============================
   Today's Date
================================= */
const todayDate = document.getElementById("todayDate");

if (todayDate) {
    todayDate.textContent = new Date().toLocaleDateString("en-GB", {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric"
    });
}


/* ===============================
   NIC Preview
================================= */
function onNicInput(value) {

    const preview = document.getElementById("nicPreview");

    if (!preview) return;

    preview.textContent = value.trim() || "Enter NIC below ↓";
}


/* ===============================
   Calculate Age
================================= */
function calcAge() {

    const dobInput = document.getElementById("dobInput");
    const ageInput = document.getElementById("ageDisplay");

    if (!dobInput || !ageInput) return;

    if (!dobInput.value) {
        ageInput.value = "";
        return;
    }

    const today = new Date();
    const dob = new Date(dobInput.value);

    let age = today.getFullYear() - dob.getFullYear();

    const month = today.getMonth() - dob.getMonth();

    if (
        month < 0 ||
        (month === 0 && today.getDate() < dob.getDate())
    ) {
        age--;
    }

    ageInput.value = age >= 0 ? age : "";
}


/* ===============================
   Calculate EDD
================================= */
function calcEDD() {

    const lmpInput = document.getElementById("lmpInput");
    const eddInput = document.getElementById("eddInput");

    if (!lmpInput || !eddInput) return;

    if (!lmpInput.value) {
        eddInput.value = "";
        return;
    }

    const edd = new Date(lmpInput.value);

    edd.setDate(edd.getDate() + 280);

    const year = edd.getFullYear();
    const month = String(edd.getMonth() + 1).padStart(2, "0");
    const day = String(edd.getDate()).padStart(2, "0");

    eddInput.value = `${year}-${month}-${day}`;
}


/* ===============================
   Pregnancy Status
================================= */
function selectPill(selected) {

    document.querySelectorAll(".status-pill").forEach(function (pill) {
        pill.classList.remove("active");
    });

    selected.classList.add("active");
}


/* ===============================
   Form Submit
================================= */

const form = document.getElementById("addMotherForm");

if (form) {

    form.addEventListener("submit", function () {

        const nic = document.getElementById("nicInput")?.value || "";
        const reg = document.getElementById("regNoDisplay")?.textContent || "";

        const toastSub = document.getElementById("toastSub");

        if (toastSub) {
            toastSub.textContent =
                `Username: ${nic} | Password: ${reg}`;
        }

        // IMPORTANT:
        // No e.preventDefault()
        // Laravel form will submit normally.
    });

}