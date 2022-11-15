for (let e of document.querySelectorAll('input[type="range"].slider-progress')) {
    e.style.setProperty('--value', e.value);
    e.style.setProperty('--min', e.min == '' ? '0' : e.min);
    e.style.setProperty('--max', e.max == '' ? '100' : e.max);
    e.addEventListener('input', () => e.style.setProperty('--value', e.value));
}
const allRanges = document.querySelectorAll(".range");
allRanges.forEach(wrap => {
  const range = wrap.querySelector(".range1");
  const bubble = wrap.querySelector(".output");

  range.addEventListener("input", () => {
    setBubble(range, bubble);
  });
  setBubble(range, bubble);
});

function setBubble(range, bubble) {
  const val = range.value;
  const min = range.min ? range.min : 1000;
  const max = range.max ? range.max : 5500;
  const newVal = Number(((val - min) * 100) / (max - min));
  bubble.innerHTML = val + 'zł';

  // Sorta magic numbers based on size of the native UI thumb
  bubble.style.left = `calc(${newVal}% + (${40.7 - newVal * 0.853}vw))`;
  bubble.style.background = 'rgba(255, 255, 255, 0.2)'

  range.style.width = newVal + '% 100% !important';
}
