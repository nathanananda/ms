import "./bootstrap";
import "preline";

import "../css/app.css";

import VanillaCalendar from "@uvarov.frontend/vanilla-calendar";
import "@uvarov.frontend/vanilla-calendar/build/vanilla-calendar.min.css";

document.addEventListener("DOMContentLoaded", () => {
    // Initialize VanillaCalendar
    const calendar = new VanillaCalendar("#calendar", {
        settings: {
            visibility: {
                theme: "light",
            },
            iso8601: true,
        },
    });
    calendar.init();

    // ✅ Initialize Preline overlays (modals)
    window.HSOverlay?.autoInit();
});

console.log(window.HSOverlay); // should not be undefined
