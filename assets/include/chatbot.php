<?php
// ITC Smart Chatbot — Enhanced with Full Product Database
// Include in assets/include/footer.php just before </body>
?>

<!-- ITC CHATBOT POPUP -->
<div id="itc-chat-btn" onclick="itcToggleChat()" title="Chat with us">
    <div id="itc-chat-icon">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="white">
            <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z" />
        </svg>
    </div>
    <div id="itc-chat-close-icon" style="display:none;">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="white">
            <path
                d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
        </svg>
    </div>
    <span id="itc-chat-badge">1</span>
</div>

<div id="itc-chat-window">
    <div id="itc-chat-header">
        <div id="itc-chat-header-left">
            <div id="itc-chat-avatar">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="white">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                </svg>
            </div>
            <div>
                <div id="itc-chat-header-name">ITC Assistant</div>
                <div id="itc-chat-header-status"><span class="itc-dot"></span> Online — Ask me anything!</div>
            </div>
        </div>
        <div style="display:flex;gap:4px;">
            <button onclick="itcMinimize()" class="itc-hbtn" title="Minimize">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13H5v-2h14v2z" />
                </svg>
            </button>
            <button onclick="itcToggleChat()" class="itc-hbtn" title="Close">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </button>
        </div>
    </div>
    <div id="itc-chat-messages"></div>
    <div id="itc-quick-replies"></div>
    <div id="itc-chat-input-area">
        <input type="text" id="itc-chat-input" placeholder="Ask about products, prices, orders…"
            onkeydown="if(event.key==='Enter')itcSend()" autocomplete="off" />
        <button id="itc-send-btn" onclick="itcSend()">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="white">
                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
            </svg>
        </button>
    </div>
</div>

<!-- ================================================================
     STYLES
     ================================================================ -->
<style>
:root {
    --ic-p: #1a5276;
    --ic-s: #2e86c1;
    --ic-acc: #f39c12;
    --ic-bg: #f0f4f8;
    --ic-w: #fff;
    --ic-txt: #2c3e50;
    --ic-bdr: #dce3ec;
    --ic-r: 16px;
    --ic-shd: 0 10px 48px rgba(26, 82, 118, .24);
}

/* --- Toggle Button --- */
#itc-chat-btn {
    position: fixed;
    bottom: 28px;
    right: 28px;
    width: 62px;
    height: 62px;
    background: linear-gradient(135deg, var(--ic-p), var(--ic-s));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 99999;
    box-shadow: 0 6px 24px rgba(26, 82, 118, .45);
    transition: transform .3s, box-shadow .3s;
    animation: icPulse 2.5s infinite;
}

#itc-chat-btn:hover {
    transform: scale(1.1);
    animation: none;
    box-shadow: 0 10px 32px rgba(26, 82, 118, .6);
}

@keyframes icPulse {
    0% {
        box-shadow: 0 6px 24px rgba(26, 82, 118, .45), 0 0 0 0 rgba(46, 134, 193, .5);
    }

    70% {
        box-shadow: 0 6px 24px rgba(26, 82, 118, .45), 0 0 0 14px rgba(46, 134, 193, 0);
    }

    100% {
        box-shadow: 0 6px 24px rgba(26, 82, 118, .45), 0 0 0 0 rgba(46, 134, 193, 0);
    }
}

#itc-chat-badge {
    position: absolute;
    top: -4px;
    right: -4px;
    background: #e74c3c;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #fff;
    animation: icBadge 1s ease infinite;
}

@keyframes icBadge {

    0%,
    100% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.25);
    }
}

/* --- Window --- */
#itc-chat-window {
    position: fixed;
    bottom: 104px;
    right: 28px;
    width: 380px;
    max-height: 580px;
    background: var(--ic-w);
    border-radius: var(--ic-r);
    box-shadow: var(--ic-shd);
    display: none;
    flex-direction: column;
    z-index: 99998;
    overflow: hidden;
    border: 1px solid var(--ic-bdr);
    font-family: 'Segoe UI', Arial, sans-serif;
    animation: icSlide .35s cubic-bezier(.25, .8, .25, 1);
}

#itc-chat-window.ic-open {
    display: flex;
}

@keyframes icSlide {
    from {
        opacity: 0;
        transform: translateY(20px) scale(.96);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* --- Header --- */
#itc-chat-header {
    background: linear-gradient(135deg, var(--ic-p), var(--ic-s));
    padding: 14px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
}

#itc-chat-header-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

#itc-chat-avatar {
    width: 42px;
    height: 42px;
    background: rgba(255, 255, 255, .2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(255, 255, 255, .4);
    flex-shrink: 0;
}

#itc-chat-header-name {
    color: #fff;
    font-weight: 700;
    font-size: 15px;
}

#itc-chat-header-status {
    color: rgba(255, 255, 255, .85);
    font-size: 11.5px;
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 2px;
}

.itc-dot {
    width: 8px;
    height: 8px;
    background: #2ecc71;
    border-radius: 50%;
    animation: icBlink 1.5s infinite;
}

@keyframes icBlink {

    0%,
    100% {
        opacity: 1;
    }

    50% {
        opacity: .3;
    }
}

.itc-hbtn {
    background: rgba(255, 255, 255, .15);
    border: none;
    color: #fff;
    width: 30px;
    height: 30px;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s;
}

.itc-hbtn:hover {
    background: rgba(255, 255, 255, .3);
}

/* --- Messages --- */
#itc-chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 14px 12px 8px;
    background: var(--ic-bg);
    display: flex;
    flex-direction: column;
    gap: 10px;
    scroll-behavior: smooth;
}

#itc-chat-messages::-webkit-scrollbar {
    width: 4px;
}

#itc-chat-messages::-webkit-scrollbar-thumb {
    background: #c0cfe0;
    border-radius: 4px;
}

.ic-row {
    display: flex;
    align-items: flex-end;
    gap: 8px;
    animation: icFade .3s ease;
}

