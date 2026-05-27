const fs = require('fs');
const width = 1600;
const height = 900;
const Ox = width * 0.55;
const Oy = height * 0.8;
const scaleX = width / 100;
const scaleY = height / 100;

let svg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ${width} ${height}" width="100%" height="100%">\n`;
svg += `<defs>
<radialGradient id="glow" cx="50%" cy="50%" r="50%">
<stop offset="0%" stop-color="#fff" stop-opacity="1"/>
<stop offset="20%" stop-color="#ff9900" stop-opacity="0.8"/>
<stop offset="100%" stop-color="#ff9900" stop-opacity="0"/>
</radialGradient>
<filter id="blur">
<feGaussianBlur stdDeviation="2"/>
</filter>
</defs>\n`;

svg += `<rect width="${width}" height="${height}" fill="#0a1128"/>\n`;

for (let x = -100; x <= 100; x += 5) {
    const sx = Ox + x * scaleX;
    svg += `<line x1="${sx}" y1="0" x2="${sx}" y2="${height}" stroke="#ffffff" stroke-opacity="0.05" stroke-dasharray="4 4" stroke-width="1"/>\n`;
}
for (let y = -100; y <= 100; y += 5) {
    const sy = Oy - y * scaleY;
    svg += `<line x1="0" y1="${sy}" x2="${width}" y2="${sy}" stroke="#ffffff" stroke-opacity="0.05" stroke-dasharray="4 4" stroke-width="1"/>\n`;
}

svg += `<line x1="0" y1="${Oy}" x2="${width}" y2="${Oy}" stroke="#ff0000" stroke-width="1.5" opacity="0.5"/>\n`;
svg += `<line x1="${Ox}" y1="0" x2="${Ox}" y2="${height}" stroke="#ff0000" stroke-width="1.5" opacity="0.5"/>\n`;

for (let x = -100; x <= 100; x += 0.5) {
    const sx = Ox + x * scaleX;
    const isMajor = Math.abs(x % 5) < 0.01;
    const isMedium = Math.abs(x % 1) < 0.01;
    const tickLen = isMajor ? 8 : (isMedium ? 5 : 3);
    svg += `<line x1="${sx}" y1="${Oy - tickLen / 2}" x2="${sx}" y2="${Oy + tickLen / 2}" stroke="#ff0000" stroke-width="1" opacity="0.7"/>\n`;
    if (isMajor && x !== 0) {
        svg += `<text x="${sx}" y="${Oy + 20}" fill="#ffffff" font-size="10" font-family="monospace" text-anchor="middle" opacity="0.5">${x > 0 ? '+' : ''}${x}%</text>\n`;
    }
}

for (let y = -100; y <= 100; y += 0.5) {
    const sy = Oy - y * scaleY;
    const isMajor = Math.abs(y % 5) < 0.01;
    const isMedium = Math.abs(y % 1) < 0.01;
    const tickLen = isMajor ? 8 : (isMedium ? 5 : 3);
    svg += `<line x1="${Ox - tickLen / 2}" y1="${sy}" x2="${Ox + tickLen / 2}" y2="${sy}" stroke="#ff0000" stroke-width="1" opacity="0.7"/>\n`;
    if (isMajor && y !== 0) {
        svg += `<text x="${Ox - 10}" y="${sy + 3}" fill="#ffffff" font-size="10" font-family="monospace" text-anchor="end" opacity="0.5">${y > 0 ? '+' : ''}${y}%</text>\n`;
    }
}

svg += `<circle cx="${Ox}" cy="${Oy}" r="15" fill="none" stroke="#ff0000" stroke-width="2" opacity="0.7"/>\n`;
svg += `<circle cx="${Ox}" cy="${Oy}" r="3" fill="#ff0000" opacity="0.7"/>\n`;

const numPaths = 15;
for (let i = 0; i < numPaths; i++) {
    const z = i / (numPaths - 1);
    const a = 10.5 / Math.pow(35, 5);
    const y_off = (i - 7) * 1.5;
    const r = 1.0 + 1.5 * z;
    const centerDist = Math.abs(i - 7) / 7;
    const opacity = 0.85 - centerDist * 0.35;
    const color = z > 0.7 ? '#ffb700' : '#ff7a00';

    for (let x = 0; x <= 100; x += 0.5) {
        const y = a * Math.sign(x) * Math.pow(Math.abs(x), 5.0) + y_off;
        const sx = Ox + x * scaleX;
        const sy = Oy - y * scaleY;
        const startFade = Math.min(1, Math.max(0, x) / 5);
        const finalOpacity = opacity * startFade;

        if (sy < height && sy > 0 && sx > 0 && sx < width) {
            if (z > 0.8 && Math.random() < 0.15) {
                svg += `<circle cx="${sx}" cy="${sy}" r="${r * 3}" fill="url(#glow)" opacity="${finalOpacity}"/>\n`;
            }
            svg += `<circle cx="${sx}" cy="${sy}" r="${r}" fill="${color}" opacity="${finalOpacity}"/>\n`;
        }
    }
}

const main_a = 10.5 / Math.pow(35, 5);
for (let x = 0; x <= 100; x += 2) {
    const y = main_a * Math.sign(x) * Math.pow(Math.abs(x), 5.0);
    const sx = Ox + x * scaleX;
    const sy = Oy - y * scaleY;
    if (sy > 0 && sx > 0 && sx < width) {
        svg += `<circle cx="${sx}" cy="${sy}" r="4" fill="#00ffff" filter="url(#blur)" opacity="0.6"/>\n`;
        svg += `<circle cx="${sx}" cy="${sy}" r="2" fill="#ffffff" opacity="0.9"/>\n`;
    }
}

svg += `</svg>`;
fs.writeFileSync('c:/xampp/htdocs/tecgroup/wp-content/themes/tecotec-group/assets/image/wave-bg.svg', svg);
