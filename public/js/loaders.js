function closeProgressBar(){
    for(const bar of document.querySelectorAll('.bar')){
        bar.parentNode.parentNode.classList.toggle('opened');
        bar.parentNode.parentNode.classList.toggle('closed');
    }
}

export function LoadProgressBar(title, current, total){
    document.querySelector('.loader header h1').innerHTML = title;
    let progress = document.querySelector('.loader .bar .progress');
    let percent = Math.round((100 / total) * current)
    progress.style.width = percent + '%';
    if(percent == 100){
        closeProgressBar();
    }
}