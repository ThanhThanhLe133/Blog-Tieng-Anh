$(document).ready(() => {
    const imgs = [
        'images/base_11.jpg',
        'images/base_12.jpg',
        'images/base_13.jpg',
        'images/base_14.jpg',
        'images/base_15.jpg',
    ]; // Replace with your images

    let viewIndex = -1;

    // Render image grid
    const $grid = $('.interactive-img__container');
    imgs.forEach((img, index) => {
        const $item = $(`
            <div class="interactive__item">
                <img src="${img}" alt="Thumbnail ${index + 1}" class="interactive__item-thumbnail" data-index="${index}">
            </div>
        `);
        $grid.append($item);
    });

    // Open viewer
    $grid.on('click', '.interactive__item-thumbnail', function () {
        viewIndex = parseInt($(this).data('index'));
        showViewer();
    });

    // Close viewer
    $(document).on('click', '.interactive__item-viewer', function () {
        closeViewer();
    });

    // Prevent image clicks from closing the viewer
    $(document).on('click', '.interactive__item__viewer-image', function (e) {
        e.stopPropagation();
    });

    // Navigate to previous image
    $(document).on('click', '.interactive__item__viewer-button:first-of-type', function (e) {
        e.stopPropagation();
        viewIndex = viewIndex === 0 ? imgs.length - 1 : viewIndex - 1;
        updateViewer();
    });

    // Navigate to next image
    $(document).on('click', '.interactive__item__viewer-button:last-of-type', function (e) {
        e.stopPropagation();
        viewIndex = (viewIndex + 1) % imgs.length;
        updateViewer();
    });

    // Show viewer overlay
    function showViewer() {
        const $viewer = $(`
            <div class="interactive__item-viewer">
                <img src="${imgs[viewIndex]}" class="interactive__item__viewer-image" alt="Image Viewer">
                <button class="interactive__item__viewer-button">❮</button>
                <button class="interactive__item__viewer-button">❯</button>
            </div>
        `);
        $('body').append($viewer);
    }

    // Update viewer image
    function updateViewer() {
        $('.interactive__item-viewer img').attr('src', imgs[viewIndex]);
    }

    // Close viewer
    function closeViewer() {
        $('.interactive__item-viewer').remove();
        viewIndex = -1;
    }
});