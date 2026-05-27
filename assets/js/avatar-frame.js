(function () {
    var canvas = document.getElementById('af-canvas');
    if (!canvas) {
        return;
    }

    var ctx = canvas.getContext('2d');
    var uploadInput = document.getElementById('af-upload-input');
    var frameInputs = document.querySelectorAll('input[name="af-frame"]');
    var downloadButton = document.getElementById('af-download');
    var shareButton = document.getElementById('af-share');
    var status = document.getElementById('af-status');

    var frameBasePath = (window.tecotecAvatar && window.tecotecAvatar.assetsBase) || '';
    var frameMap = {
        minimal: frameBasePath + '/frames/minimal.svg',
        celebration: frameBasePath + '/frames/celebration.svg',
        internal: frameBasePath + '/frames/internal.svg'
    };

    var badgePath = frameBasePath + '/frames/badge-30.svg';
    var userImage = null;
    var currentFrame = 'minimal';
    var loadedFrames = {};
    var loadedBadge = null;

    function loadImage(src) {
        return new Promise(function (resolve, reject) {
            var img = new Image();
            img.crossOrigin = 'anonymous';
            img.onload = function () { resolve(img); };
            img.onerror = function () { reject(new Error('Không thể tải asset: ' + src)); };
            img.src = src;
        });
    }

    function drawPlaceholder() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = '#f4f6f8';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = '#146eb4';
        ctx.beginPath();
        ctx.arc(540, 470, 320, 0, Math.PI * 2);
        ctx.fill();

        ctx.fillStyle = '#ffffff';
        ctx.font = '700 42px sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('Tải ảnh để bắt đầu', 540, 500);
    }

    function drawUserPhoto() {
        if (!userImage) {
            return;
        }

        var cx = 540;
        var cy = 470;
        var radius = 320;

        var scale = Math.max((radius * 2) / userImage.width, (radius * 2) / userImage.height);
        var drawW = userImage.width * scale;
        var drawH = userImage.height * scale;
        var drawX = cx - drawW / 2;
        var drawY = cy - drawH / 2;

        ctx.save();
        ctx.beginPath();
        ctx.arc(cx, cy, radius, 0, Math.PI * 2);
        ctx.closePath();
        ctx.clip();
        ctx.drawImage(userImage, drawX, drawY, drawW, drawH);
        ctx.restore();
    }

    function renderCanvas() {
        drawPlaceholder();
        drawUserPhoto();

        if (loadedFrames[currentFrame]) {
            ctx.drawImage(loadedFrames[currentFrame], 0, 0, canvas.width, canvas.height);
        }

        if (loadedBadge) {
            ctx.drawImage(loadedBadge, 740, 800, 260, 220);
        }
    }

    function setStatus(message) {
        if (status) {
            status.textContent = message;
        }
    }

    function preloadDecorators() {
        return Promise.all([
            loadImage(frameMap.minimal),
            loadImage(frameMap.celebration),
            loadImage(frameMap.internal),
            loadImage(badgePath)
        ]).then(function (images) {
            loadedFrames.minimal = images[0];
            loadedFrames.celebration = images[1];
            loadedFrames.internal = images[2];
            loadedBadge = images[3];
        }).catch(function () {
            setStatus('Một số asset khung chưa tải được.');
        });
    }

    function handleFile(file) {
        if (!file) {
            return;
        }

        if (!['image/jpeg', 'image/png'].includes(file.type)) {
            setStatus('Chỉ hỗ trợ JPG hoặc PNG.');
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            setStatus('Ảnh vượt quá 5MB.');
            return;
        }

        var reader = new FileReader();
        reader.onload = function (event) {
            loadImage(event.target.result).then(function (img) {
                userImage = img;
                setStatus('Ảnh đã sẵn sàng, bạn có thể tải về hoặc chia sẻ.');
                renderCanvas();
            }).catch(function () {
                setStatus('Không đọc được ảnh tải lên.');
            });
        };

        reader.readAsDataURL(file);
    }

    uploadInput.addEventListener('change', function (event) {
        handleFile(event.target.files[0]);
    });

    var uploadZone = uploadInput.closest('.af-upload');
    if (uploadZone) {
        uploadZone.addEventListener('dragover', function (event) {
            event.preventDefault();
            uploadZone.classList.add('af-upload--dragging');
        });
        uploadZone.addEventListener('dragleave', function () {
            uploadZone.classList.remove('af-upload--dragging');
        });
        uploadZone.addEventListener('drop', function (event) {
            event.preventDefault();
            uploadZone.classList.remove('af-upload--dragging');
            var files = event.dataTransfer && event.dataTransfer.files;
            if (files && files.length > 0) {
                handleFile(files[0]);
            }
        });
        uploadZone.addEventListener('click', function () {
            uploadInput.click();
        });
    }

    frameInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            currentFrame = input.value;
            renderCanvas();
        });
    });

    downloadButton.addEventListener('click', function () {
        canvas.toBlob(function (blob) {
            if (!blob) {
                setStatus('Không thể xuất file PNG.');
                return;
            }

            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'tecotec-30-avatar.png';
            a.click();
            URL.revokeObjectURL(url);
        }, 'image/png');
    });

    shareButton.addEventListener('click', function () {
        canvas.toBlob(function (blob) {
            if (!blob) {
                setStatus('Không thể tạo file để chia sẻ.');
                return;
            }

            var file = new File([blob], 'tecotec-30-avatar.png', { type: 'image/png' });

            if (navigator.canShare && navigator.canShare({ files: [file] }) && navigator.share) {
                navigator.share({
                    title: 'Avatar 30 năm TECOTEC Group',
                    text: 'Dấu ấn 30 năm, Hành trình tiếp nối',
                    files: [file]
                }).catch(function () {
                    setStatus('Đã hủy chia sẻ. Bạn có thể dùng nút tải về.');
                });
                return;
            }

            setStatus('Thiết bị chưa hỗ trợ chia sẻ file trực tiếp. Vui lòng tải ảnh về trước.');
        }, 'image/png');
    });

    preloadDecorators().then(function () {
        renderCanvas();
    });
})();
