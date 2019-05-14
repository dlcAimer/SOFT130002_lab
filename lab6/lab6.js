function load() {
    let pos = document.getElementById("thumbnails");
    let images = delSpaceDom(pos);
    for (let i = 0; i < images.length; i++) {
        let src = getSrc(images[i].src);
        let title = images[i].title;
        images[i].onclick = function () {
            doClick(src,title);
        };
    }

    let figure = document.getElementById("featured");
    figure.onmouseover = function () {
        startMove(0.8);
    };
    figure.onmouseout = function () {
        startMove(0);
    };
}

function getSrc(src) {
    let arr = src.split("/");
    return arr[arr.length - 1];
}

function doClick(src,title) {
    let figure = document.getElementById("featured");
    let img = delSpaceDom(figure)[0];
    img.src = "images/medium/" + src;
    let caption = delSpaceDom(figure)[1];
    caption.innerHTML = title;
}

function delSpaceDom(parentNode) {
    let sub_child = parentNode.childNodes;
    for (let i = 0; i < sub_child.length; i++) {
        if (sub_child[i].nodeType === 3 && sub_child[i].nodeName === '#text' && !/\S/.test(sub_child[i].nodeValue)) {
            //文本节点并且是空的文本节点时，将空文本节点删除
            parentNode.removeChild(sub_child[i]);
        }
    }
    return parentNode.childNodes;
}

let timer = null;
let alpha = 0;
let speed = 0;
function startMove(opTarget) {
    clearInterval(timer);
    let caption = delSpaceDom(document.getElementById("featured"))[1];
    timer = setInterval(function () {
        if (alpha < opTarget) {
            speed = 0.1;
        } else if (alpha > opTarget) {
            speed = -0.1;
        }
        if (Math.abs(alpha-opTarget)<Number.EPSILON) {
            clearInterval(timer);
        } else {
            alpha += speed;
            caption.style.opacity = alpha;
        }
    }, 125);
}
