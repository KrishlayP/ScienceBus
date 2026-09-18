<?php

function render_admin_header_bus()
{
    ?>
    <div class="dashboard-bus-route" aria-hidden="true">
        <svg class="dashboard-bus" viewBox="-18 -5 118 46" fill="none">
            <defs>
                <linearGradient id="dashboardHeadlightGlow" x1="64" y1="20" x2="102" y2="20" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#fef08a" stop-opacity=".85"/>
                    <stop offset="1" stop-color="#fef08a" stop-opacity="0"/>
                </linearGradient>
            </defs>
            <circle class="dashboard-bus-smoke" cx="3" cy="22" r="3"/>
            <circle class="dashboard-bus-smoke" cx="1" cy="20" r="2.5"/>
            <circle class="dashboard-bus-smoke" cx="4" cy="24" r="2"/>
            <path class="dashboard-bus-headlight" d="M61 15 105 4v29L61 21Z"/>
            <path d="M8 8.5C8 5.46 10.46 3 13.5 3h34.9c2.15 0 4.13.97 5.45 2.65L63 17.3V27H8V8.5Z" fill="currentColor"/>
            <path d="M13 8h12v9H13V8Zm16 0h12v9H29V8Zm16 0h5.1c.92 0 1.78.42 2.35 1.14L58.6 17H45V8Z" fill="#dbeafe"/>
            <path d="M5 22h58v5H5a2 2 0 0 1-2-2v-1a2 2 0 0 1 2-2Z" fill="#1d4ed8"/>
            <path d="M12 20h5" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
            <circle class="dashboard-bus-wheel" cx="18" cy="28" r="5" fill="#172554"/>
            <circle cx="18" cy="28" r="2" fill="#bfdbfe"/>
            <circle class="dashboard-bus-wheel" cx="52" cy="28" r="5" fill="#172554"/>
            <circle cx="52" cy="28" r="2" fill="#bfdbfe"/>
        </svg>
    </div>
    <?php
}