@keyframes icFade {
    from {
        opacity: 0;
        transform: translateY(8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.ic-row.ic-user {
    flex-direction: row-reverse;
}

.ic-avt {
    width: 28px;
    height: 28px;
    background: linear-gradient(135deg, var(--ic-p), var(--ic-s));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.ic-bbl {
    max-width: 82%;
    padding: 10px 14px;
    border-radius: 18px;
    font-size: 13.5px;
    line-height: 1.58;
    word-break: break-word;
}

.ic-bot .ic-bbl {
    background: #fff;
    border-bottom-left-radius: 4px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, .09);
    color: var(--ic-txt);
}

.ic-user .ic-bbl {
    background: var(--ic-p);
    border-bottom-right-radius: 4px;
    color: #fff;
    box-shadow: 0 2px 8px rgba(26, 82, 118, .3);
}

.ic-bbl a {
    color: var(--ic-s);
    text-decoration: underline;
}

.ic-user .ic-bbl a {
    color: #aed6f1;
}

.ic-ts {
    font-size: 10px;
    color: #9aacbe;
    margin-top: 2px;
    padding: 0 4px;
}

.ic-user .ic-ts {
    text-align: right;
}

/* Product Card */
.ic-card {
    background: #fff;
    border: 1.5px solid var(--ic-bdr);
    border-radius: 12px;
    overflow: hidden;
    margin-top: 4px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, .07);
}

.ic-card-header {
    background: linear-gradient(135deg, #1a5276, #2e86c1);
    padding: 10px 12px;
    color: #fff;
}

.ic-card-title {
    font-weight: 700;
    font-size: 13px;
    line-height: 1.3;
}

.ic-card-sub {
    font-size: 11px;
    opacity: .85;
    margin-top: 2px;
}

.ic-card-body {
    padding: 10px 12px;
}

.ic-spec-row {
    display: flex;
    justify-content: space-between;
    padding: 4px 0;
    border-bottom: 1px solid #f0f0f0;
    font-size: 12px;
}

.ic-spec-row:last-child {
    border-bottom: none;
}

.ic-spec-key {
    color: #7f8c8d;
    font-weight: 500;
}

.ic-spec-val {
    color: var(--ic-txt);
    font-weight: 600;
    text-align: right;
    max-width: 55%;
}

.ic-price-box {
    background: #f8fbff;
    border-radius: 8px;
    padding: 8px 10px;
    margin: 8px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.ic-price-range {
    font-size: 15px;
    font-weight: 800;
    color: #1a5276;
}

.ic-price-gst {
    font-size: 10px;
    color: #7f8c8d;
}

.ic-badge-row {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin: 6px 0;
}

.ic-badge {
    font-size: 10px;
    padding: 2px 7px;
    border-radius: 10px;
    font-weight: 600;
}

.ic-badge-ibr {
    background: #fff3e0;
    color: #e65100;
}

.ic-badge-stock {
    background: #e8f5e9;
    color: #2e7d32;
}

.ic-badge-out {
    background: #ffebee;
    color: #c62828;
}

.ic-badge-cert {
    background: #e3f2fd;
    color: #1565c0;
}

.ic-badge-rating {
    background: #fce4ec;
    color: #880e4f;
}

.ic-feat-list {
    margin: 6px 0 0;
    padding: 0;
    list-style: none;
}

.ic-feat-list li {
    font-size: 12px;
    color: #444;
    padding: 3px 0;
    display: flex;
    gap: 5px;
}

.ic-feat-list li::before {
    content: "✓";
    color: #27ae60;
    font-weight: 700;
    flex-shrink: 0;
}

.ic-card-actions {
    display: flex;
    gap: 6px;
    padding: 10px 12px;
    border-top: 1px solid var(--ic-bdr);
    background: #fafcff;
}

.ic-btn-view {
    flex: 1;
    background: linear-gradient(135deg, #1a5276, #2e86c1);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    display: block;
    transition: opacity .2s;
}

.ic-btn-view:hover {
    opacity: .88;
    color: #fff;
}

.ic-btn-quote {
    flex: 1;
    background: #fff;
    color: #1a5276;
    border: 1.5px solid #1a5276;
    border-radius: 8px;
    padding: 8px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    display: block;
    transition: all .2s;
}

.ic-btn-quote:hover {
    background: #1a5276;
    color: #fff;
}

.ic-offer-box {
    background: linear-gradient(135deg, #fff8e1, #fffde7);
    border: 1.5px solid #ffe082;
    border-radius: 10px;
    padding: 8px 10px;
    margin-top: 6px;
}

.ic-offer-item {
    font-size: 12px;
    color: #5d4037;
    padding: 3px 0;
    display: flex;
    align-items: flex-start;
    gap: 6px;
}

.ic-search-list {
    margin: 6px 0 0;
}

.ic-search-item {
    background: #fff;
    border: 1px solid var(--ic-bdr);
    border-radius: 8px;
    padding: 8px 10px;
    margin-bottom: 5px;
    cursor: pointer;
    transition: all .2s;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.ic-search-item:hover {
    border-color: var(--ic-s);
    background: #eaf3fb;
}

.ic-search-item-name {
    font-size: 12.5px;
    font-weight: 600;
    color: var(--ic-txt);
}

.ic-search-item-meta {
    font-size: 11px;
    color: #7f8c8d;
    margin-top: 2px;
}

.ic-search-item-price {
    font-size: 12px;
    font-weight: 700;
    color: #1a5276;
    text-align: right;
    white-space: nowrap;
}

/* Quick Replies */
#itc-quick-replies {
    padding: 8px 10px;
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    background: var(--ic-bg);
    border-top: 1px solid var(--ic-bdr);
    max-height: 88px;
    overflow-y: auto;
}

.ic-chip {
    background: #fff;
    border: 1.5px solid var(--ic-s);
    color: var(--ic-s);
    padding: 5px 11px;
    border-radius: 20px;
    font-size: 12px;
    cursor: pointer;
    transition: all .2s;
    font-weight: 500;
    white-space: nowrap;
}

.ic-chip:hover {
    background: var(--ic-s);
    color: #fff;
    transform: translateY(-1px);
}

/* Typing */
#ic-typing {
    display: none;
    align-items: flex-end;
    gap: 8px;
    animation: icFade .3s;
}

.ic-dots {
    display: flex;
    gap: 4px;
    align-items: center;
}

.ic-dots span {
    width: 7px;
    height: 7px;
    background: #9aacbe;
    border-radius: 50%;
    animation: icDot 1.4s infinite ease-in-out;
}

.ic-dots span:nth-child(2) {
    animation-delay: .2s;
}

.ic-dots span:nth-child(3) {
    animation-delay: .4s;
}

@keyframes icDot {

    0%,
    80%,
    100% {
        transform: scale(.7);
        opacity: .5;
    }

    40% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Input */
#itc-chat-input-area {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 12px;
    background: #fff;
    border-top: 1px solid var(--ic-bdr);
    flex-shrink: 0;
}

#itc-chat-input {
    flex: 1;
    border: 1.5px solid var(--ic-bdr);
    border-radius: 24px;
    padding: 9px 16px;
    font-size: 13px;
    outline: none;
    color: var(--ic-txt);
    background: var(--ic-bg);
    transition: border-color .2s;
    font-family: inherit;
}

#itc-chat-input:focus {
    border-color: var(--ic-s);
    background: #fff;
}

#itc-send-btn {
    width: 38px;
    height: 38px;
    background: linear-gradient(135deg, var(--ic-p), var(--ic-s));
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform .2s, box-shadow .2s;
    flex-shrink: 0;
}

#itc-send-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 14px rgba(26, 82, 118, .4);
}

/* Mobile */
@media(max-width:480px) {
    #itc-chat-window {
        width: calc(100vw - 16px);
        right: 8px;
        bottom: 86px;
        max-height: 80vh;
    }

    #itc-chat-btn {
        right: 14px;
        bottom: 80px !important;
        width: 56px;
        height: 56px;
    }
}
</style>

<!-- ================================================================
     JAVASCRIPT — SMART CHATBOT ENGINE
     ================================================================ -->
