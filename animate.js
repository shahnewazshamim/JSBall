var x = 0, y = window.innerHeight / 2;
xon = 0, yon = 0;
var step = 5, delay = 30;
var height = 0, heightOffset = 0;
var width = 0, widthOffset = 0;
var pause = true, interval;

var main = document.getElementById('main');

var move = function () {
    height = window.innerHeight;
    width = window.innerWidth;
    heightOffset = 50;
    widthOffset = 50;
    main.style.top = y + window.pageYOffset;
    main.style.left = x + window.pageXOffset;

    y = (yon) ? y + step : y - step;

    if (y < 0) {
        yon = 1;
        y = 0;
    }

    if (y >= (height - heightOffset)) {
        yon = 0;
        y = (height - heightOffset);
    }

    x = (xon) ? x + step : x - step;

    if (x < 0) {
        xon = 1;
        x = 0;
    }

    if (x >= (width - widthOffset)) {
        xon = 0;
        x = (width - widthOffset);
    }
};

var startAnimation = function () {
    interval = setInterval('move()', delay);
};

var stopResumeToggle = function () {
    if (pause) {
        clearInterval(interval);
        document.getElementById('button').value = 'Start';
        pause = false;
    } else {
        interval = setInterval('move()', delay);
        document.getElementById('button').value = 'Stop';
        pause = true;
    }
};

startAnimation();
