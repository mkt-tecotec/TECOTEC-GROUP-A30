(function () {
    var root = document.querySelector('.wl-page');
    if (!root) {
        return;
    }

    var assetsBase = (window.tecotecWallpaper && window.tecotecWallpaper.assetsBase) || '';
    var styleInputs = document.querySelectorAll('input[name="wl-style"]');
    var colorInputs = document.querySelectorAll('input[name="wl-color"]');
    var tabs = document.querySelectorAll('.wl-tab');
    var phonePreview = document.getElementById('wl-preview-phone');
    var desktopPreview = document.getElementById('wl-preview-desktop');
    var phonePanel = document.querySelector('[data-device-preview="phone"]');
    var desktopPanel = document.querySelector('[data-device-preview="desktop"]');
    var downloadIphone = document.getElementById('wl-download-iphone');
    var downloadAndroid = document.getElementById('wl-download-android');
    var downloadDesktop = document.getElementById('wl-download-desktop');

    var state = {
        style: 'calm',
        color: 'blue',
        device: 'phone'
    };

    function getPath(device) {
        return assetsBase + '/wallpapers/' + state.style + '-' + state.color + '-' + device + '.svg';
    }

    function render() {
        phonePreview.src = getPath('iphone');
        desktopPreview.src = getPath('desktop');
        downloadIphone.href = getPath('iphone');
        downloadIphone.download = 'tecotec-30-' + state.style + '-' + state.color + '-iphone.svg';
        downloadAndroid.href = getPath('android');
        downloadAndroid.download = 'tecotec-30-' + state.style + '-' + state.color + '-android.svg';
        downloadDesktop.href = getPath('desktop');
        downloadDesktop.download = 'tecotec-30-' + state.style + '-' + state.color + '-desktop.svg';

        phonePanel.classList.toggle('is-active', state.device === 'phone');
        desktopPanel.classList.toggle('is-active', state.device === 'desktop');

        tabs.forEach(function (tab) {
            var isActive = tab.getAttribute('data-device') === state.device;
            tab.classList.toggle('is-active', isActive);
            tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });
    }

    styleInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            state.style = input.value;
            render();
        });
    });

    colorInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            state.color = input.value;
            render();
        });
    });

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            state.device = tab.getAttribute('data-device');
            render();
        });
    });

    render();
})();