<script>
(function() {
    'use strict';

    /* ================================================================
       PRODUCT DATABASE (from itc_db.sql)
       ================================================================ */
    const ITC_PRODUCTS = [{
            id: 1,
            name: "Bronze IBR Certified Globe Steam Stop Valve",
            slug: "bronze-ibr-globe-steam-stop-valve",
            subtitle: "IBR Approved • High Temperature",
            desc: "IBR Certified steam stop valve for high-temperature applications in boiler systems. Manufactured from high-grade cast bronze / gunmetal alloy for maximum corrosion resistance.",
            category: "Gate / Globe Valves",
            badge: "IBR",
            price_min: 1320.95,
            price_max: 19688,
            mrp: 1620,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "3–5 Days",
            warranty: "Mfr. Terms",
            cert: "ISO • IBR",
            rating: 4.8,
            orders: "1000+",
            specs: [
                ["Material", "Cast Bronze / Gunmetal Alloy"],
                ["Certification", "IBR Approved • ISO 9001:2008"],
                ["Connection Type", "Flanged / Threaded"],
                ["Pressure Rating", "PN 16 to PN 25"],
                ["Size Range", "15mm to 100mm"],
                ["Temp. Range", "-20°C to 220°C"]
            ],
            features: ["IBR certified for boiler applications", "High pressure and temperature resistance",
                "Precision-machined seat for zero leakage", "Corrosion resistant bronze body",
                "Rising stem for visual status indication", "Easy installation and maintenance"
            ],
            applications: ["Power generation and thermal plants", "Boiler and steam systems",
                "Oil & gas refineries", "Chemical processing industries", "Water treatment facilities",
                "Manufacturing industries"
            ],
            keywords: ["bronze", "globe", "steam stop", "boiler", "gunmetal", "ibr", "steam valve",
                "stop valve"]
        },
        {
            id: 2,
            name: "Cast Iron IBR Certified Globe Steam Stop Valve",
            slug: "cast-iron-ibr-globe-steam-stop-valve",
            subtitle: "ASTM Grade • Flanged End",
            desc: "Heavy-duty cast iron globe valve with IBR certification for steam systems. ASTM grade material with flanged end connections for easy installation.",
            category: "Gate / Globe Valves",
            badge: "IBR",
            price_min: 1892,
            price_max: 26975,
            mrp: 2214,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "3–5 Days",
            warranty: "Mfr. Terms",
            cert: "ISO • IBR",
            rating: 4.8,
            orders: "1000+",
            specs: [
                ["Material", "Cast Iron / ASTM A126"],
                ["Certification", "IBR Approved • ISO 9001:2008"],
                ["Connection Type", "Flanged End"],
                ["Pressure Rating", "Class 125 / 250"],
                ["Size Range", "50mm to 300mm"],
                ["Temp. Range", "-20°C to 230°C"]
            ],
            features: ["IBR certified for steam systems", "Heavy duty cast iron construction",
                "Flanged end for secure pipeline connection", "Corrosion resistant coating",
                "Wedge gate design for tight shut-off", "Low maintenance design"
            ],
            applications: ["Industrial steam pipelines", "Process plants", "Water treatment", "Chemical plants",
                "Power plants", "HVAC systems"
            ],
            keywords: ["cast iron", "globe", "steam stop", "ibr", "flanged", "ci globe", "ci ibr",
                "steam valve"]
        },
        {
            id: 3,
            name: "Cast Steel IBR Certified Gate Valve Class 150#",
            slug: "cast-steel-ibr-gate-valve-class-150",
            subtitle: "Class 150 • Bolted Bonnet",
            desc: "Cast steel gate valve with class 150 pressure rating and bolted bonnet design. Suitable for high-pressure industrial pipeline applications.",
            category: "Gate / Globe Valves",
            badge: "QUALITY",
            price_min: 4928,
            price_max: 76500,
            mrp: 5766,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "3–5 Days",
            warranty: "Mfr. Terms",
            cert: "ISO • IBR",
            rating: 4.8,
            orders: "1000+",
            specs: [
                ["Material", "Cast Steel / WCB"],
                ["Certification", "IBR Approved • ISO 9001:2008"],
                ["Connection Type", "Flanged / Bolted Bonnet"],
                ["Pressure Rating", "Class 150#"],
                ["Size Range", "25mm to 600mm"],
                ["Temp. Range", "-29°C to 425°C"]
            ],
            features: ["IBR certified – Class 150# pressure rating", "Bolted bonnet for pressure containment",
                "Full port design for unrestricted flow", "ASTM WCB cast steel body",
                "Rising stem position indicator", "Suitable for steam, water, oil, gas"
            ],
            applications: ["High pressure steam lines", "Oil & gas pipelines", "Petrochemical plants",
                "Power generation", "Water treatment", "Industrial process piping"
            ],
            keywords: ["cast steel", "gate valve", "class 150", "wcb", "bolted bonnet", "ibr gate", "150#"]
        },
        {
            id: 4,
            name: "Cast Steel IBR Certified Gate Valve Class 300#",
            slug: "cast-steel-ibr-gate-valve-class-300",
            subtitle: "Class 300 • High Pressure",
            desc: "High-pressure gate valve for critical industrial applications requiring class 300 rating. Designed for demanding process conditions.",
            category: "Gate / Globe Valves",
            badge: "PREMIUM",
            price_min: 13674,
            price_max: 215009,
            mrp: 15999,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "5–7 Days",
            warranty: "Mfr. Terms",
            cert: "ISO • IBR",
            rating: 4.9,
            orders: "500+",
            specs: [
                ["Material", "Cast Steel / WCB"],
                ["Certification", "IBR Approved • ISO 9001:2008"],
                ["Connection Type", "Flanged / Bolted Bonnet"],
                ["Pressure Rating", "Class 300#"],
                ["Size Range", "25mm to 600mm"],
                ["Temp. Range", "-29°C to 425°C"]
            ],
            features: ["IBR certified – Class 300# high pressure", "Premium cast steel WCB body",
                "Designed for critical process conditions", "Bolted bonnet for safety",
                "Precision machined seats", "Wide temperature range operation"
            ],
            applications: ["Critical high pressure applications", "Petrochemical refineries",
                "High pressure steam systems", "Power generation plants", "Chemical processing",
                "Industrial process lines"
            ],
            keywords: ["cast steel", "gate valve", "class 300", "wcb", "high pressure", "ibr", "300#",
                "premium gate"
            ]
        },
        {
            id: 5,
            name: "Cast Steel IBR Certified Globe Valve Class 150#",
            slug: "cast-steel-ibr-globe-valve-class-150",
            subtitle: "Class 150 • Steam Service",
            desc: "Globe valve for steam and high-temperature service with class 150 pressure rating. Bolted bonnet for easy maintenance.",
            category: "Gate / Globe Valves",
            badge: "QUALITY",
            price_min: 3825,
            price_max: 88378,
            mrp: 4476,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "3–5 Days",
            warranty: "Mfr. Terms",
            cert: "ISO • IBR",
            rating: 4.8,
            orders: "1000+",
            specs: [
                ["Material", "Cast Steel / WCB"],
                ["Certification", "IBR Approved • ISO 9001:2008"],
                ["Connection Type", "Flanged / Bolted Bonnet"],
                ["Pressure Rating", "Class 150#"],
                ["Size Range", "25mm to 300mm"],
                ["Temp. Range", "-29°C to 425°C"]
            ],
            features: ["IBR certified steam service valve", "Globe design for precise flow control",
                "Class 150# pressure rated", "Cast steel WCB body",
                "Parabolic disc for accurate throttling", "Easy maintenance access"
            ],
            applications: ["Steam distribution systems", "Power plants", "Oil & gas processing",
                "Chemical industry", "Boiler feed lines", "Process control"
            ],
            keywords: ["cast steel globe", "globe 150", "class 150 globe", "wcb globe", "steam globe",
                "ibr globe", "flow control"
            ]
        },
        {
            id: 6,
            name: "Cast Steel IBR Certified Globe Valve Class 300#",
            slug: "cast-steel-ibr-globe-valve-class-300",
            subtitle: "Class 300 • Bolted Bonnet",
            desc: "High-pressure globe valve with IBR certification and bolted bonnet. Engineered for critical steam and high pressure service.",
            category: "Gate / Globe Valves",
            badge: "PREMIUM",
            price_min: 7845,
            price_max: 152880,
            mrp: 9183,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "5–7 Days",
            warranty: "Mfr. Terms",
            cert: "ISO • IBR",
            rating: 4.9,
            orders: "500+",
            specs: [
                ["Material", "Cast Steel / WCB"],
                ["Certification", "IBR Approved • ISO 9001:2008"],
                ["Connection Type", "Flanged / Bolted Bonnet"],
                ["Pressure Rating", "Class 300#"],
                ["Size Range", "25mm to 300mm"],
                ["Temp. Range", "-29°C to 425°C"]
            ],
            features: ["IBR certified – Class 300# service", "Heavy duty construction", "Bolted bonnet design",
                "Precision throttling capability", "High temp and pressure resistance",
                "Suitable for critical steam systems"
            ],
            applications: ["High pressure steam service", "Critical process lines", "Petrochemical plants",
                "Power generation", "Boiler systems", "Process control applications"
            ],
            keywords: ["cast steel globe", "globe 300", "class 300 globe", "wcb globe 300", "ibr globe 300",
                "high pressure globe"
            ]
        },
        {
            id: 7,
            name: "Forged Steel A-105 IBR Certified Gate Valve",
            slug: "forged-steel-a105-ibr-gate-valve",
            subtitle: "Forged A-105 • Socket Weld",
            desc: "Forged steel gate valve manufactured from A-105 grade material for high-pressure socket weld applications.",
            category: "Gate / Globe Valves",
            badge: "QUALITY",
            price_min: 2450,
            price_max: 18900,
            mrp: 2867,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "3–5 Days",
            warranty: "Mfr. Terms",
            cert: "ISO • IBR",
            rating: 4.7,
            orders: "800+",
            specs: [
                ["Material", "Forged Steel A-105"],
                ["Certification", "IBR Approved • ISO 9001:2008"],
                ["Connection Type", "Socket Weld / Screwed"],
                ["Pressure Rating", "Class 800# / 1500#"],
                ["Size Range", "8mm to 50mm"],
                ["Temp. Range", "-29°C to 425°C"]
            ],
            features: ["Forged A-105 superior strength", "Socket weld connection for tight seal",
                "Class 800# to 1500# rated", "Compact forged body design",
                "IBR certified for steam service", "Low fugitive emissions"
            ],
            applications: ["High pressure small bore lines", "Instrumentation lines", "Boiler accessories",
                "Chemical plants", "Oil & gas", "Steam tracing lines"
            ],
            keywords: ["forged", "a105", "a-105", "gate valve", "socket weld", "small bore", "forged gate",
                "800 class", "1500 class"
            ]
        },
        {
            id: 8,
            name: "Forged Steel A-105 IBR Certified Globe Valve",
            slug: "forged-steel-a105-ibr-globe-valve",
            subtitle: "Forged A-105 • Threaded",
            desc: "Forged steel globe valve with threaded connections. A-105 grade material for superior strength and pressure resistance.",
            category: "Gate / Globe Valves",
            badge: "QUALITY",
            price_min: 2180,
            price_max: 16750,
            mrp: 2551,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "3–5 Days",
            warranty: "Mfr. Terms",
            cert: "ISO • IBR",
            rating: 4.7,
            orders: "800+",
            specs: [
                ["Material", "Forged Steel A-105"],
                ["Certification", "IBR Approved • ISO 9001:2008"],
                ["Connection Type", "Threaded / Socket Weld"],
                ["Pressure Rating", "Class 800# / 1500#"],
                ["Size Range", "8mm to 50mm"],
                ["Temp. Range", "-29°C to 425°C"]
            ],
            features: ["Forged A-105 high strength material", "Threaded connections for easy installation",
                "Class 800# to 1500# rated", "Precision globe design for flow control", "IBR certified",
                "Compact design for tight spaces"
            ],
            applications: ["High pressure process lines", "Steam tracing", "Instrumentation",
                "Chemical service", "Oil & gas production", "Utility systems"
            ],
            keywords: ["forged globe", "a105 globe", "a-105 globe", "threaded globe", "forged steel globe",
                "800 globe", "socket weld globe"
            ]
        },
        {
            id: 9,
            name: "Forged Steel F-304 IBR Certified Check Valve",
            slug: "forged-steel-f304-ibr-check-valve",
            subtitle: "SS 304 • Swing Type",
            desc: "Stainless steel check valve with swing type design for preventing backflow in pipelines. F-304 grade for corrosive environments.",
            category: "Ball / Check Valves",
            badge: "IBR",
            price_min: 3250,
            price_max: 24500,
            mrp: 3803,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "3–5 Days",
            warranty: "Mfr. Terms",
            cert: "ISO • IBR",
            rating: 4.8,
            orders: "600+",
            specs: [
                ["Material", "Forged SS 304 (F-304)"],
                ["Certification", "IBR Approved • ISO 9001:2008"],
                ["Type", "Swing / Piston Check"],
                ["Pressure Rating", "Class 800# / 1500#"],
                ["Size Range", "8mm to 50mm"],
                ["Temp. Range", "-196°C to 450°C"]
            ],
            features: ["SS304 for excellent corrosion resistance", "Swing type prevents backflow",
                "IBR certified for steam applications", "Forged body for high integrity",
                "Wide temperature operating range", "Low pressure drop design"
            ],
            applications: ["Pump discharge lines", "Boiler feed water systems", "Steam lines",
                "Chemical process lines", "Water supply systems", "Industrial pipelines"
            ],
            keywords: ["check valve", "nrv", "non return", "f304", "ss304 check", "forged check", "swing check",
                "ibr check", "backflow"
            ]
        },
        {
            id: 10,
            name: "Forged Steel F-304 IBR Certified Gate Valve",
            slug: "forged-steel-f304-ibr-gate-valve",
            subtitle: "SS 304 • Flanged End",
            desc: "Stainless steel gate valve for corrosive environments with flanged end connections. IBR certified for steam applications.",
            category: "Gate / Globe Valves",
            badge: "PREMIUM",
            price_min: 3850,
            price_max: 29200,
            mrp: 4507,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "3–5 Days",
            warranty: "Mfr. Terms",
            cert: "ISO • IBR",
            rating: 4.8,
            orders: "600+",
            specs: [
                ["Material", "Forged SS 304 (F-304)"],
                ["Certification", "IBR Approved • ISO 9001:2008"],
                ["Connection Type", "Flanged End"],
                ["Pressure Rating", "Class 150# to 300#"],
                ["Size Range", "15mm to 200mm"],
                ["Temp. Range", "-196°C to 450°C"]
            ],
            features: ["SS304 stainless steel construction", "Corrosion resistant for aggressive media",
                "Flanged end connection", "IBR certified", "Suitable for chemical and steam service",
                "Long service life"
            ],
            applications: ["Corrosive media pipelines", "Chemical processing", "Steam service",
                "Food and beverage industry", "Pharmaceutical plants", "Marine applications"
            ],
            keywords: ["f304", "ss304 gate", "stainless gate", "forged ss gate", "flanged ss gate",
                "ibr ss gate", "corrosion gate"
            ]
        },
        {
            id: 11,
            name: "MS Pipes & Fittings",
            slug: "ms-pipes-fittings",
            subtitle: "Mild Steel • ERW, Seamless",
            desc: "High-quality mild steel pipes for industrial applications, available in ERW and seamless grades. ISI certified for quality assurance.",
            category: "Pipes & Fittings",
            badge: "POPULAR",
            price_min: 850,
            price_max: 12500,
            mrp: 994,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "3–5 Days",
            warranty: "Mfr. Terms",
            cert: "ISO Certified",
            rating: 4.7,
            orders: "2000+",
            specs: [
                ["Material", "Mild Steel (MS)"],
                ["Standard", "IS 1239 / IS 3589 / ASTM A106"],
                ["Type", "ERW / Seamless / Welded"],
                ["Schedule", "SCH 40 / SCH 80 / XS"],
                ["Size Range", "15mm to 300mm NB"],
                ["Length", "6m / 12m or custom"]
            ],
            features: ["ISI certified quality assurance", "Available in ERW and seamless grades",
                "Wide size range 15mm to 300mm NB", "Suitable for high pressure applications",
                "Galvanized option available", "Custom lengths on request"
            ],
            applications: ["Industrial process piping", "Structural applications", "Water supply systems",
                "Oil & gas transportation", "Fire protection systems", "HVAC systems"
            ],
            keywords: ["ms pipe", "mild steel pipe", "ms fittings", "ms tubes", "erw pipe", "seamless ms",
                "carbon steel pipe", "black pipe"
            ]
        },
        {
            id: 12,
            name: "SS Pipes & Fittings",
            slug: "ss-pipes-fittings",
            subtitle: "SS304, SS316, SS321",
            desc: "Premium stainless steel pipes and fittings in SS304, SS316, SS321 grades. Suitable for corrosive and hygienic applications.",
            category: "Pipes & Fittings",
            badge: "PREMIUM",
            price_min: 2450,
            price_max: 35800,
            mrp: 2867,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "3–5 Days",
            warranty: "Mfr. Terms",
            cert: "ISO Certified",
            rating: 4.8,
            orders: "1500+",
            specs: [
                ["Material", "SS304 / SS316 / SS321"],
                ["Standard", "ASTM A312 / IS 6913"],
                ["Type", "Seamless / Welded"],
                ["Schedule", "SCH 10S / SCH 40S / SCH 80S"],
                ["Size Range", "15mm to 300mm NB"],
                ["Length", "6m / 12m or custom"]
            ],
            features: ["Premium SS304/SS316/SS321 grades", "Hygienic surface finish available",
                "Seamless and welded construction", "Corrosion resistant for aggressive media",
                "Food and pharma grade available", "Custom sizes available"
            ],
            applications: ["Chemical process piping", "Food and beverage industry", "Pharmaceutical plants",
                "Dairy industry", "Marine applications", "High purity systems"
            ],
            keywords: ["ss pipe", "stainless pipe", "ss304", "ss316", "ss321", "stainless fittings",
                "hygienic pipe", "food grade pipe", "pharma pipe"
            ]
        },
        {
            id: 13,
            name: "GI Pipes & Fittings",
            slug: "gi-pipes-fittings",
            subtitle: "Galvanized Iron, ISI Certified",
            desc: "ISI certified galvanized iron pipes for plumbing and industrial use. Hot-dip galvanized for superior corrosion protection.",
            category: "Pipes & Fittings",
            badge: "ISI MARK",
            price_min: 1200,
            price_max: 18900,
            mrp: 1404,
            gst: 18,
            in_stock: 1,
            stock_label: "In Stock",
            ships: "Ships within 24 hrs",
            delivery: "3–5 Days",
            warranty: "Mfr. Terms",
            cert: "ISI Certified",
            rating: 4.7,
            orders: "1800+",
            specs: [
                ["Material", "Galvanized Iron (GI)"],
                ["Standard", "IS 1239 / ISI Certified"],
                ["Type", "Hot Dip Galvanized"],
                ["Grade", "Light / Medium / Heavy"],
                ["Size Range", "15mm to 150mm NB"],
                ["Length", "6m standard"]
            ],
            features: ["ISI certified galvanized iron", "Hot-dip galvanized coating",
                "Superior corrosion protection", "Suitable for water supply systems",
                "Available in light, medium, heavy grades", "Standard 6m lengths"
            ],
            applications: ["Water supply and distribution", "Plumbing systems", "Fire protection systems",
                "Agriculture irrigation", "HVAC systems", "General industrial use"
            ],
            keywords: ["gi pipe", "galvanized pipe", "gi fittings", "gi tubes", "isi pipe", "water pipe",
                "plumbing pipe", "hot dip galvanized"
            ]
        },
        {
            id: 14,
            name: "SS-Pipes-Fittings #130",
            slug: "ss-pipes-fittings-130",
            subtitle: "IBR Approved • High Temperature",
            desc: "SS-Pipes-Fittings #130 is a premium-grade stainless steel piping component designed for high durability and reliable performance in demanding industrial environments.",
            category: "Pipes & Fittings",
            badge: "",
            price_min: 1500,
            price_max: 2000,
            mrp: 3000,
            gst: 20,
            in_stock: 0,
            stock_label: "Currently Out of Stock",
            ships: "Ships within 24 hrs",
            delivery: "5–7 Days",
            warranty: "Mfr. Terms",
            cert: "ISO • IBR",
            rating: 4.5,
            orders: "100+",
            specs: [
                ["Material", "Premium Stainless Steel"],
                ["Certification", "ISO • IBR Approved"],
                ["Type", "SS Piping Component"],
                ["Min. Order", "2 Pieces"],
                ["Delivery", "5–7 Days"],
                ["GST", "20%"]
            ],
            features: ["High durability premium SS construction", "Excellent corrosion resistance",
                "Leak-proof connections", "High pressure & temperature rated",
                "Precision engineering finish", "Long service life"
            ],
            applications: ["Demanding industrial environments", "High pressure applications",
                "High temperature systems", "Chemical processing", "Industrial piping"
            ],
            keywords: ["ss 130", "ss fittings 130", "pipes fittings 130", "stainless 130", "premium ss pipe"]
        }
    ];

    /* ================================================================
       OFFERS DATABASE
       ================================================================ */
    const ITC_OFFERS = {
        "Gate / Globe Valves": [{
                icon: "🔩",
                text: "Buy any IBR valve & get free gasket kit worth ₹200",
                note: "Valid this week"
            },
            {
                icon: "📦",
                text: "Order 5+ Globe Valves — get 6% bulk discount auto-applied"
            },
            {
                icon: "🚚",
                text: "FREE delivery on Gate/Globe Valve orders above ₹5,000"
            }
        ],
        "Ball / Check Valves": [{
                icon: "🔩",
                text: "Buy 3+ Ball Valves — get 5% off on total order"
            },
            {
                icon: "📦",
                text: "SS304 Check Valve combo: save ₹350 on 2-piece set"
            },
            {
                icon: "🚚",
                text: "FREE delivery on orders above ₹4,000"
            }
        ],
        "Pipes & Fittings": [{
                icon: "🔩",
                text: "Buy MS + GI combo — get flat ₹400 off"
            },
            {
                icon: "📦",
                text: "SS Pipe bulk order (50m+): custom pricing available"
            },
            {
                icon: "🚚",
                text: "FREE delivery on pipe orders above ₹8,000"
            }
        ]
    };

    /* ================================================================
       STATE
       ================================================================ */
    let icOpen = false,
        icBadge = false,
        icTimer = null;

    /* ================================================================
       HELPERS
       ================================================================ */
    function icEsc(s) {
        return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

    function icTime() {
        const n = new Date();
        let h = n.getHours(),
            m = n.getMinutes(),
            a = h >= 12 ? 'PM' : 'AM';
        h = h % 12 || 12;
        return h + ':' + (m < 10 ? '0' : '') + m + ' ' + a;
    }

    function icFmt(n) {
        return '₹' + Number(n).toLocaleString('en-IN');
    }

    /* ================================================================
       PRODUCT SEARCH — fuzzy multi-keyword
       ================================================================ */
    function icFindProducts(query) {
        const q = query.toLowerCase();
        const words = q.split(/\s+/).filter(w => w.length > 2);
        if (!words.length) return [];

        return ITC_PRODUCTS.map(p => {
            let score = 0;
            const haystack = (p.name + ' ' + p.keywords.join(' ') + ' ' + p.category + ' ' + p.subtitle)
                .toLowerCase();
            // Exact name match: very high score
            if (haystack.includes(q)) score += 20;
            words.forEach(w => {
                if (haystack.includes(w)) score += 3;
                if (p.name.toLowerCase().includes(w)) score += 5;
            });
            return {
                p,
                score
            };
        }).filter(x => x.score > 2).sort((a, b) => b.score - a.score).slice(0, 4).map(x => x.p);
    }

    /* ================================================================
       BUILD PRODUCT CARD HTML
       ================================================================ */
    function icProductCard(p, compact = false) {
        const stockBadge = p.in_stock ?
            `<span class="ic-badge ic-badge-stock">✔ ${icEsc(p.stock_label)}</span>` :
            `<span class="ic-badge ic-badge-out">✖ Out of Stock</span>`;
        const badgeHtml = p.badge ? `<span class="ic-badge ic-badge-ibr">${icEsc(p.badge)}</span>` : '';
        const offerHtml = icOffersForCat(p.category);
        const specsHtml = p.specs.slice(0, compact ? 4 : 6).map(([k, v]) =>
            `<div class="ic-spec-row"><span class="ic-spec-key">${icEsc(k)}</span><span class="ic-spec-val">${icEsc(v)}</span></div>`
        ).join('');
        const featHtml = p.features.slice(0, compact ? 3 : 6).map(f =>
            `<li>${icEsc(f)}</li>`
        ).join('');
        const appsHtml = compact ? '' : p.applications.slice(0, 4).map(a =>
            `<span style="font-size:11px;background:#eaf2fb;color:#1a5276;border-radius:6px;padding:2px 7px;margin:2px 2px 0 0;display:inline-block;">${icEsc(a)}</span>`
            ).join('');

        return `<div class="ic-card">
    <div class="ic-card-header">
      <div class="ic-card-title">${icEsc(p.name)}</div>
      <div class="ic-card-sub">${icEsc(p.subtitle)}</div>
    </div>
    <div class="ic-card-body">
      <div class="ic-badge-row">
        ${badgeHtml}
        ${stockBadge}
        <span class="ic-badge ic-badge-cert">${icEsc(p.cert)}</span>
        <span class="ic-badge ic-badge-rating">★ ${p.rating} · ${icEsc(p.orders)} Orders</span>
      </div>
      <div class="ic-price-box">
        <div>
          <div class="ic-price-range">${icFmt(p.price_min)} – ${icFmt(p.price_max)}</div>
          <div class="ic-price-gst">Price range (excl. ${p.gst}% GST) · MRP ${icFmt(p.mrp)}</div>
        </div>
        <div style="text-align:right;font-size:11px;color:#555;">
          🚚 ${icEsc(p.ships)}<br>📅 ${icEsc(p.delivery)}
        </div>
      </div>
      <div style="font-size:11.5px;color:#555;margin-bottom:8px;line-height:1.5;">${icEsc(p.desc)}</div>
      ${compact?'':specsHtml}
      ${compact?'':appsHtml?`<div style="margin:8px 0 4px;"><strong style="font-size:11.5px;color:#444;">📍 Applications:</strong><br>${appsHtml}</div>`:''}
      ${compact?'':p.features.length?`<ul class="ic-feat-list" style="margin-top:8px;">${featHtml}</ul>`:''}
      ${offerHtml}
    </div>
    <div class="ic-card-actions">
      <a href="/itc/product_details.php?slug=${icEsc(p.slug)}" class="ic-btn-view" target="_blank">🔍 View Full Details</a>
      <a href="/itc/contact.php?product=${encodeURIComponent(p.name)}" class="ic-btn-quote" target="_blank">💬 Get Quote</a>
    </div>
  </div>`;
    }

    /* ================================================================
       OFFERS HTML FOR CATEGORY
       ================================================================ */
    function icOffersForCat(cat) {
        const offers = ITC_OFFERS[cat];
        if (!offers) return '';
        const items = offers.map(o =>
            `<div class="ic-offer-item">${o.icon} ${icEsc(o.text)}${o.note?` <em style="opacity:.75;">(${icEsc(o.note)})</em>`:''}</div>`
            ).join('');
        return `<div class="ic-offer-box"><div style="font-size:11px;font-weight:700;color:#e65100;margin-bottom:4px;">🏷️ Active Offers</div>${items}</div>`;
    }

    /* ================================================================
       RENDER MESSAGE
       ================================================================ */
    function icRenderMsg(html, isBot) {
        const wrap = document.getElementById('itc-chat-messages');
        const row = document.createElement('div');
        row.className = 'ic-row ' + (isBot ? 'ic-bot' : 'ic-user');
        if (isBot) {
            row.innerHTML =
                `<div class="ic-avt"><svg width="14" height="14" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg></div><div><div class="ic-bbl">${html}</div><div class="ic-ts">${icTime()}</div></div>`;
        } else {
            row.innerHTML =
                `<div><div class="ic-bbl">${icEsc(html)}</div><div class="ic-ts">${icTime()}</div></div>`;
        }
        wrap.appendChild(row);
        wrap.scrollTop = wrap.scrollHeight;
    }

    function icRenderChips(chips) {
        const qr = document.getElementById('itc-quick-replies');
        qr.innerHTML = '';
        (chips || []).forEach(c => {
            const b = document.createElement('button');
            b.className = 'ic-chip';
            b.textContent = c;
            b.onclick = () => icProcess(c);
            qr.appendChild(b);
        });
    }

    function icShowTyping() {
        const wrap = document.getElementById('itc-chat-messages');
        let ti = document.getElementById('ic-typing');
        if (!ti) {
            ti = document.createElement('div');
            ti.id = 'ic-typing';
            ti.className = 'ic-row ic-bot';
            ti.innerHTML =
                `<div class="ic-avt"><svg width="14" height="14" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg></div><div class="ic-bbl"><div class="ic-dots"><span></span><span></span><span></span></div></div>`;
        }
        ti.style.display = 'flex';
        wrap.appendChild(ti);
        wrap.scrollTop = wrap.scrollHeight;
    }

    function icHideTyping() {
        const ti = document.getElementById('ic-typing');
        if (ti) ti.remove();
    }

    /* ================================================================
       MAIN PROCESS FUNCTION
       ================================================================ */
    function icProcess(text) {
        document.getElementById('itc-chat-input').value = '';
        icRenderMsg(text, false);
        icRenderChips([]);
        icShowTyping();
        clearTimeout(icTimer);
        const delay = 700 + Math.random() * 500;
        icTimer = setTimeout(() => {
            icHideTyping();
            icRespond(text);
        }, delay);
    }

    /* ================================================================
       SMART RESPONSE ENGINE
       ================================================================ */
    function icRespond(input) {
        const q = input.toLowerCase().trim();

        /* ---- GREETING ---- */
        if (/^(hi|hello|hey|namaste|hii|helo|good morning|good afternoon|good evening|howdy|sup)\b/.test(q)) {
            icRenderMsg(`👋 Hello! Welcome to <strong>Indian Traders Corp (ITC)</strong>!<br><br>
I'm your smart assistant. I can help you with:<br>
• 🔍 <strong>Detailed product info</strong> — specs, features, price<br>
• 🛒 <strong>How to order</strong> — add to cart, enquiry process<br>
• 🏷️ <strong>Current offers</strong> — discounts & free delivery<br>
• 🏭 <strong>Industry applications</strong> & brand info<br>
• 📞 <strong>Contact & support</strong><br><br>
Just type a product name or ask me anything!`, true);
            icRenderChips(['Cast Iron Globe Valve', 'Cast Steel Gate Valve', 'SS Pipes', 'GI Pipes',
                'Current Offers', 'How to Order', 'Contact Us'
            ]);
            return;
        }

        /* ---- HOW TO ORDER / ADD TO CART ---- */
        if (/\b(how to order|how to buy|add to cart|place order|book|purchase|how do i buy|how to purchase|ordering process|buy online)\b/
            .test(q)) {
            icRenderMsg(`🛒 <strong>How to Order from ITC</strong><br><br>
Here's the complete step-by-step process:<br><br>
<strong>Step 1 — Browse Products</strong><br>
👉 Go to <a href="/itc/products.php" target="_blank">Products Page</a> or click <em>"View Full Details"</em> on any product card here.<br><br>
<strong>Step 2 — View Product Details</strong><br>
📋 Each product page shows full specs, sizes, price range, and available variants. Choose the size/grade you need.<br><br>
<strong>Step 3 — Submit Enquiry</strong><br>
📝 Click <strong>"Get Quote"</strong> or <strong>"Send Enquiry"</strong> on the product page. Fill in:<br>
• Product name & size<br>
• Quantity required<br>
• Your contact number / email<br><br>
<strong>Step 4 — Receive Quote</strong><br>
📞 Our team will call/WhatsApp you within <strong>2–4 hours</strong> (Mon–Sat, 9AM–6PM) with exact pricing.<br><br>
<strong>Step 5 — Confirm & Pay</strong><br>
✅ Confirm the order, make payment (NEFT/RTGS/UPI/Cheque), and receive dispatch confirmation.<br><br>
<strong>Step 6 — Delivery</strong><br>
🚚 Most in-stock items ship within <strong>24 hrs</strong>. Delivery in <strong>3–7 business days</strong> Pan-India.<br><br>
👉 <a href="/itc/contact.php" target="_blank">Start Your Enquiry →</a>`, true);
            icRenderChips(['View All Products', 'Get a Quote', 'Delivery Info', 'Contact Us', 'Current Offers']);
            return;
        }

        /* ---- OFFERS / DISCOUNTS ---- */
        if (/\b(offer|offers|discount|deal|free delivery|bulk|combo|coupon|promo)\b/.test(q)) {
            let html = `🏷️ <strong>Current Active Offers at ITC</strong><br><br>`;
            Object.entries(ITC_OFFERS).forEach(([cat, offers]) => {
                html += `<strong>📂 ${icEsc(cat)}</strong><br>`;
                offers.forEach(o => {
                    html +=
                        `${o.icon} ${icEsc(o.text)}${o.note?` <em>(${icEsc(o.note)})</em>`:''}<br>`;
                });
                html += `<br>`;
            });
            html += `👉 <a href="/itc/products.php" target="_blank">Shop Now & Save →</a>`;
            icRenderMsg(html, true);
            icRenderChips(['Gate Valve Offers', 'Pipe Combo Offer', 'Get a Quote', 'View Products']);
            return;
        }

        /* ---- DELIVERY / SHIPPING ---- */
        if (/\b(delivery|shipping|dispatch|how long|lead time|logistics|courier|transit)\b/.test(q)) {
            icRenderMsg(`🚚 <strong>Delivery & Shipping Details</strong><br><br>
• 🇮🇳 <strong>Pan-India Delivery</strong> — all cities & remote locations<br>
• ⚡ <strong>In-stock items:</strong> Dispatch within 24 hours<br>
• 📅 <strong>Standard Delivery:</strong> 3–5 business days<br>
• 📅 <strong>Premium/Large items:</strong> 5–7 business days<br>
• 📦 <strong>Packaging:</strong> Industrial-grade, manufacturer's original packing<br>
• 📋 <strong>Documentation:</strong> GST invoice, MTC, test reports included<br>
• 🔔 <strong>Tracking:</strong> Dispatch notification with courier details<br><br>
<strong>Free Delivery Thresholds:</strong><br>
• Gate/Globe Valves: Orders above ₹5,000<br>
• Ball/Check Valves: Orders above ₹4,000<br>
• Pipes & Fittings: Orders above ₹8,000<br><br>
👉 <a href="/itc/contact.php" target="_blank">Contact for Urgent Delivery →</a>`, true);
            icRenderChips(['How to Order', 'Get a Quote', 'Track My Order', 'Contact Us']);
            return;
        }

        /* ---- PRICE / PRICING ---- */
        if (/\b(price|pricing|cost|how much|rate|rates|quote|quotation|minimum order|bulk price|wholesale)\b/.test(
                q) && !icFindProducts(q).length) {
            icRenderMsg(`💰 <strong>Pricing at ITC</strong><br><br>
Our prices depend on:<br>
• <strong>Product type</strong> & material grade<br>
• <strong>Size</strong> (in mm NB / inches)<br>
• <strong>Quantity</strong> — bulk orders get better rates<br>
• <strong>Pressure class</strong> (150#, 300#, 800#, etc.)<br><br>
<strong>Price Ranges (examples):</strong><br>
• Globe Valve (Bronze IBR): ₹1,321 – ₹19,688<br>
• Gate Valve (Cast Steel 150#): ₹4,928 – ₹76,500<br>
• SS Pipes & Fittings: ₹2,450 – ₹35,800<br>
• GI Pipes: ₹1,200 – ₹18,900<br><br>
💡 <strong>Tip:</strong> Ask me about a specific product to get exact price details!<br>
👉 <a href="/itc/contact.php" target="_blank">Request a Custom Quote →</a>`, true);
            icRenderChips(['Cast Iron Globe Valve Price', 'Gate Valve Price', 'SS Pipe Price', 'GI Pipe Price',
                'Get Custom Quote'
            ]);
            return;
        }

        /* ---- IBR CERTIFICATION ---- */
        if (/\b(ibr|ibr certified|ibr certificate|what is ibr|ibr approved)\b/.test(q)) {
            icRenderMsg(`📜 <strong>About IBR Certification</strong><br><br>
<strong>IBR = Indian Boiler Regulation</strong><br><br>
The IBR (Indian Boiler Regulations, 1950) is a mandatory Indian standard for all components used in boiler and steam systems operating at pressure above 1 kg/cm².<br><br>
<strong>Why IBR Certification Matters:</strong><br>
• ✅ Legally required for steam-line components<br>
• 🛡️ Guarantees safety under high-pressure steam<br>
• 📋 Comes with official IBR certificate for each batch<br>
• 🏭 Mandatory for power plants, boilers, steam systems<br><br>
<strong>Our IBR Certified Products:</strong><br>
• Globe Steam Stop Valves (Bronze & Cast Iron)<br>
• Cast Steel Gate & Globe Valves (Class 150# & 300#)<br>
• Forged Steel Gate & Globe Valves (A-105, F-304)<br>
• Check Valves (F-304)<br>
• IBR Pipes, Boiler Tubes<br><br>
👉 <a href="/itc/products.php" target="_blank">View All IBR Products →</a>`, true);
            icRenderChips(['Bronze Globe Valve', 'Cast Steel Gate Valve', 'Cast Iron Globe Valve',
            'Get IBR Quote']);
            return;
        }

        /* ---- CONTACT ---- */
        if (/\b(contact|phone|email|address|location|reach|call|whatsapp|office|where are you)\b/.test(q)) {
            icRenderMsg(`📞 <strong>Contact Indian Traders Corp</strong><br><br>
Reach us via the Contact page for:<br>
• 📧 Email & Direct Phone<br>
• 📱 WhatsApp for quick enquiries<br>
• 📍 Office address & directions<br>
• 📝 Online enquiry form<br><br>
🕐 <strong>Business Hours:</strong> Mon–Sat, 9AM–6PM IST<br>
⚡ <strong>Response Time:</strong> 2–4 hours during business hours<br><br>
👉 <a href="/itc/contact.php" target="_blank">Open Contact Page →</a>`, true);
            icRenderChips(['How to Order', 'Get a Quote', 'Business Hours', 'Our Products']);
            return;
        }

        /* ---- ABOUT ---- */
        if (/\b(about|who are you|company|indian traders|what is itc|tell me about itc|about itc)\b/.test(q)) {
            icRenderMsg(`🏢 <strong>About Indian Traders Corp (ITC)</strong><br><br>
A trusted industrial products supplier for <strong>20+ years</strong>, serving leading industries across India.<br><br>
<strong>What We Supply:</strong><br>
• 🔴 Industrial Valves — 10+ types, all materials<br>
• 🔵 Pipes & Tubes — MS, SS, GI, HDPE, IBR, Seamless<br>
• 🟢 Fittings, Flanges, Strainers, Instrumentation<br>
• ⚙️ Pneumatic & Hydraulic Components<br><br>
<strong>Our Strengths:</strong><br>
• ✅ ISO Certified | 🛡️ IBR Approved Products<br>
• 📜 Genuine manufacturer documentation (MTCs, test reports)<br>
• 🚚 Pan-India delivery with tracking<br>
• 📞 Expert engineering support<br><br>
👉 <a href="/itc/about.php" target="_blank">Read Full About →</a>`, true);
            icRenderChips(['Our Products', 'Why Choose ITC', 'Our Brands', 'Contact Us']);
            return;
        }

        /* ---- WHY ITC ---- */
        if (/\b(why itc|why choose|advantage|benefit|quality|iso|certification|trusted)\b/.test(q)) {
            icRenderMsg(`⭐ <strong>Why Choose Indian Traders Corp?</strong><br><br>
• 🏆 <strong>20+ Years</strong> of proven industry experience<br>
• ✅ <strong>ISO Certified</strong> products & quality processes<br>
• 🔐 <strong>100% Genuine</strong> — authorized manufacturer products<br>
• 📜 <strong>Full Documentation</strong> — MTCs, IBR certs, test reports<br>
• 🚚 <strong>Pan-India Delivery</strong> within 3–7 days<br>
• 🛡️ <strong>Manufacturer Warranty</strong> on all products<br>
• ✔️ <strong>Zero Defect Policy</strong> — every unit QC checked<br>
• 💰 <strong>Factory-Direct Pricing</strong> — competitive rates<br>
• 📞 <strong>Expert Engineering Team</strong> for technical support<br><br>
👉 <a href="/itc/why-itc.php" target="_blank">Read More →</a>`, true);
            icRenderChips(['View Products', 'Get a Quote', 'Contact Us', 'Our Brands']);
            return;
        }

        /* ---- BRANDS ---- */
        if (/\b(brand|brands|manufacturer|companies|authorized|partner|festo|yuken|veljan|polyhydron|aira|normex)\b/
            .test(q)) {
            icRenderMsg(`🏷️ <strong>Our Authorized Brand Partners (50+)</strong><br><br>
<strong>Valves:</strong> Aira Euro, Alto Valves, Normex, Mahavir, UPC, Gokul Poly, Suzhik, Hawa Engineering<br><br>
<strong>Pneumatics:</strong> Festo, Janatics, Airmax, Aeroflex, Techno Pneumatics, Cair, Akari, SMC<br><br>
<strong>Hydraulics:</strong> Yuken, Veljan, Polyhydron, VBC Hydraulics, Eaton, Parker, Vickers, Jacktech, Hydroline, Koojan<br><br>
<strong>Hoses:</strong> Polyhose, Easyflex, Dowty Hydraulics<br><br>
<strong>Instruments:</strong> Baumer, Arbuda, Danfoss, Kimax<br><br>
<strong>Others:</strong> Supremo Gear Pumps, Rajdeep, Kartar, Mercury, MSL, Qinn, PMW<br><br>
👉 <a href="/itc/products.php" target="_blank">Browse All Products →</a>`, true);
            icRenderChips(['Festo Pneumatics', 'Yuken Hydraulics', 'Get Quote', 'Contact Us']);
            return;
        }

        /* ---- INDUSTRIES ---- */
        if (/\b(industry|industries|sector|application|who do you serve|oil gas|pharma|food|dairy|power plant|boiler|chemical|water treatment)\b/
            .test(q)) {
            icRenderMsg(`🏭 <strong>Industries We Serve</strong><br><br>
ITC supplies to India's most demanding industrial sectors:<br><br>
• 🛢️ <strong>Oil & Gas</strong> — valves, pipes, fittings for refineries<br>
• ⚡ <strong>Power Plants</strong> — IBR certified steam components<br>
• 🧪 <strong>Chemical & Petrochemical</strong> — corrosion-resistant products<br>
• 🌾 <strong>Food, Dairy & Beverage</strong> — SS 316L hygienic fittings<br>
• 💊 <strong>Pharmaceuticals</strong> — food/pharma grade SS pipes<br>
• 🌊 <strong>Water Treatment</strong> — GI, HDPE, CI valves<br>
• 🏗️ <strong>Construction</strong> — MS pipes, GI fittings, flanges<br>
• 🔥 <strong>Boilers & Steam</strong> — IBR certified full range<br>
• 🚒 <strong>Fire Protection</strong> — GI pipes, landing valves, hydrants<br><br>
👉 <a href="/itc/industry-we-serve.php" target="_blank">View Industries →</a>`, true);
            icRenderChips(['IBR Products', 'SS Pipes for Pharma', 'GI Pipes', 'Get Quote']);
            return;
        }

        /* ---- SHOW ALL PRODUCTS ---- */
        if (/\b(all products|product list|show products|catalog|catalogue|what do you sell|product catalog|browse)\b/
            .test(q)) {
            let html = `🔧 <strong>Our Product Catalog (14 Products)</strong><br><br>`;
            const cats = {};
            ITC_PRODUCTS.forEach(p => {
                if (!cats[p.category]) cats[p.category] = [];
                cats[p.category].push(p);
            });
            Object.entries(cats).forEach(([cat, prods]) => {
                html += `<strong>📂 ${icEsc(cat)}</strong><br>`;
                prods.forEach(p => {
                    html +=
                        `• <span style="cursor:pointer;color:#2e86c1;text-decoration:underline;" onclick="itcProcessProduct(${p.id})">${icEsc(p.name)}</span> — ${icFmt(p.price_min)}+<br>`;
                });
                html += `<br>`;
            });
            html += `👉 <a href="/itc/products.php" target="_blank">Full Catalog →</a>`;
            icRenderMsg(html, true);
            icRenderChips(['Gate Valve Details', 'SS Pipes Details', 'GI Pipes Details', 'Current Offers']);
            return;
        }

        /* ---- PRODUCT SEARCH (keyword match) ---- */
        const found = icFindProducts(q);

        if (found.length === 1) {
            // Single match — show full detailed card
            const p = found[0];
            icRenderMsg(`✅ Found exactly what you're looking for! Here are the complete details:`, true);
            const cardRow = document.createElement('div');
            cardRow.className = 'ic-row ic-bot';
            cardRow.innerHTML =
                `<div class="ic-avt" style="opacity:0;pointer-events:none;"><svg width="14" height="14" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg></div><div style="max-width:92%;">${icProductCard(p,false)}</div>`;
            document.getElementById('itc-chat-messages').appendChild(cardRow);
            document.getElementById('itc-chat-messages').scrollTop = 99999;
            icRenderChips(['How to Order This', 'Get a Quote', 'View All Products', 'More Gate Valves',
                'Current Offers'
            ]);
            return;
        }

        if (found.length > 1) {
            // Multiple matches — show search results list
            let html =
                `🔍 I found <strong>${found.length} products</strong> matching your query. Click to see full details:<br><br><div class="ic-search-list">`;
            found.forEach(p => {
                const stockIcon = p.in_stock ? '🟢' : '🔴';
                html += `<div class="ic-search-item" onclick="itcProcessProduct(${p.id})">
        <div>
          <div class="ic-search-item-name">${stockIcon} ${icEsc(p.name)}</div>
          <div class="ic-search-item-meta">${icEsc(p.category)} · ${icEsc(p.cert)} · ★${p.rating}</div>
        </div>
        <div class="ic-search-item-price">${icFmt(p.price_min)}+</div>
      </div>`;
            });
            html += `</div><br>👉 <a href="/itc/products.php" target="_blank">View All Products →</a>`;
            icRenderMsg(html, true);
            icRenderChips(['How to Order', 'Current Offers', 'Get a Quote', 'Contact Us']);
            return;
        }

        /* ---- DEFAULT FALLBACK ---- */
        icRenderMsg(`🤔 I couldn't find a specific match for "<em>${icEsc(input)}</em>".<br><br>
Try asking me:<br>
• Product name (e.g., <em>"Cast Iron Globe Valve"</em>)<br>
• Category (e.g., <em>"gate valve"</em>, <em>"ss pipes"</em>)<br>
• Material (e.g., <em>"bronze valve"</em>, <em>"forged steel"</em>)<br>
• Topics (e.g., <em>"how to order"</em>, <em>"ibr certified"</em>, <em>"offers"</em>)<br><br>
Or browse our full catalog below 👇`, true);
        icRenderChips(['All Products', 'Gate Valves', 'Globe Valves', 'SS Pipes', 'GI Pipes', 'How to Order',
            'Current Offers', 'Contact Us'
        ]);
    }

    /* ================================================================
       SHOW PRODUCT BY ID (called from search list click)
       ================================================================ */
    window.itcProcessProduct = function(id) {
        const p = ITC_PRODUCTS.find(x => x.id === id);
        if (!p) return;
        icRenderMsg(p.name, false);
        icShowTyping();
        icRenderChips([]);
        clearTimeout(icTimer);
        icTimer = setTimeout(() => {
            icHideTyping();
            icRenderMsg(`📦 Here are the complete details for <strong>${icEsc(p.name)}</strong>:`,
            true);
            const cardRow = document.createElement('div');
            cardRow.className = 'ic-row ic-bot';
            cardRow.innerHTML =
                `<div class="ic-avt" style="opacity:0;pointer-events:none;"><svg width="14" height="14" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg></div><div style="max-width:92%;">${icProductCard(p,false)}</div>`;
            document.getElementById('itc-chat-messages').appendChild(cardRow);
            document.getElementById('itc-chat-messages').scrollTop = 99999;
            icRenderChips(['How to Order This', 'Get a Quote', 'View Similar Products',
                'Current Offers', 'Contact Us'
            ]);
        }, 700);
    };

    /* ================================================================
       PUBLIC CONTROLS
       ================================================================ */
    window.itcSend = function() {
        const inp = document.getElementById('itc-chat-input');
        const t = inp.value.trim();
        if (t) icProcess(t);
    };

    window.itcToggleChat = function() {
        const w = document.getElementById('itc-chat-window');
        const io = document.getElementById('itc-chat-icon');
        const ic = document.getElementById('itc-chat-close-icon');
        const b = document.getElementById('itc-chat-badge');
        icOpen = !icOpen;
        w.classList.toggle('ic-open', icOpen);
        io.style.display = icOpen ? 'none' : 'flex';
        ic.style.display = icOpen ? 'flex' : 'none';
        if (icOpen && !icBadge) {
            b.style.display = 'none';
            icBadge = true;
        }
        if (icOpen) document.getElementById('itc-chat-input').focus();
    };

    window.itcMinimize = function() {
        const w = document.getElementById('itc-chat-window');
        document.getElementById('itc-chat-icon').style.display = 'flex';
        document.getElementById('itc-chat-close-icon').style.display = 'none';
        w.classList.remove('ic-open');
        icOpen = false;
    };

    /* ================================================================
       INIT — Welcome message on load
       ================================================================ */
    window.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            icRenderMsg(`👋 <strong>Hello! Welcome to Indian Traders Corp.</strong><br><br>
I'm your smart product assistant. Ask me about any product by name, or try:<br>
• <em>"Cast Iron Globe Valve details"</em><br>
• <em>"How to order a gate valve"</em><br>
• <em>"Show current offers"</em>`, true);
            icRenderChips(['All Products', 'Cast Iron Globe Valve', 'Gate Valve', 'SS Pipes',
                'How to Order', 'Current Offers', 'Contact Us'
            ]);
        }, 400);
    });

})();
</script>