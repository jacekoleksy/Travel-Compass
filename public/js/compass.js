document.addEventListener('DOMContentLoaded', async function(){
  const questions = await fun();
  const buttons = [...document.querySelectorAll('.buttons button, .next')];
  var questionAnswer = [];
  var currentQuestion = 0;
  const span = document.querySelector('.current_question');
  buttons.forEach(element => {
      element.addEventListener('click', function(){

          const value = element.value;
          if (questionAnswer.length < questions.length) {
              questionAnswer.push(value);
          }
          if (questionAnswer.length >= questions.length) {
              document.querySelector('input[type="hidden"]').value = questionAnswer.join(',');
              document.querySelector('form').submit();
              return;
          }

          if (currentQuestion >= 0) {
              document.querySelector(".prev").style.display = "inline-block";
          }
          const span = document.querySelector('.current_question');
          const id = span.innerHTML.trim();
          
          currentQuestion++;
          span.innerHTML = currentQuestion + 1;

          document.querySelector('.current_title').innerHTML = questions[currentQuestion].description;

          type = questions[currentQuestion].type;
          document.querySelector(".buttons").style.display = "none";
          document.querySelector(".range").style.display = "none";
          document.querySelector(".checkboxes").style.display = "none";
          document.querySelector("."+type).style.display = "block";
          if (type != "buttons") {
            document.querySelector(".next").style.display = "inline-block";
          }
      })
  }) 
  document.querySelector(".prev").addEventListener('click', function(){
      questionAnswer.pop();
      currentQuestion--;
      span.innerHTML = currentQuestion + 1;
      document.querySelector('.current_title').innerHTML = questions[currentQuestion].description;

      type = questions[currentQuestion].type;
      document.querySelector(".buttons").style.display = "none";
      document.querySelector(".range").style.display = "none";
      document.querySelector(".checkboxes").style.display = "none";
      document.querySelector(".next").style.display = "none";
      document.querySelector("."+type).style.display = "block";
      if (type != "buttons") {
        document.querySelector(".next").style.display = "inline-block";
      }

      if (currentQuestion <= 0) {
          document.querySelector(".prev").style.display = "none";
      }
  });
}
)
async function fun(){
  const data = await fetch("/questions", {
  method: "POST",
  })  
  .then(response => response.json())
  return data;
}
function changeButtonType(buttons){
  buttons.forEach(button => button.type = 'submit');
}

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
//document.querySelectorAll(".prev").attr('disabled','disabled');