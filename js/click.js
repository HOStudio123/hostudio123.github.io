const coreValues = [
    "富强", "民主", "文明", "和谐",
    "自由", "平等", "公正", "法治",
    "爱国", "敬业", "诚信", "友善"
];

let currentIndex = 0;

document.body.addEventListener('click', function(e) {
    const value = coreValues[currentIndex];
    const valueText = document.createElement('div');
    valueText.textContent = value;

    valueText.style.position = 'absolute';
    valueText.style.color = '#ff0000';
    valueText.style.fontSize = '18px';
    valueText.style.fontWeight = 'bold';
    valueText.style.transform = 'translate(-50%, -50%)';
    valueText.style.opacity = '0';
    valueText.style.transition = 'opacity 2s, transform 2s';
    document.body.appendChild(valueText);

    valueText.style.left = e.clientX + 'px';
    valueText.style.top = e.clientY + 'px';

    getComputedStyle(valueText).opacity;

    valueText.style.opacity = '1';
    valueText.style.transform = 'translate(-50%, -50%) scale(1)';

    setTimeout(() => {
        valueText.style.opacity = '0';
        valueText.style.transform = 'translate(-50%, -50%) scale(1.5)';
        valueText.addEventListener('transitionend', function() {
            valueText.remove();
        });
    }, 2000);
    
    currentIndex = (currentIndex + 1) % coreValues.length;
});
